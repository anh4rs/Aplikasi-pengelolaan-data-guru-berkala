<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Golongan;
use HCrypt;

class GuruController extends APIController
{
    public function get(){
        $guru = json_decode(redis::get("guru::all"));
        if (!$guru) {
            $guru = guru::all();
            if (!$guru) {
                return $this->returnController("error", "failed get guru data");
            }
            Redis::set("guru:all", $guru);
        }
        return $this->returnController("ok", $guru);
    }

    public function find($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $guru = Redis::get("guru:$id");
        if (!$guru) {
            $guru = guru::with('golongan','jabatan','sekolah','mata_pelajaran')->where('id',$id)->first();
            if (!$guru){
                return $this->returnController("error", "failed find data guru");
            }
            Redis::set("guru:$id", $guru);
        }
        return $this->returnController("ok", $guru);
    }

    public function create(Request $req){
        // $seksi = Seksi::create($req->all());
        $guru = new guru;
        // decrypt foreign key id
        $guru->golongan_id = Hcrypt::decrypt($req->golongan_id);
        $guru->jabatan_id = Hcrypt::decrypt($req->jabatan_id);
        $guru->sekolah_id = Hcrypt::decrypt($req->sekolah_id);
        $guru->mata_pelajaran_id = Hcrypt::decrypt($req->mata_pelajaran_id);
        $guru->telepon = $req->telepon;
        $guru->tempat_lahir = $req->tempat_lahir;
        $guru->tgl_lahir = $req->tgl_lahir;
        $guru->alamat = $req->alamat;
        $guru->status = $req->status;

        $guru->save();

        //set uuid
        $guru_id = $guru->id;
        $uuid = HCrypt::encrypt($guru_id);
        $setuuid = guru::findOrFail($guru_id);
        $setuuid->uuid = $uuid;
        $setuuid->update();
        if (!$guru) {
            return $this->returnController("error", "failed create data guru");
        }
        Redis::del("guru:all");
        Redis::set("guru:all", $guru);
        return $this->returnController("ok", $guru);
    }

    public function update($uuid, Request $req){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $guru = guru::findOrFail($id);
        $guru->kode_guru     = $req->kode_guru;
        $guru->nama    = $req->nama;
        $guru->bidang_id = Hcrypt::decrypt($req->bidang_id);
        $guru->update();
        if (!$guru) {
            return $this->returnController("error", "failed find data guru");
        }
        $guru = guru::with('golongan','jabatan','sekolah','mata_pelajaran')->where('id',$id)->first();
        Redis::del("guru:all");
        Redis::set("guru:$id", $guru);
        return $this->returnController("ok", $guru);
    }

    public function delete($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $guru = guru::find($id);
        if (!$guru) {
            return $this->returnController("error", "failed find data guru");
        }
        // Need to check realational
        // If there relation to other data, return error with message, this data has relation to other table(s)
        $delete = $guru->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete data guru");
        }
        Redis::del("guru:all");
        Redis::del("guru:$id");
        return $this->returnController("ok", "success delete data guru");
    }
}
