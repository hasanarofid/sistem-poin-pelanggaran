<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $fillable = [
        'nama_kelas',
        'subkelas',
        'deskripsi',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    // Relasi dengan siswa
    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }

    // Scope untuk kelas aktif
    public function scopeAktif($query)
    {
        return $query->where('status', true);
    }
}
