<?php

namespace App\Http\Controllers;

use App\Pet;
use App\User;
use Cloudinary;
use App\Http\Requests\PetRequest;
use Illuminate\Support\Facades\Auth;

class PetController extends Controller
{
    public function add()
    {
        return view('home/pet_register');
    }
    
    public function register(Pet $pet, PetRequest $request)
    {
        $input = $request['pet'];
        $input += ['user_id' => $request->user()->id]; 
        $pet->fill($input)->save();
        
        return redirect('/');
    }
    
    public function edit()
    {
        $id = auth()->id();
        $pet = Pet::where('user_id', $id)->first();
        return view('home/pet_edit')->with(['pet' => $pet]);
    }
    
    public function update(Pet $pet, PetRequest $request)
    {
        $user_id = auth()->id();
        #すでにauthがペット登録している場合
        if(Pet::find($user_id)){
            $pet = Pet::find($user_id);
            $pet->name = $request->pet['name'];
            $pet->type = $request->pet['type'];
            $pet->user_id = $user_id;
    
            #$requestにimageがあるなら画像をアップロードする
            if($request->file('image')){
                $mimetype = $request->file('image')->getMimeType();
                
                #すでに画像が存在しているなら消去する
                if($mimetype == 'image/jpeg' or $mimetype =='image/png'){
                    if($pet->public_id){
                        Cloudinary::uploadApi()->Destroy($pet->public_id);
                    }
                    
                $pet->image = Cloudinary::upload($request->file('image')->getRealPath(), [
                    "height" => 60,
                    "width" => 60,
                    'transformation'=>['width'=>100,'radius'=>'max', 'border'=>'3px_solid_black']
                ])->getSecurePath();
                $pet->public_id = Cloudinary::getPublicId();
            }}
            $pet->save();
            return redirect('/mypage');
        #ペット登録をしていない場合
        }else{
            $pet = new Pet;    
            $pet->name = $request->pet['name'];
            $pet->type = $request->pet['type'];
            $pet->user_id = $user_id;
            
            if($request->file('image')){
                $mimetype = $request->file('image')->getMimeType();
                
                #すでに画像が存在しているなら消去する
                if($mimetype == 'image/jpeg' or $mimetype =='image/png'){
                    if($pet->public_id){
                        Cloudinary::uploadApi()->Destroy($pet->public_id);
                    }
                    
                $pet->image = Cloudinary::upload($request->file('image')->getRealPath(), [
                    "height" => 60,
                    "width" => 60,
                    'transformation'=>['width'=>100,'radius'=>'max', 'border'=>'3px_solid_black']
                ])->getSecurePath();
                $pet->public_id = Cloudinary::getPublicId();
            }}
            $pet->save();
            return redirect('/mypage');
        }
    }
}
