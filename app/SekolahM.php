<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SekolahM extends Model
{
        protected $table = 'sekolah_m';

        public function guru()
        {
                return $this->hasMany(GuruM::class, 'sekolah_id', 'id')->where('jabatan', 'guru');    
        }

        public function kepalaSekolah()
        {
                return $this->hasMany(GuruM::class, 'sekolah_id', 'id')->where('jabatan', 'Kepala Sekolah');    
        }

        public function gurukepalaSekolah()
        {
                return $this->hasMany(GuruM::class, 'sekolah_id', 'id');    
        }
        
}
