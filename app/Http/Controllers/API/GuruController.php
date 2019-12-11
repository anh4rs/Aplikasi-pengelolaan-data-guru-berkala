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
}
