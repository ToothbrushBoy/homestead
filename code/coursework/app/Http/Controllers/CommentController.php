<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
    public function destroy($id, $commentableParent, $parentType)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->route('Posts.show', $commentableParent);
    }

    public function apiComments($post){
        $comments = Comment::all()->where('post_id', '=', $post);
        foreach($comments as $comment){
            $comment->userName=$comment->User->name;
        }
        return $comments;
    }

    public function apiStore(Request $request){

        $validated = $request->validate([
            'content' => 'required|max:255|string',
            'post_id' => 'required|integer',
            'user_id' => 'required|integer'
        ]);

        $c = new Comment;
        $c->content = $request['content'];
        $c->post_id = $request['post_id'];
        $c->user_id = $request['user_id'];

        $c->save();

        return $c;

    }
}
