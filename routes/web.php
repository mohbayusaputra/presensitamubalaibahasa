<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\SurveiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QrCodeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- RUTE HALAMAN PUBLIK ---

// BARU: Halaman utama (/) sekarang otomatis mengarah ke formulir tamu.
Route::get('/', function () {
    return redirect('/tamu');
})->name('home');

// DIUBAH: Formulir tamu sekarang diakses melalui /tamu
Route::get('/tamu', [TamuController::class, 'create'])->name('tamu.create');
// DIUBAH: Menyimpan data tamu sekarang menggunakan URL yang sama dengan method POST
Route::post('/tamu', [TamuController::class, 'store'])->middleware('throttle:10,1')->name('tamu.store');

// Rute untuk survei (tetap sama)
Route::get('/survei', [SurveiController::class, 'create'])->name('survei.create');
Route::post('/survei', [SurveiController::class, 'store'])->middleware('throttle:10,1')->name('survei.store');

// Rute halaman sukses (tetap sama)
Route::get('/sukses', function () {
    if (!session('success')) {
        // Jika diakses langsung, arahkan ke halaman utama
        return redirect()->route('home');
    }
    return view('sukses');
})->name('sukses');

// Rute QR Code (tetap sama)
Route::get('/generate-qrcode', [QrCodeController::class, 'generate']);


// --- RUTE ADMIN / DASHBOARD (Harus Login) ---
Route::middleware('auth')->group(function () {
    // Rute utama dasbor
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/tamu', [DashboardController::class, 'dataTamu'])->name('dashboard.tamu');
    Route::get('/dashboard/survei', [DashboardController::class, 'dataSurvei'])->name('dashboard.survei');

    // Rute untuk CRUD Tamu
    Route::get('/dashboard/tamu/{tamu}', [DashboardController::class, 'showTamu'])->name('dashboard.tamu.show');
    Route::post('/dashboard/tamu', [DashboardController::class, 'storeTamu'])->name('dashboard.tamu.store');
    Route::put('/dashboard/tamu/{tamu}', [DashboardController::class, 'updateTamu'])->name('dashboard.tamu.update');
    Route::delete('/dashboard/tamu/{tamu}', [DashboardController::class, 'destroyTamu'])->name('dashboard.tamu.destroy');

    // Rute untuk hapus survei
    Route::delete('/dashboard/survei/{survei}', [DashboardController::class, 'destroySurvei'])->name('dashboard.survei.destroy');

    // Rute profil bawaan
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';