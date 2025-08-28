<?php

namespace App\Http\Controllers;

use App\Models\Skbm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SkbmController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Skbm::query()->where('user_id', auth()->id());

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Pencarian nama/NIK
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('nik', 'like', '%' . $request->search . '%');
            });
        }

        $skbm = $query->latest()->paginate(10);
        return view('user.skbmindex', compact('skbm'));
    }

    public function create()
    {
        return view('user.skbmcreate');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:30',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string|max:20',
            'agama' => 'required|string|max:50',
            'alamat' => 'required|string|max:255',
            'status_pernikahan' => 'required|string',
            'foto_syarat_skbm' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'ktp' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'kk' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'pbb' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'surat_keterangan_rt' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);
        // Validasi dinamis untuk file_pernyataan, file_surat_cerai, file_surat_kematian
        if ($request->status_pernikahan === 'Belum Pernah Menikah') {
            $request->validate([
                'file_pernyataan' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            ]);
        }
        if ($request->status_pernikahan === 'Duda' || $request->status_pernikahan === 'Janda') {
            $request->validate([
                'file_surat_cerai' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            ]);
        }
        if ($request->status_pernikahan === 'Pernah Menikah & Pasangan Meninggal') {
            $request->validate([
                'file_surat_kematian' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            ]);
        }

        $data = $validated;
        // Simpan file_pernyataan jika ada
        $data['file_pernyataan'] = $request->file('file_pernyataan') ? $request->file('file_pernyataan')->store('skbm/pernyataan', 'public') : null;
        if ($data['file_pernyataan']) {
            $from = storage_path('app/public/' . $data['file_pernyataan']);
            $to = public_path('storage/' . $data['file_pernyataan']);
            if (!file_exists(dirname($to))) { mkdir(dirname($to), 0777, true); }
            copy($from, $to);
        }
        $data['foto_syarat_skbm'] = $request->file('foto_syarat_skbm')->store('skbm/foto', 'public');
        $from = storage_path('app/public/' . $data['foto_syarat_skbm']);
        $to = public_path('storage/' . $data['foto_syarat_skbm']);
        if (!file_exists(dirname($to))) { mkdir(dirname($to), 0777, true); }
        copy($from, $to);
        $data['ktp'] = $request->file('ktp')->store('skbm/ktp', 'public');
        $from = storage_path('app/public/' . $data['ktp']);
        $to = public_path('storage/' . $data['ktp']);
        if (!file_exists(dirname($to))) { mkdir(dirname($to), 0777, true); }
        copy($from, $to);
        $data['kk'] = $request->file('kk')->store('skbm/kk', 'public');
        $from = storage_path('app/public/' . $data['kk']);
        $to = public_path('storage/' . $data['kk']);
        if (!file_exists(dirname($to))) { mkdir(dirname($to), 0777, true); }
        copy($from, $to);
        $data['pbb'] = $request->file('pbb')->store('skbm/pbb', 'public');
        $from = storage_path('app/public/' . $data['pbb']);
        $to = public_path('storage/' . $data['pbb']);
        if (!file_exists(dirname($to))) { mkdir(dirname($to), 0777, true); }
        copy($from, $to);
        $data['surat_keterangan_rt'] = $request->file('surat_keterangan_rt')->store('skbm/surat_rt', 'public');
        $from = storage_path('app/public/' . $data['surat_keterangan_rt']);
        $to = public_path('storage/' . $data['surat_keterangan_rt']);
        if (!file_exists(dirname($to))) { mkdir(dirname($to), 0777, true); }
        copy($from, $to);
        $data['file_surat_cerai'] = $request->file('file_surat_cerai') ? $request->file('file_surat_cerai')->store('skbm/cerai', 'public') : null;
        if ($data['file_surat_cerai']) {
            $from = storage_path('app/public/' . $data['file_surat_cerai']);
            $to = public_path('storage/' . $data['file_surat_cerai']);
            if (!file_exists(dirname($to))) { mkdir(dirname($to), 0777, true); }
            copy($from, $to);
        }
        $data['file_surat_kematian'] = $request->file('file_surat_kematian') ? $request->file('file_surat_kematian')->store('skbm/kematian', 'public') : null;
        if ($data['file_surat_kematian']) {
            $from = storage_path('app/public/' . $data['file_surat_kematian']);
            $to = public_path('storage/' . $data['file_surat_kematian']);
            if (!file_exists(dirname($to))) { mkdir(dirname($to), 0777, true); }
            copy($from, $to);
        }

        $data['user_id'] = auth()->id();

        Skbm::create($data);

        return redirect()->route('skbm.index')->with('success', 'Pengajuan SKBM berhasil dikirim.');
    }

    public function show($id)
    {
        $skbm = Skbm::findOrFail($id);
        return view('user.skbmdetail', compact('skbm'));
    }

    public function destroy($id)
    {
        $skbm = Skbm::findOrFail($id);
        // Hapus file jika ada
        if ($skbm->file_pernyataan) Storage::disk('public')->delete($skbm->file_pernyataan);
        if ($skbm->foto_syarat_skbm) Storage::disk('public')->delete($skbm->foto_syarat_skbm);
        if ($skbm->file_surat_cerai) Storage::disk('public')->delete($skbm->file_surat_cerai);
        if ($skbm->file_surat_kematian) Storage::disk('public')->delete($skbm->file_surat_kematian);
        $skbm->delete();
        return redirect()->route('skbm.index')->with('success', 'Data berhasil dihapus.');
    }

    public function download($id)
    {
        $skbm = \App\Models\Skbm::findOrFail($id);
        if (auth()->user()->role === 'user' && $skbm->user_id !== auth()->user()->id) {
            abort(403, 'Unauthorized');
        }
        if ($skbm->pdf_path && \Storage::disk('public')->exists($skbm->pdf_path)) {
            return \Storage::disk('public')->download($skbm->pdf_path);
        }
        abort(404, 'File tidak ditemukan');
    }
} 