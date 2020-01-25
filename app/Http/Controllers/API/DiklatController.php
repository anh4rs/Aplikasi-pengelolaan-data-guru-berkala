<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Request as ApiRequest;
use App\Diklat;
use HCrypt;
use Illuminate\Support\Facades\Redis;

class DiklatController extends APIController
{
    public function get(){
        $diklat = json_decode(redis::get("diklat::all"));
        if (!$diklat) {
            $diklat = diklat::all();
            if (!$diklat) {
                return $this->returnController("error", "failed get diklat data");
            }
            Redis::set("diklat:all", $diklat);
        }
        return $this->returnController("ok", $diklat);
        }

    public function find($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $diklat = Redis::get("diklat:$id");
        if (!$diklat) {
            $diklat = diklat::find($id);
            if (!$diklat){
                return $this->returnController("error", "failed find data diklat");
            }
            Redis::set("diklat:$id", $diklat);
        }
        return $this->returnController("ok", $diklat);
    }

    public function create(Request $req){
        $cekValidasi = Validator::make(ApiRequest::all(), [

            'kode_diklat' => 'required|unique:diklats',

        ]);

        $message = 'Kode diklat tidak boleh sama ';
        if ($cekValidasi->fails()) {
            return response()->json([
                'Error' => $message
            ],202);
        }

        $diklat = diklat::create($req->all());
        //set uuid
        $diklat_id = $diklat->id;
        $uuid = HCrypt::encrypt($diklat_id);
        $setuuid = diklat::findOrFail($diklat_id);
        $setuuid->uuid = $uuid;
        $setuuid->update();
        if (!$diklat) {
            return $this->returnController("error", "failed create data diklat");
        }
        Redis::del("diklat:all");
        Redis::set("diklat:all", $diklat);
        return $this->returnController("ok", $diklat);
    }

    public function update($uuid, Request $req){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }

        $diklat = diklat::findOrFail($id);

        if (!$diklat) {
            return $this->returnController("error", "failed find data diklat");
        }
        
        $diklat->fill($req->all())->save();

        Redis::del("diklat:all");
        Redis::set("diklat:$id", $diklat);
        return $this->returnController("ok", $diklat);
    }

    public function delete($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $diklat = diklat::findOrFail($id);
        if (!$diklat) {
            return $this->returnController("error", "failed find data diklat");
        }
        // Need to check realational
        // If there relation to other data, return error with message, this data has relation to other table(s)
        $delete = $diklat->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete data diklat");
        }
        Redis::del("diklat:all");
        Redis::del("diklat:$id");
        return $this->returnController("ok", "success delete data diklat");
    }
}
