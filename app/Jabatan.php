<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $fillable = [
        'golongan_id','uuid','kode_jabatan', 'jabatan'
    ];

    protected $hidden = [
        'id','golongan_id'
    ];
}
