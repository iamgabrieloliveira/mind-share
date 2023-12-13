<?php

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use function Pest\Laravel\actingAs;

uses(
    TestCase::class,
    RefreshDatabase::class,
)->in('Feature');

function assertGuest(): \Pest\Expectation
{
    return expect(auth()->check())->toBeFalse();
}

function assertLoggedIn(Authenticatable $authenticatable): \Pest\Expectation
{
    return expect(auth()->check())->toBeTrue()
        ->and(auth()->user()->is($authenticatable))->toBeTrue();
}

function user(array $state = []): User
{
    return User::factory()->state($state)->create();
}

function actingAsUser(): \Illuminate\Foundation\Testing\TestCase
{
    return actingAs($user = user());
}
