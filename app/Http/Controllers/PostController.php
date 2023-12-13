<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Models\Post;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    public function create(CreatePostRequest $request): JsonResponse
    {
        /** @var $post Post */
        $post = Post::query()->create([
            ...$request->validated(),
            'author_id' => auth()->id(),
        ]);

        return $this->created($post->id);
    }

    public function get(Post $post): JsonResponse
    {
        return $this->ok([
            'idea' => $post->loadMissing(['author', 'comments.user']),
        ]);
    }

    public function list(): JsonResponse
    {
        // todo: optimize this query
        $query = Post::query()
            ->with(['likes', 'author'])
            ->withCount('likes')
            ->orderByDesc('likes_count')
            ->latest()
            ->paginate();

        return $this->ok([
            'pagination' => [
                'total' => $query->total(),
                'next_url' => $query->nextPageUrl(),
                'page' => $query->currentPage(),
                'has_more_pages' => $query->hasMorePages(),
            ],
            'posts' => collect($query->items())->map(fn(Post $post) => [
                'id' => $post->id,
                'title' => $post->title,
                'slug' => str($post->title)->slug(),
                'author' => $post->author->name,
                'content' => $post->content,
                'likes' => $post->likes()->pluck('user_id'),
                'created_at' => $post->created_at->format('d/m/Y'),
                'humanized_created_at' => $post->created_at->longRelativeToNowDiffForHumans(),
            ]),
        ]);
    }
}
