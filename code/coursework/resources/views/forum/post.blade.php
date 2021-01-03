@extends('layouts.app')

@section('title', $post->postTitle)

@section('user', $post->user->name)

@section('created', $post->created_at)

@section('updated', $post->updated_at)

@section('cat')
<img src="{{ $post->cat }}" style="width:500px">
@endsection

@section('commentBox')

<input v-model="newCommentContent" placeholder="Comment" max="512">

<div v-if="newCommentContent.length >= 1 && newCommentContent.length <= 512">
    <button @click="makeComment">Post</button>
</div>
<div v-else><button disabled>Post</button></div>

@endsection

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

    @yield('cat')

    <div>{{ $post->postContent }}</div>


    <div id="root">
        
        <div>

            @if ($currentUser->id == $post->user->id || $currentUser->admin == 1)
                <button @click="deletePost">Delete</button>
            @endif

        </div>

        <p></p>
        @yield('commentBox')

        <p>
            <h3>Comments</h3>
        <p>

        <ul style="list-style-type:none;">
            <li v-for="comment in commentsData">
                <a v-bind:href="'/comments/' + comment.id">
                    <p>@{{ comment.content }}</p>
                    <p>@{{ comment.userName }} at @{{ comment.created_at }}</p>
                </a>
            </li>
        </ul>
    </div>
@endsection

@section('script')

<script>
    var commentsVue = new Vue({
        el: "#root",
        data: {
            commentsData: [],
            newCommentContent: '',
            newCommentCommentableId: {{ $post->id }},
            newCommentUser: {{ $currentUser->id }},
            userName: "{{ $currentUser->name }}",
        },
        methods: {
            makeComment: function(){

                axios.post("{{ route('api.comments.store') }}", {
                    content: this.newCommentContent,
                    commentable_id: this.newCommentCommentableId,
                    user_id: this.newCommentUser,
                    commentable_type: 'App\\Models\\Post',
                })
                .then(response =>  {
                    axios.get("{{ route('api.comments.list', ['parent_type'=>'App\\Models\\Post', 'parent_id'=>$post->id]) }}")
                    .then( response => {
                        this.commentsData = response.data;
                        this.newCommentContent = '';
                    })
                    .catch( response => {
                        console.log(response);
                    })
                })
                .catch(response => {
                    console.log(response);
                })

            },
            deletePost: function(){
                axios.delete("{{ route('Posts.Destroy', $post->id) }}")
                .then( response => {
                    window.location = "/posts";
                })
            }
        },
        mounted(){
            axios.get("{{ route('api.comments.list', ['parent_type'=>'App\\Models\\Post', 'parent_id'=>$post->id]) }}")
            .then( response => {
                this.commentsData = response.data;
            })
            .catch( response => {
                console.log(response);
            })
        },
    });
</script>

@endsection
