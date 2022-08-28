<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts_table';
    
    use HasFactory;
    
    public function users(){
        return $this->belongTo('app\User');
    }
    
    #public function users(){
    #    return $this->belongsToMany('app\User');
    #}
    
    public function contents(){
        return $this->belongsToMany('app\Content');
    }
    
    public function post_replies(){
        return $this->hasMany('app\Post_Reply');
    }
}
