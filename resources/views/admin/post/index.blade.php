@extends('layouts.dashboard')

@section('content')
    <div class="container d-flex flex-column align-items-center">

        <a class="btn btn-success mb-4" href="{{ route('admin.posts.create') }}">
            <h4 class="m-0">Crea un nuovo Post</h4>
        </a>

        @foreach ($posts as $post)
            <div class="rounded-pill card p-4 m-3" style="width: 40rem;">

                <div class="card-body">
                    <h2 class="card-title text-center">{{ $post->title }}</h2>
                    <p class="card-text">{{ $post->body }}</p>

                    @if ($post->category)
                       {{ $post->category['name'] }}
                    @endif


                    <div class="d-flex justify-content-between">

                        <div>
                            <a href="{{ route('admin.posts.show', $post->id) }}" class="btn btn-primary m-2">Mostra Post</a>
                        </div>
                        <div>
                            <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-warning m-2">Modifica
                                Post</a>
                        </div>
                        {{-- <a href="{{route('admin.post.show', $post->id)}}" class="btn btn-primary">Open Post</a> --}}
                        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger m-2">Elimina Post</button></a>

                        </form>

                    </div>

                </div>
            </div>
        @endforeach


    </div>
    <div class="d-flex justify-content-center">
        {{ $posts->links() }}

    </div>
@endsection
