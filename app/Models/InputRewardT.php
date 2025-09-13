<?php

namespace App\Models;

use App\Siswa;
use Illuminate\Database\Eloquent\Model;

class InputRewardT extends Model
{
    protected $table = 'input_reward_t';
    protected $fillable = [
        'siswa_id',
        'jenis_reward_id',
        'keterangan',
        'pelapor_id'
    ];

    // Relasi dengan siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    // Relasi dengan jenis reward
    public function jenisReward()
    {
        return $this->belongsTo(JenisReward::class, 'jenis_reward_id');
    }

    // Relasi dengan user pelapor
    public function pelapor()
    {
        return $this->belongsTo(\App\User::class, 'pelapor_id');
    }
}
