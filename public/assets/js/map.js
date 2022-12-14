window.initAutocomplete = function() {
  //マップの初期設定です。
  const map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: 	35.689, lng: 139.692 },
    zoom: 13,
    mapTypeId: "hybrid",
  });
  const input = document.getElementById("pac-input");
  const searchBox = new google.maps.places.SearchBox(input);
 ////"SearchBoxクラス"はPlacesライブラリのメソッド。引数はinput(ドキュメント上ではinputFieldとある)。
 ////[https://developers.google.com/maps/documentation/javascript/reference/places-widget#SearchBox]

  map.controls[google.maps.ControlPosition.TOP].push(input);
  ////"ControlPosition"クラスはコントローラーの位置を定める。
  ////https://lab.syncer.jp/Web/API/Google_Maps/JavaScript/ControlPosition/
  ////https://developers.google.com/maps/documentation/javascript/examples/control-positioning

  map.addListener("bounds_changed", () => {
    searchBox.setBounds(map.getBounds());
  });
  ////"bound_changed"イベントは(見えてる範囲の地図･ビューポートに変化があったときに発火)
  ////https://lab.syncer.jp/Web/API/Google_Maps/JavaScript/Map/bounds_changed/ 
  ////"getBounds"メソッドはビューポートの境界を取得。Mapクラスのメソッド。
  ////https://lab.syncer.jp/Web/API/Google_Maps/JavaScript/Map/getBounds/

  let markers = [];
  searchBox.addListener("places_changed", () => {
  ////"place_chaged"イベントはAutoCompleteクラスのイベント.
  ////https://developers.google.com/maps/documentation/javascript/reference/places-widget#Autocomplete.place_changed

    const places = searchBox.getPlaces();
    ////"getPlaces"メソッドはクエリ(検索キーワード)を配列(PlaceResult)で返す。
    ////https://developers.google.com/maps/documentation/javascript/reference/places-widget#Autocomplete.place_changed

    if (places.length == 0) {
      return;
    }
    // Clear out the old markers.
    markers.forEach((marker) => {
      //"forEach"メソッドは引数にある関数へ、Mapオブジェクトのキー/値を順に代入･関数の実行をする。
        //Mapオブジェクト:
          //https://developer.mozilla.org/ja/docs/Web/JavaScript/Reference/Global_Objects/Map
      marker.setMap(null);
      ////setMapメソッドはMarker(Polyline,Circleなど)クラスのメソッド。Markerを指定した位置に配置する。引数nullにすると地図から取り除く。
    });
    markers = [];
    // For each place, get the icon, name and location.
    const bounds = new google.maps.LatLngBounds();
    ////"LatLngBounds"クラスは境界を作るインスンタンスを作成。引数は左下、右上の座標。
    ////https://lab.syncer.jp/Web/API/Google_Maps/JavaScript/LatLngBounds/#:~:text=LatLngBounds%E3%82%AF%E3%83%A9%E3%82%B9%E3%81%AF%E5%A2%83%E7%95%8C(Bounding,%E4%BD%9C%E3%82%8B%E3%81%93%E3%81%A8%E3%82%82%E3%81%A7%E3%81%8D%E3%81%BE%E3%81%99%E3%80%82
    places.forEach((place) => {
      if (!place.geometry) {
        ////"geometry"はplaceライブラリのメソッド。

        console.log("Returned place contains no geometry");
        return;
      }
      const icon = {
        url: place.icon,
        ////"icon"はアイコンを表すオブジェクト。マーカーをオリジナル画像にしたいときなど。
        ////https://lab.syncer.jp/Web/API/Google_Maps/JavaScript/Icon/
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        ////"Point"クラスはマーカーのラベルなどの位置を決めるインスタンスメソッド。
        ////https://lab.syncer.jp/Web/API/Google_Maps/JavaScript/Point/

        scaledSize: new google.maps.Size(25, 25),
      };
      // Create a marker for each place.
      markers.push(
        new google.maps.Marker({
          map,
          icon,
          title: place.name,
          position: place.geometry.location,
        })
      );

      if (place.geometry.viewport) {
        ////viewport"メソッド
        // Only geocodes have viewport.
        bounds.union(place.geometry.viewport);
        ////"union"メソッドはLatLngBoundsクラスのメソッド。自身の境界に指定した境界を取り込んで合成する。
        ////https://lab.syncer.jp/Web/API/Google_Maps/JavaScript/LatLngBounds/union/
      } else {
        bounds.extend(place.geometry.location);
        ////"extend"メソッドはLatLngBoundsクラスのメソッド。自身の境界に新しく位置座標を追加する。
        ////https://lab.syncer.jp/Web/API/Google_Maps/JavaScript/LatLngBounds/extend/
      }
    });
    map.fitBounds(bounds);
    ////"fitBounds"メソッドはmapクラスのメソッド。指定した境界を見えやすい位置にビューポートを変更する。
    ////https://lab.syncer.jp/Web/API/Google_Maps/JavaScript/Map/fitBounds/#:~:text=Map.fitBounds()%E3%81%AFMap,%E5%A4%89%E6%9B%B4%E3%81%97%E3%81%A6%E3%81%8F%E3%82%8C%E3%81%BE%E3%81%99%E3%80%82

  });
}




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
  document.getElementById("results").innerHTML = "検索中...";
  
  //Mapインスタンス生成
  var map = new google.maps.Map(
    document.createElement("map"),
    {
      zoom: 15,
      center: latLng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
  );
  
  //PlacesServiceインスタンス生成
  var service = new google.maps.places.PlacesService(map);
  
  //入力したKeywordを取得
  var keywordInput = document.getElementById("keywordInput").value;
  //入力した検索範囲を取得
  var obj = document.getElementById("radiusInput");
  var radiusInput = Number(obj.options[obj.selectedIndex].value);
  
  //周辺検索
  service.nearbySearch(
    {
      location: latLng,
      radius: radiusInput,
      type: ["food", "cafe"],
      keyword: keywordInput,
      language: 'ja'
    },
    displayResults
  );
  
  //検索範囲の円を描く
  var circle = new google.maps.Circle(
    {
      map: map,
      center: latLng,
      radius: radiusInput,
      fillColor: '#ff0000',
      fillOpacity: 0.3,
      strokeColor: '#ff0000',
      strokeOpacity: 0.5,
      strokeWeight: 1
    }
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
      
      //ソートを正しく行うため、
      //ratingが設定されていないものを
      //一旦「-1」に変更する。
      for (var i = 0; i < placesList.length; i++) {
        if(placesList[i].rating == undefined){
          placesList[i].rating = -1;
        }
      }
      
      //ratingの降順でソート（連想配列ソート）
      placesList.sort(function(a,b){
        if(a.rating > b.rating) return -1;
        if(a.rating < b.rating) return 1;
        return 0;
      });
      
      
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

/*
 マーカー表示
  name : 名称
  vicinity : 近辺住所
  lat : 緯度
  lng : 経度
*/
function createMarker(name, vicinity, lat, lng){
  
  //マーカー表示する位置のMap表示
  var map = new google.maps.Map(document.getElementById("map"), {
    zoom: 13,
    center: new google.maps.LatLng(lat, lng),
    mapTypeId: google.maps.MapTypeId.HYBRID
  });
  
  //マーカー表示
  var marker = new google.maps.Marker({
    map: map,
    position: new google.maps.LatLng(lat, lng)
  });
  
  //情報窓の設定
  var info = "<div style=\"min-width: 100px\">";
  info += name + "<br />";
  info += vicinity + "<br />";
  info += "<a href=\"https://maps.google.co.jp/maps?q=" + encodeURIComponent(name + " " + vicinity) + "&z=15&iwloc=A\"";
  info += " target=\"_blank\">⇒詳細表示</a><br />";
  info += "<a href=\"https://www.google.com/maps/dir/?api=1&destination=" + lat + "," + lng + "\"";
  info += " target=\"_blank\">⇒ここへ行く</a>";
  info += "</div>";
  
  //情報窓の表示
  var infoWindow = new google.maps.InfoWindow({
    content: info
  });
  infoWindow.open(map, marker);
  
  //マーカーのクリック時にも情報窓を表示する
  marker.addListener("click", function(){
    infoWindow.open(map, marker);
  });
}