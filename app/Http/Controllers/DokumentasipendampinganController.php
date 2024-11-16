<?php

namespace App\Http\Controllers;

use App\GuruM;
use App\Models\RencanaKerjaT;
use App\Models\UmpanbalikT;
use App\SekolahM;
use App\TanggapanUmpanbalikT;
use App\User;
use Illuminate\Http\Request;
use Auth;
use DataTables;
use Illuminate\Support\Facades\File;

class DokumentasipendampinganController extends Controller
{
    public function indexpengawas(){

        $currentMonth = date('n'); // Numeric representation of the current month (1-12)
        $currentYear = date('Y');  // Current year
        $years = range($currentYear - 5, $currentYear + 5);
         $months = [];
        
        // Array of month names in Indonesian
        $monthNamesIndo = [
            1 => 'Januari', 
            2 => 'Februari', 
            3 => 'Maret', 
            4 => 'April', 
            5 => 'Mei', 
            6 => 'Juni', 
            7 => 'Juli', 
            8 => 'Agustus', 
            9 => 'September', 
            10 => 'Oktober', 
            11 => 'November', 
            12 => 'Desember'
        ];
        
        // Generate the current and next 11 months in Indonesian
        for ($i = 0; $i < 12; $i++) {
            $timestamp = strtotime("+$i month");
            $monthNumber = date('n', $timestamp);
            $months[] = [
                'value' => $monthNumber,                // Month number (1-12)
                'name' => $monthNamesIndo[$monthNumber] // Full month name in Indonesian
            ];
        }

        $listPengawas = User::where('role','pengawas')->get();
     
        return view('dashboard_pengawas.umpanbalik.dokumentasi',compact('listPengawas',
        'months',
        'currentYear',    
        'years', 
    ));
    }
    public function index(){

        $currentMonth = date('n'); // Numeric representation of the current month (1-12)
        $currentYear = date('Y');  // Current year
        $years = range($currentYear - 5, $currentYear + 5);
         $months = [];
        
        // Array of month names in Indonesian
        $monthNamesIndo = [
            1 => 'Januari', 
            2 => 'Februari', 
            3 => 'Maret', 
            4 => 'April', 
            5 => 'Mei', 
            6 => 'Juni', 
            7 => 'Juli', 
            8 => 'Agustus', 
            9 => 'September', 
            10 => 'Oktober', 
            11 => 'November', 
            12 => 'Desember'
        ];
        
        // Generate the current and next 11 months in Indonesian
        for ($i = 0; $i < 12; $i++) {
            $timestamp = strtotime("+$i month");
            $monthNumber = date('n', $timestamp);
            $months[] = [
                'value' => $monthNumber,                // Month number (1-12)
                'name' => $monthNamesIndo[$monthNumber] // Full month name in Indonesian
            ];
        }

        $listPengawas = User::where('role','pengawas')->get();
     
        return view('dokumentasipendampingan.index',compact('listPengawas',
        'months',
        'currentYear',    
        'years', 
    ));
    }

    public function getdata(Request $request){
        if ($request->ajax()) {

            $pengawas = $request->input('pengawas', 'all');
            $tahun = $request->input('tahun', 'all');
            $bln = $request->input('bln', 'all');
            $monthNamesIndo = [
                'Januari' => 1,
                'Februari' => 2,
                'Maret' => 3,
                'April' => 4,
                'Mei' => 5,
                'Juni' => 6,
                'Juli' => 7,
                'Agustus' => 8,
                'September' => 9,
                'Oktober' => 10,
                'November' => 11,
                'Desember' => 12
            ];
            
            // Cek apakah nama bulan sesuai dengan bulan yang diterima dalam bahasa Indonesia
            $monthNumber = isset($monthNamesIndo[$bln]) ? $monthNamesIndo[$bln] : 'all';
            
            $post = TanggapanUmpanbalikT::with('umpanBalikT','umpanBalikT.rencanakerja')->latest();
             // Apply filter for 'bln' (bulan)
             if ($bln !== 'all') {
                $post->whereMonth('created_at', $monthNumber);
            }
            if ($tahun !== 'all') {
                $post->whereYear('created_at', $tahun);
            }
            
            
            $post->whereHas('umpanBalikT', function ($q) use ($pengawas) {
                if ($pengawas !== 'all') {
                    $q->where('id_pengawas', $pengawas);
                }
            });

    
                return Datatables::of($post->get())
                ->addIndexColumn()
                ->addColumn('tanggal', function($row){
                    return $row->created_at->format('d M Y');
                })
                ->addColumn('foto', function($row){
                   

                    if ($row->foto == 'userdefault.jpg') {
                        $fotoPath = public_path('userdefault.jpg'); // Adjust this path if necessary
                    } else {
                        $fotoPath = storage_path('app/public/umpanbalik/' . $row->foto);
                    }
            
                    if (File::exists($fotoPath)) {
                        $fotoData = base64_encode(File::get($fotoPath));
                        $fotoType = File::mimeType($fotoPath);
                        return '<img src="data:' . $fotoType . ';base64,' . $fotoData . '"  height="100px" alt="Image" class="card-img-top">';
                    } else {
                        return '<img src="' . asset('userdefault.jpg') . '" height="100px" alt="Default Image" class="card-img-top">';
                    }
                })
                ->addColumn('foto2', function($row){
                    if ($row->foto == 'userdefault.jpg') {
                        $fotoPath = public_path('userdefault.jpg');
                    } else {
                        $fotoPath = storage_path('app/public/umpanbalik/' . $row->foto);
                    }
                
                    if (File::exists($fotoPath)) {
                        $fotoData = base64_encode(File::get($fotoPath));
                        $fotoType = File::mimeType($fotoPath);
                        return 'data:' . $fotoType . ';base64,' . $fotoData;
                    } else {
                        return ''; // Kembalikan string kosong jika tidak ada foto
                    }
                })
                ->addColumn('program', function($row){
                    return !empty($row->umpanBalikT) ? $row->umpanBalikT->rencanakerja->nama_program_kerja : '-';
                })
                ->addColumn('pengawas', function($row){
                    return !empty($row->umpanBalikT) ? $row->umpanBalikT->pengawasnama->name : '-';
                })
                ->addColumn('nama_sekolah', function($row) {
                    $cariguru = GuruM::findOrFail($row->umpanBalikT->id_user);
                    $sekolahs = SekolahM::findOrFail($cariguru->sekolah_id);
                    return $sekolahs->nama_sekolah;
                })
                ->rawColumns(['tanggal', 'foto', 'program', 'pengawas', 'nama_sekolah','foto2'])
                ->make(true);
           }
    }

