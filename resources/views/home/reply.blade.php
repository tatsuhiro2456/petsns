@extends('layouts.timeline')　　　　　　　　　　　　　　　　　　

@section('content')
<body class="create">
    <div class="create_body">
    <div class='recruitment'>
        投稿元
        <h2 class='title'>{{ $recruitment->title}}</h2>
        <h3 class='body'>{{ $recruitment->body}}</h3>
        ユーザー：{{$recruitment->user->name }}<br>
        {{ $recruitment->created_at }}
    </div><br>

    <h2>コメント</h2>
    <form action='/walking/{{$recruitment->id}}/reply' method="POST" >
        @csrf
        <div class="body">
            <textarea name="reply[body]" placeholder="内容"></textarea>
        </div>
        <p class="body__error" style="color:yellow">{{ $errors->first('reply.body') }}</p>
        <input value="{{ $recruitment->id }}" type="hidden" name="reply[recruitment_id]" />
        <input type="submit" class="btn btn-light btn-sm" value="返信"/>
    </form>
<a class="btn btn-outline-dark btn-sm" href="/">戻る</a>
    </div>
</body>
@endsection