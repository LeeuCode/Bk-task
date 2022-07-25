<?php

use Illuminate\Support\Facades\Route;

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
    Route::get('/', [App\Http\Controllers\SchoolController::class, 'index'])->name('schools');
    Route::get('/schools/tarched', [App\Http\Controllers\SchoolController::class, 'trashed'])->name('schools.trached');
    Route::get('/school/create', [App\Http\Controllers\SchoolController::class, 'create'])->name('schools.create');
    Route::get('/school/edit/{id}', [App\Http\Controllers\SchoolController::class, 'edit'])->name('schools.edit');
    Route::post('/school/store', [App\Http\Controllers\SchoolController::class, 'store'])->name('school.store');
    Route::post('/school/update/{id}', [App\Http\Controllers\SchoolController::class, 'update'])->name('school.update');
    Route::delete('/school/delete/{id}', [App\Http\Controllers\SchoolController::class, 'destroy'])->name('school.delete');
    Route::post('/school/restore/{id}', [App\Http\Controllers\SchoolController::class, 'restore'])->name('schools.restore');
    Route::post('/school/force/delete/{id}', [App\Http\Controllers\SchoolController::class, 'forceDelete'])->name('schools.forceDelete');

    // Students Routes.
    Route::get('students', [App\Http\Controllers\StudentController::class, 'index'])->name('students');
    Route::get('/students/tarched', [App\Http\Controllers\StudentController::class, 'trashed'])->name('students.trached');
    Route::get('/student/create', [App\Http\Controllers\StudentController::class, 'create'])->name('students.create');
    Route::get('/student/edit/{id}', [App\Http\Controllers\StudentController::class, 'edit'])->name('students.edit');
    Route::post('/student/store', [App\Http\Controllers\StudentController::class, 'store'])->name('student.store');
    Route::post('/student/update/{id}', [App\Http\Controllers\StudentController::class, 'update'])->name('student.update');
    Route::delete('student/delete/{id}', [App\Http\Controllers\StudentController::class, 'destroy'])->name('student.delete');
    Route::post('/student/restore/{id}', [App\Http\Controllers\StudentController::class, 'restore'])->name('students.restore');
    Route::post('/student/force/delete/{id}', [App\Http\Controllers\StudentController::class, 'forceDelete'])->name('students.forceDelete');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
