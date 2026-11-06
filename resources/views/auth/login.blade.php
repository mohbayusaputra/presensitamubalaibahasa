<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin Presensi Tamu</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" type="image/png" href="{{ asset('images/twhlogo.png') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes aurora {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        :root {
            --accent-gold: #FDB813;
            --dark-blue: #0a192f;
        }

        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            flex-direction: column;
            /* Diubah untuk menampung footer */
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 2rem;
            background: linear-gradient(-45deg, #e0f2f1, #b2dfdb, #e8eaf6, #c5cae9);
            background-size: 400% 400%;
            animation: aurora 15s ease infinite;
            color: #333;
        }

        .login-card {
            max-width: 400px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(10px);
            border-radius: 2rem;
            padding: 3rem;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            animation: fadeIn 1s ease-out forwards;
        }

        @media (max-width: 576px) {
            .login-card {
                padding: 2rem;
            }
        }

        .login-logo {
            width: 90px;
            height: 90px;
            margin: 0 auto 1.5rem auto;
            border-radius: 50%;
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .login-logo img {
            max-width: 55px;
        }

        .login-card h3 {
            font-weight: 600;
        }

        .login-card p {
            font-size: 0.9rem;
            color: #666;
        }

        .input-group-neumorphic {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
            border-radius: 50px;
            padding: 0 1.5rem;
            background-color: rgba(255, 255, 255, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.8);
            transition: all 0.3s ease;
        }

        .input-group-neumorphic:focus-within {
            background-color: #fff;
            box-shadow: 0 0 0 4px rgba(253, 184, 19, 0.25);
        }

        .input-group-neumorphic:focus-within i {
            color: var(--accent-gold);
        }

        .input-group-neumorphic i {
            color: #aaa;
            transition: color 0.3s ease;
        }

        .form-control-neumorphic {
            border: none;
            background: none;
            padding: 1rem 1rem;
            color: #333;
            width: 100%;
        }

        .form-control-neumorphic:focus {
            outline: none;
            box-shadow: none;
        }

        .form-control-neumorphic::placeholder {
            color: #aaa;
        }

        .btn-submit {
            font-weight: 600;
            padding: 1rem;
            border-radius: 50px;
            border: none;
            transition: all 0.3s ease;
            background-color: var(--dark-blue);
            color: #ffffff;
            width: 100%;
            box-shadow: 0 7px 20px -5px rgba(10, 25, 47, 0.5);
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px -5px rgba(10, 25, 47, 0.6);
        }

        /* --- KODE BARU UNTUK FOOTER --- */
        .page-footer {
            width: 100%;
            padding: 1rem;
            margin-top: auto;
            /* Mendorong footer ke bawah */
            text-align: center;
        }

        .footer-separator {
            width: 100px;
            height: 1px;
            background-color: rgba(0, 0, 0, 0.2);
            margin: 0 auto 1rem auto;
        }

        .page-footer p {
            margin: 0;
            font-size: 0.9rem;
            color: rgba(0, 0, 0, 0.65);
            font-weight: 400;
        }

        .page-footer .credit-title {
            display: block;
            margin-bottom: 0.3rem;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: rgba(0, 0, 0, 0.5);
        }

        .page-footer strong {
            font-weight: 500;
        }

        /* --- AKHIR KODE BARU --- */
    </style>
</head>

<body>
    <div class="login-card">
        <div class="login-logo">
            <img src="{{ asset('images/logobbpr.png') }}" alt="Logo" onerror="this.style.display='none'">
        </div>

        <h3 class="mb-1">Login Admin Presensi Tamu</h3>
        <p class="mb-4">Masuk untuk mengelola data tamu dan kehadiran</p>

        <x-auth-session-status class="mb-4" :status="session('status')" />
        @if ($errors->any())
        <div class="alert alert-danger py-2 small">Email atau password salah!</div> @endif

        <form method="POST" action="{{ route('login') }}" class="mt-4">
            @csrf
            <div class="input-group-neumorphic">
                <i class="fas fa-envelope fa-fw"></i>
                <input id="email" type="email" name="email" :value="old('email')" required autofocus
                    class="form-control-neumorphic" placeholder="Email">
            </div>
            <div class="input-group-neumorphic">
                <i class="fas fa-lock fa-fw"></i>
                <input id="password" type="password" name="password" required class="form-control-neumorphic"
                    placeholder="Password">
            </div>

            <button type="submit" class="btn btn-submit mt-4">Login</button>
        </form>
    </div>

    <footer class="page-footer">
        <div class="footer-separator"></div>
        <p>
            <span class="credit-title">Desain & Pengembangan oleh Mahasiswa Magang</span>
            <strong>Universitas Sains dan Teknologi Indonesia</strong> &amp; <strong>Politeknik Caltex Riau</strong>
        </p>
    </footer>
</body>

</html>