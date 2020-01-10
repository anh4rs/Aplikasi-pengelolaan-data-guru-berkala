<?php

namespace App\Http\Controllers;
use PDF;
use Carbon\Carbon;
Use App\golongan;
Use App\jabatan;
Use App\sekolah; 
Use App\mata_pelajaran; 
Use App\Guru; 

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

    public function guruIndex(){
        return view('admin.guru.index');
    }

    public function pejabatStrukturalIndex(){
        return view('admin.pejabatStruktural.index');
    }

    public function golonganCetak(){
        $golongan=golongan::all();
        $tgl= Carbon::now()->format('d-m-Y');
        $pdf =PDF::loadView('laporan.golonganKeseluruhan', ['golongan'=>$golongan,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data golongan.pdf');
      }
      
    public function jabatanCetak(){
        $jabatan=jabatan::all();
        $tgl= Carbon::now()->format('d-m-Y');
        $pdf =PDF::loadView('laporan.jabatanKeseluruhan', ['jabatan'=>$jabatan,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data jabatan.pdf');
    }

    public function sekolahKeseluruhanCetak(){
        $sekolah=sekolah::all();
        $tgl= Carbon::now()->format('d-m-Y');
        $pdf =PDF::loadView('laporan.sekolahKeseluruhan', ['sekolah'=>$sekolah,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data Sekolah Keseluruhan.pdf');
    }

    public function mpCetak(){
        $mata_pelajaran=mata_pelajaran::all();
        $tgl= Carbon::now()->format('d-m-Y');
        $pdf =PDF::loadView('laporan.mpKeseluruhan', ['mata_pelajaran'=>$mata_pelajaran,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data mata Pelajaran Keseluruhan.pdf');
    }

    public function guruKeseluruhanCetak(){
        $guru=Guru::all();
        $tgl= Carbon::now()->format('d-m-Y');
        $pdf =PDF::loadView('laporan.guruKeseluruhan', ['guru'=>$guru,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data Guru Keseluruhan.pdf');
    }
}
