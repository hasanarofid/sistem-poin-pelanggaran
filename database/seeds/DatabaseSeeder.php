<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(
            [
                UsersTableSeeder::class,
                ProfilesTableSeeder::class,
                MasterKabupaten2Seeder::class, 
                MarketplaceTableSeeder::class,
                SekolahMSeeder::class,
                GuruMSeeder::class,
                GolPangkatRuangSeeder::class,
                MasterTupoksiSeeder::class,
                SekolahBinaanTSeeder::class,
                TugaskerjaTSeeder::class,
                UmpanbalikMSeeder::class,
                KategorySeeder::class,
                SubKategorySeeder::class,
            ]);
    }
}