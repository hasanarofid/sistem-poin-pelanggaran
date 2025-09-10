<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id'=>1,
                'name'=>'Admin Gita',
                'email'=>'admin@gmail.com',
                'username'=>'superadmin',
                'password'=>Hash::make('admin12'),
                'role'=>'Super Admin',
                'nip'=>'',
                'foto_profile'=>'userdefault.jpg',
                'jenjang_jabatan'=>'',
                'pangkat'=>'',
                'gol_ruang'=>'',
                'kabupaten_id'=>0
            ],
              [
                'id'=>2,
                'name'=>'Admin Wilayah Seragon',
                'email'=>'adminseragon@gmail.com',
                'username'=>'adminseragon',
                'password'=>Hash::make('admin12'),
                'role'=>'Admin',
                'nip'=>'',
                'foto_profile'=>'userdefault.jpg',
                'jenjang_jabatan'=>'',
                'pangkat'=>'',
                'gol_ruang'=>'',
                'kabupaten_id'=>1
            ],
            [
                'id'=>3,
                'name'=>'Hasan',
                'email'=>'hasan@gmail.com',
                'username'=>'hasan',
                'password'=>Hash::make('hasan12345'),
                'role'=>'Pengawas',
                'nip'=>'15481548745154687',
                'foto_profile'=>'userdefault.jpg',
                'jenjang_jabatan'=>'Pengawas Sekolah Utama',
                'pangkat'=>'Pembina Utama',
                'gol_ruang'=>'IV/d',
                'kabupaten_id'=>1
            ],
            [
                'id'=>4,
                'name'=>'Akbar',
                'email'=>'akbar@gmail.com',
                'username'=>'akbar',
                'password'=>Hash::make('akbar12345'),
                'role'=>'Stakeholder',
                'nip'=>'',
                'foto_profile'=>'userdefault.jpg',
                'jenjang_jabatan'=>'',
                'pangkat'=>'',
                'gol_ruang'=>'',
                'kabupaten_id'=>1
            ],
            [
                'id'=>5,
                'name'=>'Dr. Eko Supraptono, M.Si.',
                'email'=>'ekosupraptono@gmail.com',
                'username'=>'ekosupraptono',
                'password'=>Hash::make('pengawas123'),
                'role'=>'Pengawas',
                'nip'=>'196404151992031006',
                'foto_profile'=>'userdefault.jpg',
                'jenjang_jabatan'=>'Pengawas Sekolah Utama',
                'pangkat'=>'Pembina Utama',
                'gol_ruang'=>'IV/d',
                'kabupaten_id'=>1
            ],
            [
                'id'=>6,
                'name'=>'guru',
                'email'=>'guru@gmail.com',
                'username'=>'guru',
                'password'=>Hash::make('guru12'),
                'role'=>'guru',
                'nip'=>'',
                'foto_profile'=>'userdefault.jpg',
                'jenjang_jabatan'=>'Guru',
                'pangkat'=>'',
                'gol_ruang'=>'',
                'kabupaten_id'=>1
            ],
            
            
        ]);
    }
}