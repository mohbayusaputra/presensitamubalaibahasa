<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berhasil - Balai Bahasa Provinsi Riau</title>
    <link rel="icon" type="image/png" href="{{ asset('images/twhlogo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        /* --- ANIMASI & BACKGROUND (SAMA DENGAN FORM) --- */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
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

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(-45deg, #e0f2f1, #b2dfdb, #e8eaf6, #c5cae9);
            background-size: 400% 400%;
            animation: aurora 15s ease infinite;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 1rem;
        }

        .success-container {
            position: relative;
            max-width: 500px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.9);
            /* Glassmorphism */
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 1.5rem;
            box-shadow: 0 15px 50px -10px rgba(0, 0, 0, 0.15);
            animation: fadeIn 0.8s ease-out forwards;
            text-align: center;
            padding: 3rem;
            overflow: hidden;
        }

        /* Garis Emas di Atas (Ciri Khas Branding) */
        .success-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: linear-gradient(90deg, #FDB813 0%, #FFD700 50%, #B8860B 100%);
        }

        .success-icon {
            font-size: 5rem;
            background: -webkit-linear-gradient(#198754, #20c997);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 1rem;
        }

        .btn-home {
            background-color: #0a192f;
            color: #fff;
            border-radius: 50px;
            padding: 10px 30px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-home:hover {
            background-color: #1e3a5f;
            color: #fff;
            transform: translateY(-2px);
        }
    </style>
</head>

<body>
    <div class="success-container">
        <div class="success-icon">
            <i class="fas fa-check-circle"></i>
        </div>

        <h2 class="fw-bold mb-3" style="color: #0a192f;">Berhasil!</h2>

        @if (session('success'))
            <p class="text-muted fs-6 mb-4">{{ session('success') }}</p>
        @else
            <p class="text-muted fs-6 mb-4">Data Anda telah berhasil kami simpan ke dalam sistem.</p>
        @endif

        <div class="alert alert-light border d-inline-block px-4 py-2 rounded-pill text-muted small">
            <i class="fas fa-clock me-2"></i>Mengalihkan otomatis dalam <strong id="countdown"
                class="text-dark">5</strong> detik...
        </div>

        <div class="mt-4">
            <a href="{{ session('redirect_url', url('/')) }}" class="btn-home small">
                <i class="fas fa-home me-2"></i>Kembali Sekarang
            </a>
        </div>
    </div>

    {{-- Script Countdown & Redirect --}}
    <script>
        let countdownElement = document.getElementById('countdown');
        let seconds = 5;
        // Ambil URL dari session, jika tidak ada default ke '/'
        let redirectUrl = "{{ session('redirect_url', url('/')) }}";

        // Fungsi Redirect
        setTimeout(function () {
            window.location.href = redirectUrl;
        }, seconds * 1000);

        // Fungsi Update Angka
        setInterval(function () {
            if (seconds > 1) {
                seconds--;
                countdownElement.textContent = seconds;
            }
        }, 1000);
    </script>
</body>

</html>