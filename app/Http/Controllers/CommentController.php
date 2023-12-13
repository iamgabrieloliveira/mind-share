<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Services\CommentService;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    public function __construct(
        private readonly CommentService $commentsService,
    ) {
        //
    }

    public function store(CreateCommentRequest $request): JsonResponse
    {
        $dto = $request->toDto();

        $comment = $this->commentsService->create($dto);

        return $this->created($comment->id);
    }
}
