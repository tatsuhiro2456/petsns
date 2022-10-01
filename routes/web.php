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
    Route::get('/mypage', 'UserController@mypage');
    Route::get('/pet_register', 'PetController@add')->name('pet_add');
    Route::post('/pet_register', 'PetController@register')->name('pet_register');
    Route::get('/posts/create', 'PostController@create');
    Route::get('/cafeserch', 'MapController@map');
    Route::get('/contents/{content}', 'ContentController@index');
    Route::get('/userpage/{user}', 'UserController@userpage');
    Route::get('/userpage/{user}/follow', 'FollowController@follow');
    Route::get('/userpage/{user}/unfollow', 'FollowController@unfollow');

    
});