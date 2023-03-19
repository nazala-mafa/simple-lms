<?php


use App\Events\SendMessageToWaEvent;
use App\Jobs\SendEmailJob;
use Illuminate\Support\Facades\Route;

Route::get('test/', function () {
  return view('test.pusher.channels');
});

Route::get('test/job', function () {
  // dispatch((new SendEmailJob('annad8388@gmail.com'))->delay(now()->addSeconds(3)));
  dispatch(new SendEmailJob('annad8388@gmail.com'));
  // Artisan::call('queue:work', [
  //     '--once' => true,
  //     '--queue' => 'default',
  //     '--timeout' => 60,
  //     '--tries' => 3
  // ]);
  echo 'email sent';
});

Route::get('test/event', function () {
  event(new SendMessageToWaEvent('pesan-2', '0898887776661'));
});