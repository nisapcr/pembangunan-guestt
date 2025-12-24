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
    use App\Http\Controllers\KontraktorController;
    use App\Http\Controllers\TentangController;

    // --- RUTE BERANDA & PUBLIC ---
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/tentang', [TentangController::class, 'index'])->name('tentang');
    Route::get('/identitas', function () {
        return view('pages.identitas');
    })->name('identitas');

    // --- RUTE LOGOUT (Gunakan GET method) ---
    Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');

    // --- GUEST ONLY ---
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'index'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.post');
        Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
        Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    });

    // --- AUTHENTICATED USERS ---
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // ==================== USERS (HANYA ADMIN) ====================
        Route::middleware('role:admin')->group(function () {
            Route::resource('users', UserController::class);
            Route::get('users/{user}/remove-picture', [UserController::class, 'removePicture'])->name('users.remove-picture');
        });

    Route::prefix('proyek')->group(function () {

        // SEMUA USER
        Route::get('/', [ProyekController::class, 'index'])->name('proyek.index');

        // ADMIN & PETUGAS (CREATE HARUS DI ATAS)
        Route::middleware('role:admin,petugas')->group(function () {
            Route::get('/create', [ProyekController::class, 'create'])->name('proyek.create');
            Route::post('/', [ProyekController::class, 'store'])->name('proyek.store');
            Route::get('/{proyek}/edit', [ProyekController::class, 'edit'])->name('proyek.edit');
            Route::put('/{proyek}', [ProyekController::class, 'update'])->name('proyek.update');
            Route::delete('/{proyek}', [ProyekController::class, 'destroy'])->name('proyek.destroy');
            Route::post('/{proyek}/upload-files', [ProyekController::class, 'uploadFiles'])->name('proyek.uploadFiles');
            Route::delete('/{proyek}/files/{fileId}', [ProyekController::class, 'deleteFile'])->name('proyek.deleteFile');
        });

        // ⚠️ ROUTE PARAMETER DI BAWAH
        Route::get('/{proyek}', [ProyekController::class, 'show'])->name('proyek.show');
        Route::get('/{proyek}/files/{fileId}/download', [ProyekController::class, 'downloadFile'])->name('proyek.downloadFile');
        Route::get('/{proyek}/files/{fileId}/view', [ProyekController::class, 'viewFile'])->name('proyek.viewFile');
    });

        // ==================== TAHAPAN PROYEK ====================
    Route::prefix('tahapan')->group(function () {

        // SEMUA USER
        Route::get('/', [TahapanProyekController::class, 'index'])->name('tahapan.index');

        // ADMIN & PETUGAS (CREATE DI ATAS)
        Route::middleware('role:admin,petugas')->group(function () {
            Route::get('/create', [TahapanProyekController::class, 'create'])->name('tahapan.create');
            Route::post('/', [TahapanProyekController::class, 'store'])->name('tahapan.store');
            Route::get('/{tahapan}/edit', [TahapanProyekController::class, 'edit'])->name('tahapan.edit');
            Route::put('/{tahapan}', [TahapanProyekController::class, 'update'])->name('tahapan.update');
            Route::delete('/{tahapan}', [TahapanProyekController::class, 'destroy'])->name('tahapan.destroy');
        });

        // ⚠️ ROUTE PARAMETER PALING BAWAH
        Route::get('/{tahapan}', [TahapanProyekController::class, 'show'])->name('tahapan.show');
    });


        // ==================== KONTRAKTOR ====================
    Route::prefix('kontraktor')->group(function () {

        // ==================== UMUM ====================
        Route::get('/', [KontraktorController::class, 'index'])->name('kontraktor.index');

        // ==================== ADMIN & PETUGAS ====================
        Route::middleware('role:admin,petugas')->group(function () {
            Route::get('/create', [KontraktorController::class, 'create'])->name('kontraktor.create');
            Route::post('/', [KontraktorController::class, 'store'])->name('kontraktor.store');
            Route::get('/{kontraktor}/edit', [KontraktorController::class, 'edit'])->name('kontraktor.edit');
            Route::put('/{kontraktor}', [KontraktorController::class, 'update'])->name('kontraktor.update');
            Route::delete('/{kontraktor}', [KontraktorController::class, 'destroy'])->name('kontraktor.destroy');
        });

        // ==================== SHOW (PALING BAWAH) ====================
        Route::get('/{kontraktor}', [KontraktorController::class, 'show'])->name('kontraktor.show');
    });

        // ==================== PROGRESS PROYEK ====================
    Route::prefix('progres')->group(function () {

        // ==================== UMUM ====================
        Route::get('/', [ProgresProyekController::class, 'index'])->name('progres.index');
        Route::get('/export', [ProgresProyekController::class, 'export'])->name('progres.export');
        Route::get('/tahapan/{proyekId}', [ProgresProyekController::class, 'getTahapanByProyek'])->name('progres.tahapan');

        // ==================== CREATE ====================
        Route::middleware('role:admin,petugas,user')->group(function () {
            Route::get('/create', [ProgresProyekController::class, 'create'])->name('progres.create');
            Route::post('/', [ProgresProyekController::class, 'store'])->name('progres.store');
        });

        // ==================== EDIT / DELETE ====================
        Route::middleware('role:admin,petugas')->group(function () {
            Route::get('/{progres}/edit', [ProgresProyekController::class, 'edit'])->name('progres.edit');
            Route::put('/{progres}', [ProgresProyekController::class, 'update'])->name('progres.update');
            Route::delete('/{progres}', [ProgresProyekController::class, 'destroy'])->name('progres.destroy');
            Route::delete('/{id}/foto/{fotoId}', [ProgresProyekController::class, 'hapusFotoTambahan'])->name('progres.hapus-foto');
        });

        // ==================== SHOW (PALING BAWAH) ====================
        Route::get('/{progres}', [ProgresProyekController::class, 'show'])->name('progres.show');
    });


    Route::prefix('warga')->group(function () {

        // ==================== UMUM ====================
        Route::get('/', [WargaController::class, 'index'])->name('warga.index');

        // ==================== ADMIN ====================
        Route::middleware('role:admin')->group(function () {
            Route::get('/create', [WargaController::class, 'create'])->name('warga.create');
            Route::post('/', [WargaController::class, 'store'])->name('warga.store');
            Route::get('/{warga}/edit', [WargaController::class, 'edit'])->name('warga.edit');
            Route::put('/{warga}', [WargaController::class, 'update'])->name('warga.update');
            Route::delete('/{warga}', [WargaController::class, 'destroy'])->name('warga.destroy');
        });

        // ==================== SHOW (PALING BAWAH) ====================
        Route::get('/{warga}', [WargaController::class, 'show'])->name('warga.show');
    });


        // ==================== MULTIPLE UPLOADS ====================
        // HANYA ADMIN & PETUGAS BISA AKSES
        Route::middleware('role:admin,petugas')->group(function () {
            Route::prefix('multipleuploads')->group(function () {
                Route::get('/', [MultipleuploadsController::class, 'index'])->name('uploads');
                Route::get('/by-reference', [MultipleuploadsController::class, 'getByReference'])->name('uploads.byReference');
                Route::post('/save', [MultipleuploadsController::class, 'store'])->name('uploads.store');
                Route::delete('/{id}', [MultipleuploadsController::class, 'destroy'])->name('uploads.destroy');
            });
        });

        // ==================== LOKASI PROYEK ====================
    Route::prefix('lokasi')->group(function () {

        // ==================== UMUM ====================
        Route::get('/', [LokasiProyekController::class, 'index'])->name('lokasi.index');

        // API HARUS PALING ATAS
        Route::get('/api/map-data', [LokasiProyekController::class, 'getMapData'])->name('lokasi.api.map-data');
        Route::get('/api/geojson-data', [LokasiProyekController::class, 'getGeojsonData'])->name('lokasi.api.geojson-data');

        // VIEW & DOWNLOAD MEDIA (SPESIFIK)
        Route::get('/{id}/denah/view', [LokasiProyekController::class, 'viewDenah'])->name('lokasi.denah.view');
        Route::get('/{id}/media/{index}/view', [LokasiProyekController::class, 'viewMedia'])->name('lokasi.media.view');
        Route::get('/{id}/download-media/{index}', [LokasiProyekController::class, 'downloadMedia'])->name('lokasi.download-media');

        // ==================== CREATE ====================
        Route::middleware('role:admin,petugas,user')->group(function () {
            Route::get('/create', [LokasiProyekController::class, 'create'])->name('lokasi.create');
            Route::post('/', [LokasiProyekController::class, 'store'])->name('lokasi.store');
        });

        // ==================== EDIT / DELETE ====================
        Route::middleware('role:admin,petugas')->group(function () {
            Route::get('/{lokasi}/edit', [LokasiProyekController::class, 'edit'])->name('lokasi.edit');
            Route::put('/{lokasi}', [LokasiProyekController::class, 'update'])->name('lokasi.update');
            Route::delete('/{lokasi}', [LokasiProyekController::class, 'destroy'])->name('lokasi.destroy');
            Route::post('/{id}/tambah-media', [LokasiProyekController::class, 'tambahMedia'])->name('lokasi.tambah-media');
            Route::delete('/{id}/hapus-media/{index}', [LokasiProyekController::class, 'hapusMedia'])->name('lokasi.hapus-media');
        });

        // ==================== SHOW (PALING BAWAH) ====================
        Route::get('/{lokasi}', [LokasiProyekController::class, 'show'])->name('lokasi.show');

        Route::get('/cek-proyek', function () {
    $p = new \App\Models\Proyek;
    return [
        'class' => get_class($p),
        'table' => $p->getTable(),
        'file'  => (new ReflectionClass($p))->getFileName(),
    ];
});
    });
        });
