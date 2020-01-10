<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PejabatStruktural;
use HCrypt;
use Illuminate\Support\Facades\Redis;

class PejabatController extends APIController
{
    public function get(){
        $pejabat_struktural = json_decode(redis::get("pejabat_struktural::all"));
        if (!$pejabat_struktural) {
            $pejabat_struktural = pejabat_struktural::all();
            if (!$pejabat_struktural) {
                return $this->returnController("error", "failed get pejabat_struktural data");
            }
            Redis::set("pejabat_struktural:all", $pejabat_struktural);
        }
        return $this->returnController("ok", $pejabat_struktural);
    }

    public function find($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $pejabat_struktural = Redis::get("pejabat_struktural:$id");
        if (!$pejabat_struktural) {
            $pejabat_struktural = pejabat_struktural::find($id);
            if (!$pejabat_struktural){
                return $this->returnController("error", "failed find data pejabat_struktural");
            }
            Redis::set("pejabat_struktural:$id", $pejabat_struktural);
        }
        return $this->returnController("ok", $pejabat_struktural);
    }

    public function create(Request $req){
        $pejabat_struktural = pejabat_struktural::create($req->all());

        //set uuid
        $pejabat_struktural_id = $pejabat_struktural->id;
        $uuid = HCrypt::encrypt($pejabat_struktural_id);
        $setuuid = pejabat_struktural::findOrFail($pejabat_struktural_id);
        $setuuid->uuid = $uuid;
        $setuuid->update();
        if (!$pejabat_struktural) {
            return $this->returnController("error", "failed create data pejabat_struktural");
        }
        Redis::del("pejabat_struktural:all");
        Redis::set("pejabat_struktural:all", $pejabat_struktural);
        return $this->returnController("ok", $pejabat_struktural);
    }

    public function update($uuid, Request $req){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }

        $pejabat_struktural = pejabat_struktural::findOrFail($id);

        if (!$pejabat_struktural) {
            return $this->returnController("error", "failed find data pejabat_struktural");
        }

        $pejabat_struktural->fill($req->all())->save();

        Redis::del("pejabat_struktural:all");
        Redis::set("pejabat_struktural:$id", $pejabat_struktural);
        return $this->returnController("ok", $pejabat_struktural);
    }

    public function delete($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $pejabat_struktural = pejabat_struktural::find($id);
        if (!$pejabat_struktural) {
            return $this->returnController("error", "failed find data pejabat_struktural");
        }
        // Need to check realational
        // If there relation to other data, return error with message, this data has relation to other table(s)
        $delete = $pejabat_struktural->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete data pejabat_struktural");
        }
        Redis::del("pejabat_struktural:all");
        Redis::del("pejabat_struktural:$id");
        return $this->returnController("ok", "success delete data pejabat_struktural");
    }
}
