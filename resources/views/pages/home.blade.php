@extends('layouts.guest.app')
@section('content')
<!-- Hero Section -->
<section id="hero" class="hero-section position-relative overflow-hidden">
    <div class="hero-bg-pattern"></div>
    <div class="container py-5">
        <div class="row align-items-center min-vh-75">
            <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right">
                <span class="badge bg-white text-primary px-3 py-2 mb-3 shadow-sm">
                    <i class="bi bi-star-fill"></i> #1 Partner Konstruksi Terpercaya
                </span>
                <h1 class="display-3 fw-bold text-white mb-4 hero-title">
                    Wujudkan <span class="text-gradient">Proyek Impian</span> Anda
                </h1>
                <p class="lead text-white-50 mb-4 fs-5">
                    Kami menghadirkan solusi konstruksi terbaik dengan teknologi modern dan tim profesional.
                    Lebih dari sekadar membangun, kami menciptakan masa depan yang berkelanjutan.
                </p>

                <div class="d-flex gap-4 text-white-50">
                    <div>
                        <i class="bi bi-check-circle-fill text-success me-2"></i>
                        <small>Gratis Konsultasi</small>
                    </div>
                    <div>
                        <i class="bi bi-check-circle-fill text-success me-2"></i>
                        <small>Garansi Kualitas</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                <div class="hero-image-wrapper position-relative">
                    <img src="https://images.unsplash.com/photo-1541888946425-d81bb19240f5?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80"
                         alt="Pembangunan Proyek" class="img-fluid hero-image shadow-xl rounded-4">
                    <div class="floating-card">
                        <div class="d-flex align-items-center">
                            <div class="icon-box bg-success text-white me-3">
                                <i class="bi bi-people-fill fs-4"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">100+ Klien</h6>
                                <small class="text-muted">Puas & Percaya</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-wave">
        <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="white"/>
        </svg>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="py-5">
    <div class="container py-4">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="text-primary fw-bold text-uppercase letter-spacing">Keunggulan Kami</span>
            <h2 class="display-5 fw-bold mt-2 mb-3">Mengapa Memilih Kami?</h2>
            <p class="text-muted fs-5 mx-auto" style="max-width: 600px;">
                Dipercaya oleh ratusan klien untuk menghadirkan solusi konstruksi terbaik
            </p>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-card h-100 p-4 rounded-4 border-0 bg-white shadow-hover">
                    <div class="feature-icon-modern bg-primary-soft mb-4">
                        <i class="bi bi-award text-primary fs-2"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Berkualitas Tinggi</h5>
                    <p class="text-muted mb-0">Material premium dan standar keamanan internasional di setiap proyek.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-card h-100 p-4 rounded-4 border-0 bg-white shadow-hover">
                    <div class="feature-icon-modern bg-success-soft mb-4">
                        <i class="bi bi-clock-history text-success fs-2"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Tepat Waktu</h5>
                    <p class="text-muted mb-0">Sistem manajemen proyek modern untuk memastikan penyelesaian on-time.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-card h-100 p-4 rounded-4 border-0 bg-white shadow-hover">
                    <div class="feature-icon-modern bg-info-soft mb-4">
                        <i class="bi bi-shield-check text-info fs-2"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Terpercaya</h5>
                    <p class="text-muted mb-0">Pengalaman 5+ tahun dengan track record proyek sukses di seluruh Indonesia.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                <div class="feature-card h-100 p-4 rounded-4 border-0 bg-white shadow-hover">
                    <div class="feature-icon-modern bg-warning-soft mb-4">
                        <i class="bi bi-headset text-warning fs-2"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Support 24/7</h5>
                    <p class="text-muted mb-0">Tim profesional siap membantu Anda kapan saja dengan respons cepat.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section id="stats" class="py-5 stats-section position-relative">
    <div class="stats-bg-pattern"></div>
    <div class="container py-4">
        <div class="row g-4">
            <div class="col-6 col-md-3" data-aos="zoom-in">
                <div class="stat-card text-center p-4">
                    <div class="stat-icon mb-3">
                        <i class="bi bi-check-circle-fill text-primary fs-1"></i>
                    </div>
                    <h3 class="fw-bold text-primary display-4 counter" data-target="50">0</h3>
                    <p class="text-muted mb-0 fw-semibold">Proyek Selesai</p>
                </div>
            </div>
            <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="100">
                <div class="stat-card text-center p-4">
                    <div class="stat-icon mb-3">
                        <i class="bi bi-gear-fill text-success fs-1"></i>
                    </div>
                    <h3 class="fw-bold text-success display-4 counter" data-target="25">0</h3>
                    <p class="text-muted mb-0 fw-semibold">Proyek Berjalan</p>
                </div>
            </div>
            <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="200">
                <div class="stat-card text-center p-4">
                    <div class="stat-icon mb-3">
                        <i class="bi bi-people-fill text-info fs-1"></i>
                    </div>
                    <h3 class="fw-bold text-info display-4 counter" data-target="100">0</h3>
                    <p class="text-muted mb-0 fw-semibold">Klien Puas</p>
                </div>
            </div>
            <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="300">
                <div class="stat-card text-center p-4">
                    <div class="stat-icon mb-3">
                        <i class="bi bi-trophy-fill text-warning fs-1"></i>
                    </div>
                    <h3 class="fw-bold text-warning display-4 counter" data-target="5">0</h3>
                    <p class="text-muted mb-0 fw-semibold">Tahun Pengalaman</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Projects Showcase -->
