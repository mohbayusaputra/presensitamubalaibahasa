<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Gunakan firstOrCreate untuk mencari user berdasarkan email,
        // dan hanya membuatnya jika tidak ditemukan.
        User::firstOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@example.com')], // Kondisi pencarian
            [
                'name' => 'Admin Tamu',
                'password' => Hash::make(env('ADMIN_PASSWORD', '12345678')),
            ]
        );
    }
}