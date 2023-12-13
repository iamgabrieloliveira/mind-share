<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCommentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'content' => 'required|string',
            'comment_id' => 'sometimes|exists:comments,id',
            'post_id' => 'sometimes|exists:posts,id',
        ];
    }
}
