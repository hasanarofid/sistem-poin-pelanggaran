<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InputPelanggaranController extends Controller
{
    //index
    public function index(){
        return view('inputpelanggaran.index');
    }
}
