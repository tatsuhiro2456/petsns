<?php

namespace App;

use App\Post;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'contents';
    
    public function posts(){
        return $this->belongsToMany('App\Post');
    }
}
