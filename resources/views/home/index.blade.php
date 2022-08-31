@extends('layouts.app')　　　　　　　　　　　　　　　　　　

@section('content')

<h1>DoggieCat</h1>
<h3>・マイページ</h3>
<h3>・ペットランキング</h3>
<h3>・散歩募集</h3>
<h3>・犬・猫カフェ検索</h3>
<h1>タイムライン</h1>
<h2>＃可愛い<h2>
<h2>＃面白い<h2>
<h2>＃自慢<h2>
<div>[<a href='/posts/create'>投稿</a>]</div>
<div class='posts'>
    @foreach ($posts as $post)
        <div class='post'>
            <h6>User:[{{ $post->user->name }}]</h6>
            <!--<h3 class='image'>{{ $post->image_path}}</h3>-->
            <p class='body'>{{ $post->body}}</p>
        </div>
    @endforeach
</div>

@endsection