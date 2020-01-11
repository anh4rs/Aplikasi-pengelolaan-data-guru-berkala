<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Gaji_berkala;
use HCrypt;

class GajiController extends APIController
{
    public function get(){
        $gaji_berkala = json_decode(redis::get("gaji_berkala::all"));
        if (!$gaji_berkala) {
            $gaji_berkala = gaji_berkala::with('guru','pejabat_struktural')->get();
            if (!$gaji_berkala) {
                return $this->returnController("error", "failed get gaji_berkala data");
            }
            Redis::set("gaji_berkala:all", $gaji_berkala);
        }
        return $this->returnController("ok", $gaji_berkala);
    }

    public function find($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $gaji_berkala = Redis::get("gaji_berkala:$id");
        if (!$gaji_berkala) {
            $gaji_berkala = gaji_berkala::with('guru','pejabat')->where('id',$id)->first();
            if (!$gaji_berkala){
                return $this->returnController("error", "failed find data gaji_berkala");
            }
            Redis::set("gaji_berkala:$id", $gaji_berkala);
        }
        return $this->returnController("ok", $gaji_berkala);
    }

    public function create(Request $req){
        // $seksi = Seksi::create($req->all());
        $gaji_berkala = new gaji_berkala;
        // decrypt foreign key id
        
        $gaji_berkala->guru_id = Hcrypt::decrypt($req->guru_id);
        $gaji_berkala->pejabat_struktural_id = Hcrypt::decrypt($req->pejabat_struktural_id);
        $gaji_berkala->nomor_surat = $req->nomor_surat;
        $gaji_berkala->lampiran = $req->lampiran;
        $gaji_berkala->perihal = $req->perihal;
        $gaji_berkala->gaji_lama = $req->gaji_lama;
        $gaji_berkala->tgl_keputusan = $req->tgl_keputusan;
        $gaji_berkala->no_keputusan = $req->no_keputusan;
        $gaji_berkala->status = 0;
        $gaji_berkala->tgl_gaji_berlaku = $req->tgl_gaji_berlaku;
        $gaji_berkala->mkg = $req->mkg;
        $gaji_berkala->gaji_baru = $req->gaji_baru;
        $gaji_berkala->terbilang = $req->terbilang;
        $gaji_berkala->mks = $req->mks;

        $gaji_berkala->save();

        //set uuid
        $gaji_berkala_id = $gaji_berkala->id;
        $uuid = HCrypt::encrypt($gaji_berkala_id);
        $setuuid = gaji_berkala::findOrFail($gaji_berkala_id);
        $setuuid->uuid = $uuid;
        $setuuid->update();
        if (!$gaji_berkala) {
            return $this->returnController("error", "failed create data gaji_berkala");
        }
        Redis::del("gaji_berkala:all");
        Redis::set("gaji_berkala:all", $gaji_berkala);
        return $this->returnController("ok", $gaji_berkala);
    }

    public function update($uuid, Request $req){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $gaji_berkala = gaji_berkala::findOrFail($id);
        $gaji_berkala->guru_id = Hcrypt::decrypt($req->guru_id);
        $gaji_berkala->pejabat_struktural_id = Hcrypt::decrypt($req->pejabat_struktural_id);
        $gaji_berkala->no_surat = $req->no_surat;
        $gaji_berkala->lampiran = $req->lampiran;
        $gaji_berkala->perihal = $req->perihal;
        $gaji_berkala->gaji_lama = $req->gaji_lama;
        $gaji_berkala->tgl_keputusan = $req->tgl_keputusan;
        $gaji_berkala->no_keputusan = $req->no_keputusan;
        $gaji_berkala->status = $req->status;
        $gaji_berkala->tgl_gaji_berlaku = $req->tgl_gaji_berlaku;
        $gaji_berkala->mkg = $req->mkg;
        $gaji_berkala->gaji_baru = $req->gaji_baru;
        $gaji_berkala->terbilang = $req->terbilang;
        $gaji_berkala->mks = $req->mks;
        $gaji_berkala->update();
        if (!$gaji_berkala) {
            return $this->returnController("error", "failed find data gaji_berkala");
        }
        $gaji_berkala = gaji_berkala::with('golongan','jabatan','sekolah','mata_pelajaran')->where('id',$id)->first();
        Redis::del("gaji_berkala:all");
        Redis::set("gaji_berkala:$id", $gaji_berkala);
        return $this->returnController("ok", $gaji_berkala);
    }

    public function delete($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $gaji_berkala = gaji_berkala::find($id);
        if (!$gaji_berkala) {
            return $this->returnController("error", "failed find data gaji_berkala");
        }
        // Need to check realational
        // If there relation to other data, return error with message, this data has relation to other table(s)
        $delete = $gaji_berkala->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete data gaji_berkala");
        }
        Redis::del("gaji_berkala:all");
        Redis::del("gaji_berkala:$id");
        return $this->returnController("ok", "success delete data gaji_berkala");
    }
}
