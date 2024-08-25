<?php

namespace App\Http\Controllers\BEController;

use Carbon\Carbon;
use App\Models\Resi;
use Dotenv\Util\Str;
use App\Models\Notif;
use App\Models\Order;
use App\Models\Barang;
use App\Models\Juragan;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Keranjang;
use App\Models\Notiforder;
use App\Models\BarangOrder;
use App\Listeners\SendNotif;
use App\Models\UpdateProses;
use Illuminate\Http\Request;
use App\Events\OrderCreatedNotif;
use Illuminate\Support\Facades\DB;
use App\Events\MyEventNotification;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\ViewTulisOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderanProcess extends Controller
{

    public function addOrderan(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'order_date' => 'required',
            'id_customer' => 'required',
            'id_produk.*' => 'required',
            'size.*' => 'required',
            'quantity.*' => 'required',
            'total_amount.*' => 'required',
            'notes.*' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $pelanggan = Customer::where('name', $request->id_customer)->first();
        $cs = Employee::where('name', $request->served_by)->first();
        $juragan = Juragan::where('name_juragan', $request->juragan)->first();

        // Cek keberadaan pelanggan, CS, dan juragan
        if (!$pelanggan || !$cs || !$juragan) {
            return response()->json(['error' => 'Pelanggan, CS, atau Juragan tidak ditemukan'], 404);
        }

        $inisialJuragan = implode('', array_map(function ($item) {
            return $item[0];
        }, explode(' ', strtoupper($request->juragan))));

        $orderNumber = $this->generateOrderNumber($inisialJuragan);
        $totalPoints = 0;
        $orders = [];
        foreach ($request->id_produk as $index => $id_produk) {
            $produk = Barang::whereRaw('LOWER(kd_produk) = ?', [strtolower($id_produk)])->first();

            if (!$produk) {
                continue; // Skip produk yang tidak ditemukan
            }

            $pointsForThisOrder = $produk->point * $request->quantity[$index];
            $totalPoints += $pointsForThisOrder;

            $order = new Order([
                'order_date' => $request->order_date,
                'served_by' => $cs->id,
                'size' => $request->size[$index],
                'quantity' => $request->quantity[$index],
                'total_amount' => $request->total_amount[$index],
                'notes' => $request->notes,
                'payment_method' => 'COD',
                'source' => '-',
                'tgl_bayar' => now(),
                'paid_amount' => 0,
                'remaining_amount' => 0,
                'status' => 'cek_pembayaran',
                'keterangan_status' => 'orderan baru',
                'deadline' => now()->addDays(7),
                'order_number' => $orderNumber,
                'id_customer' => $pelanggan->id,
                'juragan' => $juragan->id,
                'id_produk' => $produk->id,

            ]);

            if ($order->save()) {
                $orders[] = $order; // Menambahkan order yang berhasil disimpan ke dalam array
            }
        }

        // if (!empty($orders)) {
        // }
        $notif = $this->notif($orderNumber, $cs->name, $juragan->name_juragan);
        OrderCreatedNotif::dispatch($notif);

        if ($totalPoints > 0) {
            $pelanggan->increment('point', $totalPoints);
        }

        return response()->json([
            'data' => $orders,
            'success' => true,
            'message' => 'Orderan berhasil ditambahkan',
            'pelanggan' => $totalPoints,
        ], 200);
    }

    public function notif($orderNumber, $csName, $juraganName)
    {
        $teks = "Ada order baru untuk $juraganName dengan order number $orderNumber oleh cs $csName";





        // Return combined array as JSON

        return  $teks;
    }


    public function notifEditOrderan ($orderNumber, $employeesName)
    {
        $teks = "$employeesName mengedit Data Pesanan pada invoice $orderNumber";






        return $teks;
    }

    public function notifAddInvoice($orderNumber, $employeesName)
    {
        $teks = "$employeesName  membuat invoice pada orderan $orderNumber";






        return $teks;
    }

    public function notifPembayaranMasuk($orderNumber, $payment_method)
    {
        $teks = "Orderan pada invoice $orderNumber telah melakukan pembayaran dengan $payment_method | Silahkan di cek";






        return $teks;
    }

    public function notifProsesOrderan($orderNumber, $status, $kelengkapan)
    {
        // Map id_status ke teks notifikasi
        $statusMap = [
            1 => "Orderan pada invoice $orderNumber telah ditambahkan.",
            2 => "Orderan pada invoice $orderNumber telah dibayar lunas.",
            3 => "Data orderan pada invoice $orderNumber dengan ",
            4 => "Bahan untuk orderan pada invoice $orderNumber dengan ",
            5 => "Proses sablon untuk orderan pada invoice $orderNumber dengan ",
            6 => "Proses bordir untuk orderan pada invoice $orderNumber dengan ",
            7 => "Proses penjahitan untuk orderan pada invoice $orderNumber dengan",
            8 => "Proses quality control untuk orderan pada invoice $orderNumber dengan ",
            9 => "Orderan pada invoice $orderNumber dalam tahap Packing dengan ",
            10 => "Orderan pada invoice $orderNumber sedang diantar.",
        ];

        // Tambahkan pesan kelengkapan jika tersedia
        if (array_key_exists($status, $statusMap)) {
            $teks = $statusMap[$status];
            if ($kelengkapan) {
                $teks .= " Status kelengkapan: $kelengkapan.";
            }
        } else {

            $teks = "Status pesanan tidak valid untuk orderan pada invoice $orderNumber.";
        }





        return $teks;
    }

    public function notifPengiriman($orderNumber)
    {
        $teks = "Orderan pada invoice $orderNumber telah dikirimkan";






        return $teks;
    }

    public function notifStatus($status, $orderNumber )
    {
        // Inisialisasi teks status berdasarkan status orderan
        if ($status == 'Belum Proses') {
            $teks = "Status Orderan pada invoice $orderNumber masih di tahap 'Belum Proses'";
        } elseif ($status == 'Cek Pembayaran') {
            $teks = "Status Orderan pada invoice $orderNumber masih di tahap 'Cek Pembayaran'";
        } elseif ($status == 'Dalam Proses') {
            $teks = "Status Orderan pada invoice $orderNumber masih di tahap 'Dalam Proses'";
        } elseif ($status == 'Orderan Selesai') {
            $teks = "Status Orderan pada invoice $orderNumber sudah di tahap 'Orderan Selesai'";
        } else {
            $teks = "Status tidak diketahui untuk invoice $orderNumber";
        }

        // Buat notifikasi baru dengan teks dan audio yang sudah diatur


        // Simpan notifikasi ke database


        // Kembalikan teks status
        return $teks;

    }

    public function notifAddResi($orderNumber)
    {
        $teks = "Resi pengiriman pada Orderan  $orderNumber telah di tambahkan";






        return $teks;
    }

    public function notifAcceptOrder($orderNumber, $customer)
    {
        $teks = " Orderan pada invoice $orderNumber telah di terima oleh $customer ";






        return $teks;
    }

    public function notifClosing($orderNumber)
    {
        $teks = "Orderan pada incoive $orderNumber telah selesai ";






        return $teks;
    }


    private function generateOrderNumber($inisialJuragan)
    {
        do {
            $randomNumber = rand(10000000, 99999999);
            $orderNumber = $inisialJuragan . $randomNumber;
        } while (Order::where('order_number', $orderNumber)->exists());

        return $orderNumber;
    }

    public function keorders(Request $request)
    {
        $user = Auth::guard('employee')->user();
        $total_semua = $request->input('total_f');
        $kdProdukArray = $request->input('kd_produk_f');
        $sizeArray = $request->input('size_f');
        $qtyArray = $request->input('qty_f');
        $subtotal = $request->input('subtotal_f');
        $juragan = $request->input('juragan_f');
        $JuraganName = $request->input('namajuragan');
        $sumber = $request->input('sumber_f');
        $served = $request->input('served_by');
        $tanggal = $request->input('tanggal_order');
        $id = $request->input('id_pelanggan_keorder');
        $ongkir = $request->input('jasa_ongkir');
        $dana_ongkir = $request->input('ongkir');
        $note = $request->input('note');

        $total_qty = array_sum($request->input('qty_f'));

        $inisialJuragan =   strtoupper(substr($JuraganName, 0, 1));
        $id_pelanggan_part = strtoupper(substr($id, 0, 3));
        $orderDate = \Carbon\Carbon::parse($tanggal);

        $month = $orderDate->format('m');
        $day = $orderDate->format('d');
        $orderNumber = $inisialJuragan . $id_pelanggan_part . $month . $day;


        $order = new Order();
        $order->total_amount = $total_semua;
        $order->total_quantity = $total_qty;
        $order->juragan = $juragan;
        $order->source = $sumber;
        $order->served_by = $served;
        $order->order_date = $tanggal;
        $order->id_customer = $id;
        $order->notes = $note;
        $order->order_number = $orderNumber;
        $order->ongkir = $ongkir;
        $order->dana_ongkir = $dana_ongkir;

        if (in_array($sumber, ['Bukalapak', 'Lazada', 'Shopee', 'Tokopedia'])) {
            $order->paid_amount = $total_semua;
            $order->status = 'dalam_proses';
        }


        $order->save();

        $orderId = Order::where('order_number', $orderNumber)->value('id');

        $orders = [];
        foreach ($kdProdukArray as $index => $kdProduk) {
            $barangOrder = BarangOrder::create([
                'id_produk' => $kdProduk,
                'id_order' => $orderId,
                'size' => $sizeArray[$index],
                'quantity' => $qtyArray[$index],
                'subtotal' => $subtotal[$index],
                'order_number' => $orderNumber,
            ]);
            if ($barangOrder->save()) {
                $orders[] = $barangOrder;
            }
        }


        if (!empty($orders)) {
            Log::info('Memulai memicu event OrderCreatedNotif dengan orders: ', $orders);
            event(new OrderCreatedNotif(collect($orders)));
            Log::info('Event OrderCreatedNotif dipicu.');
        }

        ViewTulisOrder::where('employee_id', $user->id)->get()->each(function ($item) {
            $item->delete();
        });
        UpdateProses::create([
            'id_order'=> $orderId,
            'nama_proses' => 'pesanan_ditambahkan',
            'order_number' => $orderNumber,
        ]);

        if (in_array($sumber, ['Bukalapak', 'Lazada', 'Shopee', 'Tokopedia'])) {
            UpdateProses::create([
                'id_order'=> $orderId,
                'nama_proses' => 'pembayaran',
                'order_number' => $orderNumber,
                'kelengkapan' => 'lengkap',
            ]);
        }

        $juragan = Juragan::where('name_juragan', $JuraganName)->first();


        return redirect()->back()->with('success', 'Data berhasil ditambahkan ke keranjang.');
    }



    public function updateOrderan(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'juragan' => 'required',
            'nama_pelanggan' => 'required',
            'payment_method' => 'required',
            'source' => 'required',
            'served_by' => 'required',
            'tgl_bayar' => 'required',
            'kd_produk' => 'required',
            'size' => 'required',
            'quantity' => 'required',
            'total_amount' => 'required',
            'paid_amount' => 'required',
            'remaining_amount' => 'required',
            'notes' => 'required',
            'status' => 'required',
            'keterangan_status' => 'required',
            'deadline' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Cari pelanggan berdasarkan nama
        $pelanggan = Customer::where('name', $request->nama_pelanggan)->first();
        if (!$pelanggan) {
            return response()->json(['error' => 'Pelanggan tidak ditemukan'], 404);
        }

        // Cari produk berdasarkan kode
        $produk = Barang::where('kd_produk', $request->kd_produk)->first();
        if (!$produk) {
            return response()->json(['error' => 'Produk tidak ditemukan'], 404);
        }

        $cs = Employee::where('name', $request->served_by)->first();
        if (!$cs) {
            return response()->json(['error' => 'Cs tidak ditemukan'], 404);
        }

        $juragan = Juragan::where('name_juragan', $request->juragan)->first();
        if (!$juragan) {
            return response()->json(['error' => 'Juragan tidak ditemukan'], 404);
        }

        $data = Order::findOrFail($id);
        $data->fill([
            'juragan' => $juragan->id,
            'id_pelanggan' => $pelanggan->id,
            'payment_method' => $request->payment_method,
            'source' => $request->source,
            'served_by' => $cs->id,
            'tgl_bayar' => $request->tgl_bayar,
            'id_produk' => $produk->id,
            'size' => $request->size,
            'quantity' => $request->quantity,
            'total_amount' => $request->total_amount,
            'paid_amount' => $request->paid_amount,
            'remaining_amount' => $request->remaining_amount,
            'notes' => $request->notes,
            'status' => $request->status,
            'keterangan_status' => $request->keterangan_status,
            'deadline' => $request->deadline
        ]);
        $data->save();

        return response()->json([
            'success' => true,
            'message' => 'Orderan berhasil diupdate',
            'data' => $data
        ], 200);
    }

    public function deleteOrderan($order_number)
    {
        //
        $data = Order::where('order_number', $order_number)->first();

        if ($data) {
            // Menghapus data jika ditemukan
            $data->delete();
            // Mengembalikan response JSON untuk kasus sukses
            return redirect()->route('semua-orderanCS')->with('success', 'Data successfully deleted.');
        } else {
            // Mengembalikan response JSON untuk kasus data tidak ditemukan
            return response()->json([
                'success' => false,
                'message' => 'Data not found.'
            ], 404); // HTTP status code 404 Not Found
        }
    }


    public function updateOnProcess(Request $request, $orderId)
    {
        $status = $request->input('status');
        $order_number = $orderId;
        $kelengkapan = $request->input('kelengkapan');
        $keterangan = $request->input('keterangan');
        $order = Order::where('order_number', $order_number)->first();
        UpdateProses::create([
            'id_order' => $order->id,
            'nama_proses' => $status,
            'order_number' => $order_number,
            'keterangan' => $keterangan,
            'kelengkapan' => $kelengkapan
        ]);



        return redirect()->back();
    }

    public function notifBerjalan($orderNumber, $cs, $juragan)
    {
        // Ambil order berdasarkan orderNumber yang statusnya selesai
        $order = Order::where('order_number', $orderNumber)
                      ->where('status', 'orderan_selesai')
                      ->first();

        // Jika order tidak ditemukan atau belum selesai, kembalikan pesan error atau handle sesuai kebutuhan
        if (!$order) {
            return 'Order tidak ditemukan atau belum selesai';
        }

        // Ambil notifikasi yang statusnya aktif
        $notif = Notif::where('status', 'active')->first(); // Sesuaikan query jika ada kondisi khusus

        // Jika ada data notif, ambil teksnya, jika tidak set default teks
        $teks = "Selamat kepada $cs, $notif->teks dari $juragan";

        // Buat instance Notiforder dengan teks yang didapatkan


        // Simpan notifikasi


        // Kembalikan teks
        return $teks;
    }

    public function resisa(Request $request, $orderNumber)
    {
        $request->validate([
            'tanggal_kirim' => 'required|date',
            'resi' => 'required|string|max:50',
        ]);
        $order = Order::where('order_number', $orderNumber)->first();
        $order->update([
            'status' => 'orderan_selesai'
        ]);

        UpdateProses::create([
            'id_order' => $order->id,
            'nama_proses' => 'diantar',
            'order_number' => $orderNumber,
        ]);


        return redirect()->back();
    }

}
