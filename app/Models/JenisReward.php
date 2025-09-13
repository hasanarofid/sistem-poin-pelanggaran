<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisReward extends Model
{
    protected $table = 'jenis_reward';
    protected $fillable = [
        'kode',
        'nama_reward',
        'kategori_id',
        'poin',
        'deskripsi',
        'is_aktif'
    ];

    protected $casts = [
        'poin' => 'integer',
        'is_aktif' => 'boolean'
    ];

    // Relasi dengan kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    // Scope untuk reward aktif
    public function scopeAktif($query)
    {
        return $query->where('is_aktif', true);
    }
}
