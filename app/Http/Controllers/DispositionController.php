<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Type;
use App\Models\IncomingMail;
use App\Models\Disposition;
use File;
use Response;

use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class DispositionController extends Controller
{
    public function disposisi()
    
        // $data['inbox'] = Disposition::all()->where('kepada', Auth::id());
        // // var_dump($data);
        // return view('dashboard.disposisi',$data);

        {
            $user = Auth::user();
            $alluser = User::where('id', '<>' , Auth::id())->get();
            if ($user->level == 'kepsek'){
            $inbox = Disposition::all();
            return view('dashboard.disposisi', compact('inbox','alluser'));

          }
          else {
            $inbox = Disposition::where('kepada', Auth::id())->get();
            return view('dashboard.disposisi', compact('inbox'));
          }
          }
    

    public function tambah(Request $request) //disposisiin surat
    {
        Disposition::create([
            'id_sm'       => $request->input('id_sm'),
            'kepada'       => $request->input('user'),
            'isi_disposisi'    => $request->input('pesan'),
            'mark'          => "unread"
    
        ]);
        return redirect('disposisi');
}

public function detail($id)
    {
        
        $data['detail_disposisi'] = Disposition::where('id', $id)->first();
        

        // if ($data['detail_disposisi']->mark == "unread"){
        //     $edit = Disposition::find($id);
        //     $edit->mark = "read";
        //     $edit->save();
        // }
        
        $data['detail'] = Incomingmail::where('id', $data['detail_disposisi']['id_sm'])->first();
        $user_id = Auth::id();
        $data['users'] = User::where('id','<>', $user_id)->get();
        // var_dump ($data['users']);
        $data['dis'] = false;
     
        return view('dashboard.detaildisposisi', $data);

        
    }
    public function edit(Request $request, $id)
    {
        $disposition  = disposition::find($id);
        $disposition->kepada = $request->get('kepada');
        $disposition->isi_disposisi = $request->get('isi_disposisi');
        $disposition->save();
        return redirect()->back();
    }

    public function hapus($id) 
    {
        $disposition = disposition::find($id);
        $disposition->delete();
        return redirect()->back();
    }



    public function laporandisposisi(){
        
        return view('dashboard.laporandisposisi');
    }

    public function cetaklaporandisposisi($tglawal, $tglakhir){
        // dd(["Tanggal Awal : ".$tglawal, "Tanggal Akhir : ".$tglakhir]);
        
        $inbox = incomingmail::all();
        $cetaklaporandisposisi = disposition::whereBetween('created_at', [$tglawal, $tglakhir])->get();
        $tglawal= Carbon::parse($tglawal)->format('d M Y');
        $tglakhir= Carbon::parse($tglakhir)->format('d M Y');
        $pdf = Pdf::loadView('dashboard.laporandisposisicetak', compact('cetaklaporandisposisi', 'tglawal', 'tglakhir', 'inbox'));
        return $pdf->stream('cetak.pdf');
        // return view('dashboard.laporanmasukcetak', compact('cetaklaporandisposisi')); 
    }
}
