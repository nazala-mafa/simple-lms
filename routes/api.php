<?php

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

Route::resource('product', '\App\Http\Controllers\ProductController')->except('create', 'edit');
Route::group(['prefix' => '/product', 'namespace' => '\App\Http\Controllers'], function () {
});