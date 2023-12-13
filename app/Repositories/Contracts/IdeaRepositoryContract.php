<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\DataTransferObjects\Ideas\CreateIdeaDto;
use App\Models\Idea;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface IdeaRepositoryContract
{
    public function create(CreateIdeaDto $dto): Idea;

    public function listPosts(): LengthAwarePaginator;
}
