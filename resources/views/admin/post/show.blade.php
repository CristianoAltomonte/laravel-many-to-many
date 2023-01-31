@extends('layouts.dashboard')

@section('content')
    <div class="container d-flex flex-column align-items-center">

        <img src="{{asset("storage/$post->cover")}}" class="img-fluid" alt="">

        <h2 class="mb-4">{{ $post->title }}</h2>

        @if ($post->category)
            {{ $post->category['name'] }}
        @endif

        <p>{{ $post->body }}</p>

    </div>
@endsection
