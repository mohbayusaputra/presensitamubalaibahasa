<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tamu extends Model
{
    protected $fillable = [
        'nama',
        'telepon',
        'email',
        'layanan', // Kolom baru pengganti kepentingan & tujuan
        'tanggal',
        'waktu',
    ];
}