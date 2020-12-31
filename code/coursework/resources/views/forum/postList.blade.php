@extends('layouts.app')

@section('header')

    <h1>All posts</h1>

@endsection

@section('content')

    <div id="postList">
        <p>@{{ posts }}</p>
    </div>

    <ul style="list-style-type:none;">
        @foreach ($posts as $post)
            <li> <a href="{{route('Posts.Show', $post->id)}}">{{ $post->postTitle }}</a></li>
        @endforeach
    </ul>

@endsection

@section('script')

<script>
    var postListVue = new Vue({
        el: "#postList",
        data: {
            posts: {},
        },
        mounted(){
            axios.get("{{ route('api.posts.index')}}")
            .then( response => {this.enclosures = response.data;})
            .catch( response => {console.log(response);})
        }
    });
</script>

@endsection