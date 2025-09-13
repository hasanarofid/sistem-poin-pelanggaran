<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoriPoint extends Model
{
    protected $table = 'historipoint_t';
    protected $fillable = [
        'siswa_id',
        'point_id',
        'jenis',
        'input_pelanggaran_id',
        'poin_sebelum',
        'poin_perubahan',
        'poin_sesudah',
        'keterangan',
        'input_by'
    ];

    protected $casts = [
        'poin_sebelum' => 'integer',
        'poin_perubahan' => 'integer',
        'poin_sesudah' => 'integer'
    ];

    // Relasi dengan siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    // Relasi dengan point
    public function point()
    {
        return $this->belongsTo(Point::class, 'point_id');
    }

    // Relasi dengan input pelanggaran
    public function inputPelanggaran()
    {
        return $this->belongsTo(\App\Models\InputPelanggaranT::class, 'input_pelanggaran_id');
    }

    // Relasi dengan jenis pelanggaran melalui input pelanggaran
    public function jenisPelanggaran()
    {
        return $this->hasOneThrough(
            \App\Models\JenisPelanggaran::class,
            \App\Models\InputPelanggaranT::class,
            'id', // Foreign key on input_pelanggaran_t table
            'id', // Foreign key on jenis_pelanggaran table
            'input_pelanggaran_id', // Local key on historipoint_t table
            'jenis_pelanggaran_id' // Local key on input_pelanggaran_t table
        );
    }

    // Relasi dengan user yang input
    public function inputBy()
    {
        return $this->belongsTo(\App\User::class, 'input_by');
    }
}
