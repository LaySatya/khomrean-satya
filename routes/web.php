<?php

use App\Http\Controllers\LessonController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// client
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [LessonController::class, 'getAllDataToClients']);

// research 
Route::get('/research', function(){
    return view('components.research');
});

// dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard/students', [StudentController::class, 'getAllStudents']);
    Route::get('/dashboard/courses', [LessonController::class, 'getAllLessons']);
});

// login
Route::post('/dashboard/students', [StudentController::class, 'storeStudent']);
Route::get('/dashboard/remove-students/{id}', [StudentController::class, 'removeStudent']);

// add score
Route::post('/dashboard/add-score-student/{id}', [ScoreController::class, 'storeStudentScore']);

Route::get('/login', function () {
    return view('auth.login');
})->name('login');
// logout
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
//signup
Route::get('/signup', function () {
    return view('auth.signup');
});
Route::post('/signup', [UserController::class, 'signup']);
Route::post('/login', [UserController::class, 'login']);


// students


// add lessons

Route::post('/dashboard/courses', [LessonController::class, 'storeLessons']);
// remove lessons
Route::get('/dashboard/remove-lesson/{id}', [LessonController::class, 'removeLesson']);
//edit lessons
Route::put('/dashboard/edit-lesson/{id}', [LessonController::class, 'updateLesson']);