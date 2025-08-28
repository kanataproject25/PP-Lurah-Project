<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sk;
use Illuminate\Http\Request;
use App\Notifications\SuratStatusNotification;

class SkController extends Controller
{
    public function index(Request $request)
    {
        $query = Sk::query();

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
        return view('admin.skindex', compact('daftarSurat'));
    }

    public function show($id)
    {
        $sk = \App\Models\Sk::findOrFail($id);
        return view('admin.skdetail', compact('sk'));
    }

    public function download($id)
    {
        $sk = \App\Models\Sk::findOrFail($id);
        if ($sk->pdf_path && \Storage::disk('public')->exists($sk->pdf_path)) {
            return \Storage::disk('public')->download($sk->pdf_path);
        }
        abort(404, 'File tidak ditemukan');
    }

    public function approve(Request $request, $id)
    {
        $request->validate([
            'pdf_file' => 'required|mimes:pdf|max:2048',
        ]);
        $sk = \App\Models\Sk::findOrFail($id);
        $path = $request->file('pdf_file')->store('sk', 'public');
        $sk->pdf_path = $path;
        $sk->status = 'approved';
        $sk->save();
        // Kirim notifikasi ke user
        if ($sk->user) {
            $sk->user->notify(new \App\Notifications\SuratStatusNotification('disetujui'));
        }
        return redirect()->route('admin.sk.show', $sk->id)->with('success', 'Surat disetujui dan PDF diupload.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate(['alasan_tolak' => 'required']);
        $sk = \App\Models\Sk::findOrFail($id);
        $sk->status = 'rejected';
        $sk->alasan_tolak = $request->alasan_tolak;
        $sk->save();
        // Kirim notifikasi ke user
        if ($sk->user) {
            $sk->user->notify(new \App\Notifications\SuratStatusNotification('ditolak', $sk->alasan_tolak));
        }
        return redirect()->route('admin.sk.show', $sk->id)->with('success', 'Surat ditolak.');
    }

    public function create()
    {
        return view('admin.surat.skcreate');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required',
            'penandatangan' => 'required|in:lurah,sekretaris,kasipmk',
            'nama_penandatangan' => 'required',
            'jabatan_penandatangan' => 'required',
            'dasar_pengantar' => 'required',
            'nama' => 'required',
            'nik' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'hari_meninggal' => 'required',
            'tanggal_meninggal' => 'required|date',
            'tempat_meninggal' => 'required',
            'nama_pelapor' => 'required',
            'nik_pelapor' => 'required',
            'status_hubungan' => 'required',
            'no_hp' => 'required',
            'tanggal_surat' => 'required|date',
            'jabatan_ttd' => 'required',
            'nama_ttd' => 'required',
            'nip_ttd' => 'nullable',
            'surat_keterangan_pendukung' => 'nullable',
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

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.surat.sk_pdf', [
            'data' => $validated,
            'ttd' => $dataPejabat['ttd'],
            'nama_ttd' => $validated['nama_ttd'],
            'nip_ttd' => $validated['nip_ttd'],
            'jabatan_ttd' => $validated['jabatan_ttd'],
        ]);
        $filename = 'sk_' . now()->format('YmdHis') . '.pdf';
        $pdfPath = 'sk/' . $filename;
        \Storage::disk('public')->put($pdfPath, $pdf->output());
        return $pdf->download($filename);
    }

    public function cetakKematian($id)
    {
        $sk = \App\Models\Sk::findOrFail($id);
        // Data pejabat bisa diambil dari field di SK atau dari user/admin, disesuaikan kebutuhan
        $pejabat = (object) [
            'nama' => $sk->nama_ttd ?? 'Nama Pejabat',
            'jabatan' => $sk->jabatan_ttd ?? 'Jabatan Pejabat',
        ];
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.surat.sk_kematian_pdf', compact('sk', 'pejabat'));
        $filename = 'sk_kematian_' . now()->format('YmdHis') . '.pdf';
        return $pdf->download($filename);
    }
} 