<?php

namespace App;

use App\Content;
use App\User;
use App\Like;
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
    
    public function likes(){
        return $this->hasMany('App\Like');
    }
    #public function users(){
    #    return $this->belongsToMany('app\User');
    #}
    
    
    public function comments(){
        return $this->hasMany('App\Comment');
    }
    
    public function getorderBy(){
        return $this::with('contents')->orderBy('updated_at', 'DESC')->get();
    }

    public function is_like(){
        return !is_null(Like::where('post_id', $this->id)->where('user_id', \Auth::user()->id)->first());
    }
    
}
