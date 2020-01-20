<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Gaji_berkala;
use App\Inbox;
use HCrypt;
use Auth;

class GajiController extends APIController
{
    public function get(){
        $gaji_berkala = json_decode(redis::get("gaji_berkala::all"));
        if (!$gaji_berkala) {
            $gaji_berkala = gaji_berkala::all();
            if (!$gaji_berkala) {
                return $this->returnController("error", "failed get gaji_berkala gaji");
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
            $gaji_berkala = gaji_berkala::findOrFail($id);
            if (!$gaji_berkala){
                return $this->returnController("error", "failed find gaji gaji_berkala");
            }
            Redis::set("gaji_berkala:$id", $gaji_berkala);
        }
        return $this->returnController("ok", $gaji_berkala);
    }

    public function create(Request $req){

        $gaji_berkala = new gaji_berkala;
        // decrypt foreign key id
        
        $gaji_berkala->golongan_id = Hcrypt::decrypt($req->golongan_id);
        $gaji_berkala->mkg = $req->mkg;

        $gaji_berkala->save();

        //set uuid
        $gaji_berkala_id = $gaji_berkala->id;
        $uuid = HCrypt::encrypt($gaji_berkala_id);
        $setuuid = gaji_berkala::findOrFail($gaji_berkala_id);
        $setuuid->uuid = $uuid;
        $setuuid->update();
        if (!$gaji_berkala) {
            return $this->returnController("error", "failed create gaji gaji_berkala");
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
        $gaji_berkala->golongan_id = Hcrypt::decrypt($req->golongan_id);
        $gaji_berkala->mkg = $req->mkg;
        $gaji_berkala->update();
        if (!$gaji_berkala) {
            return $this->returnController("error", "failed find gaji gaji_berkala");
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
            return $this->returnController("error", "failed find gaji gaji_berkala");
        }
        // Need to check realational
        // If there relation to other gaji, return error with message, this gaji has relation to other table(s)
        $delete = $gaji_berkala->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete gaji gaji_berkala");
        }
        Redis::del("gaji_berkala:all");
        Redis::del("gaji_berkala:$id");
        return $this->returnController("ok", "success delete gaji gaji_berkala");
    }
}
