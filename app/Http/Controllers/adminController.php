<?php

namespace App\Http\Controllers;
use PDF;
use Carbon\Carbon;
Use App\Golongan;
Use App\Jabatan;
Use App\Sekolah; 
Use App\Mata_pelajaran; 
Use App\Guru; 
Use App\Berita;
Use App\Pejabat_struktural;
Use App\Gaji_berkala; 



use Illuminate\Http\Request;

class adminController extends Controller
{
    public function depan(){
        $berita = berita::paginate(3);
        return view('welcome',compact('berita'));
    }

    public function index(){
        $sekolah = Sekolah::all();
        $guru = Guru::all();
        $permohonan = gaji_berkala::all();
        return view('admin.index',compact('sekolah','guru','permohonan'));
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

    public function guruFilter(){
        $sekolah = sekolah::all();
        return view('admin.guru.filter',compact('sekolah'));
    }

    public function pejabatStrukturalIndex(){
        return view('admin.pejabatStruktural.index');
    }

    public function beritaIndex(){
        return view('admin.berita.index');
    }

    public function beritaDetail($id){
        $berita = berita::findOrFail($id);
        return view('beritaDetail',compact('berita'));
    }

    public function beritaAll(){
        $berita = berita::all();
        return view('beritaAll',compact('berita'));
    }

    public function karyawanIndex(){
        return view('admin.karyawan.index');
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

    public function pejabatStrukturalCetak(){
        $pejabat=pejabat_struktural::all();
        $tgl= Carbon::now()->format('d-m-Y');
        $pdf =PDF::loadView('laporan.pejabatKeseluruhan', ['pejabat'=>$pejabat,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data Pejabat Keseluruhan.pdf');
    }

    public function beritaCetak(){
        $berita=berita::all();
        $tgl= Carbon::now()->format('d-m-Y');
        $pdf =PDF::loadView('laporan.beritaKeseluruhan', ['berita'=>$berita,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data berita Keseluruhan.pdf');
    }

    public function guruFilterCetak(Request $request){
        $guru=Guru::where('sekolah_id',$request->sekolah_id)->get();
        $tgl= Carbon::now()->format('d-m-Y');
        $pdf =PDF::loadView('laporan.guruFilter', ['guru'=>$guru,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data Guru filter Sekolah.pdf');
    }
}
