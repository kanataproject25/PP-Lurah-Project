@extends('layouts.app')

@section('content')
<style>
    .sk-detail-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 24px 0 rgba(37,99,235,0.08);
        padding: 2.2rem 1.5rem 1.5rem 1.5rem;
        margin-bottom: 2rem;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }
    .sk-detail-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 0.5rem;
    }
    .sk-detail-table th {
        width: 38%;
        background: #f1f5f9;
        font-weight: 700;
        color: #22223b;
        padding: 10px 12px;
        border: none;
        font-size: 1.04rem;
        text-align: left;
    }
    .sk-detail-table td {
        background: #fff;
        color: #374151;
        padding: 10px 12px;
        border: none;
        font-size: 1.04rem;
    }
    .sk-detail-table tr {
        border-bottom: 1.5px solid #e5e7eb;
    }
    .btn-back-sk {
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
        margin-right: 10px;
    }
    .btn-back-sk:hover {
        background: #2563eb;
        color: #fff;
    }
    .btn-download-sk {
        background: linear-gradient(90deg,#059669 0%,#10b981 100%);
        color: #fff;
        font-weight: 600;
        border-radius: 8px;
        padding: 8px 28px;
        font-size: 1.05rem;
        box-shadow: 0 2px 8px 0 rgba(5,150,105,0.08);
        border: none;
        transition: background 0.18s, color 0.18s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: 1.2rem;
    }
    .btn-download-sk:hover {
        background: #059669;
        color: #fff;
    }
    @media (max-width: 700px) {
        .sk-detail-card { padding: 1.1rem 0.5rem; }
        .sk-detail-table th, .sk-detail-table td { font-size: 0.97rem; padding: 8px 6px; }
    }
</style>
<div class="container">
    <div class="sk-detail-card">
        <h2 class="mb-4" style="font-weight:800;letter-spacing:0.5px;"><i class="bi bi-file-earmark-text me-2 text-primary"></i> Detail Surat Kematian</h2>
        <table class="sk-detail-table">
            <tr><th>Nomor Surat</th><td>{{ $sk->nomor_surat }}</td></tr>
            <tr><th>Nama Almarhum</th><td>{{ $sk->nama }}</td></tr>
            <tr><th>NIK Almarhum</th><td>{{ $sk->nik }}</td></tr>
            <tr><th>Tempat/Tgl. Lahir</th><td>{{ $sk->tempat_lahir }}, {{ $sk->tanggal_lahir }}</td></tr>
            <tr><th>Jenis Kelamin</th><td>{{ $sk->jenis_kelamin }}</td></tr>
            <tr><th>Agama</th><td>{{ $sk->agama }}</td></tr>
            <tr><th>Alamat</th><td>{{ $sk->alamat }}</td></tr>
            <tr><th>Hari Meninggal</th><td>{{ $sk->hari_meninggal }}</td></tr>
            <tr><th>Tanggal Meninggal</th><td>{{ $sk->tanggal_meninggal }}</td></tr>
            <tr><th>Penyebab Kematian</th><td>{{ $sk->penyebab }}</td></tr>
            <tr><th>Tempat Meninggal</th><td>{{ $sk->tempat_meninggal }}</td></tr>
            <tr><th>Nama Pelapor</th><td>{{ $sk->nama_pelapor }}</td></tr>
            <tr><th>NIK Pelapor</th><td>{{ $sk->nik_pelapor }}</td></tr>
            <tr><th>Status Hubungan</th><td>{{ $sk->status_hubungan }}</td></tr>
            <tr><th>No. HP</th><td>{{ $sk->no_hp }}</td></tr>
            <tr><th>Surat Keterangan Pendukung</th><td><a href="{{ asset('storage/' . $sk->surat_keterangan_pendukung) }}" target="_blank" class="text-primary fw-bold"><i class="bi bi-file-earmark-pdf"></i> Lihat File</a></td></tr>
        </table>
        <a href="{{ route('sk.index') }}" class="btn-back-sk"><i class="bi bi-arrow-left"></i> Kembali</a>
        @if($sk->status === 'approved' && $sk->pdf_path)
            <a href="{{ route('user.sk.download', $sk->id) }}" class="btn-download-sk" target="_blank"><i class="bi bi-download"></i> Download PDF</a>
        @endif
    </div>
</div>
@endsection 