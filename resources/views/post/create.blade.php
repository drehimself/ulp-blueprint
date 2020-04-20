@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('post.store') }}" method="POST">
            @csrf
            <div>
                <div>
                    <label for="title">Title</label>
                </div>
                <input type="text" name="title">
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <div>
                    <label for="content">Content</label>
                </div>
                <textarea name="content" id="content" cols="30" rows="10"></textarea>
                @error('content')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <button type="submit">Create Post</button>
            </div>
        </form>
    </div>
@endsection
