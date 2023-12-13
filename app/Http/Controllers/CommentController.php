<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    public function store(CreateCommentRequest $request): JsonResponse
    {
        /** @var $comment Comment */
        $comment = Comment::query()->create(array_merge(
            $request->validated(),
            ['user_id' => auth()->id()]
        ));

        return $this->created($comment->id);
    }
}
