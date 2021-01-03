<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommentController;
use App\Cats;

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

app()->singleton('Cats', function ($app) {
    return new Cats();
});
app()->make('Cats');

Route::redirect('/', '/home', 301);

Route::get('/home', [HomeController::class, 'homeView'])->name('home');

Route::get('/posts', [PostController::class, 'listPosts']) -> name('Posts.List');

Route::get('/posts/create',  [PostController::class, 'create']) -> name('Posts.Create')->middleware('auth');

Route::get('/posts/{post}', [PostController::class, 'showPost']) -> name('Posts.Show');

Route::delete('/posts/{post}', [PostController::class, 'destroyPost']) -> name('Posts.Destroy');

Route::get('/comments/{comment}', [CommentController::class, 'showComment']) -> name('Comments.Show');

Route::delete('/comments/{comment}', [CommentController::class, 'destroyComment']) -> name('Comments.Destroy');

Route::get('/users', [UserController::class, 'listUsers']) -> name('Users.List')->middleware('auth');

Route::get('/users/{user}', [UserController::class, 'showUser']) -> name('Users.Show')->middleware('auth');