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
Use App\Data_berkala;
Use App\Karyawan;
Use App\Diklat;
use HCrypt;



use Illuminate\Http\Request;

class adminController extends Controller
{
    public function depan(){
        $berita = berita::paginate(3);
        return view('welcome',compact('berita'));
    }

    public function index(){
        $sekolah = Sekolah::all();
        $sekolah_sd = sekolah::where('b_pendidikan','SD')->get();
        $sekolah_smp = sekolah::where('b_pendidikan','SMP')->get();
        $permohonan = data_berkala::all();
        $karyawan = karyawan::all();
        return view('admin.index',compact('sekolah_sd','sekolah_smp','permohonan','karyawan'));
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

    public function guruDetail($uuid){
        $id = HCrypt::decrypt($uuid);
        $guru = guru::findOrFail($id);
        return view('admin.guru.detail',compact('guru'));
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

    public function dataPermohonanIndex(){
        return view('admin.permohonan.index');
    }

    public function dataBerkalaIndex(){
        return view('admin.dataBerkala.index');
    }
    
    public function dataBerkalaVerifikasi($uuid){
        $id = HCrypt::decrypt($uuid);

        $permohonan = Data_berkala::findOrFail($id);

        return view('admin.dataBerkala.verifikasi',compact('permohonan'));
    }  
    
    public function permohonanFilter(){
        return view('admin.permohonan.filter');
    }

    public function gajihBerkalaIndex(){
        return view('admin.gajihBerkala.index');
    }

    public function diklatIndex(){
        return view('admin.diklat.index');
    }

    public function diklatGuruFilter(){

        $diklat = diklat::all();
        return view('admin.diklat.filter',compact('diklat'));
    }

    public function golonganCetak(){
        $golongan=golongan::all();
        $pejabat_struktural=Pejabat_struktural::all()->first();
        $tgl= Carbon::now()->format('d-m-Y');
        $pdf =PDF::loadView('laporan.golonganKeseluruhan', ['golongan'=>$golongan,'pejabat_struktural'=>$pejabat_struktural,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data golongan.pdf');
      }

    public function jabatanCetak(){
        $jabatan=jabatan::all();
        $pejabat_struktural=Pejabat_struktural::all()->first();
        $tgl= Carbon::now()->format('d-m-Y');
        $pdf =PDF::loadView('laporan.jabatanKeseluruhan', ['jabatan'=>$jabatan,'pejabat_struktural'=>$pejabat_struktural,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data jabatan.pdf');
    }

    public function sekolahKeseluruhanCetak(){
        $sekolah=sekolah::all();
        $pejabat_struktural=Pejabat_struktural::all()->first();
        $tgl= Carbon::now()->format('d-m-Y');
        $pdf =PDF::loadView('laporan.sekolahKeseluruhan', ['sekolah'=>$sekolah,'pejabat_struktural'=>$pejabat_struktural,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data Sekolah Keseluruhan.pdf');
    }

    public function mpCetak(){
        $mata_pelajaran=mata_pelajaran::all();
        $pejabat_struktural=Pejabat_struktural::all()->first();
        $tgl= Carbon::now()->format('d-m-Y');
        $pdf =PDF::loadView('laporan.mpKeseluruhan', ['mata_pelajaran'=>$mata_pelajaran,'pejabat_struktural'=>$pejabat_struktural,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data mata Pelajaran Keseluruhan.pdf');
    }

    public function guruKeseluruhanCetak(){
        $guru=Guru::all();
        $tgl= Carbon::now()->format('d-m-Y');
        $pejabat_struktural=Pejabat_struktural::all()->first();
        $pdf =PDF::loadView('laporan.guruKeseluruhan', ['guru'=>$guru,'pejabat_struktural'=>$pejabat_struktural,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data Guru Keseluruhan.pdf');
    }

    public function pejabatStrukturalCetak(){
        $pejabat=pejabat_struktural::all();
        $tgl= Carbon::now()->format('d-m-Y');
        $pejabat_struktural=Pejabat_struktural::all()->first();
        $pdf =PDF::loadView('laporan.pejabatKeseluruhan', ['pejabat'=>$pejabat,'pejabat_struktural'=>$pejabat_struktural,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data Pejabat Keseluruhan.pdf');
    }

    public function beritaCetak(){
        $berita=berita::all();
        $tgl= Carbon::now()->format('d-m-Y');
        $pejabat_struktural=Pejabat_struktural::all()->first();
        $pdf =PDF::loadView('laporan.beritaKeseluruhan', ['berita'=>$berita,'pejabat_struktural'=>$pejabat_struktural,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data berita Keseluruhan.pdf');
    }

    public function guruFilterCetak(Request $request){
        $guru=Guru::where('sekolah_id',$request->sekolah_id)->get();
        $pejabat_struktural=Pejabat_struktural::all()->first();
        $tgl= Carbon::now()->format('d-m-Y');
        $pdf =PDF::loadView('laporan.guruFilter', ['guru'=>$guru,'pejabat_struktural'=>$pejabat_struktural,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data Guru filter Sekolah.pdf');
    }

    public function karyawanCetak(){
        $karyawan=karyawan::all();
        $pejabat_struktural=Pejabat_struktural::all()->first();
        $tgl= Carbon::now()->format('d-m-Y');
        $pdf =PDF::loadView('laporan.karyawanKeseluruhan', ['karyawan'=>$karyawan,'pejabat_struktural'=>$pejabat_struktural,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data karyawan Keseluruhan.pdf');
    }

    public function permohonanCetak(){
        $permohonan = data_berkala::with('guru','pejabat_struktural')->whereIn('status',[0,2])->get();
        $pejabat_struktural=Pejabat_struktural::all()->first();
        $tgl= Carbon::now()->format('d-m-Y');
        $pdf =PDF::loadView('laporan.permohonanKeseluruhan', ['permohonan'=>$permohonan,'pejabat_struktural'=>$pejabat_struktural,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data karyawan Keseluruhan.pdf');
    }

    public function permohonanfilterCetak(Request $request){
        $permohonan=data_berkala::where('status',$request->status)->get();
        $pejabat_struktural=Pejabat_struktural::all()->first();
        $tgl= Carbon::now()->format('d-m-Y');
        $pdf =PDF::loadView('laporan.permohonanFilter', ['permohonan'=>$permohonan,'pejabat_struktural'=>$pejabat_struktural,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data Permohonan filter Status.pdf');
    }
    
    public function dataBerkalaCetak(){
        $dataBerkala = data_berkala::with('guru','pejabat_struktural')->where('status',1)->get();
        $pejabat_struktural=Pejabat_struktural::all()->first();
        $tgl= Carbon::now()->format('d-m-Y');
        $pdf =PDF::loadView('laporan.dataBerkalaKeseluruhan', ['dataBerkala'=>$dataBerkala,'pejabat_struktural'=>$pejabat_struktural,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data berkala.pdf');
    }

    public function diklatCetak(){
        $diklat = diklat::all();
        $pejabat_struktural=Pejabat_struktural::all()->first();
        $tgl= Carbon::now()->format('d-m-Y');
        $pdf =PDF::loadView('laporan.diklatKeseluruhan', ['diklat'=>$diklat,'pejabat_struktural'=>$pejabat_struktural,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data Diklat.pdf');
    }

    public function diklatFilterCetak(Request $request){
        $diklat = diklat::findorfail($request->diklat_id);
        $pejabat_struktural=Pejabat_struktural::all()->first();
        $tgl= Carbon::now()->format('d-m-Y');
        $pdf =PDF::loadView('laporan.diklatFilter', ['diklat'=>$diklat,'pejabat_struktural'=>$pejabat_struktural,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data Guru Diklat.pdf');
    }
}