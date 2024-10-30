<?php

namespace App\Models;

use App\SekolahM;
use App\User;
use Illuminate\Database\Eloquent\Model;

class RencanaKerjaT extends Model
{
    protected $table = 'rencakakerja_t';
    public function pengawasnama()
    {
        return $this->hasOne(User::class, 'id', 'id_pengawas');
    }

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
