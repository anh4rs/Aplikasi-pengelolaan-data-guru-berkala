<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mata_pelajaran;
use HCrypt;
use Illuminate\Support\Facades\Redis;

class MPController extends APIController
{
    public function get(){
        $mata_pelajaran = json_decode(redis::get("mata_pelajaran::all"));
        if (!$mata_pelajaran) {
            $mata_pelajaran = mata_pelajaran::all();
            if (!$mata_pelajaran) {
                return $this->returnController("error", "failed get mata_pelajaran data");
            }
            Redis::set("mata_pelajaran:all", $mata_pelajaran);
        }
        return $this->returnController("ok", $mata_pelajaran);
    }

    public function find($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $mata_pelajaran = Redis::get("mata_pelajaran:$id");
        if (!$mata_pelajaran) {
            $mata_pelajaran = mata_pelajaran::find($id);
            if (!$mata_pelajaran){
                return $this->returnController("error", "failed find data mata_pelajaran");
            }
            Redis::set("mata_pelajaran:$id", $mata_pelajaran);
        }
        return $this->returnController("ok", $mata_pelajaran);
    }

    public function create(Request $req){
        $mata_pelajaran = mata_pelajaran::create($req->all());
        //set uuid
        $mata_pelajaran_id = $mata_pelajaran->id;
        $uuid = HCrypt::encrypt($mata_pelajaran_id);
        $setuuid = mata_pelajaran::findOrFail($mata_pelajaran_id);
        $setuuid->uuid = $uuid;
        $setuuid->update();
        if (!$mata_pelajaran) {
            return $this->returnController("error", "failed create data mata_pelajaran");
        }
        Redis::del("mata_pelajaran:all");
        Redis::set("mata_pelajaran:all", $mata_pelajaran);
        return $this->returnController("ok", $mata_pelajaran);
    }

}
