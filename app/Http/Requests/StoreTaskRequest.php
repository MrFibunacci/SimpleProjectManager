<?php

namespace App\Http\Requests;

use App\Enum\Task;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
//        return Auth::user()->can('create', Task::class);
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => Task::TITLE->validationRules(),
            'description' => Task::DESCRIPTION->validationRules(),
            'due_date' => Task::DUE_DATE->validationRules(),
            'completed' => Task::COMPLETED->validationRules(),
            'project_id' => Task::PROJECT_ID->validationRules(),
        ];
    }
}
