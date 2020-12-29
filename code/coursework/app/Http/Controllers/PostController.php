<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function listPosts(){
        return view('forum.list');
    }

    public function showPost(Post $post){
        return view('forum.post', ['post' => $post]);
    }
}
