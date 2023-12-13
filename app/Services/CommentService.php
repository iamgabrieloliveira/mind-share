<?php

declare(strict_types=1);

namespace App\Services;

use App\DataTransferObjects\Comments\CreateCommentDto;
use App\Models\Comment;
use App\Repositories\Contracts\CommentRepositoryContract;

class CommentService
{
    public function __construct(
      private readonly CommentRepositoryContract $commentRepository,
    ) {
        //
    }

    public function create(CreateCommentDto $dto): Comment
    {
        return $this->commentRepository->create($dto);
    }
}
