<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gaji_berkala extends Model
{
    protected $fillable = [
        'uuid','guru_id','pejabat_struktural_id','no_surat','lampiran',
        'perihal','gaji_lama','tgl_keputusan','no_keputusan',
    ];

    protected $hidden = [
        'id','guru_id','pejabat_struktural_id'
    ];

    public function guru()
    {
        return $this->BelongsTo('App\Guru');
    }

    public function pejabat_struktural()
    {
        return $this->BelongsTo('App\Pejabat_struktural');
    }
}
