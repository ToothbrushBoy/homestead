@extends('layouts.app')

@section('title', $post->postTitle)

@section('user', $post->user->name)

@section('content')

    <ul>

        <li>{{ $post->postContent }}</li>

    </ul>

@endsection