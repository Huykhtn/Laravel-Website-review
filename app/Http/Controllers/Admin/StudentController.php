<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\User\StoreRequest;
use App\Http\Requests\Admin\User\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Show table all user
     */
    public function index(Request $request){        
        $course_id = $request->query('course_id');
        $search_phone = $request->search_phone ?? ""; 
  
        if(!$course_id){
            $users = DB::table('users')
                    ->join('roles', 'users.role_id', '=', 'roles.role_id')
                    ->join('courses', 'users.course_id', '=', 'courses.course_id')
                    ->select('users.*', 'roles.*', 'courses.*')->where('users.role_id', '3')->get();
            if($search_phone != ""){
                $users = DB::table('users')
                ->join('roles', 'users.role_id', '=', 'roles.role_id')
                ->join('courses', 'users.course_id', '=', 'courses.course_id')
                ->select('users.*', 'roles.*', 'courses.*')->where('users.role_id', '3')
                ->where('phone', 'LIKE', "%$search_phone%")->get();
            }
            
        }
        else{
            $users = DB::table('users')
                    ->join('roles', 'users.role_id', '=', 'roles.role_id')
                    ->join('courses', 'users.course_id', '=', 'courses.course_id')
                    ->select('users.*', 'roles.*', 'courses.*')->where('users.role_id', '3')
                    ->where('users.course_id', '=', $course_id)->get();
                    if($search_phone != ""){
                        $users = DB::table('users')
                        ->join('roles', 'users.role_id', '=', 'roles.role_id')
                        ->join('courses', 'users.course_id', '=', 'courses.course_id')
                        ->select('users.*', 'roles.*', 'courses.*')->where('users.role_id', '3')
                        ->where('users.course_id', '=', $course_id)
                        ->where('phone', 'LIKE', "%$search_phone%")->get();   
                    }
        }

        $courses = DB::table('courses')->get();

        return view('admin.student.index', ['users' => $users, 'courses' => $courses, 'search_phone' => $search_phone]);
    }

    public function list(Request $request){
        $course_id = $request->query('course_id');
        
        $users = DB::table('users')
        ->join('courses', 'users.course_id', '=', 'courses.course_id')
        ->select('users.*', 'courses.*')->where('role_id', '=', '3')
        ->where('users.course_id', '=', $course_id)->get();
        
        $courses = DB::table('courses')->where('courses.course_id', '=', $course_id)->first();

        return view('admin.student.list', ['users' => $users, 'courses' => $courses]);
    }
   
    /**
     * Show form for create user
     */
    public function create()
    {
        $users = DB::table('users')->get();
        $courses = DB::table('courses')->get();

        return view('admin.student.create', ['courses' => $courses]);        
    }

    /**
     * Processing push data to table
     * Cmd: php artisan make:request Admin/User/StoreRequest
     */
    public function store (StoreRequest $request) {
        $data = $request->except('_token', 'password', 'password_confirmation');
        $data['password'] = bcrypt($request->password);

        DB::table('users')->insert($data);
        
        return redirect()->route('admin.student.index')->with('success', 'User created successfully');
    }    

    /**
     * Show form for edit user
     */
    public function edit ($id) {
        $user = DB::table('users')->where('user_id', $id)->first();
        $courses = DB::table('courses')->get();
        return view('admin.student.edit', [
        'courses' => $courses,
        'user' => $user]);
    }

    /**
     * Processing update data to table
     * Cmd: php artisan make:request Admin/User/UpdateRequest
     */
    public function update ($id, UpdateRequest $request) {
        $data = $request->except('_token', 'password_confirmation', 'password');

        if (!empty($request->password)) {
            $request->validate([
                'user_name' => "|unique:users,user_name,$id,user_id",
                'phone' => "|unique:users,phone,$id,user_id",
            ]);


            $data['password'] = bcrypt($request->password);
        }


        $data['updated_at'] = new \DateTime;
       
        DB::table('users')->where('user_id', $id)->update($data);

        return redirect()->route('admin.user.index')->with('success','User updated successfully');
    }

    /**
     * Delete a user
     */
    public function destroy ($id) {
        DB::table('users')->where('user_id', $id)->update(array('status'=> 2));

        return redirect()->route('admin.user.index')->with('success','User deleted successfully');
    }

    /**
     * Show student detail
     */
    public function detail($id){
        $users = DB::table('users')
        ->join('courses', 'users.course_id', '=', 'courses.course_id')
        ->select('users.*', 'courses.*')->where('user_id', '=', $id)->get();
        
        return view('admin.student.detail', ['users' => $users]);
    }

}
