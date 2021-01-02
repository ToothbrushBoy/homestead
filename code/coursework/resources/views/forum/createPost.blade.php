@extends('layouts.app')

@section('title', 'Create post')

@section('user', $user->name)

@section('header')

<h1>@yield('title')</h1>
<h3>As @yield('user')</h3>

@endsection

@section('content')

<div id="root">

    <p>
        Title: <input type= "text" placeholder="Title (4-40 characters)" minlength="4" maxlength="40" id="title" v-model="newPostTitle">
    </p>
    <p>
        Score (out of 10): <input type= "number" id="score" min="1" max="10" size="2" v-model="newPostScore">
    </p>
    <p>    
        Content:
    </p>
    <input type= "text" id="title" maxlength="256" placeholder="Content (max 256 cahracters)" v-model="newPostContent" size="45">
    <div v-if="newPostScore <= 10 && newPostScore >= 1 && newPostTitle.length >= 4 && newPostTitle.length <= 40 && newPostContent.length <= 256">
        <button @click="makePost">Post</button>
    </div>
    <div v-else><button disabled>Post</button></div>

    <div>
        @{{ newPostTitle }}
    </div>
</div>

@endsection

@section('script')

<script>
    var postListVue = new Vue({
        el: "#root",
        data: {
            posts: [],
            newPostTitle: '',
            newPostScore: '',
            newPostContent: ''
        },
        methods: {
            makePost: function(){

                axios.post("{{ route('api.posts.store') }}", {
                    postTitle: this.newPostTitle,
                    score: this.newPostScore,
                    postContent: this.newPostContent
                })
                .then(response =>  {
                    console.log(response);
                    console.log("then");

                })
                .catch(response => {
                    console.log(response);
                    console.log("catch");
                    console.log(this.newPostTitle);
                    console.log(this.newPostContent);
                    console.log(this.newPostScore);
                })

            }
        },
    });
</script>

@endsection