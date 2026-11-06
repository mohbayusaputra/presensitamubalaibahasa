<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin') - Balai Bahasa Riau</title>
    <link rel="icon" type="image/png" href="{{ asset('images/twhlogo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        :root {
            --sidebar-bg: #1F2937;
            --main-bg: #F3F4F6;
            --card-bg: #ffffff;
            --text-dark: #111827;
            --text-muted: #6B7280;
            --accent-blue: #3B82F6;
            --danger-red: #EF4444;
            --sidebar-width: 260px;
            /* Variabel untuk lebar sidebar */
        }

        body {
            background-color: var(--main-bg);
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }

        /* --- KODE DIUBAH: Sidebar sekarang 'fixed' --- */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            /* Tinggi selalu 100% dari layar */
            background-color: var(--sidebar-bg);
            color: #fff;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease-in-out;
            z-index: 1050;
        }

        .sidebar-header {
            text-align: center;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-header .logo {
            max-width: 60px;
            margin-bottom: 1rem;
            border-radius: 50%;
            border: 2px solid var(--accent-blue);
        }

        .sidebar-header h5 {
            font-weight: 600;
        }

        .sidebar-nav {
            margin-top: 1.5rem;
            overflow-y: auto;
            /* Navigasi bisa di-scroll jika menunya panjang */
        }

        .sidebar-nav a {
            color: #D1D5DB;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 0.85rem 1rem;
            border-radius: 0.5rem;
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
        }

        .sidebar-nav a.active,
        .sidebar-nav a:hover {
            background-color: var(--accent-blue);
            color: #fff;
            font-weight: 500;
        }

        .sidebar-footer {
            margin-top: auto;
            /* Ini akan mendorong tombol logout ke bawah */
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            flex-shrink: 0;
        }

        .btn-logout {
            width: 100%;
            padding: 0.85rem 1rem;
            border: 1px solid #4B5563;
            color: #D1D5DB;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .btn-logout:hover {
            background-color: var(--danger-red);
            border-color: var(--danger-red);
        }

        /* --- KODE DIUBAH: Wrapper baru untuk konten & footer --- */
        .content-wrapper {
            margin-left: var(--sidebar-width);
            /* Memberi jarak dari sidebar */
            width: calc(100% - var(--sidebar-width));
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            transition: margin-left 0.3s ease-in-out;
        }

        .main-content {
            flex-grow: 1;
            /* Membuat konten mengisi ruang */
            padding: 2rem;
        }

        .top-bar {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
        }

        .top-bar h2 {
            font-weight: 700;
            color: var(--text-dark);
        }

        .sidebar-toggle {
            display: none;
            font-size: 1.5rem;
            color: var(--text-dark);
            background: none;
            border: none;
            margin-right: 1rem;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1040;
        }

        /* --- KODE DIUBAH: Menyesuaikan tampilan mobile --- */
        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
                /* Sembunyikan sidebar */
            }

            .sidebar.active {
                transform: translateX(0);
                /* Tampilkan sidebar */
                box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
            }

            .content-wrapper {
                margin-left: 0;
                /* Hapus margin agar konten full-width */
                width: 100%;
            }

            .sidebar-toggle {
                display: block;
                /* Tampilkan tombol hamburger */
            }

            .overlay.active {
                display: block;
            }
        }

        /* --- KODE DIUBAH: Footer dengan gaya dari halaman login --- */
        .page-footer {
            padding: 1.5rem 2rem;
            text-align: center;
            background-color: var(--main-bg);
            flex-shrink: 0;
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
        }

        .page-footer .credit-title {
            display: block;
            margin-bottom: 0.3rem;
            font-size: 0.7rem;
            text-transform: uppercase;
            color: rgba(0, 0, 0, 0.5);
        }

        .page-footer strong {
            font-weight: 500;
        }

        /* Style lain-lain (tidak diubah) */
        .pagination .page-link {
            border-radius: 0.375rem;
            margin: 0 3px;
            border: none;
        }

        .pagination .page-item.active .page-link {
            background-color: var(--accent-blue);
            color: #fff;
        }

        .modal-content {
            border-radius: 0.75rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
    </style>
    @stack('styles')
</head>

<body>
    <div class="overlay" id="overlay"></div>

    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <img src="{{ asset('images/logobbpr.png') }}" alt="Logo" onerror="this.style.display='none'" class="logo">
            <h5>{{ Auth::user()->name }}</h5>
            <p class="small opacity-75 mb-0">{{ Auth::user()->email }}</p>
        </div>
        <nav class="sidebar-nav">
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><i
                    class="fas fa-tachometer-alt fa-fw me-3"></i>Dashboard</a>
            <a href="{{ route('dashboard.tamu') }}"
                class="{{ request()->routeIs('dashboard.tamu') ? 'active' : '' }}"><i
                    class="fas fa-users fa-fw me-3"></i>Data Tamu</a>
            <a href="{{ route('dashboard.survei') }}"
                class="{{ request()->routeIs('dashboard.survei') ? 'active' : '' }}"><i
                    class="fas fa-poll fa-fw me-3"></i>Data Survei</a>
        </nav>
        <div class="sidebar-footer">
            <button type="button" class="btn btn-dark btn-logout w-100 d-flex align-items-center" data-bs-toggle="modal"
                data-bs-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-fw me-3"></i>Logout
            </button>
        </div>
    </div>

    <div class="content-wrapper">
        <main class="main-content">
            <div class="top-bar">
                <button class="sidebar-toggle" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <h2 class="mb-0">@yield('title-header', 'Dashboard')</h2>
            </div>
            @yield('content')
        </main>

        <footer class="page-footer">
            <div class="footer-separator"></div>
            <p>
                <span class="credit-title">Desain & Pengembangan oleh Mahasiswa Magang</span>
                <strong>Universitas Sains dan Teknologi Indonesia</strong> &amp; <strong>Politeknik Caltex
                    Riau</strong>
            </p>
        </footer>
    </div>

    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">Apakah Anda yakin ingin mengakhiri sesi ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-sign-out-alt fa-fw me-2"></i>Ya, Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const overlay = document.getElementById('overlay');
            const toggleSidebar = () => {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
            };
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', toggleSidebar);
            }
            if (overlay) {
                overlay.addEventListener('click', toggleSidebar);
            }
        });
    </script>
    @stack('scripts')
</body>

</html>