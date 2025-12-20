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

    // ========== ACCESSOR UNTUK FOTO UTAMA ==========

    // Foto utama URL (dari denah_gambar)
    public function getFotoUtamaUrlAttribute()
    {
        return $this->denah_gambar ? Storage::url($this->denah_gambar) : null;
    }

    // Cek apakah ada foto utama
    public function getMemilikiFotoUtamaAttribute()
    {
        return !empty($this->denah_gambar);
    }

    // Nama file foto utama
    public function getNamaFotoUtamaAttribute()
    {
        if ($this->denah_gambar) {
            return basename($this->denah_gambar);
        }
        return null;
    }

    // ========== ACCESSOR UNTUK MEDIA ==========

    // Fix media_tambahan untuk handle typo dan path separator
public function getMediaTambahanFixedAttribute()
{
    if (empty($this->media_tambahan)) {
        return [];
    }

    if (is_array($this->media_tambahan)) {
        return $this->media_tambahan;
    }

    $decoded = json_decode($this->media_tambahan, true);

    return is_array($decoded) ? $decoded : [];
}


    // Helper untuk memperbaiki array media
    private function fixMediaArray($array)
    {
        if (!is_array($array)) {
            return [];
        }

        $fixedArray = [];
        foreach ($array as $item) {
            if (is_array($item)) {
                $fixedItem = [];
                foreach ($item as $key => $value) {
                    // Fix typo "nime" menjadi "mime"
                    if ($key === 'nime') {
                        $fixedItem['mime'] = $value;
                    }
                    // Fix path separator
                    elseif ($key === 'path' && is_string($value)) {
                        $fixedItem[$key] = str_replace('\\', '/', $value);
                    }
                    // Fix mime type separator
                    elseif ($key === 'mime' && is_string($value)) {
                        $fixedItem[$key] = str_replace('\\', '/', $value);
                    }
                    // Field lainnya
                    else {
                        $fixedItem[$key] = $value;
                    }
                }
                $fixedArray[] = $fixedItem;
            }
        }

        return $fixedArray;
    }

    // Accessor untuk media_tambahan_parsed (kompatibilitas)
    public function getMediaTambahanParsedAttribute()
    {
        return $this->media_tambahan_fixed;
    }

    // ========== ACCESSOR LAMA ==========

    // Accessor untuk denah_gambar_url (alias untuk kompatibilitas)
    public function getDenahGambarUrlAttribute()
    {
        return $this->getFotoUtamaUrlAttribute();
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
        $media = $this->media_tambahan_fixed;
        return is_array($media) && count($media) > 0;
    }

    // Accessor untuk jumlah_media_tambahan
    public function getJumlahMediaTambahanAttribute()
    {
        $media = $this->media_tambahan_fixed;
        return is_array($media) ? count($media) : 0;
    }

    // Accessor untuk media_tambahan_preview (3 item pertama)
    public function getMediaTambahanPreviewAttribute()
    {
        $media = $this->media_tambahan_fixed;
        $result = [];

        if (is_array($media) && count($media) > 0) {
            $result = array_slice($media, 0, 3);

            // Tambahkan URL untuk setiap media
            foreach ($result as &$item) {
                if (isset($item['path'])) {
                    $item['url'] = Storage::url($item['path']);
                    $item['mime_type'] = $item['mime'] ?? 'application/octet-stream';
                    $item['file_size'] = $item['size'] ?? 0;
                }
            }
        }

        return $result;
    }
}
    