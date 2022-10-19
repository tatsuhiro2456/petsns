<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = [
        'body',
        'user_id',
        'recruitment_id'
    ];
    
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    public function recruitments(){
        return $this->belongTo('App\Recruitment');
    }
    
}
