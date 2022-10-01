<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Follow;

class FollowController extends Controller
{
    public function follow(User $user) {
        $follow = Follow::create([
            'following_id' => \Auth::user()->id,
            'followed_id' => $user->id,
        ]);
        return redirect('/userpage/'.$user->id);
    }

    public function unfollow(User $user) {
        $follow = Follow::where('following_id', \Auth::user()->id)->where('followed_id', $user->id)->first();
        $follow->delete();
        return redirect('/userpage/'.$user->id);
    }
}