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
}
