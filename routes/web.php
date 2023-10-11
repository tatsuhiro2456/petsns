<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\RecruitmentController;

use Illuminate\Support\Facades\Route;
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
Route::middleware('auth')->group(function(){
    Route::get('/', [PostController::class, 'index'])->middleware('auth');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/posts', [PostController::class,'index']);
    Route::post('/posts', [PostController::class, 'imgstore']);
    Route::delete('/posts/{post}', [PostController::class, 'destroy']);
    Route::get('/posts/{post}/comment', [PostController::class, 'comment']);
    Route::post('/posts/{post}/comment', [PostController::class, 'comment_post']);
    Route::delete('/posts/comment/{comment}', [PostController::class, 'comment_destroy']);
    Route::get('/mypage', [UserController::class, 'mypage']);
    Route::get('/pet_register', [PetController::class, 'add'])->name('pet_add');
    Route::post('/pet_register', [PetController::class, 'register'])->name('pet_register');
    Route::get('/posts/create', [PostController::class, 'create']);
    Route::get('/cafeserch', [MapController::class, 'map']);
    Route::get('/contents/{content}', [ContentController::class, 'index']);
    Route::get('/userpage/{user}', [UserController::class, 'userpage']);
    Route::get('/userpage/{user}/follow', [FollowController::class, 'follow']);
    Route::get('/userpage/{user}/unfollow', [FollowController::class, 'unfollow']);
    Route::get('/like', [LikeController::class, 'like'])->name('post_like');
    Route::get('/unlike', [LikeController::class, 'unlike'])->name('post_unlike');
    Route::get('/mypage/edit', [UserController::class, 'edit']);
    Route::post('/mypage/user/update', [UserController::class, 'update'])->name('user.update');
    Route::get('/mypage/edit/pet', [PetController::class, 'edit']);
    Route::post('/mypage/pet/update', [PetController::class, 'update'])->name('pet.update');
    Route::get('/walking', [RecruitmentController::class, 'view']);
    Route::get('/walking/recruitment', [RecruitmentController::class, 'recruitment']);
    Route::post('/walking/recruitment', [RecruitmentController::class, 'store']);
    Route::delete('/walking/recruitment/{recruitment}', [RecruitmentController::class, 'destroy']);
    Route::get('/walking/{recruitmet}/reply', [RecruitmentController::class, 'reply']);
    Route::post('/walking/{recruitmet}/reply', [RecruitmentController::class, 'reply_post']);
    Route::delete('/walking/reply/{reply}', [RecruitmentController::class, 'reply_destroy']);
    #Route::get('/favorite', 'PostController@favorite');
    Route::get('/ranking', [LikeController::class, 'ranking']);
    Route::get('/follow/index', [PostController::class, 'follow']);
    
    Route::get('/test', [UserController::class, 'test']);
});