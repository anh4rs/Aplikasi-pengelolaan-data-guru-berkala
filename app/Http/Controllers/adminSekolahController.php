<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class adminSekolahController extends Controller
{
    public function index(){

        return view('sekolah.index');
    }

    public function guruIndex(){

        return view('sekolah.guru.index');
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
