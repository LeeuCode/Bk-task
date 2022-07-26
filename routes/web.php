<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['auth']], function () {
    
    //Schools Routes.
    Route::get('/', [SchoolController::class, 'index'])->name('schools');
    Route::get('/schools/tarched', [SchoolController::class, 'trashed'])->name('schools.trached');
    Route::get('/school/create', [SchoolController::class, 'create'])->name('schools.create');
    Route::get('/school/edit/{id}', [SchoolController::class, 'edit'])->name('schools.edit');
    Route::post('/school/store', [SchoolController::class, 'store'])->name('school.store');
    Route::post('/school/update/{id}', [SchoolController::class, 'update'])->name('school.update');
    Route::delete('/school/delete/{id}', [SchoolController::class, 'destroy'])->name('school.delete');
    Route::post('/school/restore/{id}', [SchoolController::class, 'restore'])->name('schools.restore');
    Route::post('/school/force/delete/{id}', [SchoolController::class, 'forceDelete'])->name('schools.forceDelete');

    // Students Routes.
    Route::get('students', [StudentController::class, 'index'])->name('students');
    Route::get('/students/tarched', [StudentController::class, 'trashed'])->name('students.trached');
    Route::get('/student/create', [StudentController::class, 'create'])->name('students.create');
    Route::get('/student/edit/{id}', [StudentController::class, 'edit'])->name('students.edit');
    Route::post('/student/store', [StudentController::class, 'store'])->name('student.store');
    Route::post('/student/update/{id}', [StudentController::class, 'update'])->name('student.update');
    Route::delete('student/delete/{id}', [StudentController::class, 'destroy'])->name('student.delete');
    Route::post('/student/restore/{id}', [StudentController::class, 'restore'])->name('students.restore');
    Route::post('/student/force/delete/{id}', [StudentController::class, 'forceDelete'])->name('students.forceDelete');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
