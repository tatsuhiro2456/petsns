<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;

class LikeController extends Controller
{
    public function like(Request $request){
        $like = Like::create([
            'user_id' => \Auth::user()->id,
            'post_id' => $request->id,
        ]);
        
        return redirect()->back();
    }
    
    public function unlike(Request $request){
        $like = Like::where('post_id', $request->id)->where('user_id', \Auth::user()->id)->first();
        $like->delete();
        
        return redirect()->back();
    }
}
