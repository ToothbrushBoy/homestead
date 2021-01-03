<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Cats;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('cat', [Cats::class, 'getCat'])->name('api.cats.get');

Route::get('posts', [PostController::class, 'apiListPosts'])->name('api.posts.index');

Route::post('posts', [PostController::class, 'apiStore'])->name('api.posts.store');

Route::get('/comments/{post}', [CommentController::class, 'apiComments'])->name('api.comments.list');

Route::post('/comments', [CommentController::class, 'apiStore'])->name('api.comments.store');
