<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Type;
use App\Models\OutgoingMail;
use File;
use Response;
use Illuminate\Support\Carbon;

use Barryvdh\DomPDF\Facade\Pdf;
class OutgoingMailController extends Controller
{
  
    public function keluar()
    {
      $type= Type::all();
      $user_auth = Auth::user();
      $user = User::where('id', '<>' , Auth::id())->get();
      
      
      if ($user_auth->level == 'tatausaha' || $user_auth->level == 'kepsek' ){
      $inbox = Outgoingmail::all();
    }
    else {
      $inbox = Outgoingmail::where('kepada', Auth::id())->where('status', 'disetujui')->get();
    }
    return view('dashboard.keluar', compact('inbox', 'user', 'type'));
    // return view('dashboard.keluar',compact ('type','inbox'));
      
    }

    public function tambahView()
{
    $data['types'] = Type::all();
    $user_id = Auth::id();
    $data['users'] = User::where('id','<>', $user_id)->get();
        $data['outgoingmails']= Outgoingmail::all();
        //var_dump($data['types']);
        return view('dashboard.buatsk',$data);
}

public function tambahViewExternal()
{
    $data['types'] = Type::all();
    $data['outgoingmails']= Outgoingmail::all();
        //var_dump($data['types']);
        return view('dashboard.buatskexternal',$data);
}



    public function tambah(Request $request)
    {
      function numberToRomanRepresentation($number) {
        $map = array( 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $returnValue = '';
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if($number >= $int) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
      }

      $today = date('Y-m-d');
      $roman=numberToRomanRepresentation(date('m'));
      Outgoingmail::create([
        'no_sk' => '421.5/' .$request->no_surat. '/SMKN1/' . $roman.'/'.date('Y'),
        'judul_sk' => $request->input('judul_suratkeluar'),
        'id_type' => $request->input('tipe'),
        'tujuan_surat' => $request->input('tujuan_suratkeluar'),
        'tgl_keluar' => $request->input('tgl_keluar'),
        'perihal_sk' => $request->input('perihal_suratkeluar'),
        'file_sk' => $request->file('file_sk')->getClientOriginalName(),
        'isi_sk' => $request->input('isi_keluar'),
        'pengirim_sk' => Auth::id(),
        'kepada' => $request->input('kepada_keluar'),
        'kepada_external' => $request->input('kepada_keluar_external'),
        
    ]);

       if($request->hasFile('file_sk')){
            $destination = "uploadfile";
            $filename = $request->file('file_sk');
            $filename->move($destination, $filename->getClientOriginalName());
            $upload= "Y";
        }
        $extension = $request->file('file_sk')->getClientOriginalExtension();

      return redirect('surat-keluar');
  }

  

  function konfirmasiSetuju($id){
    $inbox = Outgoingmail::where('id', $id)->first();
    $inbox -> status = 'disetujui';
    $inbox->save(); 
    return redirect('surat-keluar');
    
  }
  function konfirmasiTolak(Request $request){
    $inbox = Outgoingmail::where('id', $request->id)->first();
    $inbox -> status = 'ditolak';
    $inbox -> keterangan = $request->keterangan;
    $inbox->save(); 
    return redirect('surat-keluar');

    
  }
  
  public function detail($id)
    {
      
        $data['detail'] = Outgoingmail::where('id', $id)->first();

            if (! Auth::user()->level == 'kepsek'  &&  Auth::user()->level == 'tatausaha' ){
              if ($data['detail']->mark == "unread") {
                $edit = Outgoingmail::find($id);
                $edit->mark = "read";
                $edit->save();
              }
        }

        $user_id = Auth::id();
        $data['users'] = User::where('id','<>', $user_id)->get();
        // var_dump ($data['users']);
        $data['dis'] = false;
        return view('dashboard.detailsk', $data);
    }

    public function open($id)
    {
      $data['detail'] = Outgoingmail::where('file_sk', $id)->first();
      return Response::make(file_get_contents('uploadfile/' . $data['detail']['file_sk']), 200, ['content-type'=>'application/pdf']);
    }

    public function hapus($id)
    {
        $outgoingmails = outgoingmail::find($id);
        $outgoingmails->delete();
        return redirect()->back();
    }

    public function edit(Request $request, $id)
    {
      $today = date('Y-m-d');
      if (!$request->get('file_sk') == null) {
        
      }
      $outgoingmail = outgoingmail::find($id);
      if ($request->get('kepada')) {
        $outgoingmail->kepada = $request->get('kepada');
      }
      if ($request->get('kepada_external')) {
        $outgoingmail->kepada_external = $request->get('kepada_external');
      }
      $outgoingmail->no_sk = $request->get('no_sk');
      $outgoingmail->judul_sk = $request->get('judul_sk');
      $outgoingmail->id_type = $request->get('id_type');
      $outgoingmail->tujuan_surat = $request->get('tujuan_surat');
      $outgoingmail->tgl_keluar = $request->get('tgl_keluar');
      $outgoingmail->perihal_sk = $request->get('perihal_sk');
      $outgoingmail->status = "belum";
      $outgoingmail->keterangan = null;
      if ($request->get('file_sk') != null) {
        $outgoingmail->file_sk = $request->get('file_sk');
      }
      $outgoingmail->isi_sk = $request->get('isi_sk');
      $outgoingmail->pengirim_sk = Auth::id();
      
      if($request->hasFile('file_sk')){
        $destination = "uploadfile";
        $filename = $request->file('file_sk');
        $filename->move($destination, $filename->getClientOriginalName());
        $upload= "Y";
    }
    $extension = $request->file('file_sk');
    
    $outgoingmail->save();
    return redirect()->back();
      
  
    }




    public function laporankeluar(){
        
      return view('dashboard.laporankeluar');
  }

  public function cetaklaporankeluar($tglawal, $tglakhir){
    // dd(["Tanggal Awal : ".$tglawal, "Tanggal Akhir : ".$tglakhir]);

    $cetaklaporankeluar = outgoingmail::whereBetween('tgl_keluar', [$tglawal, $tglakhir])->get();
    $tglawal= Carbon::parse($tglawal)->format('d M Y');
    $tglakhir= Carbon::parse($tglakhir)->format('d M Y');
    $pdf = Pdf::loadView('dashboard.laporankeluarcetak', compact('cetaklaporankeluar', 'tglawal', 'tglakhir'));
    return $pdf->stream('cetak.pdf');
    // return view('dashboard.laporanmasukcetak', compact('cetaklaporankeluar')); 
}

}
