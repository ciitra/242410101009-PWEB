<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\ProfilController;

Route::get('/', [DashboardController::class, 'index'])->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::view('/tentang', 'tentang')->name('tentang');

Route::view('/kontak', 'kontak')->name('kontak');

Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');
Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');

Route::get('/hitung/{a}/{b}', function ($a, $b) {
    return $a + $b;
});

Route::resource('reservasi', ReservasiController::class);
