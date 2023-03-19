<?php

namespace App\Listeners;

use App\Events\SendMessageToWaEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendMessageToWaListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(SendMessageToWaEvent $event)
    {
        info('send message wa event', [$event->message, $event->targetPhoneNumber]);
    }
}