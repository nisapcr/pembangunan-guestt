<nav class="navbar navbar-expand-lg sticky-top main-navbar">
    <div class="container">
        <!-- Logo dengan teks -->
        <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center">
            <!-- Logo bulat -->
            <div class="logo-container me-3">
                <img src="{{ asset('img/logo.png') }}" alt="Logo Pembangunan Proyek" class="rounded-circle logo-image">
            </div>

            <!-- Teks brand -->
            <div class="brand-text">
                <h2 class="brand-subtitle">Pembangunan</h2>
                <h2 class="brand-subtitle">Proyek</h2>
            </div>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars text-dark"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                <!-- HOME/BERANDA - Always Public -->
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ Request::is('/') ? 'active' : '' }}">
                        <i class="fas fa-home me-1"></i>Beranda
                    </a>
                </li>

                <!-- TENTANG - Always Public -->
                <li class="nav-item">
                    <a href="{{ route('tentang') }}" class="nav-link {{ Request::is('tentang*') ? 'active' : '' }}">
                        <i class="fas fa-info-circle me-1"></i>Tentang
                    </a>
                </li>

                <!-- IDENTITAS - Always Public -->
                <li class="nav-item">
                    <a href="{{ route('identitas') }}" class="nav-link {{ Request::is('identitas*') ? 'active' : '' }}">
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

                    <!-- DROPDOWN DATA WARGA & USER (Hanya untuk admin) -->
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
                                    <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center">
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
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                    onclick="return confirm('Apakah Anda yakin ingin logout?')">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                @else
                    <!-- Untuk non-login user -->
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link {{ Request::is('login') ? 'active' : '' }}">
                            <i class="fas fa-sign-in-alt me-1"></i>Login
                        </a>
                    </li>

                    <!-- Register menu -->
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
        padding: 4px 0;
        z-index: 1030;
        font-size: 0.68rem;
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

    /* BRAND TEXT */
    .brand-text {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .brand-subtitle {
        font-size: 0.8rem;
        font-weight: 600;
        color: #2c3e50;
        margin: 0;
        line-height: 1.2;
        opacity: 0.9;
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
        font-size: 0.7rem;
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
        font-size: 0.6rem;
    }

    /* DROPDOWN MENU */
    .dropdown-menu {
        border: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        padding: 6px 0;
        min-width: 200px;
        margin-top: 8px;
        z-index: 1050;
        font-size: 0.85rem;
    }

    .dropdown-item {
        padding: 8px 16px;
        color: #555;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        font-size: 0.85rem;
        cursor: pointer;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa;
        color: #007bff;
    }

    .dropdown-item.active {
        background-color: #007bff;
        color: white;
    }

    /* LOGOUT BUTTON STYLING */
    .dropdown-item.text-danger {
        color: #dc3545 !important;
    }

    .dropdown-item.text-danger:hover {
        background-color: rgba(220, 53, 69, 0.1);
        color: #dc3545 !important;
    }

    /* Hapus border dan background dari button logout */
    .dropdown-item.border-0.bg-transparent {
        padding: 8px 16px;
        border-radius: 0;
        text-align: left;
    }

    .dropdown-item.border-0.bg-transparent:hover {
        background-color: #f8f9fa !important;
    }

    /* USER DROPDOWN */
    .user-name {
        font-weight: 500;
        max-width: 130px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        font-size: 0.8rem;
    }

    .avatar-sm img,
    .avatar-sm div {
        width: 32px;
        height: 32px;
        object-fit: cover;
    }

    .avatar-sm div {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
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
        }

        .nav-link:last-child {
            border-bottom: none;
        }

        .dropdown-menu {
            border: 1px solid #f1f1f1;
            box-shadow: none;
            margin-left: 15px;
            margin-top: 5px;
        }

        /* Pastikan form logout responsive */
        .dropdown-item.border-0.bg-transparent {
            width: 100%;
        }
    }

    @media (max-width: 576px) {
        .brand-text {
            display: none;
        }

        .logo-container {
            margin-right: 0;
        }
    }

    /* Animasi untuk logo */
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
        const logoutForms = document.querySelectorAll('form[action="{{ route('logout') }}"]');
        logoutForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Apakah Anda yakin ingin logout?')) {
                    e.preventDefault();
                    e.stopPropagation();
                    return false;
                }
            });
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

        // Close dropdown ketika klik di luar di mobile
        document.addEventListener('click', function(e) {
            if (window.innerWidth < 992) {
                if (!e.target.closest('.nav-item.dropdown')) {
                    const openDropdowns = document.querySelectorAll('.dropdown-menu.show');
                    openDropdowns.forEach(menu => {
                        menu.classList.remove('show');
                    });
                }
            }
        });

        // Efek klik pada logo (opsional)
        const logoContainer = document.querySelector('.logo-container');
        if (logoContainer) {
            logoContainer.addEventListener('click', function(e) {
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
