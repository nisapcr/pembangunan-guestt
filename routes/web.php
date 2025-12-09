<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TahapanProyekController;
use App\Http\Controllers\MultipleuploadsController;

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
    // 1. Resource Proyek dengan routes tambahan untuk upload files
    Route::resource('proyek', ProyekController::class);

    // Tambahkan route untuk multiple file upload pada proyek
    Route::post('/proyek/{proyek}/upload-files', [ProyekController::class, 'uploadFiles'])->name('proyek.uploadFiles');
    Route::delete('/proyek/{proyek}/files/{fileId}', [ProyekController::class, 'deleteFile'])->name('proyek.deleteFile');
    Route::get('/proyek/{proyek}/files/{fileId}/download', [ProyekController::class, 'downloadFile'])->name('proyek.downloadFile');
    Route::get('/proyek/{proyek}/files/{fileId}/view', [ProyekController::class, 'viewFile'])->name('proyek.viewFile');

    // 2. Resource Tahapan Proyek
    Route::resource('tahapan', \App\Http\Controllers\TahapanProyekController::class);

    // 3. Rute kustom Proyek lainnya
    Route::get('/progres', [ProyekController::class, 'progres'])->name('progres');
    Route::get('/lokasi', [ProyekController::class, 'lokasi'])->name('lokasi');
    Route::get('/kontraktor', [ProyekController::class, 'kontraktor'])->name('kontraktor');
    Route::get('/contact', [ProyekController::class, 'contact'])->name('contact');
    Route::get('/tentang', [ProyekController::class, 'tentang'])->name('tentang');

    // 4. Rute Dashboard & Logout
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // 5. Resource Warga
    Route::resource('warga', WargaController::class);

    // 6. Resource Users dengan rute tambahan untuk hapus foto
    Route::resource('users', UserController::class);
    Route::post('/users/{user}/remove-picture', [UserController::class, 'removePicture'])->name('users.remove-picture');

    // 7. Routes untuk Multiple Uploads (general)
    Route::get('/multipleuploads', [MultipleuploadsController::class, 'index'])->name('uploads');
    Route::post('/save', [MultipleuploadsController::class, 'store'])->name('uploads.store');
    Route::delete('/multipleuploads/{id}', [MultipleuploadsController::class, 'destroy'])->name('uploads.destroy');
    Route::get('/multipleuploads/by-reference', [MultipleuploadsController::class, 'getByReference'])->name('uploads.byReference');
});
