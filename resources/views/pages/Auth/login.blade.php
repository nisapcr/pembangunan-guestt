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
            padding: 20px;
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
            background: rgba(0, 0, 0, 0.55);
            z-index: 1;
        }

        .login-container {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            width: 100%;
            max-width: 420px;
            z-index: 2;
            padding: 0;
            animation: fadeIn 0.8s ease-in-out;
        }

        .login-header {
            background: #007bff;
            color: white;
            text-align: center;
            padding: 40px 20px 20px 20px;
            border-bottom: 5px solid #0056b3;
        }

        .login-header h1 {
            font-size: 2rem;
            font-weight: 700;
            margin: 10px 0 0;
        }

        .login-header p {
            font-size: 1rem;
            opacity: 0.9;
            margin-top: 5px;
        }

        .login-body {
            padding: 35px;
        }

        .form-control {
            border-radius: 12px;
            padding: 14px 18px;
            border: 1px solid #ced4da;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
            outline: none;
        }

        .form-label {
            font-weight: 600;
            color: #343a40;
            margin-bottom: 10px;
        }

        .input-group-text {
            background-color: #e9ecef;
            border-right: none;
            border-radius: 12px 0 0 12px;
            padding: 0.75rem 1rem;
        }

        .form-control-with-icon {
            border-left: none;
            border-radius: 0 12px 12px 0;
        }

        .btn-login {
            background: linear-gradient(45deg, #007bff 0%, #0056b3 100%);
            border: none;
            border-radius: 12px;
            padding: 15px;
            font-weight: 700;
            font-size: 1.1rem;
            color: white;
            width: 100%;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 123, 255, 0.5);
            filter: brightness(1.1);
        }

        .alert {
            border-radius: 12px;
            border-left: 5px solid;
        }

        .alert-danger { border-left-color: #dc3545; }
        .alert-success { border-left-color: #28a745; }

        .login-footer {
            text-align: center;
            padding: 20px 35px;
            background: #f8f9fa;
            border-top: 1px solid #e9ecef;
            border-radius: 0 0 20px 20px;
        }

        .login-footer a {
            color: #007bff;
            text-decoration: none;
            font-weight: 600;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Toggle Password */
        .password-toggle {
            background-color: #e9ecef;
            border: none;
            border-radius: 0 12px 12px 0;
            cursor: pointer;
            padding: 0.75rem 1rem;
        }

        .password-toggle:hover {
            background-color: #dee2e6;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <i class="fas fa-hard-hat fa-3x mb-2"></i>
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

                <div class="mb-4">
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
                    <!-- HAPUS PESAN SYARAT HURUF KAPITAL -->
                    <small class="form-text text-muted mt-2 d-block">
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
            <p class="mb-0">
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

            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                toggleIcon.classList.toggle('fa-eye');
                toggleIcon.classList.toggle('fa-eye-slash');
            });

            // Validasi Form
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;

                // Cek kosong
                if (!email || !password) {
                    e.preventDefault();
                    alert('Email dan password wajib diisi');
                    return;
                }

                // Validasi Password (Hanya minimal 3 karakter)
                if (password.length < 3) {
                    e.preventDefault();
                    alert('Password harus minimal 3 karakter');
                    return;
                }

                // HAPUS VALIDASI HURUF KAPITAL
                // if (!/[A-Z]/.test(password)) {
                //     e.preventDefault();
                //     alert('Password harus mengandung huruf kapital');
                //     return;
                // }
            });

            // Auto focus pada email field
            document.getElementById('email').focus();

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
