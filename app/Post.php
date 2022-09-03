<?php

namespace App;

use App\Content;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    
    protected $fillable = [
        'body',
        'user_id',
    ];
    
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    public function contents(){
        return $this->belongsToMany('App\Content');
    }
    
    #public function users(){
    #    return $this->belongsToMany('app\User');
    #}
    
    
    public function post_replies(){
        return $this->hasMany('App\Post_Reply');
    }
    
    public function getorderBy(){
        return $this->orderBy('updated_at', 'DESC')->get();
    }
    
    
}
