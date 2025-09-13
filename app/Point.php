<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $table = 'point_t';
    protected $fillable = [
        'siswa_id',
        'total_poin'
    ];

    protected $casts = [
        'total_poin' => 'integer'
    ];

    // Relasi dengan siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    // Relasi dengan histori poin
    public function historiPoints()
    {
        return $this->hasMany(HistoriPoint::class, 'point_id');
    }

    // Method untuk update poin dengan histori
    public function updatePoin($perubahan, $jenisTransaksi, $inputPelanggaranId = null, $keterangan = null, $inputBy = null)
    {
        $poinSebelum = $this->total_poin;
        $poinSesudah = $poinSebelum + $perubahan;

        // Update poin
        $this->update(['total_poin' => $poinSesudah]);

        // Buat histori
        HistoriPoint::create([
            'siswa_id' => $this->siswa_id,
            'point_id' => $this->id,
            'jenis' => $jenisTransaksi,
            'input_pelanggaran_id' => $inputPelanggaranId,
            'poin_sebelum' => $poinSebelum,
            'poin_perubahan' => $perubahan,
            'poin_sesudah' => $poinSesudah,
            'keterangan' => $keterangan,
            'input_by' => $inputBy ?? auth()->id()
        ]);

        return $this;
    }
}
