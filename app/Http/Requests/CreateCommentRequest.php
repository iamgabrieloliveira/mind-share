<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\DataTransferObjects\Comments\CreateCommentDto;
use Illuminate\Foundation\Http\FormRequest;

class CreateCommentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'content' => 'required|string',
            'comment_id' => 'sometimes|exists:comments,id',
            'idea_id' => 'sometimes|exists:ideas,id',
        ];
    }

    public function toDto(): CreateCommentDto
    {
        return new CreateCommentDto(
            content: $this->validated('content'),
            userId: auth()->id(),
            commentId: $this->validated('comment_id'),
            ideaId: $this->validated('idea_id'),
        );
    }
}
