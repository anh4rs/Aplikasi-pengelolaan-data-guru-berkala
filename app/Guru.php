<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $fillable = [
        'golongan_id','sekolah_id','jabatan_id','mata_pelajaran_id','uuid','telepon','tempat_lahir', 'tgl_lahir','alamat','status'
    ];

    protected $hidden = [
        'id'
    ];

    public function sekolah()
    {
     return $this->belongsTo('App\Sekolah');
    }

    public function jabatan()
    {
     return $this->belongsTo('App\Jabatan');
    }

    public function golongan()
    {
     return $this->belongsTo('App\Golongan');
    }

    public function mata_pelajaran()
    {
     return $this->belongsTo('App\Mata_pelajaran');
    }

    public function gaji_berkala()
    {
        return $this->HasMany('App\Gaji_berkala');
    }

}
