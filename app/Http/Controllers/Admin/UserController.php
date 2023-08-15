<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\User\StoreRequest;
use App\Http\Requests\Admin\User\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Mail\SendMail;


class UserController extends Controller
{
    /**
     * Show table all user
     */
    public function index(Request $request){

        $users = DB::table('users')
                    ->join('roles', 'users.role_id', '=', 'roles.role_id')
                    ->select('users.*', 'roles.*')
                    ->where('users.role_id', '<>', 1)->get();
        $search_phone = $request->search_phone ?? ""; 

        if($search_phone != ""){
            $users = DB::table('users')
            ->join('roles', 'users.role_id', '=', 'roles.role_id')
            ->join('courses', 'users.course_id', '=', 'courses.course_id')
            ->select('users.*', 'roles.*', 'courses.*')->where('users.role_id', '<>', 1)
            ->where('phone', 'LIKE', "%$search_phone%")->get();
        }

        return view('admin.user.index', ['users' => $users]);

    }    

    /**
     * Show form for edit user
     */
    public function edit ($id) {
        $user = DB::table('users')->where('user_id', $id)->first();

        return view('admin.user.edit', [

        'user' => $user]);
    }

    /**
     * Processing update data to table
     * Cmd: php artisan make:request Admin/User/UpdateRequest
     */
    public function update ($id, Request $request) {
        $users = DB::table('users')->where('users.role_id', '<>', 1)->get();
        $data = $request->only('password', 'password_confirmation');
        $user_name = DB::table('users')->where('user_id', $id)->first()->user_name;
        $assigneeEmail = DB::table('users')->where('user_id', $id)->first()->email;

        if (!empty($request->password)) {
            $request->validate([
                'password' => 'required|min:6|max:20|confirmed|regex:/(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[\d\x])(?=.*[!$#%])/',
            ],[
                'password.required' => 'Please input user password.',
                'password.min' => 'Password must be more than 6 character.',
                'password.max' => 'Password is too long. Please input under 20 character.',
                'password.confirmed' => 'Password and Confirm password do not match.',
                'password.regex' => 'Password must contains at least 1 numberic 1 alphabetic 1 uppercase 1 special character and minimum 6 characters.',
            ]);

        }

        $emailData = [
            'name' => "Password of account $assigneeEmail has been reset",
            'content' => "New password: $request->password",
        ];
        // dd($emailData, $assigneeEmail);
        DB::table('users')->where('user_id', $id)->update(array('password'=> Hash::make($request->password)));

        Mail::to($assigneeEmail)->send(new SendMail($emailData));

        return redirect()->route('admin.user.index')->with('message',"Password of $user_name reset successfully");
    }

   
    
}
