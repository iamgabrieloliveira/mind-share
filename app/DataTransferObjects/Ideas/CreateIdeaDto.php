<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Ideas;

readonly class CreateIdeaDto
{
    public function __construct(
        public string $title,
        public string $content,
        public string $authorId,
    ) {
        //
    }
}
