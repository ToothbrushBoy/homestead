<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function showPosts(){
        return view();
    }

    public function showPost(Post $post){
        return view('forum.post', ['post' => $post]);
    }
}
