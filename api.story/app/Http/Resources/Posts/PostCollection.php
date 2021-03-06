<?php

namespace App\Http\Resources\Posts;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => collect($this->collection)->map(function ($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'slug' => $post->slug,
                    'body' => \Str::limit($post->body, 100),
                    'author' => $post->user,
                    'gravatar' => $post->user->gravatar(),
                    'user_id' => $post->user_id,
                    'subject' => $post->subject,
                    'publish' => $post->created_at->format('d F, Y')
                ];
            }),

            'hasMorePages' => $this->hasMorePages()
        ];
    }
}
