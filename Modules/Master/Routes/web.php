<?php
use Modules\Master\Http\Controllers\MasterController;
use Modules\Master\Http\Controllers\SchoolController;
use Modules\Master\Http\Controllers\SchoolStatusController;
use Modules\Master\Http\Controllers\UserController;

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

Route::prefix('master')->middleware(['auth', 'role:Super Admin'])->group(function () {
    Route::get('/', [MasterController::class, 'index']);

    Route::resource('user', UserController::class)->names('master.user');
    Route::resource('school/status', SchoolStatusController::class)->names('master.school.status');
    Route::resource('school', SchoolController::class)->names('master.school');
});