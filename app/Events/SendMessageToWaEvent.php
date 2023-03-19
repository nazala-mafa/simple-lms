<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendMessageToWaEvent
{
    use Dispatchable, SerializesModels;

    public $message;
    public $targetPhoneNumber;

    public function __construct($message, $targetPhoneNumber)
    {
        $this->message = $message;
        $this->targetPhoneNumber = $targetPhoneNumber;
    }

}