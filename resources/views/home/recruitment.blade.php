@extends('layouts.app')　　　　　　　　　　　　　　　　　　

@section('content')
<body>
    <a>{{Auth::user()->name}}</a>
    <h1>投稿</h1>
    <form action="/walking/recruitment" method="POST">
        @csrf
        <div class="title">
            <input type='text' name="recruitment[title]" placeholder="タイトル">{{ old('post.title') }}</input>
        </div>
        <div class="body">
            <textarea name="recruitment[body]" placeholder="内容">{{ old('post.body') }}</textarea>
        </div>
        <input type="submit" value="投稿"/>
    </form>
    <div class="back">[<a href="/walking">[戻る]</a>]</div>
</body>
@endsection