<?php

namespace App\Http\Controllers;

use App\Content;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Post $post)
    {
        return view('home/index')->with(['posts' => $post->getorderBy()]);
    }
    
    public function create(Content $content)
    {
        return view('home/create')->with(['contents' => $content->get()]);
    }
    
    public function store(Request $request, Post $post)
    {
        $input_post = $request['post'];
        $input_post += ['user_id' => $request->user()->id]; 
        $input_contents = $request->contents_array;
        
        $post->fill($input_post)->save();
        $post->contents()->attach($input_contents); 
        return redirect('/');
    }
    
    public function map()
    {
        return view('home/cafeserch');
    }

}
