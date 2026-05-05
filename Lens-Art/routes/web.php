<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index'])->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::view('/tentang', 'tentang')->name('tentang');

Route::view('/kontak', 'kontak')->name('kontak');

Route::get('/hitung/{a}/{b}', function ($a, $b) {
    return $a + $b;
});
