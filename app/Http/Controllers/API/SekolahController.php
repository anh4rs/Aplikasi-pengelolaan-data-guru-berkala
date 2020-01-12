<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Sekolah;
use App\User;
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

        $sekolah = sekolah::findOrFail($id);
        $user_id = $sekolah->user_id;
        $user = User::findOrFail($user_id);
        if (!$user){
                return $this->returnController("error", "failed find data sekolah");
            }
        if($req->foto != null){
                $FotoExt  = $req->foto->getClientOriginalExtension();
                $FotoName = $req->user_id.' - '.$req->name;
                $foto   = $FotoName.'.'.$FotoExt;
                $req->foto->move('images/user', $foto);
                $user->foto       = $foto;
                }else {
                    $user->foto  = $user->foto;
                }
            $user->name            = $req->name;
            $user->email    = $req->email;
            if($req->password != null){
                $password       = Hash::make($req->password);
                $user->password = $password;
            }else{
                $user->password = $user->password;
            }

           $user->update();

           $sekolah->nama     = $req->nama;
           $sekolah->NPSN    = $req->NPSN;
           $sekolah->status_sekolah    = $req->status_sekolah;
           $sekolah->b_pendidikan    = $req->b_pendidikan;
           $sekolah->status_pemilik    = $req->status_pemilik;
           $sekolah->sk    = $req->sk;
           $sekolah->tgl_sk    = $req->tgl_sk;
           $sekolah->sk_izin    = $req->sk_izin;
           $sekolah->tgl_sk_izin    = $req->tgl_sk_izin;
           $sekolah->update();
        if (!$user && $sekolah) {
            return $this->returnController("error", "failed find data sekolah");
        }
        $merge = (['user' => $user, 'sekolah' => $sekolah]);

        Redis::del("user:all");
        Redis::set("user:$user_id", $user);
        Redis::del("sekolah:all");
        Redis::set("sekolah:$id", $sekolah);

        return $this->returnController("ok", $merge);
    }

    public function delete($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }

        $sekolah = sekolah::find($id);
        $user = user::find($sekolah->user_id);
        if (!$user) {
            return $this->returnController("error", "failed find data sekolah");
        }

        // Need to check realational
        // If there relation to other data, return error with message, this data has relation to other table(s)
        $image_path = "img/user/".$user->foto;  // Value is not URL but directory file path
        if(File::exists($image_path)) {
        File::delete($image_path);
        }
        $delete = $user->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete data sekolah");
        }

        Redis::del("user:all");
        Redis::del("user:$sekolah->user_id");
        return $this->returnController("ok", "success delete data sekolah");
    }
}