    public function getdatapengawas(Request $request){
        if ($request->ajax()) {

            $pengawas = $request->input('pengawas', 'all');
            $tahun = $request->input('tahun', 'all');
            $bln = $request->input('bln', 'all');
            $monthNamesIndo = [
                'Januari' => 1,
                'Februari' => 2,
                'Maret' => 3,
                'April' => 4,
                'Mei' => 5,
                'Juni' => 6,
                'Juli' => 7,
                'Agustus' => 8,
                'September' => 9,
                'Oktober' => 10,
                'November' => 11,
                'Desember' => 12
            ];
            
            // Cek apakah nama bulan sesuai dengan bulan yang diterima dalam bahasa Indonesia
            $monthNumber = isset($monthNamesIndo[$bln]) ? $monthNamesIndo[$bln] : 'all';
            
            $post = TanggapanUmpanbalikT::
            with('umpanBalikT','umpanBalikT.rencanakerja')
            ->whereHas('umpanBalikT', function ($query) {
                $query->where('id_pengawas', Auth::user()->id);
            })
            ->latest();
             // Apply filter for 'bln' (bulan)
             if ($bln !== 'all') {
                $post->whereMonth('created_at', $monthNumber);
            }
            if ($tahun !== 'all') {
                $post->whereYear('created_at', $tahun);
            }
            
            
            $post->whereHas('umpanBalikT', function ($q) use ($pengawas) {
                if ($pengawas !== 'all') {
                    $q->where('id_pengawas', $pengawas);
                }
            });

    
                return Datatables::of($post->get())
                ->addIndexColumn()
                ->addColumn('tanggal', function($row){
                    return $row->created_at->format('d M Y');
                })
                ->addColumn('foto', function($row){
                   

                    if ($row->foto == 'userdefault.jpg') {
                        $fotoPath = public_path('userdefault.jpg'); // Adjust this path if necessary
                    } else {
                        $fotoPath = storage_path('app/public/umpanbalik/' . $row->foto);
                    }
            
                    if (File::exists($fotoPath)) {
                        $fotoData = base64_encode(File::get($fotoPath));
                        $fotoType = File::mimeType($fotoPath);
                        return '<img src="data:' . $fotoType . ';base64,' . $fotoData . '"  height="100px" alt="Image" class="card-img-top">';
                    } else {
                        return '<img src="' . asset('userdefault.jpg') . '" height="100px" alt="Default Image" class="card-img-top">';
                    }
                })
                ->addColumn('foto2', function($row){
                    if ($row->foto == 'userdefault.jpg') {
                        $fotoPath = public_path('userdefault.jpg');
                    } else {
                        $fotoPath = storage_path('app/public/umpanbalik/' . $row->foto);
                    }
                
                    if (File::exists($fotoPath)) {
                        $fotoData = base64_encode(File::get($fotoPath));
                        $fotoType = File::mimeType($fotoPath);
                        return 'data:' . $fotoType . ';base64,' . $fotoData;
                    } else {
                        return ''; // Kembalikan string kosong jika tidak ada foto
                    }
                })
                ->addColumn('program', function($row){
                    return !empty($row->umpanBalikT) ? $row->umpanBalikT->rencanakerja->nama_program_kerja : '-';
                })
                ->addColumn('pengawas', function($row){
                    return !empty($row->umpanBalikT) ? $row->umpanBalikT->pengawasnama->name : '-';
                })
                ->addColumn('nama_sekolah', function($row) {
                    $cariguru = GuruM::findOrFail($row->umpanBalikT->id_user);
                    $sekolahs = SekolahM::findOrFail($cariguru->sekolah_id);
                    return $sekolahs->nama_sekolah;
                })
                ->rawColumns(['tanggal', 'foto', 'program', 'pengawas', 'nama_sekolah','foto2'])
                ->make(true);
           }
    }
}
