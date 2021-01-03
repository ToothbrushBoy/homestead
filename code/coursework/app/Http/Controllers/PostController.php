<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
            'postContent' => 'required|max:2000|string',
            'score' => 'required|min:1|max:10|integer',
            'user_id' => 'required|integer',
            'cat' => 'required|String|max:255',
            'catFile' => 'file',
        ]);

        $p = new Post;
        $p->postTitle = $request['postTitle'];
        $p->postContent = $request['postContent'];
        $p->score = $request['score'];
        $p->user_id = $request['user_id'];
        if ($request['ownCat'] == 0){
            $p->cat = $request['cat'];
        } else {
            $p->cat = Storage::putFile('cats', $request['catFile'], 'public');
        }

        $p->save();

        return $p;
    }

    public function apiStoreCat(Request $request){
        $requestCat = $request['catFile'];

        $cat = Storage::putFile('cats', $requestCat, 'public');

        return $cat;
    }
}
