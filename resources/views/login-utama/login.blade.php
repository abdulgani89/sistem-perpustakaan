
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem Akademik</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #CAF0F8;
        }

        .login-card {
            background: #ffffff;
            padding: 1.5rem;
            border-radius: 12px;
            transition: 0.25s;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
            display: flex;
            align-items: center;
            gap: 1rem;
            text-decoration: none;
            color: inherit;
            margin-bottom: 1rem;
        }

        .login-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(0,0,0,0.12);
        }

        .login-card img {
            width: 50px;
            height: 50px;
            opacity: 0.6;
        }

        .login-text {
            font-size: 1.8rem;
            opacity: 0.75;
        }

        .login-title {
            color: #00B4D8;
            font-weight: bold;
        }

        .login-subtitle {
            font-size: 1.5rem;
            opacity: 0.7;
        }

        /* Gambar kanan full */
        .image-side {
            position: relative;
        }

        .image-side img {
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 100vh;
            object-fit: cover;
        }

        /* Container kiri */
        .left-container {
            z-index: 2;
            position: relative;
        }

        @media (max-width: 992px) {
            .login-text { font-size: 1.5rem; }
            .login-subtitle { font-size: 1.2rem; }
            .image-side img {
                position: relative;
                width: 100%;
                height: auto;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Kiri: Login Card -->
            <div class="col-12 col-lg-5 left-container p-5">
                <h1 class="login-title mb-3" style="font-size:48px;">Halaman Login</h1>
                
                <p class="login-subtitle mb-4">Login sebagai:</p>

                <a href="{{ route('auth.siswa') }}" class="login-card">
                    <img src="{{ asset('images/login/student.png') }}" alt="Siswa">
                    <span class="login-text">Siswa</span>
                </a>

                <a href="{{ route('login.kepala') }}" class="login-card">
                    <img src="{{ asset('images/login/head-teacher.png') }}" alt="Kepala Perpustakaan">
                    <span class="login-text">Kepala Perpustakaan</span>
                </a>

                <a href="{{ route('login.admin') }}" class="login-card">
                    <img src="{{ asset('images/login/administrator.png') }}" alt="Admin">
                    <span class="login-text">Admin</span>
                </a>
            </div>

            <!-- Kanan: Gambar Full -->
            <div class="col-12 col-lg-7 image-side d-none d-lg-block">
                <img src="https://plus.unsplash.com/premium_photo-1677567996070-68fa4181775a?q=80&w=2072&auto=format&fit=crop" alt="Background">
            </div>
        </div>
    </div>
</body>
</html>
