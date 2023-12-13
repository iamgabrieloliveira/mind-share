<?php

declare(strict_types=1);

namespace App\Http\Requests\Authentication;

use App\DataTransferObjects\Auth\LoginCredentialsDto;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string',
        ];
    }

    public function toDto(): LoginCredentialsDto
    {
        return new LoginCredentialsDto(
            email: $this->validated('email'),
            password: $this->validated('password'),
        );
    }
}
