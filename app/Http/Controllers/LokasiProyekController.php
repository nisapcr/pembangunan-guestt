<?php

namespace App\Http\Controllers;

use App\Models\LokasiProyek;
use App\Models\Proyek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LokasiProyekController extends Controller
{
    // ========== INDEX ==========
    public function index(Request $request)
    {
        try {
            // Kolom yang bisa di-filter
            $filterableColumns = ['proyek_id'];

            // Kolom yang bisa dicari
            $searchableColumns = ['nama_lokasi', 'alamat'];

            // Query dengan pagination, search, dan filter
            $lokasis = LokasiProyek::with('proyek')
                        ->filter($request, $filterableColumns)
                        ->search($request, $searchableColumns)
                        ->orderBy('created_at', 'desc')
                        ->paginate(12)
                        ->withQueryString()
                        ->onEachSide(2);

            // Hitung statistik
            $baseQuery = LokasiProyek::filter($request, $filterableColumns)
                            ->search($request, $searchableColumns);

            $totalLokasi = $baseQuery->count();
            $lokasiDenganKoordinat = $baseQuery->whereNotNull('lat')->whereNotNull('lng')->count();
            $lokasiTanpaKoordinat = $totalLokasi - $lokasiDenganKoordinat;

            // Ambil data untuk filter
            $proyeks = Proyek::all();
            $totalProyek = $proyeks->count();

            return view('pages.lokasi.index', compact(
                'lokasis',
                'proyeks',
                'totalLokasi',
                'lokasiDenganKoordinat',
                'lokasiTanpaKoordinat',
                'totalProyek'
            ));

        } catch (\Exception $e) {
            Log::error('INDEX ERROR: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // ========== CREATE ==========
    public function create()
    {
        $proyeks = Proyek::all();
        return view('pages.lokasi.create', compact('proyeks'));
    }

    // ========== STORE ==========
    public function store(Request $request)
    {
        Log::info('=== STORE START ===');

        // Validasi
        $validated = $request->validate([
            'proyek_id' => 'required|exists:proyeks,proyek_id',
            'nama_lokasi' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'lat' => 'nullable|numeric',
            'lng' => 'nullable|numeric',
            'geojson' => 'nullable|json',
            'denah_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,bmp|max:2048',
            'media_tambahan.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf,doc,docx,xls,xlsx|max:5120'
        ]);

        DB::beginTransaction();
        try {
            // Data dasar
            $data = [
                'proyek_id' => $validated['proyek_id'],
                'nama_lokasi' => $validated['nama_lokasi'],
                'alamat' => $validated['alamat'],
                'lat' => $validated['lat'],
                'lng' => $validated['lng'],
                'geojson' => $validated['geojson'] ? json_decode($validated['geojson'], true) : null,
            ];

            // 1. Handle Denah Gambar (Foto Utama)
            if ($request->hasFile('denah_gambar')) {
                $file = $request->file('denah_gambar');
                $filename = 'denah_' . time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('lokasi_proyek/denah', $filename, 'public');
                $data['denah_gambar'] = 'lokasi_proyek/denah/' . $filename;
            }

            // 2. Handle Media Tambahan
            $mediaArray = [];
            if ($request->hasFile('media_tambahan')) {
                foreach ($request->file('media_tambahan') as $index => $file) {
                    $filename = 'media_' . time() . '_' . $index . '_' . Str::random(5) . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('lokasi_proyek/media', $filename, 'public');

                    $mediaArray[] = [
                        'filename' => $filename,
                        'original_name' => $file->getClientOriginalName(),
                        'path' => 'lokasi_proyek/media/' . $filename,
                        'size' => $file->getSize(),
                        'mime' => $file->getMimeType(),
                        'uploaded_at' => now()->toDateTimeString()
                    ];
                }

                if (!empty($mediaArray)) {
                    $data['media_tambahan'] = json_encode($mediaArray, JSON_UNESCAPED_SLASHES);
                }
            }

            // 3. Create record
            $lokasi = LokasiProyek::create($data);

            DB::commit();
            Log::info('=== STORE SUCCESS ===');

            return redirect()->route('lokasi.index')
                ->with('success', 'Lokasi berhasil ditambahkan!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('STORE ERROR: ' . $e->getMessage());
            Log::error($e->getTraceAsString());

            return back()
                ->with('error', 'Gagal: ' . $e->getMessage())
                ->withInput();
        }
    }

    // ========== SHOW ==========
    public function show($id)
    {
        try {
            $lokasi = LokasiProyek::with('proyek')->findOrFail($id);

            return view('pages.lokasi.show', compact('lokasi'));

        } catch (\Exception $e) {
            Log::error('SHOW ERROR: ' . $e->getMessage());
            return redirect()->route('lokasi.index')
                ->with('error', 'Lokasi tidak ditemukan');
        }
    }

    // ========== EDIT ==========
    public function edit($id)
    {
        try {
            $lokasi = LokasiProyek::findOrFail($id);
            $proyeks = Proyek::all();

            return view('pages.lokasi.edit', compact('lokasi', 'proyeks'));

        } catch (\Exception $e) {
            Log::error('EDIT ERROR: ' . $e->getMessage());
            return redirect()->route('lokasi.index')->with('error', 'Lokasi tidak ditemukan');
        }
    }

    // ========== UPDATE ==========
    public function update(Request $request, $id)
    {
        Log::info('=== UPDATE START ===');
        Log::info('Update for ID: ' . $id);

        // Validasi
        $validated = $request->validate([
            'proyek_id' => 'required|exists:proyeks,proyek_id',
            'nama_lokasi' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'lat' => 'nullable|numeric',
            'lng' => 'nullable|numeric',
            'geojson' => 'nullable|json',
            'denah_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,bmp|max:2048',
            'media_tambahan_baru.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf,doc,docx,xls,xlsx|max:5120',
            'hapus_denah' => 'nullable|boolean',
            'hapus_media.*' => 'nullable|integer'
        ]);

        DB::beginTransaction();
        try {
            $lokasi = LokasiProyek::findOrFail($id);

            // Data dasar
            $data = [
                'proyek_id' => $validated['proyek_id'],
                'nama_lokasi' => $validated['nama_lokasi'],
                'alamat' => $validated['alamat'],
                'lat' => $validated['lat'],
                'lng' => $validated['lng'],
                'geojson' => $validated['geojson'] ? json_decode($validated['geojson'], true) : null,
            ];

            // 1. Handle Denah (Foto Utama)
            if ($request->hasFile('denah_gambar')) {
                // Hapus denah lama
                if ($lokasi->denah_gambar && Storage::disk('public')->exists($lokasi->denah_gambar)) {
                    Storage::disk('public')->delete($lokasi->denah_gambar);
                }

                // Upload baru
                $file = $request->file('denah_gambar');
                $filename = 'denah_' . time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('lokasi_proyek/denah', $filename, 'public');
                $data['denah_gambar'] = 'lokasi_proyek/denah/' . $filename;
            } elseif ($request->has('hapus_denah') && $request->hapus_denah) {
                // Hapus jika diminta
                if ($lokasi->denah_gambar && Storage::disk('public')->exists($lokasi->denah_gambar)) {
                    Storage::disk('public')->delete($lokasi->denah_gambar);
                }
                $data['denah_gambar'] = null;
            } else {
                // Pertahankan yang lama
                $data['denah_gambar'] = $lokasi->denah_gambar;
            }

            // 2. Handle Media Tambahan
            $mediaArray = $lokasi->media_tambahan_fixed;

            // Hapus media yang dipilih
            if ($request->has('hapus_media')) {
                foreach ($request->hapus_media as $index) {
                    if (isset($mediaArray[$index]['path'])) {
                        Storage::disk('public')->delete($mediaArray[$index]['path']);
                    }
                    unset($mediaArray[$index]);
                }
                $mediaArray = array_values($mediaArray);
            }

            // Tambah media baru
            if ($request->hasFile('media_tambahan_baru')) {
                foreach ($request->file('media_tambahan_baru') as $file) {
                    $filename = 'media_' . time() . '_' . count($mediaArray) . '_' . Str::random(5) . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('lokasi_proyek/media', $filename, 'public');

                    $mediaArray[] = [
                        'filename' => $filename,
                        'original_name' => $file->getClientOriginalName(),
                        'path' => 'lokasi_proyek/media/' . $filename,
                        'size' => $file->getSize(),
                        'mime' => $file->getMimeType(),
                        'uploaded_at' => now()->toDateTimeString()
                    ];
                }
            }

            $data['media_tambahan'] = !empty($mediaArray)
                ? json_encode($mediaArray, JSON_UNESCAPED_SLASHES)
                : null;

            // 3. Update
            $lokasi->update($data);

            DB::commit();
            Log::info('=== UPDATE SUCCESS ===');

            return redirect()->route('lokasi.index')
                ->with('success', 'Lokasi berhasil diperbarui!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('UPDATE ERROR: ' . $e->getMessage());

            return back()
                ->with('error', 'Gagal update: ' . $e->getMessage())
                ->withInput();
        }
    }

    // ========== DESTROY ==========
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $lokasi = LokasiProyek::findOrFail($id);

            // Hapus denah
            if ($lokasi->denah_gambar && Storage::disk('public')->exists($lokasi->denah_gambar)) {
                Storage::disk('public')->delete($lokasi->denah_gambar);
            }

            // Hapus media tambahan
            $mediaArray = $lokasi->media_tambahan_fixed;
            foreach ($mediaArray as $media) {
                if (isset($media['path'])) {
                    Storage::disk('public')->delete($media['path']);
                }
            }

            // Hapus record
            $lokasi->delete();

            DB::commit();

            return redirect()->route('lokasi.index')
                ->with('success', 'Lokasi berhasil dihapus!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('DESTROY ERROR: ' . $e->getMessage());

            return redirect()->route('lokasi.index')
                ->with('error', 'Gagal menghapus: ' . $e->getMessage());
        }
    }

    // ========== AJAX: Hapus Media ==========
    public function hapusMedia($id, $index)
    {
        DB::beginTransaction();
        try {
            $lokasi = LokasiProyek::findOrFail($id);
            $mediaArray = $lokasi->media_tambahan_fixed;

            Log::info('=== HAPUS MEDIA START ===');
            Log::info('Lokasi ID: ' . $id);
            Log::info('Index to delete: ' . $index);
            Log::info('Current media count: ' . count($mediaArray));

            if (!isset($mediaArray[$index])) {
                Log::error('Media index not found');
                return response()->json([
                    'success' => false,
                    'message' => 'Media tidak ditemukan'
                ], 404);
            }

            // Delete file from storage
            if (isset($mediaArray[$index]['path'])) {
                $filePath = $mediaArray[$index]['path'];
                Log::info('Deleting file: ' . $filePath);

                if (Storage::disk('public')->exists($filePath)) {
                    Storage::disk('public')->delete($filePath);
                    Log::info('File deleted successfully');
                } else {
                    Log::warning('File not found in storage: ' . $filePath);
                }
            }

            // Remove from array
            unset($mediaArray[$index]);
            $mediaArray = array_values($mediaArray); // Re-index array

            Log::info('New media count: ' . count($mediaArray));

            // Update database
            $lokasi->update([
                'media_tambahan' => !empty($mediaArray)
                    ? json_encode($mediaArray, JSON_UNESCAPED_SLASHES)
                    : null
            ]);

            DB::commit();

            Log::info('=== HAPUS MEDIA SUCCESS ===');

            return response()->json([
                'success' => true,
                'message' => 'Media berhasil dihapus',
                'new_count' => count($mediaArray)
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('HAPUS MEDIA ERROR: ' . $e->getMessage());
            Log::error($e->getTraceAsString());

            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    // ========== AJAX: Tambah Media ==========
    public function tambahMedia(Request $request, $id)
    {
        try {
            $request->validate([
                'media_tambahan' => 'required|file|mimes:jpeg,png,jpg,gif,pdf,doc,docx,xls,xlsx|max:5120'
            ]);

            $lokasi = LokasiProyek::findOrFail($id);
            $file = $request->file('media_tambahan');

            $mediaArray = $lokasi->media_tambahan_fixed;

            // Upload new file
            $filename = 'media_' . time() . '_' . count($mediaArray) . '_' . Str::random(5) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('lokasi_proyek/media', $filename, 'public');

            // Add to array
            $newMedia = [
                'filename' => $filename,
                'original_name' => $file->getClientOriginalName(),
                'path' => 'lokasi_proyek/media/' . $filename,
                'size' => $file->getSize(),
                'mime' => $file->getMimeType(),
                'uploaded_at' => now()->toDateTimeString()
            ];

            $mediaArray[] = $newMedia;

            // Update database
            $lokasi->update([
                'media_tambahan' => json_encode($mediaArray, JSON_UNESCAPED_SLASHES)
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Media berhasil ditambahkan',
                'media' => $newMedia
            ], 200, [], JSON_UNESCAPED_SLASHES);

        } catch (\Exception $e) {
            Log::error('TAMBAH MEDIA ERROR: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500, [], JSON_UNESCAPED_SLASHES);
        }
    }

    // ========== DOWNLOAD MEDIA ==========
    public function downloadMedia($id, $index)
    {
        try {
            $lokasi = LokasiProyek::findOrFail($id);
            $mediaArray = $lokasi->media_tambahan_fixed;

            if (!isset($mediaArray[$index])) {
                abort(404, 'Media tidak ditemukan');
            }

            $media = $mediaArray[$index];
            $path = $media['path'];

            if (!Storage::disk('public')->exists($path)) {
                abort(404, 'File tidak ditemukan');
            }

            return Storage::disk('public')->download($path, $media['original_name'] ?? 'download');

        } catch (\Exception $e) {
            Log::error('DOWNLOAD MEDIA ERROR: ' . $e->getMessage());
            abort(500, 'Gagal mendownload file');
        }
    }

    // ========== VIEW DENAH ==========
  // ========== VIEW DENAH ==========
// ========== VIEW DENAH ==========
public function viewDenah($id)
{
    try {
        Log::info('=== VIEW DENAH START ===');
        Log::info('Lokasi ID: ' . $id);

        $lokasi = LokasiProyek::find($id);

        if (!$lokasi) {
            Log::error('Lokasi not found for ID: ' . $id);
            abort(404, 'Lokasi tidak ditemukan');
        }

        Log::info('Denah gambar value: ' . $lokasi->denah_gambar);

        if (empty($lokasi->denah_gambar)) {
            Log::error('Denah gambar field is empty or null');
            abort(404, 'Denah gambar tidak ditemukan di database');
        }

        // Cek format path
        $path = $lokasi->denah_gambar;

        // Log untuk debugging
        Log::info('Original path: ' . $path);

        // Cek apakah path sudah benar
        if (!str_starts_with($path, 'lokasi_proyek/')) {
            Log::warning('Path tidak sesuai format, mencoba memperbaiki...');
            $path = 'lokasi_proyek/denah/' . basename($path);
            Log::info('Fixed path: ' . $path);
        }

        // Cek apakah file ada di storage
        if (!Storage::disk('public')->exists($path)) {
            Log::error('File does not exist in storage: ' . $path);

            // List semua file untuk debugging
            try {
                $allFiles = Storage::disk('public')->allFiles('lokasi_proyek');
                Log::info('All files in lokasi_proyek directory: ', $allFiles);

                $denahFiles = Storage::disk('public')->allFiles('lokasi_proyek/denah');
                Log::info('Files in denah directory: ', $denahFiles);
            } catch (\Exception $e) {
                Log::error('Error listing files: ' . $e->getMessage());
            }

            abort(404, 'File tidak ditemukan di storage');
        }

        $fullPath = Storage::disk('public')->path($path);
        Log::info('Full path: ' . $fullPath);

        if (!file_exists($fullPath)) {
            Log::error('File does not exist in filesystem: ' . $fullPath);
            abort(404, 'File tidak ditemukan di sistem file');
        }

        $mime = mime_content_type($fullPath);
        Log::info('Mime type: ' . $mime);
        Log::info('File size: ' . filesize($fullPath) . ' bytes');

        Log::info('=== VIEW DENAH SUCCESS ===');

        return response()->file($fullPath, [
            'Content-Type' => $mime,
            'Content-Disposition' => 'inline; filename="' . basename($path) . '"'
        ]);

    } catch (\Exception $e) {
        Log::error('VIEW DENAH ERROR: ' . $e->getMessage());
        Log::error($e->getTraceAsString());
        abort(404, 'Error: ' . $e->getMessage());
    }
}

// ========== VIEW MEDIA ==========
public function viewMedia($id, $index)
{
    try {
        $lokasi = LokasiProyek::findOrFail($id);
        $mediaArray = $lokasi->media_tambahan_fixed;

        if (!isset($mediaArray[$index])) {
            abort(404, 'Media tidak ditemukan');
        }

        $media = $mediaArray[$index];

        if (!Storage::disk('public')->exists($media['path'])) {
            abort(404, 'File tidak ditemukan');
        }

        $path = Storage::disk('public')->path($media['path']);
        $mime = mime_content_type($path);

        return response()->file($path, [
            'Content-Type' => $mime,
            'Content-Disposition' => 'inline; filename="' . ($media['original_name'] ?? 'file') . '"'
        ]);

    } catch (\Exception $e) {
        Log::error('VIEW MEDIA ERROR: ' . $e->getMessage());
        abort(404, 'File tidak ditemukan');
    }
}

    // ========== GET MAP DATA (AJAX) ==========
    public function getMapData()
    {
        try {
            $lokasis = LokasiProyek::with('proyek')
                ->whereNotNull('lat')
                ->whereNotNull('lng')
                ->get()
                ->map(function ($lokasi) {
                    return [
                        'id' => $lokasi->lokasi_id,
                        'nama_lokasi' => $lokasi->nama_lokasi,
                        'proyek' => $lokasi->proyek->nama_proyek ?? '-',
                        'alamat' => $lokasi->alamat,
                        'lat' => (float) $lokasi->lat,
                        'lng' => (float) $lokasi->lng,
                        'url' => route('lokasi.show', $lokasi->lokasi_id),
                        'denah_url' => $lokasi->denah_gambar
                            ? route('lokasi.denah.view', $lokasi->lokasi_id) // Gunakan route khusus
                            : null,
                        'edit_url' => route('lokasi.edit', $lokasi->lokasi_id)
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => $lokasis
            ], 200, [], JSON_UNESCAPED_SLASHES);

        } catch (\Exception $e) {
            Log::error('GET MAP DATA ERROR: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data'
            ], 500, [], JSON_UNESCAPED_SLASHES);
        }
    }

    // ========== GET GEOJSON DATA (AJAX) ==========
    public function getGeojsonData()
    {
        try {
            $lokasis = LokasiProyek::with('proyek')
                ->whereNotNull('geojson')
                ->get()
                ->map(function ($lokasi) {
                    return [
                        'id' => $lokasi->lokasi_id,
                        'nama_lokasi' => $lokasi->nama_lokasi,
                        'proyek' => $lokasi->proyek->nama_proyek ?? '-',
                        'geojson' => $lokasi->geojson,
                        'url' => route('lokasi.show', $lokasi->lokasi_id)
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => $lokasis
            ], 200, [], JSON_UNESCAPED_SLASHES);

        } catch (\Exception $e) {
            Log::error('GET GEOJSON DATA ERROR: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data GeoJSON'
            ], 500, [], JSON_UNESCAPED_SLASHES);
        }
    }
}
