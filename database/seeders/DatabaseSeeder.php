<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Like::query()->delete();
        Post::query()->delete();
        User::query()->delete();

        User::factory()->state([
            'email' => 'my@email.com',
            'password' => Hash::make('password'),
        ])->create();

        $posts = Post::factory()
            ->count(100)
            ->create();

        $posts
            ->each(fn(Post $post, int $index) => Like::factory()
                ->count(fake()->numberBetween(5, 100))
                ->state([
                    'post_id' => $post->getKey(),
                    'user_id' => User::query()->skip($index)->first()->id,
                ])->create());
    }
}
