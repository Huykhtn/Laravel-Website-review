<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Exam\StoreRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Response;
use Mail;
use App\Mail\SendMail;


class ExamController extends Controller
{
    function index(Request $request){
        if(Auth::user()->role_id == 1){
            $course_id = $request->course_id;

            if(!$course_id){
                $exams = DB::table('exams')
            ->join('courses', 'exams.course_id', '=', 'courses.course_id')
            ->select('exams.*', 'courses.*')
            ->get();
            }
            else{
                $exams = DB::table('exams')
            ->join('courses', 'exams.course_id', '=', 'courses.course_id')
            ->select('exams.*', 'courses.*')
            ->where('exams.course_id', '=', $course_id)
            ->get();
            }
            
        }

        elseif(Auth::user()->role_id == 2 || Auth::user()->role_id == 3){
            $exams = DB::table('exams')
            ->join('courses', 'exams.course_id', '=', 'courses.course_id')
            ->select('exams.*', 'courses.*')->where('exams.course_id', '=', Auth::user()->course_id)
            ->get();
        }
        
        $courses = DB::table('courses')->get();

        return view('admin.exam.index', ['exams' => $exams, 'courses' => $courses]);
    }

    public function create(){
        if(Auth::user()->role_id == 1){
            $courses = DB::table('courses')->get();
        }
        elseif(Auth::user()->role_id == 2){
            $courses = DB::table('courses')->where('course_id', '=', Auth::user()->course_id)->get();

        }

        return view('admin.exam.create', ['courses' => $courses]);
    }

    public function store(StoreRequest $request){
        $data = $request->except('_token');
        $request->validate([
        'file' => 'required|mimes:csv,docx,txt,xlx,xls,pdf|max:2048'
        ]);
        $fileModel = new ExamController;
        if($request->file()) {
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
            $fileModel->name = time().'_'.$request->file->getClientOriginalName();
            $fileModel->file_path = '/storage/' . $filePath;
            
            DB::table('exams')->insert(
                array(
                    'course_id' => $data['course_id'],
                    'exam_name' => $data['exam_name'],
                    'file_path' => $fileModel->name,
                )
           );

        $studentEmail = DB::table('users')->where('users.role_id', 3)
        ->where('course_id', '=', Auth::user()->course_id)->get('email');

        $exam_name = $request->exam_name;

        $emailData = [
            'name' => "New practice $exam_name has been created.",
            'content' => 'Please check your Practice folder.'
        ];

        Mail::to($studentEmail)->send(new SendMail($emailData));
       
           return redirect()->route('admin.exam.index')
           ->with('message',"File $fileName has been uploaded successfully.");
            
        }
        
   }

   public function download($fileName)
    {
        $file_path = storage_path('app/public/uploads') . "/" . $fileName;

        return Response::download($file_path);
    }

    public function destroy($id, Request $request){
        $exam_name = DB::table('exams')->where('exam_id', $id)->first()->exam_name;
        
        DB::table('exams')->where('exam_id', $id)->delete();
        $assigneeEmail = Auth::user()->email;
        $studentEmail = DB::table('users')->where('users.role_id', 3)
        ->where('course_id', '=', Auth::user()->course_id)->get('email');
        $emailData = [
            'name' => "Practice $exam_name has been deleted.",
            'content' => 'Please check your timetable.'
        ];

        Mail::to($assigneeEmail)->send(new SendMail($emailData));
        Mail::to($studentEmail)->send(new SendMail($emailData));
        
        return redirect()->route('admin.exam.index')->with('message', "Practice $exam_name deleted successfully");
    }
}
