<?php

declare(strict_types=1);

namespace App\Services;

use App\DataTransferObjects\Ideas\CreateIdeaDto;
use App\Models\Idea;
use App\Repositories\Contracts\IdeaRepositoryContract;
use Illuminate\Pagination\LengthAwarePaginator;

class IdeaService
{
    public function __construct(
        private readonly IdeaRepositoryContract $ideaRepository,
    ) {
    }

    public function create(CreateIdeaDto $dto): Idea
    {
        return $this->ideaRepository->create($dto);
    }

    public function listIdeas(): LengthAwarePaginator
    {
        return $this->ideaRepository->listPosts();
    }
}
