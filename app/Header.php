<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function details(){
        return $this->hasMany('App\Detail');
    }
}
