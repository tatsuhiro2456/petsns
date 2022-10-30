@extends('layouts.auth')



@section('content')
<div class="container pt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ペット登録') }}</div>
                    <div class="container">
                        <font color='blue'>飼育しているペットがいたらチェック</font><br>
                        <input type="checkbox" class="toggle">飼育有り</input><br>
                        <div class="checkbox_off">
                            <a class='btn btn-primary' href='/'>登録</a>
                        </div>
                        <div class="checkbox_on">
                            <form action='{{ route('pet_register') }}' method='post'>
                                @csrf
                                    飼育ペット：<select  name='pet[type]'>
                                        <option value="dog">犬</option>
                                        <option value="cat">猫</option>
                                        </select>
                                        <br>
                                    ペット名：<input type='text' name='pet[name]'><br>
                                    <p class="petname__error" style="color:red">{{ $errors->first('pet.name') }}</p>
                                <input type="submit" class="btn btn-primary" value="登録"/>
                        </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
