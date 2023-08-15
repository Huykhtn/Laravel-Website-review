<?php

namespace App\Http\Requests\Admin\User;

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
            'user_name' => 'required|min:5|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:20|confirmed|regex:/(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[\d\x])(?=.*[!$#%])/',
            'phone' => 'required|numeric|unique:users|digits:10|regex:/(0)[0-9]{9}/',
            'gender'  => 'required|exists:users,gender'
        ];
    }

    public function messages (): array {
        return [
            'user_name.required'  => 'Please input user name.',
            'user_name.min'  => 'User name must be more than 5 character.',
            'user_name.max'  => 'User name is too long. Please input under 100 character.',
            'email.required' => 'Please input user email.',
            'password.required' => 'Please input user password.',
            'gender.exists' => 'Please select user gender.',
            'phone.unique' => 'Phone number has been registed.',
            'phone.required' => 'Please input user phone number.',
            'phone.digits' => 'This phone number must be 10 digits.',
            'phone.regex' => 'This phone number must be start with 0.',
            'phone.numeric' => 'This phone number must be numberic.',
            'password.regex' => 'Password must contains at least 1 numberic 1 alphabetic 1 uppercase 1 special character and minimum 6 characters.',
            'email.email' => 'Please input correct email domain.',
            'password.min' => 'Password must be more than 6 character.',
            'password.max' => 'Password is too long. Please input under 20 character.',
            'password.confirmed' => 'Password and Confirm password do not match.',
        ];
    }

    
}