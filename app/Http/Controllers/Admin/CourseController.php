<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Course\StoreRequest;
use App\Http\Requests\Admin\Course\UpdateRequest;
use Illuminate\Support\Facades\DB;
use App\Mail\SendMail;
use Session;
use Mail;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Show table all course
     */
    function index(Request $request){
        $major_id = $request->query('major_id');

        if(!$major_id){
            
            $courses = DB::table('courses')
            ->join('majors', 'courses.major_id', '=', 'majors.major_id')
            ->select('majors.*', 'courses.*')->get();
        }
        else{
            $courses = DB::table('courses')
            ->join('majors', 'courses.major_id', '=', 'majors.major_id')
            ->select('majors.*', 'courses.*')->where('courses.major_id', $major_id)
            ->get();
        }

        $majors = DB::table('majors')->get();

        return view('admin.course.index', ['courses' => $courses, 'majors' => $majors]);
    }

    /**
     * Show form for create course
     */
    public function create()
    {
        $majors = DB::table('majors')->get();
        return view('admin.course.create', ['majors' => $majors]);
    }

    /**
     * Processing push data to table
     * Cmd: php artisan make:request Admin/course/StoreRequest
     */
    public function store (StoreRequest $request) {
        $data = $request->except('_token');
        DB::table('courses')->insert($data);
        return redirect()->route('admin.course.index')->with('message', 'Course created successfully');
    }

    /**
     * Show form for edit course
     */
    public function edit($id){ 
        
        $courses = DB::table('courses')->where('course_id', $id)->first();
        $majors = DB::table('majors')->get();
        
        return view('admin.course.edit', [
            'majors' => $majors,
            'courses' => $courses,
        ]);
    }

    /**
     * Processing update data to table
     */
    public function update ($id, UpdateRequest $request) {
        $data = $request->except('_token');
        $teacherEmail = DB::table('users')->where('users.role_id', 2)
        ->where('course_id', '=', $id)->get('email');
        $course_name = DB::table('courses')->where('course_id', $id)->first();

        if (!empty($request->course_name)) {
            $request->validate([
                'course_name' => "|unique:courses,course_name,$id,course_id",  
            ]);
        }

        if($data['status'] == 1){
            DB::table('courses')->where('course_id', $id)->update($data);
            DB::table('lessons')->where('course_id', $id)->update(array('status'=>1));
        }

        if($data['status'] == 2){
            DB::table('courses')->where('course_id', $id)->update($data);
            DB::table('lessons')->where('course_id', $id)->update(array('status'=>2));
        }
    
        $emailData = [
            'name' => "Course $course_name->course_name has been changed.",
            'content' => 'Please check your course again.'
        ];

        Mail::to($teacherEmail)->send(new SendMail($emailData));

        return redirect()->route('admin.course.index')->with('message', "Course $course_name->course_name updated successfully");
    }

    /**
     * Delete a course
     */
    public function destroy ($id, Request $request) {
        $teacherEmail = DB::table('users')->where('users.role_id', 2)
        ->where('course_id', '=', $id)->first()  ?? null;
        DB::table('courses')->where('course_id', $id)->update(array('status'=>2));
        DB::table('lessons')->where('course_id', $id)->update(array('status'=>2));
        
        if($teacherEmail == NULL){
            $course_name = DB::table('courses')->where('course_id', $id)->delete();
            
        }
        if($teacherEmail){
            $course_name = DB::table('courses')->where('course_id', $id)->first();

            $emailData = [
                'name' => "Course $course_name->course_name has been deleted.",
                'content' => 'Please check your course again.'
            ];
    
            Mail::to($teacherEmail->email)->send(new SendMail($emailData));
            
        }

        return redirect()->route('admin.course.index')->with('message','Course deleted successfully');
        
        
    }

    
}
