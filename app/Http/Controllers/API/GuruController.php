<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Request as ApiRequest;
use App\Diklat_guru;
use App\Guru;
use HCrypt;
use Auth;

class GuruController extends APIController
{
    public function get(){
        $guru = json_decode(redis::get("guru::all"));
        if (!$guru) {
            $guru = guru::with('sekolah','golongan','jabatan','mata_pelajaran')->get();
            if (!$guru) {
                return $this->returnController("error", "failed get guru data");
            }
            Redis::set("guru:all", $guru);
        }
        return $this->returnController("ok", $guru);
    }

    // get guru filter sekolah
    public function getGuru(){
        $sekolah_id = Auth::user()->sekolah->id;
        $guru = json_decode(redis::get("guru::all"));
        if (!$guru) {
            $guru = guru::with('sekolah','golongan','jabatan','mata_pelajaran')->where('sekolah_id',$sekolah_id)->get();
            if (!$guru) {
                return $this->returnController("error", "failed get guru data");
            }
            Redis::set("guru:all", $guru);
        }
        return $this->returnController("ok", $guru);
    }

    public function find($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $guru = Redis::get("guru:$id");
        if (!$guru) {
            $guru = guru::with('golongan','jabatan','sekolah','mata_pelajaran')->where('id',$id)->first();
            if (!$guru){
                return $this->returnController("error", "failed find data guru");
            }
            Redis::set("guru:$id", $guru);
        }
        return $this->returnController("ok", $guru);
    }

    public function create(Request $req){
        // $seksi = Seksi::create($req->all());
        $sekolah_id = Auth::user()->sekolah->id;

        $cekValidasi = Validator::make(ApiRequest::all(), [

            'NIP' => 'required|unique:gurus',

        ]);

        $message = 'NIP tidak boleh sama ';
        if ($cekValidasi->fails()) {
            return response()->json([
                'Error' => $message
            ],202);
        }

        $guru = new guru;
        // decrypt foreign key id

        $guru->golongan_id = Hcrypt::decrypt($req->golongan_id);
        $guru->jabatan_id = Hcrypt::decrypt($req->jabatan_id);
        $guru->sekolah_id = $sekolah_id;
        $guru->mata_pelajaran_id = Hcrypt::decrypt($req->mata_pelajaran_id);
        $guru->NIP = $req->NIP;
        $guru->nama = $req->nama;
        $guru->telepon = $req->telepon;
        $guru->tempat_lahir = $req->tempat_lahir;
        $guru->tgl_lahir = $req->tgl_lahir;
        $guru->alamat = $req->alamat;
        $guru->status = $req->status;

        $guru->save();

        //set uuid
        $guru_id = $guru->id;
        $uuid = HCrypt::encrypt($guru_id);
        $setuuid = guru::findOrFail($guru_id);
        $setuuid->uuid = $uuid;
        $setuuid->update();
        if (!$guru) {
            return $this->returnController("error", "failed create data guru");
        }
        Redis::del("guru:all");
        Redis::set("guru:all", $guru);
        return $this->returnController("ok", $guru);
    }

    public function update($uuid, Request $req){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $guru = guru::findOrFail($id);

        $guru->golongan_id = Hcrypt::decrypt($req->golongan_id);
        $guru->jabatan_id = Hcrypt::decrypt($req->jabatan_id);
        $guru->sekolah_id = $sekolah_id;
        $guru->mata_pelajaran_id = Hcrypt::decrypt($req->mata_pelajaran_id);
        $guru->NIP = $req->NIP;
        $guru->nama = $req->nama;
        $guru->telepon = $req->telepon;
        $guru->tempat_lahir = $req->tempat_lahir;
        $guru->tgl_lahir = $req->tgl_lahir;
        $guru->alamat = $req->alamat;
        $guru->status = $req->status;

        $guru->update();
        if (!$guru) {
            return $this->returnController("error", "failed find data guru");
        }
        $guru = guru::with('golongan','jabatan','sekolah','mata_pelajaran')->where('id',$id)->first();
        Redis::del("guru:all");
        Redis::set("guru:$id", $guru);
        return $this->returnController("ok", $guru);
    }

    public function delete($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $guru = guru::find($id);
        if (!$guru) {
            return $this->returnController("error", "failed find data guru");
        }
        // Need to check realational
        // If there relation to other data, return error with message, this data has relation to other table(s)
        $delete = $guru->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete data guru");
        }
        Redis::del("guru:all");
        Redis::del("guru:$id");
        return $this->returnController("ok", "success delete data guru");
    }

    public function diklat_create(Request $req){
        $diklat_guru = New diklat_guru;

        // decrypt uuid from $req
        $guru_id = HCrypt::decrypt($req->guru_id);
        $diklat_id = HCrypt::decrypt($req->diklat_id);

        if($req->sertifikat != null)
        {
            $img = $req->file('sertifikat');
            $FotoExt  = $img->getClientOriginalExtension();
            $FotoName = $guru_id.' Diklat ';
            $foto   = $FotoName.'.'.$FotoExt;
            $img->move('file/diklat', $foto);
            $setuuid->diklat       = $foto;
        }else{
            $setuuid->diklat      = $setuuid->foto;
        }
        $diklat_guru->guru_id      =  $guru_id;
        $diklat_guru->diklat_id    =  $diklat_id;
        $diklat_guru->waktu        =  $req->waktu;

        $diklat_guru->save();

        $diklat_guru_id= $diklat_guru->id;

        $uuid = HCrypt::encrypt($diklat_guru_id);
        $setuuid = diklat_guru::findOrFail($diklat_guru_id);
        $setuuid->uuid = $uuid;

        $setuuid->update();

        if (!$diklat_guru) {
            return $this->returnController("error", "failed create data diklat guru");
        }

        Redis::del("diklat_guru:all");
        Redis::set("diklat_guru:all",$diklat_guru);
        return $this->returnController("ok", $diklat_guru);
    }

    public function diklat_get($uuid){
        $guru_id = HCrypt::decrypt($uuid);
        $diklat_guru = json_decode(redis::get("diklat_guru::all"));
        if (!$diklat_guru) {
            $diklat_guru = diklat_guru::with('diklat')->where('guru_id', $guru_id)->get();
            if (!$diklat_guru) {
                return $this->returnController("error", "failed get diklat diklat_guru data");
            }
            Redis::set("diklat_guru:all", $diklat_guru);
        }
        return $this->returnController("ok", $diklat_guru);
    }
}
