<?php

namespace App\Models;


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
        return $this->belongsTo(User::class);
    }
    
    public function contents(){
        return $this->belongsToMany(Content::class);
    }
    
    public function likes(){
        return $this->hasMany(Like::class);
    }
    public function pets(){
        return $this->belongsToMany(Pet::class);
    }
    
    
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    
    public function getorderBy(){
        return $this::with('contents')->orderBy('updated_at', 'desc')->get();
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
