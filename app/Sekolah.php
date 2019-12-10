<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    protected $fillable = [
        'uuid','NPSN', 'status','b_pendidikan','status_pemilik', 'sk',
        'tgl_sk','sk_izin', 'tgl_sk_izin',
    ];

    protected $hidden = [
        'id'
    ];
}
