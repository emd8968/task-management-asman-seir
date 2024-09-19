<?php

namespace App\Http\Requests;

use App\Enums\TaskStatusTypes;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'task_name' => [
                'required',
                'string',
                'max:255',
            ],
            'description' => [
                'string',
                'max:255',
            ],
            'due_date' => [
                'date'
            ],
            'assigned_to' => [
                'required',
                'exists:users,id',
            ],
            'status' => [
                'required',
                Rule::enum(TaskStatusTypes::class),
            ],
        ];
    }
}
