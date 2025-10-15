<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Laundry Atun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', system-ui, -apple-system, Segoe UI, Roboto, 'Helvetica Neue', Arial, 'Noto Sans', 'Liberation Sans', sans-serif;
        }

        .card {
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
            border-color: #0a58ca;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        .login-option {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .login-option:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        .login-option.selected {
            border-color: #0d6efd;
            background-color: #f8f9ff;
        }

        .login-icon {
            font-size: 2rem;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <h1 class="h4 mb-2">Masuk ke Akun Anda</h1>
                            <p class="text-muted">Pilih tipe akun untuk melanjutkan</p>
                        </div>
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Login Type Selection -->

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required autofocus
                                    value="{{ old('email') }}" placeholder="Masukkan email">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required
                                    placeholder="Masukkan password">
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                               
                            </div>
                            <button class="btn btn-primary w-100 mb-3" type="submit">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
                            </button>

                            <div class="text-center">
                                <small class="text-muted">
                                    Belum punya akun?
                                    <a href="{{ route('register') }}" class="text-decoration-none">Daftar di sini</a>
                                </small>
                                 <div class="form-check">
                                    <small class="btn btn- w-100 mb-3" type="submit">
                                        <label class="form-check-label" for="remember">Forgot password</label>
                                    </small>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function selectLoginType(type) {
            // Remove selected class from all options
            document.querySelectorAll('.login-option').forEach(option => {
                option.classList.remove('selected');
            });

            // Add selected class to clicked option
            event.currentTarget.classList.add('selected');

            // Check the corresponding radio button
            document.getElementById('login_' + type).checked = true;
        }

        // Set default selection
        document.addEventListener('DOMContentLoaded', function () {
            // Select user login by default
            selectLoginType('user');
        });
    </script>
</body>

</html>