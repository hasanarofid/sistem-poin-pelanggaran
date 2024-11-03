<?php

namespace App\Imports;

use App\GuruM;
use App\SekolahM;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToArray;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException; 
use Exception;
use Illuminate\Support\Facades\Validator;
class GuruImport implements ToArray
{
    public function array(array $rows)
    {
        $errors = []; // Array to collect errors
    
        try {
            $rows = array_slice($rows, 1); // Skip the header row
    
            foreach ($rows as $index => $row) {
                // Define validation rules for each row
                $validator = Validator::make([
                    'nama_sekolah' => $row[0],
                    'nama' => $row[1],
                    'jabatan' => $row[2],
                    'no_telp' => $row[3],
                    'alamat_lengkap' => $row[4],
                    'kota' => $row[5],
                    'kode_area' => $row[6],
                ], [
                    'nama_sekolah' => 'required|string',
                    'nama' => 'required|string',
                    'jabatan' => 'required|string',
                    'no_telp' => 'nullable|string',
                    'alamat_lengkap' => 'nullable|string',
                    'kota' => 'nullable|string',
                    'kode_area' => 'nullable',
                ]);
    
                // Check if validation fails
                if ($validator->fails()) {
                    // Collect detailed error messages with row number and column names
                    foreach ($validator->errors()->messages() as $field => $messages) {
                        foreach ($messages as $message) {
                            $errors[] = "Error on row " . ($index + 2) . ", column '$field': $message";
                        }
                    }
                    continue; // Skip this row and move to the next
                }
    
                // Check if the school exists
                $carisekolah = SekolahM::where('nama_sekolah', $row[0])->first();
                if (!$carisekolah) {
                    // Add an error message for missing school without inserting it
                    $errors[] = "Error on row " . ($index + 2) . ": School '" . $row[0] . "' does not exist.";
                    continue; // Skip this row and move to the next
                }
    
                // Insert data into the database
                $guru = new GuruM();
                $guru->nama = $row[1];
                $guru->no_telp = $row[3];
                $guru->jabatan = $row[2];
                $guru->alamat_lengkap = $row[4];
                $guru->kota = $row[5];
                $guru->kode_area = $row[6];
                $guru->sekolah_id = $carisekolah->id;
                $guru->kabupaten_id = $carisekolah->kabupaten_id;
                $guru->is_aktif = true;
                $guru->save();
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    
        // If there are errors, return them as a session flash message
        if (!empty($errors)) {
            return redirect()->back()->with('errors', $errors);
        }
    
        return redirect()->back()->with('success', 'Guru Import successfully');
    }
    
    
    
    // public function array(array $rows)
    // {
    //     $errors = []; // Array to collect errors
    
    //     try {
    //         $rows = array_slice($rows, 1); // Skip the header row
    
    //         foreach ($rows as $index => $row) {
    //             // Define validation rules for each row
    //             $validator = Validator::make([
    //                 'nama_sekolah' => $row[0],
    //                 'nama' => $row[1],
    //                 'jabatan' => $row[2],
    //                 'no_telp' => $row[3],
    //                 'alamat_lengkap' => $row[4],
    //                 'kota' => $row[5],
    //                 'kode_area' => $row[6],
    //             ], [
    //                 'nama_sekolah' => 'required|string',
    //                 'nama' => 'required|string',
    //                 'jabatan' => 'required|string',
    //                 'no_telp' => 'nullable|string',
    //                 'alamat_lengkap' => 'nullable|string',
    //                 'kota' => 'nullable|string',
    //                 'kode_area' => 'nullable',
    //             ]);
    
    //             // Check if validation fails
    //             if ($validator->fails()) {
    //                 // Collect detailed error messages with row number and column names
    //                 foreach ($validator->errors()->messages() as $field => $messages) {
    //                     foreach ($messages as $message) {
    //                         $errors[] = "Error on row " . ($index + 2) . ", column '$field': $message";
    //                     }
    //                 }
    //                 continue; // Skip this row and move to the next
    //             }
    
    //             // Find the school by name
    //             $carisekolah = SekolahM::where('nama_sekolah', $row[0])->first();
    //             if (!$carisekolah) {
    //                 // If the school is not found, create a new one
    //                 $kabupaten_id = 1; // Set kabupaten_id to 1 or get it based on the user's role if needed
    
    //                 $sekolah = new SekolahM();
    //                 $sekolah->nama_sekolah = $row[0];
    //                 $sekolah->npsn = '20613588'; // Set default NPSN
    //                 $sekolah->no_telp = $row[3];
    //                 $sekolah->kota = $row[5];
    //                 $sekolah->alamat_lengkap = $row[4];
    //                 $sekolah->kode_area = $row[6];
    //                 $sekolah->is_aktif = true;
    //                 $sekolah->kabupaten_id = $kabupaten_id;
    //                 $sekolah->save();
    
    //                 // Set carisekolah to the newly created school so it can be used below
    //                 $carisekolah = $sekolah;
    //             }
    
    //             // Insert data into the database
    //             $guru = new GuruM();
    //             $guru->nama = $row[1];
    //             $guru->no_telp = $row[3];
    //             $guru->jabatan = $row[2];
    //             $guru->alamat_lengkap = $row[4];
    //             $guru->kota = $row[5];
    //             $guru->kode_area = $row[6];
    //             $guru->sekolah_id = $carisekolah->id;
    //             $guru->kabupaten_id = $carisekolah->kabupaten_id;
    //             $guru->is_aktif = true;
    //             $guru->save();
    //         }
    //     } catch (Exception $e) {
    //         return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
    //     }
    
    //     // If there are errors, return them as a session flash message
    //     if (!empty($errors)) {
    //         return redirect()->back()->with('errors', $errors);
    //     }
    
    //     return redirect()->back()->with('success', 'Guru Import successfully');
    // }
    
    
    


    
}
