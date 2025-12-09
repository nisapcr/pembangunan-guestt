@extends('layouts.guest.app')

@section('title', 'Daftar Data Pengguna')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-users me-2"></i> Data Pengguna
                </h5>
                <a href="{{ route('users.create') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-plus me-1"></i> Tambah Pengguna
                </a>
            </div>
        </div>

        <div class="card-body">
            <!-- Form Filter dan Search -->
            <form method="GET" action="{{ route('users.index') }}" class="mb-4">
                <div class="row g-2">
                    <!-- Search -->
                    <div class="col-md-8">
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" name="search" class="form-control border-start-0"
                                   value="{{ request('search') }}" placeholder="Cari nama atau email pengguna...">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search me-1"></i> Cari
                            </button>
                            @if(request('search'))
                                <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" class="btn btn-outline-danger">
                                    <i class="fas fa-times me-1"></i> Clear
                                </a>
                            @endif
                        </div>
                    </div>

                    <!-- Reset Filter -->
                    @if(request('search'))
                        <div class="col-md-4">
                            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary w-100">
                                <i class="fas fa-refresh me-1"></i> Reset
                            </a>
                        </div>
                    @endif
                </div>
            </form>

            <!-- Info Hasil Pencarian -->
            @if(request('search'))
                <div class="alert alert-info mb-3">
                    <i class="fas fa-info-circle me-2"></i>
                    Hasil pencarian untuk: "<strong>{{ request('search') }}</strong>"
                    <span class="badge bg-primary ms-2">{{ $users->total() }} hasil ditemukan</span>
                </div>
            @endif

            <!-- Card Users -->
            @if($users->count() > 0)
                <div class="row g-3">
                    @foreach ($users as $user)
                        <div class="col-md-6 col-lg-4">
                            <div class="card user-card h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-start mb-3">
                                        <!-- MODIFIKASI BAGIAN INI -->
                                        <div class="me-3">
                                            @if($user->profile_picture)
                                                <img src="{{ Storage::url($user->profile_picture) }}"
                                                     alt="{{ $user->name }}"
                                                     class="rounded-circle"
                                                     style="width: 50px; height: 50px; object-fit: cover;">
                                            @else
                                                <div class="user-avatar me-3">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </div>
                                            @endif
                                        </div>
                                        <!-- END MODIFIKASI -->
                                        <div class="flex-grow-1">
                                            <h6 class="card-title mb-1 fw-bold text-truncate">{{ $user->name }}</h6>
                                            <p class="card-text text-muted small mb-2 text-truncate">
                                                <i class="fas fa-envelope me-1"></i>{{ $user->email }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="badge bg-light text-dark">
                                                <i class="fas fa-calendar me-1"></i>
                                                Bergabung: {{ $user->created_at->format('d/m/Y') }}
                                            </span>
                                            <span class="badge bg-success">
                                                <i class="fas fa-user me-1"></i>
                                                Aktif
                                            </span>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            ID: {{ $user->id }}
                                        </small>
                                        <div class="btn-group">
                                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-sm"
                                               data-bs-toggle="tooltip" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm"
                                               data-bs-toggle="tooltip" title="Edit Data">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            @if(auth()->check() && auth()->id() == $user->id)
                                                <button class="btn btn-danger btn-sm" disabled
                                                        data-bs-toggle="tooltip" title="Tidak dapat menghapus akun sendiri">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @else
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Yakin ingin menghapus user {{ $user->name }}?')"
                                                            data-bs-toggle="tooltip" title="Hapus User">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="empty-state text-center py-5">
                    <i class="fas fa-users fa-4x text-muted mb-3"></i>
                    @if(request('search'))
                        <h5 class="fw-bold text-muted">Tidak ditemukan pengguna</h5>
                        <p class="text-muted">Tidak ada pengguna yang sesuai dengan pencarian "<strong>{{ request('search') }}</strong>"</p>
                        <a href="{{ route('users.index') }}" class="btn btn-primary mt-2">
                            <i class="fas fa-refresh me-1"></i> Tampilkan Semua Pengguna
                        </a>
                    @else
                        <h5 class="fw-bold text-muted">Belum ada data pengguna</h5>
                        <p class="text-muted">Mulai dengan menambahkan pengguna pertama Anda</p>
                        <a href="{{ route('users.create') }}" class="btn btn-primary mt-2">
                            <i class="fas fa-plus me-1"></i> Tambah Pengguna Pertama
                        </a>
                    @endif
                </div>
            @endif

            <!-- Pagination -->
            @if($users->hasPages())

                    <div>
                        {{ $users->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
</script>
@endsection

@section('styles')
<style>
    .user-card {
        border-left: 4px solid #0d6efd;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .user-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1) !important;
    }
    .user-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: #0d6efd;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 1.2rem;
        flex-shrink: 0;
    }
    .empty-state {
        padding: 3rem 1rem;
    }
    .empty-state i {
        opacity: 0.3;
    }
    .card-title {
        font-size: 1rem;
    }
    .btn-group .btn {
        padding: 0.25rem 0.5rem;
    }
</style>
@endsection
