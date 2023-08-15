<?php

namespace App\Http\Requests\Admin\Lesson;

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
            'course_id' => 'required|exists:courses,course_id',
            'lesson_name'  => 'required|min:5|max:100|unique:lessons',
            'weekday' => 'required|in:1,2,3,4,5',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'teacher_id' => 'required|exists:users,user_id',
        ];
    }

    public function messages (): array {
        return [
            'course_id.exists' => 'Please select Course.',
            'weekday.in'  => 'Please select Weekday.',
            'start_time.required' => 'Please select Start time.',
            'end_time.required' => 'Please select End time.',
            'teacher_id.exists' => 'Please select Teacher.',
            'end_time.after' => 'End time must after start time.',
            'lesson_name.required' => 'Please input Lesson name.',
            'lesson_name.min' => 'Lesson name must be more than 5 character.',
            'lesson_name.max' => 'Lesson name is too long. Please input under 250 character.',
            'lesson_name.unique' => 'This Lesson name has been registed. Please input another Lesson name.',
        ];
    }
}
