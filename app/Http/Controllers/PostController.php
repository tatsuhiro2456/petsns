<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Content;
use App\Follow;
use App\Http\Requests\PostRequest;
use App\Http\Requests\CommentRequest;
use App\Like;
use App\Post;
use App\User;
use Cloudinary;

class PostController extends Controller
{
    public function index(Post $post)
    {
        return view('home/index')->with(['posts' => $post->getorderBy()]);
    }
    
    public function follow(Follow $follow)
    {
        $user=auth()->user();
        #$userがフォローしている人のidを取得
        $follows = Follow::where('following_id', $user->id)->get('followed_id');
        
        #フォローしている人のidデータのみを$follows_idに格納
        $follows_id = [];
        foreach($follows as $follow){
            $followed_id = $follow->followed_id;
            array_push($follows_id, $followed_id);
        }
        
        #Postデータ内でフォローしている人のみのデータを取得
        $posts = Post::whereIn('user_id', $follows_id)->orderBy('updated_at', 'desc')->get();
        
        return view('/home/follow')->with(['posts' => $posts])->with(['user' => $user]);
    }
    
    #投稿を作成する
    public function create(Content $content, User $user)
    {
        $user=auth()->user();
        return view('home/create')->with(['contents' => $content->get()])->with(['user' => $user]);
    }

    public function imgstore(PostRequest $request)
    {
        #ファイルのmimetypeを判別し、画像と動画の処理を分ける
        $mimetype = $request->file('image_path')->getMimeType();
        $post = new Post();
        $post->user_id = auth()->id();
        $post->mimetype = $mimetype;
        if($mimetype == 'video/mp4' or $mimetype =='video/mov'){
            $post->image_path = Cloudinary::uploadVideo($request->file('image_path')->getRealPath(), [
                "width" => 500,
                "crop" => "fit"
            ])->getSecurePath();
            $post->public_id = Cloudinary::getPublicId();
            $input_contents = $request->contents_array;
            $input_pets = $request->pets_array;
            $post->body = $request->post['body'];
            $post->save();
            $post->contents()->attach($input_contents);
            $post->pets()->attach($input_pets);
            
            return redirect('/');
        }elseif($mimetype == 'image/jpeg' or $mimetype =='image/png'){
            $post->image_path = Cloudinary::upload($request->file('image_path')->getRealPath(), [
                "width" => 500,
                "crop" => "fit"
            ])->getSecurePath();
            $post->public_id = Cloudinary::getPublicId();
            $input_contents = $request->contents_array;
            $input_pets = $request->pets_array;
            $post->body = $request->post['body'];
            $post->save();
            $post->contents()->attach($input_contents);
            $post->pets()->attach($input_pets);
            
            return redirect('/');
        }
    }
    
    public function destroy($id)
    {
        $post = Post::find($id);
        $comment = Comment::where('post_id', $post->id);
        if(isset($post->public_id)){
            Cloudinary::uploadApi()->Destroy($post->public_id);
        }
        $post->delete();
        $comment->delete();
        return redirect('/mypage');
    }
    
    public function comment(Post $post)
    {
        return view('home/comment')->with(['post' => $post]);
    }
    
    public function comment_post(CommentRequest $request)
    {
        $comment = new Comment();
        $comment->user_id = auth()->id();
        $comment->body = $request->comment['body'];
        $comment->post_id =$request->comment['post_id'];
        $comment->save();
        
        return redirect('/');
    }
    
    public function comment_destroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        
        return redirect('/');
    }
    
}
