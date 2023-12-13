<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\DataTransferObjects\Ideas\CreateIdeaDto;
use Illuminate\Foundation\Http\FormRequest;

class CreateIdeaRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'string|required',
            'content' => 'string|required',
        ];
    }

    public function toDto(): CreateIdeaDto
    {
        return new CreateIdeaDto(
            title: $this->validated('title'),
            content: $this->validated('content'),
            authorId: auth()->id(),
        );
    }
}
