<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Authentication\LoginRequest;
use App\Http\Requests\Authentication\RegisterRequest;
use App\Services\AuthenticationService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function __construct(
        private readonly AuthenticationService $authenticationService,
    ) {
        //
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $dto = $request->toDto();

        $user = $this->authenticationService->register($dto);

        return $this->created($user->id);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $dto = $request->toDto();

        $loggedIn = $this->authenticationService->login($dto);

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
        $this->authenticationService->logout();

        return $this->noContent();
    }

    public function me(): JsonResponse
    {
        return $this->ok([
            'user' => auth()->user(),
        ]);
    }
}
