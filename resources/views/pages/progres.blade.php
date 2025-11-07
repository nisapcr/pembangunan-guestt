@extends('layouts.app')

@section('title', 'Progress Proyek')

@section('content')
<div class="container">
    <!-- Summary Cards -->
    <div class="row mb-5">
        <div class="col-md-3">
            <div class="card stat-card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body text-center p-4">
                    <div class="stat-icon bg-primary bg-opacity-10 rounded-3 p-3 d-inline-block mb-3">
                        <span class="text-primary display-6">📈</span>
                    </div>
                    <h3 class="fw-bold text-primary mb-1">85%</h3>
                    <p class="text-muted mb-0">Rata-rata Progress</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body text-center p-4">
                    <div class="stat-icon bg-success bg-opacity-10 rounded-3 p-3 d-inline-block mb-3">
                        <span class="text-success display-6">✅</span>
                    </div>
                    <h3 class="fw-bold text-success mb-1">12</h3>
                    <p class="text-muted mb-0">Proyek Selesai</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body text-center p-4">
                    <div class="stat-icon bg-warning bg-opacity-10 rounded-3 p-3 d-inline-block mb-3">
                        <span class="text-warning display-6">⏳</span>
                    </div>
                    <h3 class="fw-bold text-warning mb-1">8</h3>
                    <p class="text-muted mb-0">Dalam Pengerjaan</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body text-center p-4">
                    <div class="stat-icon bg-danger bg-opacity-10 rounded-3 p-3 d-inline-block mb-3">
                        <span class="text-danger display-6">⚠️</span>
                    </div>
                    <h3 class="fw-bold text-danger mb-1">3</h3>
                    <p class="text-muted mb-0">Perlu Perhatian</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Controls -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h5 class="fw-bold text-primary mb-0">Filter Progress Proyek</h5>
                            <p class="text-muted small mb-0">Pantau progress berdasarkan status dan timeline</p>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex gap-3 flex-wrap justify-content-md-end">
                                <select class="form-select form-select-sm" style="max-width: 200px;" id="projectFilter">
                                    <option value="">Semua Proyek</option>
                                    <option value="Proyek A">Proyek A</option>
                                    <option value="Proyek B">Proyek B</option>
                                    <option value="Proyek C">Proyek C</option>
                                </select>
                                <select class="form-select form-select-sm" style="max-width: 200px;" id="statusFilter">
                                    <option value="">Semua Status</option>
                                    <option value="completed">Selesai</option>
                                    <option value="ongoing">Dalam Proses</option>
                                    <option value="delayed">Terlambat</option>
                                </select>
                                <button class="btn btn-primary btn-sm rounded-pill px-4">
                                    <i class="fas fa-sync-alt me-2"></i>Refresh
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Progress Timeline -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-gradient-primary text-white py-3">
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="fw-bold mb-0">
                                <i class="fas fa-tasks me-2"></i>Timeline Progress Proyek
                            </h5>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-white text-primary">Update Terakhir: Hari ini</span>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <!-- Progress Item 1 - Completed -->
                    <div class="progress-timeline-item completed">
                        <div class="timeline-marker bg-success">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="timeline-content">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-md-8">
                                            <div class="d-flex align-items-start mb-3">
                                                <div class="progress-icon bg-success bg-opacity-10 rounded-3 p-3 me-3">
                                                    <span class="text-success fs-4">🏗️</span>
                                                </div>
                                                <div>
                                                    <h4 class="fw-bold text-success mb-1">Pondasi - Proyek A</h4>
                                                    <p class="text-muted mb-2">
                                                        <i class="fas fa-calendar-alt me-2"></i>25 Okt 2025 – 28 Okt 2025
                                                    </p>
                                                    <p class="mb-3">Progress pondasi telah selesai 100% sesuai dengan target yang ditentukan. Pekerjaan dilakukan dengan standar kualitas tertinggi.</p>
                                                    <div class="d-flex align-items-center flex-wrap gap-2">
                                                        <span class="badge bg-success rounded-pill">
                                                            <i class="fas fa-check me-1"></i>Selesai
                                                        </span>
                                                        <span class="badge bg-info rounded-pill">
                                                            <i class="fas fa-user me-1"></i>Oleh: Sebasti
                                                        </span>
                                                        <span class="badge bg-secondary rounded-pill">
                                                            <i class="fas fa-clock me-1"></i>3 Hari
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="text-center">
                                                <div class="progress-circle success mx-auto mb-3">
                                                    <div class="progress-circle-value">100%</div>
                                                </div>
                                                <p class="text-muted mb-3">Progress Realisasi</p>
                                                <div class="d-grid gap-2">
                                                    <button class="btn btn-outline-primary btn-sm rounded-pill">
                                                        <i class="fas fa-eye me-1"></i>Detail Progress
                                                    </button>
                                                    <button class="btn btn-outline-success btn-sm rounded-pill">
                                                        <i class="fas fa-images me-1"></i>Galeri Foto
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Progress Details -->
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <div class="progress-details">
                                                <div class="row text-center">
                                                    <div class="col-md-3">
                                                        <div class="detail-item">
                                                            <div class="detail-value text-success fw-bold">100%</div>
                                                            <div class="detail-label text-muted small">Actual</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="detail-item">
                                                            <div class="detail-value text-primary fw-bold">100%</div>
                                                            <div class="detail-label text-muted small">Target</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="detail-item">
                                                            <div class="detail-value text-success fw-bold">0 Hari</div>
                                                            <div class="detail-label text-muted small">Deviasi</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="detail-item">
                                                            <div class="detail-value text-success fw-bold">A+</div>
                                                            <div class="detail-label text-muted small">Kualitas</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Progress Item 2 - Ongoing -->
                    <div class="progress-timeline-item ongoing">
                        <div class="timeline-marker bg-warning">
                            <i class="fas fa-spinner fa-spin"></i>
                        </div>
                        <div class="timeline-content">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-md-8">
                                            <div class="d-flex align-items-start mb-3">
                                                <div class="progress-icon bg-warning bg-opacity-10 rounded-3 p-3 me-3">
                                                    <span class="text-warning fs-4">🏛️</span>
                                                </div>
                                                <div>
                                                    <h4 class="fw-bold text-warning mb-1">Struktur - Proyek B</h4>
                                                    <p class="text-muted mb-2">
                                                        <i class="fas fa-calendar-alt me-2"></i>20 Okt 2025 – 30 Okt 2025
                                                    </p>
                                                    <p class="mb-3">Pekerjaan struktur sedang berjalan dengan baik, saat ini mencapai 75%. Material sudah tersedia 90% dan tenaga kerja optimal.</p>
                                                    <div class="d-flex align-items-center flex-wrap gap-2">
                                                        <span class="badge bg-warning rounded-pill">
                                                            <i class="fas fa-spinner me-1"></i>Dalam Proses
                                                        </span>
                                                        <span class="badge bg-info rounded-pill">
                                                            <i class="fas fa-users me-1"></i>Tim: 15 Orang
                                                        </span>
                                                        <span class="badge bg-secondary rounded-pill">
                                                            <i class="fas fa-clock me-1"></i>10 Hari
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="text-center">
                                                <div class="progress-circle warning mx-auto mb-3">
                                                    <div class="progress-circle-value">75%</div>
                                                </div>
                                                <p class="text-muted mb-3">Progress Realisasi</p>
                                                <div class="d-grid gap-2">
                                                    <button class="btn btn-outline-primary btn-sm rounded-pill">
                                                        <i class="fas fa-eye me-1"></i>Detail Progress
                                                    </button>
                                                    <button class="btn btn-outline-success btn-sm rounded-pill">
                                                        <i class="fas fa-images me-1"></i>Galeri Foto
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Progress Details -->
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <div class="progress-details">
                                                <div class="row text-center">
                                                    <div class="col-md-3">
                                                        <div class="detail-item">
                                                            <div class="detail-value text-warning fw-bold">75%</div>
                                                            <div class="detail-label text-muted small">Actual</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="detail-item">
                                                            <div class="detail-value text-primary fw-bold">80%</div>
                                                            <div class="detail-label text-muted small">Target</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="detail-item">
                                                            <div class="detail-value text-warning fw-bold">-2 Hari</div>
                                                            <div class="detail-label text-muted small">Deviasi</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="detail-item">
                                                            <div class="detail-value text-warning fw-bold">B+</div>
                                                            <div class="detail-label text-muted small">Kualitas</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Progress Item 3 - Delayed -->
                    <div class="progress-timeline-item delayed">
                        <div class="timeline-marker bg-danger">
                            <i class="fas fa-exclamation"></i>
                        </div>
                        <div class="timeline-content">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-md-8">
                                            <div class="d-flex align-items-start mb-3">
                                                <div class="progress-icon bg-danger bg-opacity-10 rounded-3 p-3 me-3">
                                                    <span class="text-danger fs-4">🎨</span>
                                                </div>
                                                <div>
                                                    <h4 class="fw-bold text-danger mb-1">Finishing - Proyek C</h4>
                                                    <p class="text-muted mb-2">
                                                        <i class="fas fa-calendar-alt me-2"></i>15 Okt 2025 – 25 Okt 2025
                                                    </p>
                                                    <p class="mb-3">Progress finishing mengalami keterlambatan akibat cuaca dan keterlambatan material. Perlu percepatan untuk mengejar target.</p>
                                                    <div class="d-flex align-items-center flex-wrap gap-2">
                                                        <span class="badge bg-danger rounded-pill">
                                                            <i class="fas fa-exclamation-triangle me-1"></i>Terlambat
                                                        </span>
                                                        <span class="badge bg-info rounded-pill">
                                                            <i class="fas fa-user me-1"></i>Oleh: Andi
                                                        </span>
                                                        <span class="badge bg-secondary rounded-pill">
                                                            <i class="fas fa-clock me-1"></i>5 Hari Tertinggal
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="text-center">
                                                <div class="progress-circle danger mx-auto mb-3">
                                                    <div class="progress-circle-value">25%</div>
                                                </div>
                                                <p class="text-muted mb-3">Progress Realisasi</p>
                                                <div class="d-grid gap-2">
                                                    <button class="btn btn-outline-primary btn-sm rounded-pill">
                                                        <i class="fas fa-eye me-1"></i>Detail Progress
                                                    </button>
                                                    <button class="btn btn-outline-warning btn-sm rounded-pill">
                                                        <i class="fas fa-bullhorn me-1"></i>Lapor Masalah
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Progress Details -->
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <div class="progress-details">
                                                <div class="row text-center">
                                                    <div class="col-md-3">
                                                        <div class="detail-item">
                                                            <div class="detail-value text-danger fw-bold">25%</div>
                                                            <div class="detail-label text-muted small">Actual</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="detail-item">
                                                            <div class="detail-value text-primary fw-bold">60%</div>
                                                            <div class="detail-label text-muted small">Target</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="detail-item">
                                                            <div class="detail-value text-danger fw-bold">+5 Hari</div>
                                                            <div class="detail-label text-muted small">Deviasi</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="detail-item">
                                                            <div class="detail-value text-danger fw-bold">C</div>
                                                            <div class="detail-label text-muted small">Kualitas</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Overview Table -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-gradient-primary text-white py-3">
                    <h5 class="fw-bold mb-0">
                        <i class="fas fa-table me-2"></i>Ringkasan Proyek
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4">Proyek</th>
                                    <th class="text-center">Tahapan</th>
                                    <th class="text-center">Progress</th>
                                    <th class="text-center">Timeline</th>
                                    <th class="text-center">Lokasi</th>
                                    <th class="text-center">Kontraktor</th>
                                    <th class="text-center">Kontak</th>
                                    <th class="text-center pe-4">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="project-avatar bg-success bg-opacity-10 rounded-2 p-2 me-3">
                                                <span class="text-success">A</span>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold mb-0">Proyek A</h6>
                                                <small class="text-muted">Pembangunan Gedung</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-primary bg-opacity-10 text-primary">Pondasi</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="progress-wrapper" style="max-width: 100px; margin: 0 auto;">
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-success" style="width: 100%"></div>
                                            </div>
                                            <small class="text-success fw-bold">100%</small>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <small class="text-muted">25-28 Okt 2025</small>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-light text-dark">Jakarta Pusat</span>
                                    </td>
                                    <td class="text-center">
                                        <small>PT Bangun Jaya</small>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-primary rounded-pill">
                                            <i class="fas fa-phone"></i>
                                        </button>
                                    </td>
                                    <td class="text-center pe-4">
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-outline-primary rounded-pill px-3">
                                                <i class="fas fa-chart-line"></i>
                                            </button>
                                            <button class="btn btn-outline-secondary rounded-pill px-3">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Additional rows would go here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Progress Button -->
    <div class="text-center mt-5">
        <button class="btn btn-primary btn-lg rounded-pill px-5 py-3">
            <i class="fas fa-plus me-2"></i>Tambah Progress Baru
        </button>
    </div>
