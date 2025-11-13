<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<!-- Sweet Alert -->
<link type="text/css" href="{{ asset('assets-admin/vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">

<!-- Notyf -->
<link type="text/css" href="{{ asset('assets-admin/vendor/notyf/notyf.min.css') }}" rel="stylesheet">

<!-- Volt CSS -->
<link type="text/css" href="{{ asset('assets-admin/css/volt.css') }}" rel="stylesheet">

<!-- NOTICE: You can use the _analytics.html partial to include production code specific code & trackers -->
<!-- End CSS -->

<style>
    /* ======== Global Styles ======== */
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f5f7fa;
        color: #333;
        scroll-behavior: smooth;
        margin: 0;
        padding: 0;
    }

    h1,
    h2,
    h3,
    h4,
    h5 {
        font-weight: 600;
    }

    a {
        text-decoration: none;
        transition: all 0.3s ease;
    }

    /* ======== Navbar ======== */
    .main-navbar {
        background: #ffffff !important;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        padding: 10px 0;
        margin: 0;
    }

    .navbar-brand h1 {
        font-size: 1.6rem;
        font-weight: 700;
        color: #0d6efd;
        margin: 0;
    }

    .main-navbar .nav-link {
        color: #333 !important;
        font-weight: 500;
        font-size: 0.9rem;
        margin: 0 6px;
        border-bottom: 2px solid transparent;
        transition: all 0.25s ease;
        padding-bottom: 4px;
    }

    .main-navbar .nav-link:hover {
        color: #0d6efd !important;
        border-bottom: 2px solid #adb5bd;
    }

    .main-navbar .nav-link.active {
        color: #0d6efd !important;
        border-bottom: 2px solid #0d6efd;
        font-weight: 600;
    }

    /* ======== Dropdown Menu ======== */
    .dropdown-menu {
        border: none;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        padding: 8px 0;
        font-size: 0.85rem;
    }

    .dropdown-item {
        padding: 6px 16px;
        color: #333;
        transition: all 0.3s ease;
        font-size: 0.85rem;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa;
        color: #0d6efd;
    }

    .dropdown-item i {
        width: 16px;
        margin-right: 8px;
        color: #6c757d;
        font-size: 0.8rem;
    }

    /* ======== Hero Section ======== */
    .hero {
        background: linear-gradient(135deg, #0d6efd 0%, #4dabf7 100%);
        color: #fff;
        text-align: center;
        padding: 80px 20px 90px;
        border-radius: 0 0 30px 30px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        margin-top: 0;
    }

    .hero h1 {
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .hero p {
        font-size: 1rem;
        opacity: 0.9;
    }

    /* ======== Main Content ======== */
    .main-content {
        min-height: 70vh;
        padding: 35px 0;
    }

    /* ======== About Page Styles ======== */
    .about-section {
        padding: 60px 0;
    }

    .feature-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease;
        height: 100%;
        border-left: 4px solid #0d6efd;
    }

    .feature-card:hover {
        transform: translateY(-5px);
    }

    .feature-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #0d6efd 0%, #4dabf7 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }

    .feature-icon i {
        font-size: 30px;
        color: white;
    }

    .process-step {
        text-align: center;
        padding: 30px 20px;
        position: relative;
    }

    .step-number {
        width: 50px;
        height: 50px;
        background: #0d6efd;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        margin: 0 auto 20px;
        font-size: 1.2rem;
    }

    .module-image {
        width: 100%;
        height: 200px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        color: white;
        font-size: 3rem;
    }

    .team-card {
        text-align: center;
        padding: 30px 20px;
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease;
    }

    .team-card:hover {
        transform: translateY(-5px);
    }

    .team-avatar {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #0d6efd 0%, #4dabf7 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        color: white;
        font-size: 2.5rem;
    }

    /* ======== Footer ======== */
    footer {
        background: #ffffff;
        box-shadow: 0 -3px 10px rgba(0, 0, 0, 0.05);
        padding: 20px 0;
        text-align: center;
        color: #6c757d;
        font-size: 0.85rem;
        margin-top: 0;
    }

    footer a {
        color: #0d6efd;
        font-weight: 500;
        font-size: 0.85rem;
    }

    footer a:hover {
        text-decoration: underline;
    }

    /* ======== Floating WhatsApp Button ======== */
    .floating-wa {
        position: fixed;
        bottom: 25px;
        right: 25px;
        z-index: 1000;
    }

    .wa-float {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 60px;
        height: 60px;
        background: #25D366;
        border-radius: 50%;
        box-shadow: 0 4px 12px rgba(37, 211, 102, 0.3);
        transition: all 0.3s ease;
        text-decoration: none;
        animation: pulse-wa 2s infinite;
    }

    .wa-float:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 16px rgba(37, 211, 102, 0.4);
        animation: none;
        /* Stop pulse on hover */
    }

    .wa-float i {
        font-size: 32px;
        color: white;
    }

    /* Pulse animation untuk WhatsApp */
    @keyframes pulse-wa {
        0% {
            box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7);
        }

        70% {
            box-shadow: 0 0 0 10px rgba(37, 211, 102, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(37, 211, 102, 0);
        }
    }

    /* ======== Animation ======== */
    .fade-in {
        animation: fadeIn 0.8s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(15px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ======== Fix Layout Issues ======== */
    .content {
        margin: 0;
        padding: 0;
    }

    .py-4 {
        padding-top: 0 !important;
        padding-bottom: 0 !important;
    }

    /* ======== Mobile Responsive ======== */
    @media (max-width: 1199.98px) {
        .main-navbar .nav-link {
            font-size: 0.85rem;
            margin: 0 4px;
        }

        .navbar-brand h1 {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 991.98px) {
        .navbar-nav {
            padding: 8px 0;
        }

        .nav-link {
            margin: 4px 0 !important;
            padding: 8px 12px !important;
            font-size: 0.9rem;
        }

        .dropdown-menu {
            border: none;
            box-shadow: none;
            background-color: transparent;
        }

        .dropdown-item {
            padding-left: 35px;
            font-size: 0.9rem;
        }
    }

    @media (max-width: 767.98px) {
        .navbar-brand h1 {
            font-size: 1.4rem;
        }

        .hero h1 {
            font-size: 1.8rem;
        }

        .hero p {
            font-size: 0.9rem;
        }

        .floating-wa {
            bottom: 20px;
            right: 20px;
        }

        .wa-float {
            width: 55px;
            height: 55px;
        }

        .wa-float i {
            font-size: 28px;
        }
    }
</style>
