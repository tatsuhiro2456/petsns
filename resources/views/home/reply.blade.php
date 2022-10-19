@extends('layouts.app')　　　　　　　　　　　　　　　　　　

@section('content')
<body>
    <div class='recruitment'>
        <h3 class='title'>タイトル：{{ $recruitment->title}}</h3>
        <h3 class='body'>本文：{{ $recruitment->body}}</h3>
        <h4>{{$recruitment->user->name }}</h4>
        <h4>[{{ $recruitment->created_at }}]</h4>
    </div>

    <a>{{Auth::user()->name}}</a>
    <h1>コメント</h1>
    <form action='/walking/{{$recruitment->id}}/reply' method="POST" >
        @csrf
        <div class="body">
            <textarea name="reply[body]" placeholder="内容"></textarea>
        </div>
        <input value="{{ $recruitment->id }}" type="hidden" name="reply[recruitment_id]" />
        <input type="submit" value="返信"/>
    </form>
    <div class="back">[<a href="/">[戻る]</a>]</div>
</body>
@endsection