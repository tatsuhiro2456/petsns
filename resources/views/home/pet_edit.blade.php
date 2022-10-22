@extends('layouts.app')



@section('content')
    <h3><a href='/mypage'>・マイページ</a></h3>
    <h3><a href='/ranking'>・ペットランキング</a></h3>
    <h3><a href='/walking'>・散歩募集</h3>
    <h3><a href='/cafeserch'>・犬・猫カフェ検索</a></h3>
    <h1><a href='/'>タイムライン</a></h1>
    
    <h1>ペット登録情報変更</h1>
    <div>
        <form method="POST" action="{{route('pet.update')}}" enctype="multipart/form-data">
            @csrf
            @if($pet)
            <input  type='text' class='pet[name]' name='pet[name]' value='{{$pet->name}}'/><br>
            @else
            <input  type='text' class='pet[name]' name='pet[name]' /><br>
            @endif
            <p class="petname__error" style="color:red">{{ $errors->first('pet.name') }}</p>
            <input type="file" class='pet[image]' name='image'/>
            <select  class='pet[type]' name='pet[type]'>
                <option value="dog">犬</option>
                <option value="cat">猫</option>
            </select>
            <button>更新する</button>
        </form>
    </div>
@endsection
