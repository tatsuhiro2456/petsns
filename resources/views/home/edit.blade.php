@extends('layouts.app')　　　　　　　　　　　　　　　　　　

@section('content')
    <h3><a href='/mypage'>・マイページ</a></h3>
    <h3>・ペットランキング</h3>
    <h3>・散歩募集</h3>
    <h3><a href='/cafeserch'>・犬・猫カフェ検索</a></h3>
    <h1><a href='/'>タイムライン</a></h1>
    
    <h1>登録情報変更</h1>
    <div class="user">
        <h3>ユーザー</h3>
        <p>名前：{{Auth::user()->name}}</p>
        <p>誕生日：{{Auth::user()->birthday}}</p>
        <p>ユーザー画像：{{Auth::user()->image}}</p>
    </div>
    <form method="POST" action="{{route('user.update')}}" enctype="multipart/form-data">
        @csrf
        <input  type='text' class='user[name]' name='name' value='{{Auth::user()->name}}'/><br>
        <input  type='email' class='user[email]' name='email' value='{{Auth::user()->email}}'/><br>
        <input  type="date" class='user[bday]' name='birthday' value="：{{Auth::user()->birthday}}" required autocomplete="bday" autofocus/><br>
        <input type="file" class='user[image] 'name="image"/>
        <button>更新する</button>
    </form>
@endsection('content')