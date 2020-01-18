<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class adminSekolahController extends Controller
{
    public function index(){

        return view('sekolah.index');
    }

    public function guruIndex(){
        $sekolah = Auth::user()->sekolah;
        return view('sekolah.guru.index',compact('sekolah'));
    }

    public function sekolahIndex(){

        return view('sekolah.sekolah.index');
    }

    public function gajihBerkalaIndex(){

        return view('sekolah.gajihBerkala.index');
    }

    public function permohonanTambah(){

        return view('sekolah.gajihBerkala.permohonan');
    }


}
