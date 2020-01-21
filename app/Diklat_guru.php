<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diklat_guru extends Model
{
    protected $hidden = [
        'id','guru_id','diklat_id'
    ];

    public function diklat()
    {
        return $this->belongsTo('App\Diklat');
    }
}
