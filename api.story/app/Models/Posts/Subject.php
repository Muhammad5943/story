<?php

namespace App\Models\Posts;

use App\Models\Posts\Post;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
