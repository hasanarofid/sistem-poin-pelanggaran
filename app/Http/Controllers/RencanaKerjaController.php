<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RencanaKerjaT;



class RencanaKerjaController extends Controller
{
    //index
    public function index(){
        $rencanaKerja = RencanaKerjaT::all();

        $dates = $rencanaKerja->pluck('created_at')->map(function ($date) {
            return $date->format('Y-m-d');
        });
        $jumlahRencanaKerja = $rencanaKerja->count();
    
        // Count data per sekolah_id
        $rencanaPerSekolah = $rencanaKerja->groupBy('sekolah_id')->map(function ($item) {
            return $item->count();
        });
    
        return view('dashboard_pengawas.rencanakerja.index',
        compact('dates','jumlahRencanaKerja','rencanaPerSekolah')
    );
    }
}
