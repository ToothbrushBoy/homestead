@extends('layouts.app')

@section('title', 'Create post')

@section('user', $user->name)

@section('cat')
<div v-if="submitOwnCat == 0">
    <button @click="ownCatToggle">Submit your own cat?</button>
    <p>
    <img src={{ $cat }} style="width:500px">
</div>
<div v-else>
    <button @click="ownCatToggle">Use provided cat?</button>
    <p><input type="file" @change="handleCat"></p>
        

</div>
@endsection

@section('header')

<h1>@yield('title')</h1>
<h3>As @yield('user')</h3>


@endsection

@section('content')

<div id="root">

    
    <div>
        <h3>Cat to review:</h3>
        
        @yield('cat')

        <p>
            Title: <input type= "text" placeholder="Title (4-40 characters)" minlength="4" maxlength="40" id="title" v-model="newPostTitle">
        </p>
        
        <p>
            Score (out of 10): <input type= "number" id="score" min="1" max="10" size="2" v-model="newPostScore">
        </p>
        <p>    
            Content:
        </p>
        <input type= "text" id="title" maxlength="2000" placeholder="Content (max 2000 cahracters)" v-model="newPostContent" size="45">
        <div v-if="newPostScore <= 10 && newPostScore >= 1 && newPostTitle.length >= 4 && newPostTitle.length <= 40 && newPostContent.length <= 2000">
            <button @click="makePost">Post</button>
        </div>
        <div v-else><button disabled>Post</button></div>
    </div>

</div>

@endsection

@section('script')

<script>
    var postListVue = new Vue({
        el: "#root",
        data: {
            posts: [],
            submitOwnCat: 0,
            newPostTitle: '',
            newPostScore: '',
            newPostContent: '',
            newPostUserId: {{ $user->id }},
            catUrl: "{{ $cat }}",
            catFile: '',
        },
        methods: {
            handleCat(){
                this.catFile = event.target.files[0];
            },
            makePost: function(){
                console.log(this.newPostTitle);
                console.log(this.newPostScore);
                console.log(this.newPostContent);
                console.log(this.newPostUserId);
                console.log(this.catUrl);
                console.log(this.submitOwnCat);

                axios.post("{{ route('api.posts.store') }}", {
                    postTitle: this.newPostTitle,
                    score: this.newPostScore,
                    postContent: this.newPostContent,
                    user_id: this.newPostUserId,
                    cat: this.catUrl,
                    catFile: this.catFile,
                    ownCat: this.submitOwnCat,
                })
                .then(response =>  {
                    window.location = "/posts"
                })
                .catch(response => {
                    console.log(response);
                })

            },
            ownCatToggle: function(){
                if (this.submitOwnCat == 0){
                    this.submitOwnCat = 1;
                } else {
                    this.submitOwnCat = 0;
                }
            },
        },
    });
</script>

@endsection