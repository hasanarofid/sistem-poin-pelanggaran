<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;

class MigrationController extends Controller
{
    public function migrateFresh(){
        Artisan::call('migrate:fresh --seed');
        return "Database migate fresh!";
    }
}
