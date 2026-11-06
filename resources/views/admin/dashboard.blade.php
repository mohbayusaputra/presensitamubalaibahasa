@extends('layouts.admin')

@section('title', 'Dashboard Utama')

@push('styles')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --bg-body: #F8FAFC;
            --card-bg: #FFFFFF;
            --text-main: #0F172A;
            --text-muted: #64748B;
            --primary: #4F46E5;
            --rose: #F43F5E;
            --amber: #F59E0B;
            --sky: #0EA5E9;
            --radius-md: 16px;
            --shadow-card: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
        }

        /* HERO & CARDS */
        .welcome-card {
            background: radial-gradient(circle at top right, #1e293b 0%, #0f172a 100%);
            border-radius: 20px;
            padding: 2.5rem;
            color: white;
            position: relative;
            overflow: hidden;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.5);
        }

        .welcome-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 24px 24px;
            opacity: 0.3;
        }

        .welcome-content h1 {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }

        .date-pill {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(8px);
            padding: 10px 20px;
            border-radius: 50px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .kpi-card {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 1.5rem;
            border: 1px solid #E2E8F0;
            box-shadow: var(--shadow-card);
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform 0.2s;
            position: relative;
        }

        .kpi-card:hover {
            transform: translateY(-3px);
            border-color: var(--primary);
        }

        .kpi-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 1rem;
        }

        .kpi-title {
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            color: var(--text-muted);
        }

        .kpi-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .kpi-total {
            font-size: 2.25rem;
            font-weight: 800;
            color: var(--text-main);
            line-height: 1;
        }

        .kpi-footer {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #F1F5F9;
            font-size: 0.85rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .theme-indigo .kpi-icon {
            background: #EEF2FF;
            color: #4F46E5;
        }

        .theme-rose .kpi-icon {
            background: #FFF1F2;
            color: #F43F5E;
        }

        .theme-amber .kpi-icon {
            background: #FFFBEB;
            color: #F59E0B;
        }

        .theme-sky .kpi-icon {
            background: #E0F2FE;
            color: #0EA5E9;
        }

        /* Animation */
        .ratio-content {
            transition: opacity 0.5s ease-in-out;
        }

        .fade-out {
            opacity: 0;
        }

        /* Widgets */
        .widget-box {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 1.5rem;
            border: 1px solid #E2E8F0;
            box-shadow: var(--shadow-card);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .widget-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .chart-legend-custom {
            display: flex;
            gap: 20px;
        }

        .legend-pill {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 20px;
            border: 1px solid #E2E8F0;
        }

        .legend-color {
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }

        .feedback-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            height: 320px;
            overflow-y: auto;
            padding-right: 5px;
        }

        .feedback-item {
            background: #F8FAFC;
            border-radius: 12px;
            padding: 1rem;
            border-left: 4px solid var(--primary);
        }

        .table-modern {
            width: 100%;
            border-collapse: collapse;
        }

        .table-modern th {
            text-align: left;
            padding: 1rem;
            font-size: 0.75rem;
            text-transform: uppercase;
            color: var(--text-muted);
            background: #F8FAFC;
            border-bottom: 1px solid #E2E8F0;
        }

        .table-modern td {
            padding: 1rem;
            border-bottom: 1px solid #F1F5F9;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .avatar {
            width: 32px;
            height: 32px;
            background: var(--primary);
            color: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.8rem;
            margin-right: 10px;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid p-0">

        <div class="welcome-card">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end">
                <div class="welcome-content mb-3 mb-md-0">
                    <h1>Dashboard Utama</h1>
                    <p>Selamat datang, Admin! Berikut ringkasan performa pelayanan Balai Bahasa Provinsi Riau.</p>
                </div>
                <div class="date-pill">
                    <i class="far fa-calendar-alt text-warning"></i>
                    <span>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="kpi-card theme-indigo">
                    <div class="kpi-header">
                        <div class="kpi-title">Total Kunjungan</div>
                        <div class="kpi-icon"><i class="fas fa-users"></i></div>
                    </div>
                    <div class="kpi-total">{{ number_format($totalTamu) }}</div>
                    <div class="kpi-footer text-primary"><span class="fw-bold me-2">+{{ $tamuHariIni }}</span> Hari Ini
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="kpi-card theme-rose">
                    <div class="kpi-header">
                        <div class="kpi-title">Total Responden</div>
                        <div class="kpi-icon"><i class="fas fa-clipboard-check"></i></div>
                    </div>
                    <div class="kpi-total">{{ number_format($totalResponden) }}</div>
                    <div class="kpi-footer text-danger"><span class="fw-bold me-2">+{{ $surveiHariIni }}</span> Hari Ini
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="kpi-card theme-amber">
                    <div class="kpi-header">
                        <div class="kpi-title">Indeks Kepuasan</div>
                        <div class="kpi-icon"><i class="fas fa-medal"></i></div>
                    </div>
                    <div class="kpi-total">{{ $ikmScore }}<span class="fs-5 text-muted fw-normal">/100 ({{ $mutu }})</span>
                    </div>
                    <div class="kpi-footer text-warning"><i class="fas fa-star me-2"></i> {{ $predikat }}</div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="kpi-card theme-sky">
                    <div class="kpi-header">
                        <div class="kpi-title" id="ratioTitle">Konversi Survei</div>
                        <div class="kpi-icon"><i class="fas fa-chart-pie"></i></div>
                    </div>
                    <div id="ratioContainer">
                        <div class="kpi-total ratio-content" id="ratioValue">
                            {{ $participationRate }}<span class="fs-5 text-muted fw-normal">%</span>
                        </div>
                        <div class="kpi-footer text-info ratio-content" id="ratioDesc">
                            <i class="fas fa-percentage me-2"></i> Dari total tamu
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-lg-8">
                <div class="widget-box">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="widget-title">
                            <i class="fas fa-chart-line text-primary"></i>
                            Tren Triwulan ({{ $quarterName }})
                        </h5>
                        <div class="chart-legend-custom">
                            <div class="legend-pill">
                                <div class="legend-color" style="background:#4F46E5"></div> Tamu
                            </div>
                            <div class="legend-pill">
                                <div class="legend-color" style="background:#F43F5E"></div> SKM
                            </div>
                        </div>
                    </div>
                    <div style="height: 350px;"><canvas id="mainChart"></canvas></div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="widget-box">
                    <h5 class="widget-title mb-4"><i class="fas fa-briefcase text-warning"></i> Profil Pengunjung</h5>
                    <div style="height: 250px; position: relative;"><canvas id="demoChart"></canvas></div>
                    <div class="text-center mt-3 small text-muted">Berdasarkan data pekerjaan responden</div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-lg-8">
                <div class="widget-box">
                    <h5 class="widget-title mb-4"><i class="fas fa-sliders-h text-success"></i> Analisis Mutu Pelayanan</h5>
                    <div style="height: 300px;"><canvas id="qualityChart"></canvas></div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="widget-box">
                    <h5 class="widget-title mb-4"><i class="fas fa-comment-dots text-info"></i> Saran Terbaru</h5>
                    <div class="feedback-list">
                        @forelse($recentFeedback as $feed)
                            <div class="feedback-item">
                                <p class="fst-italic text-secondary mb-1" style="font-size: 0.9rem">
                                    "{{ Str::limit($feed->saran, 120) }}"</p>
                                <div class="d-flex justify-content-between text-muted fw-bold" style="font-size: 0.75rem">
                                    <span>{{ Str::limit($feed->nama_lengkap ?? 'Anonim', 20) }}</span>
                                    <span>{{ $feed->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-muted py-5">Belum ada saran masuk.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="widget-box p-0 overflow-hidden">
                    <div class="p-4 border-bottom d-flex justify-content-between align-items-center">
                        <h5 class="widget-title mb-0">Log Tamu Terbaru</h5>
                        <a href="#" class="btn btn-sm btn-outline-dark rounded-pill px-3">Lihat Semua</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table-modern">
                            <thead>
                                <tr>
                                    <th class="ps-4">Nama Lengkap</th>
                                    <th>Layanan</th>
                                    <th>Kontak</th>
                                    <th class="text-end pe-4">Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tamuTerbaru as $tamu)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar">{{ substr($tamu->nama, 0, 1) }}</div><span
                                                    class="fw-bold">{{ $tamu->nama }}</span>
                                            </div>
                                        </td>
                                        <td><span
                                                class="badge bg-light text-dark border fw-normal">{{ Str::limit($tamu->layanan, 30) }}</span>
                                        </td>
                                        <td class="text-muted small">{{ $tamu->telepon }}</td>
                                        <td class="text-end pe-4 fw-bold">
                                            {{ \Carbon\Carbon::parse($tamu->waktu)->format('H:i') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">Belum ada tamu hari ini.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // --- ANIMASI KARTU RASIO (Ganti Setiap 5 Detik) ---
        const ratioTitle = document.getElementById('ratioTitle');
        const ratioValue = document.getElementById('ratioValue');
        const ratioDesc = document.getElementById('ratioDesc');

        const dataRatios = [
            {
                // SLIDE 1: PERSENTASE (Partisipasi)
                // "Sekian Persen Tamu Mengisi Survei"
                title: "Tingkat Partisipasi",
                value: "{{ $participationRate }}<span class='fs-5 text-muted fw-normal'>%</span>",
                desc: "<i class='fas fa-check-circle me-2'></i> Tamu bersedia mengisi survei"
            },
            {
                // SLIDE 2: RASIO (Tamu : Survei)
                // "Setiap X Tamu, ada 1 Survei"
                title: "Rasio Tamu : Survei",
                value: "{{ $tamuPerSurvei }} : 1",
                desc: "<i class='fas fa-user-friends me-2'></i> Setiap {{ $tamuPerSurvei }} tamu, 1 survei"
            }
        ];

        let currentIndex = 0;

        // Set judul awal langsung biar ga nunggu 5 detik
        ratioTitle.innerText = dataRatios[0].title;
        ratioValue.innerHTML = dataRatios[0].value;
        ratioDesc.innerHTML = dataRatios[0].desc;

        setInterval(() => {
            // Efek Fade Out
            ratioValue.classList.add('fade-out');
            ratioDesc.classList.add('fade-out');
            ratioTitle.style.opacity = 0;

            setTimeout(() => {
                // Ganti Data
                currentIndex = (currentIndex + 1) % dataRatios.length;

                ratioTitle.innerText = dataRatios[currentIndex].title;
                ratioValue.innerHTML = dataRatios[currentIndex].value;
                ratioDesc.innerHTML = dataRatios[currentIndex].desc;

                // Efek Fade In
                ratioValue.classList.remove('fade-out');
                ratioDesc.classList.remove('fade-out');
                ratioTitle.style.opacity = 1;
            }, 500);
        }, 5000);

        // --- KONFIGURASI GRAFIK ---
        Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";
        Chart.defaults.color = '#64748B';

        const ctxMain = document.getElementById('mainChart').getContext('2d');
        let gradBlue = ctxMain.createLinearGradient(0, 0, 0, 350);
        gradBlue.addColorStop(0, 'rgba(79, 70, 229, 0.2)'); gradBlue.addColorStop(1, 'rgba(79, 70, 229, 0.0)');
        let gradRose = ctxMain.createLinearGradient(0, 0, 0, 350);
        gradRose.addColorStop(0, 'rgba(244, 63, 94, 0.2)'); gradRose.addColorStop(1, 'rgba(244, 63, 94, 0.0)');

        new Chart(ctxMain, {
            type: 'line',
            data: {
                labels: @json($chartLabels),
                datasets: [
                    {
                        label: 'Tamu',
                        data: @json($dataTamu),
                        borderColor: '#4F46E5',
                        backgroundColor: gradBlue,
                        borderWidth: 3, pointRadius: 4, fill: true, tension: 0.4
                    },
                    {
                        label: 'SKM',
                        data: @json($dataSurvei),
                        borderColor: '#F43F5E',
                        // Background semi-transparan agar data kecil tetap terlihat
                        backgroundColor: 'rgba(244, 63, 94, 0.1)',
                        borderWidth: 3, pointRadius: 4,
                        fill: true, // Fill True agar grafik SKM terlihat jelas walau rendah
                        tension: 0.4,
                        borderDash: [5, 5]
                    }
                ]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, grid: { borderDash: [4, 4], color: '#F1F5F9' } }, x: { grid: { display: false } } } }
        });

        const ctxDemo = document.getElementById('demoChart').getContext('2d');
        new Chart(ctxDemo, {
            type: 'doughnut',
            data: {
                labels: @json($demoLabels),
                datasets: [{ data: @json($demoData), backgroundColor: ['#4F46E5', '#0EA5E9', '#F59E0B', '#10B981', '#F43F5E'], borderWidth: 0 }]
            },
            options: { responsive: true, maintainAspectRatio: false, cutout: '65%', plugins: { legend: { position: 'right', labels: { boxWidth: 12, font: { size: 11 } } } } }
        });

        const ctxQual = document.getElementById('qualityChart').getContext('2d');
        new Chart(ctxQual, {
            type: 'bar',
            data: {
                labels: @json($qualityLabels),
                datasets: [{ label: 'Kepuasan (%)', data: @json($qualityData), backgroundColor: '#10B981', borderRadius: 4, barThickness: 20 }]
            },
            options: { indexAxis: 'y', responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { x: { beginAtZero: true, max: 100, grid: { color: '#F1F5F9' } }, y: { grid: { display: false } } } }
        });
    </script>
@endpush