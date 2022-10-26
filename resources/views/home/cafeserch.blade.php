@extends('layouts.timeline')
@section('head')
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    
    <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{ config("services.google-map.apikey") }}&callback=initAutocomplete&libraries=places&v=weekly" 
    defer
    ></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/mapstyle.css') }}"> 
    <script src="{{ asset('/assets/js/map.js') }}"></script>
@endsection

@section('header')
    <header class="masthead" style="background-image: url('/assets/img/cafe.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>DoggieCat</h1>
                        <span class="subheading">犬・猫カフェ検索機能</span></br>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection

@section('content')
      <input id="pac-input" 
      class="controls" 
      type="text" 
      placeholder="犬・猫カフェ検索"/>
      <div id="map" style="width:800px; height:800px; margin: auto"></div>

<div style="text-align:center;">
    <table style="margin: auto">
      <p>カフェ評価ランキング</p>
    <tr>
      <td>検索場所：</td><td><input type="text" id="addressInput" value="東京駅" style="width: 200px;"></td>
    </tr>
    <tr>
      <td>KeyWord：</td><td>
        <select  type="text" id="keywordInput" >
                    <option value="dog" value="&quot;犬カフェ&quot;">犬カフェ</option>
                    <option value="cat" value="&quot;猫カフェ&quot;">猫カフェ</option>
      </td>
    </tr>
    <tr>
      <td>検索範囲：</td>
      <td>
        <select id="radiusInput">
        <option value="500" selected>500 m</option>
        <option value="800">800 m</option>
        <option value="1000">1 km</option>
        <option value="1500">1.5 km</option>
        <option value="2000">2 km</option>
        <option value="3000">3 km</option>
        <select>
      </td>
    </tr>
    <tr>
      <td colspan="2" style="padding: 10px">
        <input type="button" value="お店情報取得" onclick="getPlaces();">
      </td>
    </tr>
    </table>
    
    結果<br />
    <div id="results" style="width: 100%; height: 200px; border: 1px dotted; padding: 10px; overflow-y: scroll; background: white;"></div>
</div>
    


@endsection
