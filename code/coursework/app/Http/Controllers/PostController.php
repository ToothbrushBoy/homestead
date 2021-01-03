<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Cats;

class PostController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Cats $c)
    {
        $user = Auth::user();
        return view('forum.createPost', ['user' => $user , 'cat' => $c->getCat()]);
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
        return view('forum.post', ['post' => $post, 'currentUser' => Auth::user()]);
    }

    public function apiListPosts(){
        $posts = Post::all();
        return $posts;
    }

    public function apiStore(Request $request){

        $validated = $request->validate([
            'postTitle' => 'required|min:4|max:40|string',
            'postContent' => 'required|max:255|string',
            'score' => 'required|min:1|max:10|integer',
            'user_id' => 'required|integer',
            'cat' => 'required|String|max:255'
        ]);

        $p = new Post;
        $p->postTitle = $request['postTitle'];
        $p->postContent = $request['postContent'];
        $p->score = $request['score'];
        $p->user_id = $request['user_id'];
        $p->cat = $request['cat'];

        $p->save();

        return $p;
    }
}
