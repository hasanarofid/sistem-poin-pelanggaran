<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Buat user admin
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Administrator',
                'email' => 'admin@sistempoin.com',
                'username' => 'admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'nip' => '123456789012345678',
                'no_telp' => '081234567890',
                'kota' => 'Jakarta',
                'alamat_lengkap' => 'Jl. Admin No. 1',
                'kode_area' => 1,
                'kabupaten_id' => 1,
            ]
        );

        // Buat user guru
        User::updateOrCreate(
            ['username' => 'guru'],
            [
                'name' => 'Guru',
                'email' => 'guru@sistempoin.com',
                'username' => 'guru',
                'password' => Hash::make('guru123'),
                'role' => 'guru',
                'nip' => '123456789012345679',
                'no_telp' => '081234567891',
                'kota' => 'Jakarta',
                'alamat_lengkap' => 'Jl. Guru No. 1',
                'kode_area' => 1,
                'kabupaten_id' => 1,
            ]
        );

        // Buat user siswa
        User::updateOrCreate(
            ['username' => 'siswa'],
            [
                'name' => 'Siswa',
                'email' => 'siswa@sistempoin.com',
                'username' => 'siswa',
                'password' => Hash::make('siswa123'),
                'role' => 'siswa',
                'nip' => null,
                'no_telp' => '081234567892',
                'kota' => 'Jakarta',
                'alamat_lengkap' => 'Jl. Siswa No. 1',
                'kode_area' => 1,
                'kabupaten_id' => 1,
            ]
        );

        $this->command->info('User dengan role admin, guru, dan siswa berhasil dibuat!');
        $this->command->info('Username: admin, Password: admin123');
        $this->command->info('Username: guru, Password: guru123');
        $this->command->info('Username: siswa, Password: siswa123');
    }
}
