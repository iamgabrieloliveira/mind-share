<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\Like;
use App\Repositories\Contracts\LikeRepositoryContract;

class LikeEloquentRepository implements LikeRepositoryContract
{
    public function create(string $userId, string $ideaId): Like
    {
        /** @var $like Like */
        $like = Like::query()->create([
            'user_id' => $userId,
            'idea_id' => $ideaId,
        ]);

        return $like;
    }
}
