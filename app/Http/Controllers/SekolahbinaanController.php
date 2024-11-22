<?php

namespace App\Http\Controllers;

use App\Models\SekolahbinaanT;
use Illuminate\Http\Request;
use Auth;

class SekolahbinaanController extends Controller
{
     //index
     public function index(){
        $binaan = SekolahbinaanT::with('sekolah','sekolah.kepalaSekolah')
        ->where('id_pengawas',Auth::user()->id)->get();
        // dd($binaan);
        return view('dashboard_pengawas.sekolahbinaan.index',
        compact('binaan')
    );
    }
}
