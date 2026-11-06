<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Survei extends Model
{
    // Pastikan nama tabel benar (opsional jika mengikuti standar Laravel, tapi aman ditulis)
    protected $table = 'surveis';

    protected $fillable = [
        // Data Diri
        'nama_lengkap',
        'email',
        'pekerjaan',
        'jenis_kelamin',
        'pendidikan',
        'jenis_layanan',

        // Pertanyaan Survei
        'q1_kesesuaian_persyaratan',
        'q2_kemudahan_prosedur',
        'q3_kecepatan',
        'q4_kewajaran_biaya',
        'q5_kompetensi',
        'q6_kesesuaian_produk',
        'q7_perilaku',
        'q8_sarpras',
        'q9_pengaduan',

        // Saran
        'saran',
    ];
}