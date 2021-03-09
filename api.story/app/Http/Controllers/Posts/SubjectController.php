<?php

namespace App\Http\Controllers\Posts;

use Illuminate\Http\Request;
use App\Models\Posts\Subject;
use App\Http\Controllers\Controller;
use App\Http\Resources\Posts\PostCollection;

class SubjectController extends Controller
{
    public function show(Subject $subject)
    {
        $posts = $subject->posts()->latest()->paginate(request('perPage'));

        return (new PostCollection($posts))->additional(['subject' => $subject]);
    }
}
