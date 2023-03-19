<?php

use App\Events\MyEvent;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('pusher.channels');
});

Route::get('/pusher', function () {
    $res = event(new MyEvent([
        'message' => 'hello world'
    ]));
    dd($res);
});