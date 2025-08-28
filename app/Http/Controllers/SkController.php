<?php

namespace App\Http\Controllers;

use App\Models\Sk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SkController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Sk::query()->where('user_id', auth()->id());

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

        $sk = $query->latest()->paginate(10);
        return view('user.skindex', compact('sk'));
    }

    public function create()
    {
        return view('user.skcreate');
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
            'hari_meninggal' => 'required|string|max:20',
            'tanggal_meninggal' => 'required|date',
            'penyebab' => 'required|string|max:100',
            'tempat_meninggal' => 'required|string|max:255',
            'nama_pelapor' => 'required|string|max:255',
            'nik_pelapor' => 'required|string|max:30',
            'status_hubungan' => 'required|string|max:50',
            'no_hp' => 'required|string|max:20',
            'surat_keterangan_pendukung' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $validated['surat_keterangan_pendukung'] = $request->file('surat_keterangan_pendukung')->store('sk', 'public');
        $from = storage_path('app/public/' . $validated['surat_keterangan_pendukung']);
        $to = public_path('storage/' . $validated['surat_keterangan_pendukung']);
        if (!file_exists(dirname($to))) { mkdir(dirname($to), 0777, true); }
        copy($from, $to);

        $validated['user_id'] = auth()->id();

        Sk::create($validated);

        return redirect()->route('sk.index')->with('success', 'Surat Kematian berhasil diajukan.');
    }

    public function show($id)
    {
        $sk = Sk::findOrFail($id);
        return view('user.skdetail', compact('sk'));
    }

    public function destroy($id)
    {
        $sk = Sk::findOrFail($id);
        // Hapus file jika ada
        if ($sk->surat_keterangan_pendukung) {
            \Storage::delete([$sk->surat_keterangan_pendukung]);
        }
        $sk->delete();
        return redirect()->route('sk.index')->with('success', 'Data berhasil dihapus.');
    }

    public function download($id)
    {
        $sk = \App\Models\Sk::findOrFail($id);
        if (auth()->user()->role === 'user' && $sk->user_id !== auth()->user()->id) {
            abort(403, 'Unauthorized');
        }
        if ($sk->pdf_path && \Storage::disk('public')->exists($sk->pdf_path)) {
            return \Storage::disk('public')->download($sk->pdf_path);
        }
        abort(404, 'File tidak ditemukan');
    }
} 