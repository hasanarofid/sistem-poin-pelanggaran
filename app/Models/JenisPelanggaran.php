<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisPelanggaran extends Model
{
    protected $table = 'jenis_pelanggaran';

    protected $fillable = [
        'nama_pelanggaran',
        'kategori_id',
        'poin',
        'deskripsi',
    ];

    // public function kategori()
    // {
    //     return $this->belongsTo(Kategori::class, 'kategori_id');
    // }
}
