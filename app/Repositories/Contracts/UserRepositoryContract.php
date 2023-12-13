<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\DataTransferObjects\Auth\CreateUserDto;
use App\Models\User;

interface UserRepositoryContract
{
    public function create(CreateUserDto $dto): User;
}
