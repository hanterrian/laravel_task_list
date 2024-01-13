<?php

namespace App\Http\Requests\Task;

use App\Enum\TaskStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskFilterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'status' => [Rule::enum(TaskStatus::class)],
            'priority' => ['numeric', 'min:0', 'max:5'],
            'title' => ['string', 'max:255'],
            'description' => ['string', 'max:5000'],
            'sort' => ['array'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
