<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Authentication\LoginRequest;
use App\Http\Requests\Authentication\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        $payload = $request->only('name', 'email', 'password');

        /** @var $user User */
        $user = User::query()->create($payload);

        auth()->login($user);

        return $this->created($user->id);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        $loggedIn = auth()->attempt($credentials);

        return $loggedIn
            ? $this->ok()
            : $this->unauthorized(__('wrong_credentials'));
    }

    public function check(): JsonResponse
    {
        return auth()->check()
            ? $this->ok(['user' => auth()->user()])
            : $this->unauthorized();
    }

    public function logout(): JsonResponse
    {
        auth()->logout();

        return $this->noContent();
    }

    public function me(): JsonResponse
    {
        return $this->ok([
            'user' => auth()->user(),
        ]);
    }
}
