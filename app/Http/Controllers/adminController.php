<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class adminController extends Controller
{
    public function index(){
        return view('admin.index');
    }
    
    public function golonganIndex(){
        return view('admin.golongan.index');
    }

    public function jabatanIndex(){
        return view('admin.jabatan.index');
    }

    public function sekolahIndex(){
        return view('admin.sekolah.index');
    }

    public function mpIndex(){
        return view('admin.mataPelajaran.index');
    }
}
