<?php

namespace App\Http\Requests\Admin\Major;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'major_name' => 'required|min:5|max:100|',
            'description' => 'required|min:5|max:250'
        ];
    }

    public function messages (): array {
        return [
            'major_name.required' => 'Please input Major name.',
            'major_name.min' => 'Major name must be more than 5 character.',
            'major_name.max' => 'Major name is too long. Please input under 250 character.',
            'description.required' => 'Please input Description.',
            'description.max' => 'Description is too long. Please input under 250 character.',

        ];
    }
}
