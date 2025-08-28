<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index()
    {
        $galeris = Galeri::orderBy('tanggal', 'desc')->get();
        return view('admin.galeri.index', compact('galeris'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $data = $validated;
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('galeri', 'public');
            $from = storage_path('app/public/' . $data['image_path']);
            $to = public_path('storage/' . $data['image_path']);
            if (file_exists($from)) {
                $dir = dirname($to);
                if (!file_exists($dir)) {
                    mkdir($dir, 0777, true);
                }
                copy($from, $to);
            }
        }
        Galeri::create($data);
        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function edit(Galeri $galeri)
    {
        return view('admin.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $data = $validated;
        if ($request->hasFile('image')) {
            if ($galeri->image_path && \Storage::disk('public')->exists($galeri->image_path)) {
                \Storage::disk('public')->delete($galeri->image_path);
                $oldPublic = public_path('storage/' . $galeri->image_path);
                if (file_exists($oldPublic)) {
                    unlink($oldPublic);
                }
            }
            $data['image_path'] = $request->file('image')->store('galeri', 'public');
            $from = storage_path('app/public/' . $data['image_path']);
            $to = public_path('storage/' . $data['image_path']);
            if (file_exists($from)) {
                $dir = dirname($to);
                if (!file_exists($dir)) {
                    mkdir($dir, 0777, true);
                }
                copy($from, $to);
            }
        }
        $galeri->update($data);
        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil diupdate.');
    }

    public function destroy(Galeri $galeri)
    {
        if ($galeri->image_path && \Storage::disk('public')->exists($galeri->image_path)) {
            \Storage::disk('public')->delete($galeri->image_path);
            $oldPublic = public_path('storage/' . $galeri->image_path);
            if (file_exists($oldPublic)) {
                unlink($oldPublic);
            }
        }
        $galeri->delete();
        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil dihapus.');
    }
}
