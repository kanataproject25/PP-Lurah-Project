@extends('layouts.admin')

@section('content')
<style>
    .detail-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 24px 0 rgba(37,99,235,0.08);
        padding: 2.2rem 2rem 1.5rem 2rem;
        margin: 2rem auto 0 auto;
        max-width: 650px;
    }
    .detail-table th {
        width: 200px;
        background: #f4f7fb;
        color: #22336b;
        font-weight: 600;
        padding: 10px 14px;
        border-radius: 8px 0 0 8px;
        border-bottom: 1px solid #e3e6ed;
        vertical-align: top;
    }
    .detail-table td {
        background: #f9fafb;
        color: #334155;
        padding: 10px 14px;
        border-radius: 0 8px 8px 0;
        border-bottom: 1px solid #e3e6ed;
        vertical-align: top;
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
    .aksi-btn-group {
        display: flex;
        flex-direction: row;
        gap: 12px;
        align-items: center;
        margin-top: 2rem;
        flex-wrap: wrap;
    }
    .btn-action {
        padding: 7px 18px;
        border-radius: 7px;
        font-weight: 500;
        font-size: 1.01rem;
        display: flex;
        align-items: center;
        gap: 7px;
        border: none;
    }
    .btn-detail { background: #2563eb; color: #fff; }
    .btn-detail:hover { background: #1d4ed8; color: #fff; }
    .btn-approve { background: #22c55e; color: #fff; }
    .btn-approve:hover { background: #16a34a; color: #fff; }
    .btn-reject { background: #ef4444; color: #fff; }
    .btn-reject:hover { background: #b91c1c; color: #fff; }
    .btn-back { background: #f3f4f6; color: #334155; border-radius: 7px; font-weight: 500; }
    .btn-back:hover { background: #e0e7ef; color: #2563eb; }
    @media (max-width: 600px) {
        .detail-card { padding: 1.1rem 0.5rem; }
        .detail-table th, .detail-table td { padding: 8px 6px; font-size: 0.97rem; }
        .aksi-btn-group { flex-direction: column; gap: 8px; }
    }
</style>
<div class="detail-card">
    <h2 class="text-2xl font-bold mb-4">Detail Surat Domisili (SD)</h2>
    <table class="detail-table w-100 mb-3">
        <tr><th>Nama</th><td>{{ $sd->nama }}</td></tr>
        <tr><th>Tempat Lahir</th><td>{{ $sd->tempat_lahir }}</td></tr>
        <tr><th>Tanggal Lahir</th><td>{{ $sd->tanggal_lahir }}</td></tr>
        <tr><th>Jenis Kelamin</th><td>{{ $sd->jenis_kelamin }}</td></tr>
        <tr><th>Kewarganegaraan</th><td>{{ $sd->kewarganegaraan }}</td></tr>
        <tr><th>Pekerjaan</th><td>{{ $sd->pekerjaan }}</td></tr>
        <tr><th>Alamat</th><td>{{ $sd->alamat }}</td></tr>
        <tr><th>Keperluan</th><td>{{ $sd->keperluan }}</td></tr>
        <tr><th>KTP</th><td>@if($sd->ktp)<a href="{{ asset('storage/' . $sd->ktp) }}" target="_blank" class="btn-action btn-detail" style="background:#f3f4f6;color:#22336b;"><i class="bi bi-card-text"></i> Lihat KTP</a>@else<span class="text-gray-400">-</span>@endif</td></tr>
        <tr><th>KK</th><td>@if($sd->kk)<a href="{{ asset('storage/' . $sd->kk) }}" target="_blank" class="btn-action btn-detail" style="background:#f3f4f6;color:#22336b;"><i class="bi bi-card-text"></i> Lihat KK</a>@else<span class="text-gray-400">-</span>@endif</td></tr>
        <tr><th>Surat Keterangan RT</th><td>@if($sd->surat_keterangan_rt)<a href="{{ asset('storage/' . $sd->surat_keterangan_rt) }}" target="_blank" class="btn-action btn-detail" style="background:#f3f4f6;color:#22336b;"><i class="bi bi-card-text"></i> Lihat Surat RT</a>@else<span class="text-gray-400">-</span>@endif</td></tr>
        <tr><th>PBB</th><td>@if($sd->pbb)<a href="{{ asset('storage/' . $sd->pbb) }}" target="_blank" class="btn-action btn-detail" style="background:#f3f4f6;color:#22336b;"><i class="bi bi-card-text"></i> Lihat PBB</a>@else<span class="text-gray-400">-</span>@endif</td></tr>
        <tr>
            <th>Status</th>
            <td>
                @if($sd->status == 'approved')
                    <span class="badge-status badge-approved">Disetujui</span>
                @elseif($sd->status == 'rejected')
                    <span class="badge-status badge-rejected">Ditolak</span>
                @else
                    <span class="badge-status badge-pending">Diproses</span>
                @endif
            </td>
        </tr>
        @if(isset($sd->alasan_tolak) && $sd->status === 'rejected')
        <tr><th>Alasan Ditolak</th><td>{{ $sd->alasan_tolak }}</td></tr>
        @endif
    </table>
    @if(empty($sd->status) || $sd->status === 'Diproses')
    <div class="aksi-btn-group">
        <button type="button" class="btn-action btn-approve" data-bs-toggle="modal" data-bs-target="#approveModal">
            <i class="bi bi-check-circle"></i> Setujui
        </button>
        <button type="button" class="btn-action btn-reject" data-bs-toggle="modal" data-bs-target="#rejectModal">
            <i class="bi bi-x-circle"></i> Tolak
        </button>
    </div>
    <!-- Modal Approve -->
    <div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="approveModalLabel">Upload PDF Surat SD</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="{{ route('admin.sd.approve', $sd->id) }}" method="POST" enctype="multipart/form-data">
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
    <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="rejectModalLabel">Alasan Penolakan SD</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="{{ route('admin.sd.reject', $sd->id) }}" method="POST">
            @csrf
            <div class="modal-body">
              <input type="text" name="alasan_tolak" placeholder="Alasan tolak" required class="form-control mb-3">
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
    <a href="{{ route('admin.sd.index') }}" class="btn btn-back mt-4"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>
@endsection 