<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
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
        // $user_name = DB::table('users')->where('user_id', Auth::user()->user_id)->first()->user_name;
        // dd($user_name);
        // $user_name =Rule::unique('users')->ignore('user_name');
        // dd($user_name);
        return [
            
            'user_name' => "required|min:5|max:100|",
            // 'email' => 'required|email|unique:users',
            // 'password' => 'required|min:6|max:20|confirmed|regex:/(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%])/',
            // 'password_confirm' => 'required|same:password',
            'phone' => 'required|numeric|digits:10|regex:/(0)[0-9]{9}/',
            // 'roled_id' => 'required|exists:roles,role_id',
            'gender'  => 'required|exists:users,gender'
        ];
    }
    
    public function messages (): array {
        return [
            'user_name.required'  => 'Please input your name.',
            'user_name.min'  => 'Your name must be more than 5 character.',
            'user_name.max'  => 'Your name is too long. Please input under 100 character.',
            // 'email.required' => 'Please input your email.',
            // 'password.required' => 'Please input your password.',
            'gender.exists' => 'Please select your gender.',
            // 'roled_id.required' => 'Please select your level.',
            
            'phone.required' => 'Please input your phone number.',
            'phone.digits' => 'Your phone number must be 10 digits.',
            'phone.regex' => 'Your phone number must be start with 0.',
            'phone.numeric' => 'Your phone number must be numberic.',
            // 'password_confirm.same' => 'Password confirm does not match.',
            // 'password.regex' => 'Password must contains ...',
            // 'user_name.unique' => 'This email has been registed.',
            // 'email.email' => 'Please input correct email domain.'
        ];
    }
}
