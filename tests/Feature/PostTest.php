<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Testing\TestResponse;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\post;

function createPost(array $payload): TestResponse
{
    return post('api/posts/create', $payload);
}

it('authenticated user can create a post for it self', function () {
    // Arrange
    actingAsUser();
    $payload = [
        'title' => fake()->sentence,
        'content' => fake()->text,
        'author_id' => auth()->id(),
    ];

    // Act
    createPost($payload);

    // Assert
    assertDatabaseCount('users', 1);
    assertDatabaseHas('posts', [
        'title' => $payload['title'],
        'content' => $payload['content'],
    ]);
});

it('authenticated user can create a post for other user if he is admin', function () {
    // Arrange
    actingAsUser();
    $payload = [
        'title' => fake()->sentence,
        'content' => fake()->text,
    ];

    // Act
    createPost($payload);

    // Assert
    assertDatabaseCount('posts', 1);
    assertDatabaseHas('posts', [
        'title' => $payload['title'],
        'content' => $payload['content'],
        'author_id' => auth()->id(),
    ]);
});

it('not authenticated user cannot create a post', function () {
    // Arrange
    assertGuest();

    // Act & Assert
    createPost([
        'title' => fake()->sentence,
        'content' => fake()->text,
    ])->assertUnauthorized();
});

it('should not create an post without title', function () {
    // Arrange
    actingAsUser();

    $payload = [
        'content' => fake()->text,
    ];

    // Act & Assert
    createPost($payload)->assertSessionHasErrors('title');
});

it('should not create an post without content', function () {
    // Arrange
    actingAsUser();

    $payload = [
        'title' => fake()->sentence,
    ];

    // Act & Assert
    createPost($payload)->assertSessionHasErrors('content');
});

it('should list posts correctly', function () {
    Post::factory()->count(5)->create();

    $response = actingAs(
        User::factory()->create()
    )->get('api/posts/list');

    $posts = $response['posts'];

    expect($posts)->toHaveCount(5);
});

it('should return pagination info in posts lists')->todo();

it('should order the posts by the number of likes')->todo();
