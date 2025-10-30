

<?php $__env->startSection('title', 'Daftar Tahapan Proyek'); ?>

<?php $__env->startSection('content'); ?>

<div class="container">
    <!-- Summary Cards -->
    <div class="row mb-5">
        <div class="col-md-3">
            <div class="card stat-card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body text-center p-4">
                    <div class="stat-icon bg-primary bg-opacity-10 rounded-3 p-3 d-inline-block mb-3">
                        <span class="text-primary display-6">📋</span>
                    </div>
                    <h3 class="fw-bold text-primary mb-1">8</h3>
                    <p class="text-muted mb-0">Total Tahapan</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body text-center p-4">
                    <div class="stat-icon bg-success bg-opacity-10 rounded-3 p-3 d-inline-block mb-3">
                        <span class="text-success display-6">✅</span>
                    </div>
                    <h3 class="fw-bold text-success mb-1">3</h3>
                    <p class="text-muted mb-0">Selesai</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body text-center p-4">
                    <div class="stat-icon bg-warning bg-opacity-10 rounded-3 p-3 d-inline-block mb-3">
                        <span class="text-warning display-6">⏳</span>
                    </div>
                    <h3 class="fw-bold text-warning mb-1">4</h3>
                    <p class="text-muted mb-0">Berjalan</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body text-center p-4">
                    <div class="stat-icon bg-info bg-opacity-10 rounded-3 p-3 d-inline-block mb-3">
                        <span class="text-info display-6">📅</span>
                    </div>
                    <h3 class="fw-bold text-info mb-1">1</h3>
                    <p class="text-muted mb-0">Akan Datang</p>
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
                            <h5 class="fw-bold text-primary mb-0">Filter Tahapan Proyek</h5>
                            <p class="text-muted small mb-0">Lihat tahapan berdasarkan proyek dan status</p>
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
                                    <option value="ongoing">Berjalan</option>
                                    <option value="upcoming">Akan Datang</option>
                                </select>
                                <button class="btn btn-primary btn-sm rounded-pill px-4">
                                    <i class="fas fa-download me-2"></i>Export
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Timeline View Toggle -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-center">
                <div class="btn-group" role="group">
                    <input type="radio" class="btn-check" name="viewMode" id="tableView" autocomplete="off" checked>
                    <label class="btn btn-outline-primary rounded-start-pill" for="tableView">
                        <i class="fas fa-table me-2"></i>Tabel
                    </label>
                    <input type="radio" class="btn-check" name="viewMode" id="timelineView" autocomplete="off">
                    <label class="btn btn-outline-primary rounded-end-pill" for="timelineView">
                        <i class="fas fa-stream me-2"></i>Timeline
                    </label>
                </div>
            </div>
        </div>
    </div>

    <!-- Table View -->
    <div class="row" id="tableViewContent">
        <div class="col-12">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-gradient-primary text-white py-3">
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="fw-bold mb-0">Daftar Tahapan Proyek</h5>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-white text-primary">Total: 8 Tahapan</span>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center">#</th>
                                <th>Tahapan</th>
                                <th class="text-center">Progress</th>
                                <th class="text-center">Timeline</th>
                                <th class="text-center">Durasi</th>
                                <th class="text-center">Proyek</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Tahap 1 -->
                            <tr class="stage-row" data-status="completed" data-project="Proyek A">
                                <td class="text-center fw-bold text-primary">1</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="stage-icon bg-success bg-opacity-10 rounded-2 p-2 me-3">
                                            <span class="text-success">🏗️</span>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-0">Pondasi</h6>
                                            <small class="text-muted">Tahap konstruksi dasar</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="progress-wrapper">
                                        <div class="d-flex justify-content-between small mb-1">
                                            <span class="fw-semibold">100%</span>
                                            <span class="text-muted">25% target</span>
                                        </div>
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar bg-success" style="width: 100%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="timeline-info">
                                        <div class="fw-semibold">10 Jan - 5 Feb</div>
                                        <small class="text-muted">2025</small>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark">27 hari</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-primary bg-opacity-10 text-primary">Proyek A</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success rounded-pill">
                                        <i class="fas fa-check me-1"></i>Selesai
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary rounded-pill px-3">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-outline-secondary rounded-pill px-3">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Tahap 2 -->
                            <tr class="stage-row" data-status="ongoing" data-project="Proyek A">
                                <td class="text-center fw-bold text-primary">2</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="stage-icon bg-warning bg-opacity-10 rounded-2 p-2 me-3">
                                            <span class="text-warning">🏛️</span>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-0">Struktur</h6>
                                            <small class="text-muted">Pembangunan struktur utama</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="progress-wrapper">
                                        <div class="d-flex justify-content-between small mb-1">
                                            <span class="fw-semibold">75%</span>
                                            <span class="text-muted">50% target</span>
                                        </div>
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar bg-warning" style="width: 75%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="timeline-info">
                                        <div class="fw-semibold">10 Feb - 1 Apr</div>
                                        <small class="text-muted">2025</small>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark">51 hari</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-primary bg-opacity-10 text-primary">Proyek A</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-warning rounded-pill">
                                        <i class="fas fa-spinner me-1"></i>Berjalan
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary rounded-pill px-3">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-outline-secondary rounded-pill px-3">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Tahap 3 -->
                            <tr class="stage-row" data-status="upcoming" data-project="Proyek A">
                                <td class="text-center fw-bold text-primary">3</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="stage-icon bg-info bg-opacity-10 rounded-2 p-2 me-3">
                                            <span class="text-info">🎨</span>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-0">Finishing</h6>
                                            <small class="text-muted">Penyelesaian akhir</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="progress-wrapper">
                                        <div class="d-flex justify-content-between small mb-1">
                                            <span class="fw-semibold">0%</span>
                                            <span class="text-muted">25% target</span>
                                        </div>
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar bg-info" style="width: 0%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="timeline-info">
                                        <div class="fw-semibold">5 Apr - 10 Mei</div>
                                        <small class="text-muted">2025</small>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark">35 hari</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-primary bg-opacity-10 text-primary">Proyek A</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-info rounded-pill">
                                        <i class="fas fa-clock me-1"></i>Akan Datang
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary rounded-pill px-3">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-outline-secondary rounded-pill px-3">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-light py-3">
                    <div class="row align-items-center">
                        <div class="col">
                            <small class="text-muted">Menampilkan 3 dari 8 tahapan</small>
                        </div>
                        <div class="col-auto">
                            <nav>
                                <ul class="pagination pagination-sm mb-0">
                                    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Timeline View (Hidden by default) -->
    <div class="row d-none" id="timelineViewContent">
        <div class="col-12">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-gradient-primary text-white py-3">
                    <h5 class="fw-bold mb-0">Timeline Tahapan Proyek</h5>
                </div>
                <div class="card-body p-4">
                    <!-- Timeline akan diisi dengan JavaScript -->
                    <div id="timelineContainer">
                        <div class="text-center py-5">
                            <div class="spinner-border text-primary mb-3" role="status">
                                <span class="visually-hidden">Loading timeline...</span>
                            </div>
                            <p class="text-muted">Memuat timeline...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
}

