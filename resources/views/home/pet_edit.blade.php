@extends('layouts.timeline')



@section('content')
    
    <div class="register">
        <div class="register_center">
            <h1>ペット登録情報変更</h1>
            <form method="POST" action="{{route('pet.update')}}" enctype="multipart/form-data">
                @csrf
                @if($pet)
                    ペット名：<input  type='text' class='pet[name]' name='pet[name]' value='{{$pet->name}}'/><br>
                    <p class="petname__error" style="color:red">{{ $errors->first('pet.name') }}</p>
                @else
                    ペット名：<input  type='text' class='pet[name]' name='pet[name]' /><br>
                    <p class="petname__error" style="color:red">{{ $errors->first('pet.name') }}</p>
                @endif
                ペット画像　：<input type="file" class='pet[image]' name='image'/><br><br>
                ペットタイプ：<select  class='pet[type]' name='pet[type]'>
                    <option value="dog">犬</option>
                    <option value="cat">猫</option>
                </select><br><br>
                <button class="btn btn-success btn-sm">更新する</button>
            </form>
        </div>
    </div>
    <hr width="100%">
@endsection
