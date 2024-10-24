<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class MarketplaceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profilemarketpalces')->insert([
            [
                'id'=>1,
                'title'=>'Gita Talavial',
                'diskripsi'=>'by Andi B Fransiska',
                'address'=>'Jogjakarta',
                'zipcode'=>3055,
                'email'=>'hasanarofid@gitatalavial.com',
                'telpon'=>'0813242424',
                'social1'=>'facebok.com/gitatalavial',
                'social2'=>'instagram.com/gitatalavial',
                'social3'=>'theards.com/gitatalavial',
                'social4'=>'twitter.com/gitatalavial',
                'logo'=>'logogita.jpeg',
                'favicon'=>'logogita.jpeg',
                'kota'=>'Yogjakarta'
            ],
          

        ]);
    }
}
