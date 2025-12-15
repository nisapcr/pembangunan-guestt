<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgresProyek extends Model
{
    use HasFactory;

    protected $table = 'progres_proyek';
    protected $primaryKey = 'progres_id';

    protected $fillable = [
        'proyek_id',
        'tahap_id',
        'persen_real',
        'tanggal',
        'catatan',
        'foto_progres' // TAMBAHKAN INI
    ];

    protected $casts = [
        'tanggal' => 'date',
        'persen_real' => 'decimal:2'
    ];

    /**
     * Relasi ke Proyek
     */
    public function proyek()
    {
        return $this->belongsTo(Proyek::class, 'proyek_id', 'proyek_id');
    }

    /**
     * Relasi ke Tahapan Proyek
     */
    public function tahapan()
    {
        return $this->belongsTo(TahapanProyek::class, 'tahap_id', 'id');
    }

    /**
     * Relasi ke Multipleuploads untuk foto-foto tambahan
     */
    public function fotos()
    {
        return $this->hasMany(Multipleuploads::class, 'ref_id', 'progres_id')
                    ->where('ref_table', 'progres_proyek');
    }

    /**
     * Get foto utama (foto_progres)
     */
    public function getFotoUtamaAttribute()
    {
        if ($this->foto_progres) {
            return asset('storage/' . $this->foto_progres);
        }
        return null;
    }

    /**
     * Scope untuk filter
     */
    public function scopeFilter($query, $request, array $filterableColumns = [])
    {
        if ($request->filled('proyek_id')) {
            $query->where('proyek_id', $request->proyek_id);
        }

        if ($request->filled('tahap_id')) {
            $query->where('tahap_id', $request->tahap_id);
        }

        return $query;
    }

    /**
     * Scope untuk search
     */
    public function scopeSearch($query, $request, array $searchableColumns = [])
    {
        if (!$request->filled('search')) {
            return $query;
        }

        $searchTerm = $request->search;
        return $query->where(function ($q) use ($searchTerm, $searchableColumns) {
            foreach ($searchableColumns as $column) {
                $q->orWhere($column, 'LIKE', '%' . $searchTerm . '%');
            }
        });
    }
}
