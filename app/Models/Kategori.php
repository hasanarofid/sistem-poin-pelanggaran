<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori_m';

    protected $fillable = [
        'nama_kategori',
        'is_aktif', // kalau kolom ini ada
    ];
}
