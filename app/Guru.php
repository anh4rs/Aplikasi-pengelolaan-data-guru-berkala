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

    public function data_berkala()
    {
        return $this->HasMany('App\Data_berkala');
    }

    public function pendidikan_guru()
    {
        return $this->HasMany('App\Pendidikan_guru');
    }

}
