<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Auth;

readonly class LoginCredentialsDto
{
    public function __construct(
        public string $email,
        public string $password,
    ) {
        //
    }
}
