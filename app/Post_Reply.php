<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post_Reply extends Model
{
    public function posts(){
        return $this->belongTo('App\Post');
    }
}
