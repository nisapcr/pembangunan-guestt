<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PembangunanProyek</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0d6efd 0%, #4dabf7 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
        }

        .login-container {
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            overflow: hidden;
            width: 100%;
            max-width: 400px;
        }

        .login-header {
            background: linear-gradient(135deg, #0d6efd 0%, #4dabf7 100%);
            color: white;
            text-align: center;
            padding: 30px 20px;
        }

        .login-header h1 {
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0;
        }

        .login-header p {
            font-size: 0.9rem;
            opacity: 0.9;
            margin: 5px 0 0 0;
        }

        .login-body {
            padding: 30px;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        .btn-login {
            background: linear-gradient(135deg, #0d6efd 0%, #4dabf7 100%);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            color: white;
            width: 100%;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.4);
        }

        .form-label {
            font-weight: 500;
            color: #495057;
            margin-bottom: 8px;
        }

        .alert {
            border-radius: 10px;
            border: none;
        }

        .login-footer {
            text-align: center;
            padding: 20px;
            background: #f8f9fa;
            border-top: 1px solid #e9ecef;
        }

        .login-footer a {
            color: #0d6efd;
            text-decoration: none;
            font-weight: 500;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }

        .fade-in {
            animation: fadeIn 0.6s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="login-container fade-in">
        <div class="login-header">
            <i class="fas fa-building fa-2x mb-3"></i>
            <h1>PembangunanProyek</h1>
            <p>Masuk ke akun Anda</p>
        </div>

        <div class="login-body">
            <?php if(session('error')): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>

            <?php if(session('success')): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('login.post')); ?>">
                <?php echo csrf_field(); ?>
                
                <div class="mb-3">
                    <label for="email" class="form-label">
                        <i class="fas fa-user me-2"></i>Email
                    </label>
                    <input type="text" 
                           class="form-control" 
                           id="email" 
                           name="email" 
                           value="<?php echo e(old('email')); ?>" 
                           placeholder="Masukkan email anda"
                           required
                           autofocus>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">
                        <i class="fas fa-lock me-2"></i>Password
                    </label>
                    <input type="password" 
                           class="form-control" 
                           id="password" 
                           name="password" 
                           placeholder="Masukkan password anda"
                           required>
                    <small class="form-text text-muted">
                        Password harus minimal 3 karakter dan mengandung huruf kapital
                    </small>
                </div>

                <button type="submit" class="btn btn-login mb-3">
                    <i class="fas fa-sign-in-alt me-2"></i>Masuk
                </button>
            </form>
        </div>

        <div class="login-footer">
            <p class="mb-0">
                Belum punya akun? <a href="<?php echo e(route('register')); ?>">Daftar di sini</a>
            </p>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;
                
                if (!email || !password) {
                    e.preventDefault();
                    alert('Email dan password wajib diisi');
                    return;
                }

                if (password.length < 3) {
                    e.preventDefault();
                    alert('Password harus minimal 3 karakter');
                    return;
                }

                if (!/[A-Z]/.test(password)) {
                    e.preventDefault();
                    alert('Password harus mengandung huruf kapital');
                    return;
                }
            });
        });
    </script>
</body>
</html><?php /**PATH D:\Nisa-2SIC\laragon-6.0-minimal\www\PembangunanGuest\resources\views/pages/login.blade.php ENDPATH**/ ?>