<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multipleuploads extends Model
{
    use HasFactory;

    protected $table = 'multipleuploads';
    protected $primaryKey = 'id';

    protected $fillable = [
        'ref_table',
        'ref_id',
        'filename',
        'original_name',
        'caption',
        'mime_type',
        'file_size',
        'file_path',
        'sort_order'
    ];

    /**
     * Scope untuk mendapatkan file berdasarkan referensi
     */
    public function scopeByReference($query, $refTable, $refId)
    {
        return $query->where('ref_table', $refTable)
                    ->where('ref_id', $refId)
                    ->orderBy('sort_order');
    }
}
