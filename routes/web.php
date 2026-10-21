<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\SimpananController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\AngsuranController;
use App\Http\Controllers\DashboardController; // Pastikan ini ditambahkan
use Illuminate\Support\Facades\Route;

// Langsung arahkan halaman utama (/) ke login atau dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Gunakan DashboardController, bukan function kosongan lagi
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute untuk modul utama
    Route::resource('anggota', AnggotaController::class);
    Route::resource('simpanan', SimpananController::class);
    Route::resource('pinjaman', PinjamanController::class);
    Route::resource('angsuran', AngsuranController::class);
});

// RUTE KHUSUS ADMIN
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class);
});

require __DIR__.'/auth.php';