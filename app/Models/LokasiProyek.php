<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LokasiProyek extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'lokasi_proyek';
    protected $primaryKey = 'lokasi_id';

    protected $fillable = [
        'proyek_id',
        'nama_lokasi',
        'alamat',
        'lat',
        'lng',
        'geojson',
        'denah_gambar',
        'media_tambahan',
        'keterangan'
    ];

    protected $casts = [
        'lat' => 'decimal:8',
        'lng' => 'decimal:8',
        'media_tambahan' => 'array'
    ];

    public function proyek()
    {
        return $this->belongsTo(Proyek::class, 'proyek_id', 'id');
    }

    // Scope untuk filter
    public function scopeFilter($query, $request, $columns)
    {
        foreach ($columns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->$column);
            }
        }
        return $query;
    }

    // Scope untuk search
    public function scopeSearch($query, $request, $columns)
    {
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($columns, $searchTerm) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $searchTerm . '%');
                }
            });
        }
        return $query;
    }

    // Accessor untuk denah gambar URL
    public function getDenahGambarUrlAttribute()
    {
        return $this->denah_gambar ? asset('storage/' . $this->denah_gambar) : null;
    }

    // Accessor untuk media tambahan URL
    public function getMediaTambahanUrlsAttribute()
    {
        if (!$this->media_tambahan) {
            return [];
        }

        $media = is_array($this->media_tambahan)
            ? $this->media_tambahan
            : json_decode($this->media_tambahan, true);

        return collect($media)->map(function ($path) {
            return asset('storage/' . $path);
        })->toArray();
    }
}
