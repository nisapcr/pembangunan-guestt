<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Proyek; 

class TahapanProyek extends Model
{
    protected $table = 'tahapan_proyek';

    protected $primaryKey = 'tahap_id'; // ⚠ GANTI sesuai nama kolom di DB kamu

    public $timestamps = false;

    protected $fillable = [
        'proyek_id',
        'nama_tahapan',
        'deskripsi',
        'target_persen',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date'
    ];

    public function proyek()
    {
        return $this->belongsTo(Proyek::class, 'proyek_id');
    }
}
