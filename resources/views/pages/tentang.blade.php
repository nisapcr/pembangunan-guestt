@extends('layouts.guest.app')
@section('title', 'Tentang Kami')

@section('content')
<div class="about-section">
    <!-- Hero Section dengan Video/GIF Background -->
    <div class="hero-section position-relative overflow-hidden">
        <div class="container position-relative z-2 py-5">
            <div class="row align-items-center min-vh-50 py-5">
                <div class="col-lg-7 text-center text-lg-start">
                    <h1 class="display-3 fw-bold text-white mb-4 animate__animated animate__fadeInUp">
                        <span class="text-warning">Pembangunan</span>Proyek
                    </h1>
                    <p class="lead text-light mb-4 animate__animated animate__fadeInUp animate__delay-1s">
                        Platform digital terintegrasi untuk mengelola, memantau, dan mengoptimalkan
                        seluruh siklus proyek pembangunan dengan transparansi dan efisiensi maksimal
                    </p>
                    <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-lg-start animate__animated animate__fadeInUp animate__delay-2s">
                        <a href="#features" class="btn btn-warning btn-lg px-4 py-3">
                            <i class="fas fa-cogs me-2"></i>Lihat Fitur
                        </a>
                        <a href="#workflow" class="btn btn-outline-light btn-lg px-4 py-3">
                            <i class="fas fa-play-circle me-2"></i>Lihat Demo
                        </a>
                    </div>
                </div>
                <div class="col-lg-5 mt-5 mt-lg-0 animate__animated animate__fadeInRight">
                    <div class="hero-image-container position-relative">
                        <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80"
                             alt="Construction Management"
                             class="img-fluid rounded-4 shadow-lg"
                             loading="lazy">
                        <div class="floating-badge bg-primary text-white p-3 rounded-4 shadow">
                            <i class="fas fa-chart-line fa-2x mb-2"></i>
                            <h6 class="mb-0">+45% Efisiensi</h6>
                            <small>Waktu Proyek</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Gradient Overlay -->
        <div class="position-absolute top-0 start-0 w-100 h-100 bg-gradient-dark"></div>
    </div>

    <!-- Statistik -->
    <div class="stats-section py-5 bg-light">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-3 col-6 text-center">
                    <div class="stat-item p-4 bg-white rounded-4 shadow-sm">
                        <i class="fas fa-building fa-3x text-primary mb-3"></i>
                        <h3 class="display-6 fw-bold text-dark mb-2" data-count="250">0</h3>
                        <p class="text-muted mb-0">Proyek Terselesaikan</p>
                    </div>
                </div>
                <div class="col-md-3 col-6 text-center">
                    <div class="stat-item p-4 bg-white rounded-4 shadow-sm">
                        <i class="fas fa-users fa-3x text-success mb-3"></i>
                        <h3 class="display-6 fw-bold text-dark mb-2" data-count="150">0</h3>
                        <p class="text-muted mb-0">Kontraktor Terdaftar</p>
                    </div>
                </div>
                <div class="col-md-3 col-6 text-center">
                    <div class="stat-item p-4 bg-white rounded-4 shadow-sm">
                        <i class="fas fa-map-marker-alt fa-3x text-warning mb-3"></i>
                        <h3 class="display-6 fw-bold text-dark mb-2" data-count="18">0</h3>
                        <p class="text-muted mb-0">Kota di Indonesia</p>
                    </div>
                </div>
                <div class="col-md-3 col-6 text-center">
                    <div class="stat-item p-4 bg-white rounded-4 shadow-sm">
                        <i class="fas fa-clock fa-3x text-info mb-3"></i>
                        <h3 class="display-6 fw-bold text-dark mb-2" data-count="98">0</h3>
                        <p class="text-muted mb-0">% Proyek Tepat Waktu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Visi & Misi -->
    <div class="vision-mission py-5">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="vision-card p-5 bg-primary text-white rounded-4 shadow-lg">
                        <div class="d-flex align-items-center mb-4">
                            <div class="vision-icon me-4">
                                <i class="fas fa-bullseye fa-3x"></i>
                            </div>
                            <h2 class="mb-0">Visi Kami</h2>
                        </div>
                        <p class="lead mb-4">
                            Menjadi ekosistem digital terdepan yang mengubah cara pengelolaan
                            proyek pembangunan di Indonesia melalui teknologi inovatif,
                            transparansi data, dan kolaborasi semua stakeholder.
                        </p>
                        <div class="vision-image">
                            <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                                 alt="Vision"
                                 class="img-fluid rounded-3"
                                 loading="lazy">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mission-card p-5 bg-white rounded-4 shadow-lg border">
                        <div class="d-flex align-items-center mb-4">
                            <div class="mission-icon me-4">
                                <i class="fas fa-tasks fa-3x text-primary"></i>
                            </div>
                            <h2 class="mb-0 text-primary">Misi Kami</h2>
                        </div>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="mission-item p-3 bg-light rounded-3">
                                    <i class="fas fa-bolt text-warning fa-2x mb-3"></i>
                                    <h5>Digitalisasi Proses</h5>
                                    <p class="small mb-0">Mengotomatisasi alur kerja proyek</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mission-item p-3 bg-light rounded-3">
                                    <i class="fas fa-eye text-success fa-2x mb-3"></i>
                                    <h5>Transparansi Data</h5>
                                    <p class="small mb-0">Akses informasi real-time untuk semua pihak</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mission-item p-3 bg-light rounded-3">
                                    <i class="fas fa-handshake text-info fa-2x mb-3"></i>
                                    <h5>Kolaborasi Optimal</h5>
                                    <p class="small mb-0">Sinkronisasi tim dan kontraktor</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mission-item p-3 bg-light rounded-3">
                                    <i class="fas fa-leaf text-success fa-2x mb-3"></i>
                                    <h5>Berbasis Sustainability</h5>
                                    <p class="small mb-0">Mendukung pembangunan berkelanjutan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modul & Fitur -->
    <div id="features" class="features-section py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <span class="badge bg-primary mb-3 px-4 py-2">MODUL TERINTEGRASI</span>
                <h2 class="display-5 fw-bold text-dark mb-3">Modul & Fitur Utama</h2>
                <p class="lead text-muted mx-auto" style="max-width: 700px;">
                    Sistem komprehensif yang mencakup seluruh aspek pengelolaan proyek pembangunan
                </p>
            </div>

            <div class="row g-4">
                <!-- Proyek -->
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card-module h-100 bg-white rounded-4 shadow-lg overflow-hidden position-relative">
                        <div class="module-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            <div class="module-icon">
                                <i class="fas fa-building"></i>
                            </div>
                            <img src="https://images.unsplash.com/photo-1541888946425-d81bb19240f5?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                                 alt="Project Management"
                                 class="img-fluid w-100 module-hero-image"
                                 loading="lazy">
                        </div>
                        <div class="module-body p-4">
                            <h4 class="fw-bold mb-3">Manajemen Proyek</h4>
                            <p class="text-muted mb-3">Pengelolaan terpusat semua informasi proyek pembangunan</p>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Data master proyek</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Jadwal pelaksanaan</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Dokumentasi proyek</li>
                                <li><i class="fas fa-check-circle text-success me-2"></i>Manajemen risiko</li>
                            </ul>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar" style="width: 95%; background: #667eea;"></div>
                            </div>
                            <small class="text-muted">95% Efektivitas</small>
                        </div>
                    </div>
                </div>

                <!-- Tahapan -->
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card-module h-100 bg-white rounded-4 shadow-lg overflow-hidden position-relative">
                        <div class="module-header" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                            <div class="module-icon">
                                <i class="fas fa-layer-group"></i>
                            </div>
                            <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                                 alt="Project Stages"
                                 class="img-fluid w-100 module-hero-image"
                                 loading="lazy">
                        </div>
                        <div class="module-body p-4">
                            <h4 class="fw-bold mb-3">Tahapan Proyek</h4>
                            <p class="text-muted mb-3">Pemantauan detail setiap fase konstruksi</p>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Perencanaan awal</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Pelaksanaan konstruksi</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Monitoring berkala</li>
                                <li><i class="fas fa-check-circle text-success me-2"></i>Quality control</li>
                            </ul>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar" style="width: 90%; background: #f5576c;"></div>
                            </div>
                            <small class="text-muted">90% Kepuasan Pengguna</small>
                        </div>
                    </div>
                </div>

                <!-- Progres -->
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card-module h-100 bg-white rounded-4 shadow-lg overflow-hidden position-relative">
                        <div class="module-header" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                            <div class="module-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                                 alt="Progress Tracking"
                                 class="img-fluid w-100 module-hero-image"
                                 loading="lazy">
                        </div>
                        <div class="module-body p-4">
                            <h4 class="fw-bold mb-3">Tracking Progres</h4>
                            <p class="text-muted mb-3">Monitoring real-time dengan visualisasi data interaktif</p>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Progress percentage</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Grafik perkembangan</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Laporan otomatis</li>
                                <li><i class="fas fa-check-circle text-success me-2"></i>Alert system</li>
                            </ul>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar" style="width: 98%; background: #4facfe;"></div>
                            </div>
                            <small class="text-muted">98% Akurasi Data</small>
                        </div>
                    </div>
                </div>

                <!-- Lokasi -->
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card-module h-100 bg-white rounded-4 shadow-lg overflow-hidden position-relative">
                        <div class="module-header" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                            <div class="module-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <img src="https://images.unsplash.com/photo-1541971875076-8f970d573be6?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                                 alt="Location Management"
                                 class="img-fluid w-100 module-hero-image"
                                 loading="lazy">
                        </div>
                        <div class="module-body p-4">
                            <h4 class="fw-bold mb-3">Manajemen Lokasi</h4>
                            <p class="text-muted mb-3">Pengelolaan geografis dan denah proyek digital</p>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Peta lokasi proyek</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Denah site plan</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Koordinasi area</li>
                                <li><i class="fas fa-check-circle text-success me-2"></i>GIS integration</li>
                            </ul>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar" style="width: 92%; background: #43e97b;"></div>
                            </div>
                            <small class="text-muted">92% Efisiensi Lokasi</small>
                        </div>
                    </div>
                </div>

                <!-- Kontraktor -->
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card-module h-100 bg-white rounded-4 shadow-lg overflow-hidden position-relative">
                        <div class="module-header" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                            <div class="module-icon">
                                <i class="fas fa-hard-hat"></i>
                            </div>
                            <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                                 alt="Contractor Data"
                                 class="img-fluid w-100 module-hero-image"
                                 loading="lazy">
                        </div>
                        <div class="module-body p-4">
                            <h4 class="fw-bold mb-3">Data Kontraktor</h4>
                            <p class="text-muted mb-3">Manajemen vendor dan kontraktor terintegrasi</p>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Profil kontraktor</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Riwayat pekerjaan</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Evaluasi kinerja</li>
                                <li><i class="fas fa-check-circle text-success me-2"></i>Sertifikasi</li>
                            </ul>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar" style="width: 88%; background: #fa709a;"></div>
                            </div>
                            <small class="text-muted">88% Kepuasan Mitra</small>
                        </div>
                    </div>
                </div>

                <!-- Anggaran -->
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card-module h-100 bg-white rounded-4 shadow-lg overflow-hidden position-relative">
                        <div class="module-header" style="background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);">
                            <div class="module-icon">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                            <img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                                 alt="Budget Management"
                                 class="img-fluid w-100 module-hero-image"
                                 loading="lazy">
                        </div>
                        <div class="module-body p-4">
                            <h4 class="fw-bold mb-3">Manajemen Anggaran</h4>
                            <p class="text-muted mb-3">Pengendalian biaya dan keuangan proyek</p>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Budget planning</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Expense tracking</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Cash flow analysis</li>
                                <li><i class="fas fa-check-circle text-success me-2"></i>Financial reporting</li>
                            </ul>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar" style="width: 96%; background: #a8edea;"></div>
                            </div>
                            <small class="text-muted">96% Akurasi Anggaran</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alur Kerja -->
    <div id="workflow" class="workflow-section py-5">
        <div class="container">
            <div class="text-center mb-5">
                <span class="badge bg-warning mb-3 px-4 py-2">PROSES TERSTRUKTUR</span>
                <h2 class="display-5 fw-bold text-dark mb-3">Alur Kerja Sistem</h2>
                <p class="lead text-muted mx-auto" style="max-width: 700px;">
                    Proses terintegrasi dari perencanaan hingga penyelesaian proyek
                </p>
            </div>

            <div class="workflow-timeline">
                <!-- Step 1 -->
                <div class="workflow-step">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <div class="step-header">
                            <div class="step-icon">
                                <i class="fas fa-lightbulb"></i>
                            </div>
                            <h4>Inisiasi & Perencanaan</h4>
                        </div>
                        <p class="text-muted mb-3">Identifikasi kebutuhan, analisis kelayakan, dan penyusunan rencana proyek</p>
                        <div class="step-image">
                            <img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                                 alt="Planning"
                                 class="img-fluid rounded-3"
                                 loading="lazy">
                        </div>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="workflow-step">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <div class="step-header">
                            <div class="step-icon">
                                <i class="fas fa-cogs"></i>
                            </div>
                            <h4>Persiapan & Setup</h4>
                        </div>
                        <p class="text-muted mb-3">Setup sistem, penjadwalan, alokasi sumber daya, dan persiapan kontrak</p>
                        <div class="step-image">
                            <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                                 alt="Setup"
                                 class="img-fluid rounded-3"
                                 loading="lazy">
                        </div>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="workflow-step">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <div class="step-header">
                            <div class="step-icon">
                                <i class="fas fa-hard-hat"></i>
                            </div>
                            <h4>Pelaksanaan</h4>
                        </div>
                        <p class="text-muted mb-3">Eksekusi konstruksi, quality control, dan manajemen lapangan</p>
                        <div class="step-image">
                            <img src="https://images.unsplash.com/photo-1581094794329-c8112a89af12?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                                 alt="Execution"
                                 class="img-fluid rounded-3"
                                 loading="lazy">
                        </div>
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="workflow-step">
                    <div class="step-number">4</div>
                    <div class="step-content">
                        <div class="step-header">
                            <div class="step-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <h4>Monitoring & Kontrol</h4>
                        </div>
                        <p class="text-muted mb-3">Tracking progress, evaluasi kinerja, dan penyesuaian rencana</p>
                        <div class="step-image">
                            <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                                 alt="Monitoring"
                                 class="img-fluid rounded-3"
                                 loading="lazy">
                        </div>
                    </div>
                </div>

                <!-- Step 5 -->
                <div class="workflow-step">
                    <div class="step-number">5</div>
                    <div class="step-content">
                        <div class="step-header">
                            <div class="step-icon">
                                <i class="fas fa-flag-checkered"></i>
                            </div>
                            <h4>Penyelesaian & Evaluasi</h4>
                        </div>
                        <p class="text-muted mb-3">Finalisasi proyek, dokumentasi, evaluasi hasil, dan lesson learned</p>
                        <div class="step-image">
                            <img src="https://images.unsplash.com/photo-1581094794329-c8112a89af12?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                                 alt="Completion"
                                 class="img-fluid rounded-3"
                                 loading="lazy">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tim -->
    <div class="team-section py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <span class="badge bg-info mb-3 px-4 py-2">TIM KAMI</span>
                <h2 class="display-5 fw-bold text-dark mb-3">Tim Profesional</h2>
                <p class="lead text-muted mx-auto" style="max-width: 700px;">
                    Dikelola oleh ahli-ahli berpengalaman di bidang konstruksi dan teknologi
                </p>
            </div>

            <div class="row g-4">
                <!-- Team Member 1 -->
                <div class="col-lg-3 col-md-6">
                    <div class="team-member-card text-center bg-white p-4 rounded-4 shadow-sm h-100">
                        <div class="team-member-image mb-4">
                            <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                                 alt="Project Manager"
                                 class="img-fluid rounded-circle border border-4 border-primary"
                                 loading="lazy"
                                 style="width: 150px; height: 150px; object-fit: cover;">
                        </div>
                        <h5 class="fw-bold mb-2">Ahmad Rizki</h5>
                        <p class="text-primary mb-3">Project Director</p>
                        <p class="text-muted small mb-4">15+ tahun pengalaman dalam manajemen proyek konstruksi skala besar</p>
                        <div class="social-links">
                            <a href="#" class="text-primary me-3"><i class="fab fa-linkedin fa-lg"></i></a>
                            <a href="#" class="text-primary"><i class="fab fa-twitter fa-lg"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Team Member 2 -->
                <div class="col-lg-3 col-md-6">
                    <div class="team-member-card text-center bg-white p-4 rounded-4 shadow-sm h-100">
                        <div class="team-member-image mb-4">
                            <img src="https://images.unsplash.com/photo-1581094794329-c8112a89af12?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                                 alt="Site Engineer"
                                 class="img-fluid rounded-circle border border-4 border-success"
                                 loading="lazy"
                                 style="width: 150px; height: 150px; object-fit: cover;">
                        </div>
                        <h5 class="fw-bold mb-2">Maya Sari</h5>
                        <p class="text-success mb-3">Chief Technical Officer</p>
                        <p class="text-muted small mb-4">Spesialis sistem konstruksi dan implementasi teknologi BIM</p>
                        <div class="social-links">
                            <a href="#" class="text-success me-3"><i class="fab fa-linkedin fa-lg"></i></a>
                            <a href="#" class="text-success"><i class="fab fa-github fa-lg"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Team Member 3 -->
                <div class="col-lg-3 col-md-6">
                    <div class="team-member-card text-center bg-white p-4 rounded-4 shadow-sm h-100">
                        <div class="team-member-image mb-4">
                            <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                                 alt="Project Manager"
                                 class="img-fluid rounded-circle border border-4 border-primary"
                                 loading="lazy"
                                 style="width: 150px; height: 150px; object-fit: cover;">
                        </div>
                        <h5 class="fw-bold mb-2">Rizky Pratama</h5>
                        <p class="text-warning mb-3">Data Analytics Lead</p>
                        <p class="text-muted small mb-4">Ahli analisis data konstruksi dan prediksi performa proyek</p>
                        <div class="social-links">
                            <a href="#" class="text-warning me-3"><i class="fab fa-linkedin fa-lg"></i></a>
                            <a href="#" class="text-warning"><i class="fab fa-medium fa-lg"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Team Member 4 -->
                <div class="col-lg-3 col-md-6">
                    <div class="team-member-card text-center bg-white p-4 rounded-4 shadow-sm h-100">
                        <div class="team-member-image mb-4">
                            <img src="https://images.unsplash.com/photo-1581094794329-c8112a89af12?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                                 alt="Community Officer"
                                 class="img-fluid rounded-circle border border-4 border-info"
                                 loading="lazy"
                                 style="width: 150px; height: 150px; object-fit: cover;">
                        </div>
                        <h5 class="fw-bold mb-2">Dewi Anggraeni</h5>
                        <p class="text-info mb-3">Stakeholder Relations</p>
                        <p class="text-muted small mb-4">Pakar hubungan masyarakat dan koordinasi stakeholder proyek</p>
                        <div class="social-links">
                            <a href="#" class="text-info me-3"><i class="fab fa-linkedin fa-lg"></i></a>
                            <a href="#" class="text-info"><i class="fab fa-instagram fa-lg"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


