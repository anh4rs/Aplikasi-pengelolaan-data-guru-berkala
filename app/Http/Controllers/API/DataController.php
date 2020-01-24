<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Request as ApiRequest;
use App\Data_berkala;
use Carbon\Carbon;
use App\Inbox;
use HCrypt;
use Auth;

class DataController extends APIController
{
    public function get(){
        $data_berkala = json_decode(redis::get("data_berkala::all"));
        if (!$data_berkala) {
            $data_berkala = data_berkala::with('guru','pejabat_struktural')->where('status',1)->get();
            if (!$data_berkala) {
                return $this->returnController("error", "failed get data_berkala data");
            }
            Redis::set("data_berkala:all", $data_berkala);
        }
        return $this->returnController("ok", $data_berkala);
    }

    public function getPending(){
        $sekolah_id = Auth::user()->sekolah->id;
        $data_berkala = json_decode(redis::get("data_berkala::all"));
        if (!$data_berkala) {
            $data_berkala = data_berkala::with('guru','pejabat_struktural')->where('sekolah_id',$sekolah_id)->whereIn('status',[0,2])->get();
            if (!$data_berkala) {
                return $this->returnController("error", "failed get data_berkala data");
            }
            Redis::set("data_berkala:all", $data_berkala);
        }
        return $this->returnController("ok", $data_berkala);
    }

    public function getPendingAdmin(){
        $data_berkala = json_decode(redis::get("data_berkala::all"));
        if (!$data_berkala) {
            $data_berkala = data_berkala::with('guru','pejabat_struktural')->whereIn('status',[0,2])->get();
            if (!$data_berkala) {
                return $this->returnController("error", "failed get data_berkala data");
            }
            Redis::set("data_berkala:all", $data_berkala);
        }
        return $this->returnController("ok", $data_berkala);
    }

    public function getData(){
        $sekolah_id = Auth::user()->sekolah->id;
        $data_berkala = json_decode(redis::get("data_berkala::all"));
        if (!$data_berkala) {
            $data_berkala = data_berkala::with('guru','pejabat_struktural')->where('sekolah_id',$sekolah_id)->where('status',1)->get();
            if (!$data_berkala) {
                return $this->returnController("error", "failed get data_berkala data");
            }
            Redis::set("data_berkala:all", $data_berkala);
        }
        return $this->returnController("ok", $data_berkala);
    }

    public function find($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $data_berkala = Redis::get("data_berkala:$id");
        if (!$data_berkala) {
            $data_berkala = data_berkala::with('guru','pejabat_struktural')->where('id',$id)->first();
            if (!$data_berkala){
                return $this->returnController("error", "failed find data data_berkala");
            }
            Redis::set("data_berkala:$id", $data_berkala);
        }
        return $this->returnController("ok", $data_berkala);
    }

