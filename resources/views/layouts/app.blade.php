<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Kelurahan App') }}</title>

    <style>
    /* Force Font Change - Arial like Disdik Jambi */
    body, h1, h2, h3, h4, h5, h6, p, span, div, a, button, input, textarea, select {
        font-family: Arial, Helvetica, sans-serif !important;
    }
    .navbar-custom {
      background: #39507a !important;
      box-shadow: none !important;
      border: none !important;
    }
    .navbar-custom .navbar-brand, .navbar-custom .nav-link, .navbar-custom .dropdown-toggle {
      color: #fff !important;
      font-weight: 500;
    }
    .navbar-custom .nav-link:hover, .navbar-custom .nav-link.active, .navbar-custom .dropdown-item:hover {
      color: #ffe066 !important;
      background: rgba(255,255,255,0.08) !important;
    }
    .navbar-custom .dropdown-menu {
      background: rgba(41,60,100,0.98);
      border-radius: 18px;
      border: none;
      box-shadow: 0 8px 32px 0 rgba(37,99,235,0.18);
      padding: 8px 6px;
      min-width: 220px;
      margin-top: 8px;
      transition: all 0.25s cubic-bezier(.4,2,.6,1);
      left: 0 !important;
      right: auto !important;
      overflow: visible;
      box-sizing: border-box;
    }
    .navbar-custom .dropdown-menu-end {
      left: auto !important;
      right: 0 !important;
    }
    @media (max-width: 991.98px) {
      .navbar-custom .dropdown-menu, .navbar-custom .dropdown-menu-end {
        left: 0 !important;
        right: 0 !important;
        min-width: 100%;
      }
    }
    .navbar-custom .dropdown-item {
      color: #fff;
      padding: 10px 12px;
      border-radius: 12px;
      margin: 0;
      transition: background 0.18s, color 0.18s;
      font-size: 1.05rem;
      position: relative;
      z-index: 1;
      box-sizing: border-box;
      width: 100%;
      display: block;
    }
    .navbar-custom .dropdown-item.active, .navbar-custom .dropdown-item:active, .navbar-custom .dropdown-item.selected {
      background: #ffe066 !important;
      color: #3b3b3b !important;
      border-radius: 18px;
      margin: 0;
      padding: 10px 12px;
      z-index: 2;
      box-sizing: border-box;
      width: 100%;
      display: block;
      box-shadow: none;
    }
    .navbar-custom .dropdown-item:hover, .navbar-custom .dropdown-item:focus {
      color: #39507a !important;
      background: #ffe066 !important;
    }
    .navbar-custom .dropdown-divider {
      border-top: 1.5px solid #4b5c7a;
      margin: 8px 0;
    }
    .navbar-custom .btn-outline-primary {
      color: #fff;
      border-color: #fff;
    }
    .navbar-custom .btn-outline-primary:hover {
      background: #2563eb;
      color: #ffe066;
      border-color: #ffe066;
    }
    @media (min-width: 992px) {
      .navbar-nav .dropdown:hover .dropdown-menu {
        display: block;
        margin-top: 0;
      }
      .navbar-nav .dropdown .dropdown-toggle::after {
        transform: rotate(180deg);
      }
    }
    
    /* Fix hamburger menu for mobile */
    @media (max-width: 991.98px) {
      .navbar-collapse {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: #39507a;
        border-radius: 0 0 12px 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        z-index: 1030;
      }
      .navbar-collapse.show {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: #39507a;
        border-radius: 0 0 12px 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        z-index: 1030;
        padding: 1rem 1.5rem 2rem 1.5rem;
        max-height: 80vh;
        overflow-y: auto;
      }
      .navbar-collapse.collapsing {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: #39507a;
        border-radius: 0 0 12px 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        z-index: 1030;
        padding: 1rem 1.5rem;
      }
      .navbar-toggler {
        border: none;
        padding: 0.25rem 0.5rem;
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .navbar-toggler:focus {
        box-shadow: none;
      }
      .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.9%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
      }
      
      /* Close button styling */
      .btn-close-navbar {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 6px;
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(255, 255, 255, 0.9);
        font-size: 24px;
        font-weight: bold;
        transition: all 0.2s ease;
        padding: 0;
      }
      
      .btn-close-navbar:hover {
        background: rgba(255, 255, 255, 0.2);
        color: #fff;
        border-color: rgba(255, 255, 255, 0.3);
      }
      
      .btn-close-navbar:focus {
        box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.25);
        outline: none;
      }
      
      .btn-close-icon {
        line-height: 1;
      }
      
      /* Mobile menu items spacing */
      .navbar-collapse .navbar-nav {
        padding-left: 0.5rem;
      }
      
      .navbar-collapse .nav-item {
        margin-bottom: 0.5rem;
      }
      
      /* Add extra spacing after dropdown items */
      .navbar-collapse .dropdown {
        margin-bottom: 1rem;
      }
      
      .navbar-collapse .dropdown.show {
        margin-bottom: 0.5rem;
      }
      
      .navbar-collapse .nav-link {
        padding: 0.75rem 1rem;
        border-radius: 8px;
        transition: background-color 0.2s ease;
      }
      
      .navbar-collapse .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.1);
      }
      
      /* Mobile dropdown styling */
      .navbar-collapse .dropdown-menu {
        background: #34495e !important;
        border: none !important;
        border-radius: 12px !important;
        margin-top: 0.75rem !important;
        margin-bottom: 1.5rem !important;
        margin-left: 0.5rem !important;
        margin-right: 0.5rem !important;
        box-shadow: 0 6px 20px rgba(0,0,0,0.2) !important;
        padding: 0.75rem 0 !important;
        position: static !important;
        float: none !important;
        width: calc(100% - 1rem) !important;
        transform: none !important;
        display: none !important;
        border-top: 2px solid rgba(255, 255, 255, 0.1) !important;
      }
      
      .navbar-collapse .dropdown-menu.show {
        display: block !important;
      }
      
      .navbar-collapse .dropdown-item {
        color: #fff !important;
        padding: 1rem 1.5rem !important;
        border-radius: 0 !important;
        transition: all 0.3s ease !important;
        font-size: 0.95rem !important;
        font-weight: 500 !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
        position: relative !important;
      }
      
      .navbar-collapse .dropdown-item:last-child {
        border-bottom: none !important;
      }
      
      .navbar-collapse .dropdown-item:hover {
        background-color: rgba(255, 255, 255, 0.08) !important;
        color: #ffe066 !important;
        transform: translateX(5px) !important;
      }
      
      .navbar-collapse .dropdown-item:active {
        background-color: rgba(255, 255, 255, 0.15) !important;
        color: #ffe066 !important;
      }
      
      /* Active dropdown styling */
      .navbar-collapse .dropdown.show .dropdown-toggle {
        background: linear-gradient(135deg, rgba(255, 224, 102, 0.15) 0%, rgba(255, 224, 102, 0.25) 100%) !important;
        color: #ffe066 !important;
        border-radius: 8px !important;
        box-shadow: 0 2px 8px rgba(255, 224, 102, 0.2) !important;
        font-weight: 600 !important;
      }
      
      .navbar-collapse .dropdown-toggle::after {
        transition: transform 0.3s ease !important;
        margin-left: 0.5rem !important;
        font-size: 0.8rem !important;
      }
      
      .navbar-collapse .dropdown.show .dropdown-toggle::after {
        transform: rotate(180deg) !important;
      }
      
      /* Dropdown divider */
      .navbar-collapse .dropdown-divider {
        border-top: 1px solid rgba(255, 255, 255, 0.1) !important;
        margin: 0.5rem 0 !important;
      }
      
      /* Ensure Admin menu is visible */
      .navbar-collapse .nav-item:last-child {
        margin-bottom: 0;
        padding-bottom: 0.5rem;
      }
      
      /* Add spacing between dropdown and next menu item */
      .navbar-collapse .dropdown + .nav-item {
        margin-top: 1rem;
      }
      
      /* Force dropdown visibility on mobile */
      @media (max-width: 991.98px) {
        .navbar-collapse .dropdown-menu {
          display: none !important;
          opacity: 0 !important;
          visibility: hidden !important;
          transform: translateY(-10px) !important;
          transition: all 0.3s ease !important;
        }
        
        .navbar-collapse .dropdown-menu.show {
          display: block !important;
          opacity: 1 !important;
          visibility: visible !important;
          transform: translateY(0) !important;
        }
        
        .navbar-collapse .dropdown.show .dropdown-menu {
          display: block !important;
          opacity: 1 !important;
          visibility: visible !important;
          transform: translateY(0) !important;
        }
        
        /* Smooth animation for dropdown items */
        .navbar-collapse .dropdown-item {
          opacity: 0;
          transform: translateX(-10px);
          transition: all 0.3s ease;
        }
        
        .navbar-collapse .dropdown-menu.show .dropdown-item {
          opacity: 1;
          transform: translateX(0);
        }
        
        .navbar-collapse .dropdown-menu.show .dropdown-item:nth-child(1) { transition-delay: 0.1s; }
        .navbar-collapse .dropdown-menu.show .dropdown-item:nth-child(2) { transition-delay: 0.15s; }
        .navbar-collapse .dropdown-menu.show .dropdown-item:nth-child(3) { transition-delay: 0.2s; }
        .navbar-collapse .dropdown-menu.show .dropdown-item:nth-child(4) { transition-delay: 0.25s; }
        .navbar-collapse .dropdown-menu.show .dropdown-item:nth-child(5) { transition-delay: 0.3s; }
      }
    }
    </style>

    <!-- Arsha CSS -->
    <link href="{{ asset('arsha/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('arsha/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('arsha/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('arsha/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('arsha/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('arsha/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('arsha/assets/css/main.css') }}" rel="stylesheet">