{{-- CSS Styles --}}
<style>
    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        min-height: 80vh;
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><path fill="%23ffffff10" d="M0,0L1000,1000L1000,0Z"/></svg>');
        background-size: cover;
        opacity: 0.1;
    }

    .hero-image-container {
        position: relative;
    }

    .floating-badge {
        position: absolute;
        bottom: 20px;
        right: 20px;
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    .bg-gradient-dark {
        background: linear-gradient(to right, rgba(0,0,0,0.7), rgba(0,0,0,0.3));
    }

    /* Stats Section */
    .stat-item {
        transition: transform 0.3s ease;
    }

    .stat-item:hover {
        transform: translateY(-10px);
    }

    /* Feature Cards */
    .feature-card-module {
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .feature-card-module:hover {
        transform: translateY(-5px);
        border-color: #0d6efd;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
    }

    .module-header {
        height: 200px;
        position: relative;
        overflow: hidden;
    }

    .module-icon {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 60px;
        height: 60px;
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
        backdrop-filter: blur(10px);
        z-index: 2;
    }

    .module-hero-image {
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .feature-card-module:hover .module-hero-image {
        transform: scale(1.1);
    }

    /* Workflow Timeline */
    .workflow-timeline {
        position: relative;
        padding-left: 50px;
    }

    .workflow-timeline::before {
        content: '';
        position: absolute;
        left: 25px;
        top: 0;
        bottom: 0;
        width: 4px;
        background: linear-gradient(to bottom, #4facfe, #00f2fe);
        border-radius: 2px;
    }

    .workflow-step {
        position: relative;
        margin-bottom: 40px;
    }

    .step-number {
        position: absolute;
        left: -50px;
        top: 0;
        width: 50px;
        height: 50px;
        background: #0d6efd;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 20px;
        border: 4px solid white;
    }

    .step-content {
        background: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .step-header {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .step-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        color: white;
        font-size: 20px;
    }

    .step-image img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 10px;
    }

    /* Team Cards */
    .team-member-card {
        transition: transform 0.3s ease;
    }

    .team-member-card:hover {
        transform: translateY(-10px);
    }

    .team-member-image img {
        transition: transform 0.3s ease;
    }

    .team-member-card:hover .team-member-image img {
        transform: scale(1.05);
    }

    /* CTA Section */
    .cta-section {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        position: relative;
        overflow: hidden;
    }

    .cta-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
        background-size: 50px 50px;
        transform: rotate(30deg);
        animation: moveBackground 20s linear infinite;
    }

    @keyframes moveBackground {
        0% { transform: rotate(30deg) translateX(0); }
        100% { transform: rotate(30deg) translateX(100px); }
    }

    /* Animations */
    .animate__animated {
        animation-duration: 1s;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-section {
            min-height: 60vh;
            text-align: center;
        }

        .workflow-timeline {
            padding-left: 0;
        }

        .workflow-timeline::before {
            display: none;
        }

        .step-number {
            position: relative;
            left: 0;
            top: 0;
            margin-bottom: 15px;
        }
    }
</style>

{{-- JavaScript for Counter Animation --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Counter animation for stats
        const counters = document.querySelectorAll('[data-count]');

        const animateCounter = (counter) => {
            const target = parseInt(counter.getAttribute('data-count'));
            const duration = 2000;
            const increment = target / (duration / 16);
            let current = 0;

            const updateCounter = () => {
                current += increment;
                if (current < target) {
                    counter.textContent = Math.floor(current);
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.textContent = target;
                }
            };

            updateCounter();
        };

        // Intersection Observer for counters
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        counters.forEach(counter => {
            counter.textContent = '0';
            observer.observe(counter);
        });
    });
</script>
@endsection
