<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('subjects', SubjectController::class)->except(['create', 'update', 'edit']);
    Route::post('subjects/update-subject', [SubjectController::class, 'update'])->name('subjects.update');

    Route::resource('students', StudentController::class);

    Route::post('students/add-note', [StudentController::class, 'createNote'])->name('students.notes.store');
    Route::get('/students/abstract/{student}', [StudentController::class, 'abstract'])->name('students.abstract');

    Route::resource('courses', CourseController::class);

    Route::get('admins/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::post('admins/profile-update', [AdminController::class, 'update'])->name('admin.update');
});
