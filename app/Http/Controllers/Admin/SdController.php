<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sd;
use Illuminate\Http\Request;
use App\Notifications\SuratStatusNotification;

class SdController extends Controller
{
    public function index(Request $request)
    {
        $query = Sd::query();

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
        return view('admin.sdindex', compact('daftarSurat'));
    }

    public function show($id)
    {
        $sd = \App\Models\Sd::findOrFail($id);
        return view('admin.sddetail', compact('sd'));
    }

    public function download($id)
    {
        $sd = \App\Models\Sd::findOrFail($id);
        if ($sd->pdf_path && \Storage::disk('public')->exists($sd->pdf_path)) {
            return \Storage::disk('public')->download($sd->pdf_path);
        }
        abort(404, 'File tidak ditemukan');
    }

    public function approve(Request $request, $id)
    {
        $request->validate([
            'pdf_file' => 'required|mimes:pdf|max:2048',
        ]);
        $sd = \App\Models\Sd::findOrFail($id);
        $path = $request->file('pdf_file')->store('sd', 'public');
        $sd->pdf_path = $path;
        $sd->status = 'approved';
        $sd->save();
        // Kirim notifikasi ke user
        if ($sd->user) {
            $sd->user->notify(new \App\Notifications\SuratStatusNotification('disetujui', null, 'sd'));
        }
        return redirect()->route('admin.sd.show', $sd->id)->with('success', 'Surat disetujui dan PDF diupload.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate(['alasan_tolak' => 'required']);
        $sd = \App\Models\Sd::findOrFail($id);
        $sd->status = 'rejected';
        $sd->alasan_tolak = $request->alasan_tolak;
        $sd->save();
        // Kirim notifikasi ke user
        if ($sd->user) {
            $sd->user->notify(new \App\Notifications\SuratStatusNotification('ditolak', $sd->alasan_tolak, 'sd'));
        }
        return redirect()->route('admin.sd.show', $sd->id)->with('success', 'Surat ditolak.');
    }

    public function create()
    {
        return view('admin.surat.sdcreate');
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
            'kewarganegaraan' => 'nullable',
            'pekerjaan' => 'nullable',
            'alamat' => 'nullable',
            'keperluan' => 'nullable',
            'isi_surat' => 'nullable',
            'penutup_surat' => 'nullable',
            'tanggal_surat' => 'nullable',
            'jabatan_ttd' => 'nullable',
            'nama_ttd' => 'nullable',
            'nip_ttd' => 'nullable',
            'ktp' => 'nullable',
            'kk' => 'nullable',
            'pbb' => 'nullable',
            'surat_keterangan_rt' => 'nullable',
            'pdf_path' => 'nullable',
            'status' => 'nullable',
            'alasan_tolak' => 'nullable',
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

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.surat.sd_pdf', [
            'data' => $validated,
            'ttd' => $dataPejabat['ttd'],
            'nama_ttd' => $validated['nama_ttd'],
            'nip_ttd' => $validated['nip_ttd'],
            'jabatan_ttd' => $validated['jabatan_ttd'],
        ]);
        $filename = 'sd_' . now()->format('YmdHis') . '.pdf';
        $pdfPath = 'sd/' . $filename;
        \Storage::disk('public')->put($pdfPath, $pdf->output());
        return $pdf->download($filename);
    }
} 