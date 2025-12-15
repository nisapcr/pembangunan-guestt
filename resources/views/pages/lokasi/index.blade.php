{{-- resources/views/pages/lokasi/index.blade.php --}}
@extends('layouts.guest.app')
@section('title', 'Lokasi Proyek')

@section('content')
<div class="container-fluid">
    <!-- Header Card -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-map-marker-alt me-2"></i>Data Lokasi Proyek
            </h5>
            <a href="{{ route('lokasi.create') }}" class="btn btn-light">
                <i class="fas fa-plus me-1"></i> Tambah Lokasi
            </a>
        </div>

        <!-- Filter Section -->
        <div class="card-body">
            <form method="GET" action="{{ route('lokasi.index') }}" class="mb-3">
                <div class="row g-2">
                    <div class="col-md-4">
                        <select name="proyek_id" class="form-select" onchange="this.form.submit()">
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
                        <div class="input-group">
                            <input type="text" name="search" class="form-control"
                                   value="{{ request('search') }}" placeholder="Cari nama lokasi atau alamat...">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                            @if(request('search'))
                                <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
                                   class="btn btn-outline-danger">
                                    <i class="fas fa-times"></i>
                                </a>
                            @endif
                        </div>
                    </div>

                    @if(request('proyek_id') || request('search'))
                    <div class="col-md-2">
                        <a href="{{ route('lokasi.index') }}" class="btn btn-outline-secondary w-100">
                            <i class="fas fa-refresh me-1"></i> Reset
                        </a>
                    </div>
                    @endif
                </div>
            </form>

            <!-- Search Info -->
            @if(request('proyek_id') || request('search'))
            <div class="alert alert-info mb-0">
                <i class="fas fa-info-circle me-2"></i>
                @if(request('search'))
                    Hasil pencarian untuk: "<strong>{{ request('search') }}</strong>"
                @endif
                @if(request('proyek_id'))
                    | Proyek: <strong>
                        @php
                            $selectedProyek = $proyeks->where('proyek_id', request('proyek_id'))->first();
                        @endphp
                        {{ $selectedProyek->nama_proyek ?? 'Tidak Diketahui' }}
                    </strong>
                @endif
                <span class="badge bg-primary ms-2">{{ $lokasis->total() }} data ditemukan</span>
            </div>
            @endif
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card statistic-card bg-gradient-primary text-white shadow border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="font-weight-bold mb-1">{{ $totalLokasi ?? 0 }}</h2>
                            <p class="mb-0 opacity-75">Total Lokasi</p>
                        </div>
                        <div class="icon-circle">
                            <i class="fas fa-database"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card statistic-card bg-gradient-success text-white shadow border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="font-weight-bold mb-1">{{ $lokasiDenganKoordinat ?? 0 }}</h2>
                            <p class="mb-0 opacity-75">Dengan Koordinat</p>
                        </div>
                        <div class="icon-circle">
                            <i class="fas fa-map-pin"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card statistic-card bg-gradient-warning text-white shadow border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="font-weight-bold mb-1">{{ $lokasiTanpaKoordinat ?? 0 }}</h2>
                            <p class="mb-0 opacity-75">Tanpa Koordinat</p>
                        </div>
                        <div class="icon-circle">
                            <i class="fas fa-map-location-dot"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card statistic-card bg-gradient-info text-white shadow border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="font-weight-bold mb-1">{{ $proyeks->count() ?? 0 }}</h2>
                            <p class="mb-0 opacity-75">Total Proyek</p>
                        </div>
                        <div class="icon-circle">
                            <i class="fas fa-building"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alerts -->
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> <strong>Sukses!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle"></i> <strong>Error!</strong> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Map Section -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
            <h6 class="mb-0">
                <i class="fas fa-map me-2"></i>Peta Lokasi Proyek
            </h6>
            <button class="btn btn-sm btn-light" onclick="refreshMap()">
                <i class="fas fa-sync-alt me-1"></i> Refresh
            </button>
        </div>
        <div class="card-body p-0">
            <div id="map" style="height: 400px; border-radius: 8px;"></div>
        </div>
    </div>

    <!-- GeoJSON Section -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h6 class="mb-0">
                <i class="fas fa-code me-2"></i>Data GeoJSON
            </h6>
            <button class="btn btn-sm btn-light" onclick="loadGeojsonData()">
                <i class="fas fa-sync-alt me-1"></i> Refresh
            </button>
        </div>
        <div class="card-body">
            <div id="geojsonMap" style="height: 300px; border-radius: 8px; margin-bottom: 15px;"></div>
            <div id="geojsonData" class="bg-light p-3 rounded" style="max-height: 200px; overflow: auto;">
                <p class="text-muted mb-0">Loading GeoJSON data...</p>
            </div>
        </div>
    </div>

    <!-- Lokasi Cards -->
    <div class="row">
        @if ($lokasis->isEmpty())
        <div class="col-12">
            <div class="card shadow border-0">
                <div class="card-body text-center py-5">
                    <i class="fas fa-map-marker-alt fa-3x text-muted mb-3 opacity-25"></i>
                    @if(request('search') || request('proyek_id'))
                    <h5 class="fw-bold text-muted">Tidak ditemukan data lokasi dengan filter yang dipilih</h5>
                    <p class="text-muted">Silakan coba dengan filter atau kata kunci lain</p>
                    @else
                    <h5 class="fw-bold text-muted">Belum ada data lokasi proyek</h5>
                    <p class="text-muted">Silakan tambah lokasi proyek baru dengan mengklik tombol "Tambah Lokasi"</p>
                    @endif
                    <a href="{{ route('lokasi.create') }}" class="btn btn-primary mt-3">
                        <i class="fas fa-plus me-1"></i> Tambah Lokasi Pertama
                    </a>
                </div>
            </div>
        </div>
        @else
            @foreach ($lokasis as $lokasi)
            <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
                <div class="card lokasi-card shadow-sm border-0 h-100">
                    <!-- Card Header -->
                    <div class="card-header bg-white border-0 pb-0">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="fw-bold mb-1 text-primary">
                                    {{ $lokasi->nama_lokasi }}
                                </h6>
                                <p class="text-muted small mb-0">
                                    <i class="fas fa-project-diagram me-1"></i>
                                    {{ $lokasi->proyek->nama_proyek ?? '-' }}
                                </p>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary border-0"
                                        type="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('lokasi.show', $lokasi->lokasi_id) }}">
                                            <i class="fas fa-eye text-info me-2"></i>Detail
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('lokasi.edit', $lokasi->lokasi_id) }}">
                                            <i class="fas fa-edit text-warning me-2"></i>Edit
                                        </a>
                                    </li>
                                    <!-- Tombol Upload Media Tambahan -->
                                    <li>
                                        <a class="dropdown-item text-success" href="#"
                                           data-bs-toggle="modal"
                                           data-bs-target="#uploadMediaModal{{ $lokasi->lokasi_id }}">
                                            <i class="fas fa-plus-circle me-2"></i>Tambah Media
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('lokasi.destroy', $lokasi->lokasi_id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus lokasi ini?')">
                                                <i class="fas fa-trash me-2"></i>Hapus
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body pt-2">
                        <!-- Koordinat -->
                        <div class="mb-3">
                            <small class="text-muted d-block mb-1">Koordinat:</small>
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded-circle p-2 me-2">
                                    <i class="fas fa-location-dot {{ $lokasi->memiliki_koordinat ? 'text-success' : 'text-secondary' }}"></i>
                                </div>
                                <div>
                                    <div class="fw-bold">
                                        {{ $lokasi->koordinat_string }}
                                    </div>
                                    @if($lokasi->memiliki_koordinat)
                                    <small>
                                        <a href="{{ $lokasi->map_url }}" target="_blank" class="text-primary">
                                            <i class="fas fa-external-link-alt me-1"></i>Lihat di Google Maps
                                        </a>
                                    </small>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Alamat -->
                        @if($lokasi->alamat)
                        <div class="mb-3">
                            <small class="text-muted d-block mb-1">Alamat:</small>
                            <p class="mb-0 text-truncate-2">
                                {{ Str::limit($lokasi->alamat, 100) }}
                            </p>
                        </div>
                        @endif

                        <!-- Denah Gambar -->
                        @if($lokasi->denah_gambar)
                        <div class="mb-3">
                            <small class="text-muted d-block mb-2">Denah Gambar:</small>
                            <div class="position-relative">
                                <img src="{{ $lokasi->denah_gambar_url }}"
                                     alt="Denah {{ $lokasi->nama_lokasi }}"
                                     class="img-fluid rounded shadow-sm cursor-pointer"
                                     style="height: 120px; width: 100%; object-fit: cover;"
                                     onclick="showImageModal('{{ $lokasi->denah_gambar_url }}', 'Denah {{ $lokasi->nama_lokasi }}')">
                                <div class="position-absolute top-0 end-0 m-2">
                                    <span class="badge bg-success">Denah</span>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Media Tambahan Preview -->
                        @if($lokasi->memiliki_media_tambahan)
                        <div class="mb-3">
                            <small class="text-muted d-block mb-2">Media Tambahan ({{ $lokasi->jumlah_media_tambahan }}):</small>
                            <div class="row g-2">
                                @foreach($lokasi->media_tambahan_preview as $index => $media)
                                <div class="col-4">
                                    @if(str_starts_with($media['mime_type'] ?? '', 'image/'))
                                    <div class="position-relative">
                                        <img src="{{ $media['url'] ?? '' }}"
                                             alt="{{ $media['original_name'] }}"
                                             class="img-fluid rounded shadow-sm cursor-pointer"
                                             style="height: 80px; width: 100%; object-fit: cover;"
                                             onclick="showImageModal('{{ $media['url'] ?? '' }}', '{{ $media['original_name'] }}')">
                                    </div>
                                    @else
                                    <div class="bg-light rounded d-flex flex-column align-items-center justify-content-center p-2"
                                         style="height: 80px;">
                                        <i class="fas fa-file text-primary mb-1"></i>
                                        <small class="text-muted text-center">
                                            {{ pathinfo($media['original_name'], PATHINFO_EXTENSION) }}
                                        </small>
                                    </div>
                                    @endif
                                </div>
                                @endforeach

                                @if($lokasi->jumlah_media_tambahan > 3)
                                <div class="col-4">
                                    <div class="bg-light rounded d-flex flex-column align-items-center justify-content-center p-2 cursor-pointer"
                                         style="height: 80px;"
                                         onclick="showMediaModal({{ $lokasi->lokasi_id }})">
                                        <i class="fas fa-plus text-muted mb-1"></i>
                                        <small class="text-muted">
                                            +{{ $lokasi->jumlah_media_tambahan - 3 }} lainnya
                                        </small>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif

                        <!-- GeoJSON Preview -->
                        @if($lokasi->geojson)
                        <div class="mb-3">
                            <small class="text-muted d-block mb-1">GeoJSON Data:</small>
                            <div class="bg-light p-2 rounded">
                                <pre class="mb-0 small text-truncate" style="max-height: 40px;">
{{ json_encode($lokasi->geojson) }}
                                </pre>
                                <button class="btn btn-sm btn-outline-info mt-1 w-100"
                                        onclick="showGeojsonModal({{ $lokasi->lokasi_id }})">
                                    <i class="fas fa-eye me-1"></i>Lihat Detail
                                </button>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Card Footer -->
                    <div class="card-footer bg-white border-0 pt-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                <i class="fas fa-clock me-1"></i>
                                {{ $lokasi->created_at->diffForHumans() }}
                            </small>
                            <div class="btn-group">
                                <!-- Tombol Upload Media -->
                                <button class="btn btn-sm btn-success"
                                        data-bs-toggle="modal"
                                        data-bs-target="#uploadMediaModal{{ $lokasi->lokasi_id }}"
                                        title="Tambah Media">
                                    <i class="fas fa-plus"></i>
                                </button>

                                @if($lokasi->memiliki_media_tambahan)
                                <button class="btn btn-sm btn-outline-info"
                                        onclick="showMediaModal({{ $lokasi->lokasi_id }})"
                                        title="Lihat Media">
                                    <i class="fas fa-images"></i>
                                </button>
                                @endif

                                @if($lokasi->denah_gambar)
                                <button class="btn btn-sm btn-outline-warning"
                                        onclick="showImageModal('{{ $lokasi->denah_gambar_url }}', 'Denah {{ $lokasi->nama_lokasi }}')"
                                        title="Lihat Denah">
                                    <i class="fas fa-map"></i>
                                </button>
                                @endif

                                @if($lokasi->geojson)
                                <button class="btn btn-sm btn-outline-secondary"
                                        onclick="showGeojsonModal({{ $lokasi->lokasi_id }})"
                                        title="Lihat GeoJSON">
                                    <i class="fas fa-code"></i>
                                </button>
                                @endif

                                <a href="{{ route('lokasi.show', $lokasi->lokasi_id) }}"
                                   class="btn btn-sm btn-outline-primary"
                                   title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal untuk Upload Media -->
            <div class="modal fade" id="uploadMediaModal{{ $lokasi->lokasi_id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title">
                                <i class="fas fa-cloud-upload-alt me-2"></i>
                                Upload Media - {{ $lokasi->nama_lokasi }}
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="{{ route('lokasi.tambah-media', $lokasi->lokasi_id) }}"
                              method="POST"
                              enctype="multipart/form-data"
                              id="uploadMediaForm{{ $lokasi->lokasi_id }}">
                            @csrf
                            <div class="modal-body">
                                <!-- Input File -->
                                <div class="mb-3">
                                    <label class="form-label fw-bold">
                                        <i class="fas fa-file me-1"></i>Pilih File
                                    </label>
                                    <input type="file"
                                           class="form-control"
                                           name="media_tambahan"
                                           id="mediaInput{{ $lokasi->lokasi_id }}"
                                           required
                                           accept=".jpg,.jpeg,.png,.gif,.bmp,.webp,.pdf,.doc,.docx">
                                    <div class="form-text">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Ukuran maksimal 5MB per file.
                                        Format: Gambar, PDF, Dokumen
                                    </div>
                                </div>

                                <!-- Preview -->
                                <div class="mb-3 d-none" id="previewContainer{{ $lokasi->lokasi_id }}">
                                    <label class="form-label fw-bold">
                                        <i class="fas fa-image me-1"></i>Preview
                                    </label>
                                    <div id="preview{{ $lokasi->lokasi_id }}" class="text-center">
                                        <img id="previewImg{{ $lokasi->lokasi_id }}"
                                             src=""
                                             class="img-fluid rounded"
                                             style="max-height: 200px;">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    <i class="fas fa-times me-1"></i>Batal
                                </button>
                                <button type="submit" class="btn btn-success" id="uploadBtn{{ $lokasi->lokasi_id }}">
                                    <i class="fas fa-upload me-1"></i>Upload
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal untuk GeoJSON -->
            <div class="modal fade" id="geojsonModal{{ $lokasi->lokasi_id }}" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                <i class="fas fa-code me-2"></i>
                                GeoJSON - {{ $lokasi->nama_lokasi }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            @if($lokasi->geojson)
                            <div class="mb-3">
                                <label class="form-label fw-bold">Data GeoJSON:</label>
                                <pre class="bg-light p-3 rounded" style="max-height: 400px; overflow: auto;">
{{ json_encode($lokasi->geojson, JSON_PRETTY_PRINT) }}
                                </pre>
                            </div>
                            @else
                            <div class="text-center py-4">
                                <i class="fas fa-code fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Tidak ada data GeoJSON</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>

    <!-- Pagination -->
    @if($lokasis->hasPages())
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body py-3">
                    <div>
                        <div>
                            {{ $lokasis->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<!-- Modal untuk Media Viewer -->
<div class="modal fade" id="mediaViewerModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediaModalTitle">
                    <i class="fas fa-images me-2"></i>Media Tambahan
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="mediaModalContent">
                <!-- Content akan diisi oleh JavaScript -->
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Image Viewer -->
<div class="modal fade" id="imageViewerModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img id="imageModalImg" src="" class="img-fluid" alt="">
            </div>
        </div>
    </div>
</div>

<!-- Leaflet CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<style>
.lokasi-card {
    transition: all 0.3s ease;
    border: 1px solid #e9ecef;
    border-radius: 12px;
    overflow: hidden;
}

.lokasi-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
    border-color: #4e73df;
}

.statistic-card {
    border: none;
    border-radius: 15px;
    transition: all 0.3s ease;
}

.statistic-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.2) !important;
}

.bg-gradient-primary {
    background: linear-gradient(45deg, #4e73df, #224abe) !important;
}

.bg-gradient-info {
    background: linear-gradient(45deg, #36b9cc, #258391) !important;
}

.bg-gradient-success {
    background: linear-gradient(45deg, #1cc88a, #13855c) !important;
}

.bg-gradient-warning {
    background: linear-gradient(45deg, #f6c23e, #dda20a) !important;
}

.icon-circle {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: rgba(255,255,255,0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}

.text-truncate-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.cursor-pointer {
    cursor: pointer;
}

#map, #geojsonMap {
    z-index: 1;
}

.leaflet-popup-content {
    min-width: 200px;
}

.leaflet-popup-content h6 {
    margin-bottom: 5px;
    color: #2c3e50;
}

.leaflet-popup-content p {
    margin-bottom: 5px;
    font-size: 0.9rem;
}

.dropdown-menu {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    border: none;
}

.btn-group .btn {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
}

pre {
    font-size: 12px;
    font-family: 'Courier New', monospace;
    white-space: pre-wrap;
    word-wrap: break-word;
}

/* Responsive */
@media (max-width: 768px) {
    .lokasi-card {
        margin-bottom: 1rem;
    }

    .statistic-card .icon-circle {
        width: 40px;
        height: 40px;
        font-size: 1rem;
    }

    .statistic-card h2 {
        font-size: 1.5rem;
    }

    .modal-dialog {
        margin: 0.5rem;
    }
}
</style>

<script>
// Variabel global untuk map dan markers
let map;
let geojsonMap;
let markers = [];
let geojsonLayers = [];

document.addEventListener('DOMContentLoaded', function() {
    // Initialize main map
    initMap();

    // Initialize GeoJSON map
    initGeojsonMap();

    // Load GeoJSON data
    loadGeojsonData();

    // Setup preview untuk media upload
    document.querySelectorAll('[id^="mediaInput"]').forEach(input => {
        const lokasiId = input.id.replace('mediaInput', '');
        setupMediaPreview(lokasiId);
    });

    // Setup form submission untuk upload media
    document.querySelectorAll('[id^="uploadMediaForm"]').forEach(form => {
        const lokasiId = form.id.replace('uploadMediaForm', '');
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            uploadMedia(lokasiId, this);
        });
    });
});

function initMap() {
    // Initialize map centered on Indonesia
    map = L.map('map').setView([-2.5489, 118.0149], 5);

    // Add tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Load markers
    loadMarkers();
}

function initGeojsonMap() {
    // Initialize GeoJSON map
    geojsonMap = L.map('geojsonMap').setView([-2.5489, 118.0149], 5);

    // Add tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(geojsonMap);
}

function loadMarkers() {
    // Clear existing markers
    markers.forEach(marker => marker.remove());
    markers = [];

    // Fetch and add markers - PERBAIKI ROUTE INI
    fetch('{{ route("lokasi.api.map-data") }}')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Jika response berupa object dengan property data
            const lokasiData = Array.isArray(data) ? data : (data.data || []);

            lokasiData.forEach(lokasi => {
                if (lokasi.lat && lokasi.lng) {
                    const customIcon = L.divIcon({
                        html: `<div class="marker-icon bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; border: 3px solid white; box-shadow: 0 2px 5px rgba(0,0,0,0.3);">
                                 <i class="fas fa-map-marker-alt"></i>
                               </div>`,
                        className: 'custom-div-icon',
                        iconSize: [40, 40],
                        iconAnchor: [20, 40],
                        popupAnchor: [0, -40]
                    });

                    const marker = L.marker([lokasi.lat, lokasi.lng], { icon: customIcon })
                        .addTo(map)
                        .bindPopup(`
                            <div style="max-width: 250px;">
                                <h6 class="fw-bold mb-1">${lokasi.nama_lokasi}</h6>
                                <p class="mb-1"><strong>Proyek:</strong> ${lokasi.proyek}</p>
                                <p class="mb-2"><strong>Alamat:</strong> ${lokasi.alamat || '-'}</p>
                                ${lokasi.denah_url ? `<p class="mb-2"><img src="${lokasi.denah_url}" style="width: 100%; height: 100px; object-fit: cover; border-radius: 4px;"></p>` : ''}
                                <div class="d-flex gap-2">
                                    <a href="${lokasi.url}" class="btn btn-sm btn-primary flex-fill" target="_blank">
                                        <i class="fas fa-info-circle me-1"></i> Detail
                                    </a>
                                    <a href="${lokasi.edit_url}" class="btn btn-sm btn-warning flex-fill" target="_blank">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a>
                                </div>
                            </div>
                        `);

                    markers.push(marker);
                }
            });

            // Fit bounds if there are markers
            if (markers.length > 0) {
                const group = new L.featureGroup(markers);
                map.fitBounds(group.getBounds(), {
                    padding: [50, 50],
                    maxZoom: 15
                });
            } else {
                console.log('Tidak ada data lokasi dengan koordinat');
            }
        })
        .catch(error => {
            console.error('Error loading map data:', error);
            showAlert('danger', 'Gagal memuat data peta');
        });
}

function loadGeojsonData() {
    // Clear existing GeoJSON layers
    geojsonLayers.forEach(layer => geojsonMap.removeLayer(layer));
    geojsonLayers = [];

    // Fetch and add GeoJSON data - PERBAIKI ROUTE INI
    fetch('{{ route("lokasi.api.geojson-data") }}')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            const geojsonContainer = document.getElementById('geojsonData');
            geojsonContainer.innerHTML = '';

            // Jika response berupa object dengan property data
            const geojsonData = Array.isArray(data) ? data : (data.data || []);

            if (geojsonData.length === 0) {
                geojsonContainer.innerHTML = '<p class="text-muted mb-0">Tidak ada data GeoJSON</p>';
                return;
            }

            // Create summary list
            const ul = document.createElement('ul');
            ul.className = 'list-unstyled mb-0';

            geojsonData.forEach(item => {
                const li = document.createElement('li');
                li.className = 'mb-2 pb-2 border-bottom';
                li.innerHTML = `
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <strong class="d-block">${item.nama_lokasi}</strong>
                            <small class="text-muted">Proyek: ${item.proyek}</small>
                        </div>
                        <a href="${item.url}" target="_blank" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>
                `;
                ul.appendChild(li);

                // Add GeoJSON to map
                if (item.geojson) {
                    try {
                        const geojsonLayer = L.geoJSON(item.geojson, {
                            style: {
                                color: '#4e73df',
                                weight: 2,
                                opacity: 0.8,
                                fillOpacity: 0.1
                            },
                            onEachFeature: function(feature, layer) {
                                if (feature.properties) {
                                    layer.bindPopup(`
                                        <div style="max-width: 250px;">
                                            <h6 class="fw-bold mb-1">${item.nama_lokasi}</h6>
                                            <p class="mb-1"><strong>Proyek:</strong> ${item.proyek}</p>
                                            <a href="${item.url}" target="_blank" class="btn btn-sm btn-primary w-100">
                                                <i class="fas fa-info-circle me-1"></i> Detail
                                            </a>
                                        </div>
                                    `);
                                }
                            }
                        }).addTo(geojsonMap);

                        geojsonLayers.push(geojsonLayer);
                    } catch (error) {
                        console.error('Error parsing GeoJSON:', error);
                    }
                }
            });

            geojsonContainer.appendChild(ul);

            // Fit bounds if there are GeoJSON layers
            if (geojsonLayers.length > 0) {
                const group = new L.featureGroup(geojsonLayers);
                geojsonMap.fitBounds(group.getBounds(), {
                    padding: [50, 50],
                    maxZoom: 15
                });
            }
        })
        .catch(error => {
            console.error('Error loading GeoJSON data:', error);
            document.getElementById('geojsonData').innerHTML = '<p class="text-danger mb-0">Error loading GeoJSON data</p>';
        });
}

