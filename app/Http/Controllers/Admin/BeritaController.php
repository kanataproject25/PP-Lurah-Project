<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $beritas = Berita::orderBy('tanggal', 'desc')->get();
        return view('admin.berita.index', compact('beritas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.berita.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'tanggal' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'headline' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $data = $validated;
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('berita', 'public');
            // Copy manual ke public/storage/berita agar bisa diakses di Windows
            $from = storage_path('app/public/' . $data['image_path']);
            $to = public_path('storage/' . $data['image_path']);
            if (file_exists($from)) {
                $dir = dirname($to);
                if (!file_exists($dir)) {
                    mkdir($dir, 0777, true);
                }
                if (!copy($from, $to)) {
                    \Log::error('Gagal copy file gambar berita dari ' . $from . ' ke ' . $to);
                }
            } else {
                \Log::error('File gambar berita tidak ditemukan di ' . $from);
            }
        }
        Berita::create($data);
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Berita $berita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Berita $beritum)
    {
        return view('admin.berita.edit', compact('beritum'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Berita $beritum)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'tanggal' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'headline' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $data = $validated;
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($beritum->image_path && \Storage::disk('public')->exists($beritum->image_path)) {
                \Storage::disk('public')->delete($beritum->image_path);
                $oldPublic = public_path('storage/' . $beritum->image_path);
                if (file_exists($oldPublic)) {
                    unlink($oldPublic);
                }
            }
            $data['image_path'] = $request->file('image')->store('berita', 'public');
            // Copy manual ke public/storage/berita
            $from = storage_path('app/public/' . $data['image_path']);
            $to = public_path('storage/' . $data['image_path']);
            if (file_exists($from)) {
                $dir = dirname($to);
                if (!file_exists($dir)) {
                    mkdir($dir, 0777, true);
                }
                if (!copy($from, $to)) {
                    \Log::error('Gagal copy file gambar berita dari ' . $from . ' ke ' . $to);
                }
            } else {
                \Log::error('File gambar berita tidak ditemukan di ' . $from);
            }
        }
        $beritum->update($data);
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Berita $beritum)
    {
        \Log::info('Destroy called for berita id: ' . $beritum->id);
        // Hapus gambar jika ada
        if ($beritum->image_path && \Storage::disk('public')->exists($beritum->image_path)) {
            \Storage::disk('public')->delete($beritum->image_path);
            $oldPublic = public_path('storage/' . $beritum->image_path);
            if (file_exists($oldPublic)) {
                unlink($oldPublic);
            }
        }
        $beritum->delete();
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus.');
    }
}
