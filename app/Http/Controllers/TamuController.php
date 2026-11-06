<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TamuController extends Controller
{
    /**
     * Menampilkan halaman formulir tamu untuk publik.
     */
    public function create()
    {
        return view('tamu');
    }

    /**
     * Menyimpan data dari formulir tamu publik.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'telepon' => 'required|string|max:20', // Di form HTML ada required
            'email' => 'nullable|email|max:255',

            // Validasi Dropdown Layanan
            'jenis_layanan' => 'required|string',
            // Validasi Input Lainnya (Wajib jika dropdown dipilih 'Lainnya')
            'jenis_layanan_lainnya' => 'required_if:jenis_layanan,Lainnya|nullable|string|max:255',
        ]);

        // 2. Logika Penggabungan Layanan
        // Jika user memilih "Lainnya", ambil teks dari input manual.
        // Jika tidak, ambil dari value dropdown.
        $layananFinal = $request->jenis_layanan;
        if ($layananFinal === 'Lainnya') {
            $layananFinal = $request->jenis_layanan_lainnya;
        }

        // 3. Simpan ke Database
        Tamu::create([
            'nama' => $request->nama,
            'telepon' => $request->telepon,
            'email' => $request->email,
            'layanan' => $layananFinal, // Simpan hasil logika di atas
            'tanggal' => Carbon::now()->toDateString(),
            'waktu' => Carbon::now()->toTimeString(),
        ]);

        // Redirect ke route 'sukses'
        return redirect()->route('sukses')
            ->with('success', 'Data tamu berhasil disimpan. Terima kasih atas kunjungan Anda!')
            ->with('redirect_url', route('tamu.create')); // Ini agar balik lagi ke form Tamu
    }
}