<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});

Route::group(['prefix' => '/auth', 'namespace' => '\App\Http\Controllers'], function () {
  Route::post('/login', 'AuthController@login');
  Route::post('/register', 'AuthController@register');
});

Route::get('product/datatable', [ProductController::class, 'datatables']);
Route::resource('product', '\App\Http\Controllers\Api\ProductController')->except('create', 'edit');

Route::get('quiz/datatable', [QuizController::class, 'datatable']);
Route::resource('quiz', QuizController::class)->only(['store', 'destroy'])->names('quiz');

Route::get('quiz/{quiz_id}/question/datatable', [QuestionController::class, 'datatable']);
Route::resource('quiz/{quiz_id}/question', QuestionController::class)->only(['store'])->names('question');

Route::resource('quiz/{quiz_id}/question/{question_id}/answer', AnswerController::class)->only(['store'])->names('answer');