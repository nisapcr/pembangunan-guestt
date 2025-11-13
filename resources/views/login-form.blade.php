<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPRO - Login Pembangunan & Monitoring Proyek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }
        .login-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 440px;
            padding: 2.5rem;
            text-align: center;
            animation: fadeIn 0.6s ease-in-out;
        }
        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(20px);}
            to {opacity: 1; transform: translateY(0);}
        }
        .icon-building {
            font-size: 3.5rem;
            color: #007bff;
            margin-bottom: 1rem;
        }
        .login-card h3 {
            font-weight: 700;
            color: #007bff;
        }
        .login-card p {
            font-size: 0.95rem;
            color: #6c757d;
        }
        .btn-login {
            background: linear-gradient(90deg, #007bff, #0056b3);
            border: none;
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(0, 123, 255, 0.35);
        }
        .footer-text {
            margin-top: 1rem;
            font-size: 0.85rem;
            color: #888;
        }
        .divider {
            width: 60px;
            height: 4px;
            background: #007bff;
            border-radius: 2px;
            margin: 0.5rem auto 1.5rem;
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="icon-building">🏗️</div>
    <h3 class="mb-1">SIPRO</h3>
    <div class="divider"></div>
    <p class="mb-4">Sistem Pembangunan & Monitoring Proyek Daerah</p>

    @if(session('error'))
        <div class="alert alert-danger text-start py-2">{{ session('error') }}</div>
    @endif

    <form action="/auth/login" method="POST" class="text-start">
        @csrf
        <div class="mb-3">
            <label for="username" class="form-label fw-semibold">👤 Username</label>
            <input type="text" name="username" id="username" class="form-control form-control-lg" placeholder="Masukkan username Anda">
        </div>

        <div class="mb-4">
            <label for="password" class="form-label fw-semibold">🔑 Password</label>
            <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="Masukkan password">
        </div>

        <button type="submit" class="btn btn-login text-white w-100 py-2 fw-semibold">
            Masuk ke Sistem 🚀
        </button>
    </form>

    <div class="footer-text">
        <small>© 2025 Dinas Pekerjaan Umum &amp; Pembangunan Daerah</small>
    </div>
</div>

</body>
</html>
