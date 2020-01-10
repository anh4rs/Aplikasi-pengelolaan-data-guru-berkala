<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Berita;
use App\User;
use HCrypt;
use Auth;

class BeritaController extends APIController
{
    public function get(){
        $berita = json_decode(redis::get("berita::all"));
        if (!$berita) {
            $berita = berita::with('user')->get();
            if (!$berita) {
                return $this->returnController("error", "failed get berita data");
            }
            Redis::set("berita:all", $berita);
        }
        return $this->returnController("ok", $berita);
    }

    public function find($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $berita = Redis::get("berita:$id");
        if (!$berita) {
            $berita = berita::with('user')->where('id',$id)->first();
            if (!$berita){
                return $this->returnController("error", "failed find data berita");
            }
            Redis::set("berita:$id", $berita);
        }
        return $this->returnController("ok", $berita);
    }

    public function create(Request $req){
        $user_id = Auth::id();
        $user = User::findOrFail($user_id);
        $berita = $user->berita()->create($req->all());
        
        $berita_id= $berita->id;
        $uuid = HCrypt::encrypt($berita_id);
        $setuuid = berita::findOrFail($berita_id);
        $setuuid->uuid = $uuid;
        if($req->foto != null)
        {
            $img = $req->file('foto');
            $FotoExt  = $img->getClientOriginalExtension();
            $FotoName = $user_id.'-'.$berita_id.'-'.$req->judul;
            $foto   = $FotoName.'.'.$FotoExt;
            $img->move('img/berita', $foto);
            $setuuid->foto       = $foto;
        }else{
            
        }

        $setuuid->update();
        
        if (!$berita) {
            return $this->returnController("error", "failed create data berita");
        }
        Redis::del("berita:all");
        Redis::set("berita:all",$berita);
        return $this->returnController("ok", $berita);
    }

    public function update($uuid, Request $req){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }

        $berita = berita::findOrFail($id);

        if (!$berita){
            return $this->returnController("error", "failed find data pelanggan");
        }

        $berita->judul              =  $req->judul;
        $berita->isi              =  $req->isi;
        if($req->foto != null){
            $img = $req->file('foto');
            $FotoExt  = $img->getClientOriginalExtension();
            $FotoName = $berita->judul;
            $foto   = $FotoName.'.'.$FotoExt;
            $img->move('img/berita', $foto);
            $berita->foto       = $foto;
        }else{
            $berita->foto       = $berita->foto;
        }

        $berita->update();
        
        if (!$berita) {
            return $this->returnController("error", "failed find data berita");
        }
        $berita = berita::with('user')->where('id',$id)->first();
        Redis::del("berita:all");
        Redis::set("berita:$id", $berita);
        return $this->returnController("ok", $berita);
    }

    public function delete($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $berita = berita::find($id);
        if (!$berita) {
            return $this->returnController("error", "failed find data berita");
        }
        // Need to check realational
        // If there relation to other data, return error with message, this data has relation to other table(s)
        $image_path = "img/berita/".$berita->foto;  // Value is not URL but directory file path
        if(File::exists($image_path)) {
        File::delete($image_path);
        }
        $delete = $berita->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete data berita");
        }
        Redis::del("berita:all");
        Redis::del("berita:$id");
        return $this->returnController("ok", "success delete data berita");
    }
}
