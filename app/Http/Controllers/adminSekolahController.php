<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Inbox;

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
