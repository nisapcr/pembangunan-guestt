

<?php $__env->startSection('title', 'Daftar Program Bantuan'); ?>

<?php $__env->startSection('content'); ?>


<!-- Program Section -->
<section class="py-5 bg-light min-vh-100">
    <div class="container">
        <!-- Filter Section -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h5 class="fw-bold text-primary mb-0">Filter Program</h5>
                                <p class="text-muted small mb-0">Temukan program yang sesuai dengan kebutuhan</p>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex gap-3 flex-wrap">
                                    <select class="form-select form-select-sm" style="max-width: 200px;">
                                        <option selected>Semua Tahun</option>
                                        <option>2024</option>
                                        <option>2025</option>
                                    </select>
                                    <select class="form-select form-select-sm" style="max-width: 200px;">
                                        <option selected>Semua Kategori</option>
                                        <option>Pendidikan</option>
                                        <option>Infrastruktur</option>
                                        <option>Kesehatan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Program Cards -->
        <div class="row g-4">
            <!-- Card 1 - Pendidikan -->
            <div class="col-md-6 col-lg-4">
                <div class="card program-card border-0 shadow-lg h-100 rounded-4 overflow-hidden">
                    <div class="card-header-gradient bg-education">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="program-badge bg-white text-primary rounded-pill px-3 py-1 small fw-bold">
                                EDU-001
                            </div>
                            <div class="program-year bg-white text-dark rounded-pill px-3 py-1 small fw-bold">
                                2024
                            </div>
                        </div>
                        <div class="program-icon mt-3">
                            <div class="icon-wrapper bg-white rounded-3 p-3 d-inline-block">
                                <span class="display-6">🎓</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4 position-relative">
                        <div class="program-budget-tag bg-success text-white px-3 py-2 rounded-pill position-absolute top-0 start-50 translate-middle">
                            Rp 1.2M
                        </div>
                        <h5 class="fw-bold text-dark mb-3 mt-2">Program Bantuan Pendidikan</h5>
                        <p class="text-secondary mb-4">
                            Menyediakan fasilitas belajar dan beasiswa bagi siswa berprestasi di daerah terpencil.
                        </p>
                        
                        <div class="program-stats mb-4">
                            <div class="row text-center">
                                <div class="col-4">
                                    <div class="stat-number text-primary fw-bold">500+</div>
                                    <div class="stat-label text-muted small">Penerima</div>
                                </div>
                                <div class="col-4">
                                    <div class="stat-number text-primary fw-bold">25</div>
                                    <div class="stat-label text-muted small">Sekolah</div>
                                </div>
                                <div class="col-4">
                                    <div class="stat-number text-primary fw-bold">95%</div>
                                    <div class="stat-label text-muted small">Progress</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <a href="#" class="btn btn-primary rounded-pill py-2 fw-semibold">
                                <i class="fas fa-file-pdf me-2"></i>Lihat Dokumen
                            </a>
                            <a href="#" class="btn btn-outline-primary rounded-pill py-2">
                                <i class="fas fa-chart-line me-2"></i>Monitor Progress
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 2 - Infrastruktur -->
            <div class="col-md-6 col-lg-4">
                <div class="card program-card border-0 shadow-lg h-100 rounded-4 overflow-hidden">
                    <div class="card-header-gradient bg-infrastructure">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="program-badge bg-white text-primary rounded-pill px-3 py-1 small fw-bold">
                                INFRA-002
                            </div>
                            <div class="program-year bg-white text-dark rounded-pill px-3 py-1 small fw-bold">
                                2025
                            </div>
                        </div>
                        <div class="program-icon mt-3">
                            <div class="icon-wrapper bg-white rounded-3 p-3 d-inline-block">
                                <span class="display-6">🏗️</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4 position-relative">
                        <div class="program-budget-tag bg-warning text-dark px-3 py-2 rounded-pill position-absolute top-0 start-50 translate-middle">
                            Rp 850Jt
                        </div>
                        <h5 class="fw-bold text-dark mb-3 mt-2">Program Bantuan Infrastruktur Desa</h5>
                        <p class="text-secondary mb-4">
                            Pembangunan jalan desa dan jembatan kecil untuk meningkatkan konektivitas antarwilayah.
                        </p>
                        
                        <div class="program-stats mb-4">
                            <div class="row text-center">
                                <div class="col-4">
                                    <div class="stat-number text-primary fw-bold">15+</div>
                                    <div class="stat-label text-muted small">Desa</div>
                                </div>
                                <div class="col-4">
                                    <div class="stat-number text-primary fw-bold">8</div>
                                    <div class="stat-label text-muted small">Jembatan</div>
                                </div>
                                <div class="col-4">
                                    <div class="stat-number text-primary fw-bold">60%</div>
                                    <div class="stat-label text-muted small">Progress</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <a href="#" class="btn btn-primary rounded-pill py-2 fw-semibold">
                                <i class="fas fa-file-pdf me-2"></i>Lihat Dokumen
                            </a>
                            <a href="#" class="btn btn-outline-primary rounded-pill py-2">
                                <i class="fas fa-map-marked-alt me-2"></i>Lihat Lokasi
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 3 - Kesehatan -->
            <div class="col-md-6 col-lg-4">
                <div class="card program-card border-0 shadow-lg h-100 rounded-4 overflow-hidden">
                    <div class="card-header-gradient bg-health">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="program-badge bg-white text-primary rounded-pill px-3 py-1 small fw-bold">
                                HEALTH-003
                            </div>
                            <div class="program-year bg-white text-dark rounded-pill px-3 py-1 small fw-bold">
                                2024
                            </div>
                        </div>
                        <div class="program-icon mt-3">
                            <div class="icon-wrapper bg-white rounded-3 p-3 d-inline-block">
                                <span class="display-6">🏥</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4 position-relative">
                        <div class="program-budget-tag bg-info text-white px-3 py-2 rounded-pill position-absolute top-0 start-50 translate-middle">
                            Rp 500Jt
                        </div>
                        <h5 class="fw-bold text-dark mb-3 mt-2">Program Kesehatan Masyarakat</h5>
                        <p class="text-secondary mb-4">
                            Penyediaan layanan kesehatan gratis dan sosialisasi gizi bagi masyarakat kurang mampu.
                        </p>
                        
                        <div class="program-stats mb-4">
                            <div class="row text-center">
                                <div class="col-4">
                                    <div class="stat-number text-primary fw-bold">2K+</div>
                                    <div class="stat-label text-muted small">Pasien</div>
                                </div>
                                <div class="col-4">
                                    <div class="stat-number text-primary fw-bold">12</div>
                                    <div class="stat-label text-muted small">Posyandu</div>
                                </div>
                                <div class="col-4">
                                    <div class="stat-number text-primary fw-bold">85%</div>
                                    <div class="stat-label text-muted small">Progress</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <a href="#" class="btn btn-primary rounded-pill py-2 fw-semibold">
                                <i class="fas fa-file-pdf me-2"></i>Lihat Dokumen
                            </a>
                            <a href="#" class="btn btn-outline-primary rounded-pill py-2">
                                <i class="fas fa-calendar-alt me-2"></i>Jadwal Kegiatan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary Section -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="card border-0 bg-gradient-primary text-white rounded-4 overflow-hidden">
                    <div class="card-body p-5">
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <h3 class="fw-bold mb-3">Total Anggaran Program</h3>
                                <h1 class="display-4 fw-bold mb-4">Rp 2.55 Miliar</h1>
                                <p class="mb-0 opacity-75">Dana dialokasikan untuk 3 program utama pembangunan daerah</p>
                            </div>
                            <div class="col-lg-4 text-lg-end">
                                <div class="d-inline-block bg-white text-primary rounded-3 p-4">
                                    <div class="h2 fw-bold mb-0">3</div>
                                    <div class="small">Program Aktif</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
}

