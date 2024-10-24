<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivitasController extends Controller
{
    //index
    public function index(){
        return view('dashboard_pengawas.activitas.index');
    }
}
