@extends('layouts.app')

@section('header')

    <h1>All posts</h1>

@endsection

@section('content')

    <ul>
        @foreach ($posts as $post)
            <li> <a href="{{route('Posts.Show', $post->id)}}">{{ $post->postTitle }}</a></li>
        @endforeach
    </ul>

@endsection