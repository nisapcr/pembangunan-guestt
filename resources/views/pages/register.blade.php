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
            padding: 20px;
        }
        
        .register-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(50, 50, 93, 0.1), 0 5px 15px rgba(0, 0, 0, 0.07);
            overflow: hidden;
            width: 100%;
            max-width: 520px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .register-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 18px 40px rgba(50, 50, 93, 0.15), 0 8px 20px rgba(0, 0, 0, 0.1);
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            color: white;
            padding: 30px 20px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .card-header::before {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: rgba(255, 255, 255, 0.1);
            transform: rotate(30deg);
        }
        
        .card-body {
            padding: 30px;
        }
        
        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #e3e6f0;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }
        
        .btn-register {
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s;
        }
        
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 14px rgba(50, 50, 93, 0.1), 0 3px 6px rgba(0, 0, 0, 0.08);
        }
        
        .form-label {
            font-weight: 600;
            color: #5a5c69;
            margin-bottom: 8px;
        }
        
        .password-requirements {
            font-size: 0.8rem;
            color: #6c757d;
            margin-top: 5px;
        }
        
        .login-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
        }
        
        .login-link:hover {
            text-decoration: underline;
        }
        
        .error-message {
            color: #e74a3b;
            font-size: 0.875rem;
            margin-top: 5px;
        }
        
        .success-message {
            color: #1cc88a;
            font-size: 0.875rem;
            margin-top: 5px;
        }
        
        .input-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #b7b9cc;
        }
        
        .input-with-icon {
            position: relative;
        }
        
        .logo-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }
        
        .logo {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
        }
        
        .logo i {
            font-size: 24px;
        }
        
        .brand-text {
            font-size: 24px;
            font-weight: 700;
        }
        
        .password-strength {
            height: 5px;
            border-radius: 5px;
            margin-top: 5px;
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
            margin-top: 15px;
        }
        
        .checkbox-container input {
            margin-top: 3px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="register-card">
        <div class="card-header">
            <div class="logo-container">
                <div class="logo">
                    <i class="fas fa-hammer"></i>
                </div>
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

            <div class="text-center mt-4">
                <small>Sudah punya akun? <a href="{{ route('login.index') }}" class="login-link">Masuk di sini</a></small>
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