<section class="py-5">
    <div class="container py-4">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="text-primary fw-bold text-uppercase letter-spacing">Portfolio</span>
            <h2 class="display-5 fw-bold mt-2 mb-3">Proyek Unggulan Kami</h2>
            <p class="text-muted fs-5 mx-auto" style="max-width: 600px;">
                Lihat hasil karya terbaik kami yang telah dipercaya oleh berbagai klien
            </p>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="project-card-modern rounded-4 overflow-hidden shadow-hover">
                    <div class="project-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?auto=format&fit=crop&w=1074&q=80"
                             class="project-img w-100" alt="Proyek Perumahan">
                        <div class="project-overlay">
                            <span class="badge bg-primary mb-2">Residensial</span>
                        </div>
                    </div>
                    <div class="p-4">
                        <h5 class="fw-bold mb-2">Perumahan Modern Elite</h5>
                        <p class="text-muted mb-3">Kompleks perumahan mewah dengan 50+ unit dan fasilitas lengkap.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-primary fw-semibold"><i class="bi bi-geo-alt-fill me-1"></i> Jakarta</span>
                            <a href="#" class="btn btn-sm btn-outline-primary rounded-pill">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="project-card-modern rounded-4 overflow-hidden shadow-hover">
                    <div class="project-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1170&q=80"
                             class="project-img w-100" alt="Proyek Komersial">
                        <div class="project-overlay">
                            <span class="badge bg-success mb-2">Komersial</span>
                        </div>
                    </div>
                    <div class="p-4">
                        <h5 class="fw-bold mb-2">Gedung Perkantoran Smart</h5>
                        <p class="text-muted mb-3">Gedung perkantoran 15 lantai dengan teknologi smart building.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-success fw-semibold"><i class="bi bi-geo-alt-fill me-1"></i> Surabaya</span>
                            <a href="#" class="btn btn-sm btn-outline-success rounded-pill">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                <div class="project-card-modern rounded-4 overflow-hidden shadow-hover">
                    <div class="project-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=1170&q=80"
                             class="project-img w-100" alt="Proyek Infrastruktur">
                        <div class="project-overlay">
                            <span class="badge bg-info mb-2">Infrastruktur</span>
                        </div>
                    </div>
                    <div class="p-4">
                        <h5 class="fw-bold mb-2">Jembatan Layang Modern</h5>
                        <p class="text-muted mb-3">Infrastruktur jembatan layang untuk kemudahan akses kota.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-info fw-semibold"><i class="bi bi-geo-alt-fill me-1"></i> Bandung</span>
                            <a href="#" class="btn btn-sm btn-outline-info rounded-pill">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</section>

