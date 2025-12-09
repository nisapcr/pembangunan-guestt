{{-- resources/views/pages/proyek/show.blade.php --}}
@extends('layouts.guest.app')
@section('title', 'Detail Proyek: ' . $proyek->nama_proyek)

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            {{-- Breadcrumb --}}
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('proyek.index') }}">Daftar Proyek</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $proyek->nama_proyek }}</li>
                </ol>
            </nav>

            {{-- Alert untuk menampilkan pesan --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Main Card --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-project-diagram me-2"></i>Detail Proyek
                        </h5>
                        <div class="btn-group">
                            <a href="{{ route('proyek.edit', $proyek->proyek_id) }}" class="btn btn-light btn-sm">
                                <i class="fas fa-edit me-1"></i>Edit
                            </a>
                            <a href="{{ route('proyek.index') }}" class="btn btn-outline-light btn-sm">
                                <i class="fas fa-arrow-left me-1"></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        {{-- Informasi Utama --}}
                        <div class="col-md-8">
                            <h4 class="text-primary mb-3">{{ $proyek->nama_proyek }}</h4>
                            <p class="text-muted mb-4">{{ $proyek->deskripsi ?: 'Tidak ada deskripsi' }}</p>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="info-item mb-3">
                                        <span class="fw-bold text-muted d-block mb-1">
                                            <i class="fas fa-hashtag me-2"></i>Kode Proyek
                                        </span>
                                        <span class="badge bg-secondary fs-6">{{ $proyek->kode_proyek }}</span>
                                    </div>

                                    <div class="info-item mb-3">
                                        <span class="fw-bold text-muted d-block mb-1">
                                            <i class="fas fa-calendar me-2"></i>Tahun
                                        </span>
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-info">{{ $proyek->tahun }}</span>
                                            @if($proyek->tahun >= date('Y'))
                                                <span class="badge bg-success ms-2">Berjalan</span>
                                            @elseif($proyek->tahun >= date('Y') - 1)
                                                <span class="badge bg-warning ms-2">Baru Selesai</span>
                                            @else
                                                <span class="badge bg-secondary ms-2">Selesai</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="info-item mb-3">
                                        <span class="fw-bold text-muted d-block mb-1">
                                            <i class="fas fa-map-marker-alt me-2"></i>Lokasi
                                        </span>
                                        {{ $proyek->lokasi }}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="info-item mb-3">
                                        <span class="fw-bold text-muted d-block mb-1">
                                            <i class="fas fa-money-bill-wave me-2"></i>Anggaran
                                        </span>
                                        <h5 class="text-success mb-0">Rp {{ number_format($proyek->anggaran, 0, ',', '.') }}</h5>
                                    </div>

                                    <div class="info-item mb-3">
                                        <span class="fw-bold text-muted d-block mb-1">
                                            <i class="fas fa-university me-2"></i>Sumber Dana
                                        </span>
                                        <span class="badge bg-primary">{{ $proyek->sumber_dana }}</span>
                                    </div>

                                    <div class="info-item mb-3">
                                        <span class="fw-bold text-muted d-block mb-1">
                                            <i class="fas fa-clock me-2"></i>Diupdate
                                        </span>
                                        {{ $proyek->updated_at->format('d/m/Y H:i') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Sidebar Statistik --}}
                        <div class="col-md-4">
                            <div class="card bg-light border-0">
                                <div class="card-body text-center">
                                    <div class="mb-3">
                                        <i class="fas fa-folder-open fa-4x text-primary"></i>
                                    </div>
                                    <h5 class="mb-2">Dokumen & Foto</h5>
                                    <div class="d-flex justify-content-around mb-3">
                                        <div>
                                            <h3 class="mb-0">{{ $files->where('mime_type', 'like', 'image/%')->count() }}</h3>
                                            <small class="text-muted">Foto</small>
                                        </div>
                                        <div>
                                            <h3 class="mb-0">{{ $files->where('mime_type', 'not like', 'image/%')->count() }}</h3>
                                            <small class="text-muted">Dokumen</small>
                                        </div>
                                    </div>
                                    <p class="small text-muted">Total: {{ $files->count() }} file</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Upload File Section --}}
            @auth
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-cloud-upload-alt me-2"></i>Upload Dokumen & Foto
                    </h5>
                </div>
                <div class="card-body">
                    <form id="uploadForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="ref_table" value="proyek">
                        <input type="hidden" name="ref_id" value="{{ $proyek->proyek_id }}">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="files" class="form-label">Pilih File</label>
                                    <input type="file" class="form-control" id="files" name="files[]" multiple required>
                                    <small class="text-muted">Format: JPG, PNG, GIF, PDF, DOC, DOCX, XLS, XLSX (Max: 5MB per file)</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="caption" class="form-label">Keterangan (Opsional)</label>
                                    <input type="text" class="form-control" id="caption" name="caption" placeholder="Masukkan keterangan file...">
                                </div>
                            </div>
                        </div>

                        <div class="progress mb-3 d-none" id="progressContainer">
                            <div class="progress-bar progress-bar-striped progress-bar-animated"
                                 id="progressBar"
                                 role="progressbar"
                                 style="width: 0%">
                                0%
                            </div>
                        </div>

                        <div id="uploadStatus"></div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary" id="uploadBtn">
                                <i class="fas fa-upload me-2"></i>Upload Files
                            </button>
                            <button type="reset" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Reset
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @endauth

            {{-- File List Section --}}
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-folder me-2"></i>Dokumen & Foto Proyek
                        <span class="badge bg-light text-dark ms-2">{{ $files->count() }}</span>
                    </h5>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="toggleView" checked>
                        <label class="form-check-label text-white" for="toggleView">
                            <i class="fas fa-th me-1"></i>Grid View
                        </label>
                    </div>
                </div>
                <div class="card-body">
                    @if($files->count() > 0)
                        <div class="row" id="fileContainer">
                            @foreach($files as $file)
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-3" data-file-id="{{ $file->id }}">
                                    <div class="card file-card h-100 border">
                                        @if(strpos($file->mime_type, 'image/') === 0)
                                            <div class="position-relative">
                                                <img src="{{ Storage::url($file->file_path) }}"
                                                     class="card-img-top file-image"
                                                     alt="{{ $file->original_name }}"
                                                     style="height: 180px; object-fit: cover;"
                                                     onclick="previewImage('{{ Storage::url($file->file_path) }}', '{{ $file->original_name }}')">
                                                <span class="position-absolute top-0 end-0 m-2">
                                                    <span class="badge bg-success">Gambar</span>
                                                </span>
                                            </div>
                                        @else
                                            <div class="card-body text-center py-4">
                                                @if($file->mime_type == 'application/pdf')
                                                    <i class="fas fa-file-pdf fa-4x text-danger mb-3"></i>
                                                    <span class="badge bg-danger mb-2">PDF</span>
                                                @elseif(in_array($file->mime_type, ['application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']))
                                                    <i class="fas fa-file-word fa-4x text-primary mb-3"></i>
                                                    <span class="badge bg-primary mb-2">DOC</span>
                                                @elseif(in_array($file->mime_type, ['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']))
                                                    <i class="fas fa-file-excel fa-4x text-success mb-3"></i>
                                                    <span class="badge bg-success mb-2">Excel</span>
                                                @else
                                                    <i class="fas fa-file fa-4x text-secondary mb-3"></i>
                                                    <span class="badge bg-secondary mb-2">File</span>
                                                @endif

                                                <h6 class="file-name small mb-1 text-truncate" title="{{ $file->original_name }}">
                                                    {{ $file->original_name }}
                                                </h6>

                                                <p class="file-size text-muted small mb-2">
                                                    @if($file->file_size)
                                                        @if($file->file_size >= 1048576)
                                                            {{ round($file->file_size / 1048576, 2) }} MB
                                                        @elseif($file->file_size >= 1024)
                                                            {{ round($file->file_size / 1024, 2) }} KB
                                                        @else
                                                            {{ $file->file_size }} bytes
                                                        @endif
                                                    @endif
                                                </p>
                                            </div>
                                        @endif

                                        <div class="card-footer bg-transparent border-top">
                                            <div class="btn-group btn-group-sm w-100">
                                                @if(strpos($file->mime_type, 'image/') === 0)
                                                    <button type="button"
                                                            class="btn btn-outline-info"
                                                            onclick="previewImage('{{ Storage::url($file->file_path) }}', '{{ $file->original_name }}')">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                @else
                                                    <a href="{{ route('proyek.viewFile', [$proyek->proyek_id, $file->id]) }}"
                                                       target="_blank"
                                                       class="btn btn-outline-info">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                @endif

                                                <a href="{{ route('proyek.downloadFile', [$proyek->proyek_id, $file->id]) }}"
                                                   class="btn btn-outline-success">
                                                    <i class="fas fa-download"></i>
                                                </a>

                                                @auth
                                                <button type="button"
                                                        class="btn btn-outline-danger delete-file"
                                                        data-file-id="{{ $file->id }}"
                                                        data-proyek-id="{{ $proyek->proyek_id }}"
                                                        data-file-name="{{ $file->original_name }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                @endauth
                                            </div>

                                            @if($file->caption)
                                                <div class="mt-2">
                                                    <small class="text-muted d-block">{{ $file->caption }}</small>
                                                </div>
                                            @endif

                                            <div class="mt-2">
                                                <small class="text-muted">
                                                    <i class="fas fa-calendar-alt me-1"></i>
                                                    {{ $file->created_at->format('d/m/Y H:i') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-folder-open fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted">Belum ada dokumen/foto</h5>
                            <p class="text-muted">Upload dokumen atau foto untuk proyek ini.</p>
                            @auth
                            <button class="btn btn-primary" onclick="document.getElementById('files').click()">
                                <i class="fas fa-upload me-2"></i>Upload File Pertama
                            </button>
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk preview gambar -->
<div class="modal fade" id="imagePreviewModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="previewTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img id="previewImage" src="" class="img-fluid rounded" alt="Preview">
            </div>
            <div class="modal-footer">
                <a href="#" id="downloadImage" class="btn btn-primary">
                    <i class="fas fa-download me-2"></i>Download
                </a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.card {
    border-radius: 10px;
    transition: all 0.3s ease;
}

.card-header {
    border-radius: 10px 10px 0 0 !important;
    font-weight: 600;
}

.file-card {
    border: 1px solid #e0e0e0;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.file-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.info-item {
    padding: 12px;
    background: #f8f9fa;
    border-radius: 8px;
    border-left: 4px solid #007bff;
}

.badge {
    font-size: 0.85em;
    padding: 0.4em 0.8em;
}

.progress {
    height: 25px;
    border-radius: 12px;
}

.btn-group .btn {
    border-radius: 5px;
}

.bg-light {
    background-color: #f8f9fa !important;
}

.position-relative {
    position: relative;
}

.position-absolute {
    position: absolute;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const uploadForm = document.getElementById('uploadForm');
    const progressContainer = document.getElementById('progressContainer');
    const progressBar = document.getElementById('progressBar');
    const uploadStatus = document.getElementById('uploadStatus');
    const uploadBtn = document.getElementById('uploadBtn');
    const toggleView = document.getElementById('toggleView');
    const fileContainer = document.getElementById('fileContainer');

    // Toggle view mode
    if (toggleView && fileContainer) {
        toggleView.addEventListener('change', function() {
            if (this.checked) {
                fileContainer.className = 'row';
                this.nextElementSibling.innerHTML = '<i class="fas fa-th me-1"></i>Grid View';
            } else {
                fileContainer.className = 'row row-cols-1';
                this.nextElementSibling.innerHTML = '<i class="fas fa-list me-1"></i>List View';
            }
        });
    }

    // Handle form upload
    if (uploadForm) {
        uploadForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            // Tampilkan progress bar
            progressContainer.classList.remove('d-none');
            uploadBtn.disabled = true;
            uploadBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Uploading...';

            // AJAX upload
            fetch('{{ route("proyek.uploadFiles", $proyek->proyek_id) }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showAlert('success', 'Files uploaded successfully!');
                    uploadForm.reset();
                    // Reload halaman setelah 1.5 detik
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                } else {
                    showAlert('danger', data.message || 'Upload failed.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('danger', 'Upload failed. Please try again.');
            })
            .finally(() => {
                progressContainer.classList.add('d-none');
                uploadBtn.disabled = false;
                uploadBtn.innerHTML = '<i class="fas fa-upload me-2"></i>Upload Files';
                progressBar.style.width = '0%';
                progressBar.textContent = '0%';
            });
        });
    }

    // Handle delete file
    document.querySelectorAll('.delete-file').forEach(button => {
        button.addEventListener('click', function() {
            const fileId = this.dataset.fileId;
            const proyekId = this.dataset.proyekId;
            const fileName = this.dataset.fileName;

            if (confirm(`Apakah Anda yakin ingin menghapus file "${fileName}"?`)) {
                fetch(`/proyek/${proyekId}/files/${fileId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showAlert('success', 'File berhasil dihapus!');
                        // Remove file element from DOM
                        const fileElement = document.querySelector(`[data-file-id="${fileId}"]`);
                        if (fileElement) {
                            fileElement.remove();
                        }
                        // Update file count
                        updateFileCount();
                    } else {
                        showAlert('danger', 'Gagal menghapus file.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('danger', 'Terjadi kesalahan saat menghapus file.');
                });
            }
        });
    });

    // Function to preview image
    window.previewImage = function(imageUrl, fileName) {
        const modal = new bootstrap.Modal(document.getElementById('imagePreviewModal'));
        document.getElementById('previewImage').src = imageUrl;
        document.getElementById('previewTitle').textContent = fileName;
        document.getElementById('downloadImage').href = imageUrl;
        document.getElementById('downloadImage').download = fileName;
        modal.show();
    };

    // Update file count
    function updateFileCount() {
        const count = document.querySelectorAll('.file-card').length;
        const badge = document.querySelector('.card-header .badge');
        if (badge) {
            badge.textContent = count;
        }

        // Show empty state if no files
        if (count === 0 && fileContainer) {
            fileContainer.innerHTML = `
                <div class="col-12 text-center py-5">
                    <i class="fas fa-folder-open fa-4x text-muted mb-3"></i>
                    <h5 class="text-muted">Belum ada dokumen/foto</h5>
                    <p class="text-muted">Upload dokumen atau foto untuk proyek ini.</p>
                    ${uploadForm ? `<button class="btn btn-primary" onclick="document.getElementById('files').click()">
                        <i class="fas fa-upload me-2"></i>Upload File Pertama
                    </button>` : ''}
                </div>
            `;
        }
    }

    // Show alert
    function showAlert(type, message) {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
        alertDiv.innerHTML = `
            <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;

        uploadStatus.innerHTML = '';
        uploadStatus.appendChild(alertDiv);

        setTimeout(() => {
            if (alertDiv.parentNode) {
                alertDiv.remove();
            }
        }, 5000);
    }
});
</script>
@endpush
@endsection
