<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\DataTransferObjects\Ideas\CreateIdeaDto;
use App\Models\Idea;
use App\Repositories\Contracts\IdeaRepositoryContract;
use Illuminate\Pagination\LengthAwarePaginator;

class IdeaEloquentRepository implements IdeaRepositoryContract
{
    public function create(CreateIdeaDto $dto): Idea
    {
        /** @var $idea Idea */
        $idea = Idea::query()->create([
            'title' => $dto->title,
            'content' => $dto->content,
            'author_id' => $dto->authorId,
        ]);

        return $idea;
    }

    public function listPosts(): LengthAwarePaginator
    {
        return Idea::query()->with([
            'author'
        ])->paginate();
    }
}
