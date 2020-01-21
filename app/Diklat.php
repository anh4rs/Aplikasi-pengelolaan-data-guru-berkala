<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diklat extends Model
{
    protected $fillable = [
        'uuid','kode_diklat', 'nama', 'tempat', 'penyelenggara', 
    ];

    protected $hidden = [
        'id'
    ];

    public function diklat_guru()
    {
    	return $this->hasMany('App\Diklat_guru');
    }
}
