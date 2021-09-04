<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController; 
use App\Http\Controllers\GoogleController; 
use App\Http\Controllers\CommentController; 
use App\Http\Controllers\LikeController; 

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/e', function () {
    event(new \App\Events\TaskEvent("hwllo"));
});

Route::get('/l', function () {
    return view('pusher');
});

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth/google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


Route::get('/post', [PostController::class, 'index']);
Route::get('/post/create', [PostController::class, 'create']);
Route::post('/post', [PostController::class, 'store']);
Route::get('/post/{post}', [PostController::class, 'show']);
Route::get('/post/{post}/edit', [PostController::class, 'edit']);
Route::put('/post/{post}', [PostController::class, 'update']);
Route::get('/post/{post}/destroy', [PostController::class, 'destroy']);

Route::post('post/{post}/comments', [CommentController::class, 'store']);
Route::post('post/{post}/likes', [LikeController::class, 'store']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
