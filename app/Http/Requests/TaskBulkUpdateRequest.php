<?php

namespace App\Http\Requests;

use App\Enums\TaskStatusTypes;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskBulkUpdateRequest extends FormRequest
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
            'tasks' => 'required|array',
            'tasks.*.id' => [
                'required'
            ],
            'tasks.*.task_name' => [
                'string',
                'max:255',
            ],
            'tasks.*.description' => [
                'string',
                'max:255',
            ],
            'tasks.*.due_date' => [
                'date'
            ],
            'tasks.*.assigned_to' => [
                'exists:users,id',
            ],
            'tasks.*.status' => [
                Rule::enum(TaskStatusTypes::class),
            ],
        ];
    }
}
