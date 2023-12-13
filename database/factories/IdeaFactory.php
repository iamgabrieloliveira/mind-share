<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\User;
use App\Models\Idea;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Idea>
*/
class IdeaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(5),
            'content' => str(fake()->randomHtml)->markdown(),
            'author_id' => User::factory(),
        ];
    }
}
