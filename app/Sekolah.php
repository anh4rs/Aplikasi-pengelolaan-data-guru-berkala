<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    protected $fillable = [
        'uuid','nama','NPSN', 'status_sekolah','b_pendidikan','status_pemilik', 'sk',
        'tgl_sk','sk_izin', 'tgl_sk_izin',
    ];

    protected $hidden = [
        'id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
      }
}
