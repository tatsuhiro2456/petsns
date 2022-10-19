@extends('layouts.app')　　　　　　　　　　　　　　　　　　

@section('content')

    <h3><a href='/mypage'>・マイページ</a></h3>
    <h3><a href='/ranking'>・ペットランキング</a></h3>
    <h3><a href='/walking'>・散歩募集</h3>
    <h3><a href='/cafeserch'>・犬・猫カフェ検索</a></h3>
    <h1><a href='/'>タイムライン</a></h1>
    
    <h3>今月のいいね取得ペットランキング</h3>
    ＜犬＞</br>
    <?php $index=1; ?>
    @foreach($dog_likes as $dog_like)
        {{$index}}位
        {{$dog_like['dog_name']}}
        [{{$dog_like['total_like']}}]</br></br>
        <?php $index++; ?>
    @endforeach
    ＜猫＞</br>
    <?php $index=1; ?>
    @foreach($cat_likes as $cat_like)
        {{$index}}位
        {{$cat_like['cat_name']}}
        [{{$cat_like['total_like']}}]</br></br>
        <?php $index++; ?>
    @endforeach
    
@endsection