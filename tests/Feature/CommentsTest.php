<?php

declare(strict_types=1);

use App\Models\Comment;
use App\Models\Idea;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\post;

it('guest should not create an comment for other comment', function () {
    // Arrange
    assertGuest();

    // Act & Assert
    post('api/comments')->assertUnauthorized();
});

it('user can create an comment for idea', function () {
    // Arrange
    actingAs($user = User::factory()->create());

    // Act
    $response = post('api/comments', [
        'content' => fake()->word(),
        'idea_id' => Idea::factory()->create()->getKey(),
    ]);

    // Assert
    $response->assertCreated();
});

it('user can create an comment answer for other comment', function () {
    // Arrange
    actingAs(User::factory()->create());

    $comment = Comment::factory()->create();

    // Act
    $response = post('api/comments', [
        'content' => fake()->word(),
        'comment_id' => $comment->id,
    ]);

    // Assert
    $response->assertCreated();
});

it('user can delete an comment for idea')->todo();

it('user can delete an comment answer for other comment')->todo();
