<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Events\LikeEvent;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\JsonResponse;

class LikeController extends Controller
{
    public function like(Post $post): JsonResponse
    {
        $alreadyLikeThisPost = $post
            ->likes()
            ->where('user_id', auth()->id())
            ->exists();

        if ($alreadyLikeThisPost) {
            return $this->forbidden('Your already like this post');
        }

        /** @var $like Like */
        $like = Like::query()->create([
            'user_id' => auth()->id(),
            'post_id' => $post->id,
        ]);

        broadcast(
            new LikeEvent($post->id, auth()->id())
        )->toOthers();

        return $this->created($like->getKey());
    }

    public function unlike(Post $post): JsonResponse
    {
        $like = $post->likes()->where('user_id', auth()->id())->first();

        if (is_null($like)) {
            return $this->forbidden('You do not like this post yet');
        }

        broadcast(
            new LikeEvent($post->id, auth()->id(), false)
        )->toOthers();

        $like->delete();

        return $this->noContent();
    }
}