</div>

{{-- css --}}
<style>
.hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
}

.stat-card {
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
}

/* Progress Timeline */
.progress-timeline-item {
    position: relative;
    padding-left: 3rem;
    margin-bottom: 2rem;
}

.timeline-marker {
    position: absolute;
    left: 0;
    top: 2rem;
    width: 2.5rem;
    height: 2.5rem;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.875rem;
    border: 3px solid white;
    box-shadow: 0 0 0 3px var(--bs-primary);
    z-index: 2;
}

.timeline-content {
    margin-left: 1rem;
}

/* Progress Circles */
.progress-circle {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 1rem;
    position: relative;
}

.progress-circle.success {
    background: conic-gradient(#28a745 100%, #e9ecef 0%);
}

.progress-circle.warning {
    background: conic-gradient(#ffc107 75%, #e9ecef 0%);
}

.progress-circle.danger {
    background: conic-gradient(#dc3545 25%, #e9ecef 0%);
}

.progress-circle-value {
    width: 60px;
    height: 60px;
    background: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}

/* Progress Details */
.progress-details {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 1rem;
    border-left: 4px solid #007bff;
}

.detail-item {
    padding: 0.5rem;
}

.detail-value {
    font-size: 1.25rem;
    margin-bottom: 0.25rem;
}

.detail-label {
    font-size: 0.75rem;
}

/* Project Avatar */
.project-avatar {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.progress-timeline-item {
    animation: fadeInUp 0.6s ease-out;
}

.progress-timeline-item:nth-child(1) { animation-delay: 0.1s; }
.progress-timeline-item:nth-child(2) { animation-delay: 0.2s; }
.progress-timeline-item:nth-child(3) { animation-delay: 0.3s; }

/* Hover Effects */
.progress-timeline-item .card {
    transition: all 0.3s ease;
}

.progress-timeline-item:hover .card {
    transform: translateX(5px);
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15) !important;
}

/* Responsive */
@media (max-width: 768px) {
    .progress-timeline-item {
        padding-left: 2rem;
    }

    .timeline-marker {
        width: 2rem;
        height: 2rem;
        top: 1.5rem;
    }

    .progress-icon {
        display: none;
    }
}
</style>
{{-- end css --}}


<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filter functionality
    const projectFilter = document.getElementById('projectFilter');
    const statusFilter = document.getElementById('statusFilter');
    const progressItems = document.querySelectorAll('.progress-timeline-item');

    function filterProgress() {
        const projectValue = projectFilter.value;
        const statusValue = statusFilter.value;

        progressItems.forEach(item => {
            const projectMatch = !projectValue || item.querySelector('h4').textContent.includes(projectValue);
            const statusMatch = !statusValue || item.classList.contains(statusValue);

            if (projectMatch && statusMatch) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }

    projectFilter.addEventListener('change', filterProgress);
    statusFilter.addEventListener('change', filterProgress);

    // Add click effects to cards
    const cards = document.querySelectorAll('.progress-timeline-item .card');
    cards.forEach(card => {
        card.addEventListener('click', function(e) {
            if (!e.target.closest('.btn')) {
                this.style.transform = 'scale(0.99)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            }
        });
    });

    // Animate progress circles on scroll
    const progressCircles = document.querySelectorAll('.progress-circle');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animation = 'grow 1s ease-out';
            }
        });
    }, { threshold: 0.5 });

    progressCircles.forEach(circle => {
        observer.observe(circle);
    });
});

// Add growing animation for progress circles
const style = document.createElement('style');
style.textContent = `
    @keyframes grow {
        from {
            transform: scale(0.8);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }
`;
document.head.appendChild(style);
</script>
@endsection
