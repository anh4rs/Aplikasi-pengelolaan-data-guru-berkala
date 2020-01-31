<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Golongan extends Model
{
    protected $fillable = [
        'uuid','kode_golongan', 'golongan'
    ];

    protected $hidden = [
        'id'
    ];

    public function gaji_berkala()
    {
        return $this->HasMany('App\Gaji_berkala');
    }

    public function pejabat_struktural()
    {
        return $this->HasMany('App\Pejabat_struktural');
    }
}
