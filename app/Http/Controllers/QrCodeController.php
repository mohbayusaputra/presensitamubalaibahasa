<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    public function generate()
    {
        // Ganti dengan domain kamu setelah di-hosting
        $baseUrl = config('app.url'); // otomatis ambil dari APP_URL di .env

        $url = $baseUrl . '/tamu';

        // Generate QR Code dalam bentuk PNG
        $qrCode = QrCode::format('png')
            ->size(300)
            ->generate($url);

        // Kembalikan dalam response langsung
        return response($qrCode)->header('Content-Type', 'image/png');
    }
}

