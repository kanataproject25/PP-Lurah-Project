<?php

namespace App\Http\Controllers;

use App\Models\Sdu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SduController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Sdu::query()->where('user_id', auth()->id());

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

        $sdu = $query->latest()->paginate(10);
        return view('user.sduindex', compact('sdu'));
    }

    public function create()
    {
        return view('user.sducreate');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string|max:20',
            'kewarganegaraan' => 'required|string|max:50',
            'pekerjaan' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'nama_usaha' => 'required|string|max:255',
            'keperluan' => 'required|string|max:255',
            'ktp' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'kk' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'pbb' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'surat_keterangan_rt' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $validated['ktp'] = $request->file('ktp')->store('sdu', 'public');
        $from = storage_path('app/public/' . $validated['ktp']);
        $to = public_path('storage/' . $validated['ktp']);
        if (!file_exists(dirname($to))) { mkdir(dirname($to), 0777, true); }
        copy($from, $to);
        $validated['kk'] = $request->file('kk')->store('sdu', 'public');
        $from = storage_path('app/public/' . $validated['kk']);
        $to = public_path('storage/' . $validated['kk']);
        if (!file_exists(dirname($to))) { mkdir(dirname($to), 0777, true); }
        copy($from, $to);
        $validated['pbb'] = $request->file('pbb')->store('sdu', 'public');
        $from = storage_path('app/public/' . $validated['pbb']);
        $to = public_path('storage/' . $validated['pbb']);
        if (!file_exists(dirname($to))) { mkdir(dirname($to), 0777, true); }
        copy($from, $to);
        $validated['surat_keterangan_rt'] = $request->file('surat_keterangan_rt')->store('sdu', 'public');
        $from = storage_path('app/public/' . $validated['surat_keterangan_rt']);
        $to = public_path('storage/' . $validated['surat_keterangan_rt']);
        if (!file_exists(dirname($to))) { mkdir(dirname($to), 0777, true); }
        copy($from, $to);

        $validated['user_id'] = auth()->id();

        Sdu::create($validated);

        return redirect()->route('sdu.index')->with('success', 'Surat Domisili Usaha berhasil diajukan.');
    }

    public function show($id)
    {
        $sdu = Sdu::findOrFail($id);
        return view('user.sdudetail', compact('sdu'));
    }

    public function destroy($id)
    {
        $sdu = Sdu::findOrFail($id);
        // Hapus file jika ada
        Storage::delete([$sdu->ktp, $sdu->kk, $sdu->pbb, $sdu->surat_keterangan_rt]);
        $sdu->delete();
        return redirect()->route('sdu.index')->with('success', 'Data berhasil dihapus.');
    }

    public function download($id)
    {
        $sdu = \App\Models\Sdu::findOrFail($id);
        if (auth()->user()->role === 'user' && $sdu->user_id !== auth()->user()->id) {
            abort(403, 'Unauthorized');
        }
        if ($sdu->pdf_path && \Storage::disk('public')->exists($sdu->pdf_path)) {
            return \Storage::disk('public')->download($sdu->pdf_path);
        }
        abort(404, 'File tidak ditemukan');
    }
} 