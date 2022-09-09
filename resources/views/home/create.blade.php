@extends('layouts.app')　　　　　　　　　　　　　　　　　　

@section('content')
<body>
    <a>{{Auth::user()->name}}</a>
    <h1>投稿</h1>
    <form action="/posts" method="POST">
        @csrf
        <div class="body">
            <textarea name="post[body]" placeholder="内容"></textarea>
        </div>
        <!--
        <div class="image_path">
            <textarea name="post[image_path]" placeholder="画像"></textarea>
        </div>
        -->
        <div class='content'>
            <h2>コンテンツ</h2>
            @foreach( $contents as $content)
                <label>
                    <input type="checkbox" value="{{ $content->id }}" name="contents_array[]">
                        {{$content->type}}
                    </input>
                </label>
            @endforeach
        </div>
        <input type="submit" value="投稿"/>
    </form>
    <div class="back">[<a href="/">[戻る]</a>]</div>
</body>
@endsection