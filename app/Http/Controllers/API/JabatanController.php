<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Request as ApiRequest;
use App\Jabatan;
use HCrypt;
use Illuminate\Support\Facades\Redis;

class JabatanController extends APIController
{
    public function get(){
        $jabatan = json_decode(redis::get("jabatan::all"));
        if (!$jabatan) {
            $jabatan = jabatan::all();
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
            $jabatan = jabatan::find($id);
            if (!$jabatan){
                return $this->returnController("error", "failed find data jabatan");
            }
            Redis::set("jabatan:$id", $jabatan);
        }
        return $this->returnController("ok", $jabatan);
    }

    public function create(Request $req){
        $cekValidasi = Validator::make(ApiRequest::all(), [

            'kode_jabatan' => 'required|unique:jabatans',

        ]);

        $message = 'Kode jabatan tidak boleh sama ';
        if ($cekValidasi->fails()) {
            return response()->json([
                'Error' => $message
            ],202);
        }

        $jabatan = jabatan::create($req->all());
        
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

        if (!$jabatan) {
            return $this->returnController("error", "failed find data jabatan");
        }

        $jabatan->fill($req->all())->save();

        Redis::del("jabatan:all");
        Redis::set("jabatan:$id", $jabatan);
        return $this->returnController("ok", $jabatan);
    }

    public function delete($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $jabatan = jabatan::find($id);
        if (!$jabatan) {
            return $this->returnController("error", "failed find data jabatan");
        }
        // Need to check realational
        // If there relation to other data, return error with message, this data has relation to other table(s)
        $delete = $jabatan->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete data jabatan");
        }
        Redis::del("jabatan:all");
        Redis::del("jabatan:$id");
        return $this->returnController("ok", "success delete data jabatan");
    }
}
