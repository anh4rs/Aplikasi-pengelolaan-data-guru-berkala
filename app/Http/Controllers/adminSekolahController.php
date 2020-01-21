<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Inbox;
use App\data_berkala;


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


}
