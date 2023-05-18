<?php
use Modules\Lms\Http\Controllers\AnswerController;
use Modules\Lms\Http\Controllers\CourseActivityController;
use Modules\Lms\Http\Controllers\CourseController;
use Modules\Lms\Http\Controllers\MyCourseController;
use Modules\Lms\Http\Controllers\QuestionController;
use Modules\Lms\Http\Controllers\QuizController;

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
    Route::resource('course/activity', CourseActivityController::class)->only('store', 'destroy')->names('lms.course.activity');

    Route::resource('quiz', QuizController::class)->names('lms.quiz')->only('index', 'edit');

    Route::resource('question', QuestionController::class)->names('lms.question')->only('index', 'edit', 'update');

    Route::resource('answer', AnswerController::class)->names('lms.answer');

    // List of My Courses
    Route::resource('my/course', MyCourseController::class)->names('lms.my.course')->only('show', 'index');
    // List of Activities of My Course
    Route::get('my/course/{course_id}/activity/{activity_id}', [MyCourseController::class, 'do_activity'])->name('lms.my.course.activity');
    // Show Quiz
    Route::get('my/course/{course_id}/activity/{activity_id}/quiz/{quiz_id}', [MyCourseController::class, 'quiz_do'])->name('lms.my.course.quiz_do');
    Route::post('my/course/submit', [MyCourseController::class, 'submit_answers'])->name('lms.my.course.submit');
});