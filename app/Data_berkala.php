<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Data_berkala extends Model
{
    protected $fillable = [
        'uuid','sekolah_id','guru_id','pejabat_struktural_id','no_surat','lampiran',
        'perihal','gaji_lama','tgl_keputusan','no_keputusan','tgl_gaji_berikut',
    ];

    protected $hidden = [
        'id','sekolah_id','guru_id','pejabat_struktural_id'
    ];

    public function sekolah()
    {
     return $this->belongsTo('App\Sekolah');
    }

    public function guru()
    {
        return $this->BelongsTo('App\Guru');
    }

    public function pejabat_struktural()
    {
        return $this->BelongsTo('App\Pejabat_struktural');
    }

    public function inbox()
    {
    	return $this->hasMany('App\Inbox');
    }
}
