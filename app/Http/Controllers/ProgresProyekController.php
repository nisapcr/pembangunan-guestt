<?php

namespace App\Http\Controllers;

use App\Models\ProgresProyek;
use App\Models\Proyek;
use App\Models\TahapanProyek;
use App\Models\Multipleuploads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProgresProyekController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Kolom yang bisa di-filter
            $filterableColumns = ['proyek_id', 'tahap_id'];

            // Kolom yang bisa dicari
            $searchableColumns = ['catatan'];

            // Query dengan pagination, search, dan filter
            $progress = ProgresProyek::with(['proyek', 'tahapan', 'fotos'])
                        ->filter($request, $filterableColumns)
                        ->search($request, $searchableColumns)
                        ->orderBy('tanggal', 'desc')
                        ->orderBy('created_at', 'desc')
                        ->paginate(10)
                        ->withQueryString()
                        ->onEachSide(2);

            // Hitung statistik
            $baseQuery = ProgresProyek::filter($request, $filterableColumns)
                            ->search($request, $searchableColumns);

            $totalProgress = $baseQuery->count();
            $avgProgress = $baseQuery->avg('persen_real');
            $maxProgress = $baseQuery->max('persen_real');
            $minProgress = $baseQuery->min('persen_real');

            // Ambil data untuk filter
            $proyeks = Proyek::all();
            $tahapans = TahapanProyek::with('proyek')->get();

            return view('pages.progres.index', compact(
                'progress',
                'totalProgress',
                'avgProgress',
                'maxProgress',
                'minProgress',
                'proyeks',
                'tahapans'
            ));

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function create()
    {
        $proyeks = Proyek::all();
        $tahapans = TahapanProyek::with('proyek')->get();

        return view('pages.progres.create', compact('proyeks', 'tahapans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'proyek_id'     => 'required|exists:proyek,proyek_id',
            'tahap_id'      => 'required|exists:tahapan_proyek,tahap_id',
            'persen_real'   => 'required|numeric|min:0|max:100',
            'tanggal'       => 'required|date',
            'catatan'       => 'nullable|string|max:1000',
            'foto_progres'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_tambahan.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Cek relasi proyek dan tahapan
        $tahapan = TahapanProyek::find($request->tahap_id);
        if ($tahapan && $tahapan->proyek_id != $request->proyek_id) {
            return redirect()->back()
                ->with('error', 'Tahapan tidak termasuk dalam proyek yang dipilih')
                ->withInput();
        }

        // Upload foto utama jika ada
        if ($request->hasFile('foto_progres')) {
            $foto = $request->file('foto_progres');
            $fileName = 'progress_' . time() . '_' . Str::random(10) . '.' . $foto->getClientOriginalExtension();
            $path = $foto->storeAs('progress_fotos', $fileName, 'public');
            $validated['foto_progres'] = $path;
        }

        // Buat progress
        $progres = ProgresProyek::create($validated);

        // Upload multiple foto tambahan
        if ($request->hasFile('foto_tambahan')) {
            foreach ($request->file('foto_tambahan') as $index => $foto) {
                $fileName = 'progress_multi_' . time() . '_' . Str::random(10) . '_' . $index . '.' . $foto->getClientOriginalExtension();
                $path = $foto->storeAs('progress_fotos/multiple', $fileName, 'public');

                Multipleuploads::create([
                    'ref_table' => 'progres_proyek',
                    'ref_id' => $progres->progres_id,
                    'filename' => $fileName,
                    'original_name' => $foto->getClientOriginalName(),
                    'mime_type' => $foto->getMimeType(),
                    'file_size' => $foto->getSize(),
                    'file_path' => $path,
                    'sort_order' => $index
                ]);
            }
        }

        return redirect()->route('progres.index')
            ->with('success', 'Progress proyek berhasil ditambahkan!');
    }

    public function show($id)
    {
        $progres = ProgresProyek::with(['proyek', 'tahapan', 'fotos'])->findOrFail($id);
        return view('pages.progres.show', compact('progres'));
    }

    public function edit($id)
    {
        $progres = ProgresProyek::with('fotos')->findOrFail($id);
        $proyeks = Proyek::all();
        $tahapans = TahapanProyek::with('proyek')->get();

        return view('pages.progres.edit', compact('progres', 'proyeks', 'tahapans'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'proyek_id'     => 'required|exists:proyeks,proyek_id',
            'tahap_id'      => 'required|exists:tahapan_proyek,tahap_id',
            'persen_real'   => 'required|numeric|min:0|max:100',
            'tanggal'       => 'required|date',
            'catatan'       => 'nullable|string|max:1000',
            'foto_progres'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_tambahan.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'hapus_foto'    => 'nullable|boolean',
        ]);

        // Cek relasi proyek dan tahapan
        $tahapan = TahapanProyek::find($request->tahap_id);
        if ($tahapan && $tahapan->proyek_id != $request->proyek_id) {
            return redirect()->back()
                ->with('error', 'Tahapan tidak termasuk dalam proyek yang dipilih')
                ->withInput();
        }

        $progres = ProgresProyek::findOrFail($id);

        // Handle foto utama
        if ($request->has('hapus_foto') && $request->hapus_foto) {
            // Hapus foto lama jika ada
            if ($progres->foto_progres && Storage::disk('public')->exists($progres->foto_progres)) {
                Storage::disk('public')->delete($progres->foto_progres);
            }
            $validated['foto_progres'] = null;
        } elseif ($request->hasFile('foto_progres')) {
            // Hapus foto lama jika ada
            if ($progres->foto_progres && Storage::disk('public')->exists($progres->foto_progres)) {
                Storage::disk('public')->delete($progres->foto_progres);
            }

            // Upload foto baru
            $foto = $request->file('foto_progres');
            $fileName = 'progress_' . time() . '_' . Str::random(10) . '.' . $foto->getClientOriginalExtension();
            $path = $foto->storeAs('progress_fotos', $fileName, 'public');
            $validated['foto_progres'] = $path;
        } else {
            // Pertahankan foto yang ada
            $validated['foto_progres'] = $progres->foto_progres;
        }

        // Update progress
        $progres->update($validated);

        // Upload multiple foto tambahan baru
        if ($request->hasFile('foto_tambahan')) {
            $existingCount = $progres->fotos->count();

            foreach ($request->file('foto_tambahan') as $index => $foto) {
                $fileName = 'progress_multi_' . time() . '_' . Str::random(10) . '_' . ($existingCount + $index) . '.' . $foto->getClientOriginalExtension();
                $path = $foto->storeAs('progress_fotos/multiple', $fileName, 'public');

                Multipleuploads::create([
                    'ref_table' => 'progres_proyek',
                    'ref_id' => $progres->progres_id,
                    'filename' => $fileName,
                    'original_name' => $foto->getClientOriginalName(),
                    'mime_type' => $foto->getMimeType(),
                    'file_size' => $foto->getSize(),
                    'file_path' => $path,
                    'sort_order' => $existingCount + $index
                ]);
            }
        }

        return redirect()->route('progres.index')
            ->with('success', 'Progress proyek berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $progres = ProgresProyek::with('fotos')->findOrFail($id);

        // Hapus foto utama jika ada
        if ($progres->foto_progres && Storage::disk('public')->exists($progres->foto_progres)) {
            Storage::disk('public')->delete($progres->foto_progres);
        }

        // Hapus semua foto tambahan
        foreach ($progres->fotos as $foto) {
            if (Storage::disk('public')->exists($foto->file_path)) {
                Storage::disk('public')->delete($foto->file_path);
            }
            $foto->delete();
        }

        // Hapus progress
        $progres->delete();

        return redirect()->route('progres.index')
            ->with('success', 'Progress proyek berhasil dihapus!');
    }

    /**
     * Hapus foto tambahan
     */
    public function hapusFotoTambahan($id, $fotoId)
    {
        try {
            $progres = ProgresProyek::findOrFail($id);
            $foto = Multipleuploads::where('id', $fotoId)
                    ->where('ref_table', 'progres_proyek')
                    ->where('ref_id', $id)
                    ->firstOrFail();

            // Hapus file dari storage
            if (Storage::disk('public')->exists($foto->file_path)) {
                Storage::disk('public')->delete($foto->file_path);
            }

            // Hapus dari database
            $foto->delete();

            return response()->json([
                'success' => true,
                'message' => 'Foto berhasil dihapus'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus foto: ' . $e->getMessage()
            ], 500);
        }
    }
}
