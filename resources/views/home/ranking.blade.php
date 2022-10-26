@extends('layouts.timeline')
@section('header')
    <header class="masthead" style="background-image: url('/assets/img/pet_ranking.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>DoggieCat</h1>
                        <span class="subheading">ペットランキング</span></br>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <div class="text-center">
        <h3>今月のいいね取得ペットランキング</h3>
        <div><h4>＜犬＞<h4></div></br>
        @if($dog_likes)
            <?php $index=1; ?>
            @foreach($dog_likes as $dog_like)
                <div>{{$index}}位
                {{$dog_like['dog_name']}}
                [{{$dog_like['total_like']}}]</br></br>
                @if($dog_like['dog_image'])
                    ペット画像：<img src="{{$dog_like['dog_image']}}" alt="画像無し">
                @else
                    ペット画像： <img src=https://res.cloudinary.com/dgrrdt1vv/image/upload/v1666451908/ct10cffq1huqyrlol83z_bng5pr.jpg alt="画像無し">
                @endif
                </div>
                <?php $index++; ?>
            @break($index==11)
            @endforeach
        @else
            まだいいねがありません
        @endif
        <div><h4>＜猫＞<h4></div></br>
        @if($cat_likes)
            <?php $index=1; ?>
            @foreach($cat_likes as $cat_like)
                <div>{{$index}}位
                {{$cat_like['cat_name']}}
                [{{$cat_like['total_like']}}]</br></br>
                @if($cat_like['cat_image'])
                    ペット画像：<img src="{{$cat_like['cat_image']}}" alt="画像無し">
                @else
                    ペット画像： <img src=https://res.cloudinary.com/dgrrdt1vv/image/upload/v1666451908/ct10cffq1huqyrlol83z_bng5pr.jpg alt="画像無し">
                @endif
                </div>
                <?php $index++; ?>
            @break($index==11)
            @endforeach
        @else
            まだいいねがありません
        @endif
    </div>
@endsection