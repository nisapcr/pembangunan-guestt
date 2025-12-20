@extends('layouts.guest.app')

@section('title', 'Detail Lokasi Proyek')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h3>
                    <i class="fas fa-map-marker-alt text-primary me-2"></i>
                    {{ $lokasi->nama_lokasi }}
                </h3>
                <div class="btn-group">
                    <a href="{{ route('lokasi.edit', $lokasi->lokasi_id) }}"
                       class="btn btn-warning">
                        <i class="fas fa-edit me-1"></i> Edit
                    </a>
                    <a href="{{ route('lokasi.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
            <hr>
        </div>
    </div>

    <!-- Alert Messages -->
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

    <div class="row">
        <!-- Left Column -->
        <div class="col-md-8">
            <!-- DENAH GAMBAR -->
            @if($lokasi->denah_gambar)
            <div class="card mb-4">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-map me-2"></i>Denah Lokasi
                    </h5>
                    <div>
                        <a href="{{ route('lokasi.denah.view', $lokasi->lokasi_id) }}"
                           target="_blank"
                           class="btn btn-sm btn-light me-1">
                            <i class="fas fa-expand me-1"></i> Full Screen
                        </a>
                        <a href="{{ route('lokasi.denah.view', $lokasi->lokasi_id) }}?download=true"
                           class="btn btn-sm btn-light">
                            <i class="fas fa-download me-1"></i> Download
                        </a>
                    </div>
                </div>
                <div class="card-body text-center">
                    <img src="{{ route('lokasi.denah.view', $lokasi->lokasi_id) }}"
                         alt="Denah {{ $lokasi->nama_lokasi }}"
                         class="img-fluid rounded shadow"
                         style="max-height: 400px; cursor: pointer;"
                         onclick="window.open('{{ route('lokasi.denah.view', $lokasi->lokasi_id) }}', '_blank')">
                    <p class="text-muted mt-2 mb-0">Klik gambar untuk melihat ukuran penuh</p>
                </div>
            </div>
            @endif

            <!-- Basic Info Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>Informasi Lokasi
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th width="30%">Nama Lokasi</th>
                                <td>{{ $lokasi->nama_lokasi }}</td>
                            </tr>
                            <tr>
                                <th>Proyek</th>
                                <td>
                                    @if($lokasi->proyek)
                                        <a href="{{ route('proyek.show', $lokasi->proyek->proyek_id) }}" class="text-decoration-none">
                                            <span class="badge bg-info">{{ $lokasi->proyek->nama_proyek }}</span>
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>{{ $lokasi->alamat ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Koordinat</th>
                                <td>
                                    @if($lokasi->lat && $lokasi->lng)
                                        <code>Lat: {{ $lokasi->lat }}, Lng: {{ $lokasi->lng }}</code>
                                        <a href="https://maps.google.com/?q={{ $lokasi->lat }},{{ $lokasi->lng }}"
                                           target="_blank"
                                           class="btn btn-sm btn-outline-primary ms-2">
                                            <i class="fas fa-external-link-alt me-1"></i> Google Maps
                                        </a>
                                    @else
                                        <span class="text-muted">Tidak ada koordinat</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Dibuat</th>
                                <td>
                                    <i class="fas fa-calendar-plus text-secondary me-1"></i>
                                    {{ $lokasi->created_at->format('d/m/Y H:i') }}
                                </td>
                            </tr>
                            <tr>
                                <th>Diupdate</th>
                                <td>
                                    <i class="fas fa-calendar-check text-secondary me-1"></i>
                                    {{ $lokasi->updated_at->format('d/m/Y H:i') }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Media Gallery -->
            @php
                $mediaArray = $lokasi->media_tambahan_fixed;
                $mediaCount = count($mediaArray);
            @endphp

            @if($mediaCount > 0)
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-images me-2"></i>Media Tambahan ({{ $mediaCount }} file)
                    </h5>
                    <small class="text-muted">Klik untuk melihat/download</small>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($mediaArray as $index => $media)
                        @php
                            // Gunakan 'mime' atau fallback ke 'nime' jika ada typo
                            $mimeType = $media['mime'] ?? $media['nime'] ?? 'application/octet-stream';
                            $isImage = str_starts_with($mimeType, 'image/');
                            $isPDF = $mimeType === 'application/pdf';

                            $fileName = $media['original_name'] ?? 'File ' . ($index + 1);
                            $fileSize = isset($media['size']) ? round($media['size'] / 1024, 1) : 0;
                        @endphp
                        <div class="col-md-3 col-sm-6 mb-3">
                            <div class="card h-100 shadow-sm hover-shadow" style="transition: all 0.3s;">
                                <div class="card-body text-center p-3">
                                    @if($isImage)
                                        <!-- Untuk gambar, gunakan route view -->
                                        <img src="{{ route('lokasi.media.view', ['id' => $lokasi->lokasi_id, 'index' => $index]) }}"
                                             alt="{{ $fileName }}"
                                             class="img-fluid rounded mb-2"
                                             style="height: 120px; width: 100%; object-fit: cover; cursor: pointer;"
                                             onclick="window.open('{{ route('lokasi.media.view', ['id' => $lokasi->lokasi_id, 'index' => $index]) }}', '_blank')">
                                    @elseif($isPDF)
                                        <!-- Untuk PDF -->
                                        <div class="py-4" style="height: 120px; cursor: pointer;"
                                             onclick="window.open('{{ route('lokasi.media.view', ['id' => $lokasi->lokasi_id, 'index' => $index]) }}', '_blank')">
                                            <i class="fas fa-file-pdf fa-4x text-danger mb-2"></i>
                                        </div>
                                    @else
                                        <!-- Untuk file lainnya -->
                                        <div class="py-4" style="height: 120px; cursor: pointer;">
                                            <i class="fas fa-file fa-4x text-secondary mb-2"></i>
                                        </div>
                                    @endif
                                    <h6 class="text-truncate mb-1" title="{{ $fileName }}">
                                        {{ Str::limit($fileName, 20) }}
                                    </h6>
                                    <small class="text-muted d-block">
                                        <i class="fas fa-hdd me-1"></i>{{ $fileSize }} KB
                                    </small>
                                </div>
                                <div class="card-footer bg-transparent border-top-0 p-2">
                                    <div class="d-flex justify-content-center">
                                        @if($isImage || $isPDF)
                                            <!-- Untuk gambar dan PDF, tampilkan tombol view -->
                                            <a href="{{ route('lokasi.media.view', ['id' => $lokasi->lokasi_id, 'index' => $index]) }}"
                                               target="_blank"
                                               class="btn btn-sm btn-outline-primary me-1"
                                               title="Lihat">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        @endif

                                        <!-- Tombol download untuk semua file -->
                                        <a href="{{ route('lokasi.download-media', ['id' => $lokasi->lokasi_id, 'index' => $index]) }}"
                                           class="btn btn-sm btn-outline-success {{ $isImage || $isPDF ? '' : 'me-1' }}"
                                           title="Download">
                                            <i class="fas fa-download"></i>
                                        </a>

                                        <!-- Tombol hapus -->
                                        <form action="{{ route('lokasi.hapus-media', ['id' => $lokasi->lokasi_id, 'index' => $index]) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Hapus media ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger ms-1" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Right Column -->
        <div class="col-md-4">
            <!-- Actions Card -->
            <div class="card mb-4">
                <div class="card-header bg-warning">
                    <h5 class="mb-0">
                        <i class="fas fa-tools me-2"></i>Aksi
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('lokasi.edit', $lokasi->lokasi_id) }}"
                           class="btn btn-warning">
                            <i class="fas fa-edit me-1"></i> Edit Lokasi
                        </a>

                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addMediaModal">
                            <i class="fas fa-plus-circle me-1"></i> Tambah Media
                        </button>

                        <form action="{{ route('lokasi.destroy', $lokasi->lokasi_id) }}"
                              method="POST"
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus lokasi ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash me-1"></i> Hapus Lokasi
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Status Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-chart-bar me-2"></i>Status
                    </h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <i class="fas fa-map me-2"></i>Denah Gambar
                            </span>
                            @if($lokasi->denah_gambar)
                                <span class="badge bg-success rounded-pill">
                                    <i class="fas fa-check me-1"></i>Ada
                                </span>
                            @else
                                <span class="badge bg-secondary rounded-pill">
                                    <i class="fas fa-times me-1"></i>Tidak ada
                                </span>
                            @endif
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <i class="fas fa-paperclip me-2"></i>Media Tambahan
                            </span>
                            <span class="badge bg-primary rounded-pill">
                                {{ $mediaCount }} file
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <i class="fas fa-map-marker-alt me-2"></i>Koordinat
                            </span>
                            @if($lokasi->lat && $lokasi->lng)
                                <span class="badge bg-success rounded-pill">
                                    <i class="fas fa-check me-1"></i>Lengkap
                                </span>
                            @else
                                <span class="badge bg-warning rounded-pill">
                                    <i class="fas fa-exclamation me-1"></i>Perlu koordinat
                                </span>
                            @endif
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <i class="fas fa-layer-group me-2"></i>GeoJSON
                            </span>
                            @if($lokasi->geojson)
                                <span class="badge bg-info rounded-pill">
                                    <i class="fas fa-check me-1"></i>Ada
                                </span>
                            @else
                                <span class="badge bg-secondary rounded-pill">
                                    <i class="fas fa-times me-1"></i>Tidak ada
                                </span>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-link me-2"></i>Tautan Cepat
                    </h5>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        @if($lokasi->proyek)
                            <a href="{{ route('proyek.show', $lokasi->proyek->proyek_id) }}"
                               class="list-group-item list-group-item-action">
                                <i class="fas fa-project-diagram me-2"></i>
                                Lihat Detail Proyek
                            </a>
                        @endif
                        <a href="{{ route('lokasi.index') }}"
                           class="list-group-item list-group-item-action">
                            <i class="fas fa-list me-2"></i>
                            Daftar Semua Lokasi
                        </a>
                        @if($lokasi->lat && $lokasi->lng)
                            <a href="https://maps.google.com/?q={{ $lokasi->lat }},{{ $lokasi->lng }}"
                               target="_blank"
                               class="list-group-item list-group-item-action">
                                <i class="fas fa-map-marked-alt me-2"></i>
                                Buka di Google Maps
                            </a>
                        @endif
                        @if($lokasi->denah_gambar)
                            <a href="{{ route('lokasi.denah.view', $lokasi->lokasi_id) }}"
                               target="_blank"
                               class="list-group-item list-group-item-action">
                                <i class="fas fa-image me-2"></i>
                                Lihat Denah Full Screen
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Add Media -->
<div class="modal fade" id="addMediaModal" tabindex="-1" aria-labelledby="addMediaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMediaModalLabel">
                    <i class="fas fa-plus-circle me-2"></i>Tambah Media
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('lokasi.tambah-media', $lokasi->lokasi_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Pilih File</label>
                        <input type="file" name="media_tambahan" class="form-control" required>
                        <small class="text-muted">Format: Gambar (JPEG, PNG, GIF), PDF, DOC, DOCX, XLS, XLSX. Maks: 5MB</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-upload me-1"></i> Upload
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.hover-shadow:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}
.card {
    transition: all 0.3s ease;
}
</style>

<script>
// Auto close alerts after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);
});
</script>
@endsection
