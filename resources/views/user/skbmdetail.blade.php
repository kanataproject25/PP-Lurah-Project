@extends('layouts.app')

@section('content')
<style>
    .skbm-detail-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 24px 0 rgba(37,99,235,0.08);
        padding: 2.2rem 1.5rem 1.5rem 1.5rem;
        margin-bottom: 2rem;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }
    .skbm-detail-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 0.5rem;
    }
    .skbm-detail-table th {
        width: 38%;
        background: #f1f5f9;
        font-weight: 700;
        color: #22223b;
        padding: 10px 12px;
        border: none;
        font-size: 1.04rem;
        text-align: left;
    }
    .skbm-detail-table td {
        background: #fff;
        color: #374151;
        padding: 10px 12px;
        border: none;
        font-size: 1.04rem;
    }
    .skbm-detail-table tr {
        border-bottom: 1.5px solid #e5e7eb;
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
    .btn-back-skbm {
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
        margin-top: 1.2rem;
    }
    .btn-back-skbm:hover {
        background: #2563eb;
        color: #fff;
    }
    @media (max-width: 700px) {
        .skbm-detail-card { padding: 1.1rem 0.5rem; }
        .skbm-detail-table th, .skbm-detail-table td { font-size: 0.97rem; padding: 8px 6px; }
    }
</style>
<div class="container">
    <div class="skbm-detail-card">
        <h2 class="mb-4" style="font-weight:800;letter-spacing:0.5px;"><i class="bi bi-file-earmark-text me-2 text-primary"></i> Detail Surat Keterangan Belum Menikah (SKBM)</h2>
        <table class="skbm-detail-table">
            <tr><th>Nama</th><td>{{ $skbm->nama }}</td></tr>
            <tr><th>NIK</th><td>{{ $skbm->nik }}</td></tr>
            <tr><th>Tempat, Tanggal Lahir</th><td>{{ $skbm->tempat_lahir }}, {{ $skbm->tanggal_lahir }}</td></tr>
            <tr><th>Jenis Kelamin</th><td>{{ $skbm->jenis_kelamin }}</td></tr>
            <tr><th>Agama</th><td>{{ $skbm->agama }}</td></tr>
            <tr><th>Alamat</th><td>{{ $skbm->alamat }}</td></tr>
            <tr><th>Status Pernikahan</th><td>{{ $skbm->status_pernikahan }}</td></tr>
            <tr><th>Surat Pernyataan</th><td>@if($skbm->file_pernyataan)<a href="{{ asset('storage/' . $skbm->file_pernyataan) }}" target="_blank" class="text-primary fw-bold"><i class="bi bi-file-earmark-pdf"></i> Download</a>@else - @endif</td></tr>
            <tr><th>Surat Cerai</th><td>@if($skbm->file_surat_cerai)<a href="{{ asset('storage/' . $skbm->file_surat_cerai) }}" target="_blank" class="text-primary fw-bold"><i class="bi bi-file-earmark-pdf"></i> Download</a>@else - @endif</td></tr>
            <tr><th>Surat Kematian</th><td>@if($skbm->file_surat_kematian)<a href="{{ asset('storage/' . $skbm->file_surat_kematian) }}" target="_blank" class="text-primary fw-bold"><i class="bi bi-file-earmark-pdf"></i> Download</a>@else - @endif</td></tr>
            <tr><th>Pas Foto 3x6</th><td>@if($skbm->foto_syarat_skbm)<a href="{{ asset('storage/' . $skbm->foto_syarat_skbm) }}" target="_blank" class="text-primary fw-bold"><i class="bi bi-image"></i> Lihat</a>@else - @endif</td></tr>
            <tr><th>Status</th><td>
                @if($skbm->status == 'pending' || !$skbm->status)
                    <span class="badge-status pending">Menunggu</span>
                @elseif($skbm->status == 'approved')
                    <span class="badge-status approved">Disetujui</span>
                @elseif($skbm->status == 'rejected')
                    <span class="badge-status rejected">Ditolak</span>
                @else
                    <span class="badge-status other">-</span>
                @endif
            </td></tr>
            <tr><th>Alasan Ditolak</th><td>@if($skbm->status == 'rejected'){{ $skbm->alasan_tolak }}@else - @endif</td></tr>
            <tr><th>File PDF</th><td>@if($skbm->pdf_path)<a href="{{ asset('storage/' . $skbm->pdf_path) }}" target="_blank" class="text-primary fw-bold"><i class="bi bi-file-earmark-pdf"></i> Download PDF</a>@else - @endif</td></tr>
        </table>
        <a href="{{ route('skbm.index') }}" class="btn-back-skbm"><i class="bi bi-arrow-left"></i> Kembali</a>
    </div>
</div>
@endsection 