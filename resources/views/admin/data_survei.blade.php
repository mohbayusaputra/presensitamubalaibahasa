@extends('layouts.admin')

@section('title', 'Data Survei')
@section('title-header', 'Manajemen Survei Kepuasan')

@push('styles')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4F46E5;
            --primary-light: #EEF2FF;
            --bg-body: #F8FAFC;
            --text-main: #0F172A;
            --text-sec: #64748B;
            --border: #E2E8F0;
        }

        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--bg-body); color: var(--text-main); }

        /* --- 1. CARD & TOOLBAR --- */
        .card-modern {
            background: white; border-radius: 20px;
            box-shadow: 0 10px 40px -10px rgba(0,0,0,0.05);
            border: 1px solid var(--border); overflow: hidden;
        }

        .toolbar-area {
            padding: 1.5rem; border-bottom: 1px solid var(--border);
            display: flex; justify-content: space-between; align-items: center; gap: 1rem; flex-wrap: wrap;
            background: #fff;
        }

        /* --- 2. INPUTS & BUTTONS --- */
        .search-box { position: relative; width: 320px; }
        .search-box input {
            width: 100%; padding: 12px 12px 12px 45px; border-radius: 12px;
            border: 1px solid var(--border); background: var(--bg-body); transition: 0.3s;
        }
        .search-box input:focus { background: white; border-color: var(--primary); outline: none; box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1); }
        .search-box i { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: #94A3B8; }

        .btn-custom {
            padding: 10px 20px; border-radius: 10px; font-weight: 600; font-size: 0.9rem;
            border: 1px solid transparent; display: inline-flex; align-items: center; gap: 8px;
            transition: all 0.2s; cursor: pointer;
        }
        .btn-filter { background: white; border-color: var(--border); color: var(--text-sec); }
        .btn-filter:hover { background: var(--bg-body); border-color: #CBD5E1; color: var(--text-main); }
        .btn-filter.active { background: var(--primary-light); border-color: var(--primary); color: var(--primary); }
        
        .btn-excel { background: #10B981; color: white; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2); }
        .btn-excel:hover { background: #059669; transform: translateY(-2px); color: white; }

        /* --- 3. TABLE STYLING --- */
        .table-responsive { overflow-x: auto; }
        .table-styled { width: 100%; border-collapse: separate; border-spacing: 0; }
        
        .table-styled th {
            background: #F8FAFC; color: #64748B; font-size: 0.75rem; text-transform: uppercase;
            letter-spacing: 0.5px; font-weight: 700; padding: 1.2rem 1.5rem;
            border-bottom: 1px solid var(--border); text-align: left;
        }
        .table-styled td {
            padding: 1.2rem 1.5rem; vertical-align: middle; border-bottom: 1px solid var(--border);
            font-size: 0.95rem; color: var(--text-main); background: white;
        }
        .table-styled tr:hover td { background-color: #F1F5F9; }

        /* Table Components */
        .user-avatar {
            width: 40px; height: 40px; border-radius: 10px;
            background: var(--primary-light); color: var(--primary);
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 1.1rem;
        }
        
        .badge-soft { padding: 6px 12px; border-radius: 8px; font-weight: 600; font-size: 0.8rem; display: inline-flex; align-items: center; gap: 5px; }
        .badge-gray { background: #F1F5F9; color: #475569; }

        /* WARNA BADGE LAYANAN */
        .bg-soft-blue   { background: #E0F2FE; color: #0284C7; border: 1px solid #BAE6FD; }
        .bg-soft-green  { background: #DCFCE7; color: #16A34A; border: 1px solid #BBF7D0; }
        .bg-soft-purple { background: #F3E8FF; color: #9333EA; border: 1px solid #E9D5FF; }
        .bg-soft-orange { background: #FFEDD5; color: #EA580C; border: 1px solid #FED7AA; }
        .bg-soft-pink   { background: #FCE7F3; color: #DB2777; border: 1px solid #FBCFE8; }
        .bg-soft-teal   { background: #CCFBF1; color: #0D9488; border: 1px solid #99F6E4; }
        .bg-soft-indigo { background: #E0E7FF; color: #4F46E5; border: 1px solid #C7D2FE; }
        .bg-soft-gray   { background: #F1F5F9; color: #64748B; border: 1px solid #E2E8F0; }

        /* Actions */
        .action-btn {
            width: 36px; height: 36px; border-radius: 8px; border: none;
            display: flex; align-items: center; justify-content: center;
            transition: 0.2s; cursor: pointer; color: #64748B; background: transparent;
        }
        .action-btn:hover { background: #E2E8F0; color: #0F172A; }
        .action-btn.view { color: var(--primary); background: var(--primary-light); }
        .action-btn.view:hover { background: var(--primary); color: white; }
        .action-btn.delete:hover { background: #FEE2E2; color: #EF4444; }

        /* --- 4. MODAL DESIGN (HERO STYLE) --- */
        .modal-premium { border: none; border-radius: 24px; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); }
        
        .modal-header-hero {
            background: linear-gradient(135deg, #4F46E5 0%, #818CF8 100%);
            padding: 1.5rem 2rem; color: white; border: none;
            display: flex; align-items: center; justify-content: space-between;
        }
        
        .modal-title-wrapper { display: flex; flex-direction: column; justify-content: center; }
        .modal-title-hero { font-weight: 800; font-size: 1.25rem; margin: 0; line-height: 1.2; }
        .modal-subtitle { font-size: 0.85rem; opacity: 0.9; margin: 2px 0 0 0; font-weight: 500; }
        
        .btn-close-white { filter: invert(1) grayscale(100%) brightness(200%); opacity: 0.8; margin: 0; width: 1.5rem; height: 1.5rem; }
        .btn-close-white:hover { opacity: 1; }

        .detail-container { padding: 2rem; display: grid; grid-template-columns: 350px 1fr; gap: 2rem; }
        @media (max-width: 992px) { .detail-container { grid-template-columns: 1fr; } }

        /* Data Card */
        .data-card { background: #F8FAFC; border-radius: 16px; padding: 1.5rem; border: 1px solid var(--border); height: 100%; }
        .data-item { display: flex; align-items: center; gap: 15px; margin-bottom: 1.2rem; }
        .icon-square { width: 45px; height: 45px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; flex-shrink: 0; }
        .ic-user { background: #DBEAFE; color: #1E40AF; }
        .ic-email { background: #E0E7FF; color: #3730A3; }
        .ic-job { background: #FEF3C7; color: #92400E; }
        .ic-edu { background: #D1FAE5; color: #065F46; }
        .ic-serv { background: #FAE8FF; color: #86198F; }
        .ic-time { background: #F1F5F9; color: #475569; }
        .data-content h6 { font-size: 0.75rem; color: #64748B; margin: 0; text-transform: uppercase; font-weight: 700; }
        .data-content p { font-size: 1rem; color: #0F172A; margin: 2px 0 0 0; font-weight: 600; }

        /* Questions (Right) */
        .q-wrapper { display: flex; flex-direction: column; gap: 10px; }
        .q-card { background: white; border: 1px solid var(--border); border-radius: 12px; padding: 12px 16px; display: flex; align-items: flex-start; justify-content: space-between; gap: 1rem; transition: 0.2s; }
        .q-number { background: var(--primary-light); color: var(--primary); width: 28px; height: 28px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.8rem; flex-shrink: 0; margin-top: 2px; }
        .q-text { font-size: 0.95rem; color: #334155; line-height: 1.5; flex: 1; }
        
        .q-grade { padding: 6px 12px; border-radius: 8px; font-weight: 700; font-size: 0.85rem; white-space: nowrap; border: 1px solid transparent; }
        
        /* === WARNA SCORE 1-4 (FIXED) === */
        .score-1-bad { background: #FEF2F2; color: #991B1B; border-color: #FECACA; } /* Merah */
        .score-2-poor { background: #FFF7ED; color: #9A3412; border-color: #FED7AA; } /* Orange */
        .score-3-good { background: #EFF6FF; color: #1E40AF; border-color: #BFDBFE; } /* Biru */
        .score-4-excellent { background: #F0FDF4; color: #166534; border-color: #BBF7D0; } /* Hijau */

        .saran-card { background: #FFFBEB; border: 1px solid #FCD34D; border-radius: 12px; padding: 1.5rem; margin-top: 1.5rem; position: relative; }
        .saran-icon { position: absolute; top: -15px; left: 20px; background: #F59E0B; color: white; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; }

        /* --- 5. MODAL FILTER (SAMA DENGAN DETAIL) --- */
        .modal-filter-body { padding: 2rem; background: #fff; }
        .filter-tabs { display: flex; gap: 10px; background: #F1F5F9; padding: 5px; border-radius: 12px; margin-bottom: 2rem; }
        .filter-tab-btn { flex: 1; border: none; background: transparent; padding: 12px; border-radius: 8px; font-weight: 700; color: #64748B; transition: 0.2s; font-size: 0.9rem; }
        .filter-tab-btn.active { background: white; color: var(--primary); box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }
        .filter-group { margin-bottom: 1.5rem; }
        .filter-label { font-weight: 700; color: #475569; margin-bottom: 8px; display: block; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; }
        .filter-input-wrapper { position: relative; }
        .filter-input-wrapper i { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--primary); font-size: 1.1rem; }
        .filter-input { width: 100%; padding: 14px 14px 14px 48px; border-radius: 12px; border: 1px solid #CBD5E1; background: #F8FAFC; font-size: 1rem; color: #334155; font-weight: 500; }
        .filter-input:focus { background: white; border-color: var(--primary); outline: none; box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); }
        .btn-apply { width: 100%; padding: 14px; background: var(--primary); color: white; border-radius: 12px; font-weight: 700; border: none; font-size: 1rem; transition: 0.2s; box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3); }
        .btn-apply:hover { background: #4338CA; transform: translateY(-2px); }
    </style>
@endpush

@section('content')
    <div class="card-modern">
        
        <div class="toolbar-area">
            <div>
                <h4 class="m-0 fw-bold text-dark">Data Survei</h4>
                <p class="m-0 text-muted small">Kelola data kepuasan masyarakat</p>
                
                @if(request('start_date'))
                    <div class="mt-2">
                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-1 rounded-pill">
                            <i class="fas fa-filter me-1"></i> {{ \Carbon\Carbon::parse(request('start_date'))->format('d M') }} - {{ \Carbon\Carbon::parse(request('end_date'))->format('d M Y') }}
                            <a href="{{ route('dashboard.survei') }}" class="ms-2 text-danger"><i class="fas fa-times"></i></a>
                        </span>
                    </div>
                @endif
            </div>

            <div class="d-flex gap-2 flex-wrap">
                <form action="{{ route('dashboard.survei') }}" method="GET" class="d-flex align-items-center gap-2">
                    @if(request('start_date')) <input type="hidden" name="start_date" value="{{ request('start_date') }}"> @endif
                    @if(request('end_date')) <input type="hidden" name="end_date" value="{{ request('end_date') }}"> @endif
                    
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" name="search" placeholder="Cari nama, email, saran..." value="{{ request('search') }}">
                    </div>
                </form>

                <button class="btn-custom btn-filter {{ request('start_date') ? 'active' : '' }}" data-bs-toggle="modal" data-bs-target="#filterModal">
                    <i class="fas fa-sliders-h"></i> Filter
                </button>
                <button class="btn-custom btn-excel" id="btn-export-survei">
                    <i class="fas fa-file-excel"></i> Unduh Excel
                </button>
            </div>
        </div>

        <div class="px-4 mt-3">
            @if(session('success'))
                <div class="alert alert-success border-0 bg-green-subtle text-success rounded-3 py-2 px-3 fw-bold">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                </div>
            @endif
        </div>

        <div class="table-responsive">
            <table class="table-styled" id="tabel-survei">
                <thead>
                    <tr>
                        <th class="ps-4">Responden</th>
                        <th>Profil Demografi</th>
                        <th>Jenis Layanan</th>
                        <th>Tanggal (WIB)</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dataSurvei as $survei)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="user-avatar">
                                        {{ substr($survei->nama_lengkap, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark">{{ $survei->nama_lengkap }}</div>
                                        <div class="small text-muted">{{ $survei->email ?? '-' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column gap-1">
                                    <span class="badge-soft badge-gray w-auto align-self-start">
                                        <i class="fas fa-briefcase me-1"></i> {{ $survei->pekerjaan }}
                                    </span>
                                    <div class="small text-muted ps-1 d-flex align-items-center">
                                        @if($survei->jenis_kelamin == 'Laki-laki') 
                                            <i class="fas fa-mars text-primary me-1"></i> Laki-laki 
                                        @else 
                                            <i class="fas fa-venus text-danger me-1"></i> Perempuan 
                                        @endif
                                        <span class="mx-2 text-muted opacity-50">|</span>
                                        <i class="fas fa-graduation-cap text-success me-1"></i> {{ $survei->pendidikan }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                @php
                                    $l = $survei->jenis_layanan;
                                    $cls = 'bg-soft-gray';
                                    if(stripos($l, 'UKBI')!==false) $cls='bg-soft-blue';
                                    elseif(stripos($l, 'Perpustakaan')!==false) $cls='bg-soft-green';
                                    elseif(stripos($l, 'Ahli')!==false) $cls='bg-soft-purple';
                                    elseif(stripos($l, 'Terjemahan')!==false || stripos($l, 'Penerjemahan')!==false) $cls='bg-soft-orange';
                                    elseif(stripos($l, 'Sastra')!==false || stripos($l, 'Literasi')!==false) $cls='bg-soft-pink';
                                    elseif(stripos($l, 'BIPA')!==false) $cls='bg-soft-teal';
                                    elseif(stripos($l, 'Magang')!==false || stripos($l, 'PKS')!==false) $cls='bg-soft-indigo';
                                @endphp
                                <span class="badge-soft {{ $cls }}">
                                    <i class="fas fa-concierge-bell me-2 opacity-50"></i> {{ $l }}
                                </span>
                            </td>
                            <td>
                                <div class="fw-bold">{{ \Carbon\Carbon::parse($survei->created_at)->setTimezone('Asia/Jakarta')->format('d M Y') }}</div>
                                <div class="small text-muted">{{ \Carbon\Carbon::parse($survei->created_at)->setTimezone('Asia/Jakarta')->format('H:i') }} WIB</div>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <button class="action-btn view btn-detail-survei" 
                                        data-bs-toggle="modal" data-bs-target="#detailModal"
                                        {{-- Data Attributes Lengkap --}}
                                        data-nama="{{ $survei->nama_lengkap }}"
                                        data-email="{{ $survei->email }}"
                                        data-jk="{{ $survei->jenis_kelamin }}"
                                        data-pekerjaan="{{ $survei->pekerjaan }}"
                                        data-pendidikan="{{ $survei->pendidikan }}"
                                        data-layanan="{{ $survei->jenis_layanan }}"
                                        data-waktu="{{ \Carbon\Carbon::parse($survei->created_at)->setTimezone('Asia/Jakarta')->translatedFormat('l, d F Y - H:i') }} WIB"
                                        data-saran="{{ $survei->saran }}"
                                        data-q1="{{ $survei->q1_kesesuaian_persyaratan }}"
                                        data-q2="{{ $survei->q2_kemudahan_prosedur }}"
                                        data-q3="{{ $survei->q3_kecepatan }}"
                                        data-q4="{{ $survei->q4_kewajaran_biaya }}"
                                        data-q5="{{ $survei->q5_kompetensi }}"
                                        data-q6="{{ $survei->q6_kesesuaian_produk }}"
                                        data-q7="{{ $survei->q7_perilaku }}"
                                        data-q8="{{ $survei->q8_sarpras }}"
                                        data-q9="{{ $survei->q9_pengaduan }}"
                                        title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn delete" 
                                        data-bs-toggle="modal" data-bs-target="#deleteModal" 
                                        data-url="{{ route('dashboard.survei.destroy', $survei->id) }}" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center p-5 text-muted">Belum ada data survei.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="p-4 border-top">{{ $dataSurvei->appends(request()->query())->links() }}</div>
    </div>

    <table id="table-export-full" style="display: none;">
        <thead>
            <tr>
                <th>No</th><th>Waktu</th><th>Nama Lengkap</th><th>Email</th><th>JK</th><th>Pekerjaan</th><th>Pendidikan</th><th>Layanan</th>
                <th>1. Bagaimana kesesuaian persyaratan pelayanan dengan jenis pelayanannya?</th>
                <th>2. Bagaimana kemudahan prosedur pelayanan di Balai Bahasa?</th>
                <th>3. Bagaimana kecepatan petugas dalam memberikan pelayanan?</th>
                <th>4. Bagaimana kewajaran biaya/tarif dalam pelayanan?</th>
                <th>5. Bagaimana kompetensi petugas dalam pelayanan?</th>
                <th>6. Kesesuaian produk pelayanan antara yang tercantum dalam standar dengan hasil yang diberikan?</th>
                <th>7. Bagaimana perilaku petugas terkait kesopanan dan keramahan?</th>
                <th>8. Bagaimana kualitas sarana dan prasarana?</th>
                <th>9. Bagaimana penanganan pengaduan pengguna layanan?</th>
                <th>Saran</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dataSurvei as $survei)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ \Carbon\Carbon::parse($survei->created_at)->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s') }}</td>
                    <td>{{ $survei->nama_lengkap }}</td>
                    <td>{{ $survei->email }}</td><td>{{ $survei->jenis_kelamin }}</td><td>{{ $survei->pekerjaan }}</td>
                    <td>{{ $survei->pendidikan }}</td><td>{{ $survei->jenis_layanan }}</td>
                    <td>{{ $survei->q1_kesesuaian_persyaratan }}</td><td>{{ $survei->q2_kemudahan_prosedur }}</td>
                    <td>{{ $survei->q3_kecepatan }}</td><td>{{ $survei->q4_kewajaran_biaya }}</td>
                    <td>{{ $survei->q5_kompetensi }}</td><td>{{ $survei->q6_kesesuaian_produk }}</td>
                    <td>{{ $survei->q7_perilaku }}</td><td>{{ $survei->q8_sarpras }}</td>
                    <td>{{ $survei->q9_pengaduan }}</td><td>{{ $survei->saran }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="modal fade" id="filterModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 600px;">
            <div class="modal-content modal-premium">
                <div class="modal-header-hero">
                    <div class="modal-title-wrapper">
                        <h5 class="modal-title-hero">Filter Data</h5>
                        <p class="modal-subtitle">Tampilkan data berdasarkan periode waktu.</p>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-filter-body">
                    <ul class="filter-tabs nav nav-pills" id="filterTab">
                        <li class="nav-item flex-fill"><button class="filter-tab-btn w-100 active" id="range-tab" data-bs-toggle="pill" data-bs-target="#pills-range">Rentang Tanggal</button></li>
                        <li class="nav-item flex-fill"><button class="filter-tab-btn w-100" id="month-tab" data-bs-toggle="pill" data-bs-target="#pills-month">Per Bulan</button></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="pills-range">
                            <form action="{{ route('dashboard.survei') }}" method="GET">
                                <div class="row">
                                    <div class="col-6 filter-group">
                                        <label class="filter-label">Dari Tanggal</label>
                                        <div class="filter-input-wrapper">
                                            <i class="far fa-calendar-alt"></i>
                                            <input type="date" name="start_date" class="filter-input" value="{{ request('start_date') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-6 filter-group">
                                        <label class="filter-label">Sampai Tanggal</label>
                                        <div class="filter-input-wrapper">
                                            <i class="far fa-calendar-check"></i>
                                            <input type="date" name="end_date" class="filter-input" value="{{ request('end_date') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn-apply">Terapkan Filter</button>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="pills-month">
                            <form action="{{ route('dashboard.survei') }}" method="GET" id="monthFilterForm">
                                <input type="hidden" name="start_date" id="month_start">
                                <input type="hidden" name="end_date" id="month_end">
                                <div class="filter-group">
                                    <label class="filter-label">Pilih Bulan & Tahun</label>
                                    <div class="filter-input-wrapper">
                                        <i class="far fa-calendar"></i>
                                        <input type="month" id="month_picker" class="filter-input" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn-apply">Terapkan Filter</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content modal-premium">
                <div class="modal-header-hero">
                    <div class="modal-title-wrapper">
                        <h5 class="modal-title-hero">Detail Responden</h5>
                        <p class="modal-subtitle">Rekapitulasi jawaban dan data diri responden.</p>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="detail-container">
                    <div class="data-card">
                        <h5 class="fw-bold text-dark mb-4">Informasi Personal</h5>
                        
                        <div class="data-item"><div class="icon-square ic-user"><i class="fas fa-user"></i></div><div class="data-content"><h6>Nama Lengkap</h6><p id="modal-nama">-</p></div></div>
                        <div class="data-item"><div class="icon-square ic-email"><i class="fas fa-envelope"></i></div><div class="data-content"><h6>Email</h6><p id="modal-email">-</p></div></div>
                        <div class="data-item"><div class="icon-square ic-job"><i class="fas fa-briefcase"></i></div><div class="data-content"><h6>Pekerjaan & JK</h6><p><span id="modal-pekerjaan"></span> <span class="text-muted fw-normal">| <span id="modal-jk"></span></span></p></div></div>
                        <div class="data-item"><div class="icon-square ic-edu"><i class="fas fa-graduation-cap"></i></div><div class="data-content"><h6>Pendidikan</h6><p id="modal-pendidikan">-</p></div></div>
                        <div class="data-item"><div class="icon-square ic-serv"><i class="fas fa-concierge-bell"></i></div><div class="data-content"><h6>Jenis Layanan</h6><p id="modal-layanan" class="text-primary">-</p></div></div>
                        <div class="data-item"><div class="icon-square ic-time"><i class="fas fa-clock"></i></div><div class="data-content"><h6>Waktu Pengisian</h6><p id="modal-waktu" class="fs-6">-</p></div></div>
                    </div>

                    <div>
                        <h5 class="fw-bold text-dark mb-4">Hasil Kuesioner (IKM)</h5>
                        <div class="q-wrapper">
                            <div class="q-card"><div class="d-flex gap-3"><div class="q-number">1</div><div class="q-text">Bagaimana kesesuaian persyaratan pelayanan dengan jenis pelayanannya?</div></div><div class="q-grade" id="m-q1">-</div></div>
                            <div class="q-card"><div class="d-flex gap-3"><div class="q-number">2</div><div class="q-text">Bagaimana kemudahan prosedur pelayanan di Balai Bahasa?</div></div><div class="q-grade" id="m-q2">-</div></div>
                            <div class="q-card"><div class="d-flex gap-3"><div class="q-number">3</div><div class="q-text">Bagaimana kecepatan petugas dalam memberikan pelayanan?</div></div><div class="q-grade" id="m-q3">-</div></div>
                            <div class="q-card"><div class="d-flex gap-3"><div class="q-number">4</div><div class="q-text">Bagaimana kewajaran biaya/tarif dalam pelayanan?</div></div><div class="q-grade" id="m-q4">-</div></div>
                            <div class="q-card"><div class="d-flex gap-3"><div class="q-number">5</div><div class="q-text">Bagaimana kompetensi petugas dalam pelayanan?</div></div><div class="q-grade" id="m-q5">-</div></div>
                            <div class="q-card"><div class="d-flex gap-3"><div class="q-number">6</div><div class="q-text">Kesesuaian produk pelayanan antara yang tercantum dalam standar dengan hasil?</div></div><div class="q-grade" id="m-q6">-</div></div>
                            <div class="q-card"><div class="d-flex gap-3"><div class="q-number">7</div><div class="q-text">Bagaimana perilaku petugas terkait kesopanan dan keramahan?</div></div><div class="q-grade" id="m-q7">-</div></div>
                            <div class="q-card"><div class="d-flex gap-3"><div class="q-number">8</div><div class="q-text">Bagaimana kualitas sarana dan prasarana?</div></div><div class="q-grade" id="m-q8">-</div></div>
                            <div class="q-card"><div class="d-flex gap-3"><div class="q-number">9</div><div class="q-text">Bagaimana penanganan pengaduan pengguna layanan?</div></div><div class="q-grade" id="m-q9">-</div></div>
                        </div>

                        <div class="saran-card">
                            <div class="saran-icon"><i class="fas fa-quote-left"></i></div>
                            <h6 class="fw-bold text-dark">Saran & Masukan</h6>
                            <p class="m-0 text-muted fst-italic" id="modal-saran">Tidak ada saran.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-premium text-center p-5">
                <div class="mb-3"><div style="width: 80px; height: 80px; background: #FEF2F2; color: #EF4444; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;"><i class="fas fa-trash-alt fa-3x"></i></div></div>
                <h4 class="fw-bold text-dark">Hapus Data Ini?</h4>
                <p class="text-muted">Tindakan ini permanen. Data survei akan hilang.</p>
                <div class="d-flex justify-content-center gap-3 mt-4">
                    <button type="button" class="btn-custom btn-filter px-4" data-bs-dismiss="modal">Batal</button>
                    <form id="deleteForm" method="POST" action="">@csrf @method('DELETE')<button type="submit" class="btn-custom bg-danger text-white px-4">Hapus</button></form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            
            // FUNGSI WARNA SCORE 1-4 (LOGIKA FIX & URUT)
            function getScoreClass(text) {
                if(!text) return 'bg-light text-dark border-0';
                const lower = text.toLowerCase().trim();
                
                // SKOR 1 (MERAH): Sangat Buruk / Tidak Ada / Tidak Sesuai
                const s1 = ['tidak sesuai','tidak mudah','tidak cepat','sangat mahal','tidak kompeten','tidak sopan','buruk','tidak ada'];
                if (s1.includes(lower)) return 'score-1-bad';

                // SKOR 2 (ORANGE): Kurang / Cukup Mahal / Ada Rusak
                const s2 = ['kurang sesuai','kurang mudah','kurang cepat','cukup mahal','kurang kompeten','kurang sopan','cukup','ada tapi rusak','ada, tdk berfungsi'];
                if (s2.includes(lower)) return 'score-2-poor';

                // SKOR 3 (BIRU): Baik / Sesuai / Murah / Kurang Maksimal (Q9)
                const s3 = ['sesuai','mudah','cepat','murah','kompeten','sopan & ramah','sopan','baik','kurang maksimal'];
                if (s3.includes(lower)) return 'score-3-good';

                // SKOR 4 (HIJAU): Sangat Baik / Gratis / Dikelola Baik
                const s4 = ['sangat sesuai','sangat mudah','sangat cepat','gratis','sangat kompeten','sangat sopan','sangat baik','dikelola baik'];
                if (s4.includes(lower)) return 'score-4-excellent';

                return '';
            }

            // MODAL DETAIL LOGIC
            const detailModal = document.getElementById('detailModal');
            if(detailModal) {
                detailModal.addEventListener('show.bs.modal', function (event) {
                    const btn = event.relatedTarget;
                    document.getElementById('modal-nama').innerText = btn.getAttribute('data-nama');
                    document.getElementById('modal-email').innerText = btn.getAttribute('data-email') || '-';
                    document.getElementById('modal-jk').innerText = btn.getAttribute('data-jk');
                    document.getElementById('modal-pekerjaan').innerText = btn.getAttribute('data-pekerjaan');
                    document.getElementById('modal-pendidikan').innerText = btn.getAttribute('data-pendidikan');
                    document.getElementById('modal-layanan').innerText = btn.getAttribute('data-layanan');
                    document.getElementById('modal-waktu').innerText = btn.getAttribute('data-waktu');
                    
                    for(let i=1; i<=9; i++) { 
                        const answer = btn.getAttribute('data-q'+i);
                        const el = document.getElementById('m-q'+i);
                        el.innerText = answer;
                        el.className = 'q-grade ' + getScoreClass(answer);
                    }

                    const saran = btn.getAttribute('data-saran');
                    document.getElementById('modal-saran').innerText = (saran && saran !== '-') ? saran : "Tidak ada saran tambahan.";
                });
            }

            // FILTER BULAN
            const monthForm = document.getElementById('monthFilterForm');
            if(monthForm) {
                monthForm.addEventListener('submit', function(e) {
                    e.preventDefault(); 
                    const picker = document.getElementById('month_picker');
                    if(picker.value) {
                        const date = new Date(picker.value);
                        const year = date.getFullYear();
                        const month = date.getMonth() + 1; 
                        const lastDay = new Date(year, month, 0).getDate();
                        const strMonth = String(month).padStart(2,'0');
                        document.getElementById('month_start').value = `${year}-${strMonth}-01`;
                        document.getElementById('month_end').value = `${year}-${strMonth}-${lastDay}`;
                        this.submit(); 
                    } else { alert("Silakan pilih bulan dan tahun terlebih dahulu."); }
                });
            }

            // HAPUS
            const deleteModal = document.getElementById('deleteModal');
            if(deleteModal) {
                deleteModal.addEventListener('show.bs.modal', function (event) {
                    document.getElementById('deleteForm').action = event.relatedTarget.getAttribute('data-url');
                });
            }

            // EXPORT EXCEL
            document.getElementById('btn-export-survei').addEventListener('click', function () {
                const table = document.getElementById("table-export-full");
                const rows = table.querySelectorAll("tr");
                let csvContent = "";
                rows.forEach((row) => {
                    let rowData = [];
                    const cols = row.querySelectorAll("th, td");
                    cols.forEach(col => {
                        let text = col.innerText.replace(/(\r\n|\n|\r)/gm, " ").trim();
                        text = text.replace(/"/g, '""');
                        rowData.push(`"${text}"`);
                    });
                    csvContent += rowData.join(",") + "\n";
                });
                const blob = new Blob(["\uFEFF" + csvContent], { type: "text/csv;charset=utf-8;" });
                const link = document.createElement("a");
                link.href = URL.createObjectURL(blob);
                link.download = `Data_Survei_Lengkap_${new Date().toISOString().split('T')[0]}.csv`;
                link.click();
            });
        });
    </script>
@endpush