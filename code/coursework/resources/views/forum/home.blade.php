@extends('layouts.app')

@section('header')

<h1>Cat reviews</h1>
<h3><a href="{{ route('Posts.List') }}">All posts</a></h3>

@endsection

@section('content')

<div id="root">

    <button @click="toggleCatImg">Cat?</button>
    <div v-if="catToggle === 1">
        <a href="{{ route('home') }}"><img src="{{ $catUrl }}" style="width:500px"></a>
    </div>

</div>

@endsection

@section('script')

<script>

    var vue = new Vue({
        el: "#root",
        data: {
            catToggle: 0,
        },
        methods: {
            toggleCatImg: function(){
                if (this.catToggle === 0){
                    this.catToggle = 1;
                } else {
                    this.catToggle = 0;
                }
            }
        }
    })

</script>

@endsection