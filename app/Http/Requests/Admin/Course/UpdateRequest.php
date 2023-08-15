<?php

namespace App\Http\Requests\Admin\Course;

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
            'course_name' => 'required|min:3|max:250|',
            'description' => 'required|min:5|max:250',
            'major_id' => 'required|exists:majors,major_id'
        ];
    }

    public function messages (): array {
        return [
            'course_name.required' => 'Please input Course name.',
            'course_name.min' => 'Course name must be more than 3 character.',
            'course_name.max' => 'Course name is too long. Please input under 250 character.',
            'description.required' => 'Please input Description.',
            'description.max' => 'Description is too long. Please input under 250 character.',
            'major_id.exists' => 'Please select Major.',
        ];
    }
}
