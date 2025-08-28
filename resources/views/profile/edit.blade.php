@extends('layouts.app')

@section('content')
<style>
    .profile-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 24px 0 rgba(37,99,235,0.08);
        padding: 2.2rem 1.5rem;
        margin-bottom: 2rem;
        border: none;
    }
    .profile-header {
        background: linear-gradient(90deg,#2563eb 0%,#06b6d4 100%);
        color: #fff;
        border-radius: 16px 16px 0 0;
        padding: 1.2rem 2rem 1rem 2rem;
        font-size: 1.5rem;
        font-weight: 700;
        letter-spacing: 1px;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .profile-section-title {
        font-size: 1.13rem;
        font-weight: 600;
        color: #2563eb;
        margin-bottom: 0.7rem;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .profile-btn {
        background: linear-gradient(90deg,#2563eb 0%,#06b6d4 100%);
        color: #fff;
        font-weight: 700;
        border-radius: 2rem;
        padding: 8px 28px;
        font-size: 1.08rem;
        box-shadow: 0 4px 16px 0 rgba(37,99,235,0.13);
        border: none;
        transition: background 0.22s, color 0.18s, box-shadow 0.18s, transform 0.18s;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        letter-spacing: 0.5px;
        position: relative;
        z-index: 2;
    }
    .profile-btn:hover, .profile-btn:focus {
        background: linear-gradient(90deg,#1d4ed8 0%,#06b6d4 100%);
        color: #fff;
        box-shadow: 0 8px 32px 0 rgba(37,99,235,0.18);
        transform: translateY(-2px) scale(1.04);
        text-decoration: none;
    }
    @media (min-width: 900px) {
        .profile-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2.5rem;
        }
    }
</style>
<div class="container mt-4">
    <div class="profile-card">
        <div class="profile-header mb-4">
            <i class="bi bi-person-circle" style="font-size:2.2rem;"></i>
            Profil Pengguna
        </div>
        @if (auth()->user()->hasVerifiedEmail())
            <div class="alert alert-success mb-3">
                <i class="bi bi-patch-check-fill"></i> Akun sudah terverifikasi.
            </div>
        @else
            <div class="alert alert-warning mb-3">
                <i class="bi bi-exclamation-triangle-fill"></i> Alamat email Anda belum diverifikasi.
                <form method="POST" action="{{ route('verification.send') }}" class="d-inline">
    @csrf
    <button type="submit" class="btn btn-link p-0 m-0 align-baseline text-primary" style="text-decoration: underline;">Klik di sini untuk mengirim ulang verifikasi.</button>
</form>
            </div>
        @endif
        <div class="profile-grid">
            <div>
                <div class="profile-section-title"><i class="bi bi-person-lines-fill"></i> Update Informasi Profil</div>
                <div class="mb-4">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
            <div>
                <div class="profile-section-title"><i class="bi bi-key"></i> Ubah Password</div>
                <div class="mb-4">
                    @include('profile.partials.update-password-form')
                </div>
                <div class="profile-section-title"><i class="bi bi-trash"></i> Hapus Akun</div>
                <div>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
