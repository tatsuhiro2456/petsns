@extends('layouts.timeline')
@section('header')
    <header class="masthead" style="background-image: url('/assets/img/walking.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>DoggieCat</h1>
                        <span class="subheading">犬散歩掲示板</span></br>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <div class="text-center">
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
    </div>
@endsection