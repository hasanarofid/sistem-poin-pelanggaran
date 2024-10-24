<?php

namespace App\Models;

use App\SekolahM;
use App\User;
use Illuminate\Database\Eloquent\Model;

class SekolahbinaanT extends Model
{
    protected $table = 'sekolahbinaan_t';
    public function sekolah()
    {
        return $this->hasOne(SekolahM::class, 'id', 'id_sekolah');

    }

    public function pengawas()
    {
        return $this->hasOne(User::class, 'id', 'id_pengawas');

    }
}
