<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Comments;

readonly class CreateCommentDto
{
    public function __construct(
        public string $content,
        public string $userId,
        public ?string $commentId,
        public ?string $ideaId,
    ) {
        //
    }
}
