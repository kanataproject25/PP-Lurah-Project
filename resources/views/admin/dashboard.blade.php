@extends('layouts.admin')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #e0e7ff 0%, #f0fdfa 100%);
    }
    .dashboard-header {
        background: linear-gradient(90deg, #2563eb 0%, #06b6d4 100%);
        color: #fff;
        border-radius: 12px;
        padding: 24px 32px 16px 32px;
        margin-bottom: 32px;
        box-shadow: 0 4px 24px 0 rgba(37,99,235,0.08);
    }
    .dashboard-header h4 {
        font-size: 2.2rem;
        font-weight: bold;
        letter-spacing: 1px;
    }
    .dashboard-card {
        border-radius: 16px;
        box-shadow: 0 4px 24px 0 rgba(0,0,0,0.08);
        transition: transform 0.2s, box-shadow 0.2s;
        position: relative;
        overflow: hidden;
    }
    .dashboard-card:hover {
        transform: scale(1.035);
        box-shadow: 0 8px 32px 0 rgba(0,0,0,0.14);
        z-index: 2;
    }
    .dashboard-card .icon {
        font-size: 2.5rem;
        margin-bottom: 8px;
        display: inline-block;
    }
    .dashboard-card.bg-primary .icon { color: #fff; }
    .dashboard-card.bg-info .icon { color: #0ea5e9; }
    .dashboard-card.bg-success .icon { color: #22c55e; }
    .dashboard-card.bg-warning .icon { color: #f59e42; }
    .dashboard-card.bg-secondary .icon { color: #64748b; }
    .dashboard-badge {
        position: absolute;
        top: 18px;
        right: 24px;
        background: #fff;
        color: #2563eb;
        font-weight: bold;
        border-radius: 50px;
        padding: 4px 14px;
        font-size: 1rem;
        box-shadow: 0 2px 8px 0 rgba(37,99,235,0.08);
    }
    .dashboard-card .btn {
        transition: background 0.2s, color 0.2s, box-shadow 0.2s;
    }
    .dashboard-card .btn:hover {
        background: #2563eb;
        color: #fff;
        box-shadow: 0 2px 8px 0 rgba(37,99,235,0.12);
    }
    @media (max-width: 768px) {
        .dashboard-header { 
            padding: 12px 8px 8px 8px; 
            font-size: 1.1rem; 
            flex-direction: column;
            gap: 10px;
            align-items: flex-start;
        }
        .dashboard-card { 
            margin-bottom: 15px; 
            border-radius: 12px;
        }
        .dashboard-card .card-body {
            padding: 1rem;
        }
        .dashboard-card .icon {
            font-size: 2rem;
        }
        .dashboard-card h5 {
            font-size: 1.1rem;
        }
        .dashboard-card p {
            font-size: 0.9rem;
        }
        .dashboard-badge {
            top: 12px;
            right: 16px;
            font-size: 0.85rem;
            padding: 3px 10px;
        }
    }
    
    @media (max-width: 576px) {
        .dashboard-header { 
            padding: 10px 6px 6px 6px; 
            font-size: 1rem; 
        }
        .dashboard-card { 
            margin-bottom: 12px; 
            border-radius: 10px;
        }
        .dashboard-card .card-body {
            padding: 0.8rem;
        }
        .dashboard-card .icon {
            font-size: 1.8rem;
        }
        .dashboard-card h5 {
            font-size: 1rem;
        }
        .dashboard-card p {
            font-size: 0.85rem;
        }
        .dashboard-badge {
            top: 10px;
            right: 12px;
            font-size: 0.8rem;
            padding: 2px 8px;
        }
        .row {
            margin-left: -5px;
            margin-right: -5px;
        }
        .col-md-6, .col-lg-4 {
            padding-left: 5px;
            padding-right: 5px;
        }
    }
    
    @media (max-width: 480px) {
        .dashboard-header { 
            padding: 8px 4px 4px 4px; 
            font-size: 0.95rem; 
        }
        .dashboard-card { 
            margin-bottom: 10px; 
            border-radius: 8px;
        }
        .dashboard-card .card-body {
            padding: 0.6rem;
        }
        .dashboard-card .icon {
            font-size: 1.6rem;
        }
        .dashboard-card h5 {
            font-size: 0.95rem;
        }
        .dashboard-card p {
            font-size: 0.8rem;
        }
        .dashboard-badge {
            top: 8px;
            right: 10px;
            font-size: 0.75rem;
            padding: 1px 6px;
        }
        .row {
            margin-left: -3px;
            margin-right: -3px;
        }
        .col-md-6, .col-lg-4 {
            padding-left: 3px;
            padding-right: 3px;
        }
    }
    
    @media (max-width: 360px) {
        .dashboard-header { 
            padding: 6px 3px 3px 3px; 
            font-size: 0.9rem; 
        }
        .dashboard-card { 
            margin-bottom: 8px; 
            border-radius: 6px;
        }
        .dashboard-card .card-body {
            padding: 0.5rem;
        }
        .dashboard-card .icon {
            font-size: 1.4rem;
        }
        .dashboard-card h5 {
            font-size: 0.9rem;
        }
        .dashboard-card p {
            font-size: 0.75rem;
        }
        .dashboard-badge {
            top: 6px;
            right: 8px;
            font-size: 0.7rem;
            padding: 1px 5px;
        }
        .row {
            margin-left: -2px;
            margin-right: -2px;
        }
        .col-md-6, .col-lg-4 {
            padding-left: 2px;
            padding-right: 2px;
        }
    }
    .statistik-flex {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: flex-start;
        gap: 40px;
    }
    .statistik-item {
        flex: 1 1 350px;
        min-width: 280px;
        max-width: 480px;
        background: #f8fafc;
        border-radius: 12px;
        box-shadow: 0 2px 8px 0 rgba(37,99,235,0.04);
        padding: 24px 18px 18px 18px;
        margin-bottom: 0;
    }
    @media (max-width: 900px) {
        .statistik-flex { flex-direction: column; gap: 28px; }
        .statistik-item { max-width: 100%; }
    }
    /* Tambahan style khusus untuk Pengajuan Semua Surat */
    .pengajuan-card {
        border-radius: 18px;
        box-shadow: 0 4px 24px 0 rgba(37,99,235,0.10);
        border: none;
        margin-bottom: 2.5rem;
        overflow: hidden;
    }
    .pengajuan-card-header {
        background: linear-gradient(90deg,#2563eb 0%,#06b6d4 100%);
        color: #fff;
        border-radius: 18px 18px 0 0;
        padding: 1.3rem 2rem 1rem 2rem;
        font-size: 1.35rem;
        font-weight: 700;
        letter-spacing: 1px;
        display: flex;
        align-items: center;
        gap: 12px;
        box-shadow: 0 2px 12px 0 rgba(37,99,235,0.08);
    }
    .pengajuan-card-body {
        padding: 2rem 2rem 1.5rem 2rem;
        background: #fff;
    }
    .pengajuan-table th, .pengajuan-table td {
        vertical-align: middle !important;
        font-size: 1.04rem;
    }
    .pengajuan-table thead th {
        background: #f1f5f9;
        color: #2563eb;
        font-weight: 700;
        border-bottom: 2px solid #e0e7ef;
    }
    .pengajuan-table tbody tr {
        transition: background 0.18s;
    }
    .pengajuan-table tbody tr:hover {
        background: #e0f2fe;
    }
    .pengajuan-badge-status {
        font-weight: 600;
        border-radius: 8px;
        padding: 2px 12px;
        font-size: 0.97rem;
        display: inline-block;
    }
    .pengajuan-badge-pending { background: #fff3cd; color: #856404; }
    .pengajuan-badge-approved { background: #d1f5e0; color: #218838; }
    .pengajuan-badge-rejected { background: #f8d7da; color: #c82333; }
    .pengajuan-badge-other { background: #e2e3e5; color: #383d41; }
    .pengajuan-btn-action {
        padding: 4px 14px;
        border-radius: 5px;
        font-weight: 500;
        font-size: 0.98rem;
        margin-right: 0;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        min-width: 0;
        transition: background 0.18s, color 0.18s, box-shadow 0.18s;
    }
    .pengajuan-btn-action.btn-outline-primary:hover { background: #2563eb; color: #fff; }
    .pengajuan-btn-action.btn-outline-danger:hover { background: #ef4444; color: #fff; }
    .pengajuan-btn-action.btn-outline-info:hover { background: #0ea5e9; color: #fff; }
    .pengajuan-btn-action .bi { font-size: 1.1em; }
    .pagination-container {
        background: white;
        border-radius: 12px;
        padding: 1rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        border: 1px solid #e5e7eb;
    }
    @media (max-width: 900px) {
        .pengajuan-card-body { padding: 1rem 0.5rem; }
        .pengajuan-card-header { padding: 1rem 1rem 0.7rem 1rem; font-size: 1.1rem; }
    }
    
    @media (max-width: 768px) {
        .pengajuan-card-body { padding: 0.8rem 0.3rem; }
        .pengajuan-card-header { padding: 0.8rem 0.8rem 0.5rem 0.8rem; font-size: 1rem; }
        .pengajuan-table th, .pengajuan-table td {
            font-size: 0.9rem;
            padding: 0.5rem 0.3rem;
        }
        .pengajuan-btn-action {
            padding: 3px 10px;
            font-size: 0.85rem;
        }
        .statistik-flex {
            gap: 20px;
        }
        .statistik-item {
            padding: 18px 14px 14px 14px;
        }
    }
    
    @media (max-width: 576px) {
        .pengajuan-card-body { padding: 0.6rem 0.2rem; }
        .pengajuan-card-header { padding: 0.6rem 0.6rem 0.4rem 0.6rem; font-size: 0.95rem; }
        .pengajuan-table th, .pengajuan-table td {
            font-size: 0.8rem;
            padding: 0.4rem 0.2rem;
        }
        .pengajuan-btn-action {
            padding: 2px 8px;
            font-size: 0.8rem;
        }
        .statistik-flex {
            gap: 15px;
        }
        .statistik-item {
            padding: 15px 12px 12px 12px;
        }
    }
    
    @media (max-width: 480px) {
        .pengajuan-card-body { padding: 0.5rem 0.1rem; }
        .pengajuan-card-header { padding: 0.5rem 0.5rem 0.3rem 0.5rem; font-size: 0.9rem; }
        .pengajuan-table th, .pengajuan-table td {
            font-size: 0.75rem;
            padding: 0.3rem 0.1rem;
        }
        .pengajuan-btn-action {
            padding: 1px 6px;
            font-size: 0.75rem;
        }
        .statistik-flex {
            gap: 12px;
        }
        .statistik-item {
            padding: 12px 10px 10px 10px;
        }
    }
    
    /* Responsive untuk notifikasi */
    @media (max-width: 768px) {
        #notifBell {
            font-size: 1.5rem !important;
        }
        #notifDropdown {
            min-width: 280px !important;
            max-width: 320px !important;
        }
        .notif-item {
            padding: 0.5rem !important;
        }
        .notif-nama {
            font-size: 0.9rem !important;
        }
        .notif-tanggal {
            font-size: 0.8rem !important;
        }
    }
    
    @media (max-width: 576px) {
        #notifBell {
            font-size: 1.3rem !important;
        }
        #notifDropdown {
            min-width: 250px !important;
            max-width: 280px !important;
        }
        .notif-item {
            padding: 0.4rem !important;
        }
        .notif-nama {
            font-size: 0.85rem !important;
        }
        .notif-tanggal {
            font-size: 0.75rem !important;
        }
    }
    
    @media (max-width: 480px) {
        #notifBell {
            font-size: 1.2rem !important;
        }
        #notifDropdown {
            min-width: 220px !important;
            max-width: 250px !important;
        }
        .notif-item {
            padding: 0.3rem !important;
        }
        .notif-nama {
            font-size: 0.8rem !important;
        }
        .notif-tanggal {
            font-size: 0.7rem !important;
        }
    }
</style>
@php
    $countPending = 
        \App\Models\Sktm::where('status', 'pending')->count() +
        \App\Models\Sdu::where('status', 'pending')->count() +
        \App\Models\Sd::where('status', 'pending')->count() +
        \App\Models\Sk::where('status', 'pending')->count() +
        \App\Models\Skbm::where('status', 'pending')->count();
@endphp
@php
    $pendingList = collect();
    $pendingList = $pendingList->concat(
        \App\Models\Sktm::where('status', 'pending')->orderBy('created_at', 'desc')->get()->map(function($item) {
            $item->jenis = 'SKTM';
            $item->route = route('admin.sktm.show', $item->id);
            return $item;
        })
    );
    $pendingList = $pendingList->concat(
        \App\Models\Sdu::where('status', 'pending')->orderBy('created_at', 'desc')->get()->map(function($item) {
            $item->jenis = 'SDU';
            $item->route = route('admin.sdu.show', $item->id);
            return $item;
        })
    );
    $pendingList = $pendingList->concat(
        \App\Models\Sd::where('status', 'pending')->orderBy('created_at', 'desc')->get()->map(function($item) {
            $item->jenis = 'SD';
            $item->route = route('admin.sd.show', $item->id);
            return $item;
        })
    );
    $pendingList = $pendingList->concat(
        \App\Models\Sk::where('status', 'pending')->orderBy('created_at', 'desc')->get()->map(function($item) {
            $item->jenis = 'SK';
            $item->route = route('admin.sk.show', $item->id);
            return $item;
        })
    );
    $pendingList = $pendingList->concat(
        \App\Models\Skbm::where('status', 'pending')->orderBy('created_at', 'desc')->get()->map(function($item) {
            $item->jenis = 'SKBM';
            $item->route = route('admin.skbm.show', $item->id);
            return $item;
        })
    );
    $pendingList = $pendingList->sortByDesc('created_at');
@endphp
<div class="dashboard-header d-flex justify-content-between align-items-center">
    <h4 class="mb-0 d-flex align-items-center">
        <i class="bi bi-speedometer2 me-2"></i>Dashboard Admin
    </h4>
    <div class="position-relative me-2">
        <i class="bi bi-bell" id="notifBell" style="font-size:2rem;cursor:pointer;"></i>
        @if($countPending > 0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size:0.85rem;">
                {{ $countPending }}
            </span>
        @endif
        <div id="notifDropdown" class="dropdown-menu dropdown-menu-end shadow notif-dropdown-custom" style="min-width:320px;max-width:400px;display:none;position:absolute;right:0;top:2.5rem;z-index:1000;">
            <div class="notif-header">Notifikasi Surat Pending</div>
            @forelse($pendingList as $item)
                <a href="{{ $item->route }}" class="notif-item d-flex align-items-center">
                    <span class="notif-badge badge bg-gradient-primary">{{ $item->jenis }}</span>
                    <div class="notif-info ms-2">
                        <div class="notif-nama fw-bold">{{ $item->nama ?? ($item->user->name ?? '-') }}</div>
                        <div class="notif-tanggal text-muted small">{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</div>
                    </div>
                </a>
            @empty
                <div class="notif-empty">Tidak ada surat baru.</div>
            @endforelse
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card dashboard-card bg-primary text-white mb-3">
            <span class="dashboard-badge">{{ $countSktm }}</span>
            <div class="card-body">
                <span class="icon"><i class="bi bi-file-text"></i></span>
                <h5 class="card-title">Kelola SKTM</h5>
                <p class="card-text">Lihat dan kelola pengajuan Surat Keterangan Tidak Mampu</p>
                <a href="{{ route('admin.sktm.index') }}" class="btn btn-light">Kelola SKTM</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card dashboard-card bg-info text-white mb-3">
            <span class="dashboard-badge">{{ $countSdu }}</span>
            <div class="card-body">
                <span class="icon"><i class="bi bi-briefcase"></i></span>
                <h5 class="card-title">Kelola SDU</h5>
                <p class="card-text">Lihat dan kelola pengajuan Surat Domisili Usaha</p>
                <a href="{{ route('admin.sdu.index') }}" class="btn btn-light">Kelola SDU</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card dashboard-card bg-success text-white mb-3">
            <span class="dashboard-badge">{{ $countSd }}</span>
            <div class="card-body">
                <span class="icon"><i class="bi bi-house"></i></span>
                <h5 class="card-title">Kelola SD</h5>
                <p class="card-text">Lihat dan kelola pengajuan Surat Domisili</p>
                <a href="{{ route('admin.sd.index') }}" class="btn btn-light">Kelola SD</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card dashboard-card bg-warning text-white mb-3">
            <span class="dashboard-badge">{{ $countSk }}</span>
            <div class="card-body">
                <span class="icon"><i class="bi bi-person-x"></i></span>
                <h5 class="card-title">Kelola SK</h5>
                <p class="card-text">Lihat dan kelola pengajuan Surat Kematian</p>
                <a href="{{ route('admin.sk.index') }}" class="btn btn-light">Kelola SK</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card dashboard-card" style="background: #6c63ff; color: #fff;">
            <span class="dashboard-badge">{{ $countSkbm }}</span>
            <div class="card-body">
                <span class="icon"><i class="bi bi-person-badge" style="color:#fff; font-size:2.5rem;"></i></span>
                <h5 class="card-title">Kelola SKBM</h5>
                <p class="card-text">Lihat dan kelola pengajuan Surat Belum Pernah Menikah</p>
                <a href="{{ route('admin.skbm.index') }}" class="btn btn-light">Kelola SKBM</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card dashboard-card bg-danger text-white mb-3">
            <div class="card-body">
                <span class="icon"><i class="bi bi-newspaper"></i></span>
                <h5 class="card-title">Kelola Berita</h5>
                <p class="card-text">Lihat dan kelola berita Kelurahan</p>
                <a href="{{ url('/admin/berita') }}" class="btn btn-light">Kelola Berita</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card dashboard-card bg-dark text-white mb-3">
            <div class="card-body">
                <span class="icon"><i class="bi bi-image"></i></span>
                <h5 class="card-title">Kelola Galeri</h5>
                <p class="card-text">Lihat dan kelola galeri foto kegiatan Kelurahan</p>
                <a href="{{ url('/admin/galeri') }}" class="btn btn-light">Kelola Galeri</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card dashboard-card" style="background: #ff6b35; color: #fff;">
            <span class="dashboard-badge">{{ $countPrestasi }}</span>
            <div class="card-body">
                <span class="icon"><i class="bi bi-trophy" style="color:#fff; font-size:2.5rem;"></i></span>
                <h5 class="card-title">Kelola Prestasi</h5>
                <p class="card-text">Lihat dan kelola prestasi & penghargaan Kelurahan</p>
                <a href="{{ route('admin.prestasi.index') }}" class="btn btn-light">Kelola Prestasi</a>
            </div>
        </div>
    </div>
</div>
<div class="card shadow-sm p-4 mb-4" style="border-radius:16px;background:#f4f8ff;">
  <form method="GET" action="" class="d-flex flex-wrap align-items-end gap-3 mb-4">
    <div class="d-flex flex-column" style="min-width:150px;">
      <label for="tahun" class="form-label mb-1" style="font-weight:600;">Tahun:</label>
      <select name="tahun" id="tahun" class="form-select" style="border-radius:8px;">
        <option value="">Semua Tahun</option>
        @for($y = 2020; $y <= date('Y')+2; $y++)
          <option value="{{ $y }}" {{ request('tahun', date('Y')) == $y ? 'selected' : '' }}>{{ $y }}</option>
        @endfor
      </select>
    </div>
    <div class="d-flex flex-column" style="min-width:140px;">
      <label for="bulan" class="form-label mb-1" style="font-weight:600;">Bulan:</label>
      <select name="bulan" id="bulan" class="form-select" style="border-radius:8px;">
        <option value="">Semua Bulan</option>
        @foreach(['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $i => $bln)
          <option value="{{ $i+1 }}" {{ request('bulan') == $i+1 ? 'selected' : '' }}>{{ $bln }}</option>
        @endforeach
      </select>
    </div>
    <div class="d-flex flex-column justify-content-end" style="min-width:90px;">
      <button type="submit" class="btn btn-primary mt-2" style="border-radius:8px;padding:8px 20px;font-weight:600;">Filter</button>
    </div>
  </form>
  <div class="statistik-flex" style="display:flex;gap:24px;flex-wrap:wrap;width:100%;justify-content:center;align-items:stretch;">
    <div class="statistik-item" style="flex:1 1 300px;min-width:260px;max-width:400px;">
      <h5 class="mb-3 font-bold text-left" style="font-size:1.2rem; color:#22336b;">Statistik Pengajuan Surat (Bar)</h5>
      <div style="position:relative;width:100%;height:320px;text-align:left;">
        <canvas id="chartSurat" style="display:block;margin-left:0;"></canvas>
      </div>
    </div>
    <div class="statistik-item" style="flex:1 1 300px;min-width:260px;max-width:400px;">
      <h5 class="mb-3 font-bold text-left" style="font-size:1.2rem; color:#22336b;">Statistik Pengajuan Surat (Line)</h5>
      <div style="position:relative;width:100%;height:320px;text-align:left;">
        <canvas id="lineSurat" style="display:block;margin-left:0;"></canvas>
      </div>
    </div>
    <div class="statistik-item" style="flex:1 1 300px;min-width:260px;max-width:400px;">
      <h5 class="mb-3 font-bold text-left" style="font-size:1.2rem; color:#22336b;">Statistik Pengajuan Surat (Doughnut)</h5>
      <div style="position:relative;width:100%;height:320px;text-align:left;">
        <canvas id="doughnutSurat" style="display:block;margin-left:0;"></canvas>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('chartSurat').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['SKTM', 'SDU', 'SD', 'SK', 'SKBM'],
            datasets: [{
                label: 'Jumlah Pengajuan',
                data: [{{ $countSktm }}, {{ $countSdu }}, {{ $countSd }}, {{ $countSk }}, {{ $countSkbm }}],
                backgroundColor: [
                    '#2563eb', '#0ea5e9', '#22c55e', '#f59e42', '#6c63ff'
                ],
                borderRadius: 8,
                barPercentage: 0.6,
                categoryPercentage: 0.6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                title: { display: false }
            },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 } }
            }
        }
    });

    // Line Chart (mengganti Pie Chart)
    const lineCtx = document.getElementById('lineSurat').getContext('2d');
    new Chart(lineCtx, {
        type: 'line',
        data: {
            labels: ['SKTM', 'SDU', 'SD', 'SK', 'SKBM'],
            datasets: [{
                label: 'Jumlah Pengajuan',
                data: [{{ $countSktm }}, {{ $countSdu }}, {{ $countSd }}, {{ $countSk }}, {{ $countSkbm }}],
                fill: false,
                borderColor: '#2563eb',
                backgroundColor: '#2563eb',
                tension: 0.3,
                pointBackgroundColor: [
                    '#2563eb', '#0ea5e9', '#22c55e', '#f59e42', '#6c63ff'
                ],
                pointRadius: 6,
                pointHoverRadius: 8,
                borderWidth: 3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'top' },
                title: { display: false }
            },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 } }
            }
        }
    });

    // Doughnut Chart
    const doughnutCtx = document.getElementById('doughnutSurat').getContext('2d');
    new Chart(doughnutCtx, {
        type: 'doughnut',
        data: {
            labels: ['SKTM', 'SDU', 'SD', 'SK', 'SKBM'],
            datasets: [{
                label: 'Jumlah Pengajuan',
                data: [{{ $countSktm }}, {{ $countSdu }}, {{ $countSd }}, {{ $countSk }}, {{ $countSkbm }}],
                backgroundColor: [
                    '#2563eb', '#0ea5e9', '#22c55e', '#f59e42', '#6c63ff'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom' },
                title: { display: false }
            }
        }
    });
</script>
                    
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card pengajuan-card">
                                <div class="pengajuan-card-header">
                                    <i class="bi bi-clock-history" style="font-size:2rem;"></i>
                                    Pengajuan Semua Surat
                                </div>
                                <div class="pengajuan-card-body">
                                    <!-- Tombol Download Laporan -->
                                    <div class="mb-3 d-flex align-items-center gap-2 flex-wrap">
                                        <a href="{{ route('admin.laporan.export', [
                                            'jenis_surat' => request('jenis_surat'),
                                            'nama' => request('nama'),
                                            'nik' => request('nik'),
                                            'tanggal' => request('tanggal')
                                        ]) }}" class="btn btn-success d-inline-flex align-items-center" style="gap:8px; font-weight:600;">
                                            <i class="bi bi-download"></i> Download Laporan Excel
                                        </a>
                                        <button type="button" class="btn btn-primary d-inline-flex align-items-center" data-bs-toggle="modal" data-bs-target="#modalUploadArsipLama" style="gap:8px; font-weight:600;">
                                            <i class="bi bi-upload"></i> Upload Arsip Lama
                                        </button>
                                    </div>
                                    <!-- Modal Upload Arsip Lama -->
                                    @include('admin.dashboard-upload-arsip-modal')
                                    <!-- FILTER & SEARCH BAR -->
                                    <form method="GET" action="{{ route('admin.dashboard') }}" class="row mb-3 g-2 align-items-end" id="filterForm">
                                        <div class="col-md-3">
                                            <label class="form-label mb-1">Jenis Surat</label>
                                            <select name="jenis_surat" class="form-select" onchange="this.form.submit()">
                                                <option value="">Semua</option>
                                                <option value="SKTM" {{ request('jenis_surat') == 'SKTM' ? 'selected' : '' }}>SKTM</option>
                                                <option value="SDU" {{ request('jenis_surat') == 'SDU' ? 'selected' : '' }}>SDU</option>
                                                <option value="SD" {{ request('jenis_surat') == 'SD' ? 'selected' : '' }}>SD</option>
                                                <option value="SK" {{ request('jenis_surat') == 'SK' ? 'selected' : '' }}>SK</option>
                                                <option value="SKBM" {{ request('jenis_surat') == 'SKBM' ? 'selected' : '' }}>SKBM</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label mb-1">Nama</label>
                                            <input type="text" id="filterNama" name="nama" class="form-control" placeholder="Cari nama..." value="{{ request('nama') }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label mb-1">NIK</label>
                                            <input type="text" id="filterNik" name="nik" class="form-control" placeholder="Cari NIK..." value="{{ request('nik') }}">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label mb-1">Tanggal Pengajuan</label>
                                            <input type="date" id="filterTanggal" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
                                        </div>
                                        <div class="col-md-1 d-flex align-items-end gap-1">
                                            <button type="submit" class="btn btn-primary w-100">Cari</button>
                                            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary w-100">Reset</a>
                                        </div>
                                    </form>
                                    <!-- END FILTER & SEARCH BAR -->
                                    @php
                                        $allSurat = collect();
                                        $allSurat = $allSurat->concat(\App\Models\Sktm::select('id', 'nama', 'nik', 'created_at')->addSelect(\DB::raw("'SKTM' as jenis"))->get());
                                        $allSurat = $allSurat->concat(\App\Models\Sdu::select('id', 'nama', \DB::raw('NULL as nik'), 'created_at')->addSelect(\DB::raw("'SDU' as jenis"))->get());
                                        $allSurat = $allSurat->concat(\App\Models\Sd::select('id', 'nama', \DB::raw('NULL as nik'), 'created_at')->addSelect(\DB::raw("'SD' as jenis"))->get());
                                        $allSurat = $allSurat->concat(\App\Models\Sk::select('id', 'nama', 'nik', 'created_at')->addSelect(\DB::raw("'SK' as jenis"))->get());
                                        $allSurat = $allSurat->concat(\App\Models\Skbm::select('id', 'nama', 'nik', 'created_at')->addSelect(\DB::raw("'SKBM' as jenis"))->get());
                                        $allSurat = $allSurat->sortByDesc('created_at');
                                        if(request('jenis_surat')) {
                                            $allSurat = $allSurat->where('jenis', request('jenis_surat'));
                                        }
                                    @endphp

                                    @if($paginated->count() > 0)
                                        <div class="table-responsive" style="overflow-x:auto;" id="tabelSuratContainer">
                                            <table class="table pengajuan-table table-striped align-middle" id="tabelSurat">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Jenis Surat</th>
                                                        <th>Nama</th>
                                                        <th>NIK</th>
                                                        <th>Tanggal Pengajuan</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($paginated as $i => $surat)
                                                    <tr>
                                                        <td>{{ ($paginated->currentPage() - 1) * $paginated->perPage() + $loop->iteration }}</td>
                                                        <td>{{ $surat->jenis }}</td>
                                                        <td>{{ $surat->nama }}</td>
                                                        <td>{{ $surat->nik }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($surat->created_at)->format('d/m/Y') }}</td>
                                                        <td>
                                                            @if(isset($surat->arsip_lama) && $surat->arsip_lama)
                                                                <a href="{{ route('admin.arsip-lama.download', $surat->id) }}" class="pengajuan-btn-action btn btn-sm btn-outline-success" target="_blank">
                                                                    <i class="bi bi-download"></i> Download PDF
                                                                </a>
                                                                <form action="{{ route('admin.arsip-lama.delete', $surat->id) }}" method="POST" class="d-inline form-hapus-arsip-lama">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="pengajuan-btn-action btn btn-sm btn-outline-danger btn-hapus-arsip-lama" data-id="{{ $surat->id }}" title="Hapus">
                                                                        <i class="bi bi-trash"></i> Hapus
                                                                    </button>
                                                                </form>
                                                            @else
                                                                @php
                                                                    $route = '#';
                                                                    if ($surat->jenis === 'SKTM') {
                                                                        $route = route('admin.sktm.show', $surat->id);
                                                                    } elseif ($surat->jenis === 'SDU') {
                                                                        $route = route('admin.sdu.show', $surat->id);
                                                                    } elseif ($surat->jenis === 'SD') {
                                                                        $route = route('admin.sd.show', $surat->id);
                                                                    } elseif ($surat->jenis === 'SK') {
                                                                        $route = route('admin.sk.show', $surat->id);
                                                                    } elseif ($surat->jenis === 'SKBM') {
                                                                        $route = route('admin.skbm.show', $surat->id);
                                                                    }
                                                                @endphp
                                                                <a href="{{ $route }}" class="pengajuan-btn-action btn btn-sm btn-outline-primary" title="Lihat Detail">
                                                                    <i class="bi bi-eye"></i> Lihat
                                                                </a>
                                                                @php
                                                                    $downloadRoute = null;
                                                                    if ($surat->jenis === 'SKTM' && isset($surat->pdf_path) && $surat->pdf_path) {
                                                                        $downloadRoute = route('admin.sktm.download', $surat->id);
                                                                    } elseif ($surat->jenis === 'SDU' && isset($surat->pdf_path) && $surat->pdf_path) {
                                                                        $downloadRoute = route('admin.sdu.download', $surat->id);
                                                                    } elseif ($surat->jenis === 'SD' && isset($surat->pdf_path) && $surat->pdf_path) {
                                                                        $downloadRoute = route('admin.sd.download', $surat->id);
                                                                    } elseif ($surat->jenis === 'SK' && isset($surat->pdf_path) && $surat->pdf_path) {
                                                                        $downloadRoute = route('admin.sk.download', $surat->id);
                                                                    } elseif ($surat->jenis === 'SKBM' && isset($surat->pdf_path) && $surat->pdf_path) {
                                                                        $downloadRoute = route('admin.skbm.download', $surat->id);
                                                                    }
                                                                @endphp
                                                                @if($downloadRoute)
                                                                <a href="{{ $downloadRoute }}" class="btn btn-outline-success btn-sm d-inline-flex align-items-center justify-content-center" style="border-radius:6px; padding:4px 10px; margin-left:4px;" title="Download PDF" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Download PDF">
                                                                    <i class="bi bi-file-earmark-arrow-down" style="font-size:1.1rem;"></i>
                                                                </a>
                                                                @endif
                                                                <form action="{{ route('admin.surat.delete', ['jenis' => $surat->jenis, 'id' => $surat->id]) }}" method="POST" class="d-inline form-hapus-surat">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="pengajuan-btn-action btn btn-sm btn-outline-danger btn-hapus-surat" data-id="{{ $surat->id }}" data-jenis="{{ $surat->jenis }}" title="Hapus">
                                                                        <i class="bi bi-trash"></i> Hapus
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="mt-3 pagination-container">
                                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                                                <div>
                                                    {{ $paginated->links() }}
                                                </div>
                                                <form method="GET" action="" class="d-flex align-items-center gap-2">
                                                    @if(request('jenis_surat'))
                                                        <input type="hidden" name="jenis_surat" value="{{ request('jenis_surat') }}">
                                                    @endif
                                                    @if(request('nama'))
                                                        <input type="hidden" name="nama" value="{{ request('nama') }}">
                                                    @endif
                                                    @if(request('nik'))
                                                        <input type="hidden" name="nik" value="{{ request('nik') }}">
                                                    @endif
                                                    @if(request('tanggal'))
                                                        <input type="hidden" name="tanggal" value="{{ request('tanggal') }}">
                                                    @endif
                                                    <label for="perPage" class="form-label mb-0 text-muted small">Tampil:</label>
                                                    <input type="number" min="1" max="1000" name="perPage" id="perPage" value="{{ request('perPage', 10) }}" class="form-control form-control-sm" style="width: 70px;" onchange="this.form.submit()" />
                                                    <span class="text-muted small">/ halaman</span>
                                                </form>
                                            </div>
                                        </div>
                                    @else
                                        <div class="text-center py-4">
                                            <i class="bi bi-inbox display-1 text-muted"></i>
                                            <p class="text-muted mt-3">Belum ada pengajuan surat</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

    // Modal konfirmasi hapus
    let formToDelete = null;
    document.querySelectorAll('.form-hapus-surat, .form-hapus-arsip-lama').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            if (!form.classList.contains('confirmed')) {
                e.preventDefault();
                formToDelete = form;
                var modal = new bootstrap.Modal(document.getElementById('modalKonfirmasiHapus'));
                modal.show();
            } else {
                form.classList.remove('confirmed');
            }
        });
    });
    document.getElementById('btnKonfirmasiHapus').addEventListener('click', function() {
        if(formToDelete) {
            formToDelete.classList.add('confirmed');
            formToDelete.submit();
        }
        var modal = bootstrap.Modal.getInstance(document.getElementById('modalKonfirmasiHapus'));
        modal.hide();
    });
});
</script>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="modalKonfirmasiHapus" tabindex="-1" aria-labelledby="modalKonfirmasiHapusLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="modalKonfirmasiHapusLabel"><i class="bi bi-exclamation-triangle me-2"></i>Konfirmasi Hapus</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <p class="mb-0" style="font-size:1.1rem;">Apakah Anda yakin ingin menghapus data ini?<br><span class="text-danger">Tindakan ini tidak dapat dibatalkan.</span></p>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-danger" id="btnKonfirmasiHapus">Ya, Hapus</button>
      </div>
    </div>
  </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const bell = document.getElementById('notifBell');
        const dropdown = document.getElementById('notifDropdown');
        if (bell && dropdown) {
            bell.addEventListener('click', function(e) {
                e.stopPropagation();
                dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
            });
            document.addEventListener('click', function(e) {
                if (!dropdown.contains(e.target)) {
                    dropdown.style.display = 'none';
                }
            });
        }
    });
