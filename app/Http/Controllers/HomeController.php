<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\IncomingMail;
use App\Models\OutgoingMail;
use App\Models\Disposition;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $data['suratmasuk'] = incomingmail::count();
        $data['suratkeluar'] = outgoingmail::count();
        $data['disposisi'] = disposition::count();
        $data['disposisimasuk'] = DB::table('dispositions')->where('dispositions.kepada', auth::id())->count();
        // $data['disposisimasuk'] = DB::table('dispositions')->join('mails','dispositions.id_mail','=','mails.id')->select('dispositions.*','mails.mail_subject','mails.id_type')->where('dispositions.mail_to', Auth::id())->count();
        return view('dashboard.index',$data);
    }
}
