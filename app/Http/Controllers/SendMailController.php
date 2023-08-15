<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SendMailController extends Controller
{
    public function send(Request $request){
        // dd($request);
        // dd(Auth::user()->course_id);

        $email = Auth::user()->email;
        // $email = ['abc@gmail.com', 'cde@gmail.com']; send multiple email
        $data = [
            'name' => 'test',
            'school' => 'Green Academy'
        ];

        Mail::to($email)->send(new SendMail($data));
    }

    
}
