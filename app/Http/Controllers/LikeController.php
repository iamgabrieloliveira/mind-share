<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\BusinessLogicException;
use App\Models\Idea;
use App\Services\LikeService;
use Illuminate\Http\JsonResponse;

class LikeController extends Controller
{
    public function __construct(
        private readonly LikeService $likeService,
    ) {
        //
    }

    /**
     * @throws BusinessLogicException
     */
    public function like(Idea $idea): JsonResponse
    {
        $like = $this->likeService->like(
            userId: auth()->id(),
            idea: $idea,
        );

        return $this->created($like->id);
    }

    /**
     * @throws BusinessLogicException
     */
    public function unlike(Idea $idea): JsonResponse
    {
        $this->likeService->unlike(
            userId: auth()->id(),
            idea: $idea,
        );

        return $this->noContent();
    }
}
