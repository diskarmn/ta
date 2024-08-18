<?php


namespace App\Listeners;

use App\Events\makeNotifMessage;
use App\Models\Notif;
use App\Models\Order;
use App\Models\Juragan;
use App\Models\Employee;
use App\Models\Notiforder;
use App\Events\OrderCreatedNotif;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Events\OrderStatusChangedNotif;

class SendNotif
{

    public static function handleOrderCreated(OrderCreatedNotif $event)
    {
        return 'test';
    }


    public function handleOrderStatusChanged(OrderStatusChangedNotif $event)
    {
        $order = Order::with(['juragan', 'served_by'])->findOrFail($event->orderId);
        $statusMessages = [
            'belum_proses' => "Order dengan order number {$order->order_number} masih dalam status belum diproses.",
            'cek_pembayaran' => "Pembayaran untuk order dengan order number {$order->order_number} sedang dicek.",
            'dalam_proses' => "Order dengan order number {$order->order_number} sedang dalam proses.",
            'orderan_selesai' => "Order dengan order number {$order->order_number} telah selesai."
        ];

        $teks = $statusMessages[$order->status] ?? "Status order dengan order number {$order->order_number} telah diperbarui.";

        $audio = Notif::where('teks', 'halo coba nih')->pluck('audio')->first();

        if ($audio !== null) {
            $notification = new Notiforder([
                'teks' => $teks,
                'audio' => $audio,
            ]);
            $notification->save();
        }
    }


    public function subscribe($events)
    {
        $events->listen(
            OrderCreatedNotif::class,
            [SendNotif::class, 'handleOrderCreated']
        );

        $events->listen(
            OrderStatusChangedNotif::class,
            [SendNotif::class, 'handleOrderStatusChanged']
        );
    }
}
