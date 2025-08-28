@extends('layouts.app')

@section('content')
<style>
    .verify-email-container {
        max-width: 600px;
        margin: 2rem auto;
        padding: 2rem;
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 24px 0 rgba(37,99,235,0.08);
        text-align: center;
    }
    .verify-email-icon {
        font-size: 4rem;
        color: #2563eb;
        margin-bottom: 1.5rem;
    }
    .verify-email-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #22336b;
        margin-bottom: 1rem;
        letter-spacing: 0.5px;
    }
    .verify-email-description {
        font-size: 1.1rem;
        color: #64748b;
        line-height: 1.6;
        margin-bottom: 2rem;
    }
    .verify-email-alert {
        background: #d1fae5;
        color: #059669;
        padding: 1rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        border: 1px solid #6ee7b7;
        font-weight: 500;
    }
    .verify-email-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
        margin-top: 2rem;
    }
    .btn-verify-primary {
        background: linear-gradient(90deg,#2563eb 0%,#06b6d4 100%);
        color: #fff;
        font-weight: 600;
        border-radius: 12px;
        padding: 12px 24px;
        font-size: 1.05rem;
        box-shadow: 0 4px 18px 0 rgba(37,99,235,0.13);
        border: none;
        transition: all 0.18s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-verify-primary:hover {
        background: #2563eb;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 8px 32px 0 rgba(37,99,235,0.18);
        text-decoration: none;
    }
    .btn-verify-secondary {
        background: #f8fafc;
        color: #64748b;
        font-weight: 600;
        border-radius: 12px;
        padding: 12px 24px;
        font-size: 1.05rem;
        border: 2px solid #e2e8f0;
        transition: all 0.18s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-verify-secondary:hover {
        background: #e2e8f0;
        color: #475569;
        border-color: #cbd5e1;
        text-decoration: none;
    }
    .btn-verify-logout {
        background: transparent;
        color: #ef4444;
        font-weight: 500;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        transition: all 0.18s;
        text-decoration: underline;
    }
    .btn-verify-logout:hover {
        background: #fef2f2;
        color: #dc2626;
    }
    @media (max-width: 768px) {
        .verify-email-container {
            margin: 1rem;
            padding: 1.5rem;
        }
        .verify-email-buttons {
            flex-direction: column;
            align-items: center;
        }
        .btn-verify-primary, .btn-verify-secondary {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="verify-email-container">
    <div class="verify-email-icon">
        <i class="bi bi-envelope-check"></i>
    </div>
    
    <h1 class="verify-email-title">
        Verifikasi Email Diperlukan
    </h1>
    
    <p class="verify-email-description">
        Silakan cek email Anda dan klik link verifikasi yang telah dikirimkan.<br>
        Jika ingin memperbarui data atau melihat profil, gunakan tombol di bawah ini.
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="verify-email-alert">
            <i class="bi bi-check-circle me-2"></i>
            {{ __('Tautan verifikasi baru telah dikirim ke email Anda.') }}
        </div>
    @endif

    <div class="verify-email-buttons">
        <form method="POST" action="{{ route('verification.send') }}" style="display: inline;">
            @csrf
            <button type="submit" class="btn-verify-primary">
                <i class="bi bi-envelope"></i>
                {{ __('Kirim Ulang Email Verifikasi') }}
            </button>
        </form>
        
        <a href="{{ route('profile.edit') }}" class="btn-verify-secondary">
            <i class="bi bi-person"></i>
            Ke Profil
        </a>
        
        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
            @csrf
            <button type="submit" class="btn-verify-logout">
                <i class="bi bi-box-arrow-right"></i>
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</div>
@endsection
