<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post_Reply extends Model
{
    public function posts(){
        return $this->belongTo(Post::class);
    }
}
