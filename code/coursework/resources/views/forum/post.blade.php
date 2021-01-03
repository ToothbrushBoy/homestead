@extends('layouts.app')

@section('title', $post->postTitle)

@section('user', $post->user->name)

@section('created', $post->created_at)

@section('updated', $post->updated_at)

@section('cat')
<img src="{{ $post->cat }}" style="width:500px">
@endsection

@section('commentBox')

<input v-model="newCommentContent" placeholder="Comment" max="255">

<div v-if="newCommentContent.length >= 1 && newCommentContent.length <= 255">
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

        <p></p>
        @yield('commentBox')

        <p>
            <h3>Comments</h3>
        <p>

        <ul style="list-style-type:none;">
            <li v-for="comment in commentsData">
                <p>@{{ comment.content }}</p>
                <p>@{{ comment.userName }} at @{{ comment.created_at }}</p>
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
                    post_id: this.newCommentCommentableId,
                    user_id: this.newCommentUser,
                })
                .then(response =>  {
                    axios.get("{{ route('api.comments.list', $post->id) }}")
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

            }
        },
        mounted(){
            axios.get("{{ route('api.comments.list', $post->id) }}")
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
