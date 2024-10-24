<?php

namespace App\Imports;

use App\User;
use App\Profile;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToArray;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException; 
use Auth;

class ImportUser implements ToArray
{
    public function array(array $rows)
    {
        try {
               $rows = array_slice($rows, 1);
            foreach ($rows as $row) {
                try {
                // Insert data into the database
                 
                if(Auth::user()->role == 'Super Admin'){
                    $kabupaten_id = 1;
                }else if(Auth::user()->role == 'Admin' || Auth::user()->role == 'Stakeholder' ){
                    $kabupaten_id = Auth::user()->kabupaten_id;
        
                }


                $row = array_map(function ($value) {
                    return str_replace("‘", "", $value); // Menghapus karakter `‘`
                }, $row);
                $user = new User;
                $user->name = $row[0];
                $user->nip = $row[1]; // Menghapus tanda kutip dari NIP
                $user->jenjang_jabatan = $row[2];
                $user->pangkat = $row[3];
                $user->gol_ruang = $row[4];
                $user->email = $row[5];
                $user->no_telp = $row[7]; // Menghapus tanda kutip dari NIP
                $user->foto_profile = 'userdefault.jpg';
                $user->role = 'Pengawas';
                $user->password = Hash::make($row[6]);
                $user->kabupaten_id = $kabupaten_id;
                
                $user->save();
                $userId = $user->id;
                $profile = new Profile;
                
                $profile->no_telp = $row[7];
                $profile->alamat_lengkap = $row[8];
                $profile->kota = $row[9];
                $profile->kode_area = $row[10];
                $profile->no_telp = $row[7];
                $profile->user_id = $userId;
                $profile->save();
                
            
        }   catch (QueryException $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }

     


             

         
        }
    
        } catch (Exception $e) {
            // Handle any other exceptions that might occur outside the loop
            // For example, log the error or handle it gracefully
                return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
            
        }

             



        // return true;

        
        // Process each row of data here
        // $rows will contain the Excel data as an array of arrays (rows)
    }

    
}
