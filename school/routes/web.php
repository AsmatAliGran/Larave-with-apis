<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\StudentController;


 

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

 // course
 Route::get('/course', [CoursesController::class, 'index'])->name('course');
    Route::prefix('/course')->group(function () {
        Route::get('/add', [CoursesController::class, 'add'])->name('add_course');
        Route::post('/save', [CoursesController::class, 'save'])->name('save_course');
        Route::get('/edit/{id}', [CoursesController::class, 'edit']);
        Route::post('/update', [CoursesController::class, 'update'])->name('update_course');
        Route::post('/status', [CoursesController::class, 'status']);
        Route::post('/destroy', [CoursesController::class, 'destroy']);
    });
 // student
 Route::get('/student', [StudentController::class, 'index'])->name('student');
    Route::prefix('/student')->group(function () {
        Route::get('/add', [StudentController::class, 'add'])->name('add_student');
        Route::post('/save', [StudentController::class, 'save'])->name('save_student');
        Route::get('/edit/{id}', [StudentController::class, 'edit']);
        Route::post('/update', [StudentController::class, 'update'])->name('update_student');
        Route::post('/status', [StudentController::class, 'status']);
        Route::post('/destroy', [StudentController::class, 'destroy']);
    });