<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PembagianTupoksiController extends Controller
{
    public function index()
    {
        return view('pembagiantupoksi.index');
    }
}
