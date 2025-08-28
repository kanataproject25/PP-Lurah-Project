@extends('layouts.admin')

@section('content')
<style>
    .form-prestasi-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 24px 0 rgba(37,99,235,0.10);
        padding: 2.5rem 2rem;
        max-width: 600px;
        margin: 0 auto;
    }
    .form-prestasi-card label {
        font-weight: 700;
        color: #2563eb;
        margin-bottom: 6px;
        display: block;
        letter-spacing: 0.01em;
    }
    .form-prestasi-card input[type="text"],
    .form-prestasi-card input[type="number"],
    .form-prestasi-card textarea,
    .form-prestasi-card input[type="file"] {
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 1.04rem;
        margin-bottom: 2px;
        width: 100%;
        transition: border 0.2s;
        background: #f8fafc;
    }
    .form-prestasi-card input:focus,
    .form-prestasi-card textarea:focus {
        border-color: #2563eb;
        outline: none;
        background: #fff;
    }
    .preview-img-edit {
        max-height: 120px;
        max-width: 220px;
        object-fit: cover;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        border: 2px solid #e5e7eb;
        margin-bottom: 8px;
    }
    .btn-update-prestasi {
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
    .btn-update-prestasi:hover {
        background: linear-gradient(90deg,#1d4ed8 0%,#0ea5e9 100%);
        color: #fff;
        transform: translateY(-2px) scale(1.04);
        box-shadow: 0 6px 24px 0 rgba(37,99,235,0.18);
    }
    .btn-batal-prestasi {
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
    .btn-batal-prestasi:hover {
        background: #e0e7ef;
        color: #2563eb;
        text-decoration: underline;
    }
    @media (max-width: 600px) {
        .form-prestasi-card { padding: 1.2rem 0.5rem; }
        .btn-update-prestasi, .btn-batal-prestasi { width: 100%; margin: 0 0 10px 0; display: block; }
    }
</style>
<div class="container mx-auto py-8">
    <h2 class="text-2xl font-bold mb-6 text-center">Edit Prestasi</h2>
    <form action="{{ route('admin.prestasi.update', $prestasi->id) }}" method="POST" enctype="multipart/form-data" class="form-prestasi-card space-y-6">
        @csrf
        @method('PUT')
        <div>
            <label for="judul">Judul Prestasi</label>
            <input type="text" name="judul" id="judul" value="{{ old('judul', $prestasi->judul) }}" required>
        </div>
        <div>
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="4">{{ old('deskripsi', $prestasi->deskripsi) }}</textarea>
        </div>
        <div>
            <label for="tahun">Tahun</label>
            <input type="number" name="tahun" id="tahun" value="{{ old('tahun', $prestasi->tahun) }}">
        </div>
        <div>
            <label for="kategori">Kategori</label>
            <input type="text" name="kategori" id="kategori" value="{{ old('kategori', $prestasi->kategori) }}">
        </div>
        <div>
            <label for="badge">Juara/Badge</label>
            <input type="text" name="badge" id="badge" value="{{ old('badge', $prestasi->badge) }}">
        </div>
        <div>
            <label for="gambar">Gambar Prestasi</label>
            @if($prestasi->gambar)
                <img src="{{ asset('storage/' . $prestasi->gambar) }}" alt="Gambar Prestasi" class="preview-img-edit">
            @endif
            <input type="file" name="gambar" id="gambar" accept="image/*">
            <small class="text-gray-500">Kosongkan jika tidak ingin mengganti gambar.</small>
        </div>
        <div class="flex items-center mt-6">
            <button type="submit" class="btn-update-prestasi"><i class="bi bi-arrow-repeat"></i> Update</button>
            <a href="{{ route('admin.prestasi.index') }}" class="btn-batal-prestasi">Batal</a>
        </div>
    </form>
</div>
@endsection 