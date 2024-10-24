<?php

namespace App\Models;

use App\MasterTupoksi;
use Illuminate\Database\Eloquent\Model;

class TugaskerjaT extends Model
{
    protected $table = 'tugaskerja_t';

    public function tugas()
    {
        return $this->hasOne(MasterTupoksi::class, 'id', 'id_tugas');
    }

}
