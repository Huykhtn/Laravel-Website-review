<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SendMailController;
use App\Http\Controllers\TelegramController;
use App\Http\Controllers\Admin\MajorController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\CalendarController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\CommonController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/admin/dashboard/index', function () {
    return view('admin.dashboard.index');
})->name('admin.dashboard.index')->middleware(['checkLogin']);

// ----------------------------- Mail -------------------------//
Route::get('send-mail', [SendMailController::class, 'send']);

Route::group(['middleware' => 'checkLogin'], function() {
    Route::get('profile', [CommonController::class, 'index'])->name('profile');
    Route::get('edit-profile/{id}', [CommonController::class, 'editProfile'])->name('edit-profile');
    Route::post('update-profile/{id}', [CommonController::class, 'updateProfile'])->name('update-profile');
    Route::post('change-password', [CommonController::class, 'changePassword'])->name('change-password');
});
Route::get('/', function () {
    return view('auth.login');
});

Route::prefix('auth')->name('auth.')->group(function(){
    Route::get('login', [LoginController::class, 'viewLogin'])->name('view-login');
    Route::post('login', [LoginController::class, 'postLogin'])->name('post-login');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    
});

Route::prefix('admin')->name('admin.')->middleware(['checkLogin'])->group(function(){
    // ----------------------------- Time table -------------------------//
    Route::prefix('calendar')->controller(CalendarController::class)->name('calendar.')->group(function(){
        Route::get('index','index')->name('index');
    });

    // ----------------------------- Major -------------------------//
    Route::prefix('major')->controller(MajorController::class)->name('major.')->middleware(['isAdmin'])->group(function(){
        Route::get('index','index')->name('index');
        Route::get('create','create')->name('create');
        Route::post('store','store')->name('store');
        Route::get('edit/{id}','edit')->name('edit');
        Route::post('update/{id}','update')->name('update');
        Route::get('destroy/{id?}','destroy')->name('destroy');
    });

    // ----------------------------- Course -------------------------//
    Route::prefix('course')->controller(CourseController::class)->name('course.')->middleware(['isAdmin'])->group(function(){
        Route::get('index','index')->name('index');
        Route::get('create','create')->name('create');
        Route::post('store','store')->name('store');
        Route::get('edit/{id}','edit')->name('edit');
        Route::post('update/{id}','update')->name('update');
        Route::get('destroy/{id?}','destroy')->name('destroy');
        
        
    });

    // ----------------------------- Lesson -------------------------//
    Route::prefix('lesson')->controller(LessonController::class)->name('lesson.')->middleware(['isAdminAndTeacher'])->group(function(){
        Route::get('index','index')->name('index');   
        Route::get('destroy/{id?}','destroy')->name('destroy');
        
    });
    Route::prefix('lesson')->controller(LessonController::class)->name('lesson.')->middleware(['isTeacher'])->group(function(){
       
        Route::get('create','create')->name('create');
        Route::post('store','store')->name('store');
        Route::get('edit/{id}','edit')->name('edit');
        Route::post('update/{id}','update')->name('update');
      
    });

    // ----------------------------- Student -------------------------//
    Route::prefix('student')->controller(StudentController::class)->name('student.')->middleware(['isAdmin'])->group(function(){
        
        Route::get('index','index')->name('index');
        Route::get('create','create')->name('create');
        Route::post('store','store')->name('store');
        Route::get('edit/{id}','edit')->name('edit');
        Route::post('update/{id}','update')->name('update');
        Route::get('destroy/{id?}','destroy')->name('destroy');
        Route::get('detail/{id}','detail')->name('detail');
        Route::get('list','list')->name('list');

    });
    
    // ----------------------------- Admin -------------------------//
    Route::prefix('user')->controller(UserController::class)->name('user.')->middleware(['isAdmin'])->group(function(){
        Route::get('index','index')->name('index');
       
        Route::get('edit/{id}','edit')->name('edit-password');
        Route::post('update/{id}','update')->name('update-password');
    });

    // ----------------------------- Teacher -------------------------//
    Route::prefix('teacher')->controller(TeacherController::class)->name('teacher.')->middleware(['isAdmin'])->group(function(){
        Route::get('index','index')->name('index');
        Route::get('create','create')->name('create');
        Route::post('store','store')->name('store');
        Route::get('edit/{id}','edit')->name('edit');
        Route::post('update/{id}','update')->name('update');
        Route::get('destroy/{id?}','destroy')->name('destroy');
    });
    
    // ----------------------------- Practice -------------------------//
    Route::prefix('exam')->controller(ExamController::class)->name('exam.')->group(function(){
        Route::get('index','index')->name('index');
        Route::get('create','create')->middleware(['isTeacher'])->name('create');
        Route::post('store','store')->middleware(['isTeacher'])->name('store');
        Route::get('destroy/{id?}','destroy')->middleware(['isTeacher'])->name('destroy');
        Route::get('download/{file}','download')->name('download');
    });
});