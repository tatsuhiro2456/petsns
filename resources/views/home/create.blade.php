@extends('layouts.app')　　　　　　　　　　　　　　　　　　

@section('content')
<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>post</title>
    </head>
    <body>
        <a>{{Auth::user()->name}}</a>
        <h1>投稿</h1>
        <form action="/posts" method="POST">
            @csrf
            <div class="body">
                <textarea name="post[body]" placeholder="内容"></textarea>
            </div>
            <!--
            <div class="image_path">
                <textarea name="post[image_path]" placeholder="画像"></textarea>
            </div>
            -->
            <input type="submit" value="投稿"/>
        </form>
        <div class="back">[<a href="/">[戻る]</a>]</div>
    </body>
</html>
@endsection