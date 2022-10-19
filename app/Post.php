<?php

namespace App;


use Carbon\Carbon;
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
    public function pets(){
        return $this->belongsToMany('App\Pet');
    }
    
    
    public function comments(){
        return $this->hasMany('App\Comment');
    }
    
    public function getorderBy(){
        return $this::with('contents')->orderBy('updated_at', 'DESC')->get();
    }

    public function is_like(){
        return !is_null(Like::where('post_id', $this->id)->where('user_id', \Auth::user()->id)->first());
    }
    
    /*public function Ranking()
    {
        $today = Carbon::now()->format('Y-m');
        $start = $today.'-01 00:00:00';
        $end = $today.'-31 23:59:59';
        
        return $this::where('created_at', '>',$start)->where('created_at', '<', $end)->withCount('likes')->orderBy('likes_count', 'desc')->get();
    }*/
}
