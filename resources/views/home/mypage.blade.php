@extends('layouts.timeline')
@section('header')
    <header class="masthead" style="background-image: url('/assets/img/mypage.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>DoggieCat</h1>
                        <span class="subheading">マイページ</span></br>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <div class="text-center">
        <div class="user">
            <h3>ユーザー</h3>
            <p>名前：{{Auth::user()->name}}</p>
            <p>誕生日：{{Auth::user()->birthday}}</p>
            
            @if(Auth::user()->image)
                <p>ユーザー画像： <img src="{{Auth::user()->image}}" alt="画像無し"></p>
            @else
                <p>ユーザー画像： <img src="https://res.cloudinary.com/dgrrdt1vv/image/upload/v1666174531/ekvllbakoiwm2zwtbfuu.jpg" alt="画像無し"></p>
            @endif
            フォロー{{Auth::user()->following->count()}}
            フォロワー{{Auth::user()->followed->count()}}</a>
        </div>
        
        <div class="pet">
            <h3>ペット紹介</h3>
            @if($pet)
                <p>ペットの種類：{{$pet->type}}</p>
                <p>ペットの名前：{{$pet->name}}</p>
                @if($pet->image)
                    <p>ペット画像：<img src="{{$pet->image}}" alt="画像無し"></p>
                @else
                    <p>ペット画像： <img src=https://res.cloudinary.com/dgrrdt1vv/image/upload/v1666451908/ct10cffq1huqyrlol83z_bng5pr.jpg alt="画像無し"></p>
                @endif
            @else
                <p>飼育無し</p>
            @endif
        </div>
        <div><a href='/mypage/edit'>ユーザー登録情報変更</a></div>
        <div><a href='/mypage/edit/pet'>ペット登録情報変更</a></div>
        
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
    </div>
@endsection