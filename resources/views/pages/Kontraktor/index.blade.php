@extends('layouts.guest.app')
@section('title', 'Daftar Data Kontraktor')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-hard-hat text-primary me-2"></i>Data Kontraktor
            </h1>
            <p class="text-muted mb-0">Manajemen data kontraktor pembangunan proyek</p>
        </div>
        <div>
            <a href="{{ route('kontraktor.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Tambah Kontraktor
            </a>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('kontraktor.index') }}" class="row g-3">
                <div class="col-md-3">
                    <select name="proyek_id" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="">Semua Proyek</option>
                        @foreach($proyeks as $proyek)
                            <option value="{{ $proyek->proyek_id }}"
                                {{ request('proyek_id') == $proyek->proyek_id ? 'selected' : '' }}>
                                {{ $proyek->nama_proyek }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" class="form-control"
                               placeholder="Cari nama, penanggung jawab, atau kontak..."
                               value="{{ request('search') }}">
                        <button class="btn btn-outline-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                        @if(request('search') || request('proyek_id'))
                        <a href="{{ route('kontraktor.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times"></i>
                        </a>
                        @endif
                    </div>
                </div>
                <div class="col-md-3 text-end">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-secondary active"
                                onclick="setViewMode('card')">
                            <i class="fas fa-th-large"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary"
                                onclick="setViewMode('table')">
                            <i class="fas fa-list"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Alerts -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Kontraktor</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalKontraktor ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hard-hat fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Proyek Terlibat</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $proyekDenganKontraktor ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-project-diagram fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Kontak Valid</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $kontakValidCount ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-phone-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Update Terakhir</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ now()->format('d/m/Y') }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kontraktor Cards -->
    <div class="row" id="cardView">
        @forelse($kontraktors as $kontraktor)
        <div class="col-xl-4 col-lg-6 mb-4">
            <div class="card kontraktor-card shadow-sm border-0">
                <div class="card-header bg-gradient-primary text-white">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <h5 class="card-title mb-1">{{ $kontraktor->nama }}</h5>
                            <small class="opacity-75">
                                <i class="fas fa-user-tie me-1"></i>{{ $kontraktor->penanggung_jawab }}
                            </small>
                        </div>
                        <div class="ms-2">
                            <span class="badge bg-light text-dark">
                                #{{ $loop->iteration + (($kontraktors->currentPage() - 1) * $kontraktors->perPage()) }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Proyek Info -->
                    <div class="mb-3">
                        <div class="d-flex align-items-center mb-2">
                            <div class="icon-circle-sm bg-info me-2">
                                <i class="fas fa-project-diagram text-white"></i>
                            </div>
                            <div>
                                <small class="text-muted">Proyek</small>
                                <h6 class="mb-0 fw-bold">{{ $kontraktor->proyek->nama_proyek ?? 'Tidak Terhubung' }}</h6>
                            </div>
                        </div>
                    </div>

                    <!-- Kontak Info -->
                    <div class="mb-3">
                        <div class="d-flex align-items-center mb-2">
                            <div class="icon-circle-sm bg-success me-2">
                                <i class="fas fa-phone text-white"></i>
                            </div>
                            <div>
                                <small class="text-muted">Kontak</small>
                                @if($kontraktor->kontak_valid)
                                <a href="tel:{{ $kontraktor->kontak }}" class="text-decoration-none d-block">
                                    <h6 class="mb-0 fw-bold text-success">{{ $kontraktor->kontak_formatted }}</h6>
                                    <small class="text-success"><i class="fas fa-check-circle me-1"></i>Kontak Valid</small>
                                </a>
                                @else
                                <h6 class="mb-0 fw-bold">{{ $kontraktor->kontak }}</h6>
                                <small class="text-warning"><i class="fas fa-exclamation-triangle me-1"></i>Format Tidak Standar</small>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Alamat Info -->
                    <div class="mb-3">
                        <div class="d-flex align-items-start">
                            <div class="icon-circle-sm bg-warning me-2">
                                <i class="fas fa-map-marker-alt text-white"></i>
                            </div>
                            <div class="flex-grow-1">
                                <small class="text-muted">Alamat</small>
                                <p class="mb-0 text-truncate-2" style="max-height: 40px; overflow: hidden;">
                                    {{ $kontraktor->alamat }}
                                </p>
                                <small class="text-muted">{{ Str::limit($kontraktor->alamat, 50) }}</small>
                            </div>
                        </div>
                    </div>

                    <!-- Metadata -->
                    <div class="row mt-3 pt-3 border-top">
                        <div class="col-6">
                            <small class="text-muted d-block">
                                <i class="fas fa-calendar-plus me-1"></i>Ditambahkan
                            </small>
                            <small class="fw-bold">{{ $kontraktor->created_at->format('d M Y') }}</small>
                        </div>
                        <div class="col-6 text-end">
                            <small class="text-muted d-block">
                                <i class="fas fa-clock me-1"></i>Terakhir Update
                            </small>
                            <small class="fw-bold">{{ $kontraktor->updated_at->format('d M Y') }}</small>
                        </div>
                    </div>
                </div>

                <!-- Card Footer - Action Buttons -->
                <div class="card-footer bg-white border-top-0">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('kontraktor.show', $kontraktor->kontraktor_id) }}"
                           class="btn btn-sm btn-outline-primary" title="Detail">
                            <i class="fas fa-eye me-1"></i>Detail
                        </a>
                        <a href="{{ route('kontraktor.edit', $kontraktor->kontraktor_id) }}"
                           class="btn btn-sm btn-outline-warning" title="Edit">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                        <form action="{{ route('kontraktor.destroy', $kontraktor->kontraktor_id) }}"
                              method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Hapus kontraktor {{ $kontraktor->nama }}?')"
                                    title="Hapus">
                                <i class="fas fa-trash me-1"></i>Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body text-center py-5">
                    <div class="empty-state-icon mb-3">
                        <i class="fas fa-hard-hat fa-3x text-muted opacity-25"></i>
                    </div>
                    <h3 class="text-muted">Belum Ada Data Kontraktor</h3>
                    <p class="text-muted mb-4">Mulai dengan menambahkan kontraktor baru untuk proyek Anda</p>
                    <a href="{{ route('kontraktor.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Tambah Kontraktor Pertama
                    </a>
                </div>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($kontraktors->hasPages())
    <div>
        <div>
            {{ $kontraktors->links('pagination::bootstrap-5') }}
        </div>
    </div>
    @endif
