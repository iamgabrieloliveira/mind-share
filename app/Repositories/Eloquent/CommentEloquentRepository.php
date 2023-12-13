<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\DataTransferObjects\Comments\CreateCommentDto;
use App\Models\Comment;
use App\Repositories\Contracts\CommentRepositoryContract;

class CommentEloquentRepository implements CommentRepositoryContract
{
    public function create(CreateCommentDto $dto): Comment
    {
        /** @var $comment Comment */
        $comment = Comment::query()->create([
            'content' => $dto->content,
            'user_id' => $dto->userId,
            'idea_id' => $dto->ideaId,
            'comment_id' => $dto->commentId,
        ]);

        return $comment;
    }
}
