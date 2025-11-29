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
            background-color: #CAF0F8;
            min-height: 100vh;
            position: relative;
            overflow: hidden;
        }

        /* Gambar background sisi kanan */
        .bg-desktop {
            position: absolute;
            right: 0;
            top: 0;
            width: 55%;
            height: 100vh;
            object-fit: cover;
        }

        .bg-overlay {
            position: absolute;
            right: 0;
            top: 0;
            width: 55%;
            height: 100vh;
            background: #42A5F5;
            opacity: 0.32;
        }

        /* Card pilihan login */
        .login-card {
            background: #ffffff;
            padding: 20px 28px;
            border-radius: 12px;
            transition: 0.25s;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .login-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(0,0,0,0.12);
        }

        .login-card img {
            width: 58px;
            height: 58px;
            opacity: 0.6;
        }

        .login-text {
            font-size: 32px;
            opacity: 0.75;
        }

        @media (max-width: 768px) {
            .bg-desktop,
            .bg-overlay {
                display: none;
            }

            .login-text {
                font-size: 24px;
            }

            .login-card {
                padding: 18px;
            }
        }
    </style>
</head>

<body>

    <!-- Background hanya tampil di desktop -->
    <img src="https://plus.unsplash.com/premium_photo-1677567996070-68fa4181775a?q=80&w=2072&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="bg-desktop d-none d-lg-block">
    <div class="bg-overlay d-none d-lg-block"></div>


    <div class="container py-5">
        <div class="row justify-content-start">
            <div class="col-12 col-lg-5 mt-5">

                <h1 class="fw-bold mb-3" style="color:#00B4D8; font-size:48px;">Halaman Login</h1>
                <p class="mb-4" style="font-size:28px; opacity:0.7;">Login sebagai:</p>


                <!-- Siswa -->
                <a href="{{ route('auth.siswa') }}" class="text-decoration-none text-dark">
                    <div class="login-card d-flex align-items-center mb-4">
                            <img src="{{ asset('images/login/student.png') }}" class="me-4">
                        <span class="login-text">Siswa</span>
                    </div>
                </a>

                <!-- Kepala Perpustakaan -->
                <a href="{{ route('login.kepala') }}" class="text-decoration-none text-dark">
                    <div class="login-card d-flex align-items-center mb-4">
                        <img src="{{ asset('images/login/head-teacher.png') }}" class="me-4" >
                        <span class="login-text">Kepala Perpustakaan</span>
                    </div>
                </a>

                <!-- Admin -->
                <a href="{{ route('login.admin') }}" class="text-decoration-none text-dark">
                    <div class="login-card d-flex align-items-center mb-4">
                        <img src="{{ asset('images/login/administrator.png') }}" class="me-4">
                        <span class="login-text">Admin</span>
                    </div>
                </a>

            </div>
        </div>
    </div>

</body>
</html>
