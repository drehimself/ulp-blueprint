@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('post.title'))
            <div class="alert alert-success">
                {{ session('post.title') }}
            </div>
        @endif
        <ul>
            @foreach ($posts as $post)
                <li><a href="{{ route('post.show', $post->id) }}">{{ $post->title}}</a></li>
            @endforeach
        </ul>

        <a href="{{ route('post.create') }}" class="btn btn-primary">Create Post</a>
    </div>
@endsection
