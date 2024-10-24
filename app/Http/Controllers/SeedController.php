<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;

class SeedController extends Controller
{
    public function seed(){
        Artisan::call('db:seed');
        return "Database Seeded!";
    }
}
