<?php

namespace App\Models;

use App\SekolahM;
use Illuminate\Database\Eloquent\Model;

class RencanaKerjaT extends Model
{
    protected $table = 'rencakakerja_t';
    public function kategoriprogram()
    {
        return $this->hasOne(Kategory::class, 'id', 'kategoriprogram_id');
    }

    public function jenisprogram()
    {
        return $this->hasOne(JenisProgram::class, 'id', 'jenisprogram_id');
    }

    public function aspekprogram()
    {
        return $this->hasOne(AspekProgram::class, 'id', 'aspekprogram_id');
    }

}
