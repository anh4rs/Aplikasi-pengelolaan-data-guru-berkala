<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mata_pelajaran extends Model
{
    protected $fillable = [
        'uuid','kode_mp', 'nama'
    ];

    protected $hidden = [
        'id'
    ];
}
