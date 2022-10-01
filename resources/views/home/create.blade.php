@extends('layouts.app')　　　　　　　　　　　　　　　　　　

@section('content')
<body>
    <a>{{Auth::user()->name}}</a>
    <h1>投稿</h1>
    <form action="/posts" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="body">
            <textarea name="post[body]" placeholder="内容"></textarea>
        </div>
        <div class="image_path">
            写真：<input type="file" name="image_path">
        </div>
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