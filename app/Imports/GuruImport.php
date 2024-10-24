<?php

namespace App\Imports;

use App\GuruM;
use App\SekolahM;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToArray;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException; 

class GuruImport implements ToArray
{
    public function array(array $rows)
    {
        try {
               $rows = array_slice($rows, 1);
            foreach ($rows as $row) {
              
                // Insert data into the database
                 
                $carisekolah = SekolahM::where('nama_sekolah',$row[0])->first();
                        //    var_dump($carisekolah->id);die;
                $guru = new GuruM();
                $guru->nama = $row[1];
                $guru->no_telp = $row[3];
                $guru->jabatan = $row[2];
                $guru->alamat_lengkap = $row[4];
                $guru->kota = $row[5];
                $guru->kode_area = $row[6];
                $guru->sekolah_id = $carisekolah->id;
                $guru->is_aktif = true;
                $guru->save();
                
               


             

         
        }
    
} catch (Exception $e) {
             return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
     

}

             



        // return true;

        
        // Process each row of data here
        // $rows will contain the Excel data as an array of arrays (rows)
    }

    
}
