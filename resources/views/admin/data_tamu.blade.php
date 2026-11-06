@extends('layouts.admin')

@section('title', 'Data Tamu')
@section('title-header', 'Manajemen Data Tamu')

@push('styles')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            /* Palette Warna Hidup */
            --primary: #4F46E5;
            --primary-dark: #4338CA;
            --secondary: #64748B;
            --success: #10B981;
            --warning: #F59E0B;
            --danger: #EF4444;
            --info: #0EA5E9;
            --bg-body: #F1F5F9;
            
            /* Warna Badge Layanan */
            --color-ukbi: #EFF6FF; --text-ukbi: #1D4ED8; 
            --color-perpus: #ECFDF5; --text-perpus: #047857; 
            --color-ahli: #FAF5FF; --text-ahli: #7E22CE; 
            --color-terjemahan: #FFF7ED; --text-terjemahan: #C2410C; 
            --color-sastra: #FDF2F8; --text-sastra: #BE185D; 
            --color-bipa: #F0FDFA; --text-bipa: #0F766E; 
            --color-magang: #FFFBEB; --text-magang: #B45309; 
            --color-lain: #F3F4F6; --text-lain: #374151; 
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-body);
            color: #1E293B;
        }

        /* --- CARD MODERN --- */
        .card-modern {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.05);
            border: 1px solid #E2E8F0;
            overflow: hidden;
        }

        /* --- TOOLBAR --- */
        .toolbar-container {
            padding: 1.5rem 2rem;
            background: #fff;
            border-bottom: 1px solid #F1F5F9;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .search-wrapper {
            position: relative;
            width: 320px;
        }
        .search-wrapper input {
            width: 100%;
            padding: 12px 12px 12px 45px;
            border-radius: 12px;
            border: 1px solid #E2E8F0;
            background: #F8FAFC;
            transition: all 0.3s;
        }
        .search-wrapper input:focus {
            background: #fff;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
            outline: none;
        }
        .search-wrapper i {
            position: absolute; left: 15px; top: 50%;
            transform: translateY(-50%); color: #94A3B8;
        }

        /* --- BUTTONS --- */
        .btn-modern {
            padding: 10px 20px; border-radius: 10px; font-weight: 600; font-size: 0.9rem;
            border: none; display: inline-flex; align-items: center; gap: 8px;
            transition: all 0.2s; cursor: pointer;
        }
        .btn-filter { background: #fff; border: 1px solid #E2E8F0; color: #475569; }
        .btn-filter:hover { background: #F8FAFC; border-color: #94A3B8; }
        .btn-filter-active { background: #EEF2FF; border-color: var(--primary); color: var(--primary); }
        
        .btn-export {
            background: linear-gradient(135deg, #10B981 0%, #059669 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }
        .btn-export:hover { transform: translateY(-2px); box-shadow: 0 6px 15px rgba(16, 185, 129, 0.4); color: white; }

        /* --- TABLE --- */
        .table-responsive { overflow-x: auto; }
        .table-custom { width: 100%; border-collapse: separate; border-spacing: 0; }
        
        .table-custom th {
            text-align: left; padding: 1.2rem 1.5rem;
            font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.8px;
            color: #64748B; background: #F8FAFC; border-bottom: 2px solid #E2E8F0;
            font-weight: 700;
        }
        .table-custom td {
            padding: 1.2rem 1.5rem; vertical-align: middle;
            border-bottom: 1px solid #F1F5F9; font-size: 0.95rem; color: #334155;
        }
        .table-custom tr:hover td { background-color: #FAFAFF; }

        /* --- BADGES LAYANAN --- */
        .badge-layanan {
            padding: 8px 14px; border-radius: 10px;
            font-weight: 600; font-size: 0.8rem;
            display: inline-flex; align-items: center; gap: 6px;
            line-height: 1.4; letter-spacing: 0.3px;
        }
        .b-ukbi { background: var(--color-ukbi); color: var(--text-ukbi); border: 1px solid rgba(29, 78, 216, 0.1); }
        .b-perpus { background: var(--color-perpus); color: var(--text-perpus); border: 1px solid rgba(4, 120, 87, 0.1); }
        .b-ahli { background: var(--color-ahli); color: var(--text-ahli); border: 1px solid rgba(126, 34, 206, 0.1); }
        .b-terjemahan { background: var(--color-terjemahan); color: var(--text-terjemahan); border: 1px solid rgba(194, 65, 12, 0.1); }
        .b-sastra { background: var(--color-sastra); color: var(--text-sastra); border: 1px solid rgba(190, 24, 93, 0.1); }
        .b-bipa { background: var(--color-bipa); color: var(--text-bipa); border: 1px solid rgba(15, 118, 110, 0.1); }
        .b-magang { background: var(--color-magang); color: var(--text-magang); border: 1px solid rgba(180, 83, 9, 0.1); }
        .b-lain { background: var(--color-lain); color: var(--text-lain); border: 1px solid #E5E7EB; }

        /* --- MODAL (PERBAIKAN HEADER & RAPI) --- */
        .modal-content-premium {
            border: none; border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            overflow: hidden;
        }
        
        .modal-header-premium {
            background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
            padding: 1.25rem 1.5rem; /* Padding pas agar sejajar */
            border: none;
            color: white;
            display: flex;
            align-items: center; /* KUNCI AGAR SEJAJAR VERTIKAL */
            justify-content: space-between;
        }
        
        .modal-header-premium .modal-title {
            font-weight: 700; 
            font-size: 1.25rem;
            margin-bottom: 0; /* Hilangkan margin bawaan bootstrap agar tidak turun */
            line-height: 1.5;
        }
        
        .modal-header-premium .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
            opacity: 0.8;
            margin: 0; /* Reset margin */
            padding: 0;
            width: 1em; height: 1em;
        }
        .modal-header-premium .btn-close:hover { opacity: 1; }

        .modal-body-premium { padding: 2rem; background: #fff; }

        .form-label-premium {
            font-size: 0.85rem; font-weight: 700; color: #475569;
            margin-bottom: 0.5rem; display: flex; align-items: center; gap: 6px;
        }
        .form-label-premium i { color: var(--primary); }

        .form-control-premium, .form-select-premium {
            padding: 12px 16px; border-radius: 12px;
            border: 2px solid #E2E8F0; background: #F8FAFC;
            font-size: 0.95rem; color: #1E293B; width: 100%; transition: all 0.2s;
        }
        .form-control-premium:focus, .form-select-premium:focus {
            background: #fff; border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); outline: none;
        }

        .btn-save-premium {
            width: 100%; padding: 14px; border-radius: 12px;
            background: linear-gradient(135deg, #4F46E5 0%, #4338CA 100%);
            color: white; font-weight: 700; border: none;
            box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
            margin-top: 1rem; transition: all 0.3s;
        }
        .btn-save-premium:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(79, 70, 229, 0.4); }

        /* Buttons Action */
        .btn-icon {
            width: 38px; height: 38px; border-radius: 10px; border: none;
            display: flex; align-items: center; justify-content: center;
            transition: 0.2s; cursor: pointer;
        }
        .btn-edit { background: #EEF2FF; color: var(--primary); }
        .btn-edit:hover { background: var(--primary); color: white; }
        .btn-delete { background: #FEF2F2; color: var(--danger); }
        .btn-delete:hover { background: var(--danger); color: white; }

    </style>
@endpush

@section('content')
    <div class="card-modern">
        
        <div class="toolbar-container">
            <div class="d-flex align-items-center gap-3">
                <h4 class="mb-0 fw-bold" style="color: #1E293B;">Manajemen Tamu</h4>
                
                @if(request('start_date') || request('end_date'))
                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2 rounded-pill">
                        <i class="fas fa-calendar-alt me-1"></i> Filter Aktif
                        <a href="{{ route('dashboard.tamu') }}" class="ms-2 text-danger"><i class="fas fa-times"></i></a>
                    </span>
                @endif
            </div>

            <div class="d-flex gap-2 flex-wrap">
                <form action="{{ route('dashboard.tamu') }}" method="GET" class="d-flex align-items-center gap-2">
                    @if(request('start_date')) <input type="hidden" name="start_date" value="{{ request('start_date') }}"> @endif
                    @if(request('end_date')) <input type="hidden" name="end_date" value="{{ request('end_date') }}"> @endif
                    <div class="search-wrapper">
                        <i class="fas fa-search"></i>
                        <input type="text" name="search" placeholder="Cari nama, email, atau layanan..." value="{{ request('search') }}">
                    </div>
                </form>

                <button type="button" class="btn-modern btn-filter {{ (request('start_date')) ? 'btn-filter-active' : '' }}" data-bs-toggle="modal" data-bs-target="#filterModal">
                    <i class="fas fa-sliders-h"></i> Filter
                </button>

                <button type="button" class="btn-modern btn-export" id="btn-export-tamu">
                    <i class="fas fa-file-excel fa-lg"></i> Unduh Excel
                </button>
            </div>
        </div>

        <div class="px-4 mt-3">
            @if(session('success'))
                <div class="alert alert-success border-0 bg-success-subtle text-success rounded-3 py-3 d-flex align-items-center shadow-sm">
                    <i class="fas fa-check-circle fa-lg me-3"></i> 
                    <div class="fw-bold">{{ session('success') }}</div>
                </div>
            @endif
        </div>

        <div class="table-responsive">
            <table class="table-custom" id="tabel-tamu">
                <thead>
                    <tr>
                        <th class="ps-4">Nama Tamu</th>
                        <th>Kontak & Email</th>
                        <th>Waktu</th>
                        <th>Layanan</th>
                        <th class="text-center pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dataTamu as $tamu)
                        <tr>
                            <td class="ps-4">
                                <span class="fw-bold text-dark fs-6">{{ $tamu->nama }}</span>
                            </td>

                            <td>
                                <div class="d-flex flex-column gap-1">
                                    @if($tamu->telepon)
                                        <div class="small text-dark fw-medium">
                                            <i class="fab fa-whatsapp text-success me-2"></i>{{ $tamu->telepon }}
                                        </div>
                                    @endif
                                    @if($tamu->email)
                                        <div class="small text-muted" style="font-family: monospace;">
                                            <i class="far fa-envelope text-primary me-2"></i>{{ $tamu->email }}
                                        </div>
                                    @endif
                                    @if(!$tamu->telepon && !$tamu->email) <span class="text-muted small">-</span> @endif
                                </div>
                            </td>

                            <td>
                                <div class="fw-bold text-dark">{{ \Carbon\Carbon::parse($tamu->tanggal)->translatedFormat('d F Y') }}</div>
                                <div class="small text-muted fw-medium">{{ \Carbon\Carbon::parse($tamu->waktu)->format('H:i') }} WIB</div>
                            </td>

                            <td>
                                @php
                                    $l = $tamu->layanan;
                                    $cls = 'b-lain'; // Default Gray
                                    $icon = 'fa-circle';

                                    if(stripos($l, 'UKBI')!==false) { $cls='b-ukbi'; $icon='fa-language'; }
                                    elseif(stripos($l, 'Perpustakaan')!==false) { $cls='b-perpus'; $icon='fa-book'; }
                                    elseif(stripos($l, 'Ahli')!==false) { $cls='b-ahli'; $icon='fa-user-tie'; }
                                    elseif(stripos($l, 'Terjemahan')!==false || stripos($l, 'Penerjemahan')!==false) { $cls='b-terjemahan'; $icon='fa-exchange-alt'; }
                                    elseif(stripos($l, 'Sastra')!==false || stripos($l, 'Literasi')!==false) { $cls='b-sastra'; $icon='fa-feather-alt'; }
                                    elseif(stripos($l, 'BIPA')!==false) { $cls='b-bipa'; $icon='fa-globe'; }
                                    elseif(stripos($l, 'Magang')!==false || stripos($l, 'PKS')!==false) { $cls='b-magang'; $icon='fa-briefcase'; }
                                @endphp
                                <span class="badge-layanan {{ $cls }}">
                                    <i class="fas {{ $icon }} fa-sm opacity-50"></i> {{ $l }}
                                </span>
                            </td>

                            <td class="text-center pe-4">
                                <div class="d-flex justify-content-center gap-2">
                                    <button class="btn-icon btn-edit btn-edit-tamu" data-id="{{ $tamu->id }}" title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <button class="btn-icon btn-delete" 
                                        data-bs-toggle="modal" data-bs-target="#deleteModal" 
                                        data-url="{{ route('dashboard.tamu.destroy', $tamu) }}" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center p-5">
                                <div class="opacity-50 mb-2"><i class="fas fa-folder-open fa-3x text-gray"></i></div>
                                <p class="text-muted fw-bold">Belum ada data tamu.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="p-4 border-top">
            {{ $dataTamu->appends(request()->query())->links() }}
        </div>
    </div>

    <div class="modal fade" id="filterModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-premium">
                <div class="modal-header-premium">
                    <h5 class="modal-title">Filter Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body-premium">
                    <form action="{{ route('dashboard.tamu') }}" method="GET">
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label-premium"><i class="far fa-calendar"></i> Dari Tanggal</label>
                                <input type="date" name="start_date" class="form-control-premium" value="{{ request('start_date') }}" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label-premium"><i class="far fa-calendar-check"></i> Sampai Tanggal</label>
                                <input type="date" name="end_date" class="form-control-premium" value="{{ request('end_date') }}" required>
                            </div>
                        </div>
                        <button type="submit" class="btn-save-premium">Terapkan Filter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tamuModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-premium">
                <div class="modal-header-premium">
                    <h5 class="modal-title" id="tamuModalLabel">Edit Data Tamu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                
                <div class="modal-body-premium">
                    <form id="tamuForm" method="POST" action="">
                        @csrf <input type="hidden" name="_method" id="formMethod" value="PUT">
                        
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label-premium"><i class="far fa-calendar-alt"></i> Tanggal</label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control-premium" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label-premium"><i class="far fa-clock"></i> Jam</label>
                                <input type="time" name="waktu" id="waktu" class="form-control-premium" required>
                            </div>

                            <div class="col-12">
                                <label class="form-label-premium"><i class="far fa-user"></i> Nama Lengkap</label>
                                <input type="text" name="nama" id="nama" class="form-control-premium" placeholder="Nama Lengkap" required>
                            </div>

                            <div class="col-6">
                                <label class="form-label-premium"><i class="fas fa-phone"></i> No. Telepon</label>
                                <input type="text" name="telepon" id="telepon" class="form-control-premium" placeholder="08xxx">
                            </div>
                            <div class="col-6">
                                <label class="form-label-premium"><i class="far fa-envelope"></i> Email</label>
                                <input type="email" name="email" id="email" class="form-control-premium" placeholder="email@contoh.com">
                            </div>

                            <div class="col-12">
                                <label class="form-label-premium"><i class="fas fa-concierge-bell"></i> Jenis Layanan</label>
                                <select id="layanan-select" class="form-select-premium">
                                    <option value="" disabled selected>Pilih Layanan...</option>
                                    <option value="Uji Kemahiran Berbahasa Indonesia (UKBI)">Uji Kemahiran Berbahasa Indonesia (UKBI)</option>
                                    <option value="Ahli Bahasa">Ahli Bahasa</option>
                                    <option value="Perpustakaan">Perpustakaan</option>
                                    <option value="Penerjemahan">Penerjemahan</option>
                                    <option value="Pemodernan dan Pelindungan Bahasa Sastra">Pemodernan & Pelindungan Sastra</option>
                                    <option value="Kegiatan Literasi">Kegiatan Literasi</option>
                                    <option value="Kegiatan Perkamusan dan Peristilahan">Perkamusan & Peristilahan</option>
                                    <option value="Kegiatan BIPA">Kegiatan BIPA</option>
                                    <option value="Permohonan Kerja Sama (PKS)">Permohonan Kerja Sama (PKS)</option>
                                    <option value="Permohonan Magang">Permohonan Magang</option>
                                    <option value="Peminjaman Aula dan Serambi">Peminjaman Aula</option>
                                    <option value="Audiensi">Audiensi</option>
                                    <option value="Lainnya">Lainnya (Manual)</option>
                                </select>
                            </div>

                            <div class="col-12" id="layanan-lainnya-wrapper" style="display: none;">
                                <label class="form-label-premium text-primary">Tulis Layanan Lainnya</label>
                                <input type="text" id="input-lainnya" class="form-control-premium" style="border-color: var(--primary);" placeholder="Ketik disini...">
                            </div>

                            <input type="hidden" name="layanan" id="layanan-final">
                        </div>

                        <button type="submit" class="btn-save-premium" id="submitButton">
                            Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-premium text-center p-4">
                <div class="mb-3">
                    <div style="width: 80px; height: 80px; background: #FEF2F2; color: #EF4444; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                        <i class="fas fa-trash-alt fa-3x"></i>
                    </div>
                </div>
                <h4 class="fw-bold text-dark">Hapus Data Ini?</h4>
                <p class="text-muted">Data yang dihapus tidak dapat dikembalikan. Lanjutkan?</p>
                <div class="d-flex justify-content-center gap-3 mt-4">
                    <button type="button" class="btn btn-light px-4 py-2 rounded-3 fw-bold" data-bs-dismiss="modal">Batal</button>
                    <form id="deleteForm" method="POST" action="">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger px-4 py-2 rounded-3 fw-bold shadow-sm">Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            
            // --- VARIABEL ---
            const tamuForm = document.getElementById('tamuForm');
            const formMethod = document.getElementById('formMethod');
            const layananSelect = document.getElementById('layanan-select');
            const layananLainnyaWrapper = document.getElementById('layanan-lainnya-wrapper');
            const inputLainnya = document.getElementById('input-lainnya');
            const layananFinal = document.getElementById('layanan-final');

            // --- 1. LOGIKA LAYANAN ---
            function checkLayanan() {
                if (!layananSelect) return;
                if (layananSelect.value === 'Lainnya') { 
                    layananLainnyaWrapper.style.display = 'block'; 
                    inputLainnya.setAttribute('required', 'required'); 
                } else { 
                    layananLainnyaWrapper.style.display = 'none'; 
                    inputLainnya.removeAttribute('required'); 
                    inputLainnya.value = ''; 
                }
            }
            if(layananSelect) layananSelect.addEventListener('change', checkLayanan);

            // --- 2. SUBMIT FORM ---
            if(tamuForm) {
                tamuForm.addEventListener('submit', function(e) {
                    if (layananSelect && layananSelect.value === 'Lainnya') { 
                        if(layananFinal) layananFinal.value = inputLainnya.value; 
                    } else { 
                        if(layananFinal) layananFinal.value = layananSelect.value; 
                    }
                });
            }

            // --- 3. EDIT DATA ---
            document.body.addEventListener('click', function(e) {
                const btn = e.target.closest('.btn-edit-tamu');
                if(btn) {
                    e.preventDefault();
                    const tamuId = btn.getAttribute('data-id');
                    
                    const modalEl = document.getElementById('tamuModal');
                    const bsModal = new bootstrap.Modal(modalEl);
                    const submitButton = document.getElementById('submitButton');

                    if(tamuForm) tamuForm.reset();
                    if(submitButton) submitButton.innerText = "Simpan Perubahan";
                    if(tamuForm) tamuForm.action = `/dashboard/tamu/${tamuId}`;
                    if(formMethod) formMethod.value = 'PUT';

                    fetch(`/dashboard/tamu/${tamuId}`)
                        .then(res => res.json())
                        .then(data => {
                            // Isi Data
                            if(document.getElementById('nama')) document.getElementById('nama').value = data.nama;
                            if(document.getElementById('tanggal')) document.getElementById('tanggal').value = data.tanggal;
                            if(data.waktu && document.getElementById('waktu')) document.getElementById('waktu').value = data.waktu.substring(0, 5);
                            if(document.getElementById('telepon')) document.getElementById('telepon').value = data.telepon || '';
                            if(document.getElementById('email')) document.getElementById('email').value = data.email || '';

                            // Isi Layanan
                            if(layananSelect) {
                                let optionExists = [...layananSelect.options].some(o => o.value === data.layanan);
                                if (optionExists) { 
                                    layananSelect.value = data.layanan; 
                                    if(inputLainnya) inputLainnya.value = ''; 
                                } else { 
                                    layananSelect.value = 'Lainnya'; 
                                    if(inputLainnya) inputLainnya.value = data.layanan; 
                                }
                                checkLayanan();
                            }
                            bsModal.show();
                        })
                        .catch(err => { console.error(err); alert("Gagal mengambil data."); });
                }
            });

            // --- 4. HAPUS DATA ---
            const deleteModal = document.getElementById('deleteModal');
            if(deleteModal) {
                deleteModal.addEventListener('show.bs.modal', function (event) {
                    const button = event.relatedTarget;
                    document.getElementById('deleteForm').action = button.getAttribute('data-url');
                });
            }

            // --- 5. EXPORT EXCEL ---
            const btnExport = document.getElementById('btn-export-tamu');
            if(btnExport) {
                btnExport.addEventListener('click', function () {
                    const table = document.getElementById("tabel-tamu");
                    const rows = table.querySelectorAll("tr");
                    let csvContent = "";
                    rows.forEach((row) => {
                        let rowData = [];
                        const cols = row.querySelectorAll("td, th");
                        // Ambil semua kolom kecuali kolom terakhir (Aksi)
                        for (let i = 0; i < cols.length - 1; i++) { 
                            let text = cols[i].innerText.replace(/(\r\n|\n|\r)/gm, " ").trim().replace(/"/g, '""');
                            rowData.push(`"${text}"`);
                        }
                        csvContent += rowData.join(",") + "\n";
                    });
                    const now = new Date().toISOString().split('T')[0];
                    const blob = new Blob(["\uFEFF" + csvContent], { type: "text/csv;charset=utf-8;" });
                    const link = document.createElement("a");
                    link.href = URL.createObjectURL(blob);
                    link.download = `Data_Tamu_${now}.csv`;
                    link.click();
                });
            }
        });
    </script>
@endpush