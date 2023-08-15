<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller{
    const WEEK_DAYS = [
        '1' => 'Monday',
        '2' => 'Tuesday',
        '3' => 'Wednesday',
        '4' => 'Thursday',
        '5' => 'Friday',
    ];

    public function generateTimeRange($from, $to){
        $time = Carbon::parse($from);
        $timeRange = [];

        do{
            array_push($timeRange, [
                'start' => $time->format("H:i"),
                'end' => $time->addMinutes(60)->format("H:i")
            ]);    
        } while ($time->format("H:i") !== $to);

        return $timeRange;
    }

    public function generateCalendarDataAdmin(Request $request , $weekDays){
        $course_id = $request->course_id;
        $calendarData = [];
        $timeRange = $this->generateTimeRange(config('app.calendar.start_time'), config('app.calendar.end_time'));
        if(Auth::user()->role_id == 1){
            if($course_id){
                $lessons = DB::table('lessons')
                ->join('courses', 'lessons.course_id', '=', 'courses.course_id')
                ->join('users', 'lessons.teacher_id', '=', 'users.user_id')
                ->select('lessons.*', 'courses.*', 'users.*')->where('lessons.status', '=', 1)
                ->where('lessons.course_id', $course_id)->get();
                foreach ($timeRange as $time)
                {
                    $timeText = $time['start'] . ' - ' . $time['end'];
                    $calendarData[$timeText] = [];
        
                    foreach (CalendarController::WEEK_DAYS as $index => $day){
                        $lesson = $lessons->where('weekday', $index)->where('start_time', $time['start'])->first();
                        $start_time = $lesson->start_time ?? null;
                        $end_time = $lesson->end_time ?? null;
                        $difference = Carbon::parse($end_time)->diffInMinutes($start_time)/60;
                        if ($lesson){
                            array_push($calendarData[$timeText], [
                                'course_name'   => $lesson->course_name,
                                'teacher_name'  => $lesson->user_name,
                                'rowspan'       => $difference,
                            ]);
                        }
                        elseif (!$lessons->where('weekday', $index)->where('start_time', '<', $time['start'])->where('end_time', '>=', $time['end'])->count()){
                            array_push($calendarData[$timeText], 1);    
                        }
                        else{
                            array_push($calendarData[$timeText], 0);
                        }
                    }
                }
   
            }
           
            return $calendarData;         
        }   
    }

    public function generateCalendarData($weekDays){
        $calendarData = [];
        $timeRange = $this->generateTimeRange(config('app.calendar.start_time'), config('app.calendar.end_time'));
        if(Auth::user()->role_id == 2 || Auth::user()->role_id == 3){
            $lessons = DB::table('lessons')
            ->join('courses', 'lessons.course_id', '=', 'courses.course_id')
            ->join('users', 'lessons.course_id', '=', 'users.course_id')
            ->select('lessons.*', 'courses.*', 'users.*')->where('lessons.status', '=', 1)->where('lessons.course_id', Auth::user()->course_id)
            ->where('users.role_id', 2)->get();
            foreach ($timeRange as $time){
                $timeText = $time['start'] . ' - ' . $time['end'];
                $calendarData[$timeText] = [];
            
                foreach (CalendarController::WEEK_DAYS as $index => $day){
                    $lesson = $lessons->where('weekday', $index)->where('start_time', $time['start'])->first();
                    $start_time = $lesson->start_time ?? null;
                    $end_time = $lesson->end_time ?? null;
                    $difference = Carbon::parse($end_time)->diffInMinutes($start_time)/60;
    
                    if ($lesson){
                        array_push($calendarData[$timeText], [
                            'course_name'   => $lesson->course_name,
                            'teacher_name'  => $lesson->user_name,
                            'rowspan'       => $difference,
                        ]);
                    }
                    elseif (!$lessons->where('weekday', $index)->where('start_time', '<', $time['start'])->where('end_time', '>=', $time['end'])->count()){
                        array_push($calendarData[$timeText], 1);
                    }
                    else{
                        array_push($calendarData[$timeText], 0);   
                    }
                }
            }
            return $calendarData;
        }           
          
    }

    public function index(Request $request){
        $courses = DB::table('courses')->get();
        $weekDays     = CalendarController::WEEK_DAYS;
        if(Auth::user()->role_id == 1){
           
            $calendarData = $this->generateCalendarDataAdmin($request, $weekDays);
        }
        elseif(Auth::user()->role_id == 2 || Auth::user()->role_id == 3){
            $calendarData = $this->generateCalendarData($weekDays);
        }
        
        return view('admin.calendar.index', compact('weekDays', 'calendarData', 'courses'));
        
    }
}
