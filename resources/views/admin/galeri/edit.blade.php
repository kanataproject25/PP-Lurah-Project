@extends('layouts.admin')

@section('content')
<style>
    .galeri-form-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 24px 0 rgba(37,99,235,0.10);
        padding: 2.5rem 2rem 2rem 2rem;
        max-width: 520px;
        margin: 0 auto 2rem auto;
    }
    .galeri-form-title {
        font-size: 2rem;
        font-weight: 800;
        color: #2563eb;
        margin-bottom: 1.5rem;
        text-align: center;
    }
    .galeri-form-label {
        font-weight: 600;
        margin-bottom: 0.4rem;
        color: #334155;
    }
    .galeri-form-input, .galeri-form-textarea, .galeri-form-date, .galeri-form-file {
        width: 100%;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 1.08rem;
        margin-bottom: 1.1rem;
        background: #f8fafc;
        transition: border 0.18s;
    }
    .galeri-form-input:focus, .galeri-form-textarea:focus, .galeri-form-date:focus, .galeri-form-file:focus {
        border-color: #2563eb;
        outline: none;
        background: #fff;
    }
    .galeri-form-btn {
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
    .galeri-form-btn:hover {
        background: linear-gradient(90deg,#1d4ed8 0%,#0ea5e9 100%);
        color: #fff;
        transform: translateY(-2px) scale(1.04);
        box-shadow: 0 6px 24px 0 rgba(37,99,235,0.18);
    }
    .galeri-form-cancel {
        color: #64748b;
        font-weight: 500;
        font-size: 1.05rem;
        margin-left: 1.2rem;
        text-decoration: underline;
        transition: color 0.18s;
    }
    .galeri-form-cancel:hover { color: #2563eb; }
    .galeri-img-preview {
        max-height: 100px;
        max-width: 160px;
        object-fit: cover;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        border: 2px solid #e5e7eb;
        margin-bottom: 0.7rem;
    }
    @media (max-width: 600px) {
        .galeri-form-card { padding: 1.2rem 0.5rem; }
        .galeri-form-title { font-size: 1.2rem; }
    }
</style>
<div class="container mx-auto py-8">
    <div class="galeri-form-card">
        <div class="galeri-form-title">Edit Galeri Kegiatan</div>
        <form action="{{ route('admin.galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="galeri-form-label" for="judul">Judul</label>
                <input type="text" name="judul" id="judul" class="galeri-form-input" value="{{ old('judul', $galeri->judul) }}" required>
            </div>
            <div class="mb-4">
                <label class="galeri-form-label" for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="4" class="galeri-form-textarea">{{ old('deskripsi', $galeri->deskripsi) }}</textarea>
            </div>
            <div class="mb-4">
                <label class="galeri-form-label" for="tanggal">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="galeri-form-date" value="{{ old('tanggal', $galeri->tanggal) }}" required>
            </div>
            <div class="mb-4">
                <label class="galeri-form-label" for="image">Gambar</label>
                @if($galeri->image_path)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $galeri->image_path) }}" alt="Gambar Galeri" class="galeri-img-preview">
                    </div>
                @endif
                <input type="file" name="image" id="image" class="galeri-form-file" accept="image/*">
                <small class="text-gray-500">Kosongkan jika tidak ingin mengganti gambar.</small>
            </div>
            <div class="flex items-center gap-4">
                <button type="submit" class="galeri-form-btn">Update</button>
                <a href="{{ route('admin.galeri.index') }}" class="galeri-form-cancel">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection 