@extends('layouts.app')　　　　　　　　　　　　　　　　　　

@section('content')

    <h3><a href='/mypage'>・マイページ</a></h3>
    <h3><a href='/ranking'>・ペットランキング</a></h3>
    <h3><a href='/walking'>・散歩募集</h3>
    <h3><a href='/cafeserch'>・犬・猫カフェ検索</a></h3>
    <h1><a href='/'>タイムライン</a></h1>
    
    <h3>今月のいいね取得ペットランキング</h3>
    <div><h4>＜犬＞<h4></div></br>
    @if($dog_likes)
        <?php $index=1; ?>
        @foreach($dog_likes as $dog_like)
            <div>{{$index}}位
            {{$dog_like['dog_name']}}
            [{{$dog_like['total_like']}}]</br></br>
            @if($dog_like['dog_image'])
                ペット画像：<img src="{{$dog_like['dog_image']}}" alt="画像無し">
            @else
                ペット画像： <img src=https://res.cloudinary.com/dgrrdt1vv/image/upload/v1666451908/ct10cffq1huqyrlol83z_bng5pr.jpg alt="画像無し">
            @endif
            </div>
            <?php $index++; ?>
        @endforeach
    @else
        まだいいねがありません
    @endif
    <div><h4>＜猫＞<h4></div></br>
    @if($cat_likes)
        <?php $index=1; ?>
        @foreach($cat_likes as $cat_like)
            <div>{{$index}}位
            {{$cat_like['cat_name']}}
            [{{$cat_like['total_like']}}]</br></br>
            @if($cat_like['cat_image'])
                ペット画像：<img src="{{$cat_like['cat_image']}}" alt="画像無し">
            @else
                ペット画像： <img src=https://res.cloudinary.com/dgrrdt1vv/image/upload/v1666451908/ct10cffq1huqyrlol83z_bng5pr.jpg alt="画像無し">
            @endif
            </div>
            <?php $index++; ?>
        @endforeach
    @else
        まだいいねがありません
    @endif
    
@endsection