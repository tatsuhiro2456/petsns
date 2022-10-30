@extends('layouts.timeline')　　　　　　　　　　　　　　　　　　

@section('content')
<body class="create">
    <div class="create_body">
    <div class='post'>
        投稿元
        <div class='image'>
            @if($post->mimetype == 'video/mp4' or $post->mimetype == 'video/mov')
                <video src="{{$post->image_path}}" loop autoplay muted controls></video>
            @else
                <img src="{{$post->image_path}}" alt="画像無し">
            @endif
        </div>
        <h2 class='body'>{{ $post->body}}</h2>
        <p>ユーザー:{{ $post->user->name }}</p>
        <p>{{ $post->created_at }}</p>
    </div><br>

    <h3>コメント</h3>
    <form action='/posts/{post}/comment' method="POST" enctype="multipart/form-data">
        @csrf
        <div class="body">
            <textarea name="comment[body]" placeholder="内容" value="{{ old('comment.body') }}"></textarea>
        </div>
        <p class="body__error" style="color:yellow">{{ $errors->first('comment.body') }}</p>
        <input value="{{ $post->id }}" type="hidden" name="comment[post_id]" />
        <input type="submit" class="btn btn-light btn-sm" value="コメント"/>
    </form>
    <a href="/" class="btn btn-outline-dark btn-sm">戻る</a>
    </div>
</body>
@endsection