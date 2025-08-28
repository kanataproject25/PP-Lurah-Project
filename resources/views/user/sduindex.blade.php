@extends('layouts.app')

@section('content')
<style>
    .sdu-table-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 24px 0 rgba(37,99,235,0.08);
        padding: 2rem 1.5rem;
        margin-bottom: 2rem;
    }
    .sdu-table th {
        background: #f1f5f9;
        font-weight: 700;
        color: #22223b;
        border-top: none;
        font-size: 1.05rem;
    }
    .sdu-table td {
        vertical-align: middle;
        font-size: 1.01rem;
    }
    .sdu-table tr:hover {
        background: #f0f6ff;
        transition: background 0.2s;
    }
    .badge-status {
        font-weight: 600;
        border-radius: 8px;
        padding: 4px 14px;
        font-size: 0.97rem;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 8px 0 rgba(37,99,235,0.08);
    }
    .badge-status.pending { background: #fff3cd; color: #b58105; border: 1px solid #ffe69c; }
    .badge-status.approved { background: #d1fae5; color: #059669; border: 1px solid #6ee7b7; }
    .badge-status.rejected { background: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; }
    .badge-status.other { background: #e5e7eb; color: #374151; border: 1px solid #cbd5e1; }
    .btn-detail-sdu {
        background: linear-gradient(90deg,#2563eb 0%,#06b6d4 100%);
        color: #fff;
        font-weight: 600;
        border-radius: 8px;
        padding: 6px 18px;
        font-size: 0.97rem;
        box-shadow: 0 2px 8px 0 rgba(37,99,235,0.08);
        border: none;
        transition: background 0.18s, color 0.18s;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .btn-detail-sdu:hover {
        background: #2563eb;
        color: #fff;
    }
    .btn-home-gradient {
        background: linear-gradient(90deg,#2563eb 0%,#06b6d4 100%);
        color: #fff;
        font-weight: 600;
        border-radius: 8px;
        padding: 8px 28px;
        font-size: 1.05rem;
        box-shadow: 0 2px 8px 0 rgba(37,99,235,0.08);
        border: none;
        transition: background 0.18s, color 0.18s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 1.2rem;
    }
    .btn-home-gradient:hover {
        background: #2563eb;
        color: #fff;
    }
    @media (max-width: 700px) {
        .sdu-table-card { padding: 1rem 0.3rem; }
        .sdu-table th, .sdu-table td { font-size: 0.93rem; }
    }
</style>
<div class="container">
    <h2 class="mb-4" style="font-weight:800;letter-spacing:0.5px; margin-top: 32px;"><i class="bi bi-file-earmark-text me-2 text-primary"></i> Tabel Surat Domisili Usaha</h2>
    <a href="/" class="btn-home-gradient"><i class="bi bi-house-door"></i> Home</a>
    @if(isset($sdu) && count($sdu) > 0)
    <div class="sdu-table-card">
        <div class="table-responsive">
            <table class="table sdu-table align-middle mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Kewarganegaraan</th>
                        <th>Pekerjaan</th>
                        <th>Alamat</th>
                        <th>Status</th>
                        <th>Alasan Ditolak</th>
                        <th>File PDF</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sdu as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->jenis_kelamin }}</td>
                        <td>{{ $item->kewarganegaraan }}</td>
                        <td>{{ $item->pekerjaan }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>
                            @if($item->status == 'pending' || !$item->status)
                                <span class="badge-status pending">Menunggu</span>
                            @elseif($item->status == 'approved')
                                <span class="badge-status approved">Disetujui</span>
                            @elseif($item->status == 'rejected')
                                <span class="badge-status rejected">Ditolak</span>
                            @else
                                <span class="badge-status other">-</span>
                            @endif
                        </td>
                        <td>
                            @if($item->status == 'rejected')
                                {{ $item->alasan_tolak }}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if($item->status == 'approved' && $item->pdf_path)
                                <a href="{{ route('user.sdu.download', $item->id) }}" target="_blank" class="text-primary fw-bold" style="display:inline-flex;align-items:center;gap:6px;">
                                    <i class="bi bi-file-earmark-pdf"></i><span>Download</span>
                                </a>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('sdu.show', $item->id) }}" class="btn-detail-sdu"><i class="bi bi-eye"></i> Detail</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @else
    <div class="alert alert-info text-center py-5" style="border-radius:16px;font-size:1.1rem;">
        <i class="bi bi-inbox text-primary" style="font-size:2.2rem;"></i><br>Data surat tidak ditemukan.
    </div>
    @endif
    {{ $sdu->links() }}
</div>
@endsection 