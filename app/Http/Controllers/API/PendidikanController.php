<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pendidikan_guru;
use HCrypt;

class PendidikanController extends APIController
{
    public function get(){
        $pendidikan_guru = json_decode(redis::get("pendidikan_guru::all"));
        if (!$pendidikan_guru) {
            $pendidikan_guru = pendidikan_guru::with('guru')->get();
            if (!$pendidikan_guru) {
                return $this->returnController("error", "failed get pendidikan_guru gaji");
            }
            Redis::set("pendidikan_guru:all", $pendidikan_guru);
        }
        return $this->returnController("ok", $pendidikan_guru);
    }

    public function find($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $pendidikan_guru = Redis::get("pendidikan_guru:$id");
        if (!$pendidikan_guru) {
            $pendidikan_guru = pendidikan_guru::with('guru')->where('id',$id)->first();
            if (!$pendidikan_guru){
                return $this->returnController("error", "failed find gaji pendidikan_guru");
            }
            Redis::set("pendidikan_guru:$id", $pendidikan_guru);
        }
        return $this->returnController("ok", $pendidikan_guru);
    }

    public function create(Request $req){

        $pendidikan_guru = new pendidikan_guru;
        // decrypt foreign key id

        $pendidikan_guru->guru_id = Hcrypt::decrypt($req->guru_id);
        $pendidikan_guru->pendidikan = $req->pendidikan;
        $pendidikan_guru->nama = $req->nama;
        $pendidikan_guru->tahun_lulus = $req->tahun_lulus;

        $pendidikan_guru->save();

        //set uuid
        $pendidikan_guru_id = $pendidikan_guru->id;
        $uuid = HCrypt::encrypt($pendidikan_guru_id);
        $setuuid = pendidikan_guru::findOrFail($pendidikan_guru_id);
        $setuuid->uuid = $uuid;
        $setuuid->update();
        if (!$pendidikan_guru) {
            return $this->returnController("error", "failed create gaji pendidikan_guru");
        }
        Redis::del("pendidikan_guru:all");
        Redis::set("pendidikan_guru:all", $pendidikan_guru);
        return $this->returnController("ok", $pendidikan_guru);
    }

    public function update($uuid, Request $req){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $pendidikan_guru = pendidikan_guru::findOrFail($id);
        
        $pendidikan_guru->guru_id = Hcrypt::decrypt($req->guru_id);
        $pendidikan_guru->pendidikan = $req->pendidikan;
        $pendidikan_guru->nama = $req->nama;
        $pendidikan_guru->tahun_lulus = $req->tahun_lulus;

        $pendidikan_guru->update();
        if (!$pendidikan_guru) {
            return $this->returnController("error", "failed find gaji pendidikan_guru");
        }
        $pendidikan_guru = pendidikan_guru::with('guru')->where('id',$id)->first();
        Redis::del("pendidikan_guru:all");
        Redis::set("pendidikan_guru:$id", $pendidikan_guru);
        return $this->returnController("ok", $pendidikan_guru);
    }

    public function delete($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $pendidikan_guru = pendidikan_guru::find($id);
        if (!$pendidikan_guru) {
            return $this->returnController("error", "failed find gaji pendidikan_guru");
        }
        // Need to check realational
        // If there relation to other gaji, return error with message, this gaji has relation to other table(s)
        $delete = $pendidikan_guru->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete gaji pendidikan_guru");
        }
        Redis::del("pendidikan_guru:all");
        Redis::del("pendidikan_guru:$id");
        return $this->returnController("ok", "success delete gaji pendidikan_guru");
    }
}
