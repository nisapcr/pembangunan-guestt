<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PembangunanProyek</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f4f8;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 10px;
            background-image: url('https://images.unsplash.com/photo-1541888946743-b9cb5319597f?fit=crop&w=1400&q=80');
            background-size: cover;
            background-position: center;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .login-container {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            width: 100%;
            max-width: 380px;
            z-index: 2;
            padding: 0;
            animation: fadeIn 0.6s ease-in-out;
        }

        .login-header {
            background: #007bff;
            color: white;
            text-align: center;
            padding: 25px 15px 15px 15px;
            border-bottom: 4px solid #0056b3;
            position: relative;
            overflow: hidden;
        }

        .logo-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
        }

        .logo-svg {
            width: 55px;
            height: 55px;
            filter: drop-shadow(0 3px 6px rgba(0, 0, 0, 0.2));
        }

        .login-header h1 {
            font-size: 1.6rem;
            font-weight: 700;
            margin: 8px 0 0;
            position: relative;
            z-index: 1;
        }

        .login-header p {
            font-size: 0.85rem;
            opacity: 0.9;
            margin-top: 3px;
            position: relative;
            z-index: 1;
        }

        .login-body {
            padding: 25px;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 1px solid #ced4da;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.15);
            outline: none;
        }

        .form-label {
            font-weight: 600;
            color: #343a40;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        .input-group-text {
            background-color: #e9ecef;
            border-right: none;
            border-radius: 10px 0 0 10px;
            padding: 0.65rem 0.9rem;
            font-size: 0.9rem;
        }

        .form-control-with-icon {
            border-left: none;
            border-radius: 0 10px 10px 0;
        }

        .btn-login {
            background: linear-gradient(45deg, #007bff 0%, #0056b3 100%);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            font-size: 1rem;
            color: white;
            width: 100%;
            transition: all 0.2s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .alert {
            border-radius: 10px;
            border-left: 4px solid;
            padding: 10px 15px;
            font-size: 0.85rem;
            margin-bottom: 15px;
        }

        .alert-danger { border-left-color: #dc3545; }
        .alert-success { border-left-color: #28a745; }

        .login-footer {
            text-align: center;
            padding: 15px 25px;
            background: #f8f9fa;
            border-top: 1px solid #e9ecef;
            border-radius: 0 0 16px 16px;
        }

        .login-footer a {
            color: #007bff;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }

        .login-footer p {
            margin: 5px 0;
            font-size: 0.8rem;
        }

        .password-toggle {
            background-color: #e9ecef;
            border: none;
            border-radius: 0 10px 10px 0;
            cursor: pointer;
            padding: 0.65rem 0.9rem;
            font-size: 0.9rem;
        }

        .password-toggle:hover {
            background-color: #dee2e6;
        }

        .form-text {
            font-size: 0.8rem;
        }

        .form-check {
            margin-bottom: 15px;
        }

        .form-check-input {
            margin-top: 0.25rem;
        }

        .form-check-label {
            font-size: 0.9rem;
        }

        .text-center a {
            font-size: 0.85rem;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive untuk mobile sangat kecil */
        @media (max-width: 400px) {
            .login-container {
                max-width: 340px;
            }

            .login-body {
                padding: 20px;
            }

            .login-header {
                padding: 20px 15px 12px 15px;
            }

            .login-header h1 {
                font-size: 1.4rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <div class="logo-container">
                <!-- Logo dengan gambar -->
                <img src="{{ asset('img/logo.png') }}"
                     alt="Logo Pembangunan Proyek"
                     style="width: 55px; height: 55px; border-radius: 50%; border: 2px solid white; box-shadow: 0 3px 6px rgba(0,0,0,0.2); object-fit: cover;">
            </div>

            <h1>PembangunanProyek</h1>
            <p>Sistem Manajemen Proyek Terpadu</p>
        </div>

        <div class="login-body">
            @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-at"></i></span>
                        <input type="email"
                               class="form-control form-control-with-icon"
                               id="email"
                               name="email"
                               value="{{ old('email') }}"
                               placeholder="Masukkan email Anda"
                               required
                               autofocus>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password"
                               class="form-control"
                               id="password"
                               name="password"
                               placeholder="Masukkan password Anda"
                               required>
                        <button type="button" class="password-toggle" id="togglePassword">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                    <small class="form-text text-muted mt-1 d-block">
                        Password minimal 3 karakter
                    </small>
                </div>

                <!-- Remember Me Checkbox -->
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Ingat saya</label>
                </div>

                <button type="submit" class="btn btn-login mb-3">
                    <i class="fas fa-sign-in-alt me-2"></i>MASUK
                </button>

                <div class="text-center">
                    <a href="#" class="text-muted small">Lupa Password?</a>
                </div>
            </form>
        </div>

        <div class="login-footer">
            <p class="mb-1">
                Belum punya akun? <a href="{{ route('register') }}">Daftar Sekarang</a>
            </p>
            <p class="mt-2 small text-muted">
                &copy; {{ date('Y') }} PembangunanProyek. Hak Cipta Dilindungi.
            </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle Password Visibility
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (togglePassword) {
                togglePassword.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    toggleIcon.classList.toggle('fa-eye');
                    toggleIcon.classList.toggle('fa-eye-slash');
                });
            }

            // Auto focus pada email field
            const emailInput = document.getElementById('email');
            if (emailInput) {
                emailInput.focus();
            }

            // Alert otomatis hilang setelah 5 detik
            setTimeout(() => {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                });
            }, 5000);
        });
    </script>
</body>
</html>
