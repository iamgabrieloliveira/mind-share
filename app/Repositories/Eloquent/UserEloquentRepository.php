<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\DataTransferObjects\Auth\CreateUserDto;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryContract;

class UserEloquentRepository implements UserRepositoryContract
{
    public function create(CreateUserDto $dto): User
    {
        /** @var $user User */
        $user = User::query()->create([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => $dto->password,
        ]);

        return $user;
    }
}
