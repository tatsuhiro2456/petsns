<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'contents';
    
    public function posts(){
        return $this->belongsToMany('App\Post');
    }
    public function getByContent()
    {
        return $this->posts()->with('contents')->orderBy('updated_at', 'DESC')->get();
    }
}
