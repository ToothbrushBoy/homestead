@extends('Layouts.app')

@section('title', 'Edit comment')

@section('header')

<h1>@yield('title')</h1>

@endsection

@section('content')

<div id="root">

    <form method="POST" action="{{ route('Comments.Update') }}">

        @csrf

        <p><input type="text" name="content" value="{{ $comment->content }}"></p>
        <input type="hidden" name="id" value="{{ $comment->id }}">
        <input type="submit" value="Ok">
    </form>

</div>

@endsection