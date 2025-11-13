<!-- resources/views/pages/tentang.blade.php -->
@extends('layouts.guest.app')
@section('title', 'Tentang Kami')

@section('content')
<div class="about-section">
    <div class="container">
        <!-- Header Section dengan Gambar -->
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <div class="hero-image mb-4">
                    <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80"
                         alt="Construction Site"
                         class="img-fluid rounded-3 shadow">
                </div>
                <h1 class="display-5 fw-bold text-primary mb-4">PembangunanProyek</h1>
                <p class="lead mb-4">Platform terintegrasi untuk mengelola proyek pembangunan dengan transparansi dan efisiensi maksimal</p>
            </div>
        </div>

        <!-- Visi Misi -->
        <div class="row mb-5">
            <div class="col-lg-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                                 alt="Vision"
                                 class="img-fluid rounded-3 mb-3"
                                 style="height: 200px; object-fit: cover; width: 100%;">
                        </div>
                        <div class="feature-icon">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <h3 class="h4 mb-3">Visi Kami</h3>
                        <p class="text-muted">Menjadi platform terdepan dalam digitalisasi manajemen proyek pembangunan yang transparan, akuntabel, dan berkelanjutan di Indonesia.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <img src="https://images.unsplash.com/photo-1581094794329-c8112a89af12?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                                 alt="Mission"
                                 class="img-fluid rounded-3 mb-3"
                                 style="height: 200px; object-fit: cover; width: 100%;">
                        </div>
                        <div class="feature-icon">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <h3 class="h4 mb-3">Misi Kami</h3>
                        <ul class="text-muted">
                            <li>Menyediakan sistem monitoring proyek yang real-time</li>
                            <li>Meningkatkan transparansi dalam pengelolaan proyek</li>
                            <li>Memudahkan koordinasi antara semua stakeholder</li>
                            <li>Mengoptimalkan efisiensi waktu dan biaya proyek</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modul dan Fitur -->
        <div class="row mb-5">
            <div class="col-12 text-center mb-5">
                <h2 class="fw-bold text-primary">Modul & Fitur Utama</h2>
                <p class="text-muted">Berbagai modul yang mendukung pengelolaan proyek secara komprehensif</p>
            </div>

            <!-- Proyek -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="feature-card">
                    <div class="module-image" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="text-center mb-3">
                        <img src="https://images.unsplash.com/photo-1541888946425-d81bb19240f5?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                             alt="Project Management"
                             class="img-fluid rounded-3"
                             style="height: 120px; object-fit: cover; width: 100%;">
                    </div>
                    <h4 class="fw-bold mb-3">Manajemen Proyek</h4>
                    <p class="text-muted mb-3">Mengelola semua informasi proyek pembangunan secara terpusat</p>
                    <ul class="list-unstyled text-muted">
                        <li><i class="fas fa-check text-success me-2"></i>Data master proyek</li>
                        <li><i class="fas fa-check text-success me-2"></i>Jadwal pelaksanaan</li>
                        <li><i class="fas fa-check text-success me-2"></i>Dokumentasi proyek</li>
                    </ul>
                </div>
            </div>

            <!-- Tahapan -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="feature-card">
                    <div class="module-image" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                        <i class="fas fa-layer-group"></i>
                    </div>
                    <div class="text-center mb-3">
                        <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                             alt="Project Stages"
                             class="img-fluid rounded-3"
                             style="height: 120px; object-fit: cover; width: 100%;">
                    </div>
                    <h4 class="fw-bold mb-3">Tahapan Proyek</h4>
                    <p class="text-muted mb-3">Memantau perkembangan setiap tahapan proyek secara detail</p>
                    <ul class="list-unstyled text-muted">
                        <li><i class="fas fa-check text-success me-2"></i>Perencanaan awal</li>
                        <li><i class="fas fa-check text-success me-2"></i>Pelaksanaan konstruksi</li>
                        <li><i class="fas fa-check text-success me-2"></i>Monitoring berkala</li>
                    </ul>
                </div>
            </div>

            <!-- Progres -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="feature-card">
                    <div class="module-image" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="text-center mb-3">
                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                             alt="Progress Tracking"
                             class="img-fluid rounded-3"
                             style="height: 120px; object-fit: cover; width: 100%;">
                    </div>
                    <h4 class="fw-bold mb-3">Tracking Progres</h4>
                    <p class="text-muted mb-3">Memantau kemajuan proyek secara real-time dengan visualisasi data</p>
                    <ul class="list-unstyled text-muted">
                        <li><i class="fas fa-check text-success me-2"></i>Progress percentage</li>
                        <li><i class="fas fa-check text-success me-2"></i>Grafik perkembangan</li>
                        <li><i class="fas fa-check text-success me-2"></i>Laporan otomatis</li>
                    </ul>
                </div>
            </div>

            <!-- Lokasi -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="feature-card">
                    <div class="module-image" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="text-center mb-3">
                        <img src="https://images.unsplash.com/photo-1541971875076-8f970d573be6?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                             alt="Location Management"
                             class="img-fluid rounded-3"
                             style="height: 120px; object-fit: cover; width: 100%;">
                    </div>
                    <h4 class="fw-bold mb-3">Manajemen Lokasi</h4>
                    <p class="text-muted mb-3">Mengelola informasi geografis dan denah lokasi proyek</p>
                    <ul class="list-unstyled text-muted">
                        <li><i class="fas fa-check text-success me-2"></i>Peta lokasi proyek</li>
                        <li><i class="fas fa-check text-success me-2"></i>Denah site plan</li>
                        <li><i class="fas fa-check text-success me-2"></i>Koordinasi area</li>
                    </ul>
                </div>
            </div>

            <!-- Kontraktor -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="feature-card">
                    <div class="module-image" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                        <i class="fas fa-hard-hat"></i>
                    </div>
                    <div class="text-center mb-3">
                        <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                             alt="Contractor Data"
                             class="img-fluid rounded-3"
                             style="height: 120px; object-fit: cover; width: 100%;">
                    </div>
                    <h4 class="fw-bold mb-3">Data Kontraktor</h4>
                    <p class="text-muted mb-3">Mengelola informasi vendor dan kontraktor yang terlibat</p>
                    <ul class="list-unstyled text-muted">
                        <li><i class="fas fa-check text-success me-2"></i>Profil kontraktor</li>
                        <li><i class="fas fa-check text-success me-2"></i>Riwayat pekerjaan</li>
                        <li><i class="fas fa-check text-success me-2"></i>Evaluasi kinerja</li>
                    </ul>
                </div>
            </div>



        <!-- Alur Kerja dengan Gambar -->
        <div class="row mb-5">
            <div class="col-12 text-center mb-5">
                <h2 class="fw-bold text-primary">Alur Kerja Sistem</h2>
                <p class="text-muted">Proses terstruktur dari perencanaan hingga penyelesaian proyek</p>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="process-step">
                    <div class="step-image mb-3">
                        <img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80"
                             alt="Planning"
                             class="img-fluid rounded-circle"
                             style="height: 80px; width: 80px; object-fit: cover;">
                    </div>
                    <div class="step-number">1</div>
                    <h5>Perencanaan</h5>
                    <p class="text-muted small">Input data proyek, tentukan timeline, dan alokasi sumber daya</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="process-step">
                    <div class="step-image mb-3">
                        <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80"
                             alt="Execution"
                             class="img-fluid rounded-circle"
                             style="height: 80px; width: 80px; object-fit: cover;">
                    </div>
                    <div class="step-number">2</div>
                    <h5>Pelaksanaan</h5>
                    <p class="text-muted small">Monitoring tahapan konstruksi dan progres pekerjaan</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="process-step">
                    <div class="step-image mb-3">
                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80"
                             alt="Monitoring"
                             class="img-fluid rounded-circle"
                             style="height: 80px; width: 80px; object-fit: cover;">
                    </div>
                    <div class="step-number">3</div>
                    <h5>Monitoring</h5>
                    <p class="text-muted small">Tracking real-time, dokumentasi, dan evaluasi berkala</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="process-step">
                    <div class="step-image mb-3">
                        <img src="https://images.unsplash.com/photo-1581094794329-c8112a89af12?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80"
                             alt="Reporting"
                             class="img-fluid rounded-circle"
                             style="height: 80px; width: 80px; object-fit: cover;">
                    </div>
                    <div class="step-number">4</div>
                    <h5>Pelaporan</h5>
                    <p class="text-muted small">Generate laporan otomatis dan analisis kinerja proyek</p>
                </div>
            </div>
        </div>

        <!-- Tim Pengembang -->
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="fw-bold text-primary">Tim Kami</h2>
                <p class="text-muted">Dikelola oleh tim profesional yang berdedikasi</p>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="team-card">
                    <div class="team-image mb-3">
                        <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80"
                             alt="Project Manager"
                             class="img-fluid rounded-circle"
                             style="height: 100px; width: 100px; object-fit: cover;">
                    </div>
                    <h5>Project Manager</h5>
                    <p class="text-muted small">Mengawasi keseluruhan eksekusi proyek</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="team-card">
                    <div class="team-image mb-3">
                        <img src="https://images.unsplash.com/photo-1581094794329-c8112a89af12?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80"
                             alt="Site Engineer"
                             class="img-fluid rounded-circle"
                             style="height: 100px; width: 100px; object-fit: cover;">
                    </div>
                    <h5>Site Engineer</h5>
                    <p class="text-muted small">Bertanggung jawab pada teknis lapangan</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="team-card">
                    <div class="team-image mb-3">
                        <img src="https://images.unsplash.com/photo-1556157382-97eda2f9e13f?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80"
                             alt="Data Analyst"
                             class="img-fluid rounded-circle"
                             style="height: 100px; width: 100px; object-fit: cover;">
                    </div>
                    <h5>Data Analyst</h5>
                    <p class="text-muted small">Menganalisis progres dan kinerja proyek</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="team-card">
                    <div class="team-image mb-3">
                        <img src="https://images.unsplash.com/photo-1581094794329-c8112a89af12?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80"
                             alt="Community Officer"
                             class="img-fluid rounded-circle"
                             style="height: 100px; width: 100px; object-fit: cover;">
                    </div>
                    <h5>Community Officer</h5>
                    <p class="text-muted small">Menangani hubungan dengan masyarakat</p>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- css --}}
<style>
    .hero-image img {
        max-height: 300px;
        object-fit: cover;
        width: 100%;
    }

    .step-image, .team-image {
        display: flex;
        justify-content: center;
    }

    .feature-card .text-center img {
        transition: transform 0.3s ease;
    }

    .feature-card:hover .text-center img {
        transform: scale(1.05);
    }

    .team-image img {
        border: 3px solid #0d6efd;
    }

    .step-image img {
        border: 3px solid #0d6efd;
    }
</style>
{{-- end css --}}
@endsection
