<?php

namespace App\Http\Controllers;

use App\Events\NewPost;
use App\Http\Requests\PostStoreRequest;
use App\Jobs\SyncMedia;
use App\Mail\ReviewNotification;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::all();

        return view('post.index', compact('posts'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Post $post)
    {
        return view('post.show', compact('post'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('post.create');
    }

    /**
     * @param \App\Http\Requests\PostStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {
        $post = Post::create($request->all());

        // Mail::to($post->author)->send(new ReviewNotification($post));

        SyncMedia::dispatch($post);

        event(new NewPost($post));

        $request->session()->flash('post.title', 'Post Created: '.$post->title);

        return redirect()->route('post.index');
    }
}
