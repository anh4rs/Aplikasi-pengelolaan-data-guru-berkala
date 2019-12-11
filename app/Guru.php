<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $fillable = [
        'user_id','sekolah_id','jabatan_id','mata_pelajaran_id','uuid','telepon','tempat_lahir', 'tgl_lahir','alamat'
    ];

    protected $hidden = [
        'id','user_id','sekolah_id','jabatan_id','mata_pelajaran_id'
    ];
}
