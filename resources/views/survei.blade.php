<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/twhlogo.png') }}">
    <title>SKM - Survei Kepuasan Masyarakat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
        /* --- PERBAIKAN RESPONSIF --- */
        @media (max-width: 576px) {
            body {
                padding: 1rem;
            }
            .main-container {
                border-radius: 1rem;
            }
            .branding-panel {
                /* Header lebih tinggi di HP agar gambar tidak gepeng */
                aspect-ratio: 2 / 1; 
                background-position: center;
            }
            .form-panel {
                padding: 1.5rem 1.2rem;
            }
            /* Ukuran teks SKM di layar kecil */
            svg text {
                font-size: 62px !important;
            }
            /* Radio button agar lebih pas di layar sempit */
            .radio-button-group > div {
                min-width: 120px;
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
            max-width: 800px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 1.5rem;
            box-shadow: 0 10px 40px -10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            animation: fadeIn 1s ease-out forwards;
        }

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

        /* PERUBAHAN DESAIN: Badge Legalitas yang Mencolok */
        .legal-badge {
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
            margin-top: 10px;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        .legal-badge i {
            color: #fff;
            margin-right: 5px;
        }

        /* --- STEPPER --- */
        .stepper-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 1rem;
            margin-bottom: 2.5rem;
            position: relative;
        }

        .stepper-item {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
        }

        .stepper-item::before {
            content: '';
            position: absolute;
            top: 15px;
            left: -50%;
            width: 100%;
            height: 2px;
            background-color: #e0e0e0;
            z-index: 1;
        }

        .stepper-item:first-child::before {
            content: none;
        }

        .stepper-circle {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: #e0e0e0;
            color: #fff;
            text-align: center;
            line-height: 32px;
            z-index: 2;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .stepper-item.active .stepper-circle {
            background-color: #FFD700;
            color: #0a192f;
            box-shadow: 0 0 0 4px rgba(255, 215, 0, 0.25);
            transform: scale(1.1);
        }

        .stepper-item.completed .stepper-circle {
            background-color: #0a192f;
        }

        .stepper-item.completed::after {
            content: '';
            position: absolute;
            top: 15px;
            left: 50%;
            width: 50%;
            height: 2px;
            background-color: #0a192f;
            z-index: 1;
        }

        .stepper-label {
            font-size: 0.85rem;
            margin-top: 8px;
            color: #adb5bd;
            font-weight: 500;
            transition: color 0.3s;
        }

        .stepper-item.active .stepper-label {
            color: #0a192f;
            font-weight: 700;
        }

        /* --- INPUTS --- */
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

        /* --- RADIO BUTTONS --- */
        .radio-button-group {
            display: flex;
            flex-wrap: wrap;
            gap: 0.6rem;
            width: 100%;
        }

        .radio-button-group>div {
            flex: 1;
            min-width: 140px;
        }

        .radio-button-group input[type="radio"] {
            display: none;
        }

        .radio-button-group label {
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 0.8rem 0.5rem;
            background-color: #fff;
            border-radius: 0.6rem;
            border: 1px solid #e0e0e0;
            color: #666;
            cursor: pointer;
            transition: all 0.2s;
            height: 100%;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .radio-button-group label:hover {
            background-color: #fcfcfc;
            border-color: #ccc;
        }

        .radio-button-group input[type="radio"]:checked+label {
            background-color: #0a192f;
            color: #fff;
            border-color: #0a192f;
            box-shadow: 0 4px 10px rgba(10, 25, 47, 0.2);
        }

        /* --- QUESTION CARDS --- */
        .question-card {
            background: #fff;
            border: 1px solid #f0f0f0;
            border-left: 4px solid #FFD700;
            border-radius: 0.8rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
        }

        .question-text {
            font-weight: 600;
            margin-bottom: 1rem;
            color: #2c3e50;
            display: block;
            font-size: 1rem;
        }

        .required-star {
            color: #e74c3c;
            margin-left: 3px;
        }

        /* --- BUTTONS --- */
        .btn-nav {
            padding: 12px 24px;
            border-radius: 0.6rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            border: none;
            transition: all 0.3s;
        }

        .btn-next {
            background: linear-gradient(135deg, #0a192f 0%, #1e3a5f 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(10, 25, 47, 0.2);
        }

        .btn-next:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(10, 25, 47, 0.3);
            color: white;
        }

        .btn-prev {
            background-color: #eff2f5;
            color: #5e6c79;
        }

        .btn-prev:hover {
            background-color: #e0e4e9;
            color: #333;
        }

        .d-none {
            display: none !important;
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
    </style>
</head>

<body>
    <div class="main-container">
        <div class="branding-panel"></div>
        <div class="form-panel">

            <div class="text-center mb-2">
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
                        <path d="M90 50 L90 30 L120 30" stroke="url(#frameGold)" stroke-width="6" stroke-linecap="round"
                            fill="none" />
                        <path d="M310 80 L310 100 L280 100" stroke="url(#frameGold)" stroke-width="6"
                            stroke-linecap="round" fill="none" />
                        <text x="200" y="85" text-anchor="middle" font-family="'Poppins', sans-serif" font-weight="700"
                            font-size="72" fill="url(#proBlue)" letter-spacing="4">SKM</text>
                        <circle cx="285" cy="45" r="6" fill="url(#frameGold)" stroke="white" stroke-width="2" />
                    </g>
                </svg>

                <div style="margin-top: -5px;">
                    <span
                        style="font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 0.95rem; color: #6c757d; letter-spacing: 2px; text-transform: uppercase;">
                        Survei Kepuasan Masyarakat
                    </span>
                </div>

                <hr class="title-separator">

                <p class="text-muted mb-2" style="font-weight: 600; font-size: 1.2rem; color: #212529 !important;">
                    Balai Bahasa Provinsi Riau
                </p>

                <div class="legal-badge">
                    <i class="fas fa-balance-scale"></i> BERDASARKAN PERMENPANRB NOMOR 14 TAHUN 2017
                </div>

                <p class="text-muted small mb-3" id="waktu-saat-ini"></p>

                <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3" id="tombol-pindai-qr"
                    data-bs-toggle="modal" data-bs-target="#qrModal">
                    <i class="fas fa-qrcode me-2"></i>Isi di Ponsel Anda
                </button>
            </div>

            <div class="stepper-wrapper">
                <div class="stepper-item active" id="indicator-step-1">
                    <div class="stepper-circle">1</div>
                    <div class="stepper-label">Identitas</div>
                </div>
                <div class="stepper-item" id="indicator-step-2">
                    <div class="stepper-circle">2</div>
                    <div class="stepper-label">Penilaian</div>
                </div>
            </div>

            @if(session('success'))
                <div class='alert alert-success' role='alert'>{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('survei.store') }}" id="survey-form">
                @csrf

                <div id="step-1">
                    <div class="input-group-soft"><i class="fas fa-user fa-fw"></i>
                        <input type="text" name="nama_lengkap" class="form-control-soft" placeholder="Nama Lengkap">
                    </div>

                    <div class="input-group-soft"><i class="fas fa-envelope fa-fw"></i>
                        <input type="email" name="email" class="form-control-soft" placeholder="Email (Opsional)">
                    </div>

                    <div class="input-group-soft"><i class="fas fa-briefcase fa-fw"></i>
                        <select name="pekerjaan" id="pekerjaan-select" class="form-select-soft">
                            <option value="" disabled selected>Pekerjaan Utama</option>
                            <option value="Siswa">Siswa</option>
                            <option value="Mahasiswa">Mahasiswa</option>
                            <option value="ASN">ASN</option>
                            <option value="Pegawai Swasta">Pegawai Swasta</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div id="pekerjaan-lainnya-wrapper" class="d-none">
                        <div class="input-group-soft"><i class="fas fa-pencil-alt fa-fw"></i>
                            <input type="text" name="pekerjaan_lainnya" class="form-control-soft"
                                placeholder="Sebutkan Pekerjaan Anda">
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="radio-button-group">
                            <div>
                                <input type="radio" id="laki-laki" name="jenis_kelamin" value="Laki-laki" checked>
                                <label for="laki-laki"><i class="fas fa-mars me-2"></i>Laki-laki</label>
                            </div>
                            <div>
                                <input type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan">
                                <label for="perempuan"><i class="fas fa-venus me-2"></i>Perempuan</label>
                            </div>
                        </div>
                    </div>

                    <div class="input-group-soft"><i class="fas fa-graduation-cap fa-fw"></i>
                        <select name="pendidikan" class="form-select-soft">
                            <option value="" disabled selected>Pendidikan Terakhir</option>
                            <option value="SD">SD</option>
                            <option value="SMP/sederajat">SMP/sederajat</option>
                            <option value="SMA/sederajat">SMA/sederajat</option>
                            <option value="D-3">D-3</option>
                            <option value="D-4/S-1">D-4/S-1</option>
                            <option value="S-2">S-2</option>
                            <option value="S-3">S-3</option>
                        </select>
                    </div>

                    <div class="input-group-soft"><i class="fas fa-concierge-bell fa-fw"></i>
                        <select name="jenis_layanan" id="layanan-select" class="form-select-soft">
                            <option value="" disabled selected>Layanan yang Diterima</option>
                            <option value="Uji Kemahiran Berbahasa Indonesia (UKBI)">Uji Kemahiran Berbahasa Indonesia
                                (UKBI)</option>
                            <option value="Ahli Bahasa">Ahli Bahasa</option>
                            <option value="Perpustakaan">Perpustakaan</option>
                            <option value="Penerjemahan">Penerjemahan</option>
                            <option value="Pemodernan dan Pelindungan Bahasa Sastra">Pemodernan dan Pelindungan Sastra
                            </option>
                            <option value="Kegiatan Literasi">Kegiatan Literasi</option>
                            <option value="Kegiatan Perkamusan dan Peristilahan">Perkamusan & Peristilahan</option>
                            <option value="Kegiatan BIPA">Kegiatan BIPA</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div id="layanan-lainnya-wrapper" class="d-none">
                        <div class="input-group-soft"><i class="fas fa-pencil-alt fa-fw"></i>
                            <input type="text" name="jenis_layanan_lainnya" class="form-control-soft"
                                placeholder="Sebutkan Layanan Lainnya">
                        </div>
                    </div>

                    <button type="button" class="btn btn-next w-100 mt-4 btn-nav" onclick="nextStep()">
                        Mulai Penilaian <i class="fas fa-arrow-right ms-2"></i>
                    </button>
                </div>

                <div id="step-2" class="d-none animate-in">

                    <div class="alert alert-light border mb-4 text-center text-muted small">
                        <i class="fas fa-info-circle me-1"></i> Mohon isi semua pertanyaan bertanda bintang (<span
                            class="text-danger">*</span>).
                    </div>

                    <div class="question-card">
                        <label class="question-text">1. Bagaimana kesesuaian persyaratan pelayanan dengan jenis
                            pelayanannya?<span class="required-star">*</span></label>
                        <div class="radio-button-group">
                            @foreach(['Tidak Sesuai', 'Kurang Sesuai', 'Sesuai', 'Sangat Sesuai'] as $opt)
                                <div>
                                    <input type="radio" id="q1_{{Str::slug($opt)}}" name="q1_kesesuaian_persyaratan"
                                        value="{{$opt}}">
                                    <label for="q1_{{Str::slug($opt)}}">{{$opt}}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="question-card">
                        <label class="question-text">2. Bagaimana kemudahan prosedur pelayanan di Balai Bahasa?<span
                                class="required-star">*</span></label>
                        <div class="radio-button-group">
                            @foreach(['Tidak Mudah', 'Kurang Mudah', 'Mudah', 'Sangat Mudah'] as $opt)
                                <div>
                                    <input type="radio" id="q2_{{Str::slug($opt)}}" name="q2_kemudahan_prosedur"
                                        value="{{$opt}}">
                                    <label for="q2_{{Str::slug($opt)}}">{{$opt}}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="question-card">
                        <label class="question-text">3. Bagaimana kecepatan petugas dalam memberikan pelayanan?<span
                                class="required-star">*</span></label>
                        <div class="radio-button-group">
                            @foreach(['Tidak Cepat', 'Kurang Cepat', 'Cepat', 'Sangat Cepat'] as $opt)
                                <div>
                                    <input type="radio" id="q3_{{Str::slug($opt)}}" name="q3_kecepatan" value="{{$opt}}">
                                    <label for="q3_{{Str::slug($opt)}}">{{$opt}}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="question-card">
                        <label class="question-text">4. Bagaimana kewajaran biaya/tarif dalam pelayanan?<span
                                class="required-star">*</span></label>
                        <div class="radio-button-group">
                            @foreach(['Sangat Mahal', 'Cukup Mahal', 'Murah', 'Gratis'] as $opt)
                                <div>
                                    <input type="radio" id="q4_{{Str::slug($opt)}}" name="q4_kewajaran_biaya"
                                        value="{{$opt}}">
                                    <label for="q4_{{Str::slug($opt)}}">{{$opt}}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="question-card">
                        <label class="question-text">5. Bagaimana kompetensi petugas dalam pelayanan?<span
                                class="required-star">*</span></label>
                        <div class="radio-button-group">
                            @foreach(['Tidak Kompeten', 'Kurang Kompeten', 'Kompeten', 'Sangat Kompeten'] as $opt)
                                <div>
                                    <input type="radio" id="q5_{{Str::slug($opt)}}" name="q5_kompetensi" value="{{$opt}}">
                                    <label for="q5_{{Str::slug($opt)}}">{{$opt}}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="question-card">
                        <label class="question-text">6. Kesesuaian produk pelayanan antara yang tercantum dalam standar
                            dengan hasil yang diberikan?<span class="required-star">*</span></label>
                        <div class="radio-button-group">
                            @foreach(['Tidak Sesuai', 'Kurang Sesuai', 'Sesuai', 'Sangat Sesuai'] as $opt)
                                <div>
                                    <input type="radio" id="q6_{{Str::slug($opt)}}" name="q6_kesesuaian_produk"
                                        value="{{$opt}}">
                                    <label for="q6_{{Str::slug($opt)}}">{{$opt}}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="question-card">
                        <label class="question-text">7. Bagaimana perilaku petugas terkait kesopanan dan keramahan?<span
                                class="required-star">*</span></label>
                        <div class="radio-button-group">
                            @foreach(['Tidak Sopan', 'Kurang Sopan', 'Sopan & Ramah', 'Sangat Sopan'] as $opt)
                                <div>
                                    <input type="radio" id="q7_{{Str::slug($opt)}}" name="q7_perilaku" value="{{$opt}}">
                                    <label for="q7_{{Str::slug($opt)}}">{{$opt}}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="question-card">
                        <label class="question-text">8. Bagaimana kualitas sarana dan prasarana?<span
                                class="required-star">*</span></label>
                        <div class="radio-button-group">
                            @foreach(['Buruk', 'Cukup', 'Baik', 'Sangat Baik'] as $opt)
                                <div>
                                    <input type="radio" id="q8_{{Str::slug($opt)}}" name="q8_sarpras" value="{{$opt}}">
                                    <label for="q8_{{Str::slug($opt)}}">{{$opt}}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="question-card">
                        <label class="question-text">9. Bagaimana penanganan pengaduan pengguna layanan?<span
                                class="required-star">*</span></label>
                        <div class="radio-button-group">
                            <div>
                                <input type="radio" id="q9_tidak_ada" name="q9_pengaduan" value="Tidak ada">
                                <label for="q9_tidak_ada">Tidak ada</label>
                            </div>
                            <div>
                                <input type="radio" id="q9_ada_rusak" name="q9_pengaduan" value="Ada tapi rusak">
                                <label for="q9_ada_rusak">Ada, Tdk Berfungsi</label>
                            </div>
                            <div>
                                <input type="radio" id="q9_kurang" name="q9_pengaduan" value="Kurang maksimal">
                                <label for="q9_kurang">Kurang Maksimal</label>
                            </div>
                            <div>
                                <input type="radio" id="q9_baik" name="q9_pengaduan" value="Dikelola baik">
                                <label for="q9_baik">Dikelola Baik</label>
                            </div>
                        </div>
                    </div>

                    <div class="question-card">
                        <label class="question-text">Saran dan Masukan<span class="required-star">*</span></label>
                        <div class="input-group-soft bg-white">
                            <i class="fas fa-comment-dots mt-3 align-self-start"></i>
                            <textarea name="saran" class="form-control-soft" rows="3"
                                placeholder="Tuliskan saran Anda..."></textarea>
                        </div>
                    </div>

                    <div class="d-flex gap-3">
                        <button type="button" class="btn btn-prev flex-fill btn-nav" onclick="prevStep()">
                            <i class="fas fa-arrow-left me-2"></i> Kembali
                        </button>
                        <button type="submit" class="btn btn-next flex-fill btn-nav">
                            <i class="fas fa-paper-plane me-2"></i> Kirim SKM
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <div class="modal fade" id="qrModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0"><button type="button" class="btn-close"
                        data-bs-dismiss="modal"></button></div>
                <div class="modal-body text-center pt-0 pb-4">
                    <h5 class="mb-3">Pindai QR Code</h5>
                    <div id="qrcode-container" class="p-2 border rounded d-inline-block"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="validationModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-danger"><i class="fas fa-exclamation-circle me-2"></i> Data Belum
                        Lengkap</h5>
                </div>
                <div class="modal-body">
                    <ul id="validation-errors" class="list-unstyled mb-0"></ul>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light w-100 border" data-bs-dismiss="modal">Saya
                        Mengerti</button>
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
        // SCRIPT WAKTU & QR
        function updateTime() {
            const now = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' };
            document.getElementById('waktu-saat-ini').innerText = now.toLocaleDateString('id-ID', options) + ' WIB';
        }
        setInterval(updateTime, 1000);
        updateTime();

        // LOGIKA SEMBUNYIKAN QR DI HP
        document.addEventListener('DOMContentLoaded', function() {
            const btnQR = document.getElementById('tombol-pindai-qr');
            
            function isMobile() {
                return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
            }

            if (isMobile() && btnQR) {
                btnQR.style.setProperty('display', 'none', 'important');
            }
        });

        const qrModal = document.getElementById('qrModal');
        qrModal.addEventListener('show.bs.modal', event => {
            const qrContainer = document.getElementById('qrcode-container');
            qrContainer.innerHTML = '';
            const qr = qrcode(4, 'L');
            qr.addData(window.location.href);
            qr.make();
            qrContainer.innerHTML = qr.createImgTag(6, 8);
        });

        // SCRIPT VALIDASI DAN STEPPER
        function nextStep() {
            const form = document.getElementById('survey-form');
            const errors = [];

            // Validasi Data Diri (Email tidak dicek karena Opsional)
            if (!form.nama_lengkap.value.trim()) errors.push('<li class="mb-2"><i class="fas fa-times text-danger me-2"></i>Nama Lengkap wajib diisi</li>');
            if (!form.pekerjaan.value) errors.push('<li class="mb-2"><i class="fas fa-times text-danger me-2"></i>Pekerjaan wajib dipilih</li>');
            if (form.pekerjaan.value === 'Lainnya' && !form.pekerjaan_lainnya.value.trim()) errors.push('<li class="mb-2"><i class="fas fa-times text-danger me-2"></i>Pekerjaan Lainnya wajib diisi</li>');
            if (!form.pendidikan.value) errors.push('<li class="mb-2"><i class="fas fa-times text-danger me-2"></i>Pendidikan wajib dipilih</li>');
            if (!form.jenis_layanan.value) errors.push('<li class="mb-2"><i class="fas fa-times text-danger me-2"></i>Jenis Layanan wajib dipilih</li>');
            if (form.jenis_layanan.value === 'Lainnya' && !form.jenis_layanan_lainnya.value.trim()) errors.push('<li class="mb-2"><i class="fas fa-times text-danger me-2"></i>Jenis Layanan Lainnya wajib diisi</li>');

            if (errors.length > 0) {
                showValidationModal(errors);
                return;
            }

            // Pindah Step
            document.getElementById('step-1').classList.add('d-none');
            document.getElementById('step-2').classList.remove('d-none');

            // Update Indikator
            document.getElementById('indicator-step-1').classList.remove('active');
            document.getElementById('indicator-step-1').classList.add('completed');
            document.getElementById('indicator-step-2').classList.add('active');

            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function prevStep() {
            document.getElementById('step-2').classList.add('d-none');
            document.getElementById('step-1').classList.remove('d-none');

            document.getElementById('indicator-step-2').classList.remove('active');
            document.getElementById('indicator-step-1').classList.remove('completed');
            document.getElementById('indicator-step-1').classList.add('active');
        }

        function showValidationModal(errors) {
            const list = document.getElementById('validation-errors');
            list.innerHTML = errors.join('');
            new bootstrap.Modal(document.getElementById('validationModal')).show();
        }

        // Toggle Input Lainnya
        document.getElementById('pekerjaan-select').addEventListener('change', function () {
            const wrapper = document.getElementById('pekerjaan-lainnya-wrapper');
            wrapper.classList.toggle('d-none', this.value !== 'Lainnya');
        });
        document.getElementById('layanan-select').addEventListener('change', function () {
            const wrapper = document.getElementById('layanan-lainnya-wrapper');
            wrapper.classList.toggle('d-none', this.value !== 'Lainnya');
        });

        // VALIDASI FINAL (WAJIB ISI SEMUA)
        document.getElementById('survey-form').addEventListener('submit', function (e) {
            e.preventDefault();
            const errors = [];

            // Cek 9 Pertanyaan Survei
            const questions = [
                'q1_kesesuaian_persyaratan', 'q2_kemudahan_prosedur', 'q3_kecepatan',
                'q4_kewajaran_biaya', 'q5_kompetensi', 'q6_kesesuaian_produk',
                'q7_perilaku', 'q8_sarpras', 'q9_pengaduan'
            ];

            // Loop cek apakah radio button terpilih
            let allAnswered = true;
            questions.forEach(q => {
                if (!document.querySelector(`input[name="${q}"]:checked`)) {
                    allAnswered = false;
                }
            });

            if (!allAnswered) {
                errors.push('<li class="mb-2"><i class="fas fa-times text-danger me-2"></i>Mohon lengkapi semua pertanyaan survei (No 1 - 9).</li>');
            }

            // Validasi Saran
            if (!this.saran.value.trim()) {
                errors.push('<li class="mb-2"><i class="fas fa-times text-danger me-2"></i>Mohon isi Saran dan Masukan Anda.</li>');
            }

            if (errors.length > 0) {
                showValidationModal(errors);
            } else {
                this.submit();
            }
        });
    </script>
</body>

</html>