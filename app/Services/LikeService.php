<?php

declare(strict_types=1);

namespace App\Services;

use App\Events\LikeEvent;
use App\Exceptions\BusinessLogicException;
use App\Models\Idea;
use App\Models\Like;
use App\Repositories\Contracts\LikeRepositoryContract;

class LikeService
{
    public function __construct(
      private readonly LikeRepositoryContract $likeRepository,
    ) {
        //
    }

    /**
     * @throws BusinessLogicException
     */
    public function like(string $userId, Idea $idea): Like
    {
        if ($idea->wasLikedBy($userId)) {
            throw new BusinessLogicException('You already like this post');
        }

        $like = $this->likeRepository->create($userId, $idea->id);

        $this->dispatchLikeEvent($idea->id, $userId, true);

        return $like;
    }

    /**
     * @throws BusinessLogicException
     */
    public function unlike(string $userId, Idea $idea): void
    {
        $like = $idea->findUserLike($userId);

        if (is_null($like)) {
            throw new BusinessLogicException('You do not like this post yet');
        }

        $this->dispatchLikeEvent(
            $idea->id,
            $userId,
            false,
        );

        $like->delete();
    }

    private function dispatchLikeEvent(string $postId, string $userId, bool $liked): void
    {
        $event = new LikeEvent(
            $postId,
            $userId,
            $liked,
        );
        broadcast($event)->toOthers();
    }
}
