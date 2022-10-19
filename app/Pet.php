<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $table = 'pets';
    
    protected $fillable = ['name', 'type', 'image', 'user_id'];
    
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    public function posts(){
        return $this->belongsToMany('App\Post');
    }
    
    public function likes()
    {
        return $this->hasManyThrough('App\Like', 'App\Post');
    }
}
