<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class CommonController extends Controller
{
    public function index(){
        if(Auth::user()->role_id == 1){
            $users = DB::table('users')
            ->join('roles', 'users.role_id', '=', 'roles.role_id')
            ->select('users.*', 'roles.*')
            ->where('user_id', '=', Auth::user()->user_id)->first();
        }
        if(Auth::user()->role_id == 2 || Auth::user()->role_id == 3){
            $users = DB::table('users')
            ->join('roles', 'users.role_id', '=', 'roles.role_id')
            ->join('courses', 'users.course_id', '=', 'courses.course_id')
            ->select('users.*', 'courses.course_name', 'roles.title')
            ->where('user_id', '=', Auth::user()->user_id)->first();
        }
        
        return view('common.profile', ['users' => $users]);
    }
    public function editProfile ($id) {
        if(Auth::user()->role_id == 1){
            $user = DB::table('users')
            ->join('roles', 'users.role_id', '=', 'roles.role_id')
            ->select('users.*', 'roles.*')
            ->where('user_id', '=', Auth::user()->user_id)->first();
        }
        if(Auth::user()->role_id == 2 || Auth::user()->role_id == 3){
            $user = DB::table('users')
            ->join('roles', 'users.role_id', '=', 'roles.role_id')
            ->join('courses', 'users.course_id', '=', 'courses.course_id')
            ->select('users.*', 'courses.course_name', 'roles.title')
            ->where('user_id', '=', Auth::user()->user_id)->first();
        }

        return view('common.edit-profile', ['user' => $user]);
    }

    public function updateProfile ($id, Request $request) {
        $data = $request->except('_token');

        $data['updated_at'] = new \DateTime;
       
        DB::table('users')->where('user_id', $id)->update($data);
        $users = DB::table('users')
            ->join('roles', 'users.role_id', '=', 'roles.role_id')
            ->join('courses', 'users.course_id', '=', 'courses.course_id')
            ->select('users.*', 'courses.course_name', 'roles.title')
            ->where('user_id', '=', Auth::user()->user_id)->first();

        return view('common.profile', ['users' => $users])->with('message','User updated successfully');
    }

    function changePassword(Request $request){
        $users = DB::table('users')
        ->join('roles', 'users.role_id', '=', 'roles.role_id')
        ->join('courses', 'users.course_id', '=', 'courses.course_id')
        ->select('users.*', 'courses.course_name', 'roles.title')
        ->where('user_id', '=', Auth::user()->user_id)->first();

        $data = $request->only('current_password','password', 'password_confirmation');
        
        if (!empty($request->current_password)) {
            $request->validate([
                'current_password' => ['required',
                function ($attribute, $value, $fail){
                    if (!Hash::check($value, Auth::user()->password)) {
                        $fail('The old password does not match our records.');
                    }
                }],   
            ]);
        }

        if (!empty($request->password)) {
            $request->validate([
                'password' => 'required|min:6|max:20|confirmed|regex:/(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%])/',
            ],[
                'password.required' => 'Please input user password.',
                'password.min' => 'Password must be more than 6 character.',
                'password.max' => 'Password is too long. Please input under 20 character.',
                'password.confirmed' => 'Password and Confirm password do not match.',
                'password.regex' => 'Password must contains at least 1 numberic 1 alphabetic 1 uppercase 1 special character and minimum 6 characters.',
            ]);

        }
        
        DB::table('users')->where('user_id', Auth::user()->user_id)->update(array('password'=> Hash::make($request->password)));

        return view('common.profile', ['users' => $users])->with('message','Password updated successfully');
    }
}
