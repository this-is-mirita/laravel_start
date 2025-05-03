@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Posts</h4>
            <a href="{{ route('post.create') }}" class="btn btn-primary">Add one</a>
        </div>

        <div class="list-group">
            @foreach($posts as $post)
                <a href="{{ route('post.show', $post->id) }}" class="list-group-item list-group-item-action">
                    <strong>#{{ $post->id }}</strong> - {{ $post->title }}
                </a>
            @endforeach
        </div>
        <div class="container mt-2">
            {{$posts -> withQueryString() -> links()}}
        </div>
    </div>
@endsection
