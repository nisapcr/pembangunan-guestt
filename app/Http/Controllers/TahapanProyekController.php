<?php

namespace App\Http\Controllers;

use App\Models\TahapanProyek;
use App\Models\Proyek;
use Illuminate\Http\Request;

class TahapanProyekController extends Controller
{
    public function index()
    {
        $tahapans = TahapanProyek::with('proyek')->latest()->get();

        // TAMBAHKAN INI: Hitung statistik untuk card
        $totalTahapan = TahapanProyek::count();
        $tahapanSelesai = TahapanProyek::where('status', 'completed')->count();
        $tahapanPending = TahapanProyek::where('status', 'pending')->count();
        $tahapanInProgress = TahapanProyek::where('status', 'in_progress')->count();

        return view('pages.tahapan.index', compact(
            'tahapans',
            'totalTahapan',
            'tahapanSelesai',
            'tahapanPending',
            'tahapanInProgress'
        ));
    }

    public function create()
    {
        $proyeks = Proyek::all();
        return view('pages.tahapan.create', compact('proyeks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'proyek_id'         => 'required|integer',
            'nama_tahapan'      => 'required|string',
            'target_persen'     => 'required|integer|min:0|max:100',
            'tanggal_mulai'     => 'nullable|date',
            'tanggal_selesai'   => 'nullable|date',
            'status'            => 'required|string|in:pending,in_progress,completed',
        ]);

        TahapanProyek::create($validated);

        return redirect()->route('tahapan.index')
            ->with('success', 'Tahapan berhasil ditambahkan!');
    }

    public function show($id)
    {
        $tahapan = TahapanProyek::with('proyek')->findOrFail($id);
        return view('pages.tahapan.show', compact('tahapan'));
    }

    public function edit($id)
    {
        $tahapan = TahapanProyek::findOrFail($id);
        $proyeks = Proyek::all();

        return view('pages.tahapan.edit', compact('tahapan', 'proyeks'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'proyek_id'         => 'required|integer',
            'nama_tahapan'      => 'required|string',
            'target_persen'     => 'required|integer|min:0|max:100',
            'tanggal_mulai'     => 'nullable|date',
            'tanggal_selesai'   => 'nullable|date',
            'status'            => 'required|string|in:pending,in_progress,completed',
        ]);

        $tahapan = TahapanProyek::findOrFail($id);
        $tahapan->update($validated);

        return redirect()->route('tahapan.index')
            ->with('success', 'Tahapan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $tahapan = TahapanProyek::findOrFail($id);
        $tahapan->delete();

        return redirect()->route('tahapan.index')
            ->with('success', 'Tahapan berhasil dihapus!');
    }
}
