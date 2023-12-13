<?php

use App\Models\Idea;
use App\Models\User;
use Illuminate\Testing\TestResponse;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\post;

function createIdea(array $payload): TestResponse
{
    return post('api/ideas/create', $payload);
}

it('authenticated user can create a idea for it self', function () {
    // Arrange
    actingAsUser();
    $payload = [
        'title' => fake()->sentence,
        'content' => fake()->text,
    ];

    // Act
    createIdea($payload);

    // Assert
    assertDatabaseCount('users', 1);
    assertDatabaseHas('ideas', [
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
    createIdea($payload);

    // Assert
    assertDatabaseCount('ideas', 1);
    assertDatabaseHas('ideas', [
        'title' => $payload['title'],
        'content' => $payload['content'],
        'author_id' => auth()->id(),
    ]);
});

it('not authenticated user cannot create a post', function () {
    // Arrange
    assertGuest();

    // Act & Assert
    createIdea([
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
    createIdea($payload)->assertSessionHasErrors('title');
});

it('should not create an post without content', function () {
    // Arrange
    actingAsUser();

    $payload = [
        'title' => fake()->sentence,
    ];

    // Act & Assert
    createIdea($payload)->assertSessionHasErrors('content');
});

it('should list posts correctly', function () {
    Idea::factory()->count(5)->create();

    $response = actingAs(
        User::factory()->create()
    )->get('api/ideas/list');

    $posts = $response['ideas'];

    expect($posts)->toHaveCount(5);
});

it('should return pagination info in posts lists')->todo();

it('should order the posts by the number of likes')->todo();
