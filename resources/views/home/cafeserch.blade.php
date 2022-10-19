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
    <h3><a href='/ranking'>・ペットランキング</a></h3>
    <h3><a href='/walking'>・散歩募集</h3>
    <h3><a href='/cafeserch'>・犬・猫カフェ検索</a></h3>
    <h1><a href='/'>タイムライン</a></h1>
        
        <input id="pac-input" 
        class="controls" 
        type="text" 
        placeholder="犬・猫カフェ検索"/>
        <div id="map" style="width:800px; height:800px"></div>
    </body>
    
    <table>
    <tr>
      <td>検索場所：</td><td><input type="text" id="addressInput" value="東京駅" style="width: 200px"></td>
    </tr>
    <tr>
      <td>KeyWord：</td><td>
        <select  type="text" id="keywordInput">
                    <option value="dog" value="&quot;犬カフェ&quot;">犬カフェ</option>
                    <option value="cat" value="&quot;猫カフェ&quot;">猫カフェ</option>
      </td>
    </tr>
    <tr>
      <td colspan="2" style="padding: 10px">
        <input type="button" value="お店情報取得" onclick="getPlaces();">
      </td>
    </tr>
    </table>
    
    ★結果★<br />
    <div id="results" style="width: 100%; height: 200px; border: 1px dotted; padding: 10px; overflow-y: scroll; background: white;"></div>
    
    
    <script type="text/javascript">
        var placesList;
        
        /*
         お店情報取得
        */
        function getPlaces(){
          
          //結果表示クリア
          document.getElementById("results").innerHTML = "";
          //placesList配列を初期化
          placesList = new Array();
          
          //入力した検索場所を取得
          var addressInput = document.getElementById("addressInput").value;
          if (addressInput == "") {
            return;
          }
          
          //検索場所の位置情報を取得
          var geocoder = new google.maps.Geocoder();
          geocoder.geocode(
            {
              address: addressInput
            },
            function(results, status) {
              if (status == google.maps.GeocoderStatus.OK) {
                //取得した緯度・経度を使って周辺検索
                startNearbySearch(results[0].geometry.location);
              }
              else {
                alert(addressInput + "：位置情報が取得できませんでした。");
              }
            });
        }
        
        /*
         位置情報を使って周辺検索
          latLng : 位置座標（google.maps.LatLng）
        */
        function startNearbySearch(latLng){
          
          //読み込み中表示
          document.getElementById("results").innerHTML = "Now Loading...";
          
          //Mapインスタンス生成
          var map = new google.maps.Map(
            document.createElement("div")
          );
          
          //PlacesServiceインスタンス生成
          var service = new google.maps.places.PlacesService(map);
          
          //入力したKeywordを取得
          var keywordInput = document.getElementById("keywordInput").value;
          
          //周辺検索
          service.nearbySearch(
            {
              location: latLng,
              radius: 4000,
              type: ["food", "cafe"],
              keyword: keywordInput,
              language: 'ja'
            },
            displayResults
          );
        }
        
        /*
         周辺検索の結果表示
         ※nearbySearchのコールバック関数
          results : 検索結果
          status ： 実行結果ステータス
          pagination : ページネーション
        */
        function displayResults(results, status, pagination) {
            
          if(status == google.maps.places.PlacesServiceStatus.OK) {
          
            //検索結果をplacesList配列に連結
            placesList = placesList.concat(results);
            
            //pagination.hasNextPage==trueの場合、
            //続きの検索結果あり
            if (pagination.hasNextPage) {
              
              //pagination.nextPageで次の検索結果を表示する
              //※連続実行すると取得に失敗するので、
              //1秒くらい間隔をおく
              setTimeout(pagination.nextPage(), 1000);
            
            //pagination.hasNextPage==falseになったら
            //全ての情報が取得できているので、
            //結果を表示する
            } else {
              
              //placesList配列をループして、
              //結果表示のHTMLタグを組み立てる
              var resultHTML = "<ol>";
              
              for (var i = 0; i < placesList.length; i++) {
                place = placesList[i];
                
                //ratingがないのものは「---」に表示変更
                var rating = place.rating;
                if(rating == undefined) rating = "---";
                
                //表示内容（評価＋名称）
                var content = "【" + rating + "】 " + place.name;
                
                resultHTML += "<li>";
                resultHTML += content;
                resultHTML += "</li>";
              }
              
              resultHTML += "</ol>";
              
              //結果表示
              document.getElementById("results").innerHTML = resultHTML;
            }
          
          } else {
            //エラー表示
            var results = document.getElementById("results");
            if(status == google.maps.places.PlacesServiceStatus.ZERO_RESULTS) {
              results.innerHTML = "検索結果が0件です。";
            } else if(status == google.maps.places.PlacesServiceStatus.ERROR) {
              results.innerHTML = "サーバ接続に失敗しました。";
            } else if(status == google.maps.places.PlacesServiceStatus.INVALID_REQUEST) {
              results.innerHTML = "リクエストが無効でした。";
            } else if(status == google.maps.places.PlacesServiceStatus.OVER_QUERY_LIMIT) {
              results.innerHTML = "リクエストの利用制限回数を超えました。";
            } else if(status == google.maps.places.PlacesServiceStatus.REQUEST_DENIED) {
              results.innerHTML = "サービスが使えない状態でした。";
            } else if(status == google.maps.places.PlacesServiceStatus.UNKNOWN_ERROR) {
              results.innerHTML = "原因不明のエラーが発生しました。";
            }
        
          }
        }
    </script>
@endsection
