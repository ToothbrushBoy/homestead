<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

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

Route::redirect('/', '/home', 301);

Route::get('/home', function () {
    return view('forum.home');
});

Route::get('/posts', [PostController::class, 'listPosts']) -> name('Posts.List')->middleware('auth');

Route::get('/posts/create',  [PostController::class, 'create']) -> name('Posts.Create')->middleware('auth');

Route::get('/posts/{post}', [PostController::class, 'showPost']) -> name('Posts.Show')->middleware('auth');

Route::get('/posts/create',  [PostController::class, 'create']) -> name('Posts.Create')->middleware('auth');

Route::get('/users', [UserController::class, 'listUsers']) -> name('Users.List')->middleware('auth');

Route::get('/users/{user}', [UserController::class, 'showUser']) -> name('Users.Show')->middleware('auth');