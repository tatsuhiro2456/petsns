<?php

namespace App\Http\Controllers;

use App\Content;
use App\Post;
use Illuminate\Http\Request;
use Cloudinary;

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
    
    /*public function store(Request $request, Post $post)
    {
        $input_post = $request['post'];
        $input_post += ['user_id' => $request->user()->id]; 
        $input_contents = $request->contents_array;
        
        $post->fill($input_post)->save();
        $post->contents()->attach($input_contents); 
        return redirect('/');
    }
    */
    
    public function imgstore(Request $request)
    {
        #ファイルのmimetypeを判別し、画像と動画の処理を分ける
        $mimetype = $request->file('image_path')->getMimeType();
        $post = new Post();
        $post->user_id = auth()->id();
        $post->mimetype = $mimetype;
        if($mimetype == 'video/mp4'){
            $post->image_path = Cloudinary::uploadVideo($request->file('image_path')->getRealPath())->getSecurePath();
            $post->public_id = Cloudinary::getPublicId();
            $input_contents = $request->contents_array;
            $post->body = $request->post['body'];
            $post->save();
            $post->contents()->attach($input_contents);
            return redirect('/');
        }elseif($mimetype == 'image/jpeg' or 'image/png'){
            $post->image_path = Cloudinary::upload($request->file('image_path')->getRealPath())->getSecurePath();
            $post->public_id = Cloudinary::getPublicId();
            $input_contents = $request->contents_array;
            $post->body = $request->post['body'];
            $post->save();
            $post->contents()->attach($input_contents);
            return redirect('/');
        }
    }
    
    
    public function destroy($id)
    {
        $post = Post::find($id);
        if(isset($post->public_id)){
            Cloudinary::uploadApi()->Destroy($post->public_id);
        }
        $post->delete();
        return redirect('/mypage');
    }
    
}
