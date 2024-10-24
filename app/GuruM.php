<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuruM extends Model
{
        protected $table = 'guru_m';

          public function sekolah()
    {
        return $this->hasOne(SekolahM::class, 'id', 'sekolah_id');

    }



}
