<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    use HasFactory;

    protected $table = 'proyek';
    protected $primaryKey = 'proyek_id';

    // Tambahkan ini untuk Eloquent tahu ini auto-increment
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'kode_proyek',
        'nama_proyek',
        'tahun',
        'lokasi',
        'anggaran',
        'sumber_dana',
        'deskripsi',
        'dokumen'
    ];

    protected $casts = [
        'tahun' => 'integer',
        'anggaran' => 'decimal:2'
    ];
}
