<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    //index
    public function index(){
        return view('laporan.index');
    }
}
