<?php

namespace App\Http\Controllers;

use App\Models\Survei;
use Illuminate\Http\Request;

class SurveiController extends Controller
{
    // Menampilkan halaman formulir survei
    public function create()
    {
        return view('survei');
    }

    // Menyimpan data survei
    public function store(Request $request)
    {
        // 1. Validasi Input
        $validatedData = $request->validate([
            // Data Diri
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'nullable|email|max:255', // Email opsional

            'pekerjaan' => 'required|string',
            'pekerjaan_lainnya' => 'required_if:pekerjaan,Lainnya|nullable|string|max:255',

            'jenis_kelamin' => 'required|string',
            'pendidikan' => 'required|string',

            'jenis_layanan' => 'required|string',
            'jenis_layanan_lainnya' => 'required_if:jenis_layanan,Lainnya|nullable|string|max:255',

            // Pertanyaan Survei (Q1 - Q9)
            'q1_kesesuaian_persyaratan' => 'required|string',
            'q2_kemudahan_prosedur' => 'required|string',
            'q3_kecepatan' => 'required|string',
            'q4_kewajaran_biaya' => 'required|string',
            'q5_kompetensi' => 'required|string',
            'q6_kesesuaian_produk' => 'required|string',
            'q7_perilaku' => 'required|string',
            'q8_sarpras' => 'required|string',
            'q9_pengaduan' => 'required|string',

            // Saran
            'saran' => 'required|string',
        ]);

        // 2. Logika untuk Pekerjaan "Lainnya"
        $pekerjaanFinal = $request->pekerjaan;
        if ($pekerjaanFinal === 'Lainnya') {
            $pekerjaanFinal = $request->pekerjaan_lainnya;
        }

        // 3. Logika untuk Jenis Layanan "Lainnya"
        $layananFinal = $request->jenis_layanan;
        if ($layananFinal === 'Lainnya') {
            $layananFinal = $request->jenis_layanan_lainnya;
        }

        // 4. Simpan ke Database
        Survei::create([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'pekerjaan' => $pekerjaanFinal,
            'jenis_kelamin' => $request->jenis_kelamin,
            'pendidikan' => $request->pendidikan,
            'jenis_layanan' => $layananFinal,

            // Simpan Jawaban Survei
            'q1_kesesuaian_persyaratan' => $request->q1_kesesuaian_persyaratan,
            'q2_kemudahan_prosedur' => $request->q2_kemudahan_prosedur,
            'q3_kecepatan' => $request->q3_kecepatan,
            'q4_kewajaran_biaya' => $request->q4_kewajaran_biaya,
            'q5_kompetensi' => $request->q5_kompetensi,
            'q6_kesesuaian_produk' => $request->q6_kesesuaian_produk,
            'q7_perilaku' => $request->q7_perilaku,
            'q8_sarpras' => $request->q8_sarpras,
            'q9_pengaduan' => $request->q9_pengaduan,

            'saran' => $request->saran,
        ]);

        // 5. Redirect Kembali dengan Pesan Sukses
        // Redirect ke route 'sukses'
        return redirect()->route('sukses')
            ->with('success', 'Terima kasih! Survei kepuasan masyarakat telah berhasil dikirim.')
            ->with('redirect_url', route('survei.create')); // Ini agar balik lagi ke form Survei
    }
}