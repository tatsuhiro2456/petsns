<?php

namespace App\Models;

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
        return $this->belongsTo(User::class);
    }
    
    public function replies(){
        return $this->hasMany(Reply::class);
    }
    
    public function getorderBy(){
        return $this::orderBy('updated_at', 'desc')->get();
    }
}