<!-- Testimonials -->
<section class="py-5 bg-light">
    <div class="container py-4">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="text-primary fw-bold text-uppercase letter-spacing">Testimoni</span>
            <h2 class="display-5 fw-bold mt-2 mb-3">Kata Mereka Tentang Kami</h2>
            <p class="text-muted fs-5 mx-auto" style="max-width: 600px;">
                Kepuasan klien adalah prioritas utama kami
            </p>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="testimonial-card h-100 p-4 rounded-4 bg-white shadow-hover">
                    <div class="rating mb-3">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                    <p class="text-muted fst-italic mb-4">
                        "Pelayanan sangat profesional dan hasilnya melebihi ekspektasi. Proyek selesai tepat waktu dengan kualitas terbaik. Sangat puas!"
                    </p>
                    <div class="d-flex align-items-center">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=687&q=80"
                             alt="Ahmad Rizki" class="rounded-circle me-3" style="width: 50px; height: 50px; object-fit: cover;">
                        <div>
                            <h6 class="mb-0 fw-bold">Ahmad Rizki</h6>
                            <small class="text-muted">CEO, Tech Startup</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="testimonial-card h-100 p-4 rounded-4 bg-white shadow-hover">
                    <div class="rating mb-3">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                    <p class="text-muted fst-italic mb-4">
                        "Tim yang sangat responsif dan komunikatif. Mereka selalu memberikan update progress dan solusi terbaik untuk setiap kendala."
                    </p>
                    <div class="d-flex align-items-center">
                        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=687&q=80"
                             alt="Siti Nurhaliza" class="rounded-circle me-3" style="width: 50px; height: 50px; object-fit: cover;">
                        <div>
                            <h6 class="mb-0 fw-bold">Siti Nurhaliza</h6>
                            <small class="text-muted">Direktur, Property Corp</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                <div class="testimonial-card h-100 p-4 rounded-4 bg-white shadow-hover">
                    <div class="rating mb-3">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                    <p class="text-muted fst-italic mb-4">
                        "Kualitas pekerjaan sangat baik dan detail. Sangat merekomendasikan PembangunanProyek untuk proyek konstruksi Anda. Worth it!"
                    </p>
                    <div class="d-flex align-items-center">
                        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=687&q=80"
                             alt="Budi Santoso" class="rounded-circle me-3" style="width: 50px; height: 50px; object-fit: cover;">
                        <div>
                            <h6 class="mb-0 fw-bold">Budi Santoso</h6>
                            <small class="text-muted">Owner, Resto Chain</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<style>
    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);
        position: relative;
        padding-top: 60px;
        padding-bottom: 100px;
    }

    .min-vh-75 {
        min-height: 75vh;
    }

    .hero-bg-pattern {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image:
            radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
        pointer-events: none;
    }

    .text-gradient {
        background: linear-gradient(135deg, #fff 0%, #e0f7ff 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-title {
        line-height: 1.2;
        text-shadow: 0 2px 10px rgba(0,0,0,0.2);
    }

    .hero-image {
        border: 5px solid rgba(255, 255, 255, 0.2);
        transition: transform 0.5s ease;
    }

    .hero-image:hover {
        transform: scale(1.02);
    }

    .floating-card {
        position: absolute;
        bottom: 20px;
        left: 20px;
        background: white;
        padding: 15px 20px;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }

    .icon-box {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
    }

    .hero-wave {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        overflow: hidden;
        line-height: 0;
    }

    .hero-wave svg {
        position: relative;
        display: block;
        width: calc(100% + 1.3px);
        height: 120px;
    }

    /* Buttons */
    .hover-lift {
        transition: all 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    /* Feature Cards */
    .feature-card {
        transition: all 0.3s ease;
        background: #fff;
    }

    .feature-icon-modern {
        width: 70px;
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 20px;
        transition: transform 0.3s ease;
    }

    .feature-card:hover .feature-icon-modern {
        transform: scale(1.1) rotate(5deg);
    }

    .bg-primary-soft { background-color: rgba(13, 110, 253, 0.1); }
    .bg-success-soft { background-color: rgba(25, 135, 84, 0.1); }
    .bg-info-soft { background-color: rgba(13, 202, 240, 0.1); }
    .bg-warning-soft { background-color: rgba(255, 193, 7, 0.1); }

    .shadow-hover {
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
    }

    .shadow-hover:hover {
        box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        transform: translateY(-5px);
    }

    /* Stats Section */
    .stats-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        position: relative;
    }

    .stats-bg-pattern {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image:
            radial-gradient(circle at 10% 20%, rgba(13, 110, 253, 0.05) 0%, transparent 50%),
            radial-gradient(circle at 90% 80%, rgba(13, 202, 240, 0.05) 0%, transparent 50%);
        pointer-events: none;
    }

    .stat-card {
        background: white;
        border-radius: 20px;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.1);
    }

    .counter {
        font-weight: 800;
    }

    /* Projects */
    .project-card-modern {
        background: white;
        transition: all 0.4s ease;
    }

    .project-image-wrapper {
        position: relative;
        overflow: hidden;
        height: 280px;
    }

    .project-img {
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .project-card-modern:hover .project-img {
        transform: scale(1.15);
    }

    .project-overlay {
        position: absolute;
        top: 20px;
        left: 20px;
        z-index: 10;
    }

    /* Testimonials */
    .testimonial-card {
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .testimonial-card:hover {
        border-color: #0d6efd;
        transform: translateY(-5px);
    }

    .rating i {
        font-size: 1rem;
    }

    /* CTA Section */
    .cta-section {
        background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);
        position: relative;
    }

    .cta-pattern {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image:
            linear-gradient(30deg, transparent 30%, rgba(255,255,255,0.05) 30%, rgba(255,255,255,0.05) 70%, transparent 70%),
            linear-gradient(-30deg, transparent 30%, rgba(255,255,255,0.05) 30%, rgba(255,255,255,0.05) 70%, transparent 70%);
        background-size: 50px 50px;
        pointer-events: none;
    }

    /* Utilities */
    .letter-spacing {
        letter-spacing: 2px;
    }

    .shadow-xl {
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }

        .display-4 {
            font-size: 2rem;
        }

        .display-5 {
            font-size: 2rem;
        }

        .hero-section {
            padding-bottom: 80px;
        }

        .floating-card {
            bottom: 10px;
            left: 10px;
            padding: 10px 15px;
        }

        .icon-box {
            width: 40px;
            height: 40px;
        }

        .feature-icon-modern {
            width: 60px;
            height: 60px;
        }

        .project-image-wrapper {
            height: 220px;
        }
    }

    @media (max-width: 576px) {
        .hero-title {
            font-size: 2rem;
        }

        .lead {
            font-size: 1rem;
        }

        .stat-card {
            padding: 1rem !important;
        }

        .counter {
            font-size: 2rem !important;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize AOS
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true,
                offset: 100
            });
        }

        // Counter Animation
        const counters = document.querySelectorAll('.counter');
        const speed = 200;

        const animateCounter = (counter) => {
            const target = +counter.getAttribute('data-target');
            const increment = target / speed;
            let count = 0;

            const updateCount = () => {
                count += increment;
                if (count < target) {
                    counter.innerText = Math.ceil(count) + '+';
                    setTimeout(updateCount, 10);
                } else {
                    counter.innerText = target + '+';
                }
            };

            updateCount();
        };

        // Intersection Observer for counter animation
        const observerOptions = {
            threshold: 0.5
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !entry.target.classList.contains('counted')) {
                    animateCounter(entry.target);
                    entry.target.classList.add('counted');
                }
            });
        }, observerOptions);

        counters.forEach(counter => {
            observer.observe(counter);
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href !== '#' && href !== '#!') {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }
            });
        });

        // Add scroll reveal effect
        const revealElements = document.querySelectorAll('[data-aos]');

        const revealOnScroll = () => {
            revealElements.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;

                if (elementTop < windowHeight - 100) {
                    element.classList.add('aos-animate');
                }
            });
        };

        window.addEventListener('scroll', revealOnScroll);
        revealOnScroll(); // Initial check
    });
</script>
@endsection
