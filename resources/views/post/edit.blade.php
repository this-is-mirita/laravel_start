@extends('layouts.main')
@section('content')
<div class="container">
    <form action="{{route('post.update', $post->id)}}" method="post">
        @csrf
        @method('patch')
        <div class=" mb-3">
            <div class="col-sm-10">
                <label for="title" class="col-sm-2 col-form-label">title</label>
                <input name="title" type="text" class="form-control" id="title" placeholder="Title" value=" {{ $post->title }}">
            </div>
        </div>
        <div class=" mb-3">
            <div class="col-sm-10">
                <label for="Content" class="col-sm-2 col-form-label">Content</label>
                <textarea name="content" placeholder="Content" type="text" class="form-control" id="Content">{{ $post->content }} </textarea>
            </div>
        </div>
        <div class=" mb-3">
            <div class="col-sm-10">
                <label for="image" class="col-sm-2 col-form-label">Image</label>
                <input name="image" placeholder="Image" type="text" class="form-control" id="image" value=" {{ $post->image }}">
            </div>
        </div>
        <div>
            <label for="category">Category</label>
            <select class="form-control mb-2" id="category" name="category_id">
                @foreach($categories as $category)
                    <option
                        {{ $category->id === $post->category->id ? 'selected' : '' }}
                        value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="tags">Tags</label>
            <select multiple class="form-control mb-2" id="tags" name="tags[]">
                @foreach($tags as $tag)
                    <option
                        @foreach($post->tags as $postTag)
                            {{ $tag->id === $postTag->id ? 'selected' : '' }}
                        @endforeach
                        value="{{ $tag->id }}">{{ $tag->title }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
