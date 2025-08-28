<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sdu;
use Illuminate\Http\Request;
use App\Notifications\SuratStatusNotification;

class SduController extends Controller
{
    public function index(Request $request)
    {
        $query = Sdu::query();

        // Filter status atau sorting
        if ($request->filled('status')) {
            if ($request->status == 'sort_desc') {
                $sort = 'desc';
            } elseif ($request->status == 'sort_asc') {
                $sort = 'asc';
            } else {
                $query->where('status', $request->status);
                $sort = $request->input('sort', 'desc');
            }
        } else {
            $sort = $request->input('sort', 'desc');
        }

        // Pencarian nama/NIK
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('nik', 'like', '%' . $request->search . '%');
            });
        }

        $perPage = $request->input('perPage', 10);
        $daftarSurat = $query->orderBy('created_at', $sort)->paginate($perPage)->appends($request->except('page'));
        return view('admin.sduindex', compact('daftarSurat'));
    }

    public function show($id)
    {
        $sdu = \App\Models\Sdu::findOrFail($id);
        return view('admin.sdudetail', compact('sdu'));
    }

    public function download($id)
    {
        $sdu = \App\Models\Sdu::findOrFail($id);
        if ($sdu->pdf_path && \Storage::disk('public')->exists($sdu->pdf_path)) {
            return \Storage::disk('public')->download($sdu->pdf_path);
        }
        abort(404, 'File tidak ditemukan');
    }

    public function approve(Request $request, $id)
    {
        $request->validate([
            'pdf_file' => 'required|mimes:pdf|max:2048',
        ]);
        $sdu = \App\Models\Sdu::findOrFail($id);
        $path = $request->file('pdf_file')->store('sdu', 'public');
        $sdu->pdf_path = $path;
        $sdu->status = 'approved';
        $sdu->save();
        // Kirim notifikasi ke user
        if ($sdu->user) {
            $sdu->user->notify(new \App\Notifications\SuratStatusNotification('disetujui', null, 'sdu'));
        }
        return redirect()->route('admin.sdu.show', $sdu->id)->with('success', 'Surat disetujui dan PDF diupload.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate(['alasan_tolak' => 'required']);
        $sdu = \App\Models\Sdu::findOrFail($id);
        $sdu->status = 'rejected';
        $sdu->alasan_tolak = $request->alasan_tolak;
        $sdu->save();
        // Kirim notifikasi ke user
        if ($sdu->user) {
            $sdu->user->notify(new \App\Notifications\SuratStatusNotification('ditolak', $sdu->alasan_tolak, 'sdu'));
        }
        return redirect()->route('admin.sdu.show', $sdu->id)->with('success', 'Surat ditolak.');
    }

    public function create()
    {
        return view('admin.surat.sducreate');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required',
            'penandatangan' => 'required|in:lurah,sekretaris,kasipmk',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'kewarganegaraan' => 'required',
            'pekerjaan' => 'required',
            'alamat' => 'required',
            'isi_surat' => 'required',
            'tanggal_surat' => 'required|date',
            'jabatan_ttd' => 'required',
            'nama_ttd' => 'required',
            'nip_ttd' => 'nullable',
            'penutup_surat' => 'required',
        ]);

        $pejabat = [
            'lurah' => [
                'nama' => 'Nama Lurah',
                'nip' => '123456789',
                'jabatan' => 'Lurah',
                'ttd' => 'img/ttd_lurah.png'
            ],
            'sekretaris' => [
                'nama' => 'Nama Sekretaris Lurah',
                'nip' => '987654321',
                'jabatan' => 'Sekretaris Lurah',
                'ttd' => 'img/sekre_lurah.png'
            ],
            'kasipmk' => [
                'nama' => 'Nama Kasi PMK',
                'nip' => '192837465',
                'jabatan' => 'Kasi PMK',
                'ttd' => 'img/kasipmk.png'
            ]
        ];
        $pilihan = $validated['penandatangan'];
        $dataPejabat = $pejabat[$pilihan];

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.surat.sdu_pdf', [
            'data' => $validated,
            'ttd' => $dataPejabat['ttd'],
            'nama_ttd' => $validated['nama_ttd'],
            'nip_ttd' => $validated['nip_ttd'],
            'jabatan_ttd' => $validated['jabatan_ttd'],
        ]);
        $filename = 'sdu_' . now()->format('YmdHis') . '.pdf';
        $pdfPath = 'sdu/' . $filename;
        \Storage::disk('public')->put($pdfPath, $pdf->output());
        return $pdf->download($filename);
    }
} 