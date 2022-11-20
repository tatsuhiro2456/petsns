<?php

namespace App\Http\Controllers;

use App\User;
use App\Pet;
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
            $pet = Pet::where('user_id',$id)->first();
            $posts = Post::where("user_id", "$user->id")->orderBy('updated_at', 'DESC')->get();
            return view('home/mypage')->with(['pet' => $pet])->with(["posts" => $posts]);
        }else{
            $pet = Pet::where('user_id',$id)->first();
            $posts = Post::where("user_id", "$user->id")->orderBy('updated_at', 'DESC')->get();
            
            return view('users.userpage')->with(['user' => $user])->with(['pet' => $pet])->with(['posts' => $posts]);
            }
    }
    
    public function mypage()
    {
        $id = auth()->id();
        $pet = Pet::where('user_id',$id)->first();
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
        
        #$requestにimageがあるなら画像をアップロードする
        if($request->file('image')){
            $mimetype = $request->file('image')->getMimeType();
            
            #すでに画像が存在しているなら消去する
            if($mimetype == 'image/jpeg' or $mimetype =='image/png'){
                if($user->public_id){
                    Cloudinary::uploadApi()->Destroy($user->public_id);
                }
                
            $user->image = Cloudinary::upload($request->file('image')->getRealPath(), [
                "height" => 60,
                "width" => 60,
                'transformation'=>['width'=>100,'radius'=>'max', 'border'=>'3px_solid_black']
            ])->getSecurePath();
            $user->public_id = Cloudinary::getPublicId();
        }}
        $user->save();
        return redirect('/mypage');
    }
    
    public function test()
    {
        return view('test');
    }
}
