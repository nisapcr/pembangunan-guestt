<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TahapanStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'proyek_id' => 'required|exists:proyek,proyek_id',
            'nama_tahap' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'target_persen' => 'required|integer|min:0|max:100',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'status' => 'required|in:pending,in_progress,completed'
        ];
    }
}
