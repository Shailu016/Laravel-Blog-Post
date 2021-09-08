<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController; 
use App\Http\Controllers\GoogleController; 
use App\Http\Controllers\CommentController; 
use App\Http\Controllers\LikeController; 
use App\Http\Controllers\SearchController; 
use  App\Events\TaskEvent;


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
    return redirect('/post');
});
Route::get('/m', function () {
   event(new TaskEvent("hellooooo"));
});


Route::get('/l', function () {
    return view('pusher');
});

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth/google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


Route::get('/post', [PostController::class, 'index']);
Route::get('/post/create', [PostController::class, 'create'])->middleware('auth');
Route::post('/post', [PostController::class, 'store']);
Route::get('/post/{post}', [PostController::class, 'show'])->middleware('auth');
Route::get('/post/{post}/edit', [PostController::class, 'edit'])->middleware('auth');
Route::put('/post/{post}', [PostController::class, 'update']);
Route::get('/post/{post}/destroy', [PostController::class, 'destroy']);

Route::post('post/{post}/comments', [CommentController::class, 'store']);
Route::post('post/{post}/likes', [LikeController::class, 'store']);
Route::get('/search',[SearchController::class,'search']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
