<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\DashboardController;

// --- GUEST ONLY (Non-Authenticated Users) ---
Route::middleware('guest')->group(function () {
    // FIX 1: Rute GET Login HARUS bernama 'login' agar middleware 'auth' bekerja
    Route::get('/login', [AuthController::class, 'index'])->name('login');

    // Rute POST Login
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    // Rute Register
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// --- AUTHENTICATED USERS ONLY ---
Route::middleware('auth')->group(function () {

    // 1. Rute Beranda/Home
    Route::get('/daftarProyek', [ProyekController::class, 'index'])->name('home');

    // 2. FIX 2: RESOURCE ROUTE untuk Proyek
    // Ini membuat rute 'proyek.create', 'proyek.store', dll. yang dibutuhkan view.
    // except(['index']) digunakan karena rute index sudah ditangani oleh rute '/' di atas.
    Route::resource('proyek', ProyekController::class)->except(['index']);

    // 3. Rute kustom Proyek lainnya
    Route::get('/tahapan', [ProyekController::class, 'tahapan'])->name('tahapan');
    Route::get('/progres', [ProyekController::class, 'progres'])->name('progres');
    Route::get('/lokasi', [ProyekController::class, 'lokasi'])->name('lokasi');
    Route::get('/kontraktor', [ProyekController::class, 'kontraktor'])->name('kontraktor');
    Route::get('/contact', [ProyekController::class, 'contact'])->name('contact');

    // 4. RUTE BARU: Halaman Tentang
    Route::get('/tentang', [ProyekController::class, 'tentang'])->name('tentang');

    // 5. Rute Dashboard & Logout
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // 6. Resource Warga
    Route::resource('warga', WargaController::class);

    Route::resource('users', UserController::class);
     Route::get('/users', [UserController::class, 'index'])->name('users.index');
});

