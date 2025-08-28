@extends('layouts.app')

@section('content')
<style>
    .form-container {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 24px 0 rgba(37,99,235,0.08);
        padding: 2rem 1.5rem;
        margin-bottom: 2rem;
    }
    .form-header {
        text-align: center;
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 2px solid #f1f5f9;
    }
    .form-header h3 {
        font-weight: 800;
        color: #22223b;
        margin-bottom: 0.5rem;
        letter-spacing: 0.5px;
    }
    .form-header p {
        color: #64748b;
        font-size: 1.05rem;
        margin-bottom: 0;
    }
    .input-group.form-row {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
        padding: 1rem;
        background: #f8fafc;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        transition: all 0.2s ease;
    }
    .input-group.form-row:hover {
        background: #f1f5f9;
        border-color: #cbd5e1;
    }
    .input-group.form-row label {
        min-width: 180px;
        margin-bottom: 0;
        font-weight: 600;
        color: #374151;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1.02rem;
    }
    .input-group.form-row label i {
        color: #2563eb;
        font-size: 1.1rem;
    }
    .input-group.form-row .form-control,
    .input-group.form-row select,
    .input-group.form-row textarea {
        flex: 1 1 0%;
        margin-bottom: 0;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        transition: all 0.2s ease;
    }
    .input-group.form-row .form-control:focus,
    .input-group.form-row select:focus,
    .input-group.form-row textarea:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
        outline: none;
    }
    .btn-back {
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
        margin-bottom: 1.5rem;
        text-decoration: none;
    }
    .btn-back:hover {
        background: #2563eb;
        color: #fff;
        text-decoration: none;
    }
    .btn-submit {
        background: linear-gradient(90deg,#10b981 0%,#059669 100%);
        color: #fff;
        font-weight: 700;
        border-radius: 12px;
        padding: 1rem 2rem;
        font-size: 1.1rem;
        box-shadow: 0 4px 16px 0 rgba(16,185,129,0.2);
        border: none;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        width: 100%;
        margin-top: 2rem;
    }
    .btn-submit:hover {
        background: #059669;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px 0 rgba(16,185,129,0.3);
    }
    .alert {
        border-radius: 12px;
        border: none;
        padding: 1rem 1.5rem;
        margin-bottom: 1.5rem;
        font-weight: 500;
    }
    .alert-danger {
        background: #fef2f2;
        color: #dc2626;
        border-left: 4px solid #dc2626;
    }
    @media (max-width: 768px) {
        .form-container { padding: 1.5rem 1rem; }
        .input-group.form-row {
            flex-direction: column;
            align-items: stretch;
            gap: 0.5rem;
        }
        .input-group.form-row label {
            min-width: 0;
            margin-bottom: 0.5rem;
        }
        .form-header h3 { font-size: 1.5rem; }
        .form-header p { font-size: 1rem; }
    }
</style>

<div class="container">
    <div class="form-container">
        <div class="form-header">
            <h3><i class="bi bi-file-earmark-text me-2 text-primary"></i>Formulir Pengajuan Surat Keterangan Tidak Mampu (SKTM)</h3>
            <p>Silakan isi data diri Anda dengan benar untuk mengajukan SKTM secara online.</p>
        </div>
        
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        
        <a href="{{ route('home') }}" class="btn-back">
            <i class="bi bi-arrow-left-circle"></i> Kembali ke Dashboard
        </a>
        
        <form method="POST" action="{{ route('sktm.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="input-group form-row">
                <label for="nama"><i class="bi bi-person"></i> Nama Lengkap</label>
                <input type="text" id="nama" name="nama" class="form-control" required placeholder="Masukkan nama lengkap Anda">
            </div>
            <div class="input-group form-row">
                <label for="nik"><i class="bi bi-credit-card-2-front"></i> NIK</label>
                <input type="text" id="nik" name="nik" class="form-control" required placeholder="Nomor Induk Kependudukan">
            </div>
            <div class="input-group form-row">
                <label for="tempat_lahir"><i class="bi bi-geo-alt"></i> Tempat Lahir</label>
                <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" required placeholder="Tempat lahir">
            </div>
            <div class="input-group form-row">
                <label for="tanggal_lahir"><i class="bi bi-calendar-date"></i> Tanggal Lahir</label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" required>
            </div>
            <div class="input-group form-row">
                <label for="jenis_kelamin"><i class="bi bi-gender-ambiguous"></i> Jenis Kelamin</label>
                <select id="jenis_kelamin" name="jenis_kelamin" class="form-control">
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="input-group form-row">
                <label for="agama"><i class="bi bi-heart"></i> Agama</label>
                <select id="agama" name="agama" class="form-control" required>
                    <option value="">Pilih Agama</option>
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Buddha">Buddha</option>
                    <option value="Konghucu">Konghucu</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>
            <div class="input-group form-row">
                <label for="pekerjaan"><i class="bi bi-briefcase"></i> Pekerjaan</label>
                <input type="text" id="pekerjaan" name="pekerjaan" class="form-control" required placeholder="Pekerjaan Anda">
            </div>
            <div class="input-group form-row">
                <label for="alamat"><i class="bi bi-house"></i> Alamat</label>
                <textarea id="alamat" name="alamat" class="form-control" required placeholder="Alamat lengkap" rows="3"></textarea>
            </div>
            <div class="input-group form-row">
                <label for="keperluan"><i class="bi bi-info-circle"></i> Keperluan</label>
                <input type="text" id="keperluan" name="keperluan" class="form-control" required placeholder="Keperluan pengajuan SKTM">
            </div>
            <div class="input-group form-row">
                <label for="file_ktp"><i class="bi bi-file-earmark-person"></i> Upload KTP (PDF/JPG/PNG)</label>
                <input type="file" id="file_ktp" name="file_ktp" class="form-control" accept=".pdf,.jpg,.jpeg,.png" required>
            </div>
            <div class="input-group form-row">
                <label for="file_kk"><i class="bi bi-file-earmark-text"></i> Upload KK (PDF/JPG/PNG)</label>
                <input type="file" id="file_kk" name="file_kk" class="form-control" accept=".pdf,.jpg,.jpeg,.png" required>
            </div>
            <div class="input-group form-row">
                <label for="file_surat_rt"><i class="bi bi-file-earmark-ruled"></i> Upload Surat Keterangan RT (PDF/JPG/PNG)</label>
                <input type="file" id="file_surat_rt" name="file_surat_rt" class="form-control" accept=".pdf,.jpg,.jpeg,.png" required>
            </div>
            <button type="submit" class="btn-submit">
                <i class="bi bi-send"></i> Kirim Pengajuan
            </button>
        </form>
    </div>
</div>
@endsection 