<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gaji_berkala extends Model
{
    protected $fillable = [
        'uuid','golongan_id','mkg','besaran_gaji',
    ];

    protected $hidden = [
        'id','golongan_id'
    ];

    public function Golongan()
    {
     return $this->belongsTo('App\Golongan');
    }
}
