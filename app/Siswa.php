<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $fillable = [
        'nis',
        'nama',
        'kelas_id',
        'hp_orang_tua',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'tahun_ajaran_id',
        'rfid',
        'finger',
        'status'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'status' => 'boolean'
    ];

    // Relasi dengan kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    // Relasi dengan tahun ajaran
    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }

    // Scope untuk siswa aktif
    public function scopeAktif($query)
    {
        return $query->where('status', true);
    }

    // Accessor untuk nama lengkap kelas
    public function getNamaKelasLengkapAttribute()
    {
        return $this->kelas ? $this->kelas->nama_kelas . ' - ' . $this->kelas->subkelas : '-';
    }
}
