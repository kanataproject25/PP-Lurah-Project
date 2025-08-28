@extends('layouts.admin')

@section('content')
<style>
    .form-berita-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 24px 0 rgba(37,99,235,0.10);
        padding: 2.5rem 2rem;
        max-width: 600px;
        margin: 0 auto;
    }
    .form-berita-card label {
        font-weight: 700;
        color: #2563eb;
        margin-bottom: 6px;
        display: block;
        letter-spacing: 0.01em;
    }
    .form-berita-card input[type="text"],
    .form-berita-card input[type="date"],
    .form-berita-card textarea,
    .form-berita-card input[type="file"] {
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 1.04rem;
        margin-bottom: 2px;
        width: 100%;
        transition: border 0.2s;
        background: #f8fafc;
    }
    .form-berita-card input:focus,
    .form-berita-card textarea:focus {
        border-color: #2563eb;
        outline: none;
        background: #fff;
    }
    .btn-simpan-berita {
        background: linear-gradient(90deg,#2563eb 0%,#06b6d4 100%);
        color: #fff;
        font-weight: 700;
        font-size: 1.08rem;
        padding: 12px 28px;
        border-radius: 10px;
        box-shadow: 0 2px 12px 0 rgba(37,99,235,0.13);
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: background 0.2s, box-shadow 0.2s, transform 0.15s;
        border: none;
        outline: none;
    }
    .btn-simpan-berita:hover {
        background: linear-gradient(90deg,#1d4ed8 0%,#0ea5e9 100%);
        color: #fff;
        transform: translateY(-2px) scale(1.04);
        box-shadow: 0 6px 24px 0 rgba(37,99,235,0.18);
    }
    .btn-batal-berita {
        margin-left: 18px;
        color: #64748b;
        background: #f3f4f6;
        border-radius: 8px;
        padding: 12px 22px;
        font-weight: 600;
        font-size: 1.04rem;
        transition: background 0.2s, color 0.2s;
        border: none;
        display: inline-block;
    }
    .btn-batal-berita:hover {
        background: #e0e7ef;
        color: #2563eb;
        text-decoration: underline;
    }
    @media (max-width: 600px) {
        .form-berita-card { padding: 1.2rem 0.5rem; }
        .btn-simpan-berita, .btn-batal-berita { width: 100%; margin: 0 0 10px 0; display: block; }
    }
</style>
<div class="container mx-auto py-8">
    <h2 class="text-2xl font-bold mb-6 text-center">Tambah Berita</h2>
    <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data" class="form-berita-card space-y-6">
        @csrf
        <div>
            <label for="judul">Judul Berita</label>
            <input type="text" name="judul" id="judul" required>
        </div>
        <div>
            <label for="isi">Isi Berita</label>
            <textarea name="isi" id="isi" rows="6" required></textarea>
        </div>
        <div>
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" required>
        </div>
        <div>
            <label for="headline">Headline (opsional)</label>
            <input type="text" name="headline" id="headline">
        </div>
        <div>
            <label for="deskripsi">Deskripsi Singkat (opsional)</label>
            <textarea name="deskripsi" id="deskripsi" rows="3"></textarea>
        </div>
        <div>
            <label for="image">Gambar Berita</label>
            <input type="file" name="image" id="image" accept="image/*">
        </div>
        <div class="flex items-center mt-6">
            <button type="submit" class="btn-simpan-berita"><i class="bi bi-save"></i> Simpan</button>
            <a href="{{ route('admin.berita.index') }}" class="btn-batal-berita">Batal</a>
        </div>
    </form>
</div>
@endsection 