    public function create(Request $req){
        // $seksi = Seksi::create($req->all());

        // $cekValidasi = Validator::make(ApiRequest::all(), [

        //     'guru_id' => 'required|unique:data_berkalas',

        // ]);
        
        $data_berkala =  data_berkala::where('guru_id',$req->guru_id)->orderBy('id','DESC')->first();
        if(isset($data_berkala->tgl_gaji_berlaku))
        {
            $tgl_last = $data_berkala->tgl_gaji_berlaku;
            $tgl_berlaku = carbon::parse($tgl_last)->format('Y');
            $now = Carbon::now()->format('Y');
            
            $diff = $now - $tgl_berlaku;


            $message = 'Guru belum bisa melakukan permohonan sampai tahun '.$max;
            if($diff < 2)
            {
                return response()->json([
                    'Error' => $message
                ],202);
            }
        }
        
        
        // if ($cekValidasi->fails()) {
        //     return response()->json([
        //         'Error' => $cekValidasi->errors()->toJson()
        //     ],202);
        // }
        $sekolah_id = Auth::user()->sekolah->id;

        $data_berkala = new data_berkala;
        // decrypt foreign key id
        
        $data_berkala->sekolah_id = $sekolah_id;
        $data_berkala->guru_id = $req->guru_id;
        $data_berkala->pejabat_struktural_id = Hcrypt::decrypt($req->pejabat_struktural_id);
        $data_berkala->nomor_surat = $req->nomor_surat;
        $data_berkala->lampiran = $req->lampiran;
        $data_berkala->perihal = $req->perihal;
        $data_berkala->gaji_lama = $req->gaji_lama;
        $data_berkala->tgl_keputusan = $req->tgl_keputusan;
        $data_berkala->no_keputusan = $req->no_keputusan;
        $data_berkala->status = 0;
        $data_berkala->tgl_gaji_berlaku = $req->tgl_gaji_berlaku;
        $data_berkala->mkg = $req->mkg;
        $data_berkala->gaji_baru = $req->gaji_baru;
        $data_berkala->terbilang = $req->terbilang;
        $data_berkala->tgl_gaji_berikut = $req->tgl_gaji_berikut;

        $data_berkala->save();

        //set uuid
        $data_berkala_id = $data_berkala->id;
        $uuid = HCrypt::encrypt($data_berkala_id);
        $setuuid = data_berkala::findOrFail($data_berkala_id);
        $setuuid->uuid = $uuid;
        $setuuid->update();
        if (!$data_berkala) {
            return $this->returnController("error", "failed create data data_berkala");
        }
        Redis::del("data_berkala:all");
        Redis::set("data_berkala:all", $data_berkala);
        return $this->returnController("ok", $data_berkala);
    }

    public function update($uuid, Request $req){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $data_berkala = data_berkala::findOrFail($id);
        $data_berkala->guru_id = Hcrypt::decrypt($req->guru_id);
        $data_berkala->pejabat_struktural_id = Hcrypt::decrypt($req->pejabat_struktural_id);
        $data_berkala->no_surat = $req->no_surat;
        $data_berkala->lampiran = $req->lampiran;
        $data_berkala->perihal = $req->perihal;
        $data_berkala->gaji_lama = $req->gaji_lama;
        $data_berkala->tgl_keputusan = $req->tgl_keputusan;
        $data_berkala->no_keputusan = $req->no_keputusan;
        $data_berkala->status = $req->status;
        $data_berkala->tgl_gaji_berlaku = $req->tgl_gaji_berlaku;
        $data_berkala->mkg = $req->mkg;
        $data_berkala->gaji_baru = $req->gaji_baru;
        $data_berkala->terbilang = $req->terbilang;
        $data_berkala->tgl_gaji_berikut = $req->tgl_gaji_berikut;
        $data_berkala->update();
        if (!$data_berkala) {
            return $this->returnController("error", "failed find data data_berkala");
        }
        $data_berkala = data_berkala::with('golongan','jabatan','sekolah','mata_pelajaran')->where('id',$id)->first();
        Redis::del("data_berkala:all");
        Redis::set("data_berkala:$id", $data_berkala);
        return $this->returnController("ok", $data_berkala);
    }

    public function updateStatus($id, Request $req)
    {
        $id = $req->data_berkala_id;
        $data_berkala = Data_berkala::findOrFail($id);
        $data_berkala->status = $req->status;
        $data_berkala->update();

        $inbox = new Inbox;
        $inbox->sekolah_id = $req->sekolah_id;
        $inbox->data_berkala_id = $id;
        $inbox->subjek = $req->subjek;
        $inbox->keterangan = $req->keterangan;
        $inbox->status_permohonan = $req->status;
        $inbox->save();
    }

    public function delete($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $data_berkala = data_berkala::find($id);
        if (!$data_berkala) {
            return $this->returnController("error", "failed find data data_berkala");
        }
        // Need to check realational
        // If there relation to other data, return error with message, this data has relation to other table(s)
        $delete = $data_berkala->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete data data_berkala");
        }
        Redis::del("data_berkala:all");
        Redis::del("data_berkala:$id");
        return $this->returnController("ok", "success delete data data_berkala");
    }
}
