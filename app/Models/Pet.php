<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $table = 'pets';
    
    protected $fillable = ['name', 'type', 'image', 'user_id'];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function posts(){
        return $this->belongsToMany(Post::class);
    }
    
    public function likes()
    {
        return $this->hasManyThrough(Like::class, Post::class);
    }
}
