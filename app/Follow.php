<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use App\User;


class Follow extends Pivot
{
    protected $fillable = ['following_id', 'followed_id'];

    protected $table = 'follows';

}
