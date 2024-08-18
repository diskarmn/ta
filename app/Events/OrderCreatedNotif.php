<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Support\Collection;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OrderCreatedNotif implements ShouldBroadcast
{
    use Dispatchable,  InteractsWithSockets, SerializesModels;

    public $data;

    public function __construct($message)
    {
        $this->data = [
            'date' => date('D, d M Y (H:i:s)'), // Get current date and time
            'message' => $message
        ];
    }

    public function broadcastOn()
    {
        return new Channel('notif');
    }

    public function broadcastAs()
    {
        return 'notif-show';
    }
}
