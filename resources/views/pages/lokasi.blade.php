@extends('layouts.guest.app')

@section('title', 'Lokasi Proyek')

@section('content')
<div class="container-fluid py-4">

    <div class="row">
        {{-- Sidebar: Daftar Proyek --}}
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-list me-2"></i>Daftar Proyek
                    </h5>
                </div>
                <div class="card-body">
                    {{-- Search --}}
                    <div class="input-group mb-3">
                        <span class="input-group-text">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="Cari proyek...">
                    </div>

                    {{-- Project List --}}
                    <div class="project-list">
                        {{-- Project 1 --}}
                        <div class="project-item card mb-3 border-primary">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="fw-bold text-primary mb-1">Proyek A - Apartemen Sentral</h6>
                                        <p class="text-muted small mb-2">
                                            <i class="fas fa-map-marker-alt me-1"></i>Jakarta Pusat
                                        </p>
                                        <div class="d-flex gap-2">
                                            <span class="badge bg-success">Aktif</span>
                                            <span class="badge bg-info">75% Progress</span>
                                        </div>
                                    </div>
                                    <button class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Project 2 --}}
                        <div class="project-item card mb-3 border-warning">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="fw-bold text-warning mb-1">Proyek B - Mall Metropolitan</h6>
                                        <p class="text-muted small mb-2">
                                            <i class="fas fa-map-marker-alt me-1"></i>Bandung Selatan
                                        </p>
                                        <div class="d-flex gap-2">
                                            <span class="badge bg-warning">Dalam Proses</span>
                                            <span class="badge bg-info">50% Progress</span>
                                        </div>
                                    </div>
                                    <button class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Project 3 --}}
                        <div class="project-item card mb-3 border-success">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="fw-bold text-success mb-1">Proyek C - Rumah Sakit Umum</h6>
                                        <p class="text-muted small mb-2">
                                            <i class="fas fa-map-marker-alt me-1"></i>Surabaya Timur
                                        </p>
                                        <div class="d-flex gap-2">
                                            <span class="badge bg-success">Selesai</span>
                                            <span class="badge bg-info">100% Progress</span>
                                        </div>
                                    </div>
                                    <button class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Content: Map and Details --}}
        <div class="col-lg-8">
            {{-- Map Section --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-map me-2"></i>Peta Lokasi Proyek
                    </h5>
                </div>
                <div class="card-body p-0">
                    {{-- Map Container --}}
                    <div class="map-container" style="height: 400px; background: linear-gradient(135deg, #e3f2fd, #bbdefb); position: relative;">
                        {{-- Map placeholder with markers --}}
                        <div class="position-relative w-100 h-100">
                            {{-- Background grid --}}
                            <div class="position-absolute w-100 h-100" style="background-image: linear-gradient(#e0e0e0 1px, transparent 1px), linear-gradient(90deg, #e0e0e0 1px, transparent 1px); background-size: 20px 20px;"></div>

                            {{-- Markers --}}
                            <div class="position-absolute" style="top: 30%; left: 25%;">
                                                <div class="map-marker bg-primary text-white rounded-circle d-flex align-items-center justify-content-center shadow" style="width: 50px; height: 50px; cursor: pointer;" data-bs-toggle="tooltip" title="Proyek A - Jakarta Pusat">
                                    <i class="fas fa-building"></i>
                                </div>
                            </div>
                            <div class="position-absolute" style="top: 50%; left: 60%;">
                                <div class="map-marker bg-warning text-white rounded-circle d-flex align-items-center justify-content-center shadow" style="width: 50px; height: 50px; cursor: pointer;" data-bs-toggle="tooltip" title="Proyek B - Bandung Selatan">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                            </div>
                            <div class="position-absolute" style="top: 70%; left: 40%;">
                                <div class="map-marker bg-success text-white rounded-circle d-flex align-items-center justify-content-center shadow" style="width: 50px; height: 50px; cursor: pointer;" data-bs-toggle="tooltip" title="Proyek C - Surabaya Timur">
                                    <i class="fas fa-hospital"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Project Details --}}
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>Detail Lokasi Proyek
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        {{-- Location Info --}}
                        <div class="col-md-6">
                            <h6 class="fw-bold text-primary mb-3">Informasi Lokasi</h6>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nama Proyek</label>
                                <p class="form-control-static">Apartemen Sentral</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Alamat Lengkap</label>
                                <p class="form-control-static">Jl. Thamrin No. 123, Jakarta Pusat, DKI Jakarta</p>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label class="form-label fw-semibold">Latitude</label>
                                    <p class="form-control-static">-6.2088</p>
                                </div>
                                <div class="col-6">
                                    <label class="form-label fw-semibold">Longitude</label>
                                    <p class="form-control-static">106.8456</p>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Kontraktor</label>
                                <p class="form-control-static">PT Bangun Jaya Konstruksi</p>
                            </div>
                        </div>

                        {{-- Media Section --}}
                        <div class="col-md-6">
                            <h6 class="fw-bold text-primary mb-3">Denah & Gambar</h6>
                            {{-- Site Plan --}}
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Denah Lokasi</label>
                                <div class="border rounded p-3 text-center bg-light" style="height: 150px;">
                                    <i class="fas fa-map fa-3x text-muted mb-2"></i>
                                    <p class="text-muted small">site_plan_proyek_a.pdf</p>
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-download me-1"></i>Unduh
                                    </button>
                                </div>
                            </div>

                            {{-- Gallery --}}
                            <div>
                                <label class="form-label fw-semibold">Gambar Lokasi</label>
                                <div class="row g-2">
                                    <div class="col-4">
                                        <div class="border rounded p-2 text-center bg-white" style="height: 80px;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="border rounded p-2 text-center bg-white" style="height: 80px;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="border rounded p-2 text-center bg-white" style="height: 80px;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- GeoJSON Info --}}
                    <div class="mt-4 pt-3 border-top">
                        <h6 class="fw-bold text-primary mb-3">Data GeoJSON</h6>
                        <div class="bg-dark text-light rounded p-3">
                            <pre class="mb-0 small"><code>{
    "type": "FeatureCollection",
    "features": [
        {
            "type": "Feature",
            "geometry": {
                "type": "Point",
                "coordinates": [106.8456, -6.2088]
            },
            "properties": {
                "name": "Apartemen Sentral",
                "status": "active"
            }
        }
    ]
}</code></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- css --}}
<style>
.project-item {
    transition: all 0.3s ease;
    cursor: pointer;
}
.project-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}
.map-marker {
    transition: all 0.3s ease;
}
.map-marker:hover {
    transform: scale(1.1);
}
.form-control-static {
    padding: 0.375rem 0;
    margin-bottom: 0;
    background-color: transparent;
    border: none;
    min-height: auto;
}
</style>
{{-- end css --}}


{{-- js --}}
<script>
// Initialize tooltips
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
});
</script>
{{-- end js --}}
@endsection
