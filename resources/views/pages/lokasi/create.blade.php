@extends('layouts.guest.app')
@section('title', 'Tambah Lokasi Proyek')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i>Tambah Lokasi Proyek
                    </h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('lokasi.store') }}" method="POST" enctype="multipart/form-data" id="form-lokasi">
                        @csrf

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
                                    <select name="proyek_id" class="form-select @error('proyek_id') is-invalid @enderror" required>
                                        <option value="">Pilih Proyek</option>
                                        @foreach($proyeks as $proyek)
                                            <option value="{{ $proyek->proyek_id }}" {{ old('proyek_id') == $proyek->proyek_id ? 'selected' : '' }}>
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
                                    <input type="text" name="nama_lokasi" class="form-control @error('nama_lokasi') is-invalid @enderror"
                                           value="{{ old('nama_lokasi') }}" required>
                                    @error('nama_lokasi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Alamat -->
                                <div class="mb-3">
                                    <label class="form-label">Alamat Lengkap</label>
                                    <textarea name="alamat" rows="4" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Koordinat -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Latitude</label>
                                        <input type="number" step="any" name="lat" class="form-control @error('lat') is-invalid @enderror"
                                               value="{{ old('lat') }}" id="latInput">
                                        @error('lat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Longitude</label>
                                        <input type="number" step="any" name="lng" class="form-control @error('lng') is-invalid @enderror"
                                               value="{{ old('lng') }}" id="lngInput">
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
                                    <label class="form-label">Pilih Koordinat di Peta (Opsional)</label>
                                    <div id="mapPicker" style="height: 250px; border-radius: 8px; border: 1px solid #dee2e6;"></div>
                                    <small class="text-muted">Klik pada peta untuk mengatur koordinat</small>
                                </div>

                                <!-- FOTO UTAMA -->
                                <div class="mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-camera me-1"></i>Foto Utama Lokasi
                                    </label>
                                    <input type="file" name="denah_gambar"
                                           class="form-control @error('denah_gambar') is-invalid @enderror"
                                           accept="image/*" id="fotoUtamaInput">
                                    @error('denah_gambar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Upload foto visual lokasi (Format: JPG, PNG. Maks: 2MB)</small>

                                    <!-- Preview -->
                                    <div id="fotoPreview" class="mt-2 d-none">
                                        <p class="text-muted mb-1">Preview foto:</p>
                                        <img id="fotoPreviewImg" src="" class="img-fluid rounded" style="max-height: 150px;">
                                    </div>
                                </div>

                                <!-- Media Tambahan -->
                                <div class="mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-paperclip me-1"></i>Media Tambahan (Opsional)
                                    </label>
                                    <input type="file" name="media_tambahan[]"
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
                                    <label class="form-label">
                                        <i class="fas fa-map-marked-alt me-1"></i>Data GeoJSON (Opsional)
                                    </label>
                                    <textarea name="geojson" rows="5" class="form-control @error('geojson') is-invalid @enderror"
                                              placeholder='Masukkan data GeoJSON (format JSON)'>{{ old('geojson') }}</textarea>
                                    @error('geojson')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Format JSON yang valid. Kosongkan jika tidak ada.</small>
                                </div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('lokasi.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="fas fa-save me-1"></i> Simpan Lokasi
                            </button>
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
    const map = L.map('mapPicker').setView([-6.2088, 106.8456], 12);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    let marker;

    // Click event untuk set marker
    map.on('click', function(e) {
        const lat = e.latlng.lat;
        const lng = e.latlng.lng;

        document.getElementById('latInput').value = lat.toFixed(8);
        document.getElementById('lngInput').value = lng.toFixed(8);

        if (marker) {
            marker.setLatLng(e.latlng);
        } else {
            marker = L.marker(e.latlng).addTo(map);
        }
    });

    // Preview foto utama
    const fotoInput = document.getElementById('fotoUtamaInput');
    const fotoPreview = document.getElementById('fotoPreview');
    const fotoPreviewImg = document.getElementById('fotoPreviewImg');

    if (fotoInput) {
        fotoInput.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const file = this.files[0];
                const maxSize = 2 * 1024 * 1024;

                if (file.size > maxSize) {
                    alert('File melebihi batas ukuran 2MB');
                    this.value = '';
                    fotoPreview.classList.add('d-none');
                    return;
                }

                const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!allowedTypes.includes(file.type)) {
                    alert('Tipe file tidak didukung. Hanya gambar (JPG, PNG, GIF) yang diperbolehkan.');
                    this.value = '';
                    fotoPreview.classList.add('d-none');
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    fotoPreviewImg.src = e.target.result;
                    fotoPreview.classList.remove('d-none');
                }
                reader.readAsDataURL(file);
            } else {
                fotoPreview.classList.add('d-none');
            }
        });
    }

    // Preview media tambahan
    const mediaInput = document.getElementById('mediaInput');
    const mediaPreviewContainer = document.getElementById('mediaPreviewContainer');

    if (mediaInput) {
        mediaInput.addEventListener('change', function(e) {
            mediaPreviewContainer.innerHTML = '';

            if (this.files && this.files.length > 0) {
                const maxFiles = 10;
                if (this.files.length > maxFiles) {
                    alert(`Maksimal ${maxFiles} file yang dapat diupload sekaligus`);
                    this.value = '';
                    return;
                }

                Array.from(this.files).forEach((file, index) => {
                    const maxSize = 5 * 1024 * 1024;
                    if (file.size > maxSize) {
                        alert(`File "${file.name}" melebihi batas ukuran 5MB`);
                        this.value = '';
                        return;
                    }

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

                            col.querySelector('.remove-media').addEventListener('click', function() {
                                removeFileFromInput(this.dataset.index);
                            });
                        }
                        reader.readAsDataURL(file);
                    } else {
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
                                        ${getFileExtension(file.name).toUpperCase()}
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

        files.splice(index, 1);
        files.forEach(file => {
            dt.items.add(file);
        });

        input.files = dt.files;
        const event = new Event('change');
        input.dispatchEvent(event);
    }

    // Helper function untuk mendapatkan ekstensi file
    function getFileExtension(filename) {
        return filename.split('.').pop();
    }

    // Form submission
    const form = document.getElementById('form-lokasi');
    const submitBtn = document.getElementById('submitBtn');

    form.addEventListener('submit', function(e) {
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

        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Menyimpan...';
    });
});
</script>
@endsection
