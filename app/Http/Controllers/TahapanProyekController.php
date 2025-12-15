<?php

namespace App\Http\Controllers;

use App\Models\TahapanProyek;
use App\Models\Proyek;
use Illuminate\Http\Request;

class TahapanProyekController extends Controller
{
public function index(Request $request)
{
    try {
        // Kolom yang bisa di-filter
        $filterableColumns = ['status', 'proyek_id'];

        // Kolom yang bisa dicari
        $searchableColumns = ['nama_tahapan',];

        // Query dengan pagination, search, dan filter
        $tahapans = TahapanProyek::with('proyek')
                    ->filter($request, $filterableColumns)
                    ->search($request, $searchableColumns)
                    ->latest()
                    ->paginate(10)
                    ->withQueryString()
                    ->onEachSide(2);

        // HITUNG STATISTIK DENGAN QUERY YANG SAMA (termasuk filter dan search)
        $baseQuery = TahapanProyek::filter($request, $filterableColumns)
                        ->search($request, $searchableColumns);

        $totalTahapan = $baseQuery->count();
        $tahapanSelesai = (clone $baseQuery)->where('status', 'completed')->count();
        $tahapanPending = (clone $baseQuery)->where('status', 'pending')->count();
        $tahapanInProgress = (clone $baseQuery)->where('status', 'in_progress')->count();

        // Ambil data proyek untuk filter
        $proyeks = Proyek::all();

        return view('pages.tahapan.index', compact(
            'tahapans',
            'totalTahapan',
            'tahapanSelesai',
            'tahapanPending',
            'tahapanInProgress',
            'proyeks'
        ));

    } catch (\Exception $e) {
        // Debug error
        // dd($e->getMessage());
        return redirect()->back()
            ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
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
        'proyek_id'       => 'required|integer',
        'nama_tahapan'    => 'required|string',
        'target_persen'   => 'required|integer|min:0|max:100',
        'tanggal_mulai'   => 'nullable|date',
        'tanggal_selesai' => 'nullable|date',
        'status'          => 'required|in:pending,in_progress,completed',
    ]);

    TahapanProyek::findOrFail($id)->update($validated);

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
