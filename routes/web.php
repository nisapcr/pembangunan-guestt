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
use App\Http\Controllers\ProgresProyekController;
use App\Http\Controllers\LokasiProyekController;

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
    // 1. Resource Proyek
    Route::resource('proyek', ProyekController::class);

    // Upload files untuk proyek
    Route::post('/proyek/{proyek}/upload-files', [ProyekController::class, 'uploadFiles'])->name('proyek.uploadFiles');
    Route::delete('/proyek/{proyek}/files/{fileId}', [ProyekController::class, 'deleteFile'])->name('proyek.deleteFile');
    Route::get('/proyek/{proyek}/files/{fileId}/download', [ProyekController::class, 'downloadFile'])->name('proyek.downloadFile');
    Route::get('/proyek/{proyek}/files/{fileId}/view', [ProyekController::class, 'viewFile'])->name('proyek.viewFile');

    // 2. Resource Tahapan Proyek
    Route::resource('tahapan', TahapanProyekController::class);

    // 3. Resource Progress Proyek
Route::resource('progres', ProgresProyekController::class);

// AJAX Routes
Route::get('progres/tahapan/{proyekId}', [ProgresProyekController::class, 'getTahapanByProyek'])
    ->name('progres.tahapan');

Route::delete('progres/{id}/foto/{fotoId}', [ProgresProyekController::class, 'hapusFotoTambahan'])
    ->name('progres.hapus-foto');

Route::get('progres/export', [ProgresProyekController::class, 'export'])
    ->name('progres.export');

    // 4. Rute kustom lainnya
    Route::get('/kontraktor', [ProyekController::class, 'kontraktor'])->name('kontraktor');
    Route::get('/contact', [ProyekController::class, 'contact'])->name('contact');
    Route::get('/tentang', [ProyekController::class, 'tentang'])->name('tentang');

    // 5. Dashboard & Logout
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // 6. Resource Warga
    Route::resource('warga', WargaController::class);

    // 7. Resource Users
    Route::resource('users', UserController::class);
   Route::get('users/{user}/remove-picture', [UserController::class, 'removePicture'])->name('users.remove-picture');

    // 8. Multiple Uploads
    Route::get('/multipleuploads', [MultipleuploadsController::class, 'index'])->name('uploads');
    Route::post('/save', [MultipleuploadsController::class, 'store'])->name('uploads.store');
    Route::delete('/multipleuploads/{id}', [MultipleuploadsController::class, 'destroy'])->name('uploads.destroy');
    Route::get('/multipleuploads/by-reference', [MultipleuploadsController::class, 'getByReference'])->name('uploads.byReference');

    // 9. ROUTES LOKASI PROYEK - DIPINDAHKAN KE DALAM MIDDLEWARE AUTH
   // Lokasi Proyek Routes
Route::resource('lokasi', \App\Http\Controllers\LokasiProyekController::class);
Route::post('/lokasi/{id}/tambah-media', [\App\Http\Controllers\LokasiProyekController::class, 'tambahMedia'])->name('lokasi.tambah-media');
Route::delete('/lokasi/{id}/hapus-media/{index}', [\App\Http\Controllers\LokasiProyekController::class, 'hapusMedia'])->name('lokasi.hapus-media');
Route::get('/lokasi/{id}/download-media/{index}', [\App\Http\Controllers\LokasiProyekController::class, 'downloadMedia'])->name('lokasi.download-media');
Route::get('/lokasi/api/map-data', [\App\Http\Controllers\LokasiProyekController::class, 'getMapData'])->name('lokasi.api.map-data');
Route::get('/lokasi/api/geojson-data', [\App\Http\Controllers\LokasiProyekController::class, 'getGeojsonData'])->name('lokasi.api.geojson-data');
});
