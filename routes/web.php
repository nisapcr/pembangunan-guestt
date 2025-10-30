<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// ✅ Guest only
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login.index');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register.index');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// ✅ Only for logged-in users
Route::middleware('auth')->group(function () {
    Route::get('/', [ProyekController::class, 'index'])->name('home');
    Route::get('/tahapan', [ProyekController::class, 'tahapan'])->name('tahapan');
    Route::get('/progres', [ProyekController::class, 'progres'])->name('progres');
    Route::get('/lokasi', [ProyekController::class, 'lokasi'])->name('lokasi');
    Route::get('/kontraktor', [ProyekController::class, 'kontraktor'])->name('kontraktor');
    Route::get('/contact', [ProyekController::class, 'contact'])->name('contact');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
