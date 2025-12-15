<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - PembangunanProyek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #36b9cc;
            --success-color: #1cc88a;
            --gradient-start: #4e73df;
            --gradient-end: #224abe;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
        }

        .register-card {
            background: white;
            border-radius: 14px;
            box-shadow: 0 10px 25px rgba(50, 50, 93, 0.1), 0 3px 10px rgba(0, 0, 0, 0.07);
            overflow: hidden;
            width: 100%;
            max-width: 480px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-header {
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            color: white;
            padding: 25px 15px 15px 15px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .card-body {
            padding: 25px;
        }

        .form-control {
            border-radius: 8px;
            padding: 10px 12px;
            border: 1px solid #e3e6f0;
            font-size: 0.9rem;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.15rem rgba(78, 115, 223, 0.25);
        }

        .btn-register {
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            border: none;
            border-radius: 8px;
            padding: 10px;
            font-weight: 600;
            letter-spacing: 0.3px;
            font-size: 0.95rem;
            transition: all 0.3s;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 12px rgba(50, 50, 93, 0.1), 0 2px 5px rgba(0, 0, 0, 0.08);
        }

        .form-label {
            font-weight: 600;
            color: #5a5c69;
            margin-bottom: 6px;
            font-size: 0.9rem;
        }

        .password-requirements {
            font-size: 0.75rem;
            color: #6c757d;
            margin-top: 4px;
        }

        .login-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .login-link:hover {
            text-decoration: underline;
        }

        .error-message {
            color: #e74a3b;
            font-size: 0.8rem;
            margin-top: 4px;
        }

        .success-message {
            color: #1cc88a;
            font-size: 0.8rem;
            margin-top: 4px;
        }

        .input-icon {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #b7b9cc;
            font-size: 0.9rem;
        }

        .input-with-icon {
            position: relative;
        }

        .logo-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
            position: relative;
            z-index: 1;
        }

        .logo-svg {
            width: 50px;
            height: 50px;
            margin-right: 10px;
            filter: drop-shadow(0 3px 6px rgba(0, 0, 0, 0.2));
        }

        .brand-text {
            font-size: 22px;
            font-weight: 700;
        }

        .password-strength {
            height: 4px;
            border-radius: 4px;
            margin-top: 4px;
            background-color: #e3e6f0;
            overflow: hidden;
        }

        .password-strength-bar {
            height: 100%;
            width: 0;
            transition: width 0.3s;
        }

        .strength-weak {
            background-color: #e74a3b;
        }

        .strength-medium {
            background-color: #f6c23e;
        }

        .strength-strong {
            background-color: #1cc88a;
        }

        .checkbox-container {
            display: flex;
            align-items: flex-start;
            margin-top: 12px;
            font-size: 0.85rem;
        }

        .checkbox-container input {
            margin-top: 2px;
            margin-right: 8px;
        }

        .alert {
            border-radius: 8px;
            margin-bottom: 15px;
            padding: 10px 15px;
            font-size: 0.85rem;
        }

        .alert ul {
            margin-bottom: 0;
            padding-left: 15px;
        }

        .card-header h4 {
            font-size: 1.2rem;
            margin-bottom: 5px;
        }

        .card-header p {
            font-size: 0.85rem;
            opacity: 0.75;
            margin-bottom: 0;
        }

        .text-center small {
            font-size: 0.85rem;
        }

        /* Responsive untuk mobile kecil */
        @media (max-width: 480px) {
            .register-card {
                max-width: 100%;
            }

            .card-body {
                padding: 20px;
            }

            .logo-svg {
                width: 45px;
                height: 45px;
            }

            .brand-text {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="register-card">
        <div class="card-header">
            <div class="logo-container">
                <!-- Logo SVG Horizontal -->
                <svg class="logo-svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                    <!-- Background Circle -->
                    <circle cx="50" cy="50" r="48" fill="rgba(255, 255, 255, 0.2)"/>

                    <!-- Building Base -->
                    <rect x="30" y="48" width="40" height="30" fill="#ffffff" rx="2"/>

                    <!-- Building Windows -->
                    <rect x="35" y="53" width="6" height="6" fill="#4e73df" opacity="0.9"/>
                    <rect x="44" y="53" width="6" height="6" fill="#4e73df" opacity="0.9"/>
                    <rect x="53" y="53" width="6" height="6" fill="#4e73df" opacity="0.9"/>

                    <rect x="35" y="63" width="6" height="6" fill="#4e73df" opacity="0.9"/>
                    <rect x="44" y="63" width="6" height="6" fill="#4e73df" opacity="0.9"/>
                    <rect x="53" y="63" width="6" height="6" fill="#4e73df" opacity="0.9"/>

                    <!-- Door -->
                    <rect x="44" y="70" width="6" height="8" fill="#ffc107"/>

                    <!-- Crane Structure -->
                    <line x1="38" y1="48" x2="38" y2="25" stroke="#ffc107" stroke-width="2.5" stroke-linecap="round"/>
                    <line x1="38" y1="25" x2="60" y2="35" stroke="#ffc107" stroke-width="2.5" stroke-linecap="round"/>

                    <!-- Crane Cable -->
                    <line x1="57" y1="34" x2="57" y2="45" stroke="#ff6b6b" stroke-width="2" stroke-linecap="round" stroke-dasharray="2,2"/>

                    <!-- Crane Hook -->
                    <circle cx="57" cy="47" r="2.5" fill="#ff6b6b"/>

                    <!-- Construction Worker Helmet -->
                    <circle cx="67" cy="28" r="6" fill="#ffc107"/>
                    <ellipse cx="67" cy="26" rx="7" ry="3" fill="#ffed4e"/>

                    <!-- Brick/Construction Element -->
                    <rect x="20" y="70" width="8" height="4" fill="#ff6b6b" opacity="0.8"/>
                    <rect x="20" y="74" width="8" height="4" fill="#ff6b6b" opacity="0.6"/>
                </svg>

                <div class="brand-text">PembangunanProyek</div>
            </div>
            <h4 class="mb-0">Buat Akun Baru</h4>
            <p class="mb-0 mt-2 opacity-75">Bergabung dengan kami untuk memulai proyek Anda</p>
        </div>

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register.post') }}" method="POST" id="registerForm">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <div class="input-with-icon">
                        <input id="name" type="text" name="name" value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="Masukkan nama lengkap Anda" required>
                        <span class="input-icon">
                            <i class="fas fa-user"></i>
                        </span>
                    </div>
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-with-icon">
                        <input id="email" type="email" name="email" value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="Masukkan alamat email Anda" required>
                        <span class="input-icon">
                            <i class="fas fa-envelope"></i>
                        </span>
                    </div>
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <div class="input-with-icon">
                        <input id="password" type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Buat kata sandi yang kuat" required>
                        <span class="input-icon">
                            <i class="fas fa-lock"></i>
                        </span>
                    </div>
                    <div class="password-requirements">
                        <i class="fas fa-info-circle"></i> Kata sandi harus minimal 8 karakter dan mengandung huruf kapital & angka
                    </div>
                    <div class="password-strength">
                        <div class="password-strength-bar" id="passwordStrengthBar"></div>
                    </div>
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                    <div class="input-with-icon">
                        <input id="password_confirmation" type="password" name="password_confirmation"
                            class="form-control" placeholder="Ulangi kata sandi Anda" required>
                        <span class="input-icon">
                            <i class="fas fa-lock"></i>
                        </span>
                    </div>
                </div>

                <div class="checkbox-container">
                    <input type="checkbox" class="form-check-input" id="terms" required>
                    <label class="form-check-label" for="terms">
                        Saya setuju dengan <a href="#" class="login-link">Syarat & Ketentuan</a> dan <a href="#" class="login-link">Kebijakan Privasi</a>
                    </label>
                </div>
                <div class="error-message" id="termsError"></div>

                <button type="submit" class="btn btn-primary btn-register w-100 mt-3">
                    <i class="fas fa-user-plus me-2"></i> Daftar Akun
                </button>
            </form>

            <div class="text-center mt-3">
                <small>Sudah punya akun? <a href="{{ route('login') }}" class="login-link">Masuk di sini</a></small>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const passwordStrengthBar = document.getElementById('passwordStrengthBar');
            const registerForm = document.getElementById('registerForm');
            const termsCheckbox = document.getElementById('terms');
            const termsError = document.getElementById('termsError');

            // Validasi kekuatan password
            passwordInput.addEventListener('input', function() {
                const password = this.value;
                let strength = 0;

                // Kriteria kekuatan password
                if (password.length >= 8) strength += 25;
                if (/[A-Z]/.test(password)) strength += 25;
                if (/[0-9]/.test(password)) strength += 25;
                if (/[^A-Za-z0-9]/.test(password)) strength += 25;

                // Update tampilan kekuatan password
                passwordStrengthBar.style.width = strength + '%';

                if (strength <= 25) {
                    passwordStrengthBar.className = 'password-strength-bar strength-weak';
                } else if (strength <= 75) {
                    passwordStrengthBar.className = 'password-strength-bar strength-medium';
                } else {
                    passwordStrengthBar.className = 'password-strength-bar strength-strong';
                }
            });

            // Validasi form sebelum submit
            registerForm.addEventListener('submit', function(e) {
                let isValid = true;

                // Reset pesan error
                termsError.textContent = '';

                // Validasi syarat & ketentuan
                if (!termsCheckbox.checked) {
                    termsError.textContent = 'Anda harus menyetujui syarat & ketentuan';
                    isValid = false;
                }

                if (!isValid) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>
