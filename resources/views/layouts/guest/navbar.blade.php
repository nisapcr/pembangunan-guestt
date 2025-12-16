<nav class="navbar navbar-expand-lg sticky-top main-navbar">
    <div class="container">
        <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center">
            <!-- Logo Horizontal untuk Navbar -->
            <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center">
                <svg class="logo-navbar" width="200" height="60" viewBox="0 0 400 120"
                    xmlns="http://www.w3.org/2000/svg">
                    <!-- Icon Container -->
                    <g transform="translate(10, 10)">
                        <!-- Background Circle -->
                        <circle cx="50" cy="50" r="48" fill="#E3F2FD" />

                        <!-- Building -->
                        <rect x="30" y="55" width="25" height="35" fill="#37474F" rx="1" />
                        <rect x="33" y="60" width="4" height="4" fill="#64B5F6" />
                        <rect x="39" y="60" width="4" height="4" fill="#64B5F6" />
                        <rect x="46" y="60" width="4" height="4" fill="#64B5F6" />
                        <rect x="33" y="68" width="4" height="4" fill="#64B5F6" />
                        <rect x="39" y="68" width="4" height="4" fill="#64B5F6" />
                        <rect x="46" y="68" width="4" height="4" fill="#64B5F6" />
                        <rect x="33" y="76" width="4" height="4" fill="#64B5F6" />
                        <rect x="39" y="76" width="4" height="4" fill="#64B5F6" />
                        <rect x="46" y="76" width="4" height="4" fill="#64B5F6" />
                        <rect x="39" y="84" width="4" height="6" fill="#FFA726" />

                        <!-- Tower Crane -->
                        <line x1="60" y1="30" x2="60" y2="70" stroke="#FFA726"
                            stroke-width="3" stroke-linecap="round" />
                        <line x1="60" y1="30" x2="80" y2="30" stroke="#FFA726"
                            stroke-width="3" stroke-linecap="round" />
                        <line x1="40" y1="30" x2="60" y2="30" stroke="#FFA726"
                            stroke-width="2.5" stroke-linecap="round" />

                        <!-- Crane Cable -->
                        <line x1="70" y1="30" x2="70" y2="45" stroke="#FF6B6B"
                            stroke-width="2" stroke-linecap="round" stroke-dasharray="2,2" />
                        <rect x="67" y="45" width="6" height="4" fill="#90A4AE" rx="1" />

                        <!-- Excavator -->
                        <g transform="translate(20, 75)">
                            <rect x="0" y="10" width="15" height="6" fill="#FFA726" rx="1" />
                            <circle cx="3" cy="16" r="2.5" fill="#37474F" />
                            <circle cx="12" cy="16" r="2.5" fill="#37474F" />
                            <rect x="12" y="5" width="4" height="6" fill="#FFA726" />
                            <path d="M 16 5 L 22 2 L 24 4 L 18 7 Z" fill="#FFA726" />
                        </g>

                        <!-- Safety Helmet -->
                        <circle cx="75" cy="55" r="5" fill="#FFC107" />
                        <ellipse cx="75" cy="53" rx="6" ry="2" fill="#FFEB3B" />
                    </g>

                    <!-- Text -->
                    <text x="120" y="50" font-family="Arial, sans-serif" font-size="28" font-weight="700"
                        fill="#1E3A5F">
                        Pembangunan
                    </text>
                    <text x="120" y="78" font-family="Arial, sans-serif" font-size="28" font-weight="700"
                        fill="#1E3A5F">
                        Proyek
                    </text>
                </svg>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-dark"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                    <!-- Menu utama -->
                    <li class="nav-item">
                        <a href="{{ route('proyek.index') }}"
                            class="nav-link {{ Request::is('proyek*') && !Request::is('proyek/*/files*') ? 'active' : '' }}">
                            <i class="fas fa-project-diagram me-1"></i>Proyek
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('tahapan.index') }}"
                            class="nav-link {{ Request::is('tahapan*') ? 'active' : '' }}">
                            <i class="fas fa-tasks me-1"></i>Tahapan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('progres.index') }}"
                            class="nav-link {{ Request::is('progres*') ? 'active' : '' }}">
                            <i class="fas fa-chart-line me-1"></i>Progres
                        </a>
                    </li>

                    <!-- MENU LOKASI -->
                    <li class="nav-item">
                        <a href="{{ route('lokasi.index') }}"
                            class="nav-link {{ Request::is('lokasi*') ? 'active' : '' }}">
                            <i class="fas fa-map-marker-alt me-1"></i>Lokasi
                        </a>
                    </li>


                    <!-- MENJADI INI (tanpa kondisi): -->
                    <li class="nav-item">
                        <a href="{{ route('kontraktor.index') }}"
                            class="nav-link {{ Request::is('kontraktor*') ? 'active' : '' }}">
                            <i class="fas fa-hard-hat me-1"></i>Kontraktor
                        </a>
                    </li>

                    <!-- MENU TENTANG -->
                    @if (Route::has('tentang'))
                        <li class="nav-item">
                            <a href="{{ route('tentang') }}"
                                class="nav-link {{ Request::is('tentang*') ? 'active' : '' }}">
                                <i class="fas fa-info-circle me-1"></i>Tentang
                            </a>
                        </li>
                    @endif

                    <!-- DROPDOWN DATA WARGA & USER (Hanya untuk yang login) -->
                    @auth
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
                    @endauth

                    <!-- USER MENU / LOGIN MENU -->
                    @auth
                        <!-- User dropdown menu (saat login) -->
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
                        <!-- Login menu (saat belum login) -->
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link {{ Request::is('login') ? 'active' : '' }}">
                                <i class="fas fa-sign-in-alt me-1"></i>Login
                            </a>
                        </li>
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
        padding: 12px 0;
        z-index: 1030;
        font-size: 0.875rem;
    }

    /* LOGO STYLING */
    .logo-navbar {
        flex-shrink: 0;
        transition: transform 0.3s ease;
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
    }

    .navbar-brand:hover .logo-navbar {
        transform: scale(1.05) rotate(2deg);
    }

    /* BRAND/LOGO */
    .navbar-brand {
        font-size: 0.95rem;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .navbar-brand:hover {
        opacity: 0.9;
    }

    .navbar-brand h1 {
        font-size: 1.25rem;
        font-weight: 600;
        color: #2c3e50;
        margin: 0;
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

        .navbar-brand h1 {
            font-size: 1.1rem;
        }

        .logo-navbar {
            width: 35px;
            height: 35px;
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
    });
</script>
