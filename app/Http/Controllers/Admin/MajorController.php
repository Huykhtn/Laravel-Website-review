<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Major\StoreRequest;
use App\Http\Requests\Admin\Major\UpdateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Mail\SendMail;
use Mail;
// use Illuminate\Support\Facades\Input;

class MajorController extends Controller
{
    /**
     * Show table all major
     */
    public function index(Request $request){
        $data = $request->except('_token');
        $majors = DB::table('majors')->get();

        return view('admin.major.index', ['majors' => $majors]);
    }

    /**
     * Show form for create major
     */
    public function create()
    {
        return view('admin.major.create');
    }

    /**
     * Processing push data to table
     * Cmd: php artisan make:request Admin/major/StoreRequest
     */
    public function store (StoreRequest $request) {
        $data = $request->except('_token');
        DB::table('majors')->insert($data);
        return redirect()->route('admin.major.index')->with('message', 'Major created successfully');
    }

    /**
     * Show form for edit major
     */
    public function edit($id){
        $majors = DB::table('majors')->where('major_id', $id)->first();
        return view('admin.major.edit', [
            'majors' => $majors,
        ]);
    }

    /**
     * Processing update data to table
     * Cmd: php artisan make:request Admin/major/UpdateRequest
     */
    public function update($id, UpdateRequest $request) {
        $data = $request->except('_token');

        if (!empty($request->major_name)) {
            $request->validate([
                'major_name' => "|unique:majors,major_name,$id,major_id"
            ]);
        }

        if($data['status'] == 1){
            DB::table('majors')->where('major_id', $id)->update($data);
            $course_ids = DB::table('courses')->where('major_id', $id)->get();
            DB::table('courses')->where('major_id', $id)->update(array('status'=>1));
            foreach($course_ids as $course_id){
                $course_id = $course_id->course_id;
                DB::table('lessons')->where('course_id', $course_id)->update(array('status'=>1));
                
                // $teacherEmail = DB::table('users')->where('users.role_id', 2)
                // ->where('course_id', '=', $course_id)->get('email');

                // if($teacherEmail){
                //     // $course_name = DB::table('courses')->where('course_id', $id)->first();
                
                //     $emailData = [
                //         'name' => "Major is actived again.",
                //         'content' => 'Please check your course again.'
                //     ];
            
                //     Mail::to($teacherEmail)->send(new SendMail($emailData));
                // }
  
            }
   
        }

        if($data['status'] == 2){
            DB::table('majors')->where('major_id', $id)->update($data);
            $course_ids = DB::table('courses')->where('major_id', $id)->get();
            DB::table('courses')->where('major_id', $id)->update(array('status'=>2));
            foreach($course_ids as $course_id){
                $course_id = $course_id->course_id;
                DB::table('lessons')->where('course_id', $course_id)->update(array('status'=>2));
            }
        }
        
        return redirect()->route('admin.major.index')->with('message', 'Major updated successfully');
    
}

    /**
     * Delete a major
     */
    public function destroy ($id) {
        
            DB::table('majors')->where('major_id', $id)->update(array('status'=>2));
            $course_ids = DB::table('courses')->where('major_id', $id)->get();
            DB::table('courses')->where('major_id', $id)->update(array('status'=>2));
            foreach($course_ids as $course_id){
                $course_id = $course_id->course_id;
                DB::table('lessons')->where('course_id', $course_id)->update(array('status'=>2));
            }
        

        return redirect()->route('admin.major.index')->with('message','Major deleted successfully');
    }

}
