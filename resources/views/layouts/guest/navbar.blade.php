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

                <li><a href="{{ route('proyek.index') }}"
                        class="nav-link {{ Request::is('proyek*') ? 'active' : '' }}">Proyek</a></li>
                <li><a href="{{ route('tahapan') }}"
                        class="nav-link {{ Request::is('tahapan*') ? 'active' : '' }}">Tahapan</a></li>
                <li><a href="{{ route('progres') }}"
                        class="nav-link {{ Request::is('progres*') ? 'active' : '' }}">Progres</a></li>
                <li><a href="{{ route('lokasi') }}"
                        class="nav-link {{ Request::is('lokasi*') ? 'active' : '' }}">Lokasi</a></li>
                <li><a href="{{ route('kontraktor') }}"
                        class="nav-link {{ Request::is('kontraktor*') ? 'active' : '' }}">Kontraktor</a>
                </li>

                <!-- MENU BARU: TENTANG -->
                <li><a href="{{ route('tentang') }}"
                        class="nav-link {{ Request::is('tentang*') ? 'active' : '' }}">Tentang</a></li>

                <!-- DROPDOWN DATA WARGA -->
                <!-- DROPDOWN DATA WARGA -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ Request::is('warga*') ? 'active' : '' }}" href="#"
                        role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-users me-1"></i>Data
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item {{ Request::is('warga') ? 'active' : '' }}"
                                href="{{ route('warga.index') }}">
                                <i class="fas fa-list"></i>Daftar Warga
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ Request::is('User') ? 'active' : '' }}"
                                href="{{ route('users.index') }}">
                                <i class="fas fa-list"></i>Daftar pengguna
                            </a>
                        </li>
                    </ul>
                </li>

                <li><a href="{{ route('login') }}"
                        class="nav-link {{ Request::is('login') ? 'active' : '' }}">Login</a></li>
            </ul>
        </div>
    </div>
</nav>
