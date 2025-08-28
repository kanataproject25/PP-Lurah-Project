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
    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 15px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 8px 32px rgba(102, 126, 234, 0.2);
    }
    .page-title {
        color: white;
        font-size: 2rem;
        font-weight: 700;
        margin: 0;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .filter-section {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 16px rgba(0,0,0,0.05);
        border: 1px solid #e5e7eb;
    }
    .filter-form {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        align-items: center;
    }
    .form-input, .form-select {
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background: white;
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.5rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
        padding-right: 2.5rem;
    }
    .form-select {
        cursor: pointer;
        min-width: 180px;
    }
    .form-select:hover {
        border-color: #667eea;
        box-shadow: 0 2px 8px rgba(102, 126, 234, 0.15);
    }
    .form-select option {
        padding: 0.5rem;
        background: white;
        color: #374151;
        border: none;
    }
    .form-select option:hover {
        background: #f3f4f6;
    }
    .form-select option:checked {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    .form-input:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        outline: none;
    }
    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 8px;
        padding: 0.75rem 1.5rem;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    }
    .btn-reset {
        background: #f3f4f6;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        padding: 0.75rem 1.5rem;
        color: #6b7280;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-reset:hover {
        background: #e5e7eb;
        color: #374151;
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
        gap: 10px;
        align-items: center;
        justify-content: flex-start;
        flex-wrap: wrap;
    }
    .aksi-form-inline {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 8px;
    }
    .aksi-form-inline input[type="file"],
    .aksi-form-inline input[type="text"] {
        font-size: 0.95rem;
        padding: 2px 8px;
        border-radius: 5px;
        height: 32px;
    }
    .aksi-form-inline input[type="file"] {
        width: 120px;
    }
    .aksi-form-inline input[type="text"] {
        width: 120px;
    }
    .pagination-container {
        background: white;
        border-radius: 12px;
        padding: 1rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        border: 1px solid #e5e7eb;
    }
    @media (max-width: 768px) {
        .sktm-table-card { padding: 1rem 0.5rem; }
        .aksi-btn-group { flex-direction: column; gap: 8px; align-items: flex-start; }
        .aksi-form-inline { flex-direction: column; align-items: flex-start; gap: 6px; }
        .filter-form { flex-direction: column; align-items: stretch; }
        .page-header { padding: 1.5rem; }
        .page-title { font-size: 1.5rem; }
    }
</style>

