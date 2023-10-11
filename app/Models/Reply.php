<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = [
        'body',
        'user_id',
        'recruitment_id'
    ];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function recruitments(){
        return $this->belongTo(Recruitment::class);
    }
    
}
