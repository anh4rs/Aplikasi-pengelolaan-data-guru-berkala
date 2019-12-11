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

    public function update($uuid, Request $req){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }

        $mata_pelajaran = mata_pelajaran::findOrFail($id);

        if (!$mata_pelajaran) {
            return $this->returnController("error", "failed find data mata_pelajaran");
        }
        
        $mata_pelajaran->fill($req->all())->save();

        Redis::del("mata_pelajaran:all");
        Redis::set("mata_pelajaran:$id", $mata_pelajaran);
        return $this->returnController("ok", $mata_pelajaran);
    }

    public function delete($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $mata_pelajaran = mata_pelajaran::findOrFail($id);
        if (!$mata_pelajaran) {
            return $this->returnController("error", "failed find data mata_pelajaran");
        }
        // Need to check realational
        // If there relation to other data, return error with message, this data has relation to other table(s)
        $delete = $mata_pelajaran->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete data mata_pelajaran");
        }
        Redis::del("mata_pelajaran:all");
        Redis::del("mata_pelajaran:$id");
        return $this->returnController("ok", "success delete data mata_pelajaran");
    }

}
