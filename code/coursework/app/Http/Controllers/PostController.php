<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view('forum.createPost', ['user' => $user ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function listPosts(){
        $posts = Post::all();
        return view('forum.postList', ['posts' => $posts]);
    }

    public function showPost($id){
        $post = Post::findOrFail($id);
        return view('forum.post', ['post' => $post]);
    }

    public function apiListPosts(){
        $posts = Post::all();
        return $posts;
    }

    public function apiStore(Request $request){
        $p = new Post;
        $p->postTitle = $request['postTitle'];
        $p->postContent = $request['postContent'];
        $p->score = $request['score'];
        $p->user_id = $request['user_id'];

        return $p;
    }
}
