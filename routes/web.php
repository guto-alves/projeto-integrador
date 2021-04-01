<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonPlanController;
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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::resources([
        'course' => CourseController::class
    ]);

    Route::get('course/{course}/lesson', [LessonPlanController::class, 'create'])->name('lessons.create');
    Route::post('course/{course}/lesson', [LessonPlanController::class, 'store'])->name('lessons.store');
});
