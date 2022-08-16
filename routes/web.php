<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{StudentController, CourseController};
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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('student', StudentController::class);
Route::put('student/{student}/restore',[StudentController::class, 'restore'])->name('student.restore');


Route::get('courses', [CourseController::class, 'index'])->name('courses');
