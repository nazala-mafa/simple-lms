<?php

use Illuminate\Http\Request;
use Modules\Forum\Http\Controllers\FeedController;

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


Route::prefix('forum')->middleware('auth:sanctum')->group(function () {
    Route::resource('feed', FeedController::class)->names('feed')->except('create', 'edit');
    Route::post('feed/{feed_id}/like', [FeedController::class, 'like']);
    Route::post('feed/{feed_id}/dislike', [FeedController::class, 'dislike']);
    Route::post('feed/{feed_id}/comment', [FeedController::class, 'store_comment']);
});