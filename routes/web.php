<?php

use App\Http\Controllers\CKEditorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    if (auth()->check()) {
        return redirect('/home');
    } else {
        return view('welcome');
    }
});

include_once 'web/test.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('product', ProductController::class)->names('product');

Route::post('ckeditor/upload', [CKEditorController::class, 'upload'])->name('ckeditor.image-upload')->middleware('auth');