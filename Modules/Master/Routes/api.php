<?php

use Illuminate\Http\Request;
use Modules\Master\Http\Controllers\SchoolController;
use Modules\Master\Http\Controllers\UserController;

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

Route::prefix('master')->group(function () {
    Route::get('user/datatable', [UserController::class, 'datatable']);
    Route::get('school/datatable', [SchoolController::class, 'datatable']);
});