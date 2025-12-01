<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Kepala Perpustakaan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #CAF0F8;
            min-height: 100vh;
            position: relative;
            overflow: hidden;
        }

        /* Background kanan mengikuti style halaman login utama */
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

        /* Kotak input mengikuti style input-card */
        .input-card {
            background: #ffffff;
            padding: 20px 28px;
            border-radius: 12px;
            transition: 0.25s;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
        }

        .input-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(0,0,0,0.12);
        }

        .input-card img {
            width: 58px;
            height: 58px;
            opacity: 0.6;
            margin-right: 18px;
        }

        .input-card input {
            font-size: 26px;
            border: none !important;
            box-shadow: none !important;
        }

        /* Tombol login */
        .btn-login {
            background: #00B4D8;
            border-radius: 60px;
            height: 80px;
            font-size: 32px;
            font-weight: 700;
            color: white;
            border: none;
            width: 260px;
            transition: 0.25s;
            margin-top: -10px;
        }

        .btn-login:hover {
            background: #0090aa;
            transform: translateY(-3px);
        }

        @media (max-width: 768px) {
            .bg-desktop,
            .bg-overlay {
                display: none;
            }

            .input-card {
                padding: 18px;
            }

            .input-card img {
                width: 48px;
                height: 48px;
            }

            .input-card input {
                font-size: 22px;
            }

            .btn-login {
                height: 65px;
                width: 220px;
                font-size: 26px;
            }
        }
    </style>
</head>

<body>

    <!-- Background kanan -->
    <img src="https://plus.unsplash.com/premium_photo-1677567996070-68fa4181775a?q=80&w=2072&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="bg-desktop d-none d-lg-block">
    
    <div class="container py-5 pb-5">
        <div class="row justify-content-start ">
            <div class="col-12 col-lg-5  ">

                <h1 class="fw-bold mb-3" style="color:#00B4D8; font-size:48px;">
                    Login Kepala Perpustakaan
                </h1>

                <p class="mb-4" style="font-size:28px; opacity:0.7;">
                    Masukkan Username dan Password
                </p>

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- FORM LOGIN KEPALA -->
                <form action="{{ url('/login/kepala') }}" method="POST">
                    @csrf

                    <!-- Input Username -->
                    <div class="input-card mb-4">
                        <img src="{{ asset('images/login/head-teacher.png') }}">
                        <input type="text" name="username" placeholder="Masukkan Username" required>
                    </div>

                    <!-- Input Password -->
                    <div class="input-card mb-5">
                        <img src="{{ asset('images/login/padlock.png') }}">
                        <input type="password" name="password" placeholder="Masukkan Password" required>
                    </div>

                    <button class="btn-login d-block mx-auto">Login</button>

                </form>

            </div>
        </div>
    </div>

</body>
</html>
