<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    
    protected $fillable = [
        'body',
        'user_id'
    ];
    
    public function user(){
        return $this->belongsTo('app\User');
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
    
    public function getorderBy(){
        return $this->orderBy('updated_at', 'DESC')->get();
    }
    
    
}
