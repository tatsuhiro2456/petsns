<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    protected $table = 'recruitments';
    
    protected $fillable = [
        'title',
        'body',
        'user_id',
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function replies(){
        return $this->hasMany('App\Reply');
    }
    
    public function getorderBy(){
        return $this::orderBy('updated_at', 'desc')->get();
    }
}
