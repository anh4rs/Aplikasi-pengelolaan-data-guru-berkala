<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jabatan;
use HCrypt;
use Illuminate\Support\Facades\Redis;

class JabatanController extends APIController
{
    public function get(){
        $jabatan = json_decode(redis::get("jabatan::all"));
        if (!$jabatan) {
            $jabatan = jabatan::with('golongan')->get();
            if (!$jabatan) {
                return $this->returnController("error", "failed get jabatan data");
            }
            Redis::set("jabatan:all", $jabatan);
        }
        return $this->returnController("ok", $jabatan);
    }
}
