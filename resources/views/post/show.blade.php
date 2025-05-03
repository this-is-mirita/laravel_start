@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <div class="card p-4 shadow">
            <h5 class="card-title">#{{ $post->id }} - {{ $post->title }}</h5>
            <p class="card-text">{{ $post->content }}</p>
            @if ($post->img)
                <img src="{{ asset('storage/' . $post->img) }}" class="img-fluid rounded" alt="Post Image">
            @endif

            <div class="d-flex gap-2 mt-3">
                <a href="{{ route('post.edit', $post->id) }}" class="btn btn-primary">Edit</a>

                <form action="{{ route('post.delete', $post->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>

                <a href="{{ route('post.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
@endsection
