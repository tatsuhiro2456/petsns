@extends('layouts.app')　　　　　　　　　　　　　　　　　　

@section('content')
    <h3><a href='/mypage'>・マイページ</a></h3>
    <h3><a href='/ranking'>・ペットランキング</a></h3>
    <h3><a href='/walking'>・散歩募集</h3>
    <h3><a href='/cafeserch'>・犬・猫カフェ検索</a></h3>
    <h1><a href='/'>タイムライン</a></h1>
    
    <h1>マイページ</h1>
    <div class="user">
        <h3>ユーザー</h3>
        <p>名前：{{Auth::user()->name}}</p>
        <p>誕生日：{{Auth::user()->birthday}}</p>
        <p>ユーザー画像： <img src="{{Auth::user()->image}}" alt="画像無し"></p>
    </div>
    
    <div class="pet">
        <h3>ペット紹介</h3>
        @if($pet)
            <p>ペットの種類：{{$pet->type}}</p>
            <p>ペットの名前：{{$pet->name}}</p>
            <p>ペット画像：{{$pet->image}}</p>
        @else
            <p>飼育無し</p>
        @endif
    </div>
    <div><a href='/mypage/edit'>登録情報変更</a></div>
    
    <div class="posts">
    @foreach ($posts as $post)
        <div class='post'>
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
            <div class='comment'>
                @foreach($post->comments as $comment)
                    コメントユーザー：{{$comment->user->name}}
                    <br>コメント内容：{{$comment->body}}
                @endforeach
            </div>
            <h5>[<a href='/posts/{{$post->id}}/comment'>コメント</a>]</h5> 
            <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post" style="display:inline">
                @csrf
                @method('DELETE')
                <h5><button type="submit">削除</button></h5> 
            </form>
        </div>
        @endforeach
    </div>

@endsection