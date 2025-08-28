<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Models\Sktm;
use Illuminate\Support\Facades\Storage;
use App\Notifications\SuratStatusNotification;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SktmController extends Controller
{
    public function create()
    {
        return view('admin.surat.sktmcreate');
    }

    public function store(Request $request)
    {
        \Log::info('Masuk ke method store SKTM', ['user_id' => auth()->id(), 'request' => $request->all()]);
        // Validasi data
        $validated = $request->validate([
            'nomor_surat' => 'required',
            'penandatangan' => 'required|in:lurah,sekretaris,kasipmk',
            'penandatangan_nama' => 'required',
            'penandatangan_jabatan' => 'required',
            'nama' => 'required',
            'nik' => 'nullable',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'pekerjaan' => 'required',
            'alamat' => 'required',
            'isi_surat' => 'required',
            'tanggal_surat' => 'required|date',
            'jabatan_ttd' => 'required',
            'nama_ttd' => 'required',
            'nip_ttd' => 'nullable',
            'penutup_surat' => 'required',
        ]);

        // Data pejabat
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

        $pdf = Pdf::loadView('admin.surat.sktm_pdf', [
            'data' => $validated,
            'ttd' => $dataPejabat['ttd'],
            'nama_ttd' => $dataPejabat['nama'],
            'nip_ttd' => $dataPejabat['nip'],
            'jabatan_ttd' => $dataPejabat['jabatan'],
        ]);
        $filename = 'sktm_' . now()->format('YmdHis') . '.pdf';
        $pdfPath = 'sktm/' . $filename;
        \Storage::disk('public')->put($pdfPath, $pdf->output());
        return $pdf->download($filename);
    }

    public function index(Request $request)
    {
        $query = Sktm::query();

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

        // Filter tahun
        if ($request->filled('tahun')) {
            $query->whereYear('created_at', $request->tahun);
        }
        // Filter bulan
        if ($request->filled('bulan')) {
            $query->whereMonth('created_at', $request->bulan);
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
        return view('admin.surat.sktmindex', compact('daftarSurat'));
    }

    public function download(Sktm $sktm)
    {
        if ($sktm->pdf_path && Storage::disk('public')->exists($sktm->pdf_path)) {
            return Storage::disk('public')->download($sktm->pdf_path);
        }
        abort(404, 'File tidak ditemukan');
    }

    public function show(Sktm $sktm)
    {
        return view('admin.surat.sktmdetail', compact('sktm'));
    }

    public function approve(Request $request, Sktm $sktm)
    {
        $request->validate([
            'pdf_file' => 'required|mimes:pdf|max:2048',
        ]);
        $path = $request->file('pdf_file')->store('sktm', 'public');
        $sktm->pdf_path = $path;
        $sktm->status = 'approved';
        $sktm->save();
        // Kirim notifikasi ke user
        if ($sktm->user) {
            $sktm->user->notify(new \App\Notifications\SuratStatusNotification('disetujui', null, 'sktm'));
        }
        return redirect()->route('admin.sktm.show', $sktm->id)->with('success', 'Surat disetujui dan PDF diupload.');
    }

    public function reject(Request $request, Sktm $sktm)
    {
        $request->validate([
            'alasan_tolak' => 'required',
        ]);
        $sktm->alasan_tolak = $request->alasan_tolak;
        $sktm->status = 'rejected';
        $sktm->save();
        // Kirim notifikasi ke user
        if ($sktm->user) {
            $sktm->user->notify(new \App\Notifications\SuratStatusNotification('ditolak', $sktm->alasan_tolak, 'sktm'));
        }
        return redirect()->route('admin.sktm.show', $sktm->id)->with('success', 'Surat ditolak.');
    }

    public function verifikasi($id)
    {
        // Contoh: cari surat berdasarkan hash id (sementara data dummy)
        // Nanti bisa dikembangkan untuk mencari di database
        $data = [
            'nomor_surat' => 'Contoh/123/2025',
            'nama' => 'Nama Pemohon',
            'tanggal_surat' => '2025-07-27',
            'status' => 'Surat ini ASLI dan terdaftar di sistem',
            'nama_ttd' => 'Lurah Pasir Putih',
            'nip_ttd' => '123456789',
        ];
        return view('verifikasi.surat', compact('data'));
    }
}
