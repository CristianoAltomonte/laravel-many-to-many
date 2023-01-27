@extends('layouts.dashboard')

@section('content')
    <div class="container p-5">

        <h1 class="text-center p-4">Crea un Post</h1>

        <form method="POST" action="{{ route('admin.posts.store') }}">

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

            <button type="submit" class="btn btn-primary">Crea Post</button>

        </form>

    </div>
@endsection
