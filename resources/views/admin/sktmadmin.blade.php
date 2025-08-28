@extends('layouts.admin')

@section('content')
<style>
    .sktm-table-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 24px 0 rgba(37,99,235,0.08);
        padding: 2rem 1.5rem;
        margin-bottom: 2rem;
    }
    .badge-status {
        font-weight: 600;
        border-radius: 8px;
        padding: 2px 12px;
        font-size: 0.97rem;
        display: inline-block;
    }
    .badge-pending { background: #fff3cd; color: #856404; }
    .badge-approved { background: #d1f5e0; color: #218838; }
    .badge-rejected { background: #f8d7da; color: #c82333; }
    .badge-other { background: #e2e3e5; color: #383d41; }
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
    .btn-detail { background: #2563eb; color: #fff; border: none; }
    .btn-detail:hover { background: #1d4ed8; color: #fff; }
    .btn-approve { background: #22c55e; color: #fff; border: none; }
    .btn-approve:hover { background: #16a34a; color: #fff; }
    .btn-reject { background: #ef4444; color: #fff; border: none; }
    .btn-reject:hover { background: #b91c1c; color: #fff; }
    .aksi-btn-group {
        display: flex;
        flex-direction: row;
        gap: 6px;
        align-items: center;
        justify-content: flex-start;
    }
    @media (max-width: 768px) {
        .sktm-table-card { padding: 1rem 0.5rem; }
        .aksi-btn-group { flex-direction: column; gap: 4px; }
    }
</style>
<div class="container mx-auto py-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Daftar Pengajuan SKTM</h2>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary">
            <i class="bi bi-arrow-left-circle"></i> Kembali ke Dashboard
        </a>
    </div>
    <div class="sktm-table-card">
        <div class="table-responsive">
            <table class="min-w-full table-auto align-middle">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2">No</th>
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">NIK</th>
                        <th class="px-4 py-2">KTP</th>
                        <th class="px-4 py-2">KK</th>
                        <th class="px-4 py-2">Surat Keterangan RT</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $item)
                    <tr class="border-b align-middle hover:bg-blue-50 transition">
                        <td class="px-4 py-3 font-semibold text-gray-700">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">{{ $item->nama }}</td>
                        <td class="px-4 py-3">{{ $item->nik }}</td>
                        <td class="px-4 py-3">
                            @if($item->file_ktp)
                                <a href="{{ asset('storage/' . $item->file_ktp) }}" target="_blank">Lihat KTP</a>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            @if($item->file_kk)
                                <a href="{{ asset('storage/' . $item->file_kk) }}" target="_blank">Lihat KK</a>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            @if($item->file_surat_rt)
                                <a href="{{ asset('storage/' . $item->file_surat_rt) }}" target="_blank">Lihat Surat RT</a>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            @if($item->status == 'pending')
                                <span class="badge-status badge-pending">Menunggu</span>
                            @elseif($item->status == 'approved')
                                <span class="badge-status badge-approved">Disetujui</span>
                            @elseif($item->status == 'rejected')
                                <span class="badge-status badge-rejected">Ditolak</span>
                            @else
                                <span class="badge-status badge-other">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="aksi-btn-group">
                                <a href="{{ route('admin.sktm.show', $item->id) }}" class="btn-action btn-detail" title="Detail">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                                @if($item->status == 'pending')
                                <form action="{{ route('admin.sktm.approve', $item->id) }}" method="POST" enctype="multipart/form-data" style="display:inline;">
                                    @csrf
                                    <input type="file" name="pdf_file" accept="application/pdf" required style="display:inline;width:120px;">
                                    <button type="submit" class="btn-action btn-approve" title="Setujui">
                                        <i class="bi bi-check-circle"></i> Setujui
                                    </button>
                                </form>
                                <form action="{{ route('admin.sktm.reject', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="text" name="alasan_tolak" placeholder="Alasan tolak" required style="width:120px;display:inline;">
                                    <button type="submit" class="btn-action btn-reject" title="Tolak">
                                        <i class="bi bi-x-circle"></i> Tolak
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4 text-gray-500">Belum ada pengajuan SKTM.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .table thead th {
        font-weight: 700;
        font-size: 1.07rem;
        background: #f4f7fb;
        color: #22336b;
        border-bottom: 2px solid #e3e6ed;
    }
    .table tbody td {
        vertical-align: middle;
        font-size: 1.01rem;
    }
    .badge.bg-warning.text-dark { background: #fff3cd !important; color: #856404 !important; font-weight: 600; }
    .badge.bg-success { background: #d1f5e0 !important; color: #218838 !important; font-weight: 600; }
    .badge.bg-danger { background: #f8d7da !important; color: #c82333 !important; font-weight: 600; }
    .badge.bg-secondary { background: #e2e3e5 !important; color: #383d41 !important; font-weight: 600; }
    .btn-group .btn { margin-right: 4px; }
    .btn-group .btn:last-child { margin-right: 0; }
    .card { box-shadow: 0 4px 24px rgba(37,99,235,0.08); border-radius: 16px; }
    .card-header { background: #f8fafc; border-radius: 16px 16px 0 0; border-bottom: 1.5px solid #e3e6ed; }
    .card-body { border-radius: 0 0 16px 16px; }
    .table-responsive { border-radius: 12px; }
    @media (max-width: 768px) {
        .table-responsive { font-size: 0.97rem; }
        .card-header h4 { font-size: 1.1rem; }
    }
</style>
@endpush
