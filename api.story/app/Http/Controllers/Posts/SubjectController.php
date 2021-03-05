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
        return new PostCollection($subject->posts);
    }
}
