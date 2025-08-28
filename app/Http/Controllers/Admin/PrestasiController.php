<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prestasi = Prestasi::orderByDesc('tahun')->get();
        return view('admin.prestasi.index', compact('prestasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.prestasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tahun' => 'nullable|integer',
            'kategori' => 'nullable|string|max:100',
            'badge' => 'nullable|string|max:100',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('prestasi', 'public');
            $from = storage_path('app/public/' . $validated['gambar']);
            $to = public_path('storage/' . $validated['gambar']);
            if (!file_exists(dirname($to))) { mkdir(dirname($to), 0777, true); }
            copy($from, $to);
        }
        Prestasi::create($validated);
        return redirect()->route('admin.prestasi.index')->with('success', 'Prestasi berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        return view('admin.prestasi.edit', compact('prestasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $prestasi = Prestasi::findOrFail($id);
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tahun' => 'nullable|integer',
            'kategori' => 'nullable|string|max:100',
            'badge' => 'nullable|string|max:100',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($request->hasFile('gambar')) {
            if ($prestasi->gambar && \Storage::disk('public')->exists($prestasi->gambar)) {
                \Storage::disk('public')->delete($prestasi->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('prestasi', 'public');
            $from = storage_path('app/public/' . $validated['gambar']);
            $to = public_path('storage/' . $validated['gambar']);
            if (!file_exists(dirname($to))) { mkdir(dirname($to), 0777, true); }
            copy($from, $to);
        }
        $prestasi->update($validated);
        return redirect()->route('admin.prestasi.index')->with('success', 'Prestasi berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        $prestasi->delete();
        return redirect()->route('admin.prestasi.index')->with('success', 'Prestasi berhasil dihapus!');
    }
}
