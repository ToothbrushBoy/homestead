@extends('layouts.app')

@section('header')

    <h1>All posts</h1>

@endsection

@section('content')

    <div id="postList">
        <ul style="list-style-type:none;">
            <li v-for="post in posts"><a v-bind:href="'/posts/' + post.id">@{{ post.postTitle }}</a></li>
        </ul>
    </div>

@endsection

@section('script')

<script>
    var postListVue = new Vue({
        el: "#postList",
        data: {
            posts: [],
        },
        mounted(){
            axios.get("{{ route('api.posts.index') }}")
            .then( response => {
                this.posts = response.data;
            })
            .catch( response => {
                console.log(response);
            })
        },
    });
</script>

@endsection