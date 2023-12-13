<?php

use App\Models\Idea;
use App\Models\User;
use Illuminate\Testing\TestResponse;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseEmpty;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\post;

function like(Idea|string $idea): TestResponse
{
    $id = $idea instanceof Idea ? $idea->id : $idea;

    return post("api/like/$id");
}

function unlike(Idea|string $idea): TestResponse
{
    $id = $idea instanceof Idea ? $idea->id : $idea;

    return post("api/unlike/$id");
}

it('user can like a idea of other user', function () {
    // Arrange
    actingAsUser();
    $idea = Idea::factory()->create();

    // Act
    like($idea);

    // Assert
    assertDatabaseCount('likes', 1);
    assertDatabaseHas('likes', [
        'user_id' => auth()->id(),
        'idea_id' => $idea->id,
    ]);
});

it('user can like different ideas', function () {
    // Arrange
    $user = User::factory()->create();
    $ideas = Idea::factory()->count(5)->create();

    // Act
    actingAs($user);
    $ideas->each(fn (Idea $idea) => like($idea));

    // Assert
    expect($ideas->pluck('id'))
        ->toEqualCanonicalizing(
            $user->likes->pluck('idea_id')
        );
});

it('user cannot like the same post twice', function () {
    // Arrange
    $user = actingAsUser();
    $idea = Idea::factory()->create();

    // Act & Assert
    like($idea)->assertCreated();
    like($idea)->assertForbidden();
});

it('user can unlike the post', function () {
    // Arrange
    actingAsUser();
    $idea = Idea::factory()->create();

    // Act
    like($idea);
    unlike($idea);

    // Assert
    assertDatabaseEmpty('likes');
});

it('user cannot unlike the same post twice', function () {
    // Arrange
    actingAsUser();
    $idea = Idea::factory()->create();

    // Act & Assert
    like($idea)->assertCreated();
    unlike($idea)->assertNoContent();
    unlike($idea)
        ->assertForbidden()
        ->assertSee("You do not like this post yet");
});
