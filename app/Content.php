<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;
    
    public function posts(){
        return $this->belongsToMany('app\Post');
    }
}
