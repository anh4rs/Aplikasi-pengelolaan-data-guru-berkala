<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $fillable = [
        'uuid','kode_jabatan', 'jabatan'
    ];

    protected $hidden = [
        'id','golongan_id'
    ];

    // public function golongan()
    // {
    //     return $this->belongsTo('App\Golongan');
    // }
}
