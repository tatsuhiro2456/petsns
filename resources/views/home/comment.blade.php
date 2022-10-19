@extends('layouts.app')　　　　　　　　　　　　　　　　　　

@section('content')
<body>
    <div class='post'>
        <h3 class='image'>メディア:</h3>
            @if($post->mimetype == 'video/mp4' or $post->mimetype == 'video/mov')
                <video src="{{$post->image_path}}" loop autoplay muted controls></video>
            @else
                <img src="{{$post->image_path}}" alt="画像無し">
            @endif
        <h3 class='body'>本文：{{ $post->body}}</h3>
        <h4>User:[{{ $post->user->name }}]</h4>
        <h4>[{{ $post->created_at }}]</h4>
    </div>

    <a>{{Auth::user()->name}}</a>
    <h1>コメント</h1>
    <form action='/posts/{post}/comment' method="POST" enctype="multipart/form-data">
        @csrf
        <div class="body">
            <textarea name="comment[body]" placeholder="内容"></textarea>
        </div>
        <p class="body__error" style="color:red">{{ $errors->first('comment.body') }}</p>
        <input value="{{ $post->id }}" type="hidden" name="comment[post_id]" />
        <input type="submit" value="コメント"/>
    </form>
    <div class="back">[<a href="/">[戻る]</a>]</div>
</body>
@endsection