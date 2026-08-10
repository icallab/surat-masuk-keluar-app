<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Incomingmail;

class LaporanController extends Controller
{
    public function index()  {
        $data = Incomingmail::all();
    	return view('dashboard.laporanmasuk',['data'=>$data]);
    }
    public function cetakPdfMasuk(){
        $data = Incomingmail::all();
        PDF::setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
    	$pdf = PDF::loadview('dashboard.laporanmasuk',['data'=>$data]);
    	return $pdf->stream();
        
    }
}
