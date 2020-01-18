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

    public function dataBerkalaIndex(){

        return view('sekolah.dataBerkala.index');
    }

    public function permohonanTambah(){

        return view('sekolah.dataBerkala.permohonan');
    }


}
