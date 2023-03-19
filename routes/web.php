<?php

use App\Events\MyEvent;
use App\Jobs\SendEmailJob;
use App\Mail\WelcomeMail;
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

Route::get('/job', function () {
    // dispatch((new SendEmailJob('annad8388@gmail.com'))->delay(now()->addSeconds(3)));
    dispatch((new SendEmailJob('annad8388@gmail.com')));
    // Artisan::call('queue:work', [
    //     '--once' => true,
    //     '--queue' => 'default',
    //     '--timeout' => 60,
    //     '--tries' => 3
    // ]);
    echo 'email sent';
});