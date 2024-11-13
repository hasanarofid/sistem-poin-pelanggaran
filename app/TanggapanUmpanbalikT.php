<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TanggapanUmpanbalikT extends Model
{
    protected $table = 'tanggapan_umpanbalik_t';

    public function umpanBalikT()
    {
        return $this->hasOne(UmpanbalikT::class, 'id', 'id_umpanbalik');
    }
}
