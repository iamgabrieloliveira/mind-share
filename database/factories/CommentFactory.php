<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Comment>
 */
class CommentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
//            'comment_id' => Comment::factory()->create()->getKey(), Recursion
            'post_id' => Post::factory(),
            'content' => fake()->randomHtml(),
        ];
    }
}
