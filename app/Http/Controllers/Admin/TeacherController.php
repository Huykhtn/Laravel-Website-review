<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Http\Requests\Admin\Teacher\StoreRequest;
// use App\Http\Requests\Admin\Teacher\UpdateRequest;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Http\Requests\Admin\User\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class TeacherController extends Controller
{
    public function index(){
        $users = DB::table('users')
        ->join('roles', 'users.role_id', '=', 'roles.role_id')
        ->select('users.*', 'roles.*')->where('users.role_id', '2')->get();

        return view('admin.teacher.index', ['users' => $users]);
    }

    /**
     * Show form for create user
     */
    public function create()
    {
        $users = DB::table('users')->get();
        $courses = DB::table('courses')->get();

        return view('admin.teacher.create', ['users' => $users, 'courses' => $courses]);
    }

    /**
     * Processing push data to table
     * Cmd: php artisan make:request Admin/User/StoreRequest
     */
    public function store (StoreRequest $request) {
        $data = $request->except('_token', 'password', 'password_confirmation');
        $data['password'] = bcrypt($request->password);
        DB::table('users')->insert($data);
       
        return redirect()->route('admin.teacher.index')->with('message', 'User created successfully');
    }
    

    /**
     * Show form for edit user
     */
    public function edit ($id) {
        $user = DB::table('users')->where('user_id', $id)->first();
        $courses = DB::table('courses')->get();
        // dd($user,$courses);
        return view('admin.teacher.edit', [
        'courses' => $courses,
        'user' => $user]);
    }

    /**
     * Processing update data to table
     * Cmd: php artisan make:request Admin/User/UpdateRequest
     */
    public function update ($id, UpdateRequest $request) {
        $data = $request->except('_token', 'password_confirmation', 'password');
        $user_name = DB::table('users')->where('user_id', $id)->first()->user_name;

        if (!empty($request->password)) {
            $request->validate([
                'user_name' => "|unique:users,user_name,$id,user_id",
                'phone' => "|unique:users,phone,$id,user_id",
            ]);

            $data['password'] = bcrypt($request->password);  
        }


        $data['updated_at'] = new \DateTime;
       
        DB::table('users')->where('user_id', $id)->update($data);

        return redirect()->route('admin.teacher.index')->with('status','User updated successfully');
    }

    /**
     * Delete a user
     */
    public function destroy ($id) {
        DB::table('users')->where('user_id', $id)->update(array('status'=> 2));

        return redirect()->route('admin.teacher.index')->with('status','User deleted successfully');
    }
}
