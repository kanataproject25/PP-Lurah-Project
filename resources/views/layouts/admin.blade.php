<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Kelurahan App') }} - Admin</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, Helvetica, sans-serif;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: Arial, Helvetica, sans-serif;
            font-weight: 600;
        }
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            overflow-y: auto;
            height: 100vh;
            box-shadow: 2px 0 16px 0 rgba(80, 80, 160, 0.15);
            transform: translateX(0);
            opacity: 1;
            animation: sidebarIn 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94) 0.1s forwards;
            transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            will-change: transform, opacity;
        }
        
        .sidebar.hide {
            transform: translateX(-100%);
            opacity: 0;
            pointer-events: none;
        }
        
        @keyframes sidebarIn {
            0% { 
                transform: translateX(-60px); 
                opacity: 0; 
            }
            50% {
                transform: translateX(-10px);
                opacity: 0.7;
            }
            100% { 
                transform: translateX(0); 
                opacity: 1; 
            }
        }
        
        .main-content {
            transition: margin-left 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            will-change: margin-left;
        }
        
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1040;
            opacity: 0;
            visibility: hidden;
            transition: all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            backdrop-filter: blur(2px);
            will-change: opacity, visibility;
        }
        
        .sidebar-overlay.show {
            opacity: 1;
            visibility: visible;
        }
        
        .dropdown-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
            z-index: 1055;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        
        .dropdown-overlay.show {
            opacity: 1;
            visibility: visible;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,.85);
            padding: 0.85rem 1.2rem;
            border-radius: 0.5rem;
            margin: 0.3rem 0;
            font-size: 1.08rem;
            display: flex;
            align-items: center;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            position: relative;
            overflow: hidden;
        }
        
        /* Hapus animasi shimmer dari nav links */
        
        .sidebar .nav-link i {
            margin-right: 0.7rem;
            font-size: 1.25em;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            will-change: transform, color;
        }
        
        .sidebar .nav-link:hover {
            color: #fff;
            background: rgba(255,255,255,0.18);
            transform: translateX(8px) scale(1.02);
            box-shadow: 0 4px 16px 0 rgba(80, 80, 160, 0.15);
        }
        
        .sidebar .nav-link.active {
            color: #fff !important;
            background: linear-gradient(135deg, #a78bfa 0%, #c4b5fd 100%) !important;
            transform: translateX(8px) scale(1.02) !important;
            box-shadow: 0 4px 16px 0 rgba(139, 92, 246, 0.25) !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            position: relative;
            z-index: 10;
        }
        
        .sidebar .nav-link.active i {
            color: #fbbf24 !important;
            transform: scale(1.1);
            transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        
        /* Tambahan untuk memastikan icon kuning saat active */
        .sidebar .nav-link.active .bi,
        .sidebar .nav-link.active i {
            color: #fbbf24 !important;
        }
        
        /* Override untuk memastikan icon kuning */
        .sidebar .nav-link.active .bi,
        .sidebar .nav-link.active i,
        .sidebar .nav-link.active:hover .bi,
        .sidebar .nav-link.active:hover i {
            color: #fbbf24 !important;
        }
        
        /* Selector paling spesifik untuk icon kuning */
        body .sidebar .nav-link.active i,
        body .sidebar .nav-link.active .bi,
        body .sidebar .nav-link.active:hover i,
        body .sidebar .nav-link.active:hover .bi,
        body .sidebar .nav-link.active:focus i,
        body .sidebar .nav-link.active:focus .bi {
            color: #fbbf24 !important;
        }
        
        /* Selector paling spesifik dengan !important */
        html body .sidebar .nav-link.active i,
        html body .sidebar .nav-link.active .bi,
        html body .sidebar .nav-link.active:hover i,
        html body .sidebar .nav-link.active:hover .bi,
        html body .sidebar .nav-link.active:focus i,
        html body .sidebar .nav-link.active:focus .bi {
            color: #fbbf24 !important;
        }
        
        /* Selector paling spesifik dengan warna kuning yang lebih terang */
        html body .sidebar .nav-link.active i,
        html body .sidebar .nav-link.active .bi {
            color: #fbbf24 !important;
        }
        
        .sidebar .nav-link.active::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            animation: activeShimmer 2s infinite;
        }
        
        @keyframes activeShimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }
        
        .sidebar .nav-link:hover i {
            color: #ffe082;
            transform: scale(1.2) rotate(-5deg);
        }
        
        /* Pastikan icon tetap kuning untuk link yang active */
        .sidebar .nav-link.active i,
        .sidebar .nav-link.active .bi {
            color: #fbbf24 !important;
        }
        
        .sidebar .nav-link.active:hover i,
        .sidebar .nav-link.active:hover .bi {
            color: #fbbf24 !important;
        }
        
        /* Selector paling spesifik untuk icon kuning */
        html body .sidebar .nav-link.active i,
        html body .sidebar .nav-link.active .bi,
        html body .sidebar .nav-link.active:hover i,
        html body .sidebar .nav-link.active:hover .bi,
        html body .sidebar .nav-link.active:focus i,
        html body .sidebar .nav-link.active:focus .bi {
            color: #fbbf24 !important;
        }
        
        /* Selector paling spesifik dengan warna kuning yang lebih terang */
        html body .sidebar .nav-link.active i,
        html body .sidebar .nav-link.active .bi {
            color: #f59e0b !important;
        }
        
        /* Selector paling spesifik untuk semua icon active */
        html body .sidebar .nav-link.active i,
        html body .sidebar .nav-link.active .bi,
        html body .sidebar .nav-link.active:hover i,
        html body .sidebar .nav-link.active:hover .bi,
        html body .sidebar .nav-link.active:focus i,
        html body .sidebar .nav-link.active:focus .bi {
            color: #f59e0b !important;
        }
        
        /* Override untuk memastikan icon kuning */
        .sidebar .nav-link.active i,
        .sidebar .nav-link.active .bi {
            color: #fbbf24 !important;
        }
        
        /* Selector paling spesifik untuk icon kuning */
        html body .sidebar .nav-link.active i,
        html body .sidebar .nav-link.active .bi {
            color: #fbbf24 !important;
        }
        
        /* Selector paling spesifik dengan warna kuning yang lebih terang */
        html body .sidebar .nav-link.active i,
        html body .sidebar .nav-link.active .bi {
            color: #fbbf24 !important;
        }
        
        /* Override semua style untuk icon active */
        .sidebar .nav-link.active i,
        .sidebar .nav-link.active .bi,
        .sidebar .nav-link.active:hover i,
        .sidebar .nav-link.active:hover .bi,
        .sidebar .nav-link.active:focus i,
        .sidebar .nav-link.active:focus .bi {
            color: #fbbf24 !important;
            transform: scale(1.1) !important;
        }
        
        .sidebar .nav-link.active:hover {
            background: linear-gradient(135deg, #a78bfa 0%, #c4b5fd 100%) !important;
            transform: translateX(8px) scale(1.02) !important;
        }
        
        .sidebar .nav-link.active:hover i,
        .sidebar .nav-link.active:hover .bi {
            color: #fbbf24 !important;
        }
        
        /* Selector paling spesifik untuk memastikan icon kuning */
        html body .sidebar .nav-link.active i,
        html body .sidebar .nav-link.active .bi,
        html body .sidebar .nav-link.active:hover i,
        html body .sidebar .nav-link.active:hover .bi,
        html body .sidebar .nav-link.active:focus i,
        html body .sidebar .nav-link.active:focus .bi {
            color: #fbbf24 !important;
        }
        
        /* Selector paling spesifik dengan warna kuning yang lebih terang */
        html body .sidebar .nav-link.active i,
        html body .sidebar .nav-link.active .bi {
            color: #fbbf24 !important;
        }
        
        /* Selector paling spesifik untuk memastikan icon kuning */
        html body .sidebar .nav-link.active i,
        html body .sidebar .nav-link.active .bi,
        html body .sidebar .nav-link.active:hover i,
        html body .sidebar .nav-link.active:hover .bi,
        html body .sidebar .nav-link.active:focus i,
        html body .sidebar .nav-link.active:focus .bi {
            color: #fbbf24 !important;
        }
        
        /* Stagger animation for nav links */
        .sidebar .nav-link {
            animation: navLinkFadeIn 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
            opacity: 0;
            transform: translateX(-20px);
        }
        
        .sidebar .nav-link:nth-child(1) { animation-delay: 0.1s; }
        .sidebar .nav-link:nth-child(2) { animation-delay: 0.15s; }
        .sidebar .nav-link:nth-child(3) { animation-delay: 0.2s; }
        .sidebar .nav-link:nth-child(4) { animation-delay: 0.25s; }
        .sidebar .nav-link:nth-child(5) { animation-delay: 0.3s; }
        .sidebar .nav-link:nth-child(6) { animation-delay: 0.35s; }
        .sidebar .nav-link:nth-child(7) { animation-delay: 0.4s; }
        .sidebar .nav-link:nth-child(8) { animation-delay: 0.45s; }
        .sidebar .nav-link:nth-child(9) { animation-delay: 0.5s; }
        .sidebar .nav-link:nth-child(10) { animation-delay: 0.55s; }
        
        @keyframes navLinkFadeIn {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        .sidebar h4 {
            font-size: 1.3rem;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .sidebar-close-btn {
            background: rgba(255, 255, 255, 0.15);
            border: none;
            color: #fff;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            backdrop-filter: blur(4px);
        }
        
        .sidebar-close-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: scale(1.1);
        }
        
        .sidebar-close-btn:active {
            transform: scale(0.95);
        }
        
        .sidebar-close-btn i {
            font-size: 1.2rem;
            transition: transform 0.3s ease;
        }
        
        .sidebar-close-btn:hover i {
            transform: rotate(90deg);
        }
        .sidebar hr {
            border-color: rgba(255,255,255,0.25);
        }
        .sidebar .relative {
            margin-bottom: 1.2rem;
        }
        .sidebar button[aria-expanded], .sidebar button {
            transition: background 0.2s, color 0.2s;
        }
        .sidebar .relative ul[x-show] {
            transition: max-height 0.4s cubic-bezier(0.77,0,0.18,1), opacity 0.3s;
            overflow: hidden;
        }
        .sidebar .relative ul[x-show="true"] {
            max-height: 400px;
            opacity: 1;
        }
        .sidebar .relative ul[x-show="false"] {
            max-height: 0;
            opacity: 0;
        }
        .sidebar .relative ul {
            box-shadow: 0 4px 24px 0 rgba(80, 80, 160, 0.13);
        }
        .sidebar .relative ul li a {
            font-size: 1rem;
            transition: background 0.2s, color 0.2s;
        }
        .sidebar .relative ul li a:hover {
            background: rgba(255,255,255,0.13);
            color: #ffe082;
        }
        .main-content {
            margin-left: 250px;
        }
        .top-navbar {
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,.075);
        }
        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }
        .sidebar-toggle {
            background: linear-gradient(135deg, #2563eb 0%, #06b6d4 100%);
            border: none;
            outline: none;
            cursor: pointer;
            padding: 0.75rem;
            margin-right: 1rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 1101;
            border-radius: 12px;
            width: 48px;
            height: 48px;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            position: relative;
            overflow: hidden;
        }
        
        /* Mobile hamburger menu */
        .sidebar-toggle-mobile {
            background: linear-gradient(135deg, #2563eb 0%, #06b6d4 100%);
            border: none;
            outline: none;
            cursor: pointer;
            padding: 0.6rem;
            margin-right: 1rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 1101;
            border-radius: 10px;
            width: 44px;
            height: 44px;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            position: relative;
            overflow: hidden;
        }
        
        .sidebar-toggle-mobile:hover {
            background: linear-gradient(135deg, #1d4ed8 0%, #0891b2 100%);
            transform: scale(1.05);
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.3);
        }
        
        .sidebar-toggle-mobile::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            border-radius: 10px;
        }
        
        .sidebar-toggle-mobile:hover::before {
            left: 100%;
        }
        
        .sidebar-toggle-mobile:active {
            transform: scale(0.95);
        }
        
        .sidebar-toggle-mobile .bar {
            display: block;
            width: 20px;
            height: 2.5px;
            margin: 2px 0;
            background: #fff;
            border-radius: 2px;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            transform-origin: center;
            will-change: transform, opacity;
        }
        
        .sidebar-toggle-mobile.open .bar:nth-child(1) {
            transform: translateY(6px) rotate(45deg);
            background: #fff;
        }
        
        .sidebar-toggle-mobile.open .bar:nth-child(2) {
            opacity: 0;
            transform: scaleX(0) translateX(-8px);
        }
        
        .sidebar-toggle-mobile.open .bar:nth-child(3) {
            transform: translateY(-6px) rotate(-45deg);
            background: #fff;
        }
        
        .sidebar-toggle:hover {
            background: linear-gradient(135deg, #1d4ed8 0%, #0891b2 100%);
            transform: scale(1.05);
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.3);
        }
        
        .sidebar-toggle::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            border-radius: 12px;
        }
        
        .sidebar-toggle:hover::before {
            left: 100%;
        }
        
        .sidebar-toggle:active {
            transform: scale(0.95);
        }
        
        .sidebar-toggle .bar {
            display: block;
            width: 24px;
            height: 3px;
            margin: 2px 0;
            background: #fff;
            border-radius: 2px;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            transform-origin: center;
            will-change: transform, opacity;
        }
        
        .sidebar-toggle.open .bar:nth-child(1) {
            transform: translateY(7px) rotate(45deg);
            background: #fff;
        }
        
        .sidebar-toggle.open .bar:nth-child(2) {
            opacity: 0;
            transform: scaleX(0) translateX(-10px);
        }
        
        .sidebar-toggle.open .bar:nth-child(3) {
            transform: translateY(-7px) rotate(-45deg);
            background: #fff;
        }
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0 !important;
                padding: 0.5rem !important;
            }
            .sidebar {
                width: 280px !important;
                min-width: 280px;
                max-width: 280px;
                z-index: 1050;
            }
            .sidebar.hide {
                transform: translateX(-100%);
            }
            .sidebar-toggle {
                width: 44px;
                height: 44px;
                padding: 0.6rem;
                margin-right: 1rem !important;
            }
            .sidebar-toggle .bar {
                width: 20px;
                height: 2.5px;
            }
            .sidebar-toggle-mobile {
                width: 40px;
                height: 40px;
                padding: 0.5rem;
                margin-right: 0.8rem !important;
            }
            .sidebar-toggle-mobile .bar {
                width: 18px;
                height: 2px;
            }
            .sidebar-overlay {
                display: block;
            }
            .sidebar .nav-link {
                padding: 0.7rem 1rem;
                font-size: 1rem;
                margin: 0.2rem 0;
            }
            .sidebar h4 {
                font-size: 1.1rem;
            }
            .sidebar-close-btn {
                width: 32px;
                height: 32px;
            }
            .sidebar-close-btn i {
                font-size: 1rem;
            }
            .top-navbar {
                padding: 0.5rem 1rem;
            }
            .btn-home-gradient {
                padding: 8px 16px;
                font-size: 0.9rem;
            }
        }
        
        @media (max-width: 576px) {
            .main-content {
                padding: 0.25rem !important;
            }
            .sidebar {
                width: 260px !important;
                min-width: 260px;
                max-width: 260px;
            }
            .sidebar-toggle {
                width: 40px;
                height: 40px;
                padding: 0.5rem;
                margin-right: 0.8rem !important;
            }
            .sidebar-toggle .bar {
                width: 18px;
                height: 2px;
            }
            .sidebar .nav-link {
                padding: 0.6rem 0.8rem;
                font-size: 0.95rem;
            }
            .sidebar h4 {
                font-size: 1rem;
            }
            .sidebar-close-btn {
                width: 30px;
                height: 30px;
            }
            .sidebar-close-btn i {
                font-size: 0.9rem;
            }
            .top-navbar {
                padding: 0.4rem 0.5rem;
            }
            .btn-home-gradient {
                padding: 6px 12px;
                font-size: 0.85rem;
            }
            .dropdown-menu.buatsurat-dropdown .dropdown-item {
                padding: 8px 12px;
                font-size: 0.9rem;
            }
        }
        
        @media (max-width: 480px) {
            .main-content {
                padding: 0.15rem !important;
            }
            .sidebar {
                width: 240px !important;
                min-width: 240px;
                max-width: 240px;
            }
            .sidebar-toggle {
                width: 36px;
                height: 36px;
                padding: 0.4rem;
                margin-right: 0.6rem !important;
            }
            .sidebar-toggle .bar {
                width: 16px;
                height: 1.8px;
            }
            .sidebar .nav-link {
                padding: 0.5rem 0.6rem;
                font-size: 0.9rem;
                margin: 0.15rem 0;
            }
            .sidebar h4 {
                font-size: 0.95rem;
            }
            .top-navbar {
                padding: 0.3rem 0.4rem;
            }
            .btn-home-gradient {
                padding: 5px 10px;
                font-size: 0.8rem;
            }
            .dropdown-menu.buatsurat-dropdown .dropdown-item {
                padding: 6px 10px;
                font-size: 0.85rem;
            }
        }
        
        @media (max-width: 360px) {
            .main-content {
                padding: 0.1rem !important;
            }
            .sidebar {
                width: 220px !important;
                min-width: 220px;
                max-width: 220px;
            }
            .sidebar-toggle {
                width: 32px;
                height: 32px;
                padding: 0.3rem;
                margin-right: 0.5rem !important;
            }
            .sidebar-toggle .bar {
                width: 14px;
                height: 1.5px;
            }
            .sidebar .nav-link {
                padding: 0.4rem 0.5rem;
                font-size: 0.85rem;
                margin: 0.1rem 0;
            }
            .sidebar h4 {
                font-size: 0.9rem;
            }
            .top-navbar {
                padding: 0.2rem 0.3rem;
            }
            .btn-home-gradient {
                padding: 4px 8px;
                font-size: 0.75rem;
            }
            .dropdown-menu.buatsurat-dropdown .dropdown-item {
                padding: 5px 8px;
                font-size: 0.8rem;
            }
        }
        
        @media (min-width: 769px) {
            .sidebar-overlay {
                display: none;
            }
        }
        .up {
            transform: rotate(-135deg);
            -webkit-transform: rotate(-135deg);
        }
        .down {
            transform: rotate(45deg);
            -webkit-transform: rotate(45deg);
        }
        .btn-home-gradient {
            background: linear-gradient(90deg,#2563eb 0%,#06b6d4 100%);
            color: #fff;
            font-weight: 700;
            border-radius: 2rem;
            padding: 10px 32px;
            font-size: 1.13rem;
            box-shadow: 0 4px 16px 0 rgba(37,99,235,0.13);
            border: none;
            transition: background 0.22s, color 0.18s, box-shadow 0.18s, transform 0.18s;
            display: inline-flex;
            align-items: center;
            gap: 12px;
            letter-spacing: 0.5px;
            position: relative;
            z-index: 2;
        }
        .btn-home-gradient:hover, .btn-home-gradient:focus {
            background: linear-gradient(90deg,#1d4ed8 0%,#06b6d4 100%);
            color: #fff;
            box-shadow: 0 8px 32px 0 rgba(37,99,235,0.18);
            transform: translateY(-2px) scale(1.04);
            text-decoration: none;
        }
        .btn-home-gradient .bi {
            font-size: 1.25em;
        }
        .dropdown-menu.buatsurat-dropdown .dropdown-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 22px;
            font-size: 1.07rem;
            font-weight: 600;
            border-radius: 10px;
            margin-bottom: 2px;
            transition: background 0.18s, color 0.18s;
        }
        .dropdown-menu.buatsurat-dropdown .dropdown-item .bi {
            font-size: 1.18em;
            color: #2563eb;
            transition: color 0.18s;
        }
        .dropdown-menu.buatsurat-dropdown .dropdown-item:hover, .dropdown-menu.buatsurat-dropdown .dropdown-item:focus {
            background: linear-gradient(90deg,#2563eb0d 0%,#06b6d40d 100%);
            color: #2563eb;
        }
        .dropdown-menu.buatsurat-dropdown .dropdown-item:hover .bi, .dropdown-menu.buatsurat-dropdown .dropdown-item:focus .bi {
            color: #0ea5e9;
        }
        
        /* Responsive dropdown untuk mobile */
        @media (max-width: 768px) {
            .dropdown-menu.buatsurat-dropdown {
                position: fixed !important;
                top: 70px !important;
                left: 10px !important;
                right: 10px !important;
                width: auto !important;
                max-width: none !important;
                min-width: auto !important;
                margin: 0 !important;
                border-radius: 12px !important;
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15) !important;
                z-index: 1060 !important;
            }
            .btn-home-gradient { 
                padding: 8px 16px; 
                font-size: 1rem; 
            }
            .dropdown-menu.buatsurat-dropdown .dropdown-item { 
                font-size: 0.98rem; 
                padding: 12px 16px; 
                border-radius: 8px;
                margin-bottom: 4px;
            }
        }
        
        @media (max-width: 600px) {
            .btn-home-gradient { 
                padding: 6px 12px; 
                font-size: 0.9rem; 
            }
            .dropdown-menu.buatsurat-dropdown .dropdown-item { 
                font-size: 0.95rem; 
                padding: 10px 14px; 
            }
        }
        
        @media (max-width: 480px) {
            .dropdown-menu.buatsurat-dropdown {
                top: 60px !important;
                left: 8px !important;
                right: 8px !important;
                border-radius: 10px !important;
            }
            .btn-home-gradient { 
                padding: 5px 10px; 
                font-size: 0.85rem; 
            }
            .dropdown-menu.buatsurat-dropdown .dropdown-item { 
                font-size: 0.9rem; 
                padding: 8px 12px; 
                border-radius: 6px;
            }
        }
    </style>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body x-data="{ sidebarOpen: true, dropdownOpen: false }" :class="{ 'sidebar-collapsed': !sidebarOpen }">
    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay" :class="{ 'show': sidebarOpen }" @click="sidebarOpen = false" x-show="sidebarOpen"></div>
    
    <!-- Dropdown Overlay for Mobile -->
    <div class="dropdown-overlay" id="dropdownOverlay" style="display: none;"></div>
    
    <!-- Sidebar -->
    <transition enter-active-class="transition duration-400" leave-active-class="transition duration-400">
    <div class="sidebar" :class="{ 'hide': !sidebarOpen }" x-show="sidebarOpen">
        <div class="p-3">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="text-white mb-0">
                    <i class="bi bi-building"></i>
                    Admin Panel
                </h4>
                <button class="sidebar-close-btn d-md-none" @click="sidebarOpen = false" aria-label="Close sidebar">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <nav class="nav flex-column">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="bi bi-house"></i>
                    Beranda
                </a>
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-speedometer2"></i>
                    Dashboard
                </a>
                <a class="nav-link" href="{{ route('admin.sktm.index') }}">
                    <i class="bi bi-file-text"></i>
                    Kelola SKTM
                </a>
                <a class="nav-link" href="{{ route('admin.sdu.index') }}">
                    <i class="bi bi-briefcase"></i>
                    Kelola SDU
                </a>
                <a class="nav-link" href="{{ route('admin.sd.index') }}">
                    <i class="bi bi-house"></i>
                    Kelola SD
                </a>
                <a class="nav-link" href="{{ route('admin.sk.index') }}">
                    <i class="bi bi-person-x"></i>
                    Kelola SK
                </a>
                <a class="nav-link" href="{{ route('admin.skbm.index') }}">
                    <i class="bi bi-person-badge"></i>
                    Kelola SKBM
                </a>
                <a class="nav-link" href="{{ route('admin.berita.index') }}">
                    <i class="bi bi-newspaper"></i>
                    Kelola Berita
                </a>
                <a class="nav-link" href="{{ route('admin.galeri.index') }}">
                    <i class="bi bi-images"></i>
                    Kelola Galeri
                </a>
                <a class="nav-link" href="{{ route('admin.prestasi.index') }}">
                    <i class="bi bi-trophy"></i>
                    Kelola Prestasi
                </a>
                <hr class="text-white">
            </nav>
        </div>
    </div>
    </transition>

    <!-- Main Content -->
    <div class="main-content" :style="sidebarOpen ? 'margin-left:250px;' : 'margin-left:0;'">
        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-lg top-navbar">
            <div class="container-fluid d-flex align-items-center">
                <!-- Desktop hamburger menu -->
                <button class="sidebar-toggle me-3 d-none d-md-flex" :class="{ 'open': !sidebarOpen }" @click="sidebarOpen = !sidebarOpen" aria-label="Toggle sidebar">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </button>
                
                <!-- Mobile hamburger menu (hanya muncul saat sidebar tertutup) -->
                <button class="sidebar-toggle-mobile me-3 d-md-none" :class="{ 'open': sidebarOpen }" @click="sidebarOpen = !sidebarOpen" aria-label="Toggle sidebar" x-show="!sidebarOpen">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </button>
                <div class="ms-auto d-flex align-items-center gap-2">
                    <div class="dropdown me-2">
                        <button class="btn-home-gradient dropdown-toggle d-flex align-items-center" type="button" id="buatSuratDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-file-earmark-plus me-2"></i> Buat Surat
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow buatsurat-dropdown" aria-labelledby="buatSuratDropdown">
                            <li><a class="dropdown-item" href="{{ route('admin.sktm.create') }}"><i class="bi bi-person-badge"></i> Surat Keterangan Tidak Mampu (SKTM)</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.sdu.create') }}"><i class="bi bi-briefcase"></i> Surat Domisili Usaha</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.sd.create') }}"><i class="bi bi-house"></i> Surat Domisili</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.sk.create') }}"><i class="bi bi-person-x"></i> Surat Kematian</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.skbm.create') }}"><i class="bi bi-person-lines-fill"></i> Surat Keterangan Belum Menikah</a></li>
                        </ul>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-light d-flex align-items-center px-3 py-2 rounded-pill" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-2" style="font-size:1.35rem;"></i>
                            <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                            <i class="bi bi-caret-down-fill ms-2"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="profileDropdown">
                            <li>
                                <a class="dropdown-item" href="/profile"><i class="bi bi-person me-2"></i> Profile</a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right me-2"></i> Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="p-4">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript untuk dropdown mobile dan active state -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownToggle = document.getElementById('buatSuratDropdown');
            const dropdownMenu = document.querySelector('.buatsurat-dropdown');
            const dropdownOverlay = document.getElementById('dropdownOverlay');
            
            // Fungsi untuk menampilkan overlay
            function showDropdownOverlay() {
                if (window.innerWidth <= 768) {
                    dropdownOverlay.style.display = 'block';
                    setTimeout(() => {
                        dropdownOverlay.classList.add('show');
                    }, 10);
                }
            }
            
            // Fungsi untuk menyembunyikan overlay
            function hideDropdownOverlay() {
                dropdownOverlay.classList.remove('show');
                setTimeout(() => {
                    dropdownOverlay.style.display = 'none';
                }, 300);
            }
            
            // Fungsi untuk mengatur active state
            function setActiveNavLink() {
                const currentPath = window.location.pathname;
                const navLinks = document.querySelectorAll('.sidebar .nav-link');
                
                // Hapus semua active state
                navLinks.forEach(link => {
                    link.classList.remove('active');
                    const icon = link.querySelector('i, .bi');
                    if (icon) {
                        icon.style.color = '';
                        icon.style.removeProperty('color');
                    }
                });
                
                // Set active state berdasarkan current path
                navLinks.forEach(link => {
                    const href = link.getAttribute('href');
                    if (!href) return;

                    // Dashboard
                    if (href.includes('dashboard') && (currentPath === '/admin/dashboard' || currentPath === '/admin')) {
                        link.classList.add('active');
                    }
                    // SKTM (paling spesifik, harus sebelum SK dan SKBM)
                    else if (
                        href.includes('sktm') &&
                        !href.includes('skbm') &&
                        currentPath.match(/^\/admin(\/surat)?\/sktm(\/|$)/)
                    ) {
                        link.classList.add('active');
                    }
                    // SKBM (paling spesifik, harus sebelum SK)
                    else if (
                        href.includes('skbm') &&
                        currentPath.match(/^\/admin(\/surat)?\/skbm(\/|$)/)
                    ) {
                        link.classList.add('active');
                    }
                    // SK (harus setelah SKTM dan SKBM)
                    else if (
                        href.includes('sk') &&
                        !href.includes('sktm') &&
                        !href.includes('skbm') &&
                        currentPath.match(/^\/admin(\/surat)?\/sk(\/|$)/)
                    ) {
                        link.classList.add('active');
                    }
                    // SDU (paling spesifik, harus sebelum SD)
                    else if (
                        href.includes('sdu') &&
                        currentPath.match(/^\/admin(\/surat)?\/sdu(\/|$)/)
                    ) {
                        link.classList.add('active');
                    }
                    // SD (harus setelah SDU)
                    else if (
                        href.includes('sd') &&
                        !href.includes('sdu') &&
                        currentPath.match(/^\/admin(\/surat)?\/sd(\/|$)/)
                    ) {
                        link.classList.add('active');
                    }
                    // Berita
                    else if (href.includes('berita') && currentPath.startsWith('/admin/berita')) {
                        link.classList.add('active');
                    }
                    // Galeri
                    else if (href.includes('galeri') && currentPath.startsWith('/admin/galeri')) {
                        link.classList.add('active');
                    }
                    // Prestasi
                    else if (href.includes('prestasi') && currentPath.startsWith('/admin/prestasi')) {
                        link.classList.add('active');
                    }
                    // Beranda
                    else if (href.includes('home') && currentPath === '/') {
                        link.classList.add('active');
                    }
                });
                
                // Debug: log current path dan active links
                console.log('Current path:', currentPath);
                const activeLinks = document.querySelectorAll('.sidebar .nav-link.active');
                console.log('Active links:', activeLinks.length);
                
                // Debug: log setiap link dan href-nya
                navLinks.forEach(link => {
                    const href = link.getAttribute('href');
                    const isActive = link.classList.contains('active');
                    console.log('Link:', link.textContent.trim(), 'Href:', href, 'Active:', isActive);
                });
                
                // Debug: log current path untuk memastikan
                console.log('=== DEBUG INFO ===');
                console.log('Current Path:', currentPath);
                console.log('Active Links Found:', activeLinks.length);
                activeLinks.forEach(link => {
                    console.log('Active Link:', link.textContent.trim(), 'Href:', link.getAttribute('href'));
                });
                console.log('=== END DEBUG ===');
                
                // Tambahan: pastikan icon kuning untuk link yang active
                activeLinks.forEach(link => {
                    const icon = link.querySelector('i, .bi');
                    if (icon) {
                        icon.style.color = '#fbbf24';
                        icon.style.setProperty('color', '#fbbf24', 'important');
                        console.log('Set icon kuning for:', link.textContent.trim());
                    }
                });
            }
            
            // Event listener untuk dropdown toggle
            if (dropdownToggle) {
                dropdownToggle.addEventListener('click', function(e) {
                    if (window.innerWidth <= 768) {
                        const isOpen = dropdownMenu.classList.contains('show');
                        if (!isOpen) {
                            showDropdownOverlay();
                        } else {
                            hideDropdownOverlay();
                        }
                    }
                });
            }
            
            // Event listener untuk overlay
            if (dropdownOverlay) {
                dropdownOverlay.addEventListener('click', function() {
                    hideDropdownOverlay();
                    // Tutup dropdown
                    const bsDropdown = bootstrap.Dropdown.getInstance(dropdownToggle);
                    if (bsDropdown) {
                        bsDropdown.hide();
                    }
                });
            }
            
            // Event listener untuk dropdown items
            const dropdownItems = document.querySelectorAll('.buatsurat-dropdown .dropdown-item');
            dropdownItems.forEach(item => {
                item.addEventListener('click', function() {
                    hideDropdownOverlay();
                });
            });
            
            // Event listener untuk resize window
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    hideDropdownOverlay();
                }
            });
            
            // Set active state saat halaman dimuat
            setActiveNavLink();
            
            // Event listener untuk nav links
            const navLinks = document.querySelectorAll('.sidebar .nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    // Hapus active state dari semua link
                    navLinks.forEach(l => {
                        l.classList.remove('active');
                        const icon = l.querySelector('i, .bi');
                        if (icon) {
                            icon.style.color = '';
                        }
                    });
                    
                    // Tambahkan active state ke link yang diklik
                    this.classList.add('active');
                    
                    // Pastikan icon kuning untuk link yang active
                    const icon = this.querySelector('i, .bi');
                    if (icon) {
                        icon.style.color = '#fbbf24';
                        icon.style.setProperty('color', '#fbbf24', 'important');
                        console.log('Clicked link icon kuning:', this.textContent.trim());
                    }
                    
                    // Debug: log link yang diklik
                    console.log('Clicked link:', this.getAttribute('href'));
                });
            });
            
            // Set active state setiap kali halaman berubah
            window.addEventListener('popstate', function() {
                setTimeout(setActiveNavLink, 100);
            });
            
            // Set active state setiap kali URL berubah (untuk SPA behavior)
            let currentUrl = window.location.href;
            setInterval(function() {
                if (currentUrl !== window.location.href) {
                    currentUrl = window.location.href;
                    setTimeout(setActiveNavLink, 100);
                }
            }, 100);
            
            // Set active state setiap 500ms untuk memastikan
            setInterval(setActiveNavLink, 500);
            
            // Set active state saat halaman dimuat ulang
            window.addEventListener('load', function() {
                setTimeout(setActiveNavLink, 100);
            });
            
            // Set active state saat DOM selesai dimuat
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(setActiveNavLink, 100);
            });
        });
    </script>
</body>
</html> 