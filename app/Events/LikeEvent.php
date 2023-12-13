<?php

namespace App\Events;

use App\Enums\ChannelEnum;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LikeEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        private readonly string $postId,
        private readonly string $userId,
        private readonly bool $isLiked = true,
    ) {
        //
    }

    public function broadcastOn(): Channel
    {
        return new Channel(ChannelEnum::Feed->value);
    }

    public function broadCastWith(): array
    {
        return [
            'post_id' => $this->postId,
            'user_id' => $this->userId,
            'is_liked' => $this->isLiked,
        ];
    }
}
