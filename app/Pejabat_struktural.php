<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pejabat_struktural extends Model
{
    protected $fillable = [
        'uuid','nama','NIP', 'jabatan'
    ];
    protected $hidden = [
        'id'
    ];

    public function data_berkala()
    {
        return $this->HasMany('App\Data_berkala');
    }

    public function golongan()
    {
        return $this->BelongsTo('App\Golongan');
    }
}
