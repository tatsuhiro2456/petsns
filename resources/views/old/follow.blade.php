@extends('layouts.master')　　　　　　　　　　　　　　　　　　
@section('header')
    <header class="masthead" style="background-image: url('/assets/img/timeline.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>DoggieCat</h1>
                        <span class="subheading">タイムライン</span></br>
                        <a class="link-light" href="/contents/1" ><strong>＃可愛い &emsp;</strong></a>
                        <a class="link-light" href="/contents/2"><strong>＃面白い &emsp;</strong></a>
                        <a class="link-light" href="/contents/3"><strong>＃ペット自慢 &emsp;</strong></a>
                        <p class="text-primary" style="display:inline;"><strong><strong>フォロー中のユーザー</strong></p><br><br><br>
                        <a class="btn btn-outline-light" href='/posts/create' role="button">投稿</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection


@section('content')
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