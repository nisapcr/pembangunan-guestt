@extends('layouts.app')

@section('title', 'Kontraktor')

@section('content')
<div class="container py-5">

    {{-- Filter & Search --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Cari Kontraktor</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="Nama kontraktor atau spesialisasi...">
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Spesialisasi</label>
                    <select class="form-select">
                        <option selected>Semua Spesialisasi</option>
                        <option>Konstruksi Gedung</option>
                        <option>Jalan & Jembatan</option>
                        <option>Infrastruktur</option>
                        <option>Renovasi</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Lokasi</label>
                    <select class="form-select">
                        <option selected>Semua Lokasi</option>
                        <option>Jakarta</option>
                        <option>Bandung</option>
                        <option>Surabaya</option>
                        <option>Bali</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-semibold">Rating</label>
                    <select class="form-select">
                        <option selected>Semua Rating</option>
                        <option>5 Bintang</option>
                        <option>4 Bintang ke atas</option>
                        <option>3 Bintang ke atas</option>
                    </select>
                </div>
            </div>
            <div class="text-end mt-3">
                <button class="btn btn-primary">
                    <i class="fas fa-filter me-2"></i>Filter
                </button>
                <button class="btn btn-outline-secondary">
                    <i class="fas fa-sync me-2"></i>Reset
                </button>
            </div>
        </div>
    </div>

    {{-- Statistics Cards --}}
    <div class="row mb-5">
        <div class="col-md-3">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Total Kontraktor</h6>
                            <h3 class="fw-bold">24</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-building fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Aktif</h6>
                            <h3 class="fw-bold">18</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-check-circle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Dalam Proyek</h6>
                            <h3 class="fw-bold">12</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-hard-hat fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Spesialisasi</h6>
                            <h3 class="fw-bold">8</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-tools fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Contractor List --}}
    <div class="row">
        {{-- Contractor 1 --}}
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card contractor-card shadow-sm h-100">
                <div class="card-header bg-gradient-primary text-white text-center py-4">
                    <div class="contractor-avatar mx-auto mb-3">
                        <div class="rounded-circle bg-white text-primary d-flex align-items-center justify-content-center fw-bold" style="width: 80px; height: 80px; font-size: 1.5rem;">
                            PT BJ
                        </div>
                    </div>
                    <h5 class="card-title mb-1">PT Bangun Jaya</h5>
                    <p class="mb-0 opacity-75">Konstruksi Gedung</p>
                </div>
                <div class="card-body">
                    <div class="contractor-info">
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-map-marker-alt text-muted me-2"></i>
                                <span class="text-muted">Jakarta Pusat</span>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-phone text-muted me-2"></i>
                                <span class="text-muted">(021) 1234-5678</span>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-envelope text-muted me-2"></i>
                                <span class="text-muted">info@bangunjaya.com</span>
                            </div>
                        </div>

                        <div class="rating mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-semibold">Rating:</span>
                                <div>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star-half-alt text-warning"></i>
                                    <span class="ms-1 fw-bold">4.5</span>
                                </div>
                            </div>
                        </div>

                        <div class="projects mb-3">
                            <span class="badge bg-primary">5 Proyek</span>
                            <span class="badge bg-success">Aktif</span>
                        </div>

                        <div class="specialization">
                            <small class="text-muted">Spesialisasi:</small>
                            <div class="mt-1">
                                <span class="badge bg-light text-dark border me-1 mb-1">Gedung Tinggi</span>
                                <span class="badge bg-light text-dark border me-1 mb-1">Apartemen</span>
                                <span class="badge bg-light text-dark border me-1 mb-1">Komersial</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-eye me-1"></i>Lihat Detail
                        </button>
                        <button class="btn btn-primary btn-sm">
                            <i class="fas fa-project-diagram me-1"></i>Proyek
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Contractor 2 --}}
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card contractor-card shadow-sm h-100">
                <div class="card-header bg-gradient-success text-white text-center py-4">
                    <div class="contractor-avatar mx-auto mb-3">
                        <div class="rounded-circle bg-white text-success d-flex align-items-center justify-content-center fw-bold" style="width: 80px; height: 80px; font-size: 1.5rem;">
                            PT KM
                        </div>
                    </div>
                    <h5 class="card-title mb-1">PT Konstruksi Maju</h5>
                    <p class="mb-0 opacity-75">Jalan & Jembatan</p>
                </div>
                <div class="card-body">
                    <div class="contractor-info">
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-map-marker-alt text-muted me-2"></i>
                                <span class="text-muted">Bandung</span>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-phone text-muted me-2"></i>
                                <span class="text-muted">(022) 8765-4321</span>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-envelope text-muted me-2"></i>
                                <span class="text-muted">contact@konstruksimaju.com</span>
                            </div>
                        </div>

                        <div class="rating mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-semibold">Rating:</span>
                                <div>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <span class="ms-1 fw-bold">5.0</span>
                                </div>
                            </div>
                        </div>

                        <div class="projects mb-3">
                            <span class="badge bg-primary">8 Proyek</span>
                            <span class="badge bg-warning">Sibuk</span>
                        </div>

                        <div class="specialization">
                            <small class="text-muted">Spesialisasi:</small>
                            <div class="mt-1">
                                <span class="badge bg-light text-dark border me-1 mb-1">Jalan Tol</span>
                                <span class="badge bg-light text-dark border me-1 mb-1">Jembatan</span>
                                <span class="badge bg-light text-dark border me-1 mb-1">Infrastruktur</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-eye me-1"></i>Lihat Detail
                        </button>
                        <button class="btn btn-primary btn-sm">
                            <i class="fas fa-project-diagram me-1"></i>Proyek
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Contractor 3 --}}
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card contractor-card shadow-sm h-100">
                <div class="card-header bg-gradient-warning text-white text-center py-4">
                    <div class="contractor-avatar mx-auto mb-3">
                        <div class="rounded-circle bg-white text-warning d-flex align-items-center justify-content-center fw-bold" style="width: 80px; height: 80px; font-size: 1.5rem;">
                            PT SA
                        </div>
                    </div>
                    <h5 class="card-title mb-1">PT Sentosa Abadi</h5>
                    <p class="mb-0 opacity-75">Renovasi & Interior</p>
                </div>
                <div class="card-body">
                    <div class="contractor-info">
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-map-marker-alt text-muted me-2"></i>
                                <span class="text-muted">Surabaya</span>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-phone text-muted me-2"></i>
                                <span class="text-muted">(031) 2468-1357</span>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-envelope text-muted me-2"></i>
                                <span class="text-muted">hello@sentosaabadi.com</span>
                            </div>
                        </div>

                        <div class="rating mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-semibold">Rating:</span>
                                <div>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="far fa-star text-warning"></i>
                                    <span class="ms-1 fw-bold">4.0</span>
                                </div>
                            </div>
                        </div>

                        <div class="projects mb-3">
                            <span class="badge bg-primary">12 Proyek</span>
                            <span class="badge bg-success">Tersedia</span>
                        </div>

                        <div class="specialization">
                            <small class="text-muted">Spesialisasi:</small>
                            <div class="mt-1">
                                <span class="badge bg-light text-dark border me-1 mb-1">Renovasi</span>
                                <span class="badge bg-light text-dark border me-1 mb-1">Interior</span>
                                <span class="badge bg-light text-dark border me-1 mb-1">Residensial</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-eye me-1"></i>Lihat Detail
                        </button>
                        <button class="btn btn-primary btn-sm">
                            <i class="fas fa-project-diagram me-1"></i>Proyek
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Add Contractor Button --}}
    <div class="text-center mt-4">
        <button class="btn btn-primary btn-lg">
            <i class="fas fa-plus me-2"></i>Tambah Kontraktor Baru
        </button>
    </div>
</div>

{{-- css --}}
<style>
.contractor-card {
    transition: all 0.3s ease;
}
.contractor-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}
.bg-gradient-primary {
    background: linear-gradient(135deg, #007bff, #0056b3);
}
.bg-gradient-success {
    background: linear-gradient(135deg, #28a745, #1e7e34);
}
.bg-gradient-warning {
    background: linear-gradient(135deg, #ffc107, #e0a800);
}
.contractor-avatar {
    border: 3px solid rgba(255,255,255,0.2);
    border-radius: 50%;
}
</style>
{{-- end css --}}
@endsection
