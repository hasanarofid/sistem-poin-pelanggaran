<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Kelas;
use Illuminate\Support\Facades\Hash;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Mapping username ke kelas
        $guruData = [
            // Kelas X
            'XBD1' => 'X BD 1',
            'XBD2' => 'X BD 2',
            'XDPIB1' => 'X DPIB 1',
            'XDPIB2' => 'X DPIB 2',
            'XTSM1' => 'X TSM 1',
            'XTSM2' => 'X TSM 2',
            'XRPL1' => 'X RPL 1',
            'XRPL2' => 'X RPL 2',
            'XTITL1' => 'X TITL 1',
            'XTITL2' => 'X TITL 2',
            
            // Kelas XI
            'XIBD1' => '11 BD 1',
            'XIBD2' => '11 BD 2',
            'XIBD3' => '11 BD 3',
            'XIDPIB1' => '11 DPIB 1',
            'XIDPIB2' => '11 DPIB 2',
            'XITSM1' => '11 TSM 1',
            'XITSM2' => '11 TSM 2',
            'XIRPL1' => '11 RPL 1',
            'XIRPL2' => '11 RPL 2',
            'XIRPL3' => '11 RPL 3',
            'XITITL1' => '11 TITL 1',
            'XITITL2' => '11 TITL 2',
            
            // Kelas XII (jika ada)
            'XIIBD1' => 'XII BD 1',
            'XIIBD2' => 'XII BD 2',
            'XIIBD3' => 'XII BD 3',
            'XIIDPIB1' => 'XII DPIB 1',
            'XIIDPIB2' => 'XII DPIB 2',
            'XIITSM1' => 'XII TSM 1',
            'XIITSM2' => 'XII TSM 2',
            'XIIRPL1' => 'XII RPL 1',
            'XIIRPL2' => 'XII RPL 2',
            'XIIRPL3' => 'XII RPL 3',
            'XIITITL1' => 'XII TITL 1',
            'XIITITL2' => 'XII TITL 2',
        ];

        foreach ($guruData as $username => $kelasName) {
            // Cari kelas berdasarkan subkelas
            $kelas = Kelas::where('subkelas', $kelasName)->first();
            
            if ($kelas) {
                // Buat user guru
                User::updateOrCreate(
                    ['username' => $username],
                    [
                        'name' => 'Walas ' . $kelasName,
                        'email' => strtolower($username) . '@SMKN12.school',
                        'username' => $username,
                        'password' => Hash::make('guru123'),
                        'role' => 'Guru',
                        'kelas_id' => $kelas->id,
                        'foto_profile' => 'userdefault.jpg',
                        'nip' => 'GURU' . str_pad($kelas->id, 6, '0', STR_PAD_LEFT),
                        'jenjang_jabatan' => 'Guru Kelas',
                        'pangkat' => 'Guru Muda',
                        'gol_ruang' => 'III/a',
                        'no_telp' => '08' . str_pad($kelas->id, 10, '0', STR_PAD_LEFT),
                        'kota' => 'Jakarta',
                        'alamat_lengkap' => 'Alamat Guru ' . $kelasName,
                        'kode_area' => 21,
                        'kabupaten_id' => 1,
                    ]
                );
                
                $this->command->info("Guru {$username} untuk kelas {$kelasName} berhasil dibuat");
            } else {
                $this->command->warn("Kelas {$kelasName} tidak ditemukan untuk username {$username}");
            }
        }
        
        $this->command->info('Seeder Guru selesai dijalankan!');
    }
}