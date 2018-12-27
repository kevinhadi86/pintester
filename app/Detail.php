<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    public function header(){
        return $this->belongsTo('App\Header');
    }
    public function post(){
        return $this->belongsTo('App\Post');
    }
}
