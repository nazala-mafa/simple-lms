<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CKEditorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SchoolController;
use Illuminate\Support\Facades\Route;

include_once 'web/test.php';

Auth::routes();

Route::get('login-with-id/{user_id}', [AuthController::class, 'login_with_id'])->middleware('auth', 'role:Super Admin');

Route::get('/', [SchoolController::class, 'index']);
Route::get('/{slug}', [SchoolController::class, 'show']);

Route::get('/home', [HomeController::class, 'index'])->name('home');
// Route::resource('product', ProductController::class)->names('product')->middleware('auth');

Route::post('ckeditor/upload', [CKEditorController::class, 'upload'])->name('ckeditor.image-upload')->middleware('auth');