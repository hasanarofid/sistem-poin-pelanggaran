<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Administrator',
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin12'),
                'role' => 'admin',
                'nip' => 'ADM001',
                'kabupaten_id' => 1,
                'alamat_lengkap' => 'Alamat Admin',
                'kota' => 'Jakarta',
                'no_telp' => '081234567890'
            ],
            [
                'name' => 'Guru',
                'username' => 'guru',
                'email' => 'guru@example.com',
                'password' => Hash::make('guru12'),
                'role' => 'guru',
                'nip' => 'GRU001',
                'kabupaten_id' => 1,
                'alamat_lengkap' => 'Alamat Guru',
                'kota' => 'Jakarta',
                'no_telp' => '081234567891'
            ],
            [
                'name' => 'Siswa',
                'username' => 'siswa',
                'email' => 'siswa@example.com',
                'password' => Hash::make('siswa123'),
                'role' => 'siswa',
                'nip' => 'SWA001',
                'kabupaten_id' => 1,
                'alamat_lengkap' => 'Alamat Siswa',
                'kota' => 'Jakarta',
                'no_telp' => '081234567892'
            ]
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['username' => $user['username']],
                $user
            );
        }
    }
}
