<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    
    use HasFactory;
    
    protected $table = 'users_table';
    
    
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function posts(){
        return $this->hasMany('app\Post');
    }
    
    public function users(){
        return $this->belongsToManyhasMany('app\User');
    }
    
    public function pets(){
        return $this->hasMany('app\Pet');
    }
    
    #public function posts(){
    #    return $this->belongsToMany('app\Post');
    #}
}
