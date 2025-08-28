@extends('layouts.app')

@section('content')
<style>
    .sdu-detail-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 24px 0 rgba(37,99,235,0.08);
        padding: 2.2rem 1.5rem 1.5rem 1.5rem;
        margin-bottom: 2rem;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }
    .sdu-detail-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 0.5rem;
    }
    .sdu-detail-table th {
        width: 38%;
        background: #f1f5f9;
        font-weight: 700;
        color: #22223b;
        padding: 10px 12px;
        border: none;
        font-size: 1.04rem;
        text-align: left;
    }
    .sdu-detail-table td {
        background: #fff;
        color: #374151;
        padding: 10px 12px;
        border: none;
        font-size: 1.04rem;
    }
    .sdu-detail-table tr {
        border-bottom: 1.5px solid #e5e7eb;
    }
    .btn-back-sdu {
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
    .btn-back-sdu:hover {
        background: #2563eb;
        color: #fff;
    }
    @media (max-width: 700px) {
        .sdu-detail-card { padding: 1.1rem 0.5rem; }
        .sdu-detail-table th, .sdu-detail-table td { font-size: 0.97rem; padding: 8px 6px; }
    }
</style>
<div class="container">
    <div class="sdu-detail-card">
        <h2 class="mb-4" style="font-weight:800;letter-spacing:0.5px;"><i class="bi bi-file-earmark-text me-2 text-primary"></i> Detail Surat Domisili Usaha</h2>
        <table class="sdu-detail-table">
            <tr><th>Nama</th><td>{{ $sdu->nama }}</td></tr>
            <tr><th>Tempat Lahir</th><td>{{ $sdu->tempat_lahir }}</td></tr>
            <tr><th>Tanggal Lahir</th><td>{{ $sdu->tanggal_lahir }}</td></tr>
            <tr><th>Jenis Kelamin</th><td>{{ $sdu->jenis_kelamin }}</td></tr>
            <tr><th>Kewarganegaraan</th><td>{{ $sdu->kewarganegaraan }}</td></tr>
            <tr><th>Pekerjaan</th><td>{{ $sdu->pekerjaan }}</td></tr>
            <tr><th>Alamat</th><td>{{ $sdu->alamat }}</td></tr>
            <tr><th>Nama Usaha</th><td>{{ $sdu->nama_usaha }}</td></tr>
            <tr><th>Keperluan</th><td>{{ $sdu->keperluan }}</td></tr>
            <tr><th>KTP</th><td><a href="{{ asset('storage/' . $sdu->ktp) }}" target="_blank" class="text-primary fw-bold"><i class="bi bi-file-earmark-pdf"></i> Lihat File</a></td></tr>
            <tr><th>KK</th><td><a href="{{ asset('storage/' . $sdu->kk) }}" target="_blank" class="text-primary fw-bold"><i class="bi bi-file-earmark-pdf"></i> Lihat File</a></td></tr>
            <tr><th>PBB</th><td><a href="{{ asset('storage/' . $sdu->pbb) }}" target="_blank" class="text-primary fw-bold"><i class="bi bi-file-earmark-pdf"></i> Lihat File</a></td></tr>
            <tr><th>Surat Keterangan RT</th><td><a href="{{ asset('storage/' . $sdu->surat_keterangan_rt) }}" target="_blank" class="text-primary fw-bold"><i class="bi bi-file-earmark-pdf"></i> Lihat File</a></td></tr>
        </table>
        <a href="{{ route('sdu.index') }}" class="btn-back-sdu"><i class="bi bi-arrow-left"></i> Kembali</a>
    </div>
</div>
@endsection 