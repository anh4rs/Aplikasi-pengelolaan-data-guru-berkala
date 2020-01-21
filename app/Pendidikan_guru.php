<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pendidikan_guru extends Model
{
    protected $fillable = [
        'uuid','guru_id','pendidikan','nama','tahun_lulus',
    ];

    protected $hidden = [
        'id','guru_id'
    ];

    public function guru()
    {
     return $this->belongsTo('App\Guru');
    }
}
