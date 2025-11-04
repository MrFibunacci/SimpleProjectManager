<?php

namespace App\Http\Requests;

use App\Enum\Project;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => Project::NAME->validationRules(),
            'description' => Project::DESCRIPTION->validationRules(),
            'due_date' => Project::DUE_DATE->validationRules(),
            'status' => Project::STATUS_ID->validationRules(),
        ];
    }
}
