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

}
