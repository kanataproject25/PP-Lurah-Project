@extends('layouts.admin')

@section('content')
<style>
    .prestasi-form-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 24px 0 rgba(37,99,235,0.10);
        padding: 2.5rem 2rem 2rem 2rem;
        max-width: 520px;
        margin: 0 auto 2rem auto;
    }
    .prestasi-form-title {
        font-size: 2rem;
        font-weight: 800;
        color: #2563eb;
        margin-bottom: 1.5rem;
        text-align: center;
    }
    .prestasi-form-label {
        font-weight: 600;
        margin-bottom: 0.4rem;
        color: #334155;
    }
    .prestasi-form-input, .prestasi-form-textarea, .prestasi-form-file {
        width: 100%;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 1.08rem;
        margin-bottom: 1.1rem;
        background: #f8fafc;
        transition: border 0.18s;
    }
    .prestasi-form-input:focus, .prestasi-form-textarea:focus, .prestasi-form-file:focus {
        border-color: #2563eb;
        outline: none;
        background: #fff;
    }
    .prestasi-form-btn {
        background: linear-gradient(90deg,#2563eb 0%,#06b6d4 100%);
        color: #fff;
        font-weight: 700;
        font-size: 1.08rem;
        padding: 12px 32px;
        border-radius: 10px;
        box-shadow: 0 2px 12px 0 rgba(37,99,235,0.13);
        border: none;
        outline: none;
        transition: background 0.2s, box-shadow 0.2s, transform 0.15s;
    }
    .prestasi-form-btn:hover {
        background: linear-gradient(90deg,#1d4ed8 0%,#0ea5e9 100%);
        color: #fff;
        transform: translateY(-2px) scale(1.04);
        box-shadow: 0 6px 24px 0 rgba(37,99,235,0.18);
    }
    .prestasi-form-cancel {
        color: #64748b;
        font-weight: 500;
        font-size: 1.05rem;
        margin-left: 1.2rem;
        text-decoration: underline;
        transition: color 0.18s;
    }
    .prestasi-form-cancel:hover { color: #2563eb; }
    @media (max-width: 600px) {
        .prestasi-form-card { padding: 1.2rem 0.5rem; }
        .prestasi-form-title { font-size: 1.2rem; }
    }
</style>
<div class="container mx-auto py-8">
    <div class="prestasi-form-card">
        <div class="prestasi-form-title">Tambah Prestasi</div>
        <form action="{{ route('admin.prestasi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="prestasi-form-label" for="judul">Judul <span class="text-danger">*</span></label>
                <input type="text" name="judul" id="judul" class="prestasi-form-input" required value="{{ old('judul') }}">
            </div>
            <div class="mb-4">
                <label class="prestasi-form-label" for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="4" class="prestasi-form-textarea">{{ old('deskripsi') }}</textarea>
            </div>
            <div class="mb-4">
                <label class="prestasi-form-label" for="tahun">Tahun</label>
                <input type="number" name="tahun" id="tahun" class="prestasi-form-input" value="{{ old('tahun') }}">
            </div>
            <div class="mb-4">
                <label class="prestasi-form-label" for="kategori">Kategori</label>
                <input type="text" name="kategori" id="kategori" class="prestasi-form-input" value="{{ old('kategori') }}">
            </div>
            <div class="mb-4">
                <label class="prestasi-form-label" for="badge">Juara</label>
                <input type="text" name="badge" id="badge" class="prestasi-form-input" value="{{ old('badge') }}">
            </div>
            <div class="mb-4">
                <label class="prestasi-form-label" for="gambar">Upload Gambar</label>
                <input type="file" name="gambar" id="gambar" class="prestasi-form-file" accept="image/*">
            </div>
            <div class="flex items-center gap-4">
                <button type="submit" class="prestasi-form-btn">Simpan</button>
                <a href="{{ route('admin.prestasi.index') }}" class="prestasi-form-cancel">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection 