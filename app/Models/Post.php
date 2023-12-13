<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $uuid
 * @property string $title
 * @property string $content
 * @property Carbon $published_at
 * @property string $author_id
 * @property Carbon $created_at
 * @property-read Collection<Like> $likes
 * @property-read User $author
 * @method static Builder wasLikedBy(int $userId)
*/
class Post extends BaseModel
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'author_id'];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function wasLikedBy(int $userId): bool
    {
        return $this
            ->likes()
            ->where('user_id', $userId)
            ->exists();
    }

    public function scopeWasLikedBy(Builder $query, int $userId): Builder
    {
        return $query
            ->whereHas(
                'likes',
                fn (Builder $q) => $q->where('user_id', $userId)
            );
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
