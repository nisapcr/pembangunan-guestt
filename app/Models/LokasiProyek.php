<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class LokasiProyek extends Model
{
    protected $primaryKey = 'lokasi_id';
    protected $table = 'lokasi_proyek';

    protected $fillable = [
        'proyek_id',
        'nama_lokasi',
        'alamat',
        'lat',
        'lng',
        'geojson',
        'denah_gambar',
        'media_tambahan'
    ];

    protected $casts = [
        'media_tambahan' => 'array',
        'geojson' => 'array'
    ];

    // Relationship dengan Proyek
    public function proyek()
    {
        return $this->belongsTo(Proyek::class, 'proyek_id', 'proyek_id');
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
            $search = $request->search;
            $query->where(function($q) use ($search, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'like', "%{$search}%");
                }
            });
        }
        return $query;
    }

    // Accessor untuk denah_gambar_url
    public function getDenahGambarUrlAttribute()
    {
        return $this->denah_gambar ? Storage::url($this->denah_gambar) : null;
    }

    // Accessor untuk memiliki_koordinat
    public function getMemilikiKoordinatAttribute()
    {
        return !empty($this->lat) && !empty($this->lng);
    }

    // Accessor untuk koordinat_string
    public function getKoordinatStringAttribute()
    {
        if ($this->memiliki_koordinat) {
            return number_format($this->lat, 6) . ', ' . number_format($this->lng, 6);
        }
        return 'Tidak ada koordinat';
    }

    // Accessor untuk map_url
    public function getMapUrlAttribute()
    {
        if ($this->memiliki_koordinat) {
            return 'https://www.google.com/maps?q=' . $this->lat . ',' . $this->lng;
        }
        return '#';
    }

    // Accessor untuk memiliki_media_tambahan
    public function getMemilikiMediaTambahanAttribute()
    {
        $media = $this->media_tambahan;

        if (is_array($media) && count($media) > 0) {
            return true;
        }

        if (is_string($media) && !empty($media)) {
            $decoded = json_decode($media, true);
            return is_array($decoded) && count($decoded) > 0;
        }

        return false;
    }

    // Accessor untuk jumlah_media_tambahan
    public function getJumlahMediaTambahanAttribute()
    {
        $media = $this->media_tambahan;

        if (is_array($media)) {
            return count($media);
        }

        if (is_string($media) && !empty($media)) {
            $decoded = json_decode($media, true);
            return is_array($decoded) ? count($decoded) : 0;
        }

        return 0;
    }

    // Accessor untuk media_tambahan_preview (3 item pertama)
    public function getMediaTambahanPreviewAttribute()
    {
        $media = $this->media_tambahan;
        $result = [];

        if (is_array($media)) {
            $result = array_slice($media, 0, 3);
        } elseif (is_string($media) && !empty($media)) {
            $decoded = json_decode($media, true);
            if (is_array($decoded)) {
                $result = array_slice($decoded, 0, 3);
            }
        }

        // Tambahkan URL untuk setiap media
        foreach ($result as &$item) {
            if (isset($item['path'])) {
                $item['url'] = Storage::url($item['path']);
                $item['mime_type'] = $item['mime'] ?? 'application/octet-stream';
                $item['file_size'] = $item['size'] ?? 0;
            }
        }

        return $result;
    }
}
