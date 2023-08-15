<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\Lesson\StoreRequest;
use App\Http\Requests\Admin\Lesson\UpdateRequest;
use Illuminate\Http\Request;
use Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Mail\SendMail;



class LessonController extends Controller
{
    public function index(Request $request){
        if(Auth::user()->role_id == 1){
            $course_id = $request->course_id;
            if(!$course_id){
                $lessons = DB::table('lessons')
                ->join('courses', 'lessons.course_id', '=', 'courses.course_id')
                ->join('users', 'lessons.teacher_id', '=', 'users.user_id')
                ->select('courses.course_name', 'users.user_name', 'lessons.lesson_id', 'lessons.lesson_name', 'lessons.weekday','lessons.start_time', 'lessons.end_time', 'lessons.status')
                ->where('users.role_id', 2)->get();
            }
            else{
                $lessons = DB::table('lessons')
                ->join('courses', 'lessons.course_id', '=', 'courses.course_id')
                ->join('users', 'lessons.teacher_id', '=', 'users.user_id')
                ->select('courses.course_name', 'users.user_name', 'lessons.lesson_id', 'lessons.lesson_name', 'lessons.weekday','lessons.start_time', 'lessons.end_time', 'lessons.status')
                ->where('users.role_id', 2)->where('lessons.course_id', '=', $course_id)->get();
            }
            
        }
        
        elseif(Auth::user()->role_id == 2){
            $lessons = DB::table('lessons')
            ->join('courses', 'lessons.course_id', '=', 'courses.course_id')
            ->join('users', 'lessons.course_id', '=', 'users.course_id')
            ->select('courses.course_id', 'courses.course_name', 'users.user_name', 'lessons.lesson_id', 'lessons.lesson_name', 'lessons.weekday','lessons.start_time', 'lessons.end_time', 'lessons.status')->where('lessons.course_id', Auth::user()->course_id)
            ->where('users.role_id', 2)->get();
        }

        $courses = DB::table('courses')->get();
      
        return view('admin.lesson.index', ['lessons' => $lessons, 'courses' => $courses]);
        
    }

    public function create(Request $request)
    {  
        if(Auth::user()->role_id == 1){
            $courses = DB::table('courses')->get();
            $teachers = DB::table('users')->where('role_id', 2)->get();
        }

        elseif(Auth::user()->role_id == 2){
            $courses = DB::table('courses')->where('course_id', '=', Auth::user()->course_id)
            ->where('status', 1)->get();
            $teachers = DB::table('users')->where('role_id', 2)
            ->where('user_id', '=', Auth::user()->user_id)
            ->where('status', 1)->get();
        }
        
        return view('admin.lesson.create', ['courses' => $courses, 'teachers' => $teachers]);
    }

    /**
     * Processing push data to table
     */
    public function store(StoreRequest $request)
    {
        $data = $request->except('_token');

        DB::table('lessons')->insert($data);

        $assigneeEmail = Auth::user()->email;
        $studentEmail = DB::table('users')->where('users.role_id', 3)
        ->where('course_id', '=', Auth::user()->course_id)->get('email');

        $emailData = [
            'name' => 'New lesson has been created.',
            'content' => 'Please check your timetable.'
        ];

        Mail::to($assigneeEmail)->send(new SendMail($emailData));
        Mail::to($studentEmail)->send(new SendMail($emailData));

        return redirect()->route('admin.lesson.index')->with('message', 'Lesson created successfully');
    }

    /**
     * Show form for edit product
     */
    public function edit($id)
    {
        $courses_id = DB::table('lessons')->where('lesson_id', $id)->first()->course_id;
        $courses = DB::table('courses')->where('course_id', $courses_id)->get();
        $lessons = DB::table('lessons')->where('lesson_id', $id)->first();
        $teachers = DB::table('users')->where('role_id', 2)->where('course_id', $courses_id)->get();

        return view('admin.lesson.edit', [
            'lessons' => $lessons,
            'courses' => $courses,
            'teachers' => $teachers,
        ]);
    }

    /**
     * Processing update data from table
     */
    public function update(UpdateRequest $request, $id)
    {
        $lesson_name = DB::table('lessons')->where('lesson_id', $id)->first()->lesson_name;
        $data = $request->except('_token');
        if (!empty($request->lesson_name)) {
            $request->validate([
                'lesson_name' => "|unique:lessons,lesson_name,$id,lesson_id",
            ]);
        }

        DB::table('lessons')->where('lesson_id', $id)->update($data);

        $assigneeEmail = Auth::user()->email;
        $studentEmail = DB::table('users')->where('users.role_id', 3)
        ->where('course_id', '=', Auth::user()->course_id)->get('email');
        $emailData = [
            'name' => "Lesson $lesson_name has been updated.",
            'content' => 'Please check your timetable.'
        ];

        Mail::to($assigneeEmail)->send(new SendMail($emailData));
        Mail::to($studentEmail)->send(new SendMail($emailData));

        return redirect()->route('admin.lesson.index')->with('message', 'Lesson updated successfully');
    }

    /**
     * Delete a product
     */
    public function destroy($id)
    {
        $lesson_name = DB::table('lessons')->where('lesson_id', $id)->first()->lesson_name;
        if(Auth::user()->role_id == 1){
            $course_id = DB::table('lessons')->where('lesson_id', $id)->first()->course_id;
            $assigneeEmail = DB::table('users')->where('users.role_id', '<>', 1)
            ->where('course_id', '=', $course_id)->get('email');

            DB::table('lessons')->where('lesson_id', $id)->delete();
            $emailData = [
                'name' => "Lesson $lesson_name has been deleted.",
                'content' => 'Please check your timetable.'
            ];

            Mail::to($assigneeEmail)->send(new SendMail($emailData));

        }

        if(Auth::user()->role_id == 2){
            DB::table('lessons')->where('lesson_id', $id)->update(array('status'=> 2));
            $assigneeEmail = Auth::user()->email;
            $studentEmail = DB::table('users')->where('users.role_id', 3)
            ->where('course_id', '=', Auth::user()->course_id)->get('email');
            $emailData = [
                'name' => "Lesson $lesson_name has been deleted.",
                'content' => 'Please check your timetable.'
            ];
    
            Mail::to($assigneeEmail)->send(new SendMail($emailData));
            Mail::to($studentEmail)->send(new SendMail($emailData));
        }
        

        return redirect()->route('admin.lesson.index')->with('message', 'Lesson deleted successfully');
    }
}
