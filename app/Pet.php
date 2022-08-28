<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $table = 'pets_table';
    
    use HasFactory;
    
    public function users(){
        return $this->belongTo('app\User');
    }
}
