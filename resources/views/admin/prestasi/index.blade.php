@extends('layouts.admin')

@section('content')
<style>
    .prestasi-table-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 24px 0 rgba(37,99,235,0.08);
        padding: 2rem 1.5rem;
        margin-bottom: 2rem;
    }
    .prestasi-img-thumb {
        max-height: 80px;
        max-width: 140px;
        object-fit: cover;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        border: 2px solid #e5e7eb;
    }
    .badge-prestasi {
        background: linear-gradient(90deg,#fd7e14 0%,#ffb347 100%);
        color: #fff;
        font-weight: 600;
        border-radius: 8px;
        padding: 2px 12px;
        font-size: 0.95rem;
        margin-bottom: 4px;
        display: inline-block;
    }
    .btn-action {
        padding: 4px 10px;
        border-radius: 5px;
        font-weight: 500;
        font-size: 0.93rem;
        margin-right: 0;
        display: flex;
        align-items: center;
        gap: 5px;
        min-width: 0;
    }
    .btn-edit { background: #2563eb; color: #fff; border: none; }
    .btn-edit:hover { background: #1d4ed8; color: #fff; }
    .btn-delete { background: #ef4444; color: #fff; border: none; }
    .btn-delete:hover { background: #b91c1c; color: #fff; }
    .btn-tambah-prestasi {
        background: linear-gradient(90deg,#2563eb 0%,#06b6d4 100%);
        color: #fff;
        font-weight: 600;
        font-size: 1.08rem;
        padding: 12px 28px;
        border-radius: 10px;
        box-shadow: 0 2px 12px 0 rgba(37,99,235,0.13);
        display: flex;
        align-items: center;
        gap: 10px;
        transition: background 0.2s, box-shadow 0.2s, transform 0.15s;
        border: none;
        outline: none;
    }
    .btn-tambah-prestasi:hover {
        background: linear-gradient(90deg,#1d4ed8 0%,#0ea5e9 100%);
        color: #fff;
        transform: translateY(-2px) scale(1.04);
        box-shadow: 0 6px 24px 0 rgba(37,99,235,0.18);
    }
    .aksi-btn-group {
        display: flex;
        flex-direction: row;
        gap: 6px;
        align-items: center;
        justify-content: flex-start;
    }
    @media (max-width: 768px) {
        .prestasi-table-card { padding: 1rem 0.5rem; }
        .prestasi-img-thumb { max-width: 80px; }
    }
    @media (max-width: 600px) {
        .aksi-btn-group {
            flex-direction: column;
            gap: 4px;
        }
    }
    .modal-konfirmasi-bg {
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(30,41,59,0.25);
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center;
    }
    .modal-konfirmasi {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 8px 32px 0 rgba(37,99,235,0.18);
        padding: 2rem 2.2rem 1.5rem 2.2rem;
        max-width: 350px;
        text-align: center;
        animation: popin 0.18s cubic-bezier(.4,2,.6,1) both;
    }
    @keyframes popin {
        0% { transform: scale(0.7); opacity: 0; }
        100% { transform: scale(1); opacity: 1; }
    }
    .modal-konfirmasi h4 {
        color: #ef4444;
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 0.7rem;
    }
    .modal-konfirmasi p {
        color: #334155;
        font-size: 1.05rem;
        margin-bottom: 1.3rem;
    }
    .modal-konfirmasi .btn-modal {
        padding: 10px 22px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1.04rem;
        border: none;
        margin: 0 8px;
        transition: background 0.18s, color 0.18s;
        cursor: pointer;
    }
    .btn-modal-ya { background: #ef4444; color: #fff; }
    .btn-modal-ya:hover { background: #b91c1c; }
    .btn-modal-tidak { background: #f3f4f6; color: #334155; }
    .btn-modal-tidak:hover { background: #e0e7ef; color: #2563eb; }
</style>
<div class="container mx-auto py-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Daftar Prestasi & Penghargaan</h2>
        <a href="{{ route('admin.prestasi.create') }}" class="btn-tambah-prestasi">
            <i class="bi bi-plus-circle" style="font-size:1.3em;"></i>
            Tambah Prestasi
        </a>
    </div>
    <div class="prestasi-table-card">
        <div class="table-responsive">
        <table class="min-w-full table-auto align-middle">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2">#</th>
                    <th class="px-4 py-2">Gambar</th>
                    <th class="px-4 py-2">Judul</th>
                    <th class="px-4 py-2">Tahun</th>
                    <th class="px-4 py-2">Kategori</th>
                    <th class="px-4 py-2">Badge</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($prestasi as $item)
                <tr class="border-b align-middle hover:bg-blue-50 transition">
                    <td class="px-4 py-3 font-semibold text-gray-700">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3">
                        @if($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="Gambar" class="prestasi-img-thumb">
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        <div class="font-bold text-lg text-gray-800">{{ $item->judul }}</div>
                    </td>
                    <td class="px-4 py-3 text-gray-600">{{ $item->tahun }}</td>
                    <td class="px-4 py-3">{{ $item->kategori }}</td>
                    <td class="px-4 py-3">
                        <span class="badge-prestasi">{{ $item->badge }}</span>
                    </td>
                    <td class="px-4 py-3">
                        <div class="aksi-btn-group">
                            <a href="{{ route('admin.prestasi.edit', $item->id) }}" class="btn-action btn-edit" title="Edit"><i class="bi bi-pencil-square"></i> Edit</a>
                            <form action="{{ route('admin.prestasi.destroy', $item->id) }}" method="POST" class="form-hapus-prestasi inline" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn-action btn-delete btn-hapus-prestasi" data-id="{{ $item->id }}" title="Hapus"><i class="bi bi-trash"></i> Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4 text-gray-500">Belum ada prestasi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>
</div>
<!-- Modal Konfirmasi Hapus -->
<div id="modalKonfirmasiBg" class="modal-konfirmasi-bg">
    <div class="modal-konfirmasi">
        <h4><i class="bi bi-exclamation-triangle-fill me-2"></i>Konfirmasi Hapus</h4>
        <p>Yakin ingin menghapus prestasi ini?</p>
        <div class="mt-4">
            <button id="btnModalYa" class="btn-modal btn-modal-ya">Ya, Hapus</button>
            <button id="btnModalTidak" class="btn-modal btn-modal-tidak">Batal</button>
        </div>
    </div>
</div>
<script>
    let formToDelete = null;
    document.querySelectorAll('.btn-hapus-prestasi').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            formToDelete = this.closest('form');
            document.getElementById('modalKonfirmasiBg').style.display = 'flex';
        });
    });
    document.getElementById('btnModalTidak').onclick = function() {
        document.getElementById('modalKonfirmasiBg').style.display = 'none';
        formToDelete = null;
    };
    document.getElementById('btnModalYa').onclick = function() {
        if (formToDelete) formToDelete.submit();
        document.getElementById('modalKonfirmasiBg').style.display = 'none';
    };
    document.getElementById('modalKonfirmasiBg').addEventListener('click', function(e) {
        if (e.target === this) {
            this.style.display = 'none';
            formToDelete = null;
        }
    });
</script>
@endsection 