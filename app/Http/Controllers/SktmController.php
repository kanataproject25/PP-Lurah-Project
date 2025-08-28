<?php

namespace App\Http\Controllers;

use App\Models\Sktm;
use Illuminate\Http\Request;

class SktmController extends Controller
{
    public function index()
    {
        // Hanya admin yang boleh akses
        if (auth()->user()->role === 'admin') {
            $data = Sktm::latest()->get();
            return view('admin.sktmadmin', compact('data'));
        }
        // User diarahkan ke dashboard user
        return redirect()->route('user.dashboard');
    }

    public function create()
    {
        return view('user.sktmcreate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'          => 'required|string|max:255',
            'nik'           => 'required|string|max:20',
            'tempat_lahir'  => 'required|string|max:100', 
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'agama'         => 'required|string',
            'pekerjaan'     => 'required|string|max:100',
            'alamat'        => 'required|string',
            'keperluan'     => 'required|string',
            'file_ktp'      => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
            'file_kk'       => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
            'file_surat_rt' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only([
            'nama',
            'nik',
            'tempat_lahir',
            'tanggal_lahir',
            'jenis_kelamin',
            'agama',
            'pekerjaan',
            'alamat',
            'keperluan'
        ]);

        $data['user_id'] = auth()->user()->id;

        if ($request->hasFile('file_ktp')) {
            $data['file_ktp'] = $request->file('file_ktp')->store('sktm', 'public');
            // Copy ke public/storage agar bisa diakses
            $from = storage_path('app/public/' . $data['file_ktp']);
            $to = public_path('storage/' . $data['file_ktp']);
            if (!file_exists(dirname($to))) { mkdir(dirname($to), 0777, true); }
            copy($from, $to);
        }

        if ($request->hasFile('file_kk')) {
            $data['file_kk'] = $request->file('file_kk')->store('sktm', 'public');
            $from = storage_path('app/public/' . $data['file_kk']);
            $to = public_path('storage/' . $data['file_kk']);
            if (!file_exists(dirname($to))) { mkdir(dirname($to), 0777, true); }
            copy($from, $to);
        }

        if ($request->hasFile('file_surat_rt')) {
            $data['file_surat_rt'] = $request->file('file_surat_rt')->store('sktm', 'public');
            $from = storage_path('app/public/' . $data['file_surat_rt']);
            $to = public_path('storage/' . $data['file_surat_rt']);
            if (!file_exists(dirname($to))) { mkdir(dirname($to), 0777, true); }
            copy($from, $to);
        }

        Sktm::create($data);

        return redirect()->route('home')->with('success', 'Pengajuan SKTM berhasil dikirim.');
    }

    public function mySktm()
    {
        $surats = Sktm::where('user_id', auth()->user()->id)->get();
        return view('user.sktmuser', compact('surats'));
    }

    public function show($id)
    {
        $sktm = \App\Models\Sktm::findOrFail($id);
        // Pastikan hanya user yang berhak bisa melihat detail suratnya sendiri
        if (auth()->user()->role === 'user' && $sktm->user_id !== auth()->user()->id) {
            abort(403, 'Unauthorized');
        }
        return view('user.sktmdetail', compact('sktm'));
    }

    public function approve(Request $request, $id)
    {
        $request->validate(['pdf_file' => 'required|mimes:pdf|max:2048']);
        $sktm = Sktm::findOrFail($id);
        $path = $request->file('pdf_file')->store('sktm', 'public');
        $sktm->pdf_path = $path;
        $sktm->status = 'approved';
        $sktm->save();
        return redirect()->back()->with('success', 'Surat disetujui dan PDF diupload.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate(['alasan_tolak' => 'required']);
        $sktm = Sktm::findOrFail($id);
        $sktm->alasan_tolak = $request->alasan_tolak;
        $sktm->status = 'rejected';
        $sktm->save();
        return redirect()->back()->with('success', 'Surat ditolak.');
    }

    public function download($id)
    {
        $sktm = \App\Models\Sktm::findOrFail($id);
        // Pastikan hanya user yang berhak bisa download
        if (auth()->user()->role === 'user' && $sktm->user_id !== auth()->user()->id) {
            abort(403, 'Unauthorized');
        }
        if ($sktm->pdf_path && \Storage::disk('public')->exists($sktm->pdf_path)) {
            return \Storage::disk('public')->download($sktm->pdf_path);
        }
        abort(404, 'File tidak ditemukan');
    }
}
