<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAPA (Sistem Aspirasi dan Pelayanan) - Balai Bahasa Provinsi Riau</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/png" href="{{ asset('images/twhlogo.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        /* --- ANIMASI & BACKGROUND --- */
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
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 2rem;
            background: linear-gradient(-45deg, #e0f2f1, #b2dfdb, #e8eaf6, #c5cae9);
            background-size: 400% 400%;
            animation: aurora 15s ease infinite;
        }

        /* --- CONTAINER UTAMA --- */
        .main-container {
            position: relative;
            display: grid;
            grid-template-columns: 1fr;
            max-width: 700px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.85);
            /* Glassmorphism Solid */
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 1.5rem;
            box-shadow: 0 10px 40px -10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            animation: fadeIn 1s ease-out forwards;
        }

        /* Garis Emas di Atas */
        .main-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #FDB813 0%, #FFD700 50%, #B8860B 100%);
            z-index: 2;
        }

        .branding-panel {
            background-image: url("{{ asset('images/header.png') }}");
            background-size: cover;
            background-position: center;
            aspect-ratio: 4 / 1;
        }
        /* --- PERBAIKAN RESPONSIF --- */
@media (max-width: 576px) {
    body {
        padding: 1rem; /* Kurangi padding luar di HP */
    }
    .main-container {
        border-radius: 1rem; /* Border lebih kecil di HP */
    }
    .branding-panel {
        aspect-ratio: 2 / 1; /* Header lebih tinggi di HP agar gambar tidak gepeng */
    }
    .form-panel {
        padding: 1.5rem 1.2rem;
    }
    /* Ukuran teks SAPA di SVG agar tidak terlalu besar di layar kecil */
    svg text {
        font-size: 60px !important;
    }
}

        .form-panel {
            padding: 2.5rem;
            color: #212529;
        }

        @media (max-width: 576px) {
            .form-panel {
                padding: 1.5rem;
            }
        }

        /* --- HEADER ELEMENTS --- */
        .title-separator {
            width: 80px;
            height: 3px;
            margin: 15px auto;
            border: none;
            background: linear-gradient(90deg, #FDB813, #B8860B);
            border-radius: 2px;
            opacity: 1;
        }

        /* DESKRIPSI BADGE (FORMULIR TAMU) */
        .description-badge {
            display: inline-block;
            background: linear-gradient(135deg, #0a192f 0%, #1e3a5f 100%);
            color: #FFD700;
            /* Warna Emas */
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            border: 1px solid #FFD700;
            box-shadow: 0 4px 10px rgba(10, 25, 47, 0.2);
            margin-top: 5px;
            margin-bottom: 15px;
            /* Jarak ke Waktu */
            text-transform: uppercase;
        }

        .description-badge i {
            color: #fff;
            margin-right: 5px;
        }

        /* --- INPUT STYLES --- */
        .input-group-soft {
            display: flex;
            align-items: center;
            background-color: #f8f9fa;
            border-radius: 0.8rem;
            margin-bottom: 1.2rem;
            padding: 0 1rem;
            border: 1px solid #e9ecef;
            transition: all 0.2s ease-in-out;
        }

        .input-group-soft i {
            color: #b0b0b0;
            transition: color 0.2s;
        }

        .form-control-soft,
        .form-select-soft {
            border: none;
            background: none;
            padding: 1rem 0.8rem;
            color: #333;
            width: 100%;
            font-size: 0.95rem;
        }

        .form-control-soft:focus,
        .form-select-soft:focus {
            outline: none;
        }

        .input-group-soft:focus-within {
            background-color: #fff;
            border-color: #FFD700;
            box-shadow: 0 4px 12px rgba(255, 215, 0, 0.15);
        }

        .input-group-soft:focus-within i {
            color: #B8860B;
        }

        /* --- BUTTON STYLES --- */
        .btn-submit {
            font-weight: 600;
            padding: 14px;
            border-radius: 0.6rem;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px -5px rgba(10, 25, 47, 0.4);
            background: linear-gradient(135deg, #0a192f 0%, #1e3a5f 100%);
            color: #ffffff;
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px -5px rgba(10, 25, 47, 0.5);
            color: white;
        }

        /* MODAL & FOOTER */
        .modal-body #qrcode-container canvas {
            width: 100% !important;
            height: auto !important;
        }

        .page-footer {
            text-align: center;
            margin-top: 2rem;
        }

        .footer-separator {
            width: 100px;
            height: 1px;
            background-color: rgba(0, 0, 0, 0.1);
            margin: 0 auto 1rem auto;
        }

        .page-footer p {
            font-size: 0.85rem;
            color: #777;
        }

        .page-footer .credit-title {
            display: block;
            margin-bottom: 0.3rem;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: rgba(0, 0, 0, 0.5);
        }
    </style>
</head>

<body>
    <div class="main-container">
        <div class="branding-panel"></div>
        <div class="form-panel">

            <div class="text-center mb-5">
                <svg width="100%" height="auto" viewBox="0 0 400 120" fill="none" xmlns="http://www.w3.org/2000/svg"
                    style="max-width: 380px;">
                    <defs>
                        <linearGradient id="proBlue" x1="0%" y1="0%" x2="0%" y2="100%">
                            <stop offset="0%" style="stop-color:#0a192f;stop-opacity:1" />
                            <stop offset="100%" style="stop-color:#1e3a5f;stop-opacity:1" />
                        </linearGradient>
                        <linearGradient id="frameGold" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" style="stop-color:#FFD700;stop-opacity:1" />
                            <stop offset="100%" style="stop-color:#B8860B;stop-opacity:1" />
                        </linearGradient>
                        <filter id="softShadow" x="-20%" y="-20%" width="140%" height="140%">
                            <feDropShadow dx="0" dy="4" stdDeviation="3" flood-color="rgba(0,0,0,0.1)" />
                        </filter>
                    </defs>
                    <g filter="url(#softShadow)">
                        <path d="M80 50 L80 30 L110 30" stroke="url(#frameGold)" stroke-width="6" stroke-linecap="round"
                            fill="none" />
                        <path d="M320 80 L320 100 L290 100" stroke="url(#frameGold)" stroke-width="6"
                            stroke-linecap="round" fill="none" />
                        <text x="200" y="85" text-anchor="middle" font-family="'Poppins', sans-serif" font-weight="700"
                            font-size="72" fill="url(#proBlue)" letter-spacing="2">SAPA</text>
                        <circle cx="295" cy="45" r="6" fill="url(#frameGold)" stroke="white" stroke-width="2" />
                    </g>
                </svg>

                <div style="margin-top: -5px;">
                    <span
                        style="font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 0.95rem; color: #6c757d; letter-spacing: 2px; text-transform: uppercase;">
                        Sistem Aspirasi dan Pelayanan
                    </span>
                </div>

                <hr class="title-separator">

                <p class="text-muted mb-2" style="font-weight: 500; font-size: 1.1rem; color: #212529 !important;">
                    Balai Bahasa Provinsi Riau
                </p>

                <div class="description-badge">
                    <i class="fas fa-book-open"></i> Formulir Data Tamu Balai Bahasa Provinsi Riau
                </div>

                <p class="text-muted small mb-3" id="waktu-saat-ini"></p>

                <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3" id="tombol-pindai-qr"
                    data-bs-toggle="modal" data-bs-target="#qrModal">
                    <i class="fas fa-qrcode me-2"></i>Isi di Ponsel Anda
                </button>
            </div>

            @if(session('success'))
                <div class='alert alert-success' role='alert'>{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('tamu.store') }}" id="guestbook-form">
                @csrf
                <div class="input-group-soft">
                    <i class="fas fa-user fa-fw"></i>
                    <input type="text" name="nama" class="form-control-soft" placeholder="Nama Lengkap"
                        value="{{ old('nama') }}">
                </div>
                <div class="input-group-soft">
                    <i class="fas fa-phone fa-fw"></i>
                    <input type="tel" name="telepon" class="form-control-soft" placeholder="Nomor Telepon/WhatsApp"
                        value="{{ old('telepon') }}">
                </div>
                <div class="input-group-soft">
                    <i class="fas fa-envelope fa-fw"></i>
                    <input type="email" name="email" class="form-control-soft" placeholder="Posel (Opsional)"
                        value="{{ old('email') }}">
                </div>

                <div class="input-group-soft">
                    <i class="fas fa-concierge-bell fa-fw"></i>
                    <select name="jenis_layanan" id="layanan-select" class="form-select-soft">
                        <option value="" disabled selected>Jenis Layanan yang Diterima</option>
                        <option value="Uji Kemahiran Berbahasa Indonesia (UKBI)">Uji Kemahiran Berbahasa Indonesia
                            (UKBI)</option>
                        <option value="Ahli Bahasa">Ahli Bahasa (Saksi Ahli, Narasumber, Juri, dll)</option>
                        <option value="Perpustakaan">Perpustakaan</option>
                        <option value="Penerjemahan">Penerjemahan</option>
                        <option value="Pemodernan dan Pelindungan Bahasa Sastra">Pemodernan dan Pelindungan Sastra
                        </option>
                        <option value="Kegiatan Literasi">Kegiatan Literasi</option>
                        <option value="Kegiatan Perkamusan dan Peristilahan">Perkamusan & Peristilahan</option>
                        <option value="Kegiatan BIPA">Kegiatan BIPA</option>
                        <option value="Permohonan Kerja Sama (PKS)">Permohonan Kerja Sama (PKS)</option>
                        <option value="Permohonan Magang">Permohonan Magang</option>
                        <option value="Peminjaman Aula dan Serambi">Peminjaman Aula dan Serambi</option>
                        <option value="Audiensi">Audiensi</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>

                <div id="layanan-lainnya-wrapper" style="display: none;">
                    <div class="input-group-soft">
                        <i class="fas fa-pencil-alt fa-fw"></i>
                        <input type="text" name="jenis_layanan_lainnya" id="input-lainnya" class="form-control-soft"
                            placeholder="Sebutkan keperluan lainnya...">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 btn-submit mt-4">
                    <i class="fas fa-paper-plane me-2"></i>Kirim Data
                </button>
            </form>
        </div>
    </div>

    <div class="modal fade" id="qrModal" tabindex="-1" aria-labelledby="qrModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center pt-0 pb-4">
                    <h5 class="mb-3">Pindai QR Code</h5>
                    <div id="qrcode-container" class="p-2 border rounded d-inline-block"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="validationModal" tabindex="-1" aria-labelledby="validationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-danger"><i class="fas fa-exclamation-circle me-2"></i> Formulir Belum
                        Lengkap</h5>
                </div>
                <div class="modal-body">
                    <p>Mohon isi kolom berikut yang wajib diisi:</p>
                    <ul id="validation-errors" class="list-unstyled mb-0"></ul>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light w-100 border" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <footer class="page-footer">
        <div class="footer-separator"></div>
        <p>
            <span class="d-block text-uppercase small text-muted mb-1">Desain & Pengembangan oleh Mahasiswa
                Magang</span>
            <strong>Universitas Sains dan Teknologi Indonesia</strong> &amp; <strong>Politeknik Caltex Riau</strong>
        </p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode-generator/qrcode.js"></script>

    <script>
        // SCRIPT WAKTU
        function updateTime() {
            const now = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' };
            document.getElementById('waktu-saat-ini').innerText = now.toLocaleDateString('id-ID', options) + ' WIB';
        }
        setInterval(updateTime, 1000);
        updateTime();

        // LOGIKA UTAMA
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('guestbook-form');
            const layananSelect = document.getElementById('layanan-select');
            const layananLainnyaWrapper = document.getElementById('layanan-lainnya-wrapper');
            const inputLainnya = document.getElementById('input-lainnya');
            const validationModal = new bootstrap.Modal(document.getElementById('validationModal'));
            const errorList = document.getElementById('validation-errors');

            // QR Code
            const qrModal = document.getElementById('qrModal');
            qrModal.addEventListener('show.bs.modal', event => {
                const qrContainer = document.getElementById('qrcode-container');
                qrContainer.innerHTML = '';
                const qr = qrcode(4, 'L');
                qr.addData(window.location.href);
                qr.make();
                qrContainer.innerHTML = qr.createImgTag(6, 8);
            });

            // Fungsi untuk mendeteksi jika user menggunakan perangkat mobile
    function deteksiPerangkatMobile() {
        const toMatch = [
            /Android/i,
            /webOS/i,
            /iPhone/i,
            /iPad/i,
            /iPod/i,
            /BlackBerry/i,
            /Windows Phone/i
        ];

        return toMatch.some((toMatchItem) => {
            return navigator.userAgent.match(toMatchItem);
        });
    }

    // Jika terdeteksi HP, sembunyikan tombol QR Code
    if (deteksiPerangkatMobile()) {
        if (tombolQR) {
            tombolQR.style.display = 'none';
        }
    }

            

            // Toggle Input Lainnya
            layananSelect.addEventListener('change', function () {
                if (this.value === 'Lainnya') {
                    layananLainnyaWrapper.style.display = 'block';
                    inputLainnya.setAttribute('required', 'required');
                } else {
                    layananLainnyaWrapper.style.display = 'none';
                    inputLainnya.removeAttribute('required');
                    inputLainnya.value = '';
                }
            });

            // Validasi Form
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                let errors = [];

                if (!form.nama.value.trim()) errors.push('<li class="mb-2"><i class="fas fa-times text-danger me-2"></i>Nama Lengkap wajib diisi</li>');
                if (!form.telepon.value.trim()) errors.push('<li class="mb-2"><i class="fas fa-times text-danger me-2"></i>No. Telepon / WhatsApp wajib diisi</li>');
                if (!layananSelect.value || layananSelect.value === "") errors.push('<li class="mb-2"><i class="fas fa-times text-danger me-2"></i>Jenis Layanan wajib dipilih</li>');
                if (layananSelect.value === 'Lainnya' && !inputLainnya.value.trim()) errors.push('<li class="mb-2"><i class="fas fa-times text-danger me-2"></i>Keterangan Layanan Lainnya wajib diisi</li>');

                if (errors.length > 0) {
                    errorList.innerHTML = errors.join('');
                    validationModal.show();
                } else {
                    const submitButton = form.querySelector('button[type="submit"]');
                    submitButton.disabled = true;
                    submitButton.innerHTML = `<i class="fas fa-spinner fa-spin me-2"></i> Mengirim...`;
                    form.submit();
                }
            });
        });
    </script>
</body>

</html>