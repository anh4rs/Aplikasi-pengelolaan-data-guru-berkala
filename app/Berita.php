<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $fillable = [
        'uuid','user_id','judul','isi'
    ];

    protected $hidden = [
        'id','user_id'
    ];

    public function user()
    {
        return $this->BelongsTo('App\User');
    }
}
