@extends('layouts.timeline')　　　　　　　　　　　　　　　　　　

@section('content')
<body class="create">
    <div class="create_body">
        <h2>投稿</h2>
        <form action="/walking/recruitment" method="POST">
            @csrf
            <div class="title">
                <input type='text' name="recruitment[title]" placeholder="タイトル" value="{{ old('recruitment.title') }}"></input>
                <p class="title__error" style="color:yellow">{{ $errors->first('recruitment.title') }}</p>
            </div>
            <div class="body">
                <textarea name="recruitment[body]" placeholder="内容" value="{{ old('recruitment.body') }}"></textarea>
                <p class="body__error" style="color:yellow">{{ $errors->first('recruitment.body') }}</p>
            </div>
            <input type="submit" class="btn btn-light btn-sm" value="投稿"/>
        </form>
        <a href="/" class="btn btn-outline-dark btn-sm">戻る</a>
    </div>
</body>
<hr width="200%">
@endsection