.stage-row {
    transition: all 0.2s ease;
}

.stage-row:hover {
    background-color: #f8f9fa !important;
    transform: scale(1.01);
}

.stage-icon {
    transition: all 0.3s ease;
}

.stage-row:hover .stage-icon {
    transform: scale(1.1);
}

.progress {
    border-radius: 10px;
}

.progress-bar {
    border-radius: 10px;
    transition: width 0.6s ease;
}

.btn-group .btn {
    transition: all 0.2s ease;
}

.btn-group .btn:hover {
    transform: translateY(-1px);
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.stage-row {
    animation: fadeInUp 0.5s ease-out;
}

.stage-row:nth-child(1) { animation-delay: 0.1s; }
.stage-row:nth-child(2) { animation-delay: 0.2s; }
.stage-row:nth-child(3) { animation-delay: 0.3s; }

/* Custom badges */
.badge {
    font-weight: 500;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .table-responsive {
        font-size: 0.875rem;
    }
    
    .btn-group .btn {
        padding: 0.25rem 0.5rem;
    }
    
    .stage-icon {
        display: none;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // View Mode Toggle
    const tableView = document.getElementById('tableView');
    const timelineView = document.getElementById('timelineView');
    const tableViewContent = document.getElementById('tableViewContent');
    const timelineViewContent = document.getElementById('timelineViewContent');

    tableView.addEventListener('change', function() {
        if (this.checked) {
            tableViewContent.classList.remove('d-none');
            timelineViewContent.classList.add('d-none');
        }
    });

    timelineView.addEventListener('change', function() {
        if (this.checked) {
            tableViewContent.classList.add('d-none');
            timelineViewContent.classList.remove('d-none');
            loadTimelineView();
        }
    });

    // Filter functionality
    const projectFilter = document.getElementById('projectFilter');
    const statusFilter = document.getElementById('statusFilter');
    const stageRows = document.querySelectorAll('.stage-row');

    function filterStages() {
        const projectValue = projectFilter.value;
        const statusValue = statusFilter.value;

        stageRows.forEach(row => {
            const projectMatch = !projectValue || row.getAttribute('data-project') === projectValue;
            const statusMatch = !statusValue || row.getAttribute('data-status') === statusValue;

            if (projectMatch && statusMatch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    projectFilter.addEventListener('change', filterStages);
    statusFilter.addEventListener('change', filterStages);

    // Timeline View Loader
    function loadTimelineView() {
        const timelineContainer = document.getElementById('timelineContainer');
        
        // Simulate loading
        setTimeout(() => {
            timelineContainer.innerHTML = `
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-marker bg-success"></div>
                        <div class="timeline-content">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h6 class="fw-bold text-success mb-0">Pondasi</h6>
                                        <span class="badge bg-success">Selesai</span>
                                    </div>
                                    <p class="text-muted small mb-2">Proyek A - 25% target</p>
                                    <div class="progress mb-2" style="height: 6px;">
                                        <div class="progress-bar bg-success" style="width: 100%"></div>
                                    </div>
                                    <div class="d-flex justify-content-between text-muted small">
                                        <span>10 Jan 2025</span>
                                        <span>5 Feb 2025</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-marker bg-warning"></div>
                        <div class="timeline-content">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h6 class="fw-bold text-warning mb-0">Struktur</h6>
                                        <span class="badge bg-warning">Berjalan</span>
                                    </div>
                                    <p class="text-muted small mb-2">Proyek A - 50% target</p>
                                    <div class="progress mb-2" style="height: 6px;">
                                        <div class="progress-bar bg-warning" style="width: 75%"></div>
                                    </div>
                                    <div class="d-flex justify-content-between text-muted small">
                                        <span>10 Feb 2025</span>
                                        <span>1 Apr 2025</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-marker bg-info"></div>
                        <div class="timeline-content">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h6 class="fw-bold text-info mb-0">Finishing</h6>
                                        <span class="badge bg-info">Akan Datang</span>
                                    </div>
                                    <p class="text-muted small mb-2">Proyek A - 25% target</p>
                                    <div class="progress mb-2" style="height: 6px;">
                                        <div class="progress-bar bg-info" style="width: 0%"></div>
                                    </div>
                                    <div class="d-flex justify-content-between text-muted small">
                                        <span>5 Apr 2025</span>
                                        <span>10 Mei 2025</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            // Add timeline styles
            const style = document.createElement('style');
            style.textContent = `
                .timeline {
                    position: relative;
                    padding-left: 2rem;
                }
                .timeline-item {
                    position: relative;
                    margin-bottom: 2rem;
                }
                .timeline-marker {
                    position: absolute;
                    left: -2rem;
                    top: 0.5rem;
                    width: 1rem;
                    height: 1rem;
                    border-radius: 50%;
                    border: 3px solid white;
                    box-shadow: 0 0 0 3px var(--bs-primary);
                }
                .timeline-content {
                    margin-left: 1rem;
                }
            `;
            document.head.appendChild(style);
        }, 500);
    }

    // Add click effects to rows
    stageRows.forEach(row => {
        row.addEventListener('click', function(e) {
            if (!e.target.closest('.btn-group')) {
                this.style.backgroundColor = '#e3f2fd';
                setTimeout(() => {
                    this.style.backgroundColor = '';
                }, 300);
            }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Nisa-2SIC\laragon-6.0-minimal\www\PembangunanGuest\resources\views/pages/tahapan.blade.php ENDPATH**/ ?>