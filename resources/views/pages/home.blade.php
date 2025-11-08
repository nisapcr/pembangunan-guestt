@extends('layouts.app')

@section('content')
<section id="hero" class="bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <h1 class="display-5 fw-bold mb-5">Selamat Datang di PembangunanProyek</h1>
                <p class="lead mb-3">mitra terpercaya Anda dalam mewujudkan visi. Kami hadir tidak hanya untuk membangun struktur fisik, tetapi untuk merancang landasan masa depan yang berkelanjutan dan penuh makna. Dengan setiap proyek, kami berkomitmen menciptakan ruang yang tidak hanya fungsional, tetapi juga menginspirasi dan meninggalkan warisan positif bagi generasi mendatang. Bersama kami, masa depan yang Anda impikan mulai mengambil bentuk yang nyata.</p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="#" class="btn btn-light btn-lg">
                        <i class="bi bi-box-arrow-in-right"></i> Login
                    </a>
                    <a href="#" class="btn btn-outline-light btn-lg">
                        <i class="bi bi-person-plus"></i> Daftar
                    </a>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <img src="https://images.unsplash.com/photo-1541888946425-d81bb19240f5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" 
                     alt="Pembangunan Proyek" class="img-fluid hero-image">
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="py-5">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="fw-bold text-primary">Mengapa Memilih Kami?</h2>
            <p class="text-muted">Kami menyediakan solusi terbaik untuk kebutuhan pembangunan Anda</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon bg-primary rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                            <i class="bi bi-award text-white fs-4"></i>
                        </div>
                        <h5 class="card-title">Berkualitas Tinggi</h5>
                        <p class="card-text text-muted">Proyek-proyek kami mengutamakan kualitas dan standar keamanan tertinggi.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon bg-success rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                            <i class="bi bi-clock-history text-white fs-4"></i>
                        </div>
                        <h5 class="card-title">Tepat Waktu</h5>
                        <p class="card-text text-muted">Kami berkomitmen menyelesaikan proyek sesuai dengan jadwal yang ditentukan.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon bg-info rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                            <i class="bi bi-shield-check text-white fs-4"></i>
                        </div>
                        <h5 class="card-title">Terpercaya</h5>
                        <p class="card-text text-muted">Dengan pengalaman bertahun-tahun, kami menjadi pilihan terpercaya.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Projects Showcase -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="fw-bold text-primary">Proyek Kami</h2>
            <p class="text-muted">Beberapa proyek yang telah kami selesaikan</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card project-card border-0 shadow-sm h-100">
                    <img src="https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1074&q=80" 
                         class="card-img-top project-img" alt="Proyek Perumahan">
                    <div class="card-body">
                        <h5 class="card-title">Proyek Perumahan</h5>
                        <p class="card-text">Perumahan modern dengan fasilitas lengkap dan lingkungan yang asri.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card project-card border-0 shadow-sm h-100">
                    <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" 
                         class="card-img-top project-img" alt="Proyek Komersial">
                    <div class="card-body">
                        <h5 class="card-title">Proyek Komersial</h5>
                        <p class="card-text">Bangunan komersial dengan desain modern dan fungsional.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card project-card border-0 shadow-sm h-100">
                    <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" 
                         class="card-img-top project-img" alt="Proyek Infrastruktur">
                    <div class="card-body">
                        <h5 class="card-title">Proyek Infrastruktur</h5>
                        <p class="card-text">Pembangunan infrastruktur untuk mendukung perkembangan daerah.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section id="stats" class="py-5 stats-section">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3" data-aos="zoom-in">
                <h3 class="fw-bold text-primary display-4">50+</h3>
                <p class="text-muted">Proyek Selesai</p>
            </div>
            <div class="col-md-3" data-aos="zoom-in" data-aos-delay="100">
                <h3 class="fw-bold text-primary display-4">25+</h3>
                <p class="text-muted">Proyek Berjalan</p>
            </div>
            <div class="col-md-3" data-aos="zoom-in" data-aos-delay="200">
                <h3 class="fw-bold text-primary display-4">100+</h3>
                <p class="text-muted">Klien Puas</p>
            </div>
            <div class="col-md-3" data-aos="zoom-in" data-aos-delay="300">
                <h3 class="fw-bold text-primary display-4">5+</h3>
                <p class="text-muted">Tahun Pengalaman</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="fw-bold text-primary">Testimoni Klien</h2>
            <p class="text-muted">Apa kata klien tentang layanan kami</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" 
                             alt="Klien 1" class="rounded-circle mb-3" style="width: 80px; height: 80px; object-fit: cover;">
                        <h5 class="card-title">Ahmad Rizki</h5>
                        <p class="text-muted fst-italic">"Pelayanan sangat profesional dan hasilnya melebihi ekspektasi. Proyek selesai tepat waktu dengan kualitas terbaik."</p>
                    </div>
                </div>
            </div>
            
            
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" 
                             alt="Klien 3" class="rounded-circle mb-3" style="width: 80px; height: 80px; object-fit: cover;">
                        <h5 class="card-title">Budi Santoso</h5>
                        <p class="text-muted fst-italic">"Kualitas pekerjaan sangat baik dan detail. Sangat merekomendasikan PembangunanProyek untuk proyek konstruksi Anda."</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .feature-icon {
        transition: transform 0.3s ease;
    }
    .card:hover .feature-icon {
        transform: scale(1.1);
    }
    #hero {
        background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);
    }
    .project-img {
        height: 250px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    .project-card:hover .project-img {
        transform: scale(1.05);
    }
    .stats-section {
        background-color: #f8f9fa;
    }
    .hero-image {
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true
            });
        }
    });
</script>
@endsection