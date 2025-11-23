<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Proyek;
use Illuminate\Database\Eloquent\Builder;

class TahapanProyek extends Model
{
    protected $table = 'tahapan_proyek';

    protected $primaryKey = 'tahap_id';

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

    /**
     * Scope untuk filter
     */
    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }
        return $query;
    }

    /**
     * Scope untuk search
     */
    public function scopeSearch($query, $request, array $columns)
    {
        if ($request->filled('search')) {
            $query->where(function($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                }
            });
        }
        return $query;
    }
}
