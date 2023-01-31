@extends('layouts.dashboard')

@section('content')
    <div class="container p-5">

        <h1 class="text-center p-4">Crea un Post</h1>

        <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">

            @csrf

            <div class="mb-3">
                <label class="form-label">Titolo</label>
                <input name="title" type="text" class="form-control @error('title') is-invalid @enderror">
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Descrizione</label>
                <textarea name="body" class="form-control @error('body') is-invalid @enderror"></textarea>
                @error('body')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Categoria</label>
                <select class="form-control" name="category_id" id="">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Tags: </label>

                @foreach ($tags as $tag)
                    <label for="">
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}">
                        {{ $tag->name }}
                    </label>
                @endforeach

            </div>
            <div class="my-3">
                <label for="">Aggiunta cover image</label>
                <input type="file" name="image" class="form-control-file">
            </div>

            <button type="submit" class="btn btn-primary">Crea Post</button>

        </form>

    </div>
@endsection
