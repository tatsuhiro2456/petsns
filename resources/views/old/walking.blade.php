@extends('layouts.app')　　　　　　　　　　　　　　　　　　

@section('content')

    <h3><a href='/mypage'>・マイページ</a></h3>
    <h3><a href='/ranking'>・ペットランキング</a></h3>
    <h3><a href='/walking'>・散歩募集</h3>
    <h3><a href='/cafeserch'>・犬・猫カフェ検索</a></h3>
    <h1><a href='/'>タイムライン</a></h1>
    
    <div>[<a href='/walking/recruitment'>投稿</a>]</div>
    <div class='recruitments'>
        @foreach ($recruitments as $recruitment)
            <div class='recruitment'>
                <h3 class='title'>タイトル：{{ $recruitment->title}}</h3>
                <h3 class='body'>本文：{{ $recruitment->body}}</h3>
                <h4><a href="/userpage/{{ $recruitment->user_id}}">{{$recruitment->user->name }}</a></h4>
                <h4>[{{ $recruitment->created_at }}]</h4>
                <h5>[<a href='/walking/{{$recruitment->id}}/reply'>返信</a>]</h5> 
            </div>
             @if( $recruitment->user_id == auth()->user()->id )
                <form action='/walking/recruitment/{{$recruitment->id}}' id="form_{{ $recruitment->id }}" method="post" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <h5><button type="submit">投稿削除</button></h5> 
                </form>
            @endif
            <div class='reply'>
                @foreach($recruitment->replies as $reply)
                    返信ユーザー：{{$reply->user->name}}
                    <br>返信内容：{{$reply->body}}
                    @if($reply->user->id == auth()->user()->id)
                        <form action='/walking/reply/{{$reply->id}}' id="form_{{ $reply->id }}" method="post" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <h5><button type="submit">返信削除</button></h5> 
                        </form>
                    @endif
                @endforeach
            </div>
        @endforeach
    </div>
@endsection