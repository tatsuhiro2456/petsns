@extends('layouts.app')　　　　　　　　　　　　　　　　　　

@section('content')
    <h3><a href='/mypage'>・マイページ</a></h3>
    <h3>・ペットランキング</h3>
    <h3>・散歩募集</h3>
    <h3><a href='/cafeserch'>・犬・猫カフェ検索</a></h3>
    <h1><a href='/'>タイムライン</a></h1>


    <h1>ユーザーページ</h1>
    <div class='user'>
        <h3>ユーザー</h3>
        <p>名前：{{$user->name}}</p>
        <p>誕生日：{{$user->birthday}}</p>
        <p>ユーザー画像：{{$user->image}}</p>
    </div>
    <div class='pet'>
        <h3>ペット紹介</h3>
        <p>ペットの種類：{{$pet->type}}</p>
        <p>ペットの名前：{{$pet->name}}</p>
        <p>ペット画像：{{$pet->image}}</p>
    </div>
    
    <div class="follow">
        @if($user->is_follow())
            <a href='/userpage/{{$user->id}}/unfollow' class="btn btn-success btn-sm">フォロー解除</a>
        @else
            <a href='/userpage/{{$user->id}}/follow' class="btn btn-success btn-sm">フォロー</a>
        @endif
    </div>
    
    
    <div class='posts'>
        @foreach ($posts as $post)
            <div class='post'>
                <h3 class='image'>メディア:</h3>
                    @if($post->mimetype == 'video/mp4')
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
        @endforeach
    </div>

    
    <div class="back">[<a href="/">[戻る]</a>]</div>

    


@endsection