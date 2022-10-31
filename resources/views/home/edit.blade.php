@extends('layouts.timeline')　　　　　　　　　　　　　　　　　　

@section('content')
    <div class="register">
        <div class="register_center">
            <h1>登録情報変更</h1>
            <font color="white">変更前</font>
            <p>名前：{{Auth::user()->name}}</p>
            <p>誕生日：{{Auth::user()->birthday}}</p>
                @if(Auth::user()->image)
                    <p>ユーザー画像：<img src="{{Auth::user()->image}}" alt="画像無し"></p>
                @else
                    <p>ユーザー画像：<img src="https://res.cloudinary.com/dgrrdt1vv/image/upload/v1667129479/iweftskvwuu51umwt3mt.jpg" alt="画像無し"></p>
                @endif
            
            <font color="white">変更後</font><br>
            <form method="POST" action="{{route('user.update')}}" enctype="multipart/form-data">
                @csrf
                名前：<input  type='text' class='user[name]' name='name' value='{{Auth::user()->name}}'/><br><br>
                メール：<input  type='email' class='user[email]' name='email' value='{{Auth::user()->email}}'/><br><br>
                誕生日：<input  type="date" class='user[bday]' name='birthday' value="{{Auth::user()->birthday}}" required autocomplete="bday" autofocus/><br><br>
                ユーザー画像：<input type="file" class='user[image] 'name="image"/><br><br>
                <button class="btn btn-success btn-sm">更新する</button>
            </form>
        </div>
    </div>
@endsection('content')