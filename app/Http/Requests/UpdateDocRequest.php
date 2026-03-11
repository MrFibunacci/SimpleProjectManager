<?php

namespace App\Http\Requests;

use App\Models\Doc;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateDocRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $project = $this->route('project');
        $doc = $this->route('doc');

        return Auth::check()
            && $project->users()->where('user_id', Auth::id())->exists()
            && Doc::where('project_id', $project->id)->where('id', $doc->id)->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'content' => 'required|string|max:4294967295|min:1',
        ];
    }
}
