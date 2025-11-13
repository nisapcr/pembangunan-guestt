<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPRO - Dashboard Pembangunan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #b9e0ff, #8ec5fc);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }

        .dashboard-box {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(15px);
            border-radius: 24px;
            padding: 3rem 2.5rem;
            text-align: center;
            max-width: 480px;
            width: 90%;
            box-shadow: 0 10px 28px rgba(0, 0, 0, 0.15);
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: scale(0.96);}
            to {opacity: 1; transform: scale(1);}
        }

        .emoji {
            font-size: 3.2rem;
            margin-bottom: 1rem;
        }

        h2 {
            font-weight: 700;
            color: #0d47a1;
        }

        p {
            color: #444;
            font-size: 0.95rem;
        }

        .btn-logout {
            background-color: #ef5350;
            color: #fff;
            border: none;
            font-weight: 600;
            transition: all 0.25s ease;
            border-radius: 25px;
            padding: 10px 25px;
            margin-top: 1.5rem;
        }

        .btn-logout:hover {
            background-color: #d32f2f;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(239, 83, 80, 0.3);
        }

        .footer-text {
            margin-top: 1.5rem;
            font-size: 0.85rem;
            color: #777;
        }
    </style>
</head>
<body>

<div class="dashboard-box shadow-lg">
    <div class="emoji">🏗️</div>
    <h2>Login berhasil</h2>
    <p class="mt-3">Selamat datang, <strong>{{ $username }}</strong> 👋</p>
    <p class="mb-4">Kamu telah berhasil login ke sistem.</p>

    <a href="/auth" class="btn btn-logout">Keluar</a>

    <div class="footer-text">
        <small>© 2025 Dinas Pekerjaan Umum &amp; Pembangunan Daerah</small>
    </div>
</div>

</body>
</html>
