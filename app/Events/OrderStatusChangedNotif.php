<?php


namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;

class OrderStatusChangedNotif
{
    use Dispatchable, SerializesModels;

    public $orderId;
    public $newStatus;

    public function __construct($orderId, $newStatus)
    {
        $this->orderId = $orderId;
        $this->newStatus = $newStatus;
    }
}
