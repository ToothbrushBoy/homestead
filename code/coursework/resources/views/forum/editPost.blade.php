@extends('Layouts.app')

@section('title', 'Edit post')

@section('header')

<h1>@yield('title')</h1>

@endsection

@section('content')

<div id="root">

    <form method="POST" action="{{ route('Posts.Update') }}">

        @csrf
        Title:
        <p><input type="text" name="postTitle" min="4" max="40" value="{{ $post->postTitle }}"></p>
        Content:
        <p><input type="text" name="postContent" size="40" max="2000" value="{{ $post->postContent }}"></p>
        
        <p>Score: <input type="number" size="2" name="score" value="{{ $post->score }}"></p>
        <input type="hidden" name="id" value="{{ $post->id }}">

        <input type="submit" value="Ok">
    </form>

</div>

@endsection