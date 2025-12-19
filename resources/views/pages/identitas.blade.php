@extends('layouts.guest.app')
@section('title', 'Identitas Pengembang')

@section('content')
    <section class="developer-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">

                    <div class="developer-card text-center p-5">
                        <!-- Foto -->
                        <div class="developer-avatar mb-3">
                            <img src="{{ asset('img/foto-nisa.png') }}" alt="Siti Harnisa">
                        </div>

                        <!-- Nama -->
                        <h3 class="fw-bold mb-1 text-primary">Siti Harnisa Nurhabiby</h3>
                        <p class="text-muted mb-4">Mahasiswi / Web Developer</p>

                        <!-- Tentang Saya -->
                        <div class="about-box mb-4">
                            <h5 class="fw-bold mb-3">
                                <i class="bi bi-person-circle me-2"></i>Tentang Saya
                            </h5>

                            <p>
                                Saya adalah <strong>Siti Harnisa Nurhabiby</strong>, mahasiswi Program Studi
                                <strong>Sistem Informasi</strong> di <strong>Politeknik Caltex Riau</strong>.
                                Website <strong>Pembangunan proyek</strong> ini dikembangkan sebagai
                                <strong>Project perkuliahan</strong> yang bertujuan untuk mengimplementasikan
                                pengetahuan dan keterampilan di bidang <em>pengembangan web</em>.
                            </p>

                            <p class="mb-0">
                                Dalam proyek ini, saya berperan sebagai <strong>Web Developer</strong>
                                yang bertanggung jawab dalam perancangan, pengembangan, serta implementasi
                                sistem agar informasi desa dapat diakses secara informatif dan terstruktur.
                            </p>
                        </div>

                        <!-- Identitas -->
                        <div class="row text-start mb-4">
                            <div class="col-md-6 mb-2">
                                <i class="bi bi-card-text text-primary me-2"></i>
                                <strong>NIM:</strong> 2457301133
                            </div>
                            <div class="col-md-6 mb-2">
                                <i class="bi bi-envelope text-primary me-2"></i>
                                <strong>Email:</strong> harnisa24si@mahasiswa.pcr.ac.id
                            </div>
                            <div class="col-md-6 mb-2">
                                <i class="bi bi-mortarboard text-primary me-2"></i>
                                <strong>Prodi:</strong> Sistem Informasi
                            </div>
                            <div class="col-md-6 mb-2">
                                <i class="bi bi-building text-primary me-2"></i>
                                <strong>Institusi:</strong> Politeknik Caltex Riau
                            </div>
                        </div>

                        <!-- Sosial Media -->
                        <div class="social-icons d-flex justify-content-center gap-3 mt-3">
                            <a href="www.linkedin.com/in/siti-harnisa-nurhabiby/" target="_blank" class="social-circle">
                                <i class="bi bi-linkedin"></i>
                            </a>
                            <a href="https://github.com/nisapcr" target="_blank" class="social-circle">
                                <i class="bi bi-github"></i>
                            </a>
                            <a href="https://www.instagram.com/siti.harnisanr" target="_blank" class="social-circle">
                                <i class="bi bi-instagram"></i>
                            </a>
                            <a href="mailto:harnisa24si@mahasiswa.pcr.ac.id" class="social-circle">
                                <i class="bi bi-envelope-fill"></i>
                            </a>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
@push('styles')
    <style>
        .developer-section {
            background-color: #f8fafc;
        }

        .developer-card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .developer-avatar img {
            width: 140px;
            height: 140px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #2563eb;
        }

        .about-box {
            background-color: #eff6ff;
            padding: 20px;
            border-radius: 12px;
            border-left: 4px solid #2563eb;
        }

        .social-circle {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background-color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            transition: 0.3s;
            text-decoration: none;
        }

        .social-circle:hover {
            background-color: #1e40af;
            transform: translateY(-3px);
            color: white;
        }
    </style>
@endpush
