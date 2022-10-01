<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Follow;

class User extends Authenticatable
{
    use Notifiable;
    
    protected $table = 'users';
    
    
    protected $fillable = [
        'name', 'email', 'password', 'birthday',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function posts(){
        return $this->hasMany('App\Post');
    }
    
    public function following(){
        return $this->belongsToMany('App\User', 'follows', 'following_id', 'followed_id');
    }
    
    public function followed(){
        return $this->belongsToMany('App\User', 'follows', 'followed_id', 'following_id');
    }

    public function pets(){
        return $this->hasMany('App\Pet');
    }
    
    #public function posts(){
    #    return $this->belongsToMany('app\Post');
    #}
    
    public function is_follow(){
        return !is_null(Follow::where('following_id', \Auth::user()->id)->where('followed_id', $this->id)->first());
    }
}