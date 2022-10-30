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
    <h1 class="text-center"><font color="#332524">今月のいいね取得ペットランキング</font></h1><br>
    <div class="ranking_container">
        <div class="dog"><h2>＜犬＞<h2></br>
            @if($dog_likes)
            <?php $index=1; ?>
            <table  class="table table-bordered border-dark">
                <thead>
                    <tr>
                        <th scope="col">順位</th>
                        <th scope="col">画像</th>
                        <th scope="col">名前</th>
                        <th scope="col">いいね数</th>
                        <th scope="col">飼い主</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach($dog_likes as $dog_like)
                    <tr>
                        <th scope="row">{{$index}}位</th>
                            <td>
                                @if($dog_like['dog_image'])
                                    <img src="{{$dog_like['dog_image']}}" alt="画像無し">
                                @else
                                    <img src="https://res.cloudinary.com/dgrrdt1vv/image/upload/v1667130969/pjx07auezdd44d56lldf.jpg" alt="画像無し">
                                @endif
                        </td>
                        <td>{{$dog_like['dog_name']}}</td>
                        <td>{{$dog_like['total_like']}}</td>
                        <td><a href="/userpage/{{$dog_like['user_id']}}">{{$dog_like['user']}}</a></td>
                        <?php $index++; ?>
                    @break($index==11)
                    @endforeach
                    </tr>
            </table>
            @else
                まだいいねがありません
            @endif
        </div>
        
        <div class="cat"><h2>＜猫＞<h2></br>
            @if($cat_likes)
            <?php $index=1; ?>
            <table  class="table table-bordered border-dark">
                <thead>
                    <tr>
                        <th scope="col">順位</th>
                        <th scope="col">画像</th>
                        <th scope="col">名前</th>
                        <th scope="col">いいね数</th>
                        <th scope="col">飼い主</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach($cat_likes as $cat_like)
                    <tr>
                        <th scope="row">{{$index}}位</th>
                            <td>
                                @if($cat_like['cat_image'])
                                    <img src="{{$cat_like['cat_image']}}" alt="画像無し">
                                @else
                                    <img src="https://res.cloudinary.com/dgrrdt1vv/image/upload/v1667130969/pjx07auezdd44d56lldf.jpg" alt="画像無し">
                                @endif
                        </td>
                        <td>{{$cat_like['cat_name']}}</td>
                        <td>{{$cat_like['total_like']}}</td>
                        <td><a href="/userpage/{{$cat_like['user_id']}}">{{$cat_like['user']}}</a></td>
                        <?php $index++; ?>
                    @break($index==11)
                    @endforeach
                    </tr>
            </table>
            @else
                まだいいねがありません
            @endif
        </div>
    </div>
    <hr width="100%">
    


@endsection