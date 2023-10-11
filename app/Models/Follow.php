<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;


class Follow extends Pivot
{
    protected $fillable = ['following_id', 'followed_id'];

    protected $table = 'follows';

}
