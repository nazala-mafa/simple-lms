<?php

use Illuminate\Http\Request;
use Modules\Lms\Http\Controllers\CourseActivityController;
use Modules\Lms\Http\Controllers\CourseController;

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

Route::prefix('lms')->group(function () {
    Route::get('course/datatable', [CourseController::class, 'datatable'])->name('course.datatable');

    Route::get('course/activity', [CourseActivityController::class, 'index'])->name('course.activity');
});