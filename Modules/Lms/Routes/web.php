<?php
use Modules\Lms\Http\Controllers\CourseController;

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

Route::prefix('lms')->middleware(['role:Super Admin|Student|Teacher'])->group(function () {
    Route::get('/', 'LmsController@index');

    Route::resource('course', CourseController::class)->names('lms.course');
    Route::post('course.add-partisipant', [CourseController::class, 'add_partisipant'])->name('lms.course.add-partisipant');

    Route::resource('course/activity', CourseActivityController::class)->only('store')->names('lms.course.activity');
});