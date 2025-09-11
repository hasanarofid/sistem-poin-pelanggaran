<?php

namespace App\Models;

use App\Siswa;
use Illuminate\Database\Eloquent\Model;

class InputPelanggaranT extends Model
{
    protected $table = 'input_pelanggaran_t';
    protected $guarded = [];

    public function jenispelanggaran()
    {
        return $this->belongsTo(jenispelanggaran::class, 'jenis_pelanggaran_id');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
