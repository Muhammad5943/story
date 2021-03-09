<?php

namespace App\Models\Posts;

use App\User;
// use App\Models\Posts\Subject;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
