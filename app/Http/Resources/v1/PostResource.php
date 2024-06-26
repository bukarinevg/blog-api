<?php

namespace App\Http\Resources\v1;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug'=> $this->slug,
            'content'=> $this->content,
            'type'=> $this->type,
            'publishedAt' => $this->published_at  instanceof \DateTime ?  $this->published_at->format('F d, Y') : null,
            'comments' => CommentResource::collection($this->whenLoaded('comments')),
        ];
    }
}
