<?php

declare(strict_types=1);

namespace App\Services;

use App\DataTransferObjects\Auth\CreateUserDto;
use App\DataTransferObjects\Auth\LoginCredentialsDto;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryContract;

class AuthenticationService
{
    public function __construct(
        private readonly UserRepositoryContract $userRepository,
    ) {
        //
    }

    public function register(CreateUserDto $dto): User
    {
        $user = $this->userRepository->create($dto);

        auth()->login($user);

        return $user;
    }

    public function login(LoginCredentialsDto $dto): bool
    {
        return auth()->attempt([
            'email' => $dto->email,
            'password' => $dto->password,
        ]);
    }

    public function logout(): void
    {
        auth()->logout();
    }
}
