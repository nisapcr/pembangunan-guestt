<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PembangunanProyek')</title>

    <!-- Start CSS -->
    <!-- Bootstrap -->
    @include('layouts.guest.css')

    @stack('styles')
</head>

<body>

    <!-- start sidebar -->
    <!-- Sidebar untuk mobile - DISEMBUNYIKAN KARENA TIDAK DIPAKAI -->

    <!-- Sidebar utama - DISEMBUNYIKAN KARENA TIDAK DIPAKAI -->
    @include('layouts.guest.sidebar')
    <!-- end sidebar -->

    <main class="content">
        <!-- start header - HEADER UTAMA KITA PAKAI YANG DIBAWAH -->

        <!-- end header -->

        <!-- start main content -->
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-0">
            <!-- Main content area -->
            <div class="container-fluid p-0">

                <!-- NAVBAR UTAMA -->
                @include('layouts.guest.navbar')

                <!-- Hero Section -->
                <section class="hero fade-in">
                    <h1>@yield('title', 'Beranda PembangunanProyek')</h1>
                    <p>Membangun masa depan dengan inovasi, kualitas, dan kepercayaan.</p>
                </section>
                <br>
                <!-- Main Content -->
                @yield('content')

            </div>
        </div>
        <!-- end main content -->

    </main>

    <!-- Footer -->
    @include('layouts.guest.footer')

    <!-- Floating WhatsApp Button -->
    <div class="floating-wa">
        <a href="https://wa.me/6285263992821?text=Halo,%20saya%20ingin%20konsultasi%20tentang%20proyek%20pembangunan%20di%20PembangunanProyek"
            target="_blank" class="wa-float" title="Konsultasi via WhatsApp">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>

    <!-- Bootstrap JS -->
    @include('layouts.guest.js')
    @stack('scripts')
</body>

</html>
