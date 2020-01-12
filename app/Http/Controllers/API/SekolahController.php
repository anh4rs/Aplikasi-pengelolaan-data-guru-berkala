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
            $sekolah = sekolah::all();
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

    public function create(Request $req){
        $user = User::create($req->all());
        // hash password
        $password=Hash::make($user->password);
        //set uuid
        $user_id = $user->id;
        $uuid = HCrypt::encrypt($user_id);
        $setuuid = User::findOrFail($user_id);
        $setuuid->uuid = $uuid;
        $setuuid->password = $password;
        $setuuid->role = 2;
        if($req->foto != null)
        {
            $img = $req->file('foto');
            $FotoExt  = $img->getClientOriginalExtension();
            $FotoName = $user_id.' - '.$req->username;
            $foto   = $FotoName.'.'.$FotoExt;
            $img->move('img/sekolah', $foto);
            $setuuid->foto       = $foto;
        }else{
            $setuuid->foto       = $setuuid->foto;
        }
        $setuuid->update();

        $sekolah = $user->sekolah()->create($req->all());
        
        //set uuid
        $sekolah_id = $sekolah->id;
        $uuid = HCrypt::encrypt($sekolah_id);
        $setuuid = sekolah::findOrFail($sekolah_id);
        $setuuid->uuid = $uuid;
        $setuuid->update();
        if (!$sekolah) {
            return $this->returnController("error", "failed create data sekolah");
        }

        $merge = (['user' => $user, 'sekolah' => $sekolah]);
        
        Redis::set("user:all", $user);
        Redis::set("sekolah:all", $sekolah);
        return $this->returnController("ok", $merge);
    }

    public function update($uuid, Request $req){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }

        $sekolah = Sekolah::findOrFail($id);

        if (!$sekolah) {
            return $this->returnController("error", "failed find data sekolah");
        
        }
        $sekolah->fill($req->all())->save();

        Redis::del("sekolah:all");
        Redis::set("sekolah:$id", $sekolah);
        return $this->returnController("ok", $sekolah);
    }

    public function delete($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $sekolah = sekolah::findOrFail($id);
        if (!$sekolah) {
            return $this->returnController("error", "failed find data sekolah");
        }
        // Need to check realational
        // If there relation to other data, return error with message, this data has relation to other table(s)
        $delete = $sekolah->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete data sekolah");
        }
        Redis::del("sekolah:all");
        Redis::del("sekolah:$id");
        return $this->returnController("ok", "success delete data sekolah");
    }
}
