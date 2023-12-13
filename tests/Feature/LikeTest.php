<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Testing\TestResponse;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseEmpty;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\post;

function like(Post|string $post): TestResponse
{
    $id = $post instanceof Post ? $post->id : $post;

    return post("api/like/$id");
}

function unlike(Post|string $post): TestResponse
{
    $id = $post instanceof Post ? $post->id : $post;

    return post("api/unlike/$id");
}

it('user can like a post of other user', function () {
    // Arrange
    actingAsUser();
    $post = Post::factory()->create();

    // Act
    like($post);

    // Assert
    assertDatabaseCount('likes', 1);
    assertDatabaseHas('likes', [
        'user_id' => auth()->id(),
        'post_id' => $post->id,
    ]);
});

it('user can like differents posts', function () {
    // Arrange
    $user = User::factory()->create();
    $posts = Post::factory()->count(5)->create();

    // Act
    actingAs($user);
    $posts->each(fn (Post $post) => like($post));

    // Assert
    expect($posts->pluck('id'))
        ->toEqualCanonicalizing(
            $user->likes->pluck('post_id')
        );
});

it('user cannot like the same post twice', function () {
    // Arrange
    $user = actingAsUser();
    $post = Post::factory()->create();

    // Act & Assert
    like($post)->assertCreated();
    like($post)->assertForbidden();
});

it('user can unlike the post', function () {
    // Arrange
    actingAsUser();
    $post = Post::factory()->create();

    // Act
    like($post);
    unlike($post);

    // Assert
    assertDatabaseEmpty('likes');
});

it('user cannot unlike the same post twice', function () {
    // Arrange
    actingAsUser();
    $post = Post::factory()->create();

    // Act & Assert
    like($post)->assertCreated();
    unlike($post)->assertNoContent();
    unlike($post)
        ->assertForbidden()
        ->assertSee("You do not like this post yet");
});
