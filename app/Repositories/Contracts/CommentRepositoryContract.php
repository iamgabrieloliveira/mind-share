<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\DataTransferObjects\Comments\CreateCommentDto;
use App\Models\Comment;

interface CommentRepositoryContract
{
    public function create(CreateCommentDto $dto): Comment;
}
