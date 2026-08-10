<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function cari(Request $request)
    {
        $data['user'] = User::where('name','like','%'.$request->input('cari').'%')->get();
        $data['dis'] = false;
        return view('dashboard.User',$data);
    }
    public function baca() 
    {
        $data['user'] = User::all();
        return view('dashboard.user',$data);
    }
    public function tambah(Request $request) 
    {
        User::create([
            'name'  => $request->input('name'),
            'username'  => $request->input('username'),
            'password'  => bcrypt ($request-> password),
            'level'  => $request->input('level'),
        ]);
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $user = User::find($id);
        $user->name     =$request->get('name');
        $user->username     =$request->get('username');
        if(!empty($request->get('password'))){
            $user->password =bcrypt($request->get('password'));
        }
        $user->level   =$request->get('level');
        $user->save();
        return redirect()->back();
    }
    public function hapus($id) 
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
