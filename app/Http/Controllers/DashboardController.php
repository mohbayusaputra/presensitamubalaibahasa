<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use App\Models\Survei;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // =========================================================================
    // 1. HALAMAN UTAMA DASHBOARD (STATISTIK & GRAFIK)
    // =========================================================================
    public function index()
    {
        $today = Carbon::today();
        $startOfMonth = Carbon::now()->startOfMonth();

        // --- A. DATA POKOK ---
        $tamuHariIni = Tamu::whereDate('tanggal', $today)->count();
        $totalTamu = Tamu::count();
        $surveiHariIni = Survei::whereDate('created_at', $today)->count();
        $totalResponden = Survei::count();

        // --- B. LOGIKA IKM (Indeks Kepuasan Masyarakat) ---
        $bobotNilai = [
            'q1_kesesuaian_persyaratan' => ['Sangat Sesuai' => 4, 'Sesuai' => 3, 'Kurang Sesuai' => 2, 'Tidak Sesuai' => 1],
            'q2_kemudahan_prosedur' => ['Sangat Mudah' => 4, 'Mudah' => 3, 'Kurang Mudah' => 2, 'Tidak Mudah' => 1],
            'q3_kecepatan' => ['Sangat Cepat' => 4, 'Cepat' => 3, 'Kurang Cepat' => 2, 'Tidak Cepat' => 1],
            'q4_kewajaran_biaya' => ['Gratis' => 4, 'Murah' => 3, 'Cukup Mahal' => 2, 'Sangat Mahal' => 1],
            'q5_kompetensi' => ['Sangat Kompeten' => 4, 'Kompeten' => 3, 'Kurang Kompeten' => 2, 'Tidak Kompeten' => 1],
            'q6_kesesuaian_produk' => ['Sangat Sesuai' => 4, 'Sesuai' => 3, 'Kurang Sesuai' => 2, 'Tidak Sesuai' => 1],
            'q7_perilaku' => ['Sangat Sopan' => 4, 'Sopan & Ramah' => 3, 'Kurang Sopan' => 2, 'Tidak Sopan' => 1],
            'q8_sarpras' => ['Sangat Baik' => 4, 'Baik' => 3, 'Cukup' => 2, 'Buruk' => 1],
            'q9_pengaduan' => ['Dikelola baik' => 4, 'Kurang maksimal' => 3, 'Ada tapi rusak' => 2, 'Tidak ada' => 1]
        ];

        $totalSkorSemua = 0;
        $qualityData = [];

        foreach ($bobotNilai as $kolom => $opsi) {
            $skorPerUnsur = 0;
            $rekapJawaban = Survei::select($kolom, DB::raw('count(*) as jumlah'))
                ->groupBy($kolom)->pluck('jumlah', $kolom)->toArray();

            foreach ($opsi as $teksJawaban => $poin) {
                if (isset($rekapJawaban[$teksJawaban])) {
                    $skorPerUnsur += $rekapJawaban[$teksJawaban] * $poin;
                }
            }
            $totalSkorSemua += $skorPerUnsur;
            $maxSkor = $totalResponden * 4;
            $qualityData[] = $maxSkor > 0 ? round(($skorPerUnsur / $maxSkor) * 100, 1) : 0;
        }

        $totalMaxIKM = $totalResponden * 9 * 4;
        $ikmScore = $totalMaxIKM > 0 ? round(($totalSkorSemua / $totalMaxIKM) * 100, 2) : 0;

        $mutu = 'D';
        $predikat = 'Tidak Baik';
        if ($ikmScore >= 88.31) {
            $mutu = 'A';
            $predikat = 'Sangat Baik';
        } elseif ($ikmScore >= 76.61) {
            $mutu = 'B';
            $predikat = 'Baik';
        } elseif ($ikmScore >= 65.00) {
            $mutu = 'C';
            $predikat = 'Kurang Baik';
        }

        // --- C. KONVERSI & RASIO ---
        // Konversi (%): Berapa persen tamu yang mengisi survei
        $participationRate = $totalTamu > 0 ? round(($totalResponden / $totalTamu) * 100, 1) : 0;
        // Rasio (Angka): 1 Survei mewakili berapa Tamu
        $tamuPerSurvei = $totalResponden > 0 ? round($totalTamu / $totalResponden, 1) : 0;

        // --- D. GRAFIK TREN (FIXED QUARTER / TRIWULAN) ---
        // Menentukan Triwulan berdasarkan bulan saat ini
        $currentMonth = $today->month;
        $startQuarterMonth = floor(($currentMonth - 1) / 3) * 3 + 1;

        $quarterStart = Carbon::createFromDate($today->year, $startQuarterMonth, 1)->startOfDay();
        $quarterEnd = $quarterStart->copy()->addMonths(3)->subDay()->endOfDay();
        $quarterName = $quarterStart->translatedFormat('F') . ' - ' . $quarterEnd->translatedFormat('F Y');

        $chartLabels = [];
        $dataTamu = [];
        $dataSurvei = [];

        $period = $quarterStart->copy();

        while ($period->lte($quarterEnd)) {
            $weekStart = $period->copy()->startOfDay();
            $weekEnd = $period->copy()->addDays(6)->endOfDay();

            if ($weekEnd->gt($quarterEnd)) {
                $weekEnd = $quarterEnd->copy()->endOfDay();
            }

            $chartLabels[] = $weekStart->format('d') . '-' . $weekEnd->format('d M');

            // Query Data (Format DateTime String agar akurat)
            $dataTamu[] = Tamu::whereBetween('tanggal', [$weekStart->format('Y-m-d H:i:s'), $weekEnd->format('Y-m-d H:i:s')])->count();
            $dataSurvei[] = Survei::whereBetween('created_at', [$weekStart->format('Y-m-d H:i:s'), $weekEnd->format('Y-m-d H:i:s')])->count();

            $period->addWeek();
        }

        // --- E. DATA PENDUKUNG ---
        $demografiPekerjaan = Survei::select('pekerjaan', DB::raw('count(*) as total'))
            ->groupBy('pekerjaan')->orderByDesc('total')->get();
        $demoLabels = $demografiPekerjaan->pluck('pekerjaan');
        $demoData = $demografiPekerjaan->pluck('total');

        $recentFeedback = Survei::whereNotNull('saran')->where('saran', '!=', '-')->latest()->take(4)->get();
        $tamuTerbaru = Tamu::latest()->take(6)->get();
        $qualityLabels = ['Persyaratan', 'Prosedur', 'Kecepatan', 'Biaya', 'Kompetensi', 'Produk', 'Perilaku', 'Sarpras', 'Pengaduan'];

        return view('admin.dashboard', compact(
            'tamuHariIni',
            'totalTamu',
            'surveiHariIni',
            'totalResponden',
            'ikmScore',
            'mutu',
            'predikat',
            'participationRate',
            'tamuPerSurvei',
            'quarterName',
            'chartLabels',
            'dataTamu',
            'dataSurvei',
            'demoLabels',
            'demoData',
            'qualityLabels',
            'qualityData',
            'recentFeedback',
            'tamuTerbaru'
        ));
    }

    public function dataTamu(Request $request)
    {
        $query = Tamu::query();

        // 1. Logika Pencarian (Nama/Layanan)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'LIKE', "%{$search}%")
                    ->orWhere('layanan', 'LIKE', "%{$search}%");
            });
        }

        // 2. Logika Filter Rentang Tanggal (BARU)
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal', [
                $request->start_date,
                $request->end_date
            ]);
        }

        // Urutkan & Pagination
        $dataTamu = $query->latest('tanggal')->latest('waktu')->paginate(10);

        return view('admin.data_tamu', compact('dataTamu'));
    }

    public function storeTamu(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'layanan' => 'required|string', // Hanya validasi layanan
            'telepon' => 'nullable|string',
            'email' => 'nullable|email',
        ]);

        Tamu::create($validated);

        return redirect()->route('dashboard.tamu')->with('success', 'Data tamu berhasil ditambahkan!');
    }

    public function showTamu(Tamu $tamu)
    {
        // Laravel otomatis sudah mencarikan data berdasarkan ID
        // Jadi kita tinggal kembalikan saja
        return response()->json($tamu);
    }

    /**
     * Update Data Tamu
     * Perbaikan: Menggunakan (Tamu $tamu)
     */
    public function updateTamu(Request $request, Tamu $tamu)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'layanan' => 'required|string',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        // Langsung update tanpa cari ID lagi
        $tamu->update($validated);

        return redirect()->route('dashboard.tamu')->with('success', 'Data tamu berhasil diperbarui!');
    }

    /**
     * Hapus Data Tamu
     * Perbaikan: Menggunakan (Tamu $tamu)
     */
    public function destroyTamu(Tamu $tamu)
    {
        $tamu->delete();

        return redirect()->route('dashboard.tamu')->with('success', 'Data tamu berhasil dihapus!');
    }
    // =========================================================================
    // 3. MANAJEMEN DATA SURVEI (CRUD)
    // =========================================================================

    /**
     * Menampilkan Halaman Daftar Survei
     * Route: GET /dashboard/survei
     */
    public function dataSurvei(Request $request)
    {
        // 1. Inisialisasi Query
        $query = Survei::query();

        // 2. Logika Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'LIKE', "%{$search}%")
                    ->orWhere('saran', 'LIKE', "%{$search}%");
            });
        }

        // 3. LOGIKA FILTER TANGGAL (PENTING!)
        // Pastikan nama input di view adalah 'start_date' dan 'end_date'
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereDate('created_at', '>=', $request->start_date)
                ->whereDate('created_at', '<=', $request->end_date);
        }

        // 4. Eksekusi Query dengan Pagination
        // withQueryString() penting agar saat pindah halaman, filter tidak hilang
        $dataSurvei = $query->latest()->paginate(10)->withQueryString();

        return view('admin.data_survei', compact('dataSurvei'));
    }

    /**
     * Hapus Data Survei
     * Route: DELETE /dashboard/survei/{id}
     */
    public function destroySurvei($id)
    {
        $survei = Survei::findOrFail($id);
        $survei->delete();

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Data survei berhasil dihapus!');
    }
}