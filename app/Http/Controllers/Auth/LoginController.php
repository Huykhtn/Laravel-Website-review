<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function viewLogin() {
        if(Auth::check()) {
        return redirect()->route('admin.dashboard.index');
        }
        return view('auth.login');
    }

        
    public function postLogin(LoginRequest $request){
        $data = $request->only('email','password');
        $email = $request->input('email');
		$password = $request->input('password');
        // dd($data, DB::table('users')->where('email', $email)->first()->status);
        $status = DB::table('users')->where('email', $email)->first()->status;
        
        if (Auth::attempt(['email' => $email, 'password' => $password])){
            //   check account status is active or block
            if($status == 2){
                
                return view('auth.login')->withErrors(['message' => 'Email is blocked!!!']);
            }
            return redirect()->route('admin.dashboard.index')->with('message', 'Signed in');
        }
            
		 else {
			
			return redirect()->back()->withErrors(['message' => 'Email or password is incorrect!!!']);
		}
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.view-login');
    }
}
