<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PembangunanProyek')</title>

    <!-- Start CSS -->
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Sweet Alert -->
    <link type="text/css" href="{{ asset('assets-admin/vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
    
    <!-- Notyf -->
    <link type="text/css" href="{{ asset('assets-admin/vendor/notyf/notyf.min.css') }}" rel="stylesheet">
    
    <!-- Volt CSS -->
    <link type="text/css" href="{{ asset('assets-admin/css/volt.css') }}" rel="stylesheet">
    
    <!-- NOTICE: You can use the _analytics.html partial to include production code specific code & trackers -->
    <!-- End CSS -->

    <style>
        /* ======== Global Styles ======== */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            color: #333;
            scroll-behavior: smooth;
            margin: 0;
            padding: 0;
        }

        h1, h2, h3, h4, h5 {
            font-weight: 600;
        }

        a {
            text-decoration: none;
            transition: all 0.3s ease;
        }

        /* ======== Navbar ======== */
        .main-navbar {
            background: #ffffff !important;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
            padding: 12px 0;
            margin: 0;
        }

        .navbar-brand h1 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #0d6efd;
            margin: 0;
        }

        .main-navbar .nav-link {
            color: #333 !important;
            font-weight: 500;
            margin: 0 10px;
            border-bottom: 3px solid transparent;
            transition: all 0.25s ease;
            padding-bottom: 6px;
        }

        .main-navbar .nav-link:hover {
            color: #0d6efd !important;
            border-bottom: 3px solid #adb5bd;
        }

        .main-navbar .nav-link.active {
            color: #0d6efd !important;
            border-bottom: 3px solid #0d6efd;
            font-weight: 600;
        }

        /* ======== Hero Section ======== */
        .hero {
            background: linear-gradient(135deg, #0d6efd 0%, #4dabf7 100%);
            color: #fff;
            text-align: center;
            padding: 90px 20px 100px;
            border-radius: 0 0 35px 35px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-top: 0;
        }

        .hero h1 {
            font-size: 2.6rem;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .hero p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        /* ======== Main Content ======== */
        .main-content {
            min-height: 70vh;
            padding: 40px 0;
        }

        /* ======== Footer ======== */
        footer {
            background: #ffffff;
            box-shadow: 0 -3px 10px rgba(0,0,0,0.05);
            padding: 25px 0;
            text-align: center;
            color: #6c757d;
            font-size: 14px;
            margin-top: 0;
        }

        footer a {
            color: #0d6efd;
            font-weight: 500;
        }

        footer a:hover {
            text-decoration: underline;
        }

        /* ======== Modal Search ======== */
        .modal-content {
            border-radius: 16px;
            border: none;
            box-shadow: 0 5px 25px rgba(0,0,0,0.2);
        }

        .modal-body input {
            border-radius: 10px;
            padding: 14px 18px;
        }

        /* ======== Buttons ======== */
        .btn-primary {
            background-color: #0d6efd;
            border: none;
            border-radius: 8px;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
            transform: translateY(-2px);
        }

        .btn:active {
            transform: scale(0.97);
        }

        /* ======== Animation ======== */
        .fade-in {
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ======== Fix Layout Issues ======== */
        .content {
            margin: 0;
            padding: 0;
        }

        .py-4 {
            padding-top: 0 !important;
            padding-bottom: 0 !important;
        }
    </style>

    @stack('styles')
</head>
<body>

    <!-- start sidebar -->
    <!-- Sidebar untuk mobile - DISEMBUNYIKAN KARENA TIDAK DIPAKAI -->
    <nav class="navbar navbar-dark navbar-theme-primary px-4 col-12 d-lg-none d-none">
        <!-- Sidebar mobile content -->
    </nav>

    <!-- Sidebar utama - DISEMBUNYIKAN KARENA TIDAK DIPAKAI -->
    <nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse d-none" data-simplebar>
        <!-- Sidebar content -->
    </nav>
    <!-- end sidebar -->

    <main class="content">
        <!-- start header - HEADER UTAMA KITA PAKAI YANG DIBAWAH -->
        <nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark ps-0 pe-2 pb-0 d-none">
            <!-- Header content - DISEMBUNYIKAN -->
        </nav>
        <!-- end header -->

        <!-- start main content -->
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-0">
            <!-- Main content area -->
            <div class="container-fluid p-0">
                
                <!-- NAVBAR UTAMA -->
                <nav class="navbar navbar-expand-lg sticky-top main-navbar">
                    <div class="container">
                        <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center">
                            <i class="fas fa-building text-primary me-2"></i>
                            <h1>PembangunanProyek</h1>
                        </a>

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                            <span class="fa fa-bars text-dark"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarCollapse">
                            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                                <li><a href="{{ route('home') }}" class="nav-link {{ Request::is('/') ? 'active' : '' }}">Proyek</a></li>
                                <li><a href="{{ route('tahapan') }}" class="nav-link {{ Request::is('tahapan') ? 'active' : '' }}">Tahapan</a></li>
                                <li><a href="{{ route('progres') }}" class="nav-link {{ Request::is('progres') ? 'active' : '' }}">Progres</a></li>
                                <li><a href="{{ route('lokasi') }}" class="nav-link {{ Request::is('lokasi') ? 'active' : '' }}">Lokasi</a></li>
                                <li><a href="{{ route('kontraktor') }}" class="nav-link {{ Request::is('kontraktor') ? 'active' : '' }}">Kontraktor</a></li>
                                <li><a href="{{ route('contact') }}" class="nav-link {{ Request::is('contact') ? 'active' : '' }}">Kontak</a></li>
                                <li><a href="{{ route('login.index') }}" class="nav-link {{ Request::is('login') ? 'active' : '' }}">Login</a></li>

                            </ul>

                            <div class="d-flex align-items-center ms-lg-3">
                                <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#searchModal">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </nav>

                <!-- Hero Section -->
                <section class="hero fade-in">
                    <h1>@yield('title', 'Selamat Datang di PembangunanProyek')</h1>
                    <p>Membangun masa depan dengan inovasi, kualitas, dan kepercayaan.</p>
                </section>

                <!-- Main Content -->
                <div class="main-content fade-in">
                    <div class="container">
                        @yield('content')
                    </div>
                </div>

            </div>
        </div>
        <!-- end main content -->

    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>© {{ date('Y') }} <strong>PembangunanProyek</strong>. Semua Hak Dilindungi.</p>
            <p>
                <a href="{{ route('contact') }}">Hubungi Kami</a> •
                <a href="{{ route('tahapan') }}">Tahapan Proyek</a>
            </p>
        </div>
    </footer>

    <!-- Search Modal -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3">
                <div class="modal-header border-0">
                    <h5 class="modal-title"><i class="fas fa-search me-2 text-primary"></i>Cari Sesuatu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <input type="text" class="form-control form-control-lg" placeholder="Masukkan kata kunci...">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Sweet Alert -->
    <script src="{{ asset('assets-admin/vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    
    <!-- Notyf -->
    <script src="{{ asset('assets-admin/vendor/notyf/notyf.min.js') }}"></script>
    
    <!-- Volt JS -->
    <script src="{{ asset('assets-admin/js/volt.js') }}"></script>

    @stack('scripts')
</body>
</html>