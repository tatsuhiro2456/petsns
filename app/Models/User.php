<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    
    protected $table = 'users';
    
    
    protected $fillable = [
        'name', 'email', 'image', 'password', 'birthday',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function posts(){
        return $this->hasMany(Post::class);
    }
    
    public function following(){
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'followed_id');
    }
    
    public function followed(){
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'following_id');
    }

    public function pets(){
        return $this->hasMany(Pet::class);
    }
    
    public function likes(){
        return $this->hasMany(Like::class);
    }
    
    public function Recruitment(){
        return $this->hasMany(Recruitment::class);
    }
    
    public function replies(){
        return $this->hasMany(Reply::class);
    }
    
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    
    public function is_follow(){
        return !is_null(Follow::where('following_id', \Auth::user()->id)->where('followed_id', $this->id)->first());
    }
}