<?php

namespace App\Http\Controllers\Posts;

use App\Models\Posts\Post;
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
}