function refreshMap() {
    loadMarkers();
}

function setupMediaPreview(lokasiId) {
    const input = document.getElementById('mediaInput' + lokasiId);
    const previewContainer = document.getElementById('previewContainer' + lokasiId);
    const previewImg = document.getElementById('previewImg' + lokasiId);

    if (input) {
        input.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const file = this.files[0];

                // Validasi ukuran file (5MB)
                const maxSize = 5 * 1024 * 1024;
                if (file.size > maxSize) {
                    alert('File melebihi batas ukuran 5MB');
                    this.value = '';
                    previewContainer.classList.add('d-none');
                    return;
                }

                // Validasi tipe file
                const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/bmp', 'image/webp', 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
                if (!allowedTypes.includes(file.type)) {
                    alert('Tipe file tidak didukung');
                    this.value = '';
                    previewContainer.classList.add('d-none');
                    return;
                }

                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                        previewContainer.classList.remove('d-none');
                    }
                    reader.readAsDataURL(file);
                } else {
                    // Untuk file non-gambar, sembunyikan preview
                    previewContainer.classList.add('d-none');
                }
            } else {
                previewContainer.classList.add('d-none');
            }
        });
    }
}

async function uploadMedia(lokasiId, form) {
    const uploadBtn = document.getElementById('uploadBtn' + lokasiId);
    const originalText = uploadBtn.innerHTML;

    try {
        uploadBtn.disabled = true;
        uploadBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Mengupload...';

        const formData = new FormData(form);

        const response = await fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        });

        const data = await response.json();

        if (data.success) {
            showAlert('success', data.message);
            // Close modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('uploadMediaModal' + lokasiId));
            if (modal) modal.hide();

            // Reload page after 1 second
            setTimeout(() => {
                location.reload();
            }, 1000);
        } else {
            showAlert('danger', data.message || 'Gagal mengupload media');
        }
    } catch (error) {
        console.error('Error:', error);
        showAlert('danger', 'Terjadi kesalahan saat mengupload');
    } finally {
        uploadBtn.disabled = false;
        uploadBtn.innerHTML = originalText;
    }
}