.card-header-gradient {
    padding: 2rem 1.5rem 1.5rem;
    color: white;
    position: relative;
}

.bg-education {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
}

.bg-infrastructure {
    background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
}

.bg-health {
    background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
}

.program-card {
    transition: all 0.3s ease;
    border: none;
}

.program-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15) !important;
}

.program-budget-tag {
    font-size: 0.85rem;
    font-weight: 600;
    z-index: 1;
}

.icon-wrapper {
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.stat-number {
    font-size: 1.25rem;
}

.stat-label {
    font-size: 0.75rem;
}

.program-stats {
    border-top: 1px solid #e9ecef;
    border-bottom: 1px solid #e9ecef;
    padding: 1rem 0;
}

.btn {
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
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

.program-card {
    animation: fadeInUp 0.6s ease-out;
}

.program-card:nth-child(2) {
    animation-delay: 0.1s;
}

.program-card:nth-child(3) {
    animation-delay: 0.2s;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .hero-section .display-5 {
        font-size: 2rem;
    }
    
    .program-stats .stat-number {
        font-size: 1rem;
    }
    
    .card-header-gradient {
        padding: 1.5rem 1rem 1rem;
    }
}
</style>

<script>
// Add some interactive features
document.addEventListener('DOMContentLoaded', function() {
    // Add click animation to cards
    const cards = document.querySelectorAll('.program-card');
    cards.forEach(card => {
        card.addEventListener('click', function() {
            this.style.transform = 'scale(0.98)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
        });
    });

    // Add hover effect to buttons
    const buttons = document.querySelectorAll('.btn');
    buttons.forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
        });
        btn.addEventListener('mouseleave', function() {
            this.style.transform = '';
        });
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Nisa-2SIC\laragon-6.0-minimal\www\PembangunanGuest\resources\views/pages/proyek.blade.php ENDPATH**/ ?>