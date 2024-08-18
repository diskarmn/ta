<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MyEventNotification implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $audioURL;

    public function __construct(string $message, string $audioURL)
    {
        $this->message = $message;
        $this->audioURL = $audioURL;
    }

    public function broadcastWith()
    {
        return [
            'message' => $this->message,
            'audioURL' => $this->audioURL,
        ];
    }

    public function broadcastOn()
    {
        return [new Channel('Pos-Djuragan')];
    }

    public function broadcastAs()
    {
        return 'MyEvent';
    }
}
