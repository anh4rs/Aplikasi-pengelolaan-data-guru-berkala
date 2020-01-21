<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
    public function data_berkala(){
        return $this->belongsTo('App\Data_berkala');
      }
}
