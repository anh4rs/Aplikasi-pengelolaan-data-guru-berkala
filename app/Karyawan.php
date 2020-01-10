<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use HCrypt;

class Karyawan extends Model
{
    protected $fillable = [
        'uuid', 'NIP', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'telepon'
     ];
     protected $hidden = [
         'id', 'user_id'
     ];
 
     public function user(){
       return $this->belongsTo('App\User');
     }
}
