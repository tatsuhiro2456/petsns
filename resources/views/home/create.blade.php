@extends('layouts.app')　　　　　　　　　　　　　　　　　　

@section('content')
<body>
    <a>{{Auth::user()->name}}</a>
    <h1>投稿</h1>
    <form action="/posts" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="body">
            <textarea name="post[body]" placeholder="内容">{{ old('post.body') }}</textarea>
            <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
        </div>
        <div class="image_path">
            メディア：<input type="file" name="image_path"></input>
            <p class="file__error" style="color:red">{{ $errors->first('image_path') }}</p>
        </div>
        <div class='pet_exists'>
            ペットは写っていますか？(写っていたらチェック)</br>
            @foreach ($user->pets as $pet)
                <label>
                    <input type="checkbox"  value="{{$pet->id}}" name="pets_array[]">
                        {{$pet->name}}
                    </input>
                </label>
            @endforeach
        </div></br>    
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