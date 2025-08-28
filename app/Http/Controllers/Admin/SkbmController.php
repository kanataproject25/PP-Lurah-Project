<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skbm;
use Illuminate\Http\Request;
use App\Notifications\SuratStatusNotification;

class SkbmController extends Controller
{
    public function index(Request $request)
    {
        $query = Skbm::query();

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
        return view('admin.skbmindex', compact('daftarSurat'));
    }

    public function create()
    {
        return view('admin.skbmcreate');
    }

    public function show($id)
    {
        $skbm = \App\Models\Skbm::findOrFail($id);
        return view('admin.skbmdetail', compact('skbm'));
    }

    public function download($id)
    {
        $skbm = \App\Models\Skbm::findOrFail($id);
        if ($skbm->pdf_path && \Storage::disk('public')->exists($skbm->pdf_path)) {
            return \Storage::disk('public')->download($skbm->pdf_path);
        }
        abort(404, 'File tidak ditemukan');
    }

    public function approve(\Illuminate\Http\Request $request, $id)
    {
        $request->validate([
            'pdf_file' => 'required|mimes:pdf|max:2048',
        ]);
        $skbm = \App\Models\Skbm::findOrFail($id);
        $path = $request->file('pdf_file')->store('skbm', 'public');
        $skbm->pdf_path = $path;
        $skbm->status = 'approved';
        $skbm->save();
        // Kirim notifikasi ke user
        if ($skbm->user) {
            $skbm->user->notify(new \App\Notifications\SuratStatusNotification('disetujui', null, 'skbm'));
        }
        return redirect()->route('admin.skbm.show', $skbm->id)->with('success', 'Surat disetujui dan PDF diupload.');
    }

    public function reject(\Illuminate\Http\Request $request, $id)
    {
        $request->validate(['alasan_tolak' => 'required']);
        $skbm = \App\Models\Skbm::findOrFail($id);
        $skbm->status = 'rejected';
        $skbm->alasan_tolak = $request->alasan_tolak;
        $skbm->save();
        // Kirim notifikasi ke user
        if ($skbm->user) {
            $skbm->user->notify(new \App\Notifications\SuratStatusNotification('ditolak', $skbm->alasan_tolak, 'skbm'));
        }
        return redirect()->route('admin.skbm.show', $skbm->id)->with('success', 'Surat ditolak.');
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'penandatangan' => 'required|in:lurah,sekretaris,kasipmk',
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string|max:20',
            'agama' => 'required|string|max:50',
            'kewarganegaraan' => 'required|string|max:50',
            'pekerjaan' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'isi_surat' => 'required|string',
            'penutup_surat' => 'required|string',
            'tanggal_surat' => 'required|date',
            'jabatan_ttd' => 'required|string',
            'nama_ttd' => 'required|string',
            'nip_ttd' => 'nullable|string',
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

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.skbm_pdf', [
            'data' => $validated,
            'ttd' => $dataPejabat['ttd'],
            'nama_ttd' => $validated['nama_ttd'],
            'nip_ttd' => $validated['nip_ttd'],
            'jabatan_ttd' => $validated['jabatan_ttd'],
        ]);
        $filename = 'skbm_' . now()->format('YmdHis') . '.pdf';
        $pdfPath = 'skbm/' . $filename;
        \Storage::disk('public')->put($pdfPath, $pdf->output());
        return $pdf->download($filename);
    }
} 