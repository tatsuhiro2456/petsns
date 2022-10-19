<?php

namespace App\Http\Controllers;

use App\Pet;
use App\User;
use App\Post;
use Cloudinary;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function userpage($id)
    {
        $user = User::find($id);
        
        //投稿のuserのidがログインユーザーのidと一致していればマイページを、それ以外ならユーザーページを返す
        if($user->id == auth()->id()){
            $pet = Pet::find($user->id);
            $posts = Post::where("user_id", "$user->id")->orderBy('updated_at', 'DESC')->get();
            return view('home/mypage')->with(['pet' => $pet])->with(["posts" => $posts]);
        }else{
            $pet = Pet::find($user->id);
            $posts = Post::where("user_id", "$user->id")->orderBy('updated_at', 'DESC')->get();
            
            return view('users.userpage')->with(['user' => $user])->with(['pet' => $pet])->with(['posts' => $posts]);
            }
    }
    
    public function mypage()
    {
        $id = auth()->id();
        $pet = Pet::find($id);
        $posts = Post::where("user_id", "$id")->orderBy('updated_at', 'DESC')->get();
        return view('home/mypage')->with(['pet' => $pet])->with(["posts" => $posts]);
    }
    
    public function edit()
    {
        $id = auth()->id();
        return view('home/edit');
    }
    
    public function update(Request $request)
    {
        $user = User::find( auth()->id());
        $user->name = $request->name;
        $user->email = $request->email;
        $user->birthday = $request->birthday;
        $mimetype = $request->file('image')->getMimeType();
        
        if($mimetype == 'image/jpeg' or $mimetype =='image/png'){
            $user->image = Cloudinary::upload($request->file('image')->getRealPath(), [
                "height" => 100,
                "width" => 100,
                "crop" => "fit"
            ])->getSecurePath();
            $user->public_id = Cloudinary::getPublicId();
        }
        $user->save();
        return redirect('/mypage');
    }
}
