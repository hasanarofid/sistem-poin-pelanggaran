<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UmpanbalikT extends Model
{
    protected $table = 'umpanbalik_t';
    public function pengawasnama()
    {
        return $this->hasOne(User::class, 'id', 'id_pengawas');
    }
    
}
