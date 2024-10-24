<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Pelaporan extends Model
{
    protected $table = 'pelaporan';

    public function tugaskerja()
    {
        return $this->hasOne(TugaskerjaT::class, 'id', 'id_tugas');
    }
    public function pengawas()
    {
        return $this->hasOne(User::class, 'id', 'id_pengawas');

    }

    public function kategoriprogram()
    {
        return $this->hasOne(Kategory::class, 'id', 'kategori');
    }
}
