<?php

declare(strict_types=1);

namespace App\Http\Requests\Comment;

use App\Enum\CommentStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CommentStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'status' => ['required', Rule::enum(CommentStatus::class)],
            'comment' => ['required', 'string', 'max:50000'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
