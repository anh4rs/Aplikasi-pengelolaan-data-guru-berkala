<?php

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Golongan;
use HCrypt;
use Illuminate\Support\Facades\Redis;

class GolonganController extends APIController
{
    public function get(){
        $golongan = json_decode(redis::get("golongan::all"));
        if (!$golongan) {
            $golongan = golongan::all();
            if (!$golongan) {
                return $this->returnController("error", "failed get golongan data");
            }
            Redis::set("golongan:all", $golongan);
        }
        return $this->returnController("ok", $golongan);
        }

    public function find($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $golongan = Redis::get("golongan:$id");
        if (!$golongan) {
            $golongan = golongan::find($id);
            if (!$golongan){
                return $this->returnController("error", "failed find data golongan");
            }
            Redis::set("golongan:$id", $golongan);
        }
        return $this->returnController("ok", $golongan);
    }
}