</script>
<style>
.notif-dropdown-custom {
    border-radius: 12px;
    padding: 0;
    background: #f8fafc;
    max-height: 350px;
    overflow-y: auto;
}
.notif-header {
    font-weight: bold;
    padding: 12px 18px;
    border-bottom: 1px solid #e5e7eb;
    background: #e0e7ff;
    border-radius: 12px 12px 0 0;
}
.notif-item {
    padding: 12px 18px;
    border-bottom: 1px solid #f1f5f9;
    transition: background 0.2s;
    text-decoration: none;
    color: #22336b;
}
.notif-item:last-child { border-bottom: none; }
.notif-item:hover { background: #e0e7ff; }
.notif-badge {
    font-size: 0.8em;
    padding: 4px 10px;
    border-radius: 8px;
    background: linear-gradient(90deg, #2563eb 0%, #06b6d4 100%);
    color: #fff;
}
.notif-nama { font-weight: 600; }
.notif-tanggal { font-size: 0.92em; }
.notif-empty {
    padding: 16px 18px;
    color: #888;
    text-align: center;
}
</style>
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterForm = document.getElementById('filterForm');
    const tabelSuratContainer = document.getElementById('tabelSuratContainer');
    if(filterForm && tabelSuratContainer) {
        filterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(filterForm);
            const params = new URLSearchParams(formData).toString();
            fetch(filterForm.action + '?' + params, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(res => res.text())
            .then(html => {
                // Ambil tabel dari response HTML
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newTable = doc.getElementById('tabelSuratContainer');
                if(newTable) {
                    tabelSuratContainer.innerHTML = newTable.innerHTML;
                }
            });
        });
    }
});
</script>
@endsection