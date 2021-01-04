@extends('layouts.app')

@section('header')

    <h3><a href='{{ route('Posts.Create') }}'>Create post</a></h3>

    <h1>All posts</h1>

@endsection

@section('content')

     <div class="container">

        <ul style="list-style-type:none;">
            @foreach ($posts as $post)
                <li><a href="{{ route('Posts.Show', $post->id) }}">{{ $post->postTitle }} - {{ $post->score }}/10</a></li>
            @endforeach
        </ul>

     </div>

     {{ $posts->links() }}

@endsection