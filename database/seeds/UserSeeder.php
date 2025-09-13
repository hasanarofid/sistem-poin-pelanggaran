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
           
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['username' => $user['username']],
                $user
            );
        }
    }
}