function showMediaModal(lokasiId) {
    fetch(`/lokasi/${lokasiId}`)
        .then(response => response.text())
        .then(html => {
            // Parse HTML untuk mendapatkan media content
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const mediaContent = doc.querySelector('#mediaGallery')?.innerHTML;

            if (mediaContent) {
                document.getElementById('mediaModalTitle').innerHTML = `<i class="fas fa-images me-2"></i>Media Tambahan`;
                document.getElementById('mediaModalContent').innerHTML = mediaContent;

                const modal = new bootstrap.Modal(document.getElementById('mediaViewerModal'));
                modal.show();
            } else {
                showAlert('info', 'Tidak ada media tambahan untuk lokasi ini');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('danger', 'Gagal memuat data media');
        });
}

function showImageModal(imageUrl, title) {
    document.getElementById('imageModalTitle').textContent = title;
    document.getElementById('imageModalImg').src = imageUrl;

    const modal = new bootstrap.Modal(document.getElementById('imageViewerModal'));
    modal.show();
}

function showGeojsonModal(lokasiId) {
    const modalElement = document.getElementById('geojsonModal' + lokasiId);
    if (modalElement) {
        const modal = new bootstrap.Modal(modalElement);
        modal.show();
    }
}

function showAlert(type, message) {
    // Hapus alert sebelumnya jika ada
    const existingAlert = document.querySelector('.alert-fixed');
    if (existingAlert) existingAlert.remove();

    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} alert-dismissible fade show alert-fixed position-fixed top-0 end-0 m-3`;
    alertDiv.style.zIndex = '9999';
    alertDiv.innerHTML = `
        <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;

    document.body.appendChild(alertDiv);

    setTimeout(() => {
        if (alertDiv.parentNode) {
            alertDiv.remove();
        }
    }, 5000);
}
</script>
@endsection
