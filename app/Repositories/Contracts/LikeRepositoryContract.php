<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Models\Like;

interface LikeRepositoryContract
{
    public function create(string $userId, string $ideaId): Like;
}
