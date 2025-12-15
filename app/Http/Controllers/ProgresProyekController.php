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
        $filterableColumns = ['proyek_id', 'tahap_id'];
        $searchableColumns = ['catatan'];

        $progress = ProgresProyek::with(['proyek', 'tahapan', 'fotos'])
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->orderBy('tanggal', 'desc')
            ->paginate(10)
            ->withQueryString();

        $baseQuery = ProgresProyek::filter($request, $filterableColumns)
            ->search($request, $searchableColumns);

        return view('pages.progres.index', [
            'progress'      => $progress,
            'totalProgress' => $baseQuery->count(),
            'avgProgress'   => $baseQuery->avg('persen_real'),
            'maxProgress'   => $baseQuery->max('persen_real'),
            'minProgress'   => $baseQuery->min('persen_real'),
            'proyeks'       => Proyek::all(),
            'tahapans'      => TahapanProyek::with('proyek')->get(),
        ]);
    }

    public function create()
    {
        return view('pages.progres.create', [
            'proyeks'  => Proyek::all(),
            'tahapans' => TahapanProyek::with('proyek')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'proyek_id'    => 'required|exists:proyeks,proyek_id',
            'tahap_id'     => 'required|exists:tahapan_proyek,id', // ✅ FIX
            'persen_real'  => 'required|numeric|min:0|max:100',
            'tanggal'      => 'required|date',
            'catatan'      => 'nullable|string',
            'foto_progres' => 'nullable|image|max:2048',
        ]);

        // validasi relasi proyek & tahap
        $tahapan = TahapanProyek::findOrFail($validated['tahap_id']);
        if ($tahapan->proyek_id != $validated['proyek_id']) {
            return back()->withInput()->withErrors([
                'tahap_id' => 'Tahapan tidak sesuai dengan proyek'
            ]);
        }

        // upload foto
        if ($request->hasFile('foto_progres')) {
            $validated['foto_progres'] =
                $request->file('foto_progres')
                ->store('progress_fotos', 'public');
        }

        $progres = ProgresProyek::create($validated);

        return redirect()->route('progres.index')
            ->with('success', 'Progress berhasil ditambahkan');
    }

    public function edit($id)
    {
        return view('pages.progres.edit', [
            'progres'  => ProgresProyek::with('fotos')->findOrFail($id),
            'proyeks'  => Proyek::all(),
            'tahapans' => TahapanProyek::with('proyek')->get(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $progres = ProgresProyek::findOrFail($id);

        $validated = $request->validate([
            'proyek_id'    => 'required|exists:proyeks,proyek_id',
            'tahap_id'     => 'required|exists:tahapan_proyek,id', // ✅ FIX
            'persen_real'  => 'required|numeric|min:0|max:100',
            'tanggal'      => 'required|date',
            'catatan'      => 'nullable|string',
            'foto_progres' => 'nullable|image|max:2048',
            'hapus_foto'   => 'nullable|boolean',
        ]);

        if ($request->boolean('hapus_foto')) {
            if ($progres->foto_progres) {
                Storage::disk('public')->delete($progres->foto_progres);
            }
            $validated['foto_progres'] = null;
        }

        if ($request->hasFile('foto_progres')) {
            if ($progres->foto_progres) {
                Storage::disk('public')->delete($progres->foto_progres);
            }
            $validated['foto_progres'] =
                $request->file('foto_progres')
                ->store('progress_fotos', 'public');
        }

        $progres->update($validated);

        return redirect()->route('progres.index')
            ->with('success', 'Progress berhasil diperbarui');
    }

    public function destroy($id)
    {
        $progres = ProgresProyek::with('fotos')->findOrFail($id);

        if ($progres->foto_progres) {
            Storage::disk('public')->delete($progres->foto_progres);
        }

        foreach ($progres->fotos as $foto) {
            Storage::disk('public')->delete($foto->file_path);
            $foto->delete();
        }

        $progres->delete();

        return back()->with('success', 'Progress berhasil dihapus');
    }
    public function show($id)
{
    $progres = ProgresProyek::with([
        'proyek',
        'tahapan',
        'fotos'
    ])->findOrFail($id);

    return view('pages.progres.show', compact('progres'));
}

}
