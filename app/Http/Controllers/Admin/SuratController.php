<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArsipLama;

class SuratController extends Controller
{
    public function index()
    {
        return view('admin.surat.index');
    }

    public function delete($jenis, $id)
    {
        $model = null;
        switch (strtoupper($jenis)) {
            case 'SKTM':
                $model = \App\Models\Sktm::find($id);
                break;
            case 'SDU':
                $model = \App\Models\Sdu::find($id);
                break;
            case 'SD':
                $model = \App\Models\Sd::find($id);
                break;
            case 'SK':
                $model = \App\Models\Sk::find($id);
                break;
            case 'SKBM':
                $model = \App\Models\Skbm::find($id);
                break;
        }
        if ($model) {
            $model->delete();
            return redirect()->route('admin.dashboard')->with('success', 'Surat berhasil dihapus.');
        } else {
            return redirect()->route('admin.dashboard')->with('error', 'Surat tidak ditemukan.');
        }
    }

    public function uploadArsipLama(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:32',
            'tanggal_pengajuan' => 'required|date',
            'jenis_surat' => 'required|in:SKTM,SD,SDU,SK,SKBM',
            'file_pdf' => 'required|mimes:pdf|max:20480',
        ]);
        $filePath = $request->file('file_pdf')->store('arsip_lama', 'public');
        ArsipLama::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'jenis_surat' => $request->jenis_surat,
            'file_pdf' => $filePath,
        ]);
        return redirect()->route('admin.dashboard', ['perPage' => $request->perPage])->with('success', 'Arsip lama berhasil diupload.');
    }

    public function deleteArsipLama($id)
    {
        $arsip = \App\Models\ArsipLama::find($id);
        if ($arsip) {
            // Hapus file PDF jika ada
            if ($arsip->file_pdf && \Storage::disk('public')->exists($arsip->file_pdf)) {
                \Storage::disk('public')->delete($arsip->file_pdf);
            }
            $arsip->delete();
            return redirect()->route('admin.dashboard')->with('success', 'Arsip lama berhasil dihapus.');
        } else {
            return redirect()->route('admin.dashboard')->with('error', 'Arsip lama tidak ditemukan.');
        }
    }

    public function downloadArsipLama($id)
    {
        $arsip = \App\Models\ArsipLama::findOrFail($id);
        if ($arsip->file_pdf && \Storage::disk('public')->exists($arsip->file_pdf)) {
            return \Storage::disk('public')->download($arsip->file_pdf);
        }
        abort(404, 'File tidak ditemukan');
    }
}
