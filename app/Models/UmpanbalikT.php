<?php

namespace App\Models;

use App\User;
use App\TanggapanUmpanbalikT;
use App\Models\RencanaKerjaT;
use Illuminate\Database\Eloquent\Model;

class UmpanbalikT extends Model
{
    protected $table = 'umpanbalik_t';
    public function pengawasnama()
    {
        return $this->hasOne(User::class, 'id', 'id_pengawas');
    }

    public function rencanakerja()
    {
        return $this->hasOne(RencanaKerjaT::class, 'id', 'id_pelaporan');
    }

    public function tanggapanUmpanBalik()
    {
        return $this->hasMany(TanggapanUmpanbalikT::class, 'id_umpanbalik');
    }
    
}
