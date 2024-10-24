<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterumpanbalikController extends Controller
{
   //index
   public function index(){
    return view('dashboard_pengawas.masterumpanbalik.index');
}
}
