<nav class="navbar navbar-expand-lg sticky-top main-navbar">
    <div class="container">
        <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center">
            <i class="fas fa-building text-primary me-2"></i>
            <h1 class="m-0">PembangunanProyek</h1>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars text-dark"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                <!-- Menu utama -->
                <li class="nav-item">
                    <a href="{{ route('proyek.index') }}"
                        class="nav-link {{ Request::is('proyek*') ? 'active' : '' }}">
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
                    <a href="{{ route('lokasi') }}"
                        class="nav-link {{ Request::is('lokasi*') ? 'active' : '' }}">
                        <i class="fas fa-map-marker-alt me-1"></i>Lokasi
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('kontraktor') }}"
                        class="nav-link {{ Request::is('kontraktor*') ? 'active' : '' }}">
                        <i class="fas fa-hard-hat me-1"></i>Kontraktor
                    </a>
                </li>

                <!-- MENU TENTANG -->
                <li class="nav-item">
                    <a href="{{ route('tentang') }}"
                        class="nav-link {{ Request::is('tentang*') ? 'active' : '' }}">
                        <i class="fas fa-info-circle me-1"></i>Tentang
                    </a>
                </li>

                <!-- DROPDOWN DATA WARGA & USER (Hanya untuk yang login) -->
                @auth
                @if(in_array(Auth::user()->role, ['superadmin', 'admin']))
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
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                        <div class="avatar-sm me-2">
                            @if(Auth::user()->profile_picture)
                                <img src="{{ asset('storage/profile_pictures/' . Auth::user()->profile_picture) }}"
                                     alt="{{ Auth::user()->name }}"
                                     class="rounded-circle" style="width: 32px; height: 32px; object-fit: cover;">
                            @else
                                <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center"
                                     style="width: 32px; height: 32px;">
                                    <span class="text-white fw-bold small">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
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
                        @if(in_array(Auth::user()->role, ['superadmin', 'admin']))
                        @endif
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
                    <a href="{{ route('login') }}"
                        class="nav-link {{ Request::is('login') ? 'active' : '' }}">
                        <i class="fas fa-sign-in-alt me-1"></i>Login
                    </a>
                </li>
                @if(Route::has('register'))
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
.main-navbar {
    background-color: #ffffff;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    padding: 15px 0;
    z-index: 1030;
}

.navbar-brand h1 {
    font-size: 1.5rem;
    font-weight: 600;
    color: #2c3e50;
    margin: 0;
}

.navbar-brand .fa-building {
    font-size: 1.8rem;
}

.nav-link {
    font-weight: 500;
    color: #555 !important;
    padding: 10px 15px !important;
    border-radius: 5px;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
}

.nav-link:hover, .nav-link.active {
    color: #007bff !important;
    background-color: rgba(0, 123, 255, 0.1);
}

.nav-link i {
    width: 18px;
    text-align: center;
}

.dropdown-menu {
    border: none;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    border-radius: 8px;
    padding: 8px 0;
    min-width: 200px;
    margin-top: 10px;
}

.dropdown-item {
    padding: 10px 16px;
    color: #555;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
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
    margin: 6px 0;
}

/* User dropdown styling */
.nav-link.dropdown-toggle {
    padding: 8px 12px !important;
}

.user-name {
    font-weight: 500;
    max-width: 150px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.avatar-sm {
    flex-shrink: 0;
}

/* Responsive */
@media (max-width: 992px) {
    .navbar-collapse {
        background-color: white;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        margin-top: 10px;
    }

    .nav-link {
        padding: 12px 0 !important;
        border-bottom: 1px solid #f1f1f1;
        justify-content: flex-start;
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
    }

    .user-name {
        max-width: 120px;
    }
}

/* Animasi dropdown */
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

/* Avatar styling */
.avatar-sm img,
.avatar-sm div {
    width: 32px;
    height: 32px;
    object-fit: cover;
}

/* Ikon menu */
.nav-link i {
    font-size: 1rem;
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
            }
        });
    });

    // Aktifkan dropdown hover di desktop
    if (window.innerWidth >= 992) {
        const dropdowns = document.querySelectorAll('.nav-item.dropdown');
        dropdowns.forEach(dropdown => {
            dropdown.addEventListener('mouseenter', function() {
                const toggle = this.querySelector('.dropdown-toggle');
                if (toggle) {
                    const bsDropdown = new bootstrap.Dropdown(toggle);
                    bsDropdown.show();
                }
            });

            dropdown.addEventListener('mouseleave', function() {
                const toggle = this.querySelector('.dropdown-toggle');
                if (toggle) {
                    const bsDropdown = new bootstrap.Dropdown(toggle);
                    bsDropdown.hide();
                }
            });
        });
    }
});
</script>
