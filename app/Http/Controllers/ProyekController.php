<?php

namespace App\Http\Controllers;

use App\Models\Proyek;
use App\Models\Multipleuploads;
use App\Models\TahapanProyek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProyekController extends Controller
{
    /**
     * Menampilkan daftar semua proyek.
     */
    public function index(Request $request)
    {
        // Kolom yang bisa di-filter
        $filterableColumns = ['tahun', 'sumber_dana', 'lokasi'];

        // Kolom yang bisa dicari
        $searchableColumns = ['nama_proyek', 'kode_proyek', 'deskripsi', 'lokasi'];

        // Query dengan pagination, search, dan filter
        $proyek = Proyek::filter($request, $filterableColumns)
                    ->search($request, $searchableColumns)
                    ->latest()
                    ->paginate(10)
                    ->withQueryString()
                    ->onEachSide(2);

        // HITUNG STATISTIK DENGAN QUERY YANG SAMA (termasuk filter dan search)
        $baseQuery = Proyek::filter($request, $filterableColumns)
                        ->search($request, $searchableColumns);

        $totalProyek = $baseQuery->count();
        $totalAnggaran = $baseQuery->sum('anggaran');

        // Hitung proyek berdasarkan tahun
        $proyekAktif = (clone $baseQuery)->where('tahun', '>=', date('Y') - 1)->count();
        $proyekSelesai = (clone $baseQuery)->where('tahun', '<', date('Y') - 1)->count();

        // Hitung berdasarkan sumber dana
        $sumberDanaCount = (clone $baseQuery)->select('sumber_dana')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('sumber_dana')
            ->get();

        return view('pages.proyek.index', compact(
            'proyek',
            'totalProyek',
            'totalAnggaran',
            'proyekAktif',
            'proyekSelesai',
            'sumberDanaCount'
        ));
    }

    /**
     * Menampilkan formulir untuk membuat proyek baru.
     */
    public function create()
    {
        return view('pages.proyek.create', [
            'title' => 'Tambah Proyek Baru'
        ]);
    }

    /**
     * Menyimpan proyek baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi data input
        $validated = $request->validate([
            'kode_proyek' => 'required|unique:proyeks,kode_proyek',
            'nama_proyek' => 'required',
            'tahun' => 'required|integer',
            'lokasi' => 'required',
            'anggaran' => 'required|numeric',
            'sumber_dana' => 'required',
            'deskripsi' => 'nullable',
            'files.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,pdf,doc,docx,xls,xlsx|max:5120'
        ]);

        // Simpan proyek
        $proyek = Proyek::create($validated);

        // Handle upload multiple files
        if ($request->hasFile('files')) {
            $this->uploadMultipleFiles($request->file('files'), $proyek->proyek_id, $request->caption);
        }

        return redirect()->route('proyek.index')->with('success', 'Proyek berhasil ditambahkan');
    }

    /**
     * Menampilkan detail proyek tertentu.
     */
    public function show(Proyek $proyek)
    {
        // Ambil semua file yang terkait dengan proyek ini
        $files = Multipleuploads::where('ref_table', 'proyek')
            ->where('ref_id', $proyek->proyek_id)
            ->orderBy('sort_order')
            ->get();

        return view('pages.proyek.show', [
            'proyek' => $proyek,
            'files' => $files,
            'title' => 'Detail Proyek'
        ]);
    }

    /**
     * Menampilkan formulir untuk mengedit proyek.
     */
    public function edit(Proyek $proyek)
    {
        // Ambil semua file yang terkait dengan proyek ini
        $files = Multipleuploads::where('ref_table', 'proyek')
            ->where('ref_id', $proyek->proyek_id)
            ->orderBy('sort_order')
            ->get();

        return view('pages.proyek.edit', [
            'proyek' => $proyek,
            'files' => $files,
            'title' => 'Edit Proyek'
        ]);
    }

    /**
     * Memperbarui proyek di database.
     */
    public function update(Request $request, Proyek $proyek)
    {
        // Validasi data input untuk update
        $validated = $request->validate([
            'kode_proyek' => 'required|unique:proyeks,kode_proyek,' . $proyek->proyek_id . ',proyek_id',
            'nama_proyek' => 'required',
            'tahun' => 'required|integer',
            'lokasi' => 'required',
            'anggaran' => 'required|numeric',
            'sumber_dana' => 'required',
            'deskripsi' => 'nullable',
            'files.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,pdf,doc,docx,xls,xlsx|max:5120'
        ]);

        // Update data proyek
        $proyek->update($validated);

        // Handle upload multiple files baru
        if ($request->hasFile('files')) {
            $this->uploadMultipleFiles($request->file('files'), $proyek->proyek_id, $request->caption);
        }

        return redirect()->route('proyek.index')->with('success', 'Proyek berhasil diperbarui');
    }

    /**
     * Menghapus proyek dari database.
     */
    public function destroy(Proyek $proyek)
    {
        // Hapus semua file yang terkait dengan proyek ini
        $files = Multipleuploads::where('ref_table', 'proyek')
            ->where('ref_id', $proyek->proyek_id)
            ->get();

        foreach ($files as $file) {
            // Hapus file dari storage
            if ($file->file_path && Storage::disk('public')->exists($file->file_path)) {
                Storage::disk('public')->delete($file->file_path);
            }
            // Hapus record dari database
            $file->delete();
        }

        // Hapus proyek
        $proyek->delete();

        return redirect()->route('proyek.index')->with('success', 'Proyek berhasil dihapus');
    }

    /**
     * Upload file tambahan untuk proyek (AJAX).
     */
    public function uploadFiles(Request $request, Proyek $proyek)
    {
        $request->validate([
            'files.*' => 'required|file|mimes:jpg,jpeg,png,gif,pdf,doc,docx,xls,xlsx|max:5120',
            'caption' => 'nullable|string|max:255'
        ]);

        if ($request->hasFile('files')) {
            $uploadedFiles = $this->uploadMultipleFiles($request->file('files'), $proyek->proyek_id, $request->caption);

            return response()->json([
                'success' => true,
                'message' => 'Files uploaded successfully',
                'files' => $uploadedFiles
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No files uploaded'
        ], 400);
    }

    /**
     * Hapus file dari proyek (AJAX).
     */
    public function deleteFile(Request $request, Proyek $proyek, $fileId)
    {
        // Cari file berdasarkan ID dan pastikan milik proyek ini
        $file = Multipleuploads::where('id', $fileId)
            ->where('ref_table', 'proyek')
            ->where('ref_id', $proyek->proyek_id)
            ->firstOrFail();

        // Hapus file dari storage
        if ($file->file_path && Storage::disk('public')->exists($file->file_path)) {
            Storage::disk('public')->delete($file->file_path);
        }

        // Hapus record dari database
        $file->delete();

        return response()->json([
            'success' => true,
            'message' => 'File deleted successfully'
        ]);
    }

    /**
     * Helper method untuk upload multiple files.
     */
    private function uploadMultipleFiles($files, $proyekId, $caption = null)
    {
        $uploadedFiles = [];

        if (!is_array($files)) {
            $files = [$files];
        }

        foreach ($files as $file) {
            if ($file->isValid()) {
                // Generate nama file unik
                $originalName = $file->getClientOriginalName();
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                // Simpan file ke folder 'proyek'
                $filePath = $file->storeAs('proyek', $fileName, 'public');

                // Simpan ke tabel multipleuploads
                $uploadedFile = Multipleuploads::create([
                    'ref_table' => 'proyek',
                    'ref_id' => $proyekId,
                    'filename' => $fileName,
                    'original_name' => $originalName,
                    'caption' => $caption,
                    'mime_type' => $file->getMimeType(),
                    'file_size' => $file->getSize(),
                    'file_path' => $filePath,
                    'sort_order' => Multipleuploads::where('ref_table', 'proyek')
                        ->where('ref_id', $proyekId)
                        ->max('sort_order') + 1
                ]);

                $uploadedFiles[] = $uploadedFile;
            }
        }

        return $uploadedFiles;
    }

    /**
     * Update sort order files (AJAX).
     */
    public function updateFileOrder(Request $request, Proyek $proyek)
    {
        $request->validate([
            'files' => 'required|array'
        ]);

        foreach ($request->files as $index => $fileId) {
            Multipleuploads::where('id', $fileId)
                ->where('ref_table', 'proyek')
                ->where('ref_id', $proyek->proyek_id)
                ->update(['sort_order' => $index]);
        }

        return response()->json([
            'success' => true,
            'message' => 'File order updated successfully'
        ]);
    }

    public function kontraktor()
    {
        return view('pages.kontraktor', ['title' => 'Daftar Kontraktor']);
    }

    public function lokasi()
    {
        return view('pages.lokasi', ['title' => 'Lokasi Proyek']);
    }

    public function progres()
    {
        return view('pages.progres', ['title' => 'Progres Proyek']);
    }

    /**
     * Download file.
     */
    public function downloadFile(Proyek $proyek, $fileId)
    {
        // Cari file berdasarkan ID dan pastikan milik proyek ini
        $file = Multipleuploads::where('id', $fileId)
            ->where('ref_table', 'proyek')
            ->where('ref_id', $proyek->proyek_id)
            ->firstOrFail();

        if (!Storage::disk('public')->exists($file->file_path)) {
            abort(404, 'File not found');
        }

        return Storage::disk('public')->download($file->file_path, $file->original_name);
    }

    /**
     * View file.
     */
    public function viewFile(Proyek $proyek, $fileId)
    {
        // Cari file berdasarkan ID dan pastikan milik proyek ini
        $file = Multipleuploads::where('id', $fileId)
            ->where('ref_table', 'proyek')
            ->where('ref_id', $proyek->proyek_id)
            ->firstOrFail();

        if (!Storage::disk('public')->exists($file->file_path)) {
            abort(404, 'File not found');
        }

        $path = Storage::disk('public')->path($file->file_path);
        $mime = mime_content_type($path);

        return response()->file($path, [
            'Content-Type' => $mime,
            'Content-Disposition' => 'inline; filename="' . $file->original_name . '"'
        ]);
    }
}
