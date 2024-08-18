<?php

namespace App\Http\Controllers\BEController;

use App\Models\Order;
use App\Models\Employee;
use App\Models\Juragan;
use App\Models\Notiforder;
use App\Models\Notif;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\ValidatedData;

class Notifdinamis extends Controller
{
    public function Notif_dinamis(Request $request)
    {
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([ 
            'id_order' => 'required|exists:orders,id',
            'id_employee' => 'required|exists:employees,id',
            'id_juragan' => 'required|exists:juragans,id',
        ]);

        // Mengambil data entitas yang diperlukan
        $cs = Employee::findOrFail($request->id_employee);
        $juragan = Juragan::findOrFail($request->id_juragan);
        $order = Order::findOrFail($request->id_order);

        // Menyusun teks notifikasi
        $teks = "Selamat kepada {$cs->name} dari {$juragan->name_juragan} sudah melakukan closing pada order id: {$order->id}.";

        // Mengambil audio berdasarkan id order yang sesuai pada table notifs
        $audio = Notif::where('teks', 'halo coba nih')->pluck('audio')->first();

        // Pastikan audio tidak null
        if ($audio === null) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak dapat menemukan audio untuk notifikasi ini.',
            ], 500);
        }

            // Membuat dan menyimpan objek notifikasi baru
            $notification = new Notiforder([
            'teks' => $teks,
            'audio' => $audio,
            'id_order' => $order->id,
            ]);

            $notification->save();

        return response()->json([
            'data' => $order,
            'success' => true,
            'message' => 'Notifikasi berhasil ditambahkan',
        ], 200);
    }

    public function update(Request $request, $notificationId)
    {
        //Menemukan notif berdasarkan id
        $notification = Notiforder::find($notificationId);
        //Jika notif tidak ditemukan
        if (!$notification) {
            return response()->json(['message' => 'Notif tidak ditemukan'], 404);
        }

        //Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'status'=> 'required|in:belum_proses,cek_pembayaran,dalam_proses,orderan_selesai',
        ]);

        // Mengambil entitas Order berdasarkan id_order dari notifikasi
        $order = Order::find($notification->id_order);

        // Jika entitas Order tidak ditemukan
        if (!$order) {
            return response()->json(['message' => 'Pesanan tidak ditemukan'], 404);
        }

        //Update status order
        $order->status = $validatedData['status'];
        $order->save();

        //Jika status adalah 'orderan_selesai', hapus notif dari table
        if($order->status == 'orderan_selesai') {
            $notification->delete();
            return response()->json(['message' => 'Notifikasi berhasil dihapus karena status orderan_selesai'], 200);
        }
        

        return response()->json(['message' => 'Status order berhasil diupdate'], 200);
    }


    public function delete($notificationId)
    {
        //Menemukan notif berdasarkan id
        $notification = Notiforder::find($notificationId);

        //Jika notif tifak ditemukan
        if (!$notification) {
            return response()->json(['success' => 'Notif tidak ditemukan'], 404);
        }

        //Hapus notif
        $notification->delete();

        return response()->json(['success' => 'Notif berhasil dihapus'], 200);

    }
}