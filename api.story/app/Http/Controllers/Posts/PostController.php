<?php

namespace App\Http\Controllers\Posts;

use App\Models\Posts\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Posts\Subject;
use App\Http\Controllers\Controller;
use App\Http\Resources\Posts\PostResource;
use App\Http\Resources\Posts\PostCollection;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'subject'])->latest()->paginate(request('perPage'));

        // return PostResource::collection($posts);
        return new PostCollection($posts);
    }

    public function show(Subject $subject, Post $post)
    {
        return new PostResource($post);
    }

    public function store()
    {
        // dd('store');
        $this->requestValidate();

        auth()->user()->posts()->create([
            'title' => request('title'),
            'slug' => \Str::slug('title') . \Str::random(6),
            'body' => request('body'),
            'subject_id' => request('subject')
        ]);

        return response()->json(['success' => 'The post was created']);
    }

    public function update(Post $post)
    {
        $this->requestValidate();

        $post->update([
            'title' => request('title'),
            'body' => request('body'),
            'subject_id' => request('subject')
        ]);

        return response()->json(['success' => 'The post was updated']);

        // return $post;
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json(['data' => "was deleted"]);
    }

    public function requestValidate()
    {
        return request()->validate([
            'title' => 'required|min:6',
            'body' => 'required',
            'subject' => 'required'
        ]);
    }
}
