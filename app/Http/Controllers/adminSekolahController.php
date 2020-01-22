<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Inbox;
use App\Data_berkala;
use App\Guru;
use App\Sekolah;
Use App\Pejabat_struktural;
use PDF;
use Carbon\Carbon;


class adminSekolahController extends Controller
{
    public function index(){
        $sekolah = Auth::user()->sekolah;
        $sekolah_id = $sekolah->id;
        $data = data_berkala::with('guru','pejabat_struktural')->where('sekolah_id',$sekolah_id)->where('status',1)->get();
        return view('sekolah.index',compact('sekolah','data'));
    }

    public function guruIndex(){
        $sekolah = Auth::user()->sekolah;
        return view('sekolah.guru.index',compact('sekolah'));
    }

    public function sekolahIndex(){

        return view('sekolah.sekolah.index');
    }

    public function permohonanIndex(){

        return view('sekolah.permohonan.index');
    }

    public function permohonanTambah(){

        return view('sekolah.dataBerkala.permohonan');
    }

    public function inboxIndex(){
        $sekolah = Auth::user()->sekolah;
        $inbox = inbox::where('sekolah_id',$sekolah->id)->get();
        return view('sekolah.inbox.index',compact('inbox'));
    }

    public function inboxDetail($id){
        $inbox = inbox::findOrFail($id);
        $inbox->status = 1;
        $inbox->update();
        return view('sekolah.inbox.detail',compact('inbox'));
    }

    public function inboxDelete($id){
        $inbox = inbox::findOrFail($id);
        $inbox->delete();
        return redirect('sekolah.inbox.index');
    }

    public function dataBerkalaIndex(){
        return view('sekolah.dataBerkala.index');
    }

    public function gajiIndex(){
        return view('sekolah.gaji.index');
    }

    public function guruCetak(){
        $sekolah_id = Auth::user()->sekolah->id;
        $sekolah = sekolah::findOrFail($sekolah_id);
        $guru = guru::with('sekolah','golongan','jabatan','mata_pelajaran')->where('sekolah_id',$sekolah_id)->get();
        $tgl= Carbon::now()->format('d-m-Y');
        $pejabat_struktural=Pejabat_struktural::all()->first();
        $pdf =PDF::loadView('laporan.guruSekolah', ['sekolah'=>$sekolah,'guru'=>$guru,'pejabat_struktural'=>$pejabat_struktural,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data Guru.pdf');
    }

    public function permohonanCetak(){
        $sekolah_id = Auth::user()->sekolah->id;
        $sekolah = sekolah::findOrFail($sekolah_id);
        $data = data_berkala::with('guru','pejabat_struktural')->where('sekolah_id',$sekolah_id)->whereIn('status',[0,2])->get();
        $tgl= Carbon::now()->format('d-m-Y');
        $pejabat_struktural=Pejabat_struktural::all()->first();
        $pdf =PDF::loadView('laporan.permohonanSekolah', ['sekolah'=>$sekolah,'data'=>$data,'pejabat_struktural'=>$pejabat_struktural,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data Permohonan Berkala.pdf');
    }

}
