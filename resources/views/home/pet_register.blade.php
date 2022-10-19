@extends('layouts.app')

@section('header')
    <link rel="stylesheet" href='/css/pet_register.css' type="text/css" >
@endsection('header')

@section('content')
    ペット登録<br>
    <input type="checkbox" class="toggle">飼育有り</input>
    <div class="checkbox_off">
        <a href='/'>登録</a>
    </div>
    <div class="checkbox_on">
        <form action='{{ route('pet_register') }}' method='post'>
            @csrf
                ペット名：<input type='text' name='pet[name]'><br>
                <p class="petname__error" style="color:red">{{ $errors->first('pet.name') }}</p>
                飼育ペット：<select  name='pet[type]'>
                        <option value="dog">犬</option>
                        <option value="cat">猫</option>
                <input type='submit' value='登録'>
        </form>
    </div>
@endsection
