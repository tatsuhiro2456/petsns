@extends('layouts.app')　　　　　　　　　　　　　　　　　　

@section('content')

    <h3><a href='/mypage'>・マイページ</a></h3>
    <h3><a href='/ranking'>・ペットランキング</a></h3>
    <h3><a href='/walking'>・散歩募集</h3>
    <h3><a href='/cafeserch'>・犬・猫カフェ検索</a></h3>
    <h1><a href='/'>タイムライン</a></h1>
    <h2><a href="/contents/1">＃可愛い</a><h2>
    <h2><a href="/contents/2">＃面白い</a><h2>
    <h2><a href="/contents/3">＃ペット自慢</a><h2>
    <div>[<a href='/posts/create'>投稿</a>]</div>
    <div class='posts'>
        @foreach ($posts as $post)
            <div class='post'>
                <h3 class='image'>メディア:</h3>
                    @if($post->mimetype == 'video/mp4' or $post->mimetype == 'video/mov')
                        <video src="{{$post->image_path}}" loop autoplay muted controls></video>
                    @else
                        <img src="{{$post->image_path}}" alt="画像無し">
                    @endif
                <h3 class='body'>本文：{{ $post->body}}</h3>
                <h4><a href="/userpage/{{ $post->user_id}}">User:[{{ $post->user->name }}]</a></h4>
                <h4>[{{ $post->created_at }}]</h4>
            </div>
            <h6 class='content'>
                @foreach($post->contents as $content)
                    <a href="/contents/{{ $content->id }}">＃{{ $content->type }}</a>
                @endforeach
            </h6>
            <div class="like">
                @if($post->is_like())
                    <a href="{{ route('post_unlike', ['id' => $post->id]) }}" class="btn btn-success btn-sm">いいね<span class="badge">{{ $post->likes->count() }}</span></a>
                 @else
                    <a href="{{ route('post_like', ['id' => $post->id]) }}" class="btn btn-secondary btn-sm">いいね<span class="badge">{{ $post->likes->count() }}</span></a>
                 @endif
            </div>
        @endforeach
    </div>

@endsection