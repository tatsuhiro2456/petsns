<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recruitment_Reply extends Model
{
    public function recruitments(){
        return $this->belongTo('App\Recruitment');
    }
}
