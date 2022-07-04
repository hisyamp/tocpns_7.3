<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use DataTables;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    public function paymentacc()
    {
        $get_member = auth::user()->member;
        return view('admin.accpembayaran',compact('get_member'));
    }
    public function listuser()
    {
        $get_member = auth::user()->member;
        return view('admin.datapeserta',compact('get_member'));
    }
    public function apilistuser()
    {
        $listuser = User::all();
        return DataTables::of($listuser)->make(true);
    }
    public function passwordreset()
    {
        $get_member = auth::user()->member;
        return view('admin.resetlogin',compact('get_member'));
    }

    public function soal()
    {
        $get_member = auth::user()->member;
        return view('user.soal',compact('get_member'));
    }

    public function upgrade_member()
    {
        $get_member = auth::user()->member;
        return view('user.upgrade_member',compact('get_member'));
    }
    
    public function reset_password(Request $request)
    {
        $id = $request->id;
        $datauser = User::find($id);
        $datauser->password = \Hash::make('1234');

        $resp = [
            "status" => 200,
            "message" => "Password berhasil diubah !",
        ];

        return $resp;
    }
}
