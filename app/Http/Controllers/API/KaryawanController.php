<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Karyawan;
use App\User;
use HCrypt;

class KaryawanController extends APIController
{
    public function get(){
        $karyawan = json_decode(redis::get("karyawan::all"));
        if (!$karyawan) {
            $karyawan = karyawan::with('user')->get();
            if (!$karyawan) {
                return $this->returnController("error", "failed get karyawan data");
            }
            Redis::set("karyawan:all", $karyawan);
        }
        return $this->returnController("ok", $karyawan);
    }

    public function find($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $karyawan = Redis::get("karyawan:$id");
        if (!$karyawan) {
            $karyawan = karyawan::with('user')->where('id', $id)->first();
            if (!$karyawan){
                return $this->returnController("error", "failed find data karyawan");
            }
            Redis::set("karyawan:$id", $karyawan);
        }
        return $this->returnController("ok", $karyawan);
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
            $img->move('img/karyawan', $foto);
            $setuuid->foto       = $foto;
        }else{
            $setuuid->foto       = $setuuid->foto;
        }
        $setuuid->update();

        $karyawan = $user->karyawan()->create($req->all());
        //set uuid
        $karyawan_id = $karyawan->id;
        $uuid = HCrypt::encrypt($karyawan_id);
        $setuuid = Karyawan::findOrFail($karyawan_id);
        $setuuid->uuid = $uuid;
        $setuuid->update();
        if (!$user && $karyawan) {
            return $this->returnController("error", "failed create data karyawan");
        }

        $merge = (['user' => $user, 'karyawan' => $karyawan]);
        Redis::del("user:all");
        Redis::set("user:$user_id", $user);
        Redis::del("karyawan:all");
        Redis::set("karyawan:$karyawan_id", $karyawan);
        return $this->returnController("ok", $merge);
    }

    public function update($uuid, Request $req){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }

        $karyawan = karyawan::findOrFail($id);
        $user_id = $karyawan->user_id;
        $user = User::findOrFail($user_id);
        if (!$user){
                return $this->returnController("error", "failed find data karyawan");
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
           $karyawan->NIP     = $req->NIP;
           $karyawan->tempat_lahir    = $req->tempat_lahir;
           $karyawan->tanggal_lahir    = $req->tanggal_lahir;
           $karyawan->alamat    = $req->alamat;
           $karyawan->telepon    = $req->telepon;
           $karyawan->update();
        if (!$user && $karyawan) {
            return $this->returnController("error", "failed find data karyawan");
        }
        $merge = (['user' => $user, 'karyawan' => $karyawan]);

        Redis::del("user:all");
        Redis::set("user:$user_id", $user);
        Redis::del("karyawan:all");
        Redis::set("karyawan:$id", $karyawan);

        return $this->returnController("ok", $merge);
    }

    public function delete($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }

        $karyawan = karyawan::find($id);
        $user = user::find($karyawan->user_id);
        if (!$user) {
            return $this->returnController("error", "failed find data karyawan");
        }

        // Need to check realational
        // If there relation to other data, return error with message, this data has relation to other table(s)
        $image_path = "img/user/".$user->foto;  // Value is not URL but directory file path
        if(File::exists($image_path)) {
        File::delete($image_path);
        }
        $delete = $user->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete data karyawan");
        }

        Redis::del("user:all");
        Redis::del("user:$karyawan->user_id");

        return $this->returnController("ok", "success delete data karyawan");
    }
}