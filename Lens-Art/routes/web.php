<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\CustomerReservasiController;
use App\Http\Controllers\CustomerProfilController;
use App\Http\Controllers\PreferensiController;

Route::view('/', 'landing')->name('home');

Route::view('/tentang', 'tentang')->name('tentang');

Route::view('/kontak', 'kontak')->name('kontak');

Route::get('/hitung/{a}/{b}', function ($a, $b) {
    return $a + $b;
});

Route::middleware(['auth', 'cekowner'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');
    Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');

    Route::post('/reservasi/live-search', [ReservasiController::class, 'liveSearch'])
        ->name('reservasi.live-search');

    Route::resource('reservasi', ReservasiController::class);
});

Route::middleware(['auth', 'cekcustomer'])->group(function () {
    Route::get('/customer/dashboard', function () {
        $visitCount = session('customer_dashboard_visit_count', 0) + 1;

        if (!session()->has('customer_dashboard_first_visit')) {
            session([
                'customer_dashboard_first_visit' => now()->format('d M Y H:i:s'),
            ]);
        }

        session([
            'customer_dashboard_visit_count' => $visitCount,
            'customer_dashboard_last_visit' => now()->format('d M Y H:i:s'),
        ]);

        return view('customer.dashboard', [
            'visitCount' => session('customer_dashboard_visit_count'),
            'firstVisit' => session('customer_dashboard_first_visit'),
            'lastVisit' => session('customer_dashboard_last_visit'),
        ]);
    })->name('customer.dashboard');

    Route::post('/customer/dashboard/reset-visit', function () {
        session()->forget([
            'customer_dashboard_visit_count',
            'customer_dashboard_first_visit',
            'customer_dashboard_last_visit',
        ]);

        return redirect()
            ->route('customer.dashboard')
            ->with('success', 'Hitungan kunjungan berhasil direset.');
    })->name('customer.dashboard.reset-visit');

    Route::get('/customer/reservasi', [CustomerReservasiController::class, 'index'])
        ->name('customer.reservasi.index');

    Route::get('/customer/reservasi/create', [CustomerReservasiController::class, 'create'])
        ->name('customer.reservasi.create');

    Route::post('/customer/reservasi', [CustomerReservasiController::class, 'store'])
        ->name('customer.reservasi.store');

    Route::get('/customer/profil', [CustomerProfilController::class, 'edit'])
        ->name('customer.profil.edit');

    Route::put('/customer/profil', [CustomerProfilController::class, 'update'])
        ->name('customer.profil.update');
});

Route::middleware('auth')->group(function () {
    Route::view('/preferensi', 'preferensi')->name('preferensi');

    Route::post('/preferensi/simpan', [PreferensiController::class, 'store'])
        ->name('preferensi.store');
});

require __DIR__.'/auth.php';
