@extends('layouts.timeline')
@section('header')
    <header class="masthead" style="background-image: url('/assets/img/timeline.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>DoggieCat</h1>
                        <span class="subheading">タイムライン</span></br>
                        <?php
                            $url = $_SERVER['REQUEST_URI'];
                          if(strstr($url,'/contents/1')==true):
                        ?>
                        <p class="text-primary" style="display:inline;"><strong>＃可愛い &emsp;</strong></p>
                        <a class="link-light" href="/contents/2"><strong>＃面白い &emsp;</strong></a>
                        <a class="link-light" href="/contents/3"><strong>＃ペット自慢 &emsp;</strong></a>
                        <a class="link-light" href="/follow/index"><strong>フォローユーザー</strong></a><br><br><br>
                        <?php elseif(strstr($url,'/contents/2')==true):?>
                        <a class="link-light" href="/contents/1" ><strong>＃可愛い &emsp;</strong></a>
                        <p class="text-primary" style="display:inline;"><strong>＃面白い &emsp;</strong></p>
                        <a class="link-light" href="/contents/3"><strong>＃ペット自慢 &emsp;</strong></a>
                        <a class="link-light" href="/follow/index"><strong>フォローユーザー</strong></a><br><br><br>
                        <?php else:?>
                        <a class="link-light" href="/contents/1" ><strong>＃可愛い &emsp;</strong></a>
                        <a class="link-light" href="/contents/2"><strong>＃面白い &emsp;</strong></a>
                        <p class="text-primary" style="display:inline;"><strong>＃ペット自慢 &emsp;</strong></p>
                        <a class="link-light" href="/follow/index"><strong>フォローユーザー</strong></a><br><br><br>
                        <?php endif; ?>
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
                    <div class="post_container">
                        <div class='image'>
                            @if($post->mimetype == 'video/mp4' or $post->mimetype == 'video/mov')
                                <video src="{{$post->image_path}}" loop autoplay muted controls></video>
                            @else
                                <img src="{{$post->image_path}}" alt="画像無し">
                            @endif
                            @foreach($post->pets as $pet)
                                <h6><font color="black">pet in the picture : </font><font color = "#264B70">{{$pet->name}}</font></h6>
                            @endforeach
                        </div>
                        <div class='right'>
                            <h2 class='body'>{{ $post->body}}</h2>
                            <h6 ><font color="black">{{ $post->created_at}}</font></h4>
                            <h6 class='content'>
                            @foreach($post->contents as $content)
                                <a href="/contents/{{ $content->id }}">＃{{ $content->type }}</a>
                            @endforeach
                            </h6>
                            <p class="user"><font color="black">ユーザー : </font><a href="/userpage/{{ $post->user_id}}">{{ $post->user->name }}</a></p>
                            
                            <div class="btn_container">
                                <div class="like">
                                    @if($post->is_like())
                                        <a href="{{ route('post_unlike', ['id' => $post->id]) }}" class="btn btn-danger btn-sm">いいね<span class="badge">{{ $post->likes->count() }}</span></a>
                                     @else
                                        <a href="{{ route('post_like', ['id' => $post->id]) }}" class="btn btn-outline-danger btn-sm">いいね<span class="badge">{{ $post->likes->count() }}</span></a>
                                    @endif
                                </div>
                                <div class="comment_btn"><a href='/posts/{{$post->id}}/comment' type="button" class="btn btn-primary btn-sm">コメント</a></div> 
                            </div>
                            <div class='comment'>
                                ＜コメント＞<br>
                                @foreach($post->comments as $comment)
                                    ユーザー : <a href="/userpage/{{$comment->user_id}}">{{$comment->user->name}}</a><br>
                                    {{$comment->body}}<br>
                                    @if($comment->user->id == auth()->user()->id)
                                        <form action='/posts/comment/{{$comment->id}}' id="form_{{ $comment->id }}" method="post" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <h5><button type="submit" class="btn btn-warning btn-sm" onclick="return deletePost(this);">コメント削除</button></h5> 
                                        </form>
                                    @endif
                                    <hr width="400">
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <hr width="100%">
            @endforeach
        </div>
@endsection