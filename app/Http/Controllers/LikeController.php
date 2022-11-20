<?php

namespace App\Http\Controllers;

use App\Like;
use App\Post;
use App\Pet;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like(Request $request, Post $post){
        if(empty($post::find($request->id)->pets->first())){
            $like = Like::create([
                'user_id' => \Auth::user()->id,
                'post_id' => $request->id,
            ]);
        }else{
            $pet_id = $post::find($request->id)->pets->first();
            $like = Like::create([
                'user_id' => \Auth::user()->id,
                'post_id' => $request->id,
                'pet_id' => $pet_id->id,
            ]);}
        
        return redirect()->back();
    }
    
    public function unlike(Request $request, Post $post){
        if(empty($post::find($request->id)->pets->first())){
            $like = Like::where('post_id', $request->id)->where('user_id', \Auth::user()->id)->first();
        }else{
            $pet_id = $post::find($request->id)->pets->first()->id;
            $like = Like::where('post_id', $request->id)->where('user_id', \Auth::user()->id)->where('pet_id', $pet_id)->first();
        }
        $like->delete();
        
        return redirect()->back();
    }
    
    public function ranking(Pet $pet, Like $like)
    {
        #月間のデータを取得するために今月の月初めと月末を定義
        $today_month = Carbon::now()->format('m');
        $today = Carbon::now()->format('Y-m');
        $start = $today.'-01 00:00:00';
        
        if($today_month == 4 or $today_month == 6 or $today_month == 9 or $today_month == 11){
            $end = $today.'-30 23:59:59';
        }elseif($today_month == 2){
            $end = $today.'-28 23:59:59';
        }else{
            $end = $today.'-31 23:59:59';
        }
        #今月、ペットが写っている投稿にいいねしてくれたデータを取得
        $likes = $like::where('created_at', '>',$start)->where('created_at', '<', $end)->get();
        
        #ペットデータを取得
        $dogs = Pet::where('type', '=', 'dog')->get();
        $cats = Pet::where('type', '=', 'cat')->get();
        
        $dog_likes = [];
        $cat_likes = [];
        
        
        #犬
        #pet_likesにペットデータといいね合計数を格納
        foreach($dogs as $dog){
        foreach($likes as $like){
            $array = ['dog_name' => $dog->name, 'total_like' => $like->where('pet_id',$dog->id)->count(), 'dog_image' => $dog->image, 'user_id' => $dog->user_id, 'user' => User::find($dog->user_id)->name];
        }
            if(isset($array)){
            array_push($dog_likes, $array);
            }
        }
        #ペットのいいね数（'total_like'）の値を取得
        foreach($dog_likes as $data => $value){
            $dog_sort[$data] = $value["total_like"];
        }
        if(!empty($dog_likes)){
        #取り出した'total_like'で数が多い順番に$pet_likesを並び替え
        $sorted_array_dog = array_multisort($dog_sort, SORT_DESC, $dog_likes);
        }
        
        #猫
        foreach($cats as $cat){
        foreach($likes as $like){
            $array = ['cat_name' => $cat->name, 'total_like' => $like->where('pet_id',$cat->id)->count(), 'cat_image' => $cat->image, 'user_id' => $cat->user_id, 'user' => User::find($cat->user_id)->name];
        }
            if(isset($array)){
            array_push($cat_likes, $array);
            }
        }
        #ペットのいいね数（'total_like'）の値を取得
        foreach($cat_likes as $data => $value){
            $cat_sort[$data] = $value["total_like"];
        }
        if(!empty($cat_likes)){
        #取り出した'total_like'で数が多い順番に$pet_likesを並び替え
        $sorted_array_cat = array_multisort($cat_sort, SORT_DESC, $cat_likes);
        }
        return view('home/ranking')->with(['dog_likes' => $dog_likes])->with(['cat_likes' => $cat_likes]);
    }
}
