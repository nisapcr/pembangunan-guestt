<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    use HasFactory;

    // Tentukan nama tabel
    protected $table = 'warga';

    // Tentukan primary key
    protected $primaryKey = 'warga_id';

    // Tentukan field yang bisa diisi
    protected $fillable = [
        'no_ktp',
        'nama',
        'jenis_kelamin', 
        'agama',
        'pekerjaan',
        'telp',
        'email'
    ];

    // Non-aktifkan timestamps jika tidak perlu
    public $timestamps = true;
}