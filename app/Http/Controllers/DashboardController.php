<?php

namespace App\Http\Controllers;

use App\Events\OrderCreatedNotif;
use App\Models\Customer;
use App\Models\Juragan;
use App\Models\Order;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\InfoPembayaran;
use App\Models\Notiforder;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{

    // public function indexa()
    // {
    //     $orderanRaw = Order::
    //         join('customers', 'orders.id_customer', '=', 'customers.id')
    //         ->join('barangs', 'orders.id_produk', '=', 'barangs.id')
    //         ->join('employees', 'orders.served_by', '=', 'employees.id')
    //         ->join('juragans', 'orders.juragan', '=', 'juragans.id')
    //         ->select(
    //             'orders.*',
    //             'customers.name as customer_name',
    //             'customers.phone as customer_phone',
    //             'barangs.kd_produk as kd_produk',
    //             'juragans.name_juragan as juraganname',
    //             'employees.name as served_byname',
    //         )
    //         ->distinct()
    //         ->get();
    //     $orderan = $orderanRaw->groupBy('order_number');

    //     $updates = Order::join('update_status_proses', 'orders.keterangan_status_id', '=', 'update_status_proses.id')
    //         ->select('update_status_proses.id_status', 'update_status_proses.kelengkapan')
    //         ->distinct()
    //         ->get()
    //         ->groupBy('order_number');

    //     $dana = Order::where('status', 'cek_pembayaran')
    //         ->get()
    //         ->groupBy('order_number');


    //     $user = auth()->user();
    //     $role = $user->role;

    //     $pelanggan = Customer::get();
    //     $juragan = Juragan::get();
    //     $statistics = $this->orderStatus();
    //     $allorder = Order::join('update_status_proses', 'orders.order_number', '=', 'update_status_proses.order_number')
    //     ->select('update_status_proses.order_number')
    //     ->get();

    //     $notifications = Notiforder::all();
    //     $dataJuragan = DB::table('juragans')->get();
    //     return view('admin.dashboard.semua-orderan', [
    //         'status' => $statistics,
    //         'dana' => $dana,
    //         'allorder' => $allorder,
    //         'orderan' => $orderan,
    //         'update'=>$updates,
    //         'pelanggan' => $pelanggan,
    //         'juragan' => $juragan,
    //         'notifications' => $notifications,
    //         'title' => 'Semua Orderan',
    //         'dataJuragan'=>$dataJuragan

    //     ]);
    // }

    // public function belumprosesA(Request $request)
    // {
    //     $segment = $request->segment(1);

    //     $orderanRaw = Order::where('status', 'belum_proses')
    //         ->join('customers', 'orders.id_customer', '=', 'customers.id')
    //         ->join('barangs', 'orders.id_produk', '=', 'barangs.id')
    //         ->join('employees', 'orders.served_by', '=', 'employees.id')
    //         ->join('juragans', 'orders.juragan', '=', 'juragans.id')
    //         ->leftJoin('update_status_proses', 'orders.order_number', '=', 'update_status_proses.order_number')
    //         ->select(
    //             'orders.*',
    //             'customers.name as customer_name',
    //             'customers.phone as customer_phone',
    //             'barangs.kd_produk as kd_produk',
    //             'juragans.name_juragan as juraganname',
    //             'employees.name as served_byname',
    //             'update_status_proses.updated_at as tanggal_status',
    //             'update_status_proses.id_status as id_status'
    //         )
    //         ->distinct()
    //         ->get();
    //         $dana = Order::where('status', 'cek_pembayaran')
    //         ->get()
    //         ->groupBy('order_number');

    //     $orderan = $orderanRaw->groupBy('order_number');

    //     $statistics = $this->orderStatus();

    //     $pelanggan = Customer::get();
    //     $juragan = Juragan::get();

    //     $allorder = Order::get();
    //     $notifications=Notiforder::all();
    //     $dataJuragan = DB::table('juragans')->get();
    //     return view('admin.dashboard.belum-proses-orderan', [
    //         'orderan' => $orderan,
    //         'allorder' => $allorder,
    //         'status' => $statistics,
    //         'juragan' => $juragan,
    //         'pelanggan' => $pelanggan,
    //         'dana'=>$dana,
    //         'title' => 'Belum Proses Orderan',
    //         'notifications'=>$notifications,
    //         'dataJuragan'=>$dataJuragan
    //     ]);
    // }
    // public function menunggudicekA(Request $request)
    // {
    //     $orderanRaw = Order::where('status', 'cek_pembayaran')
    //         ->join('customers', 'orders.id_customer', '=', 'customers.id')
    //         ->join('barangs', 'orders.id_produk', '=', 'barangs.id')
    //         ->join('employees', 'orders.served_by', '=', 'employees.id')
    //         ->join('juragans', 'orders.juragan', '=', 'juragans.id')

    //         ->select(
    //             'orders.*',
    //             'customers.name as customer_name',
    //             'customers.phone as customer_phone',
    //             'barangs.kd_produk as kd_produk',
    //             'juragans.name_juragan as juraganname',
    //             'employees.name as served_byname'
    //         )
    //         ->get();
    //     $dana = Order::where('status', 'cek_pembayaran')
    //         ->get()
    //         ->groupBy('order_number');




    //     $orderan = $orderanRaw->groupBy('order_number');
    //     $statistics = $this->orderStatus();
    //     $pelanggan = Customer::get();
    //     $juragan = Juragan::get();
    //     $allorder = Order::get();
    //     $notifications=Notiforder::all();
    //     $dataJuragan = DB::table('juragans')->get();
    //     return view('admin.dashboard.menunggu-dicek-orderan', [
    //         'dana' => $dana,
    //         'orderan' => $orderan,
    //         'allorder' => $allorder,
    //         'status' => $statistics,
    //         'juragan' => $juragan,
    //         'pelanggan' => $pelanggan,
    //         'title' => 'Menunggu Dicek Orderan',
    //         'notifications'=>$notifications,
    //         'dataJuragan'=>$dataJuragan
    //     ]);
    // }



//     public function dalamprosesA(Request $request)
//     {
//         $segment = $request->segment(1);
//         $orderanRaw = Order::where('status', 'dalam_proses')
//             ->join('customers', 'orders.id_customer', '=', 'customers.id')
//             ->join('barangs', 'orders.id_produk', '=', 'barangs.id')
//             ->join('employees', 'orders.served_by', '=', 'employees.id')
//             ->join('juragans', 'orders.juragan', '=', 'juragans.id')
//             ->select('orders.*', 'customers.name as customer_name', 'customers.phone as customer_phone', 'barangs.kd_produk as kd_produk', 'juragans.name_juragan as juraganname', 'employees.name as served_byname')
//             ->get();
//         $updates = Order::join('update_status_proses', 'orders.keterangan_status_id', '=', 'update_status_proses.id')
//             ->select('update_status_proses.id_status', 'update_status_proses.kelengkapan')
//             ->distinct()
//             ->get()
//             ->groupBy('order_number');
//             $dana = Order::where('status', 'cek_pembayaran')
//             ->get()
//             ->groupBy('order_number');

//         $orderan = $orderanRaw->groupBy('order_number');
//         $statistics = $this->orderStatus();
//         $pelanggan = Customer::get();
//         $juragan = Juragan::get();
//         $allorder = Order::get();
//         $notifications=Notiforder::all();
//         $dataJuragan = DB::table('juragans')->get();
//         return view('admin.dashboard.dalam-proses-orderan', [
//             'orderan' => $orderan,
//             'allorder' => $allorder,
//             'status' => $statistics,
//             'juragan' => $juragan,
//             'pelanggan' => $pelanggan,
//             'update'=>$updates,
//             'dana'=>$dana,
//             'title' => 'Dalam Proses Orderan',
//             'notifications'=>$notifications,
// 'dataJuragan'=>$dataJuragan
//         ]);
//     }

    // public function orderanselesaiA(Request $request)
    // {
    //     $segment = $request->segment(1);
    //     // $orderan = Order::where('status', 'orderan_selesai')->get();
    //     $orderanRaw = Order::where('status', 'orderan_selesai')
    //         ->join('customers', 'orders.id_customer', '=', 'customers.id')
    //         ->join('barangs', 'orders.id_produk', '=', 'barangs.id')
    //         ->join('employees', 'orders.served_by', '=', 'employees.id')
    //         ->join('juragans', 'orders.juragan', '=', 'juragans.id')
    //         ->select('orders.*', 'customers.name as customer_name', 'customers.phone as customer_phone', 'barangs.kd_produk as kd_produk', 'juragans.name_juragan as juragan', 'employees.name as served_by')
    //         ->get();

    //     $orderan = $orderanRaw->groupBy('order_number');
    //     $statistics = $this->orderStatus();
    //     $pelanggan = Customer::get();
    //     $juragan = Juragan::get();
    //     $notifications=Notiforder::all();
    //     $dataJuragan = DB::table('juragans')->get();
    //     return view('admin.dashboard.orderan-selesai', [
    //         'orderan' => $orderan,
    //         'status' => $statistics,
    //         'juragan' => $juragan,
    //         'pelanggan' => $pelanggan,
    //         'title' => 'Orderan Selesai',
    //         'notifications'=>$notifications,
    //         'dataJuragan'=>$dataJuragan
    //     ]);
    // }


    public function index(Request $request)
    {
        $user = auth()->user();
        $role = $user->role;
        $view = $this->getViewBasedOnRole($role);
        $orderanRaw = Order::
        join('customers', 'orders.id_customer', '=', 'customers.id')
        ->join('barangs', 'orders.id_produk', '=', 'barangs.id')
        ->join('employees', 'orders.served_by', '=', 'employees.id')
        ->join('juragans', 'orders.juragan', '=', 'juragans.id')
        ->select(
            'orders.*',
            'customers.name as customer_name',
            'customers.phone as customer_phone',
            'barangs.kd_produk as kd_produk',
            'juragans.name_juragan as juraganname',
            'employees.name as served_byname',
        )
        ->distinct()
        ->get();
    $orderan = $orderanRaw->groupBy('order_number');

    $updates = Order::join('update_status_proses', 'orders.keterangan_status_id', '=', 'update_status_proses.id')
        ->select('update_status_proses.id_status', 'update_status_proses.kelengkapan')
        ->distinct()
        ->get()
        ->groupBy('order_number');

    $dana = Order::where('status', 'cek_pembayaran')
        ->get()
        ->groupBy('order_number');


    $user = auth()->user();
    $role = $user->role;
    $view = $this->getViewBasedOnRole($role);
    $pelanggan = Customer::get();
    $juragan = Juragan::get();
    $statistics = $this->orderStatus();
    $allorder = Order::join('update_status_proses', 'orders.order_number', '=', 'update_status_proses.order_number')
    ->select('update_status_proses.order_number')
    ->get();

    $notifications = Notiforder::all();


     $dataJuragan = DB::table('juragans')->get();
     $statistics = $this->orderStatus();
    return view($view, [
        'status' => $statistics,
        'dana' => $dana,
        'allorder' => $allorder,
        'orderan' => $orderan,
        'update'=>$updates,
        'pelanggan' => $pelanggan,
        'juragan' => $juragan,
        'notifications' => $notifications,
        'title' => 'Dashboard',
        "dataJuragan" => $dataJuragan,
        'countStatus' => $statistics,
    ]);

    }

    // public function filterByJuragan(Request $request)
    // {
    //     $query = DB::table('orders')
    //         ->join('customers', 'orders.id_customer', '=', 'customers.id')
    //         ->join('barangs', 'orders.id_produk', '=', 'barangs.id')
    //         ->join('employees', 'orders.served_by', '=', 'employees.id')
    //         ->join('juragans', 'orders.juragan', '=', 'juragans.id')
    //         ->select('orders.*', 'customers.name as customer_name', 'customers.phone as customer_phone', 'barangs.kd_produk as kd_produk', 'juragans.name_juragan as juraganname', 'employees.name as served_byname');

    //     $juragan = $request->input('juragan');

    //     $query->when($juragan, function ($q) use ($juragan) {
    //         $q->where('name_juragan', $juragan);
    //     });

    //     $dana = Order::where('status', 'cek_pembayaran')
    //         ->get()
    //         ->groupBy('order_number');

    //     $pelanggan = Customer::get();
    //     $juragan = Juragan::get();
    //     $allorder = Order::get();

    //     $user = auth()->user();
    //     $role = $user->role;
    //     $view = $this->getViewBasedOnRole($role);
    //     $statistics = $this->orderStatus();

    //     $order = $query->get();
    //     $orderan = $order->groupBy('order_number');

    //     return view($view, [
    //         'status' => $statistics,
    //         'juragan' => $juragan,
    //         'dana' => $dana,
    //         'pelanggan' => $pelanggan,
    //         'orderan' => $orderan,
    //         'allorder' => $allorder,
    //         'title' => 'Semua Orderan'
    //     ]);
    // }
    public function notifCekPembayaran($orderNumber, $employeesName, $isPaymentMade, $paymentCompleteness)
    {
        $paymentStatus = $isPaymentMade ? 'Ada' : 'Tidak Ada';
        $teks = "$employeesName men-set Pembayaran $paymentStatus pada invoice $orderNumber.";

        if ($isPaymentMade && $paymentCompleteness !== null) {
            $teks .= " Kelengkapan Pembayaran: $paymentCompleteness.";
        }

        



        return $teks;
    }

    public function updateCheckPaymentsa(Request $request, $orderId)
    {
        $kelengkapans = $request->adatidak;
        $link = $request->link;
        $InfoPembayaran = InfoPembayaran::where('order_number', $orderId)
            ->whereNull('kelengkapan')
            ->orWhere('kelengkapan', '')
            ->get();

        $InfoPembayaran->each(function ($item, $index) use ($kelengkapans, $link) {
            $kelengkapan = isset($kelengkapans[$index]) ? $kelengkapans[$index] : null;
            $linkValue = isset($link[$index]) ? $link[$index] : null;
            if ($kelengkapan !== null) {
                $kelengkapan = $kelengkapan === 'Ada' ? 'Ada' : 'Tidak Ada';

                $item->update([
                    'kelengkapan' => $kelengkapan,
                    'link' => $linkValue
                ]);
            }
        });

        InfoPembayaran::where('order_number', $orderId)
            ->where('kelengkapan', 'Tidak Ada')
            ->delete();

        $jumlahDana = InfoPembayaran::where('order_number', $orderId)
            ->where('kelengkapan', 'Ada')
            ->sum('jumlah_dana');

        $countInfoPembayaran = DB::table('info_pembayaran')
            ->where('order_number', $orderId)
            ->where(function($query) {
                $query->whereNull('kelengkapan')
                    ->orWhere('kelengkapan', '');
            })
            ->count();

        $order = Order::where('order_number', $orderId)->first();
        $employeesName = auth()->user()->name;

        if ($countInfoPembayaran > 0) {
            Order::where('order_number', $orderId)
                ->update([
                    'paid_amount' => $jumlahDana,
                    'status' => 'cek_pembayaran'
                ]);
            // Panggil fungsi notifCekPembayaran untuk membuat notifikasi
            $notif = $this->notifCekPembayaran($orderId, $employeesName, true, null);
            OrderCreatedNotif::dispatch($notif);
        } else if ($countInfoPembayaran == 0) {
            Order::where('order_number', $orderId)
                ->update([
                    'paid_amount' => $jumlahDana,
                    'status' => DB::raw('CASE WHEN paid_amount < total_amount THEN "dalam_proses" ELSE "dalam_proses" END')
                ]);
            // Panggil fungsi notifCekPembayaran untuk membuat notifikasi
            $notif = $this->notifCekPembayaran($orderId, $employeesName, $jumlahDana > 0, null);
            OrderCreatedNotif::dispatch($notif);

            // dd($countInfoPembayaran);
        }
        return redirect()->back();
    }




    public function updateCheckPayment(Request $request, $orderId)
    {
        try {
            $order = Order::find($orderId);

            $order->status = $request->input('status');
            $order->tujuan_bayar = $request->input('tujuan_bayar');
            $order->tgl_bayar = $request->input('tgl_bayar');
            $order->jumlah_dana = $request->input('jumlah_dana');

            $order->save();

            return redirect()->route('dashboard', ['status' => $order->status])
                ->with('success', 'Order <span class="text-success">Berhasil</span> Diubah');
        } catch (\Exception $e) {
            return redirect()
                ->with('error', 'Order <span class="text-danger">Belum</span> Lengkap!' . $e->getMessage());
        }
    }

    public function updateOnProcess(Request $request, $orderId)
    {
        try {
            $order = Order::find($orderId);

            $order->status = $request->input('status');
            $order->kelengkapan = $request->input('kelengkapan');
            $order->notes = $request->input('notes');

            if ($order->kelengkapan === 'Lengkap') {
                $order->keterangan_status = $request->input('keterangan_status');
                // Perubahan 1: Tambahkan kondisi berikut untuk menyimpan data keteranganStatus
                if ($request->input('keterangan_status')) {
                    $order->keterangan_status = 'Masuk';
                } else {
                    $order->keterangan_status = 'Selesai'; // Atau sesuaikan dengan nilai default jika perlu
                }
            } else {
                $order->keterangan_status = $request->input('keterangan_status');
            }

            $order->save();

            return redirect()->route('dashboard', ['status' => $order->status])
                ->with('success', 'Order <span class="text-success">Berhasil</span> Diubah');
            // ->with('kelengkapan', $order->kelengkapan)
            // ->with('keterangan_status', $order->keterangan_status)
            // ->with('status', $order->status)
            // ->with('disableDataPesanan', $order->kelengkapan === 'Lengkap');
        } catch (\Exception $e) {
            return redirect()->route('dashboard', ['status' => $order->status])
                ->with('success', 'Order <span class="text-success">Berhasil</span> Diubah');
        }
    }

    public function orderStatus()
    {
        $statistics = [
            'jumlah_id' => Order::distinct('order_number')->count('id'),
            'belumProses' => Order::where('status', 'belum_proses')->distinct('order_number')->count(),
            'menungguDicek' => Order::where('status', 'cek_pembayaran')->distinct('order_number')->count(),
            'dalamProses' => Order::where('status', 'dalam_proses')->distinct('order_number')->count(),
            'orderanSelesai' => Order::where('status', 'orderan_selesai')->distinct('order_number')->count(),
        ];

        return $statistics;
    }


    public function tambahPembayaran(Request $request, $orderNumber)
    {
        $tujuan = $request->tujuan_bayar;
        $dana = $request->jumlah_dana;
        $updated = $request->tanggal_bayar;

        $order = Order::where('order_number', $orderNumber);

        if ($dana > 0) {
            $order->increment('paid_amount', $dana);
        }

        $order->update([
            'tujuan_bayar' => $tujuan,
            'jumlah_dana' => $dana,
            'updated_at' => $updated,
            'payment_method' => $tujuan,
        ]);

        return redirect()->back();
    }


    protected function getViewBasedOnRole($role)
    {
        switch ($role) {
            case 'superAdmin':
                return 'super-admin.dashboard-invoice.semua-orderan';
            case 'admin':
                return 'admin.dashboard.semua-orderan';
            case 'cs':
                return 'customer-service.dashboard-invoice.semua-orderan';
            default:
                return 'errors.unknown-role';
        }
    }

    public function search(Request $request)
    {
        $query = DB::table('orders')
            ->join('customers', 'orders.id_customer', '=', 'customers.id')
            ->join('barangs', 'orders.id_produk', '=', 'barangs.id')
            ->join('employees', 'orders.served_by', '=', 'employees.id')
            ->join('juragans', 'orders.juragan', '=', 'juragans.id')
            ->select('orders.*', 'customers.name as customer_name', 'customers.phone as customer_phone', 'barangs.kd_produk as kd_produk', 'juragans.name_juragan as juraganname', 'employees.name as served_byname');

        $statistics = $this->orderStatus();
        $notifications = Notiforder::all();

        $dana = Order::where('status', 'cek_pembayaran')
            ->get()
            ->groupBy('order_number');

        //meminta inputan
        $opsi1 = $request->input('payment_method');
        $opsi2 = $request->input('status');
        $opsi3 = $request->input('opsi_pengiriman');
        $opsi4 = $request->input('customer_name');
        $opsi5 = $request->input('order_date');


        //Melakukan pengecekan inputan
        $query->when($opsi1, function ($query) use ($opsi1) {
            $query->where('payment_method', 'like', "%" . $opsi1 . "%");
        })->when($opsi2, function ($query) use ($opsi2) {
            $query->where('status', 'like', "%" . $opsi2 . "%");
        })->when($opsi3, function ($query) use ($opsi3) {
            $query->where('status', 'like', "%" . $opsi3 . "%");
        })->when($opsi4, function ($query) use ($opsi4) {
            $query->where('customers.name', 'like', "%" . $opsi4 . "%");
        })->when($opsi5, function ($query) use ($opsi5) {
            $query->whereDate('order_date', '=', $opsi5);
        });

        $pelanggan = Customer::get();
        $juragan = Juragan::get();
        $allorder = Order::get();

        $user = auth()->user();
        $role = $user->role; // Assuming a 'role' attribute exists

        // Determine which view to use based on the role
        $view = $this->getViewBasedOnRole($role);

        $order = $query->get();
        $orderan = $order->groupBy('order_number');

        return view($view, [
            'status' => $statistics,
            'dana' => $dana,
            'allorder' => $allorder,
            'notifications' => $notifications,
            'pelanggan' => $pelanggan,
            'juragan' => $juragan,
            'orderan' => $orderan,
            'addorder' => $allorder,
            'title' => 'Semua Orderan'
        ]);
    }


    public function selectJuragan(Request $request)
    {
        // Jika juragan ditemukan, lanjutkan dengan proses berikutnya
        $title = 'Pilih Juragan';
        $query = Order::query()
            ->join('customers', 'orders.id_customer', '=', 'customers.id')
            ->join('barangs', 'orders.id_produk', '=', 'barangs.id')
            ->join('employees', 'orders.served_by', '=', 'employees.id')
            ->join('juragans', 'orders.juragan', '=', 'juragans.id')
            ->select('orders.*', 'customers.name as customer_name', 'customers.phone as customer_phone', 'barangs.kd_produk as kd_produk', 'juragans.name_juragan as juragan', 'employees.name as served_by');

        $countStatus = $this->orderStatus();

        // Mendapatkan input juragan dari permintaan
        $selectedJuragan = $request->input('juragan');

        // Filter query berdasarkan juragan yang dipilih
        if ($selectedJuragan) {
            $query->where('juragans.name_juragan', $selectedJuragan);
        }

        // Ambil data juragan untuk dropdown
        $dataJuragan = Juragan::all();

        $orders = $query->get();

        $ordersGrouped = $query->get()->groupBy('order_number');
        $orders = $ordersGrouped->map(function ($items, $orderNumber) {
            $itemsArray = $items->toArray();
            $firstItem = (array) array_shift($itemsArray); // Mengonversi item pertama menjadi array
            $barangs = $items->map(function ($item) {
                return ['kd_produk' => $item->kd_produk, 'quantity' => $item->quantity, 'size' => $item->size];
            })->toArray(); // Pastikan ini adalah array
            return array_merge($firstItem, ['barangs' => $barangs]);
        });

        // Kembalikan view dengan data juragan yang dipilih
        return view('admin.dashboard.dashboard', compact('title', 'dataJuragan', 'orders', 'countStatus'));
    }
}
