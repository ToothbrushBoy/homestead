@extends('layouts.app')

@section('title', $post->postTitle)

@section('user', $post->user->name)

@section('created', $post->created_at)

@section('updated', $post->updated_at)

@section('timeText')

    @if ($post->created_at == $post->updated_at)
        Posted @yield('created')
    @else
        Posted @yield('created'), updated @yield('updated')
    @endif

@endsection

@section('header')

    <h1>@yield('title')</h1>
    <h3>By @yield('user')</h3>
    <p>@yield('timeText')</p>

@endsection

@section('content')

    <p>{{ $post->postContent }}</p>

@endsection