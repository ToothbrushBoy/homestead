@extends('layouts.app')

@section('title', 'Comment by' . $comment->user->name)

@section('user', $comment->user->name)

@section('header')

<h2>By @yield('user')</h2>
<h3>{{$comment->content}}</h3>

@endsection

@section('commentBox')

<input v-model="newCommentContent" placeholder="Comment" max="512">

<div v-if="newCommentContent.length >= 1 && newCommentContent.length <= 512">
    <button @click="makeComment">Post</button>
</div>
<div v-else><button disabled>Post</button></div>

@endsection

@section('content')

<div id="root">

    <div>

        @if ($currentUser->id == $comment->user->id || $currentUser->admin == 1)
            <button @click="deleteComment">Delete</button>
        @endif

    </div>

    @yield('commentBox')

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
            newCommentCommentableId: {{ $comment->id }},
            newCommentUser: {{ $currentUser->id }},
            userName: "{{ $currentUser->name }}",
            newCommentCommentableType: "App\\Models\\Comment",
        },
        methods: {
            makeComment: function(){

                axios.post("{{ route('api.comments.store') }}", {
                    content: this.newCommentContent,
                    commentable_id: this.newCommentCommentableId,
                    user_id: this.newCommentUser,
                    commentable_type: this.newCommentCommentableType,
                })
                .then(response =>  {
                    axios.get("{{ route('api.comments.list', ['parent_type'=>'App\\Models\\Comment', 'parent_id'=>$comment->id]) }}")
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
            deleteComment: function(){
                axios.delete("{{ route('Comments.Destroy', $comment->id) }}")
                .then( response => {
                    window.location = "/posts";
                })
            }
        },
        mounted(){
            axios.get("{{ route('api.comments.list', ['parent_type'=>'App\\Models\\Comment', 'parent_id'=>$comment->id]) }}")
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