<nav class="navbar navbar-expand-lg sticky-top main-navbar">
    <div class="container">
        <!-- Logo dengan teks -->
        <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center">
            <!-- Logo bulat -->
            <div class="logo-container me-3">
                <img src="{{ asset('img/logo.png') }}"
                     alt="Logo Pembangunan Proyek"
                     class="rounded-circle logo-image">
            </div>

            <!-- Teks brand -->
            <div class="brand-text">
                <h2 class="brand-subtitle">Pembangunan</h2>
                <h2 class="brand-subtitle">Proyek</h2>
            </div>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarCollapse">
            <span class="fa fa-bars text-dark"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                <!-- HOME/BERANDA - Always Public -->
                <li class="nav-item">
                    <a href="{{ route('home') }}"
                        class="nav-link {{ Request::is('/') ? 'active' : '' }}">
                        <i class="fas fa-home me-1"></i>Beranda
                    </a>
                </li>

                <!-- TENTANG - Always Public -->
                <li class="nav-item">
                    <a href="{{ route('tentang') }}"
                        class="nav-link {{ Request::is('tentang*') ? 'active' : '' }}">
                        <i class="fas fa-info-circle me-1"></i>Tentang
                    </a>
                </li>

                <!-- IDENTITAS - Always Public (Pindahkan ke sini) -->
                <li class="nav-item">
                    <a href="{{ route('identitas') }}"
                        class="nav-link {{ Request::is('identitas*') ? 'active' : '' }}">
                        <i class="fas fa-user-circle me-1"></i>Identitas
                    </a>
                </li>

                <!-- MENU HANYA UNTUK USER YANG LOGIN -->
                @auth
                    <!-- Menu Proyek -->
                    <li class="nav-item">
                        <a href="{{ route('proyek.index') }}"
                            class="nav-link {{ Request::is('proyek*') && !Request::is('proyek/*/files*') ? 'active' : '' }}">
                            <i class="fas fa-project-diagram me-1"></i>Proyek
                        </a>
                    </li>

                    <!-- Menu Tahapan -->
                    <li class="nav-item">
                        <a href="{{ route('tahapan.index') }}"
                            class="nav-link {{ Request::is('tahapan*') ? 'active' : '' }}">
                            <i class="fas fa-tasks me-1"></i>Tahapan
                        </a>
                    </li>

                    <!-- Menu Progres -->
                    <li class="nav-item">
                        <a href="{{ route('progres.index') }}"
                            class="nav-link {{ Request::is('progres*') ? 'active' : '' }}">
                            <i class="fas fa-chart-line me-1"></i>Progres
                        </a>
                    </li>

                    <!-- Menu Lokasi -->
                    <li class="nav-item">
                        <a href="{{ route('lokasi.index') }}"
                            class="nav-link {{ Request::is('lokasi*') ? 'active' : '' }}">
                            <i class="fas fa-map-marker-alt me-1"></i>Lokasi
                        </a>
                    </li>

                    <!-- Menu Kontraktor -->
                    <li class="nav-item">
                        <a href="{{ route('kontraktor.index') }}"
                            class="nav-link {{ Request::is('kontraktor*') ? 'active' : '' }}">
                            <i class="fas fa-hard-hat me-1"></i>Kontraktor
                        </a>
                    </li>

                    <!-- DROPDOWN DATA WARGA & USER (Hanya untuk admin/superadmin) -->
                    @if (in_array(Auth::user()->role, ['superadmin', 'admin']))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ Request::is('warga*') || Request::is('users*') ? 'active' : '' }}"
                                href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-database me-1"></i>Data
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item {{ Request::is('warga*') ? 'active' : '' }}"
                                        href="{{ route('warga.index') }}">
                                        <i class="fas fa-users me-2"></i>Daftar Warga
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ Request::is('users*') ? 'active' : '' }}"
                                        href="{{ route('users.index') }}">
                                        <i class="fas fa-user-cog me-2"></i>Daftar Pengguna
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    <!-- USER MENU DROPDOWN -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                            data-bs-toggle="dropdown">
                            <div class="avatar-sm me-2">
                                @if (Auth::user()->profile_picture)
                                    <img src="{{ asset('storage/profile_pictures/' . Auth::user()->profile_picture) }}"
                                        alt="{{ Auth::user()->name }}" class="rounded-circle">
                                @else
                                    <div
                                        class="rounded-circle bg-primary d-flex align-items-center justify-content-center">
                                        <span
                                            class="text-white fw-bold">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                                    </div>
                                @endif
                            </div>
                            <span class="user-name">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('dashboard') }}">
                                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('users.edit', Auth::user()->id) }}">
                                    <i class="fas fa-user-edit me-2"></i>Edit Profil
                                </a>
                            </li>
                            @if (in_array(Auth::user()->role, ['superadmin', 'admin']))
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                            @endif
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                                <a class="dropdown-item text-danger" href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                @else
                    <!-- Untuk non-login user: Hanya tampilkan Beranda, Tentang, dan Login -->

                    <!-- Login menu -->
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link {{ Request::is('login') ? 'active' : '' }}">
                            <i class="fas fa-sign-in-alt me-1"></i>Login
                        </a>
                    </li>

                    <!-- Register menu (optional) -->
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a href="{{ route('register') }}"
                                class="nav-link {{ Request::is('register') ? 'active' : '' }}">
                                <i class="fas fa-user-plus me-1"></i>Register
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- CSS untuk styling -->
<style>
    /* NAVBAR UTAMA */
    .main-navbar {
        background-color: #ffffff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 8px 0;
        z-index: 1030;
        font-size: 0.875rem;
    }

    /* LOGO CONTAINER */
    .logo-container {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    /* LOGO BULAT */
    .logo-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #007bff;
        padding: 3px;
        background-color: white;
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
        transition: all 0.3s ease;
    }

    /* Efek hover pada logo */
    .navbar-brand:hover .logo-image {
        transform: scale(1.05) rotate(5deg);
        border-color: #0056b3;
        box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
    }

    /* Efek glow saat hover */
    .logo-container::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(0,123,255,0.2) 0%, transparent 70%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .navbar-brand:hover .logo-container::after {
        opacity: 1;
    }

    /* BRAND TEXT */
    .brand-text {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .brand-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1E3A5F;
        margin: 0;
        line-height: 1.2;
        letter-spacing: 0.5px;
    }

    .brand-subtitle {
        font-size: 0.95rem;
        font-weight: 600;
        color: #2c3e50;
        margin: 0;
        line-height: 1.2;
        opacity: 0.9;
    }

    /* Efek hover pada teks */
    .navbar-brand:hover .brand-title {
        color: #007bff;
    }

    .navbar-brand:hover .brand-subtitle {
        opacity: 1;
    }

    /* NAV LINK */
    .nav-link {
        font-weight: 500;
        color: #555 !important;
        padding: 8px 12px !important;
        border-radius: 5px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        font-size: 0.85rem;
        margin: 0 2px;
    }

    .nav-link:hover,
    .nav-link.active {
        color: #007bff !important;
        background-color: rgba(0, 123, 255, 0.1);
    }

    .nav-link i {
        width: 16px;
        text-align: center;
        font-size: 0.9rem;
    }

    /* DROPDOWN MENU */
    .dropdown-menu {
        border: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        padding: 6px 0;
        min-width: 180px;
        margin-top: 8px;
        z-index: 1050;
        font-size: 0.85rem;
    }

    .dropdown-item {
        padding: 8px 14px;
        color: #555;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        font-size: 0.85rem;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa;
        color: #007bff;
    }

    .dropdown-item.active {
        background-color: #007bff;
        color: white;
    }

    .dropdown-divider {
        margin: 5px 0;
    }

    /* USER DROPDOWN */
    .nav-link.dropdown-toggle {
        padding: 6px 10px !important;
    }

    .user-name {
        font-weight: 500;
        max-width: 130px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        font-size: 0.85rem;
    }

    .avatar-sm {
        flex-shrink: 0;
    }

    /* AVATAR STYLING */
    .avatar-sm img,
    .avatar-sm div {
        width: 28px;
        height: 28px;
        object-fit: cover;
    }

    .avatar-sm div {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.85rem;
    }

    /* HIGHLIGHT MENU AKTIF */
    .nav-link.active {
        position: relative;
    }

    .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 12px;
        right: 12px;
        height: 2px;
        background-color: #007bff;
        border-radius: 1px;
    }

    /* NAVBAR TOGGLER */
    .navbar-toggler {
        border: none;
        padding: 0;
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .navbar-toggler:focus {
        box-shadow: none;
        outline: none;
    }

    .navbar-toggler .fa-bars {
        font-size: 1.1rem;
    }

    /* ANIMASI DROPDOWN */
    .dropdown-menu {
        animation: fadeIn 0.2s ease;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-5px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* RESPONSIVE */
    @media (max-width: 992px) {
        .navbar-collapse {
            background-color: white;
            padding: 12px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-top: 8px;
        }

        .nav-link {
            padding: 10px 0 !important;
            border-bottom: 1px solid #f1f1f1;
            justify-content: flex-start;
            font-size: 0.85rem;
        }

        .nav-link:last-child {
            border-bottom: none;
        }

        .nav-link.dropdown-toggle {
            justify-content: space-between;
        }

        .dropdown-menu {
            border: 1px solid #f1f1f1;
            box-shadow: none;
            margin-left: 0;
            margin-top: 5px;
            position: static !important;
            transform: none !important;
        }

        .user-name {
            max-width: 100px;
        }

        /* Responsive untuk logo dan teks */
        .logo-container {
            width: 50px;
            height: 50px;
        }

        .brand-title {
            font-size: 1rem;
        }

        .brand-subtitle {
            font-size: 0.85rem;
        }
    }

    @media (max-width: 768px) {
        .logo-container {
            width: 45px;
            height: 45px;
        }

        .brand-title {
            font-size: 0.9rem;
        }

        .brand-subtitle {
            font-size: 0.8rem;
        }

        /* Sembunyikan teks brand di mobile yang sangat kecil */
        @media (max-width: 576px) {
            .brand-text {
                display: none;
            }

            .logo-container {
                margin-right: 0;
            }
        }
    }

    /* Efek hover yang lebih smooth */
    .nav-link {
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .dropdown-item {
        transition: all 0.15s ease;
    }

    /* Dropdown arrow styling */
    .dropdown-toggle::after {
        font-size: 0.75rem;
        vertical-align: middle;
        margin-left: 4px;
    }

    /* Ikon dropdown di dalam menu */
    .dropdown-item i {
        font-size: 0.9rem;
        width: 18px;
    }

    /* Text truncation untuk nama panjang */
    .text-truncate-custom {
        max-width: 180px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        display: inline-block;
        vertical-align: middle;
    }

    /* Animasi untuk logo saat page load */
    @keyframes logoAppear {
        from {
            transform: scale(0.8);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    .logo-image {
        animation: logoAppear 0.5s ease-out;
    }
</style>

<!-- JavaScript untuk logout confirmation -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Logout dengan konfirmasi
        const logoutLinks = document.querySelectorAll('.dropdown-item.text-danger');
        logoutLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                if (!confirm('Apakah Anda yakin ingin logout?')) {
                    e.preventDefault();
                    e.stopPropagation();
                    return false;
                }
            });
        });

        // Aktifkan dropdown hover di desktop
        if (window.innerWidth >= 992) {
            const dropdowns = document.querySelectorAll('.nav-item.dropdown');
            dropdowns.forEach(dropdown => {
                let hideTimeout;

                dropdown.addEventListener('mouseenter', function() {
                    clearTimeout(hideTimeout);
                    const toggle = this.querySelector('.dropdown-toggle');
                    if (toggle) {
                        const bsDropdown = bootstrap.Dropdown.getInstance(toggle) ||
                            new bootstrap.Dropdown(toggle);
                        bsDropdown.show();
                    }
                });

                dropdown.addEventListener('mouseleave', function() {
                    const toggle = this.querySelector('.dropdown-toggle');
                    if (toggle) {
                        hideTimeout = setTimeout(() => {
                            const bsDropdown = bootstrap.Dropdown.getInstance(toggle);
                            if (bsDropdown) {
                                bsDropdown.hide();
                            }
                        }, 200);
                    }
                });
            });
        }

        // Close dropdown ketika klik di luar
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.nav-item.dropdown')) {
                const openDropdowns = document.querySelectorAll(
                    '.nav-item.dropdown .dropdown-toggle[aria-expanded="true"]');
                openDropdowns.forEach(toggle => {
                    const bsDropdown = bootstrap.Dropdown.getInstance(toggle);
                    if (bsDropdown) {
                        bsDropdown.hide();
                    }
                });
            }
        });

        // Mobile menu close ketika pilih item
        const navLinks = document.querySelectorAll('.navbar-collapse .nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                const navbarCollapse = document.querySelector('.navbar-collapse');
                if (navbarCollapse.classList.contains('show')) {
                    const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse);
                    if (bsCollapse) {
                        bsCollapse.hide();
                    }
                }
            });
        });

        // Tambahkan kelas active untuk dropdown parent
        const activeDropdownItems = document.querySelectorAll('.dropdown-item.active');
        activeDropdownItems.forEach(item => {
            const parentDropdown = item.closest('.nav-item.dropdown');
            if (parentDropdown) {
                const dropdownToggle = parentDropdown.querySelector('.dropdown-toggle');
                if (dropdownToggle) {
                    dropdownToggle.classList.add('active');
                }
            }
        });

        // Efek klik pada logo
        const logoContainer = document.querySelector('.logo-container');
        if (logoContainer) {
            logoContainer.addEventListener('click', function(e) {
                // Tambahkan efek ripple
                const ripple = document.createElement('div');
                ripple.style.position = 'absolute';
                ripple.style.borderRadius = '50%';
                ripple.style.backgroundColor = 'rgba(0, 123, 255, 0.3)';
                ripple.style.transform = 'scale(0)';
                ripple.style.animation = 'ripple 0.6s linear';
                ripple.style.width = '100%';
                ripple.style.height = '100%';
                ripple.style.top = '0';
                ripple.style.left = '0';
                ripple.style.zIndex = '1';

                this.appendChild(ripple);

                // Hapus elemen ripple setelah animasi selesai
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        }

        // Tambahkan style untuk efek ripple
        const style = document.createElement('style');
        style.textContent = '@keyframes ripple { to { transform: scale(2); opacity: 0; } }';
        document.head.appendChild(style);
    });
</script>
