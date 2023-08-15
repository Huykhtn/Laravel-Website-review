<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class LoginRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    public function messages (): array {
        return [
            'email.required' => 'Please input your email.',
            'email.email' => 'Please input correct email domain.',
            // 'email.exists' => 'This email is not exist.',
            
            'password.required' => 'Please input your password.',
            // 'password.exists' => 'Your password is wrong. Please try again.',
            
        ];
    }
}
