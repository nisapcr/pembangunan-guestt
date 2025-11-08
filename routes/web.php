<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;

// --- RUTE BERANDA (Bisa diakses oleh semua pengguna) ---
Route::get('/', [HomeController::class, 'index'])->name('home');

// --- GUEST ONLY (Non-Authenticated Users) ---
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// --- AUTHENTICATED USERS ONLY ---
Route::middleware('auth')->group(function () {
    // 1. Resource Proyek (SUDAH TERMASUK proyek.index, create, store, show, edit, update, destroy)
    Route::resource('proyek', ProyekController::class);

    // 2. Rute kustom Proyek lainnya
    Route::get('/tahapan', [ProyekController::class, 'tahapan'])->name('tahapan');
    Route::get('/progres', [ProyekController::class, 'progres'])->name('progres');
    Route::get('/lokasi', [ProyekController::class, 'lokasi'])->name('lokasi');
    Route::get('/kontraktor', [ProyekController::class, 'kontraktor'])->name('kontraktor');
    Route::get('/contact', [ProyekController::class, 'contact'])->name('contact');
    Route::get('/tentang', [ProyekController::class, 'tentang'])->name('tentang');

    // 3. Rute Dashboard & Logout
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // 4. Resource Warga
    Route::resource('warga', WargaController::class);

    // 5. Resource Users
    Route::resource('users', UserController::class);
});