</head>
<body>
    @php
      $hideNavbar = (
        Request::is('tabel-surat*') ||
        Request::routeIs('user.sktm.index') ||
        Request::routeIs('sdu.index') ||
        Request::routeIs('sd.index') ||
        Request::routeIs('sk.index') ||
        Request::routeIs('skbm.index') ||
        Request::is('*sktm*') ||
        Request::is('*sdu*') ||
        Request::is('*sd*') ||
        Request::is('*sk*') ||
        Request::is('*skbm*') ||
        Request::is('login') ||
        Request::is('register')
      );
    @endphp
    @if(!$hideNavbar)
    <!-- Navbar Responsive -->
    <nav class="navbar navbar-expand-lg navbar-custom shadow-sm sticky-top" style="z-index:1040;">
      <div class="container-fluid px-4">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="/">
          <img src="{{ asset('img/logo-jambi.png') }}" alt="Logo" width="36" height="36" class="me-2" style="object-fit:contain; background: transparent !important; filter: drop-shadow(0 1px 3px rgba(0,0,0,0.1));">
          Kelurahan
        </a>
        <div class="d-flex align-items-center">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <button class="btn-close-navbar ms-2 d-none" type="button" aria-label="Close navigation">
            <span class="btn-close-icon">×</span>
          </button>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center gap-lg-2">
            <li class="nav-item">
              <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/#profil">Profil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/#struktur">Struktur Organisasi</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/#layanan">Layanan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/#berita">Berita</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/#galeri">Galeri</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/#contact">Kontak</a>
            </li>
            <!-- Dropdown Tabel Surat -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="tabelSuratDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Tabel Surat
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="tabelSuratDropdown">
                <li><a class="dropdown-item" href="{{ route('user.sktm.index') }}">Tabel Surat Keterangan Tidak Mampu</a></li>
                <li><a class="dropdown-item" href="{{ route('sdu.index') }}">Tabel Surat Domisili Usaha</a></li>
                <li><a class="dropdown-item" href="{{ route('sd.index') }}">Tabel Surat Domisili</a></li>
                <li><a class="dropdown-item" href="{{ route('sk.index') }}">Tabel Surat Kematian</a></li>
                <li><a class="dropdown-item" href="{{ route('skbm.index') }}">Tabel Surat Keterangan Belum Menikah</a></li>
              </ul>
            </li>
            <!-- Dropdown Pengajuan Surat -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="pengajuanSuratDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Pengajuan Surat
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="pengajuanSuratDropdown">
                <li><a class="dropdown-item" href="{{ route('sktm.create') }}">Surat Keterangan Tidak Mampu</a></li>
                <li><a class="dropdown-item" href="{{ route('sdu.create') }}">Surat Domisili Usaha</a></li>
                <li><a class="dropdown-item" href="{{ route('sd.create') }}">Surat Domisili</a></li>
                <li><a class="dropdown-item" href="{{ route('sk.create') }}">Surat Kematian</a></li>
                <li><a class="dropdown-item" href="{{ route('skbm.create') }}">Surat keterangan Belum Menikah</a></li>
              </ul>
            </li>
            @auth
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  {{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profil</a></li>
                  @if(Auth::user()->role === 'admin')
                    <li><a class="dropdown-item" href="/admin/dashboard">Admin Panel</a></li>
                  @endif
                  <li><hr class="dropdown-divider"></li>
                  <li>
                    <form method="POST" action="{{ route('logout') }}">
                      @csrf
                      <button class="dropdown-item" type="submit">Logout</button>
                    </form>
                  </li>
                </ul>
              </li>
            @else
              <li class="nav-item">
                <a class="nav-link btn btn-outline-primary px-3 py-1 ms-lg-2" href="{{ route('login') }}">Login</a>
              </li>
            @endauth
          </ul>
        </div>
      </div>
    </nav>
    @endif
    @yield('content')

    <!-- Arsha JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('arsha/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('arsha/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('arsha/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('arsha/assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
    <script src="{{ asset('arsha/assets/js/main.js') }}"></script>
    
    <!-- Fix Hamburger Menu -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
      var navbarCollapse = document.querySelector('.navbar-collapse');
      var navbarToggler = document.querySelector('.navbar-toggler');
      var btnCloseNavbar = document.querySelector('.btn-close-navbar');
      
      // Auto close navbar when clicking on nav links (excluding dropdown toggles)
      var navLinks = document.querySelectorAll('.navbar-collapse .nav-link:not(.dropdown-toggle)');
      navLinks.forEach(function(link) {
        link.addEventListener('click', function() {
          if (navbarCollapse.classList.contains('show')) {
            var bsCollapse = new bootstrap.Collapse(navbarCollapse, {toggle: false});
            bsCollapse.hide();
            toggleCloseButton(false);
          }
        });
      });
      
      // Auto close navbar when clicking on dropdown items
      var dropdownItems = document.querySelectorAll('.navbar-collapse .dropdown-item');
      dropdownItems.forEach(function(item) {
        item.addEventListener('click', function() {
          if (navbarCollapse.classList.contains('show')) {
            var bsCollapse = new bootstrap.Collapse(navbarCollapse, {toggle: false});
            bsCollapse.hide();
            toggleCloseButton(false);
          }
        });
      });
      
      // Show/hide close button based on navbar state
      function toggleCloseButton(show) {
        if (show) {
          btnCloseNavbar.classList.remove('d-none');
          navbarToggler.classList.add('d-none');
        } else {
          btnCloseNavbar.classList.add('d-none');
          navbarToggler.classList.remove('d-none');
        }
      }
      
      // Listen for navbar show/hide events
      navbarCollapse.addEventListener('shown.bs.collapse', function() {
        toggleCloseButton(true);
      });
      
      navbarCollapse.addEventListener('hidden.bs.collapse', function() {
        toggleCloseButton(false);
      });
      
      // Close button functionality
      btnCloseNavbar.addEventListener('click', function() {
        var bsCollapse = new bootstrap.Collapse(navbarCollapse, {toggle: false});
        bsCollapse.hide();
        toggleCloseButton(false);
      });
      
      // Ensure dropdowns work properly on mobile
      var dropdownToggles = document.querySelectorAll('.navbar-collapse .dropdown-toggle');
      console.log('Found dropdown toggles:', dropdownToggles.length);
      
      dropdownToggles.forEach(function(toggle) {
        toggle.addEventListener('click', function(e) {
          console.log('Dropdown toggle clicked!');
          e.preventDefault();
          e.stopPropagation();
          
          var dropdown = this.closest('.dropdown');
          var dropdownMenu = dropdown.querySelector('.dropdown-menu');
          
          console.log('Dropdown:', dropdown);
          console.log('Dropdown menu:', dropdownMenu);
          
          // Close other dropdowns
          var otherDropdowns = document.querySelectorAll('.navbar-collapse .dropdown.show');
          otherDropdowns.forEach(function(otherDropdown) {
            if (otherDropdown !== dropdown) {
              otherDropdown.classList.remove('show');
              otherDropdown.querySelector('.dropdown-menu').classList.remove('show');
            }
          });
          
          // Toggle current dropdown
          dropdown.classList.toggle('show');
          dropdownMenu.classList.toggle('show');
          
          console.log('Dropdown show class:', dropdown.classList.contains('show'));
          console.log('Dropdown menu show class:', dropdownMenu.classList.contains('show'));
        });
      });
    });
    </script>
</body>
</html>
