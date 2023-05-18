<?php

use Illuminate\Http\Request;
use Modules\Lms\Http\Controllers\CourseActivityController;
use Modules\Lms\Http\Controllers\CourseController;
use Modules\Lms\Http\Controllers\MyCourseController;
use Modules\Lms\Http\Controllers\QuestionController;
use Modules\Lms\Http\Controllers\QuizController;

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

// Route::prefix('lms')->middleware('auth:sanctum')->group(function () {
Route::prefix('lms')->group(function () {
    Route::get('course/datatable', [CourseController::class, 'datatable']);

    Route::get('course/activity', [CourseActivityController::class, 'index']);

    Route::get('quiz/datatable', [QuizController::class, 'datatable']);
    Route::resource('quiz', QuizController::class)->only(['store', 'update', 'destroy']);
    Route::get('quiz/{quiz_id}/question/datatable', [QuestionController::class, 'quiz_datatable']);
    Route::post('quiz/question/add', [QuestionController::class, 'add_quiz_question']);
    Route::delete('quiz/question/remove', [QuestionController::class, 'remove_quiz_question']);

    Route::get('question/datatable', [QuestionController::class, 'datatable']);
    Route::resource('question', QuestionController::class)->only(['store', 'destroy']);

    Route::get('my/course/datatable', [MyCourseController::class, 'datatable']);
    Route::get('my/course/{course_id}/activity/datatable', [MyCourseController::class, 'activity_datatable']);
});