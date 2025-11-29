<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Siswa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #CAF0F8;
            min-height: 100vh;
            position: relative;
            overflow: hidden;
        }

        /* Background sisi kanan */
        .right-img {
            position: absolute;
            top: 0;
            right: 0;
            width: 48%;
            height: 100%;
            object-fit: cover;
        }

        .right-overlay {
            position: absolute;
            top: 0;
            right: 0;
            width: 48%;
            height: 100%;
            background: #42A5F5;
            opacity: 0.32;
        }

        /* Kotak input */
        .input-wrapper {
            background: #fff;
            border-radius: 14px;
            padding: 18px 22px;
            display: flex;
            align-items: center;
            box-shadow: 0px 3px 12px rgba(0,0,0,0.08);
            transition: 0.25s;
        }

        .input-wrapper:hover {
            transform: translateY(-2px);
            box-shadow: 0px 6px 18px rgba(0,0,0,0.12);
        }

        .input-wrapper img {
            width: 52px;
            opacity: 0.5;
            margin-right: 16px;
        }

        .input-wrapper input {
            font-size: 22px;
            padding: 4px 0;
        }

        /* Tombol */
        .btn-login {
            background: #00B4D8;
            border-radius: 50px;
            height: 70px;
            font-size: 28px;
            font-weight: 600;
            width: 240px;
            border: none;
            color: white;
            transition: 0.25s;
        }

        .btn-login:hover {
            background: #0095b3;
            transform: translateY(-3px);
        }

        /* Responsif */
        @media (max-width: 992px) {
            .right-img,
            .right-overlay {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .input-wrapper {
                padding: 16px;
            }
            .input-wrapper img {
                width: 45px;
            }
            .input-wrapper input {
                font-size: 20px;
            }
            .btn-login {
                height: 60px;
                font-size: 24px;
                width: 200px;
            }
        }
    </style>
</head>
<body>

    <!-- Background Kanan -->
    <img src="https://placehold.co/641x1048" class="right-img d-none d-lg-block">
    <div class="right-overlay d-none d-lg-block"></div>

    <div class="container h-100">
        <div class="row h-100 align-items-center">

            <div class="col-lg-5 col-md-12">

                <h1 class="fw-bold mb-3" style="color:#00B4D8; font-size:46px;">
                    Login Siswa
                </h1>

                <p class="mb-4" style="font-size:24px; opacity:0.7;">
                    Masukkan NISN dan Password
                </p>

                <!-- FORM LOGIN -->
                <form action="{{ route('auth.siswa') }}" method="POST">
                    @csrf

                    <!-- Input NISN -->
                    <div class="input-wrapper mb-4">
                        <img src="https://placehold.co/61x61">
                        <input type="text" name="nis" class="form-control border-0 shadow-none" placeholder="Masukkan NISN">
                    </div>

                    <!-- Input Password -->
                    <div class="input-wrapper mb-5">
                        <img src="https://placehold.co/61x61">
                        <input type="password" name="password" class="form-control border-0 shadow-none" placeholder="Masukkan Password">
                    </div>

                    <!-- Tombol -->
                    <button class="btn-login d-block mx-auto">Login</button>

                </form>
            </div>

        </div>
    </div>

</body>
</html>