<div class="container mx-auto py-8">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="bi bi-file-earmark-text me-3"></i>
            Daftar Surat SKTM
        </h1>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
        <form method="GET" action="" class="filter-form">
            <input type="text" name="search" placeholder="Cari Nama/NIK" value="{{ request('search') }}" class="form-input flex-1 min-w-0" />
            <select name="status" class="form-select">
                <option value="">-- Semua Status --</option>
                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                <option value="sort_desc" {{ request('status') == 'sort_desc' ? 'selected' : '' }}>Terbaru</option>
                <option value="sort_asc" {{ request('status') == 'sort_asc' ? 'selected' : '' }}>Terlama</option>
            </select>
            <button type="submit" class="btn-primary">Filter</button>
            @if(request('search') || request('status') || request('perPage') || request('sort'))
                <a href="{{ route(\Route::currentRouteName()) }}" class="btn-reset">Reset</a>
            @endif
        </form>
    </div>

    <!-- Table Card -->
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
                    @forelse($daftarSurat as $i => $sktm)
                    <tr class="border-b align-middle hover:bg-blue-50 transition">
                        <td class="px-4 py-3 font-semibold text-gray-700">{{ $daftarSurat->firstItem() + $i }}</td>
                        <td class="px-4 py-3">{{ $sktm->nama }}</td>
                        <td class="px-4 py-3">{{ $sktm->nik }}</td>
                        <td class="px-4 py-3">
                            @if($sktm->file_ktp)
                                <a href="{{ asset('storage/' . $sktm->file_ktp) }}" target="_blank" class="btn btn-sm btn-outline-primary d-inline-flex align-items-center" style="gap:6px;">
                                    <i class="bi bi-file-earmark-text"></i> KTP
                                </a>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            @if($sktm->file_kk)
                                <a href="{{ asset('storage/' . $sktm->file_kk) }}" target="_blank" class="btn btn-sm btn-outline-success d-inline-flex align-items-center" style="gap:6px;">
                                    <i class="bi bi-file-earmark-text"></i> KK
                                </a>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            @if($sktm->file_surat_rt)
                                <a href="{{ asset('storage/' . $sktm->file_surat_rt) }}" target="_blank" class="btn btn-sm btn-outline-warning d-inline-flex align-items-center" style="gap:6px;">
                                    <i class="bi bi-file-earmark-text"></i> Surat RT
                                </a>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            @if($sktm->status == 'pending')
                                <span class="badge-status badge-pending">Menunggu</span>
                            @elseif($sktm->status == 'approved')
                                <span class="badge-status badge-approved">Disetujui</span>
                            @elseif($sktm->status == 'rejected')
                                <span class="badge-status badge-rejected">Ditolak</span>
                            @else
                                <span class="badge-status badge-other">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="aksi-btn-group">
                                <a href="{{ route('admin.sktm.show', $sktm->id) }}" class="btn-action btn-detail" title="Detail">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                                @if($sktm->status === 'approved' && $sktm->pdf_path)
                                <a href="{{ route('admin.sktm.download', $sktm->id) }}" class="btn btn-outline-success btn-sm d-inline-flex align-items-center justify-content-center" style="border-radius:6px; padding:4px 10px; margin-left:4px;" title="Download PDF" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Download PDF SKTM">
                                    <i class="bi bi-file-earmark-arrow-down" style="font-size:1.1rem;"></i> PDF
                                </a>
                                @endif
                                @if($sktm->status === 'pending')
                                <button type="button" class="btn-action btn-approve" title="Setujui" data-bs-toggle="modal" data-bs-target="#approveModal{{ $sktm->id }}">
                                    <i class="bi bi-check-circle"></i> Setujui
                                </button>
                                <button type="button" class="btn-action btn-reject" title="Tolak" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $sktm->id }}">
                                    <i class="bi bi-x-circle"></i> Tolak
                                </button>
                                <!-- Modal Approve -->
                                <div class="modal fade" id="approveModal{{ $sktm->id }}" tabindex="-1" aria-labelledby="approveModalLabel{{ $sktm->id }}" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="approveModalLabel{{ $sktm->id }}">Upload PDF Surat SKTM</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <form action="{{ route('admin.sktm.approve', $sktm->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                          <input type="file" name="pdf_file" accept="application/pdf" required class="form-control mb-3">
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                          <button type="submit" class="btn btn-success">Setujui & Upload</button>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                                <!-- Modal Reject -->
                                <div class="modal fade" id="rejectModal{{ $sktm->id }}" tabindex="-1" aria-labelledby="rejectModalLabel{{ $sktm->id }}" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="rejectModalLabel{{ $sktm->id }}">Alasan Penolakan SKTM</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <form action="{{ route('admin.sktm.reject', $sktm->id) }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                          <select name="alasan_tolak" id="alasanTolakSelect{{ $sktm->id }}" class="form-select mb-3" required onchange="document.getElementById('alasanTolakLain{{ $sktm->id }}').style.display = this.value === 'Lainnya' ? 'block' : 'none';">
                                            <option value="">-- Pilih Alasan Penolakan --</option>
                                            <option value="Data Tidak Jelas">Data Tidak Jelas</option>
                                            <option value="Data Tidak Sesuai">Data Tidak Sesuai</option>
                                            <option value="Dokumen Tidak Lengkap">Dokumen Tidak Lengkap</option>
                                            <option value="Persyaratan Tidak Memenuhi">Persyaratan Tidak Memenuhi</option>
                                            <option value="Lainnya">Lainnya</option>
                                          </select>
                                          <input type="text" name="alasan_tolak_lain" id="alasanTolakLain{{ $sktm->id }}" class="form-control mb-3" placeholder="Tulis alasan lain..." style="display:none;">
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                          <button type="submit" class="btn btn-danger">Tolak</button>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
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

    <!-- Pagination Section -->
    <div class="pagination-container">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">
            <div>
                {{ $daftarSurat->links() }}
            </div>
            <form method="GET" action="" class="flex items-center gap-1 ml-2">
                @if(request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                @endif
                @if(request('status'))
                    <input type="hidden" name="status" value="{{ request('status') }}">
                @endif
                @if(request('sort'))
                    <input type="hidden" name="sort" value="{{ request('sort') }}">
                @endif
                <label for="perPage" class="mr-1 text-xs text-gray-600">Tampil:</label>
                <input type="number" min="1" max="1000" name="perPage" id="perPage" value="{{ request('perPage', 10) }}" class="text-sm h-8 w-16 px-2 py-1 border rounded bg-white shadow-sm focus:ring focus:border-blue-400" onchange="this.form.submit()" />
                <span class="text-xs text-gray-500 ml-1">/ halaman</span>
            </form>
        </div>
    </div>
</div>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.forEach(function (tooltipTriggerEl) {
        new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>
