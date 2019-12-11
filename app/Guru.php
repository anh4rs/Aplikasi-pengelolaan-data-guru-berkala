<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $fillable = [
        'golongan_id','sekolah_id','jabatan_id','mata_pelajaran_id','uuid','telepon','tempat_lahir', 'tgl_lahir','alamat','status'
    ];

    protected $hidden = [
        'id','golongan_id','sekolah_id','jabatan_id','mata_pelajaran_id'
    ];
}
