@extends('layouts.app')

@section('title', 'Create post')

@section('user', $user->name)


@section('header')
<h1>@yield('title')</h1>
<h3>As @yield('user')</h3>
@endsection

@section('content')

<div>

    
    <div>
        
        <form method="POST" action="{{ route('api.posts.store') }}" enctype="multipart/form-data">

            @csrf
            
            <p>Title: <input type="text" name="postTitle" min="4" max="40"></p>
            
            <p>score: <input type= "number" name="score" min="1" max="10" size="2"></p>
    
            Content:
            <p><input type="text" name="postContent" size="50" min="4" max="40"></p>

            <input type="file" class="form-control" name="catFile">

            <input type="hidden" name="user_id" value="{{ $user->id }}">

            <p><input type="submit" value="Post"></p>
    
        </form>

        @if ($errors->any())
        <div>
            Errors:
            <ul>
                @foreach ($errors->all() as $error)
                   <li> {{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    </div>

</div>

@endsection

