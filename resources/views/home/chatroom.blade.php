@extends('layouts.app')　　　　

@section('header')
    <title>Todos</title>
@endsection

@section('content')

    <div id="message_area">
    
    </div>
    <div>
       <textarea id = "message" rows="5" cols="100"></textarea>
       <button id="submit">送信</button>
    </div>
    
    <script src="/js/app.js"></script>
    <script src="{mix('js/chat.js')}}"></script>
@endsection