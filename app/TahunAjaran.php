<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    protected $table = 'tahun_ajaran';
    
    protected $fillable = [
        'tahun_ajaran',
        'tanggal_mulai',
        'tanggal_selesai',
        'status'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'status' => 'boolean'
    ];

    // Relasi dengan siswa
    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }

    // Scope untuk tahun ajaran aktif
    public function scopeAktif($query)
    {
        return $query->where('status', true);
    }
}
