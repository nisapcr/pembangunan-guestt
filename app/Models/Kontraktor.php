<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontraktor extends Model
{
    use HasFactory;

    protected $table = 'kontraktor';
    protected $primaryKey = 'kontraktor_id';

    protected $fillable = [
        'proyek_id',
        'nama',
        'penanggung_jawab',
        'kontak',
        'alamat'
    ];

    /**
     * Relasi ke Proyek
     */
    public function proyek()
    {
        return $this->belongsTo(Proyek::class, 'proyek_id', 'proyek_id');
    }

    /**
     * Scope untuk filter
     */
    public function scopeFilter($query, $request, array $filterableColumns = [])
    {
        if ($request->filled('proyek_id')) {
            $query->where('proyek_id', $request->proyek_id);
        }

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('nama', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('penanggung_jawab', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('kontak', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('alamat', 'LIKE', '%' . $searchTerm . '%');
            });
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

    /**
     * Format kontak untuk tampilan
     */
    public function getKontakFormattedAttribute()
    {
        $kontak = preg_replace('/[^0-9]/', '', $this->kontak);

        if (strlen($kontak) === 12) {
            return '+'.substr($kontak, 0, 2).' '.substr($kontak, 2, 3).' '.substr($kontak, 5, 4).' '.substr($kontak, 9, 3);
        } elseif (strlen($kontak) === 11) {
            return '+'.substr($kontak, 0, 2).' '.substr($kontak, 2, 4).' '.substr($kontak, 6, 4).' '.substr($kontak, 10, 1);
        } elseif (strlen($kontak) === 10) {
            return '+'.substr($kontak, 0, 2).' '.substr($kontak, 2, 4).' '.substr($kontak, 6, 4);
        }

        return $this->kontak;
    }

    /**
     * Cek apakah kontak valid
     */
    public function getKontakValidAttribute()
    {
        return preg_match('/^[0-9+\-\s()]+$/', $this->kontak);
    }
}
