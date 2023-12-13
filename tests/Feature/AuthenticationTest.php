<?php

use App\Models\User;
use Illuminate\Testing\TestResponse;
use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas, get, post};

function register(array $payload = []): TestResponse
{
    return post('api/auth/register', $payload);
}

function login(array $payload = []): TestResponse
{
    return post('api/auth/login', $payload);
}

function check(): TestResponse
{
    return get('api/auth/check');
}

function logout(): TestResponse
{
    return post('api/auth/logout');
}

it('should register new user', function () {
    // Arrange
    $payload = [
        'name' => fake()->name,
        'email' => fake()->safeEmail,
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ];

    // Act
    register($payload)->assertCreated();

    // Assert
    assertDatabaseCount('users', 1);
    assertDatabaseHas('users', [
        'name' => $payload['name'],
        'email' => $payload['email'],
    ]);
});

it('should not register new user without name', function () {
    // Arrange
    $password = fake()->password(8);

    $payload = [
        'email' => fake()->email,
        'password' => $password,
        'password_confirmation' => $password,
    ];

    // Act & Assert
    register($payload)
        ->assertFound()
        ->assertSessionHasErrors(['name']);
});

it('should not register new user without email', function () {
    // Arrange
    $password = fake()->password(8);

    $payload = [
        'name' => fake()->name,
        'password' => $password,
        'password_confirmation' => $password,
    ];

    // Act & Assert
    register($payload)
        ->assertFound()
        ->assertSessionHasErrors(['email']);
});

it('should not register new user without password', function () {
    // Arrange
    $payload = [
        'name' => fake()->name,
        'email' => fake()->email,
    ];

    // Act & Assert
    register($payload)
        ->assertFound()
        ->assertSessionHasErrors(['password']);
});

it('should not register new user when password doesn\'t match', function () {
    // Arrange
    $payload = [
        'name' => fake()->name,
        'email' => fake()->email,
        'password' => 'password123',
        'password_confirmation' => '123password',
    ];

    // Act & Assert
    register($payload)
        ->assertFound()
        ->assertSessionHasErrors(['password']);
});

it('should not register two users with same email', function () {
    // Arrange
    user(['email' => 'duplicated@email.com']);

    $payload = [
        'name' => fake()->name,
        'email' => 'duplicated@email.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ];

    // Act & Assert
    register($payload)
        ->assertFound()
        ->assertSessionHasErrors('email');
});

it('should authenticate user', function () {
    // Arrange
    $user = User::factory()->state(['password' => 'password123'])->create();
    assertGuest();

    // Act
    login([
        'email' => $user->email,
        'password' => 'password123',
    ]);

    // Assert
    assertLoggedIn($user);
});

it('should not authenticate user with invalid credentials', function () {
    // Arrange
    assertGuest();
    user([
        'email' => 'email@correct.com',
        'password' => 'correct-passwrd',
    ]);

    // Act
    login([
        'email' => 'email@correct.com',
        'password' => 'invalid-password',
    ]);

    // Assert
    assertGuest();
});

it('should ensure when user is authenticated', function () {
    // Arrange
    assertGuest();
    actingAsUser();

    // Act & Assert
    check()->assertOk();
});

it('should ensure when user is not authenticated', function () {
    // Arrange
    assertGuest();

    // Act & Assert
    check()->assertUnauthorized();
});

it('should logout user', function () {
    // Arrange
    $user = actingAsUser();

    // Act
    logout($user);

    // Assert
    assertGuest();
});
