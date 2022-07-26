<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SchoolController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\PassportController;

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

Route::post('register', [PassportController::class, 'register']);
Route::post('login', [PassportController::class, 'login']);


// put all api protected routes here
Route::middleware('auth:api')->group(function () {

    // School Api Route.
    Route::get('schools', [SchoolController::class, 'index']);
    Route::post('school/store', [SchoolController::class, 'store'])->name('api.school.store');
    Route::post('school/update/{id}', [SchoolController::class, 'update']);
    Route::post('school/delete/{id}', [SchoolController::class, 'delete']);
    Route::post('school/restore/{id}', [SchoolController::class, 'restore']);
    Route::post('school/force/delete/{id}', [SchoolController::class, 'forceDelete']);


    // Student Api Route.
    Route::get('students', [StudentController::class, 'index']);
    Route::post('student/store', [StudentController::class, 'store']);
    Route::post('student/update/{id}', [StudentController::class, 'update']);
    Route::post('student/delete/{id}', [StudentController::class, 'update']);
    Route::delete('student/delete/{id}', [StudentController::class, 'destroy']);
    Route::post('student/restore/{id}', [StudentController::class, 'restore']);
    Route::post('student/force/delete/{id}', [StudentController::class, 'forceDelete']);

    // Logout
    Route::post('logout', [PassportController::class, 'logout']);
});
