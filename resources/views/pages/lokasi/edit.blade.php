@extends('layouts.guest.app')
@section('title', 'Edit Lokasi Proyek')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card shadow">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-edit me-2"></i>Edit Lokasi Proyek
                    </h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('lokasi.update', $lokasi->lokasi_id) }}" method="POST" enctype="multipart/form-data" id="lokasiForm">
                        @csrf
                        @method('PUT')

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-6">
                                <!-- Proyek -->
                                <div class="mb-3">
                                    <label class="form-label">Proyek <span class="text-danger">*</span></label>
                                    <select name="proyek_id"
                                            class="form-control @error('proyek_id') is-invalid @enderror" required>
                                        <option value="">-- Pilih Proyek --</option>
                                        @foreach ($proyeks as $proyek)
                                            <option value="{{ $proyek->proyek_id }}"
                                                {{ old('proyek_id', $lokasi->proyek_id) == $proyek->proyek_id ? 'selected' : '' }}>
                                                {{ $proyek->nama_proyek }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('proyek_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Nama Lokasi -->
                                <div class="mb-3">
                                    <label class="form-label">Nama Lokasi <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_lokasi"
                                           class="form-control @error('nama_lokasi') is-invalid @enderror"
                                           value="{{ old('nama_lokasi', $lokasi->nama_lokasi) }}" required>
                                    @error('nama_lokasi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Alamat -->
                                <div class="mb-3">
                                    <label class="form-label">Alamat Lengkap</label>
                                    <textarea name="alamat" rows="4"
                                              class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $lokasi->alamat) }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Koordinat -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Latitude</label>
                                        <input type="number" name="lat" step="any"
                                               class="form-control @error('lat') is-invalid @enderror"
                                               value="{{ old('lat', $lokasi->lat) }}"
                                               id="latInput">
                                        @error('lat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Longitude</label>
                                        <input type="number" name="lng" step="any"
                                               class="form-control @error('lng') is-invalid @enderror"
                                               value="{{ old('lng', $lokasi->lng) }}"
                                               id="lngInput">
                                        @error('lng')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="col-md-6">
                                <!-- Map Picker -->
                                <div class="mb-3">
                                    <label class="form-label">Pilih Koordinat di Peta</label>
                                    <div id="mapPicker" style="height: 250px; border-radius: 8px; border: 1px solid #dee2e6;"></div>
                                    <small class="text-muted">Klik pada peta untuk mengubah koordinat</small>
                                </div>

                                <!-- Denah Gambar -->
                                <div class="mb-3">
                                    <label class="form-label">Denah Gambar</label>

                                    <!-- Current Denah -->
                                    @if($lokasi->denah_gambar)
                                    <div class="mb-2">
                                        <p class="text-muted mb-1">Denah saat ini:</p>
                                        <img src="{{ $lokasi->denah_gambar_url }}"
                                             class="img-fluid rounded border"
                                             style="max-height: 150px;">
                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="checkbox"
                                                   name="hapus_denah" id="hapusDenah" value="1">
                                            <label class="form-check-label text-danger" for="hapusDenah">
                                                Hapus denah saat ini
                                            </label>
                                        </div>
                                    </div>
                                    @endif

                                    <!-- Upload New Denah -->
                                    <input type="file" name="denah_gambar"
                                           class="form-control @error('denah_gambar') is-invalid @enderror"
                                           accept="image/*" id="denahInput">
                                    @error('denah_gambar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Format: JPG, PNG, GIF, SVG. Maks: 2MB</small>

                                    <!-- Preview New Denah -->
                                    <div id="denahPreview" class="mt-2 d-none">
                                        <p class="text-muted mb-1">Preview denah baru:</p>
                                        <img id="denahPreviewImg" src="" class="img-fluid rounded" style="max-height: 150px;">
                                    </div>
                                </div>

                                <!-- Media Tambahan Baru -->
                                <div class="mb-3">
                                    <label class="form-label">Tambah Media Tambahan (opsional)</label>
                                    <input type="file" name="media_tambahan_baru[]"
                                           class="form-control"
                                           accept="image/*,.pdf,.doc,.docx,.xls,.xlsx"
                                           multiple id="mediaInput">
                                    <small class="text-muted">Format: Gambar, PDF, DOC, XLS. Maks: 5MB per file</small>

                                    <!-- Preview New Media -->
                                    <div id="mediaPreviewContainer" class="row mt-2"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Full Width Row -->
                        <div class="row">
                            <div class="col-12">
                                <!-- GeoJSON -->
                                <div class="mb-3">
                                    <label class="form-label">Data GeoJSON (opsional)</label>
                                    <textarea name="geojson" rows="5"
                                              class="form-control @error('geojson') is-invalid @enderror"
                                              placeholder='Masukkan data GeoJSON (format JSON)'>{{ old('geojson', $lokasi->geojson ? json_encode($lokasi->geojson, JSON_PRETTY_PRINT) : '') }}</textarea>
                                    @error('geojson')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Format JSON yang valid. Kosongkan jika tidak ada.</small>
                                </div>

                                <!-- Media Tambahan Existing -->
                                @if($lokasi->memiliki_media_tambahan)
                                <div class="mb-3">
                                    <label class="form-label">Media Tambahan yang Sudah Ada</label>
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Media dapat dihapus dari halaman detail lokasi atau saat menambah media baru.
                                    </div>
                                    <div class="row">
                                        @foreach($lokasi->media_tambahan_parsed as $index => $media)
                                        <div class="col-md-3 mb-3">
                                            <div class="card border-0 shadow-sm">
                                                @if(str_starts_with($media['mime_type'] ?? '', 'image/'))
                                                <img src="{{ asset('storage/' . $media['path']) }}"
                                                     class="card-img-top"
                                                     alt="{{ $media['original_name'] }}"
                                                     style="height: 100px; object-fit: cover;">
                                                @else
                                                <div class="card-body text-center py-3">
                                                    <i class="fas fa-file fa-2x text-primary mb-2"></i>
                                                    <h6 class="text-truncate mb-0">{{ $media['original_name'] }}</h6>
                                                    <small class="text-muted">
                                                        {{ pathinfo($media['original_name'], PATHINFO_EXTENSION) }}
                                                    </small>
                                                </div>
                                                @endif
                                                <div class="card-body p-2">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <small class="text-muted text-truncate">
                                                            {{ $media['original_name'] }}
                                                        </small>
                                                        <small class="text-muted">
                                                            {{ round(($media['file_size'] ?? 0) / 1024, 1) }} KB
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('lokasi.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                            <div>
                                <a href="{{ route('lokasi.show', $lokasi->lokasi_id) }}" class="btn btn-info me-2">
                                    <i class="fas fa-eye me-1"></i> Lihat
                                </a>
                                <button type="submit" class="btn btn-primary" id="submitBtn">
                                    <i class="fas fa-save me-1"></i> Update Lokasi
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Leaflet untuk map picker -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<style>
#mapPicker {
    z-index: 1;
}

.media-item {
    transition: all 0.2s ease;
}

.media-item:hover {
    transform: translateY(-2px);
}

.remove-media {
    width: 30px;
    height: 30px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.preview-item {
    position: relative;
    border-radius: 8px;
    overflow: hidden;
    border: 1px solid #dee2e6;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Map picker
    const defaultLat = {{ $lokasi->lat ?? -6.2088 }};
    const defaultLng = {{ $lokasi->lng ?? 106.8456 }};
    const zoom = {{ $lokasi->lat ? 15 : 12 }};

    const map = L.map('mapPicker').setView([defaultLat, defaultLng], zoom);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    let marker;

    // Add marker jika ada koordinat
    if (defaultLat && defaultLng) {
        marker = L.marker([defaultLat, defaultLng]).addTo(map);
    }

    // Click event untuk set marker
    map.on('click', function(e) {
        const lat = e.latlng.lat;
        const lng = e.latlng.lng;

        // Update form fields
        document.getElementById('latInput').value = lat.toFixed(8);
        document.getElementById('lngInput').value = lng.toFixed(8);

        // Update atau buat marker baru
        if (marker) {
            marker.setLatLng(e.latlng);
        } else {
            marker = L.marker(e.latlng).addTo(map);
        }
    });

    // Preview denah gambar baru
    const denahInput = document.getElementById('denahInput');
    const denahPreview = document.getElementById('denahPreview');
    const denahPreviewImg = document.getElementById('denahPreviewImg');

    if (denahInput) {
        denahInput.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const file = this.files[0];

                // Validasi ukuran file (2MB)
                const maxSize = 2 * 1024 * 1024;
                if (file.size > maxSize) {
                    alert('File melebihi batas ukuran 2MB');
                    this.value = '';
                    denahPreview.classList.add('d-none');
                    return;
                }

                // Validasi tipe file
                const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml'];
                if (!allowedTypes.includes(file.type)) {
                    alert('Tipe file tidak didukung. Hanya gambar yang diperbolehkan.');
                    this.value = '';
                    denahPreview.classList.add('d-none');
                    return;
                }

                const reader = new FileReader();

                reader.onload = function(e) {
                    denahPreviewImg.src = e.target.result;
                    denahPreview.classList.remove('d-none');
                }

                reader.readAsDataURL(file);
            } else {
                denahPreview.classList.add('d-none');
            }
        });
    }

    // Preview media tambahan baru
    const mediaInput = document.getElementById('mediaInput');
    const mediaPreviewContainer = document.getElementById('mediaPreviewContainer');

    if (mediaInput) {
        mediaInput.addEventListener('change', function(e) {
            mediaPreviewContainer.innerHTML = '';

            if (this.files && this.files.length > 0) {
                // Validasi jumlah file
                const maxFiles = 5;
                if (this.files.length > maxFiles) {
                    alert(`Maksimal ${maxFiles} file yang dapat diupload sekaligus`);
                    this.value = '';
                    return;
                }

                Array.from(this.files).forEach((file, index) => {
                    // Validasi ukuran file (5MB)
                    const maxSize = 5 * 1024 * 1024;
                    if (file.size > maxSize) {
                        alert(`File "${file.name}" melebihi batas ukuran 5MB`);
                        this.value = '';
                        return;
                    }

                    // Validasi tipe file
                    const allowedTypes = [
                        'image/jpeg', 'image/png', 'image/gif', 'image/bmp', 'image/webp',
                        'application/pdf',
                        'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                    ];
                    if (!allowedTypes.includes(file.type)) {
                        alert(`Tipe file "${file.name}" tidak didukung`);
                        this.value = '';
                        return;
                    }

                    // Buat preview item
                    const col = document.createElement('div');
                    col.className = 'col-md-3 mb-3';

                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            col.innerHTML = `
                                <div class="preview-item">
                                    <img src="${e.target.result}"
                                         class="img-fluid"
                                         style="height: 100px; width: 100%; object-fit: cover;">
                                    <div class="p-2">
                                        <small class="text-muted d-block text-truncate">${file.name}</small>
                                        <small class="text-muted">${(file.size / 1024).toFixed(1)} KB</small>
                                        <button type="button" class="btn btn-sm btn-danger remove-media w-100 mt-1" data-index="${index}">
                                            <i class="fas fa-times me-1"></i> Hapus
                                        </button>
                                    </div>
                                </div>
                            `;

                            // Add remove event listener
                            col.querySelector('.remove-media').addEventListener('click', function() {
                                removeFileFromInput(this.dataset.index);
                            });
                        }
                        reader.readAsDataURL(file);
                    } else {
                        // Tentukan icon berdasarkan tipe file
                        let fileIcon = 'fa-file';
                        let fileColor = 'text-primary';

                        if (file.type.includes('pdf')) {
                            fileIcon = 'fa-file-pdf';
                            fileColor = 'text-danger';
                        } else if (file.type.includes('word')) {
                            fileIcon = 'fa-file-word';
                            fileColor = 'text-primary';
                        } else if (file.type.includes('excel')) {
                            fileIcon = 'fa-file-excel';
                            fileColor = 'text-success';
                        }

                        col.innerHTML = `
                            <div class="preview-item">
                                <div class="d-flex flex-column align-items-center justify-content-center p-3"
                                     style="height: 100px;">
                                    <i class="fas ${fileIcon} fa-2x ${fileColor} mb-2"></i>
                                    <small class="text-muted text-center">
                                        ${pathinfo(file.name).extension.toUpperCase()}
                                    </small>
                                </div>
                                <div class="p-2">
                                    <small class="text-muted d-block text-truncate">${file.name}</small>
                                    <small class="text-muted">${(file.size / 1024).toFixed(1)} KB</small>
                                    <button type="button" class="btn btn-sm btn-danger remove-media w-100 mt-1" data-index="${index}">
                                        <i class="fas fa-times me-1"></i> Hapus
                                    </button>
                                </div>
                            </div>
                        `;

                        // Add remove event listener
                        col.querySelector('.remove-media').addEventListener('click', function() {
                            removeFileFromInput(this.dataset.index);
                        });
                    }

                    mediaPreviewContainer.appendChild(col);
                });
            }
        });
    }

    // Helper function untuk remove file dari input
    function removeFileFromInput(index) {
        const input = document.getElementById('mediaInput');
        const dt = new DataTransfer();
        const files = Array.from(input.files);

        // Hapus file dari array
        files.splice(index, 1);

        // Tambahkan file yang tersisa ke DataTransfer
        files.forEach(file => {
            dt.items.add(file);
        });

        // Update file input
        input.files = dt.files;

        // Trigger change event untuk update preview
        const event = new Event('change');
        input.dispatchEvent(event);
    }

    // Helper function untuk mendapatkan ekstensi file
    function pathinfo(filename) {
        const name = filename.substring(0, filename.lastIndexOf('.'));
        const extension = filename.substring(filename.lastIndexOf('.') + 1);
        return { name, extension };
    }

    // Form submission
    const form = document.getElementById('lokasiForm');
    const submitBtn = document.getElementById('submitBtn');

    form.addEventListener('submit', function(e) {
        // Validasi GeoJSON
        const geojsonInput = document.querySelector('textarea[name="geojson"]');
        if (geojsonInput.value.trim()) {
            try {
                JSON.parse(geojsonInput.value);
            } catch (error) {
                e.preventDefault();
                alert('Format GeoJSON tidak valid. Harap periksa kembali.');
                geojsonInput.focus();
                return;
            }
        }

        // Disable button dan tampilkan loading
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Menyimpan...';
    });
});
</script>
@endsection
