<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Type;
use App\Models\IncomingMail;
use File;
use Response;
use Illuminate\Support\Carbon;



use Barryvdh\DomPDF\Facade\Pdf;

class IncomingMailController extends Controller
{
    public function masuk()
    {
        if (Auth::user()->level == 'kepsek' || Auth::user()->level == 'tatausaha') {
        $type = Type::all();
        $inbox = Incomingmail::all();
        // $inbox = [];
        // foreach ($incomingmail as $data) {
        //     $data->tgl_masuk= Carbon::parse($data->tgl_masuk)->format('d-M-Y');
        //     $inbox[] = $data;
        // }
        //return view('dashboard.masuk', compact('type', 'inbox'));
        return view('dashboard.masuk',compact('type', 'inbox'));
      // }
    }
    return \abort (403,'Anda Tidak punya akses');
    }   
    public function detail($id)
    {
        if (Auth::user()->level == 'kepsek' || Auth::user()->level == 'tatausaha') {
        $data['detail'] = Incomingmail::where('id', $id)->first();
        if (Auth::user()->level == 'kepsek'  && $data['detail']->mark == "unread"){
            $edit = Incomingmail::find($id);
            $edit->mark = "read";
            $edit->save();
        }
        $user_id = Auth::id();
        $data['users'] = User::where('id','<>', $user_id)->get();
        // var_dump ($data['users']);
        $data['dis'] = false;
        return view('dashboard.detailsm', $data);
    }
    return \abort (403,'Anda Tidak punya akses');
    }
    
    
    public function surat()
    {
        $data['types'] = Type::all();
        $data['users'] = User::all();
        $data['incomingmails']= Incomingmail::all;
        return view('dashboard.buatsm',$data);
    }

    public function download($file_sm)
    {
        $download = Incomingmail::where('file_sm', $file_sm)->firstOrFail();
        $pathToFile = public_path('uploadfile/' . $download->file_sm);
        return response()->download($pathToFile);
    }
public function tambahView()
{
    if (Auth::user()->level == 'tatausaha') {
        $data['types'] = Type::all();
        $data['users'] = User::all();
        $data['incomingmails']= Incomingmail::all();
        //var_dump($data['types']);
        return view('dashboard.buatsm',$data);      
    }
    return \abort (403,'Anda Tidak punya akses');
}
    public function tambah(Request $request)
    {
        
    // $today = date('Y-m-d');
      Incomingmail::create([
        'no_sm' => $request->input('no_suratmasuk'),
        'judul_sm' => $request->input('judul_suratmasuk'),
        'id_type' => $request->input('tipe'),
        'asal_surat' => $request->input('asal_suratmasuk'),
        'tgl_masuk' =>  $request->input('tgl_suratmasuk'),
        'perihal_sm' => $request->input('perihal_suratmasuk'),
        'file_sm' => $request->file('file_sm')->getClientOriginalName(),
        'isi_sm' => $request->input('isi_suratmasuk'),
        'pengirim_sm' => Auth::id(),
        'mark' => "unread"
    ]);

       if($request->hasFile('file_sm')){
            $destination = "uploadfile";
            $filename = $request->file('file_sm');
            $filename->move($destination, $filename->getClientOriginalName());
            $upload= "Y";
        }
        $extension = $request->file('file_sm')->getClientOriginalExtension();
        session()->flash('message', 'Buat Surat berhasil.');
      return redirect('surat-masuk');
  }
 
  
  public function open($id)
  {
    $data['detail'] = Incomingmail::where('file_sm', $id)->first();
    return Response::make(file_get_contents('uploadfile/' . $data['detail']['file_sm']), 200, ['content-type'=>'application/pdf']);
  }

  public function hapus($id)
    {
        $incomingmails = incomingmail::find($id);
        $incomingmails->delete();
        session()->flash('delete', 'Hapus Surat berhasil.');
        return redirect()->back();
    }
//     public function editView()
// {
//         $data['types'] = Type::all();
//         $data['users'] = User::all();
//         $data['incomingmails']= Incomingmail::all();
//         //var_dump($data['types']);
//         return view('dashboard.buatsm',$data);
// }
    public function edit(Request $request, $id) 
    
    {
        if (!$request->get('file_sm') == null) {
        
        }
        $incomingmail = incomingmail::find($id);
        $incomingmail->no_sm = $request->get('no_sm');
        $incomingmail->judul_sm = $request->get('judul_sm');
        $incomingmail->id_type = $request->get('id_type');
        $incomingmail->asal_surat = $request->get('asal_surat');
        $incomingmail->tgl_masuk = $request->get('tgl_masuk');
        $incomingmail->perihal_sm = $request->get('perihal_sm');
        if (!$request->get('file_sm') == null) {
            $incomingmail->file_sm = $request->get('file_sm');
        }
        
        $incomingmail->isi_sm = $request->get('isi_sm');
        $incomingmail->pengirim_sm = Auth::id();
        
        if($request->hasFile('file_sm')){
            $destination = "uploadfile";
            $filename = $request->file('file_sm');
            $filename->move($destination, $filename->getClientOriginalName());
            $upload= "Y";
        }
        $extension = $request->file('file_sm');
        
        $incomingmail->save();
        return redirect()->back();

    }

    
    public function laporanmasuk(){
        
        return view('dashboard.laporanmasuk');
    }

    public function cetaklaporanmasuk($tglawal, $tglakhir){
        // dd(["Tanggal Awal : ".$tglawal, "Tanggal Akhir : ".$tglakhir]);
    
        $cetaklaporanmasuk = Incomingmail::whereBetween('tgl_masuk', [$tglawal, $tglakhir])->get();
        $tglawal= Carbon::parse($tglawal)->format('d M Y');
        $tglakhir= Carbon::parse($tglakhir)->format('d M Y');
        $pdf = Pdf::loadView('dashboard.laporanmasukcetak', compact('cetaklaporanmasuk', 'tglawal', 'tglakhir'));
        return $pdf->stream('cetak.pdf');
        // return view('dashboard.laporanmasukcetak', compact('cetaklaporanmasuk')); 
    }
    
}


