<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Idea */
class IdeaListResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => str($this->title)->slug(),
            'author' => $this->author->name,
            'content' => $this->content,
            'likes' => $this->likes()->pluck('user_id'),
            'created_at' => $this->created_at->format('d/m/Y'),
            'humanized_created_at' => $this->created_at->longRelativeToNowDiffForHumans(),
        ];
    }
}
