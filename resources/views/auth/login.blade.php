@extends('layouts.app')

@section('content')
<!-- Google Fonts: Poppins -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Poppins', Arial, sans-serif;
        background: linear-gradient(120deg, #89f7fe 0%, #66a6ff 100%);
        min-height: 100vh;
    }
    .login-bg {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: linear-gradient(120deg, #89f7fe 0%, #66a6ff 100%);
    }
    .login-card {
        width: 25rem;
        background: rgba(255,255,255,0.93);
        box-shadow: 0 8px 32px 0 rgba(31,38,135,0.13);
        border-radius: 1.5rem;
        padding: 2.5rem 2rem;
        backdrop-filter: blur(10px);
        animation: fadeInCard 1s ease;
        position: relative;
    }
    @keyframes fadeInCard {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .login-logo {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 2.2rem;
        position: relative;
    }
    .login-logo::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, rgba(102,166,255,0.1) 0%, rgba(137,247,254,0.1) 100%);
        border-radius: 50%;
        z-index: -1;
        animation: pulse 2s infinite;
    }
    @keyframes pulse {
        0% { transform: translate(-50%, -50%) scale(1); opacity: 0.7; }
        50% { transform: translate(-50%, -50%) scale(1.1); opacity: 0.4; }
        100% { transform: translate(-50%, -50%) scale(1); opacity: 0.7; }
    }
    .login-logo img {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        box-shadow: 0 4px 16px rgba(102,166,255,0.2);
        object-fit: contain;
        background: transparent !important;
        filter: drop-shadow(0 2px 8px rgba(0,0,0,0.1));
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .login-logo img:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 20px rgba(102,166,255,0.3);
    }
    .input-group {
        display: flex;
        align-items: center;
        background: #fff;
        border: 1.5px solid #b5d0f7;
        border-radius: 1rem;
        box-shadow: 0 1px 4px rgba(102,166,255,0.07);
        margin-bottom: 1.2rem;
        padding: 0 1rem;
        height: 2.8rem;
        transition: border-color 0.3s, box-shadow 0.3s;
    }
    .input-group:focus-within {
        border-color: #66a6ff;
        box-shadow: 0 0 0 2px #66a6ff33;
    }
    .input-group,
    .input-group *,
    .input-icon,
    .input-group span,
    .input-group i,
    input.form-control {
        background: #fff !important;
    }
    input.form-control:-webkit-autofill,
    input.form-control:-webkit-autofill:focus,
    input.form-control:-webkit-autofill:hover,
    input.form-control:-webkit-autofill:active {
        -webkit-box-shadow: 0 0 0 1000px #fff inset !important;
        box-shadow: 0 0 0 1000px #fff inset !important;
        background: #fff !important;
        color: #37517e !important;
    }
    .input-icon {
        color: #66a6ff;
        font-size: 1.18rem;
        opacity: 0.88;
        margin-right: 0.7rem;
        display: flex;
        align-items: center;
        background: none !important;
    }
    .form-control {
        border: none;
        outline: none;
        font-size: 1rem;
        font-family: 'Poppins', Arial, sans-serif;
        flex: 1;
        height: 100%;
        padding: 0;
        box-shadow: none;
    }
    .form-control::placeholder {
        color: #37517e;
        opacity: 0.7;
        font-weight: 500;
        font-size: 1.04rem;
    }
    .btn-modern {
        background: linear-gradient(90deg, #66a6ff 0%, #89f7fe 100%);
        color: #fff;
        border: none;
        border-radius: 1.2rem;
        font-weight: 600;
        font-size: 1.13rem;
        box-shadow: 0 2px 8px rgba(102,166,255,0.15);
        transition: background 0.3s, transform 0.2s, box-shadow 0.2s;
        margin-bottom: 0.7rem;
        margin-top: 0.7rem;
        padding: 1rem 0;
        letter-spacing: 0.5px;
    }
    .btn-modern:hover {
        background: linear-gradient(90deg, #89f7fe 0%, #66a6ff 100%);
        transform: translateY(-2px) scale(1.04);
        color: #fff;
        box-shadow: 0 4px 16px rgba(102,166,255,0.18);
    }
    .login-card .text-center.mt-3 a.btn {
        border-radius: 1rem;
        font-size: 1rem;
    }
    .mb-3.form-check {
        margin-bottom: 1.7rem !important;
    }
    .text-center.mt-3 {
        margin-top: 1.7rem !important;
    }
    /* Tambahan untuk logo yang lebih baik */
    .logo-container {
        position: relative;
        display: inline-block;
    }
    .logo-container::after {
        content: '';
        position: absolute;
        top: -5px;
        left: -5px;
        right: -5px;
        bottom: -5px;
        background: linear-gradient(45deg, #66a6ff, #89f7fe, #66a6ff);
        border-radius: 50%;
        z-index: -1;
        opacity: 0.3;
        animation: rotate 3s linear infinite;
    }
    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
</style>
<div class="login-bg">
  <div class="login-card">
    <div class="login-logo">
      <div class="logo-container">
        <img src="{{ asset('img/logo-jambi.png') }}" alt="Logo" style="background: transparent !important;">
      </div>
    </div>
    <h4 class="text-center mb-4" style="font-weight:600;">Login</h4>
    <form method="POST" action="{{ route('login') }}">
      @csrf
      <div class="input-group">
        <span class="input-icon"><i class="bi bi-envelope"></i></span>
        <input type="email" name="email" class="form-control" id="email" placeholder="Email" required autofocus autocomplete="username">
      </div>
      <div class="input-group">
        <span class="input-icon"><i class="bi bi-lock"></i></span>
        <input type="password" name="password" class="form-control" id="password" placeholder="Password" required autocomplete="current-password">
      </div>
      <div class="mb-3 form-check">
        <input type="checkbox" name="remember" class="form-check-input" id="remember">
        <label class="form-check-label" for="remember">Remember me</label>
      </div>
      <button type="submit" class="btn btn-modern w-100">Login</button>
    </form>
    <div class="text-center mt-3">
      <p class="mb-2">Belum punya akun?</p>
      <a href="{{ route('register') }}" class="btn btn-outline-primary">Register</a>
      <p></p>
      <a href="{{ route('google.login') }}"
         class="d-flex align-items-center justify-content-center mb-4"
         style="width: 220px; height: 48px; border-radius: 24px; background: #fff; border: 1px solid #ddd; margin: 0 auto; box-shadow: 0 2px 8px rgba(0,0,0,0.05); text-decoration: none; transition: box-shadow 0.2s;"
         title="Login/Daftar dengan Google"
         onmouseover="this.style.boxShadow='0 4px 16px rgba(66,133,244,0.15)';" onmouseout="this.style.boxShadow='0 2px 8px rgba(0,0,0,0.05)';">
          <img src="{{ asset('img/google-logo.svg') }}" alt="Google" style="width:28px; height:28px; margin-right: 16px;" />
          <span style="font-size: 1rem; color: #444; font-weight: 500;">Login with Google</span>
      </a>
    </div>
  </div>
</div>
@endsection
