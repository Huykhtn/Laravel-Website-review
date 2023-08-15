<?php

namespace App\Http\Requests\Admin\Exam;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'course_id' => 'required|exists:lessons,course_id',
            'exam_name' => 'required|min:5|max:250',
            'file' => 'required|mimes:txt,docx,xlx,xls,pdf|max:2048'
        ];
    }

    public function messages (): array {
        return [
            'exam_name.required' => 'Please input file.',
            'file.required' => 'Please choose file.',
            'file.mimes' => 'Please input correct file type(txt,docx,xlx,xls,pdf).',
            'file.max' => 'This file is too ',
            'course_id.exists' => 'Please select Course.',
            'exam_name.min' => 'Exam name must be more than 5 character.',
            'exam_name.max' => 'Exam name is too long. Please input under 250 character.',
        ];
    }
}
