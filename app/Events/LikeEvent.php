<?php

declare(strict_types=1);

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
        private readonly string $ideaId,
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
            'idea_id' => $this->ideaId,
            'user_id' => $this->userId,
            'is_liked' => $this->isLiked,
        ];
    }
}
