<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Userfolder\UserApiController;
use App\Http\Controllers\Api\Project\CourseController;
use App\Http\Controllers\Api\Project\StudentController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::prefix("/user")->group(function(){
    Route::post("/register", [UserApiController::class, "register"]);
    Route::post("/login", [UserApiController::class, "login"]);

});

//! Here Couse routes 
Route::prefix("/Course")->group(function(){
    Route::get('/list', [CourseController::class, 'index']);
    Route::post('/save', [CourseController::class, 'save']);
    Route::post('/update', [CourseController::class, 'update']);
    Route::post('/delete', [CourseController::class, 'destroy']);
});
//! Here Students routes 
Route::prefix("/students")->group(function(){
    Route::get('/list', [StudentController::class, 'index']);
    Route::post('/save', [StudentController::class, 'save']);
    Route::post('/update', [StudentController::class, 'update']);
    Route::post('/delete', [StudentController::class, 'destroy']);
});
