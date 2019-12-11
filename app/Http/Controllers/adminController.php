<?php

namespace App\Http\Controllers;
use PDF;
use Carbon\Carbon;
Use App\golongan;

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

    public function golonganCetak(){
        $golongan=golongan::all();
        $tgl= Carbon::now()->format('d-m-Y');
        $pdf =PDF::loadView('laporan.golonganKeseluruhan', ['golongan'=>$golongan,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data golongan.pdf');
      }
}
