@extends('layouts.main')

@section('content')
    <div class="container">
        <form action="{{ route('post.store') }}" method="POST">
            @csrf

            {{-- Title --}}
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input name="title" type="text"
                       class="form-control @error('title') is-invalid @enderror"
                       id="title" placeholder="Title" value="{{ old('title') }}">
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Content --}}
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea name="content"
                          class="form-control @error('content') is-invalid @enderror"
                          id="content" rows="4" placeholder="Content">{{ old('content') }}</textarea>
                @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Image --}}
            <div class="mb-3">
                <label for="image" class="form-label">Image URL</label>
                <input name="image" type="text"
                       class="form-control @error('image') is-invalid @enderror"
                       id="image" placeholder="Image URL" value="{{ old('image') }}">
                @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Category --}}
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-control @error('category_id') is-invalid @enderror"id="category" name="category_id">
                    <option value="">Choose category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->title }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tags --}}
            <div class="mb-3">
                <label for="tags" class="form-label">Tags</label>
                <select multiple class="form-control @error('tags') is-invalid @enderror"
                        id="tags" name="tags[]">
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}"
                            {{ collect(old('tags'))->contains($tag->id) ? 'selected' : '' }}>
                            {{ $tag->title }}
                        </option>
                    @endforeach
                </select>
                @error('tags')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            {{-- Submit --}}
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
