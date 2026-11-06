<?php

return [
    App\Providers\AppServiceProvider::class,
    // Tambahkan Service Provider untuk QR Code di sini
    SimpleSoftwareIO\QrCode\QrCodeServiceProvider::class,
];
