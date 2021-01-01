@extends('layouts.app')

@section('title', $post->postTitle)

@section('user', $post->user->name)

@section('created', $post->created_at)

@section('updated', $post->updated_at)

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

    <div>{{ $post->postContent }}</div>

    <p>
    <h3>Comments</h3>
    <p>

    <div id="comments">
        <ul style="list-style-type:none;">
            <li v-for="comment in comments">
                <p>@{{ comment.content }}</p>
                <p>@{{ comment.userName }} at @{{ comment.created_at }}</p>
            </li>
        </ul>
    </div>
@endsection

@section('script')

<script>
    var commentsVue = new Vue({
        el: "#comments",
        data: {
            comments: [],
        },
        mounted(){
            axios.get("{{ route('api.comments.list', $post->id) }}")
            .then( response => {
                this.comments = response.data;
            })
            .catch( response => {
                console.log(response);
            })
        },
    });
</script>

@endsection
