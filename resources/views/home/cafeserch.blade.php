@extends('layouts.app')　　　　　　　　　　　　　　　　　　
@section('header')
    <title>犬・猫カフェ検索</title>
    
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    
    <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{ config("services.google-map.apikey") }}&callback=initAutocomplete&libraries=places&v=weekly" 
    defer
    ></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/mapstyle.css') }}"> 
    <script src="{{ asset('/assets/js/map.js') }}"></script>
@endsection

@section('content')
    <body>
        <h3><a href='/mypage'>・マイページ</a></h3>
        <h3>・ペットランキング</h3>
        <h3>・散歩募集</h3>
        <h3><a href='/cafeserch'>・犬・猫カフェ検索</a></h3>
        <h1><a href='/'>タイムライン</a></h1>
        
        <input id="pac-input" 
        class="controls" 
        type="text" 
        placeholder="犬・猫カフェ検索"/>
        <div id="map"></div>
    </body>
@endsection
