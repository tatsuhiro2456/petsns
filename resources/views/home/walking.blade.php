@extends('layouts.timeline')
@section('header')
    <header class="masthead" style="background-image: url('/assets/img/walking.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>DoggieCat</h1>
                        <span class="subheading">犬散歩掲示板</span></br><br>
                        <a class="btn btn-outline-light " href='/walking/recruitment' role="button">投稿</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <div class='recruitments'>
        @foreach ($recruitments as $recruitment)
            <div class='recruitment'>
                <div class="recruitment_container">
                    <div class="body">
                        <font color="white">
                            <h2 class='title'>{{ $recruitment->title}}</h2>
                            <h3 class='body'>{{ $recruitment->body}}</h3>
                        </font>
                        <h6><a href="/userpage/{{ $recruitment->user_id}}">{{$recruitment->user->name }}</a></h6>
                        <h6>{{ $recruitment->created_at }}</h6>
                        @if( $recruitment->user_id == auth()->user()->id )
                        <form action='/walking/recruitment/{{$recruitment->id}}' id="form_{{ $recruitment->id }}" method="post" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-warning btn-sm" onclick="return deletePost(this);">投稿削除</button> 
                        </form>
                        @endif
                        <a href='/walking/{{$recruitment->id}}/reply' class="btn btn-primary btn-sm">返信</a>
                    </div>
                    
                <div class='reply'>
                    <font color="black">[返信一覧]</font>
                    <hr width="400">
                    @foreach($recruitment->replies as $reply)
                        {{$reply->body}}<br>
                        <font size="3">ユーザー：<a href="/userpage/{{$reply->user->id}}">{{$reply->user->name}}</a></font><br>
                        @if($reply->user->id == auth()->user()->id)
                            <form action='/walking/reply/{{$reply->id}}' id="form_{{ $reply->id }}" method="post" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-warning btn-sm" onclick="deletePost(this);return false;">返信削除</button>
                            </form>
                        @endif
                        <hr width="400">
                    @endforeach
                </div>
            </div>
        </div>
        <hr width="100%">
        @endforeach
    </div>
@endsection