</div>

<style>
/* Card Styling */
.kontraktor-card {
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.3s ease;
    border: 1px solid #e3e6f0;
}

.kontraktor-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
    border-color: #4e73df;
}

.kontraktor-card .card-header {
    border-top-left-radius: 12px !important;
    border-top-right-radius: 12px !important;
    padding: 1rem 1.25rem;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
}

/* Icon Circles */
.icon-circle-sm {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.icon-circle-sm i {
    font-size: 0.875rem;
}

/* Text Truncate */
.text-truncate-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Action Buttons */
.btn-outline-primary:hover {
    background-color: #4e73df;
    border-color: #4e73df;
    color: white;
}

.btn-outline-warning:hover {
    background-color: #f6c23e;
    border-color: #f6c23e;
    color: #212529;
}

.btn-outline-danger:hover {
    background-color: #e74a3b;
    border-color: #e74a3b;
    color: white;
}

/* Empty State */
.empty-state-icon {
    opacity: 0.5;
}

/* Border Left Colors */
.border-left-primary {
    border-left: 4px solid #4e73df !important;
}

.border-left-success {
    border-left: 4px solid #1cc88a !important;
}

.border-left-info {
    border-left: 4px solid #36b9cc !important;
}

.border-left-warning {
    border-left: 4px solid #f6c23e !important;
}

/* Responsive */
@media (max-width: 1200px) {
    .col-xl-4 {
        width: 50%;
    }
}

@media (max-width: 768px) {
    .col-xl-4, .col-lg-6 {
        width: 100%;
    }

    .kontraktor-card .card-body {
        padding: 1rem;
    }

    .d-flex.justify-content-between {
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .d-flex.justify-content-between > * {
        flex: 1;
        min-width: 120px;
    }
}

/* Badge Styling */
.badge.bg-light {
    color: #495057;
    font-weight: 600;
    font-size: 0.75rem;
    padding: 0.25rem 0.5rem;
}
</style>

<script>
function setViewMode(mode) {
    const cardButtons = document.querySelectorAll('.btn-group .btn');
    cardButtons.forEach(btn => {
        if (btn.textContent.includes(mode === 'card' ? 'th-large' : 'list')) {
            btn.classList.add('active');
            btn.classList.remove('btn-outline-secondary');
            btn.classList.add('btn-primary');
        } else {
            btn.classList.remove('active', 'btn-primary');
            btn.classList.add('btn-outline-secondary');
        }
    });

    // Simpan preferensi ke localStorage
    localStorage.setItem('viewMode', mode);
}

// Load saved view mode preference
document.addEventListener('DOMContentLoaded', function() {
    const savedMode = localStorage.getItem('viewMode') || 'card';
    setViewMode(savedMode);

    // Add hover effect to cards
    const cards = document.querySelectorAll('.kontraktor-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.zIndex = '10';
        });
        card.addEventListener('mouseleave', function() {
            this.style.zIndex = '1';
        });
    });
});
</script>
@endsection
