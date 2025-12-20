<?php

namespace App\Http\Controllers;

use App\Models\Multipleuploads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MultipleuploadsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('multipleuploads');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ref_table' => 'required|string|max:100',
            'ref_id' => 'required|integer',
            'filename' => 'required|array',
            'filename.*' => 'required|file|mimes:jpg,jpeg,png,gif,pdf,doc,docx,xls,xlsx|max:5120',


        ]);

            if ($request->hasFile('filename')) {

            $files = [];

            foreach ($request->file('filename') as $file) {
                if ($file->isValid()) {
                    // Generate nama file unik
                    $originalName = $file->getClientOriginalName();
                    $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                    // Simpan file ke folder sesuai tabel
                    $folder = $request->ref_table;
                    $filePath = $file->storeAs($folder, $filename, 'public');

                    $files[] = [
                        'ref_table' => $request->ref_table,
                        'ref_id' => $request->ref_id,
                        'filename' => $filename,
                        'original_name' => $originalName,
                        'caption' => $request->caption,
                        'mime_type' => $file->getMimeType(),
                        'file_size' => $file->getSize(),
                        'file_path' => $filePath,
                        'sort_order' => Multipleuploads::where('ref_table', $request->ref_table)
                                                    ->where('ref_id', $request->ref_id)

                                                    ->max('sort_order') ?? 0 + 1

                    ];
                }
            }

            if (!empty($files)) {
                Multipleuploads::insert($files);
                return response()->json([
                    'success' => true,
                    'message' => 'Files uploaded successfully!'
                ]);
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'No valid files to upload'
        ], 400);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Not needed for now
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Not needed for now
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Not needed for now
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $file = Multipleuploads::findOrFail($id);

        // Hapus file dari storage
        if ($file->file_path) {
            Storage::disk('public')->delete($file->file_path);
        }

        $file->delete();

        return response()->json([
            'success' => true,
            'message' => 'File deleted successfully!'
        ]);
    }

    /**
     * Get files by reference
     */
    public function getByReference(Request $request)
    {
        $request->validate([
            'ref_table' => 'required|string',
            'ref_id' => 'required|integer'
        ]);

        $files = Multipleuploads::byReference($request->ref_table, $request->ref_id)->get();

        return response()->json([
            'success' => true,
            'files' => $files
        ]);
    }
}
