<?php

namespace App\Http\Controllers;

use App\Models\SekolahbinaanT;
use Illuminate\Http\Request;
use Auth;

class DatapengawasController extends Controller
{
    //index
    public function index(){
        $binaan = SekolahbinaanT::with('sekolah',  'pengawas.profile')
        ->where('id_pengawas', '!=', Auth::user()->id)
        ->get();
        $groupedBinaan = [];
        foreach ($binaan as $item) {
        $pengawasId = $item->pengawas->id;
        if (!isset($groupedBinaan[$pengawasId])) {
            $groupedBinaan[$pengawasId] = [
                'pengawas' => $item->pengawas,
                'sekolahs' => [],
            ];
        }
        $groupedBinaan[$pengawasId]['sekolahs'][] = $item->sekolah;
    }
        return view('dashboard_pengawas.datapengawas.index',
        compact('binaan','groupedBinaan'));

    }
}
