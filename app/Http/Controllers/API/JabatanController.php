<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jabatan;
use HCrypt;
use Illuminate\Support\Facades\Redis;

class JabatanController extends APIController
{
    public function get(){
        $jabatan = json_decode(redis::get("jabatan::all"));
        if (!$jabatan) {
            $jabatan = jabatan::with('golongan')->get();
            if (!$jabatan) {
                return $this->returnController("error", "failed get jabatan data");
            }
            Redis::set("jabatan:all", $jabatan);
        }
        return $this->returnController("ok", $jabatan);
    }

    public function find($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $jabatan = Redis::get("jabatan:$id");
        if (!$jabatan) {
            $jabatan = jabatan::with('golongan')->where('id',$id)->first();
            if (!$jabatan){
                return $this->returnController("error", "failed find data jabatan");
            }
            Redis::set("jabatan:$id", $jabatan);
        }
        return $this->returnController("ok", $jabatan);
    }

    public function create(Request $req){
        // $jabatan = jabatan::create($req->all());
        $jabatan = new jabatan;
        $jabatan->kode_jabatan = $req->kode_jabatan;
        $jabatan->jabatan = $req->jabatan;
        // decrypt golongan id
        $jabatan->golongan_id = Hcrypt::decrypt($req->golongan_id);
        $jabatan->save();
        //set uuid
        $jabatan_id = $jabatan->id;
        $uuid = HCrypt::encrypt($jabatan_id);
        $setuuid = jabatan::findOrFail($jabatan_id);
        $setuuid->uuid = $uuid;
        $setuuid->update();
        if (!$jabatan) {
            return $this->returnController("error", "failed create data jabatan");
        }
        Redis::del("jabatan:all");
        Redis::set("jabatan:all", $jabatan);
        return $this->returnController("ok", $jabatan);
    }

    public function update($uuid, Request $req){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $jabatan = jabatan::findOrFail($id);
        $jabatan->kode_jabatan     = $req->kode_jabatan;
        $jabatan->jabatan    = $req->jabatan;
        $jabatan->golongan_id = Hcrypt::decrypt($req->golongan_id);
        $jabatan->update();
        if (!$jabatan) {
            return $this->returnController("error", "failed find data jabatan");
        }
        $jabatan = jabatan::with('golongan')->where('id',$id)->first();
        Redis::del("jabatan:all");
        Redis::set("jabatan:$id", $jabatan);
        return $this->returnController("ok", $jabatan);
    }
}
