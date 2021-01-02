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
        Title: <input type= "text" id="title" v-model="newPostTitle">
    </p>
    <p>
        Score (out of 10): <input type= "number" id="score" min="1" max="10" size="2" v-model="newPostScore">
    </p>
    <p>    
        Content:
    </p>
    <input type= "text" id="title" v-model="newPostContent" size="45">
    <div v-if="newPostScore <= 10"><button @click="makePost">Post</button></div>
    <div v-else><button @click="makePost">Poust</button></div>

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
            newPostContent: '',
        },
        methods: {
            createPost: function(){

            }
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