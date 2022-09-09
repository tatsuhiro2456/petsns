 <!DOCTYPE html>
<html>
    <head>
        <title>犬・猫カフェ検索</title>
        
        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
        
        <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{ config("services.google-map.apikey") }}&callback=initAutocomplete&libraries=places&v=weekly" 
        defer
        ></script>
        <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/mapstyle.css') }}"> 
        <script src="{{ asset('/assets/js/map.js') }}"></script>
        
    </head>
    <body>
        <input id="pac-input" 
        class="controls" 
        type="text" 
        placeholder="犬・猫カフェ検索"/>
        <div id="map"></div>
        
  </body>
</html>