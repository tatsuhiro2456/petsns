<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    public function posts(){
        return $this->belongsToMany('app\Post');
    }
}
