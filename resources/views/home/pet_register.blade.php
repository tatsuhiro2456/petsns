@extends('layouts.app')

@section('content')
    ペット登録<br>
    <form action='{{ route('pet_register') }}' method='post'>
        @csrf
            ペット名：<input type='text' name='pet[name]'><br>
            飼育ペット：<select  name='pet[type]'>
                    <option value="dog">犬</option>
                    <option value="cat">猫</option>
                    <option value="other">その他</option>
                    <option value="not">飼育無し</option>
            <input type='submit' value='保存'>
    </form>
@endsection
