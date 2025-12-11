<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Proyek extends Model
{
    use HasFactory;

    protected $table = 'proyeks'; // TAMBAHKAN INI
    protected $primaryKey = 'proyek_id';

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

    /**
     * Get files associated with this proyek
     */
    public function files()
    {
        return $this->hasMany(\App\Models\Multipleuploads::class, 'ref_id', 'proyek_id')
                    ->where('ref_table', 'proyek');
    }

    /**
     * Get the count of files
     */
    public function getFilesCountAttribute()
    {
        return $this->files()->count();
    }

    /**
     * Get formatted anggaran
     */
    public function getFormattedAnggaranAttribute()
    {
        return 'Rp ' . number_format($this->anggaran, 0, ',', '.');
    }

    /**
     * Get status based on tahun
     */
    public function getStatusAttribute()
    {
        if ($this->tahun >= date('Y')) {
            return 'Aktif';
        } elseif ($this->tahun >= date('Y') - 1) {
            return 'Baru Selesai';
        } else {
            return 'Selesai';
        }
    }

    /**
     * Get status color
     */
    public function getStatusColorAttribute()
    {
        if ($this->tahun >= date('Y')) {
            return 'success';
        } elseif ($this->tahun >= date('Y') - 1) {
            return 'warning';
        } else {
            return 'secondary';
        }
    }
}
