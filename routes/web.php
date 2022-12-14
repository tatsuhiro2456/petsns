<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::group(['middleware' =>['auth']], function(){
    Route::get('/', 'PostController@index')->middleware('auth');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/posts', 'PostController@index');
    Route::post('/posts', 'PostController@imgstore');
    Route::delete('/posts/{post}', 'PostController@destroy');
    Route::get('/posts/{post}/comment', 'PostController@comment');
    Route::post('/posts/{post}/comment', 'PostController@comment_post');
    Route::delete('/posts/comment/{comment}', 'PostController@comment_destroy');
    Route::get('/mypage', 'UserController@mypage');
    Route::get('/pet_register', 'PetController@add')->name('pet_add');
    Route::post('/pet_register', 'PetController@register')->name('pet_register');
    Route::get('/posts/create', 'PostController@create');
    Route::get('/cafeserch', 'MapController@map');
    Route::get('/contents/{content}', 'ContentController@index');
    Route::get('/userpage/{user}', 'UserController@userpage');
    Route::get('/userpage/{user}/follow', 'FollowController@follow');
    Route::get('/userpage/{user}/unfollow', 'FollowController@unfollow');
    Route::get('/like', 'LikeController@like')->name('post_like');
    Route::get('/unlike', 'LikeController@unlike')->name('post_unlike');
    Route::get('/mypage/edit', 'UserController@edit');
    Route::post('/mypage/user/update','UserController@update')->name('user.update');
    Route::get('/mypage/edit/pet', 'PetController@edit');
    Route::post('/mypage/pet/update','PetController@update')->name('pet.update');
    Route::get('/walking', 'RecruitmentController@view');
    Route::get('/walking/recruitment', 'RecruitmentController@recruitment');
    Route::post('/walking/recruitment', 'RecruitmentController@store');
    Route::delete('/walking/recruitment/{recruitment}', 'RecruitmentController@destroy');
    Route::get('/walking/{recruitmet}/reply', 'RecruitmentController@reply');
    Route::post('/walking/{recruitmet}/reply', 'RecruitmentController@reply_post');
    Route::delete('/walking/reply/{reply}', 'RecruitmentController@reply_destroy');
    #Route::get('/favorite', 'PostController@favorite');
    Route::get('/ranking', 'LikeController@ranking');
    Route::get('/follow/index', 'PostController@follow');
    
    Route::get('/test', 'UserController@test');
});