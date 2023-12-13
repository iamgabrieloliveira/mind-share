<?php

declare(strict_types=1);

use App\Models\Comment;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\post;

it('guest should not create an comment for other commment', function () {
    // Arrange
    assertGuest();

    // Act & Assert
    post('api/comments')->assertUnauthorized();
});

it('user can create an comment for post', function () {
    // Arrange
    actingAs($user = User::factory()->create());

    // Act
    $response = post('api/comments', [
        'content' => fake()->word(),
        'post_id' => \App\Models\Post::factory()->create()->getKey(),
    ]);

    // Assert
    $response->assertCreated();
});

it('user can create an comment answer for other commment', function () {
    // Arrange
    actingAs($user = User::factory()->create());

    $comment = Comment::factory()->create();

    // Act
    $response = post('api/comments', [
        'content' => fake()->word(),
        'comment_id' => $comment->id,
    ]);

    // Assert
    $response->assertCreated();
});

it('user can delete an comment for post')->todo();

it('user can delete an comment answer for other comment')->todo();
