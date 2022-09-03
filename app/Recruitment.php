<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    public function recluitment_replies(){
        return $this->hasMany('App\Recruitment_Reply');
    }
}
