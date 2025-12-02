
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Siswa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #CAF0F8;
            min-height: 100vh;
        }

        /* Container kiri */
        .left-container {
            z-index: 2;
            position: relative;
            padding: 5rem 2rem;
        }

        h1 {
            color: #00B4D8;
            font-weight: bold;
            font-size: 48px;
            margin-bottom: 1rem;
        }

        p {
            font-size: 28px;
            opacity: 0.7;
            margin-bottom: 2rem;
        }

        /* Kotak input */
        .input-card {
            background: #ffffff;
            padding: 20px 28px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 1rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            transition: 0.25s;
            margin-bottom: 1.5rem;
        }

        .input-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(0,0,0,0.12);
        }

        .input-card img {
            width: 58px;
            height: 58px;
            opacity: 0.6;
        }

        .input-card input {
            border: none;
            box-shadow: none;
            width: 100%;
            font-size: 26px;
        }

        /* Tombol login */
        .btn-login {
            background: #00B4D8;
            border-radius: 60px;
            height: 80px;
            font-size: 32px;
            font-weight: 700;
            color: #fff;
            border: none;
            width: 260px;
            transition: 0.25s;
        }

        .btn-login:hover {
            background: #0090aa;
            transform: translateY(-3px);
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
            border-radius: 0;
        }

        .bg-overlay {
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 100vh;
            background: #42A5F5;
            opacity: 0.32;
        }

        @media (max-width: 992px) {
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

            .image-side img,
            .bg-overlay {
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
            <!-- Kiri: Form Login -->
            <div class="col-12 col-lg-5 left-container">
                <h1>Login Siswa</h1>
                <p>Masukkan Username dan Password</p>

                @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <!-- FORM LOGIN -->
                <form action="{{ route('auth.siswa') }}" method="POST">
                    @csrf

                    <!-- Input Username -->
                    <div class="input-card">
                        <img src="{{ asset('images/login/student.png') }}" alt="Student">
                        <input type="text" name="username" placeholder="Masukkan Username" required>
                    </div>

                    <!-- Input Password -->
                    <div class="input-card">
                        <img src="{{ asset('images/login/padlock.png') }}" alt="Password">
                        <input type="password" name="password" placeholder="Masukkan Password" required>
                    </div>

                    <button type="submit" class="btn-login d-block mx-auto">Login</button>
                </form>
            </div>

            <!-- Kanan: Gambar Full + Overlay -->
            <div class="col-12 col-lg-7 image-side d-none d-lg-block">
                <img src="https://plus.unsplash.com/premium_photo-1677567996070-68fa4181775a?q=80&w=2072&auto=format&fit=crop" alt="Background">
                
            </div>
        </div>
    </div>

</body>
</html>
