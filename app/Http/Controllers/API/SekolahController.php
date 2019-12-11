<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Sekolah;
use HCrypt;
use Illuminate\Support\Facades\Redis;

class SekolahController extends APIController
{
    public function get(){
        $sekolah = json_decode(redis::get("sekolah::all"));
        if (!$sekolah) {
            $sekolah = sekolah::with('bidang')->get();
            if (!$sekolah) {
                return $this->returnController("error", "failed get sekolah data");
            }
            Redis::set("sekolah:all", $sekolah);
        }
        return $this->returnController("ok", $sekolah);
    }

    public function find($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $sekolah = Redis::get("sekolah:$id");
        if (!$sekolah) {
            $sekolah = sekolah::find($id);
            if (!$sekolah){
                return $this->returnController("error", "failed find data sekolah");
            }
            Redis::set("sekolah:$id", $sekolah);
        }
        return $this->returnController("ok", $sekolah);
    }
}
