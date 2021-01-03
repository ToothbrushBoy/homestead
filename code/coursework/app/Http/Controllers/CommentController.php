<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
    public function showComment($id)
    {
        $comment = Comment::findOrFail($id);
        
        return view('forum.commentDetails', ['comment' => $comment, 'currentUser' => Auth::user()]);
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
    public function destroyComment($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
    }

    public function apiComments($parent_type, $parent_id){
        $comments = Comment::all()->where('commentable_type', '=', $parent_type)->where('commentable_id', '=', $parent_id);
        foreach($comments as $comment){
            $comment->userName=$comment->User->name;
        }
        return $comments;
    }

    public function apiStore(Request $request){

        $validated = $request->validate([
            'content' => 'required|max:512|string',
            'commentable_id' => 'required|integer',
            'user_id' => 'required|integer',
            'commentable_type' => "required|string",

        ]);

        $c = new Comment;
        $c->content = $request['content'];
        $c->user_id = $request['user_id'];
        $c->commentable_type = $request['commentable_type'];
        $c->commentable_id = $request['commentable_id'];


        $c->save();

        return $c;

    }
}
