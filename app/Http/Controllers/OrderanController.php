<?php

namespace App\Http\Controllers;

use App\Models\Cs;
use App\Models\Notif;
use App\Models\Order;
use App\Models\Barang;
use App\Events\MyEvent;
use App\Models\Juragan;
use App\Models\Orderan;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\ViewTulisOrder;
use App\Models\Pelanggan;
use App\Models\Notiforder;
use App\Models\BarangOrder;
use App\Models\EditRequest;
use Illuminate\Http\Request;
use App\Models\InfoPembayaran;
use App\Events\OrderCreatedNotif;
use App\Events\NotifAddPembayaran;
use App\Models\UpdateProses;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreorderanRequest;
use App\Http\Requests\UpdateorderanRequest;
use App\Http\Controllers\BEController\OrderanProcess;

class OrderanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */

     public function utamaadmin()
     {
         $title = "halaman utama admin";
         return view('super-admin.dashboard-invoice.utamaadmin', compact('title'));
     }

    public function index()
    {
        $orderan = Order::join('customers', 'orders.id_customer', '=', 'customers.id')
            ->join('employees', 'orders.served_by', '=', 'employees.id')
            ->join('juragans', 'orders.juragan', '=', 'juragans.id')
            ->select(
                'orders.*',
                'customers.name as customer_name',
                'customers.phone as customer_phone',
                'juragans.name_juragan as juraganname',
                'employees.name as served_byname',
            )
            ->distinct()
            ->get();




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

        // Ambil semua notifikasi, atau Anda bisa menyesuaikan query sesuai kebutuhan


        return view($view, [
            'status' => $statistics,
            'dana' => $dana,
            'allorder' => $allorder,
            'orderan' => $orderan,
            // 'update' => $updates,
            'pelanggan' => $pelanggan,
            'juragan' => $juragan,
            'title' => 'Semua Orderan',
            // 'statusa' => $status
        ]);
    }

    public function indexa()
    {
        $gambar = Auth::guard('employee')->user()->profile_image;
        $orderan = Order::join('customers', 'orders.id_customer', '=', 'customers.id')
            ->join('employees', 'orders.served_by', '=', 'employees.id')
            ->join('juragans', 'orders.juragan', '=', 'juragans.id')
            ->select(
                'orders.*',
                'customers.name as customer_name',
                'customers.phone as customer_phone',
                'juragans.name_juragan as juraganname',
                'employees.name as served_byname',
            )
            ->distinct()
            ->get();



        $dana = Order::where('status', 'cek_pembayaran')
            ->get()
            ->groupBy('order_number');


        $user = auth()->user();

        $pelanggan = Customer::get();
        $juragan = Juragan::get();
        $statistics = $this->orderStatus();
        $allorder = Order::join('update_proses', 'orders.order_number', '=', 'update_proses.order_number')
            ->select('update_proses.order_number')
            ->get();


        $dataJuragan = DB::table('juragans')->get();
        return view('admin.dashboard.semua-orderan', [
            'status' => $statistics,
            'dana' => $dana,
            'allorder' => $allorder,
            'orderan' => $orderan,
            'gambar'=>$gambar,
            'pelanggan' => $pelanggan,
            'juragan' => $juragan,
            'title' => 'Semua Orderan',
            'dataJuragan' => $dataJuragan

        ]);
    }

    public function indexSA()
    {
        $orderanRaw = DB::table('orders')
            ->join('customers', 'orders.id_customer', '=', 'customers.id')
            ->join('barangs', 'orders.id_produk', '=', 'barangs.id')
            ->join('employees', 'orders.served_by', '=', 'employees.id')
            ->join('juragans', 'orders.juragan', '=', 'juragans.id')
            ->select('orders.*', 'customers.name as customer_name', 'customers.phone as customer_phone', 'barangs.kd_produk as kd_produk', 'juragans.name_juragan as juraganname', 'employees.name as served_byname')
            ->get();

        $orderan = $orderanRaw->groupBy('order_number');

        $dana = Order::where('status', 'cek_pembayaran')
            ->get()
            ->groupBy('order_number');

        $user = auth()->user();
        $role = $user->role;
        $view = $this->getViewBasedOnRole($role);
        $pelanggan = Customer::get();
        $juragan = Juragan::get();
        $statistics = $this->orderStatus();
        $allorder = Order::get();
        return view($view, [
            'status' => $statistics,
            'allorder' => $allorder,
            'dana' => $dana,
            'orderan' => $orderan,
            'pelanggan' => $pelanggan,
            'juragan' => $juragan,
            'title' => 'Semua Orderan'
        ]);
    }

    public function store(Request $request)
    {
        $addOrderan = new OrderanProcess;
        $addOrderan->addOrderan($request);

        return redirect()->route('')->with('success', 'Berhasil menambahkan data orderan');
    }

    public function update(Request $request, $id)
    {
        $updateOrderan = new OrderanProcess;
        $updateOrderan->updateOrderan($request, $id);

        return redirect()->route('')->with('success', 'Berhasil udpate data orderan');
    }

    public function filterByJuragan(Request $request)
    {
        $query = DB::table('orders')
            ->join('customers', 'orders.id_customer', '=', 'customers.id')
            ->join('barangs', 'orders.id_produk', '=', 'barangs.id')
            ->join('employees', 'orders.served_by', '=', 'employees.id')
            ->join('juragans', 'orders.juragan', '=', 'juragans.id')
            ->select('orders.*', 'customers.name as customer_name', 'customers.phone as customer_phone', 'barangs.kd_produk as kd_produk', 'juragans.name_juragan as juraganname', 'employees.name as served_byname');

        $juragan = $request->input('juragan');

        $query->when($juragan, function ($q) use ($juragan) {
            $q->where('name_juragan', $juragan);
        });

        $dana = Order::where('status', 'cek_pembayaran')
            ->get()
            ->groupBy('order_number');

        $pelanggan = Customer::get();
        $juragan = Juragan::get();
        $allorder = Order::get();

        $user = auth()->user();
        $role = $user->role;
        $view = $this->getViewBasedOnRole($role);
        $statistics = $this->orderStatus();

        $order = $query->get();
        $orderan = $order->groupBy('order_number');

        return view($view, [
            'status' => $statistics,
            'juragan' => $juragan,
            'dana' => $dana,
            'pelanggan' => $pelanggan,
            'orderan' => $orderan,
            'allorder' => $allorder,
            'title' => 'Semua Orderan'
        ]);
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

            'pelanggan' => $pelanggan,
            'juragan' => $juragan,
            'orderan' => $orderan,
            'addorder' => $allorder,
            'title' => 'Semua Orderan'
        ]);
    }

    protected function getViewBasedOnRole($role)
    {
        switch ($role) {
            case 'admin':
                return 'super-admin.dashboard-invoice.utamaadmin';
            case 'cs':
                return 'admin.dashboard.semua-orderan';
            case 'ceo':
                return 'customer-service.dashboard-invoice.semua-orderan';
            default:
                return 'errors.unknown-role';
        }
    }


    // Menggunakan data array sebagai data alert sementara
    public function dataalert(Request $request)
    {
        $segment = $request->segment(1);
        $alert = [
            [
                "kode" => "001",
                "hari" => "Kamis",
                "tanggal" => "18-01-2024",
                "jam" => "15.30",
                "info" => "Admin Mengedit 'Data Pesanan' pada invoice AH1693918567",
                "status" => "diedit"
            ]

        ];

        Session::put('alert', $alert);

        //menghitung jumlah code
        $jumlah_kode = count(array_unique(array_column($alert, 'kode')));


        return view('layouts.mainSA', compact('alert', 'jumlah_kode'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function cetakInvoiceAdmin($orderNumber)
    {
        $gambar = Auth::guard('employee')->user()->profile_image;
        // Mendapatkan data order dari database berdasarkan nomor pesanan
        $order = Order::where('order_number', $orderNumber)->first();

        if ($order) {
            // Informasi invoice
            $invoiceNumber = $order->order_number;
            $invoiceDate = date('Y-m-d'); // Tanggal cetak invoice, Anda bisa mengganti dengan tanggal lain sesuai kebutuhan
            $servedBy = $order->served_by; // Menggunakan data served_by dari order

            // Menyiapkan data produk pada order
            $items = $order->items;

            // Menghitung subtotal
            $subtotal = 0;

            // Memeriksa apakah $items tidak null sebelum melakukan perulangan
            if ($items) {
                foreach ($items as $item) {
                    // Mengakses data barang dari relasi barang pada setiap item pesanan
                    $barang = $item->barang;

                    // Jika barang ditemukan, tambahkan informasi barang ke dalam item
                    if ($barang) {
                        $item->kd_produk = $barang->kd_produk;
                        $item->quantity = $order->quantity; // Menggunakan quantity dari item pesanan, bukan dari pesanan itu sendiri
                        $item->harga_satuan = $barang->harga_satuan ?? 0; // Gunakan harga satuan dari barang dan handel jika tidak ada harga satuan
                        $item->subtotal = $item->quantity * $item->harga_satuan; // Menghitung subtotal per item
                        $subtotal += $item->subtotal; // Menambahkan subtotal item ke subtotal total
                    }
                }
            } else {
                $items = []; // Inisialisasi $items sebagai array kosong jika null
            }

            // Set judul halaman
            $title = "Invoice #" . $invoiceNumber;

            // Mengirim data ke tampilan invoice.blade.php
            return view('admin.data-pelanggan.invoice', [
                'title' => $title,
                'invoiceNumber' => $invoiceNumber,
                'invoiceDate' => $invoiceDate,
                'servedBy' => $servedBy,
                'items' => $items,
                'subtotal' => $subtotal,
                'gambar'=>$gambar,
            ]);
        } else {
            return "Order dengan nomor $orderNumber tidak ditemukan.";
            // Atau lakukan penanganan kesalahan lainnya sesuai kebutuhan
        }
    }

    // Di dalam controller Anda
    public function cetakInvoiceCs($orderNumber)
    {
        // Mendapatkan data order dari database berdasarkan nomor pesanan
        $order = Order::where('order_number', $orderNumber)->first();

        if ($order && $order->status == 'orderan_selesai' && $order->total_amount == $order->paid_amount) {
            // Informasi invoice
            $invoiceNumber = $order->order_number;
            $invoiceDate = date('Y-m-d'); // Tanggal cetak invoice, Anda bisa mengganti dengan tanggal lain sesuai kebutuhan
            $servedBy = $order->served_by; // Menggunakan data served_by dari order

            // Menyiapkan data produk pada order
            $items = $order->items;

            // Menghitung subtotal
            $subtotal = 0;

            // Memeriksa apakah $items tidak null sebelum melakukan perulangan
            if ($items) {
                foreach ($items as $item) {
                    // Mengakses data barang dari relasi barang pada setiap item pesanan
                    $barang = $item->barang;

                    // Jika barang ditemukan, tambahkan informasi barang ke dalam item
                    if ($barang) {
                        $item->kd_produk = $barang->kd_produk;
                        $item->quantity = $order->quantity; // Menggunakan quantity dari item pesanan, bukan dari pesanan itu sendiri
                        $item->harga_satuan = $barang->harga_satuan ?? 0; // Gunakan harga satuan dari barang dan handel jika tidak ada harga satuan
                        $item->subtotal = $item->quantity * $item->harga_satuan; // Menghitung subtotal per item
                        $subtotal += $item->subtotal; // Menambahkan subtotal item ke subtotal total
                    }
                }
            } else {
                $items = []; // Inisialisasi $items sebagai array kosong jika null
            }

            // Set judul halaman
            $title = "Invoice #" . $invoiceNumber;

            // Mengirim data ke tampilan invoice.blade.php
            return view('customer-service.dashboard-invoice.invoice', [
                'title' => $title,
                'invoiceNumber' => $invoiceNumber,
                'invoiceDate' => $invoiceDate,
                'servedBy' => $servedBy,
                'items' => $items,
                'subtotal' => $subtotal,
                'order' => $order, // Mengirimkan data order ke tampilan
            ]);
        } else {
            return "Order dengan nomor $orderNumber tidak ditemukan atau belum selesai terbayar.";
            // Atau lakukan penanganan kesalahan lainnya sesuai kebutuhan
        }
    }


    public function cetakinvoiceSa($orderNumber)
    {
        // Mendapatkan data order dari database berdasarkan nomor pesanan
        $order = Order::where('order_number', $orderNumber)->first();

        if ($order) {
            // Informasi invoice
            $invoiceNumber = $order->order_number;
            $invoiceDate = date('Y-m-d'); // Tanggal cetak invoice, Anda bisa mengganti dengan tanggal lain sesuai kebutuhan
            $servedBy = $order->served_by; // Menggunakan data served_by dari order

            // Menyiapkan data produk pada order
            $items = $order->items;

            // Menghitung subtotal
            $subtotal = 0;

            // Memeriksa apakah $items tidak null sebelum melakukan perulangan
            if ($items) {
                foreach ($items as $item) {
                    // Mengakses data barang dari relasi barang pada setiap item pesanan
                    $barang = $item->barang;

                    // Jika barang ditemukan, tambahkan informasi barang ke dalam item
                    if ($barang) {
                        $item->kd_produk = $barang->kd_produk;
                        $item->quantity = $order->quantity; // Menggunakan quantity dari item pesanan, bukan dari pesanan itu sendiri
                        $item->harga_satuan = $barang->harga_satuan ?? 0; // Gunakan harga satuan dari barang dan handel jika tidak ada harga satuan
                        $item->subtotal = $item->quantity * $item->harga_satuan; // Menghitung subtotal per item
                        $subtotal += $item->subtotal; // Menambahkan subtotal item ke subtotal total
                    }
                }
            } else {
                $items = []; // Inisialisasi $items sebagai array kosong jika null
            }
            $juragan = Order::join('juragans', 'orders.juragan', '=', 'juragans.id')
                ->select('juragans.name_juragan')
                ->first();
            $cs = Order::join('customers', 'orders.id_customer', '=', 'customers.id')
                ->first();

            // Set judul halaman
            $title = "Invoice #" . $invoiceNumber;

            // Mengirim data ke tampilan invoice.blade.php
            return view('customer-service.dashboard-invoice.invoice', [
                'title' => $title,
                'invoiceNumber' => $invoiceNumber,
                'invoiceDate' => $invoiceDate,
                'servedBy' => $servedBy,
                'items' => $items,
                'subtotal' => $subtotal,
                'order' => $order,
                'juragan' => $juragan,
                'cs' => $cs
            ]);
        } else {
            return "Order dengan nomor $orderNumber tidak ditemukan.";
            // Atau lakukan penanganan kesalahan lainnya sesuai kebutuhan
        }
    }



    public function belumproses(Request $request)
    {

        $orderan = Order::join('customers', 'orders.id_customer', '=', 'customers.id')
        ->join('employees', 'orders.served_by', '=', 'employees.id')
        ->join('juragans', 'orders.juragan', '=', 'juragans.id')
        ->select(
            'orders.*',
            'customers.name as customer_name',
            'customers.phone as customer_phone',
            'juragans.name_juragan as juraganname',
            'employees.name as served_byname',
        )
        ->where('orders.status', 'belum_proses')
        ->distinct()
        ->get();
        $dana = Order::where('status', 'cek_pembayaran')
            ->get()
            ->groupBy('order_number');


        $statistics = $this->orderStatus();

        $pelanggan = Customer::get();
        $juragan = Juragan::get();


        $allorder = Order::get();
        // Mengirim data ke view
        return view('customer-service.dashboard-invoice.belum-proses-orderan', [
            'orderan' => $orderan,
            'allorder' => $allorder,
            'status' => $statistics,
            'juragan' => $juragan,
            'pelanggan' => $pelanggan,
            'dana' => $dana,
            'title' => 'Belum Proses Orderan',

        ]);
    }

    // admin
    public function belumprosesA(Request $request)
    {
        $gambar = Auth::guard('employee')->user()->profile_image;

        $orderan = Order::join('customers', 'orders.id_customer', '=', 'customers.id')
        ->join('employees', 'orders.served_by', '=', 'employees.id')
        ->join('juragans', 'orders.juragan', '=', 'juragans.id')
        ->select(
            'orders.*',
            'customers.name as customer_name',
            'customers.phone as customer_phone',
            'juragans.name_juragan as juraganname',
            'employees.name as served_byname',
        )
        ->where('orders.status', 'belum_proses')
        ->distinct()
        ->get();
        $dana = Order::where('status', 'cek_pembayaran')
            ->get()
            ->groupBy('order_number');


        $statistics = $this->orderStatus();

        $pelanggan = Customer::get();
        $juragan = Juragan::get();

        $allorder = Order::get();

        $dataJuragan = DB::table('juragans')->get();
        return view('admin.dashboard.belum-proses-orderan', [
            'orderan' => $orderan,
            'allorder' => $allorder,
            'status' => $statistics,
            'juragan' => $juragan,
            'pelanggan' => $pelanggan,
            'dana' => $dana,
            'title' => 'Belum Proses Orderan',
            'gambar'=>$gambar,
            'dataJuragan' => $dataJuragan
        ]);
    }

    //sa
    public function belumprosesSA(Request $request)
    {
        $segment = $request->segment(1);

        $orderan = Order::join('customers', 'orders.id_customer', '=', 'customers.id')
            ->join('employees', 'orders.served_by', '=', 'employees.id')
            ->join('juragans', 'orders.juragan', '=', 'juragans.id')
            ->select(
                'orders.*',
                'customers.name as customer_name',
                'customers.phone as customer_phone',
                'juragans.name_juragan as juraganname',
                'employees.name as served_byname',
            )
            ->where('orders.status', 'belum_proses')
            ->distinct()
            ->get();
        $dana = Order::where('status', 'cek_pembayaran')
            ->get()
            ->groupBy('order_number');


        $statistics = $this->orderStatus();

        $pelanggan = Customer::get();
        $juragan = Juragan::get();

        $allorder = Order::get();
        // Mengirim data ke view

        return view('super-admin.dashboard-invoice.belum-proses-orderan', [
            'orderan' => $orderan,
            'allorder' => $allorder,
            'status' => $statistics,
            'juragan' => $juragan,
            'pelanggan' => $pelanggan,
            'dana' => $dana,
            'title' => 'Belum Proses Orderan'
        ]);
    }

    public function menunggudicek(Request $request)
    {
        $segment = $request->segment(1);
        $orderan = Order::join('customers', 'orders.id_customer', '=', 'customers.id')
        ->join('employees', 'orders.served_by', '=', 'employees.id')
        ->join('juragans', 'orders.juragan', '=', 'juragans.id')
        ->select(
            'orders.*',
            'customers.name as customer_name',
            'customers.phone as customer_phone',
            'juragans.name_juragan as juraganname',
            'employees.name as served_byname',
        )
        ->where('orders.status', 'cek_pembayaran')
        ->distinct()
        ->get();
        $statistics = $this->orderStatus();
        $pelanggan = Customer::get();
        $juragan = Juragan::get();
        $allorder = Order::get();

        return view('customer-service.dashboard-invoice.menunggu-dicek-orderan', [
            'orderan' => $orderan,
            'allorder' => $allorder,
            'juragan' => $juragan,
            'status' => $statistics,
            'pelanggan' => $pelanggan,
            'title' => 'Menunggu Dicek',

        ]);
    }
    // admin
    public function menunggudicekA(Request $request)
    {
        $gambar = Auth::guard('employee')->user()->profile_image;
        $orderan = Order::join('customers', 'orders.id_customer', '=', 'customers.id')
            ->join('employees', 'orders.served_by', '=', 'employees.id')
            ->join('juragans', 'orders.juragan', '=', 'juragans.id')
            ->select(
                'orders.*',
                'customers.name as customer_name',
                'customers.phone as customer_phone',
                'juragans.name_juragan as juraganname',
                'employees.name as served_byname',
            )
            ->where('orders.status', 'cek_pembayaran')
            ->distinct()
            ->get();
        $dana = Order::where('status', 'cek_pembayaran')
            ->get()
            ->groupBy('order_number');




        $statistics = $this->orderStatus();
        $pelanggan = Customer::get();
        $juragan = Juragan::get();
        $allorder = Order::get();

        $dataJuragan = DB::table('juragans')->get();
        return view('admin.dashboard.menunggu-dicek-orderan', [
            'dana' => $dana,
            'orderan' => $orderan,
            'allorder' => $allorder,
            'status' => $statistics,
            'juragan' => $juragan,
            'pelanggan' => $pelanggan,
            'title' => 'Menunggu Dicek Orderan',
            'gambar'=>$gambar,
            'dataJuragan' => $dataJuragan
        ]);
    }
    // superadmin
    public function menunggudicekSA(Request $request)
    {
        $orderan = Order::join('customers', 'orders.id_customer', '=', 'customers.id')
            ->join('employees', 'orders.served_by', '=', 'employees.id')
            ->join('juragans', 'orders.juragan', '=', 'juragans.id')
            ->select(
                'orders.*',
                'customers.name as customer_name',
                'customers.phone as customer_phone',
                'juragans.name_juragan as juraganname',
                'employees.name as served_byname',
            )
            ->where('orders.status', 'cek_pembayaran')
            ->distinct()
            ->get();
        $dana = Order::where('status', 'cek_pembayaran')
            ->get()
            ->groupBy('order_number');




        // $orderan = $orderanRaw->groupBy('order_number');
        $statistics = $this->orderStatus();
        $pelanggan = Customer::get();
        $juragan = Juragan::get();
        $allorder = Order::get();

        return view('super-admin.dashboard-invoice.menunggu-dicek-orderan', [
            'dana' => $dana,
            'orderan' => $orderan,
            'allorder' => $allorder,
            'status' => $statistics,
            'juragan' => $juragan,
            'pelanggan' => $pelanggan,
            'title' => 'Menunggu Dicek Orderan'
        ]);
    }

    public function dalamproses(Request $request)
    {
        $orderan = Order::join('customers', 'orders.id_customer', '=', 'customers.id')
            ->join('employees', 'orders.served_by', '=', 'employees.id')
            ->join('juragans', 'orders.juragan', '=', 'juragans.id')
            ->select(
                'orders.*',
                'customers.name as customer_name',
                'customers.phone as customer_phone',
                'juragans.name_juragan as juraganname',
                'employees.name as served_byname',
            )
            ->where('orders.status', 'dalam_proses')
            ->distinct()
            ->get();
        // $updates = Order::join('update_status_proses', 'orders.keterangan_status_id', '=', 'update_status_proses.id')
        //     ->select('update_status_proses.id_status', 'update_status_proses.kelengkapan')
        //     ->distinct()
        //     ->get()
        //     ->groupBy('order_number');
        $dana = Order::where('status', 'cek_pembayaran')
            ->get()
            ->groupBy('order_number');

        $statistics = $this->orderStatus();
        $pelanggan = Customer::get();
        $juragan = Juragan::get();
        $allorder = Order::get();

        return view('customer-service.dashboard-invoice.dalam-proses-orderan', [
            'orderan' => $orderan,
            'allorder' => $allorder,
            'status' => $statistics,
            'juragan' => $juragan,
            'pelanggan' => $pelanggan,
            // 'update' => $updates,
            'dana' => $dana,
            'title' => 'Dalam Proses Orderan',

        ]);
    }
    // admin

    public function dalamprosesA(Request $request)
    {
        $gambar = Auth::guard('employee')->user()->profile_image;
        $orderan = Order::join('customers', 'orders.id_customer', '=', 'customers.id')
            ->join('employees', 'orders.served_by', '=', 'employees.id')
            ->join('juragans', 'orders.juragan', '=', 'juragans.id')
            ->select(
                'orders.*',
                'customers.name as customer_name',
                'customers.phone as customer_phone',
                'juragans.name_juragan as juraganname',
                'employees.name as served_byname',
            )
            ->where('orders.status', 'dalam_proses')
            ->distinct()
            ->get();

        $dana = Order::where('status', 'cek_pembayaran')
            ->get()
            ->groupBy('order_number');

        $statistics = $this->orderStatus();
        $pelanggan = Customer::get();
        $juragan = Juragan::get();
        $allorder = Order::get();

        $dataJuragan = DB::table('juragans')->get();
        return view('admin.dashboard.dalam-proses-orderan', [
            'orderan' => $orderan,
            'allorder' => $allorder,
            'status' => $statistics,
            'juragan' => $juragan,
            'pelanggan' => $pelanggan,
            'dana' => $dana,
            'title' => 'Dalam Proses Orderan',
            'gambar'=>$gambar,
            'dataJuragan' => $dataJuragan
        ]);
    }
    // sa
    public function dalamprosesSA(Request $request)
    {
        $segment = $request->segment(1);
        $orderan = Order::join('customers', 'orders.id_customer', '=', 'customers.id')
            ->join('employees', 'orders.served_by', '=', 'employees.id')
            ->join('juragans', 'orders.juragan', '=', 'juragans.id')
            ->select(
                'orders.*',
                'customers.name as customer_name',
                'customers.phone as customer_phone',
                'juragans.name_juragan as juraganname',
                'employees.name as served_byname',
            )
            ->where('orders.status', 'dalam_proses')
            ->distinct()
            ->get();

        $dana = Order::where('status', 'cek_pembayaran')
            ->get()
            ->groupBy('order_number');

        $statistics = $this->orderStatus();
        $pelanggan = Customer::get();
        $juragan = Juragan::get();
        $allorder = Order::get();

        return view('super-admin.dashboard-invoice.dalam-proses-orderan', [
            'orderan' => $orderan,
            'allorder' => $allorder,
            'status' => $statistics,
            'juragan' => $juragan,
            'pelanggan' => $pelanggan,
            // 'update' => $updates,
            'dana' => $dana,
            'title' => 'Dalam Proses Orderan'
        ]);
    }

    public function orderanselesai(Request $request)
    {

        $orderan = Order::join('customers', 'orders.id_customer', '=', 'customers.id')
        ->join('employees', 'orders.served_by', '=', 'employees.id')
        ->join('juragans', 'orders.juragan', '=', 'juragans.id')
        ->select(
            'orders.*',
            'customers.name as customer_name',
            'customers.phone as customer_phone',
            'juragans.name_juragan as juraganname',
            'employees.name as served_byname',
        )
        ->where('orders.status', 'orderan_selesai')
        ->distinct()
        ->get();

        $statistics = $this->orderStatus();
        $pelanggan = Customer::get();
        $juragan = Juragan::get();

        return view('customer-service.dashboard-invoice.orderan-selesai', [
            'orderan' => $orderan,
            'status' => $statistics,
            'juragan' => $juragan,
            'pelanggan' => $pelanggan,
            'title' => 'Orderan Selesai',

        ]);
    }
    // admin
    public function orderanselesaiA(Request $request)
    {
        $gambar = Auth::guard('employee')->user()->profile_image;
        // $orderan = Order::where('status', 'orderan_selesai')->get();
        $orderan = Order::join('customers', 'orders.id_customer', '=', 'customers.id')
        ->join('employees', 'orders.served_by', '=', 'employees.id')
        ->join('juragans', 'orders.juragan', '=', 'juragans.id')
        ->select(
            'orders.*',
            'customers.name as customer_name',
            'customers.phone as customer_phone',
            'juragans.name_juragan as juraganname',
            'employees.name as served_byname',
        )
        ->where('orders.status', 'orderan_selesai')
        ->distinct()
        ->get();
        $statistics = $this->orderStatus();
        $pelanggan = Customer::get();
        $juragan = Juragan::get();

        $dataJuragan = DB::table('juragans')->get();
        return view('admin.dashboard.orderan-selesai', [
            'orderan' => $orderan,
            'status' => $statistics,
            'juragan' => $juragan,
            'pelanggan' => $pelanggan,
            'title' => 'Orderan Selesai',
            'gambar'=>$gambar,
            'dataJuragan' => $dataJuragan
        ]);
    }
    // sa
    public function orderanselesaiSA(Request $request)
    {
        $segment = $request->segment(1);
        // $orderan = Order::where('status', 'orderan_selesai')->get();
        $orderan = Order::join('customers', 'orders.id_customer', '=', 'customers.id')
            ->join('employees', 'orders.served_by', '=', 'employees.id')
            ->join('juragans', 'orders.juragan', '=', 'juragans.id')
            ->select(
                'orders.*',
                'customers.name as customer_name',
                'customers.phone as customer_phone',
                'juragans.name_juragan as juraganname',
                'employees.name as served_byname',
            )
            ->where('orders.status', 'orderan_selesai')
            ->distinct()
            ->get();

        // $orderan = $orderanRaw->groupBy('order_number');
        $statistics = $this->orderStatus();
        $pelanggan = Customer::get();
        $juragan = Juragan::get();

        return view('super-admin.dashboard-invoice.orderan-selesai', [
            'orderan' => $orderan,
            'status' => $statistics,
            'juragan' => $juragan,
            'pelanggan' => $pelanggan,
            'title' => 'Orderan Selesai'
        ]);
    }

    public function show($id)
    {
        $data = Order::find($id); // Ganti 'Model' dengan nama model yang sesuai
        return view('customer-service.dashboard-invoice.semua-orderan', compact('data'));
    }

    public function edit(orderan $orderan)
    {
        //
    }

    public function notifPembayaran($orderNumber, $dana)
    {
        $teks = "Orderan pada invoice $orderNumber menambahkan pembayaran sebesar Rp.$dana";





        return $teks;
    }

    public function tambahPembayaran(Request $request, $orderNumber)
    {

        $tujuan = $request->input('tujuan_bayar');
        $updated = $request->input('tanggal_bayar');
        $dana = $request->input('jumlah_dana');
        $order = Order::where('order_number', $orderNumber)->firstOrFail();
        // dd($request->all());

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');

            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('bukti_pembayaran'), $fileName);
        } else {
            $fileName = null;
        }

        InfoPembayaran::create([
            'order_id' => $order->id,
            'order_number' => $orderNumber,
            'jumlah_dana' => $request->input('jumlah_dana'),
            'gambar' => $fileName,
            'payment_method'=>$tujuan,
        ]);

        UpdateProses::create([
            'id_order' => $order->id,
            'nama_proses' => 'pembayaran',
            'order_number' => $orderNumber,
            'kelengkapan'=>'lengkap'

        ]);

        // Update semua baris dengan order_number yang sesuai
        Order::where('order_number', $orderNumber)->update([
            'updated_at' => $updated,
            'payment_method' => $tujuan,
            'status' => 'cek_pembayaran',
        ]);


        $notif = $this->notifPembayaran($orderNumber, $dana);
        NotifAddPembayaran::dispatch($notif);

        return redirect()->back()->with('success-pembayaran', $notif);
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

    public function uniqueFilter()
    {
        $orderan = Order::all();

        $uniquePaymentMethods = $orderan->pluck('payment_method')->unique();
        $uniqueStatus = $orderan->pluck('status')->unique();
        $uniqueCustomerName = $orderan->pluck('status')->unique();

        return [
            'uniquePaymentMethods' => $uniquePaymentMethods,
            'uniqueStatus' => $uniqueStatus,
            'uniqueCustomerName' => $uniqueCustomerName
        ];
    }

    public function destroy($id)
    {
        $deleteOrderan = new OrderanProcess;
        $deleteOrderan->deleteOrderan($id);

        return back()->with('success', 'Berhasil menghapus orderan');
    }

    public function tulisOrder()
    {
        $gambar = Auth::guard('employee')->user()->profile_image;
        $user = Auth::guard('employee')->user();
        $data = Order::all();

        $cs = Customer::all();
        $juragan = Juragan::get();
        $employees = Employee::where('role', 'cs')->get();
        $kda = Barang::all();
        $ongkir = ViewTulisOrder::whereNotNull('ongkir')
            ->whereNotNull('jasa_ongkir')
            ->where('employee_id', $user->id)
            ->get();



        $viewtulisorder = ViewTulisOrder::whereNotNull('kd')
            ->whereNotNull('harga')
            ->whereNotNull('qty')
            ->whereNotNull('ukuran')
            ->where('employee_id', $user->id)
            ->whereNull('order_number')
            ->get();

        $title = "Tulis Orderan";
        $total_semua = ViewTulisOrder::where('employee_id', $user->id)
            ->selectRaw('SUM(qty * harga) as total')
            ->value('total') + ViewTulisOrder::sum('ongkir');

        return view(
            'admin.tulis-orderan.main',
            [
                'title' => $title,
                'datas' => $data,
                'kda' => $kda,
                'viewtulisorder' => $viewtulisorder,
                'ongkir' => $ongkir,
                'total_semua' => $total_semua,
                'cs' => $cs,
                "employees" => $employees,
                'juragan' => $juragan,
                'id_lokal' => $user->id,
                'name' => $user->name,
                'gambar'=>$gambar,
            ]
        );
    }

    public function option(Request  $request)
    {
        $customerId = $request->input('customer_id');
        $selectedCustomer = Customer::find($customerId);
        $cs = Customer::all();
        return response()->json($selectedCustomer);
    }


    public function suntinga($orderNumber)
    {
        $gambar = Auth::guard('employee')->user()->profile_image;
        $title = "Sunting Edit";
        $user = Auth::guard('employee')->user();

        // $requests = EditRequest::where('order_number', $orderNumber)->get();
        $juragans = Juragan::get();
        $employees = Employee::get();
        $viewtulisorder = ViewTulisOrder::where('order_number', $orderNumber)->get();


        $ongkir = ViewTulisOrder::whereNotNull('ongkir')
            ->whereNotNull('jasa_ongkir')
            ->where('order_number', $orderNumber)
            ->get();
        $kda = Barang::all();
        $nomer_order = $orderNumber;


        return view(
            'admin.sunting-orderan.suntingOrderan',
            [
                'gambar'=>$gambar,
                'viewtulisorder' => $viewtulisorder,
                'juragans' => $juragans,
                'employees' => $employees,

                'ongkir' => $ongkir,
                'kda' => $kda,
                'title' => $title,
                'nomer_order' => $nomer_order,
                'user_id' => $user->id,

            ]
        );
    }



    public function deleteorder($orderNumber)
    {
        $orders = Order::where('order_number', $orderNumber)->get();

        if ($orders->isNotEmpty()) {
            Order::where('order_number', $orderNumber)->delete();
            UpdateProses::where('order_number', $orderNumber)->delete();
            return back()->with('success', 'Data berhasil dihapus dari viewtulisorder.');
        } else {
            return back()->with('error', 'Data gagal dihapus. Order tidak ditemukan.');
        }
    }



    public function notifSuntingOrder($orderNumber, $employeesName)
    {
        $teks = " $employeesName telah melakukan sunting Orderan pada invoice $orderNumber";






        return $teks;
    }


    public function kesunting(Request $request, $orderNumber)
    {
        $user = Auth::guard('employee')->user();


        $orders = BarangOrder::where('order_number', $orderNumber)->get();
        $notas = Order::where('order_number', $orderNumber)->first();


        if ($notas) {
            $ongkir = $notas->ongkir;
            $dana_ongkir = $notas->dana_ongkir;

            foreach ($orders as $order) {
                $barang = Barang::find($order->id_produk);

                if ($barang) {
                    $viewtulisorder = new ViewTulisOrder();

                    $viewtulisorder->order_number = $order->order_number;
                    $viewtulisorder->ukuran = $order->size;
                    $viewtulisorder->jasa_ongkir = $ongkir;
                    $viewtulisorder->ongkir = $dana_ongkir;
                    $viewtulisorder->barang = $barang->nama;
                    $viewtulisorder->kd = $barang->id;
                    $viewtulisorder->harga = $barang->harga_satuan;
                    $viewtulisorder->qty = $order->quantity;
                    $viewtulisorder->save();
                }
            }
            Order::where('order_number', $orderNumber)->delete();
            BarangOrder::where('order_number', $orderNumber)->delete();

            return redirect()->route('suntinga', ['orderNumber' => $orderNumber]);
        } else {
            return redirect()->route('suntinga', ['orderNumber' => $orderNumber]);
        }
        $notif =  $this->notifSuntingOrder($orderNumber, $user->name);
        OrderCreatedNotif::dispatch($notif);
    }
    public function kesuntingsa(Request $request, $orderNumber)
    {
        $user = Auth::guard('employee')->user();
        $orders = BarangOrder::where('order_number', $orderNumber)->get();
        $notas = Order::where('order_number', $orderNumber)->first();


        if ($notas) {
            $ongkir = $notas->ongkir;
            $dana_ongkir = $notas->dana_ongkir;
            $biaya_lain = $notas->biaya_lain;
            $dana_biaya_lain = $notas->dana_dana_biaya_lain;

            foreach ($orders as $order) {
                $barang = Barang::find($order->id_produk);

                if ($barang) {
                    $viewtulisorder = new ViewTulisOrder();

                    $viewtulisorder->order_number = $order->order_number;
                    $viewtulisorder->ukuran = $order->size;
                    $viewtulisorder->jasa_ongkir = $ongkir;
                    $viewtulisorder->jasa_biaya_lain = $biaya_lain;
                    $viewtulisorder->ongkir = $dana_ongkir;
                    $viewtulisorder->biaya_lain = $dana_biaya_lain;
                    $viewtulisorder->barang = $barang->nama;
                    $viewtulisorder->kd = $barang->id;
                    $viewtulisorder->harga = $barang->harga_satuan;
                    $viewtulisorder->qty = $order->quantity;
                    $viewtulisorder->subtotal = $order->subtotal;
                    $viewtulisorder->save();
                }
            }
            Order::where('order_number', $orderNumber)->delete();
            BarangOrder::where('order_number', $orderNumber)->delete();

            return redirect()->route('suntingsa', ['orderNumber' => $orderNumber]);
        } else {
            return redirect()->route('suntingsa', ['orderNumber' => $orderNumber]);
        }
        // public function coba(Request $request, $orderNumber)
        // {
        //     $coba=$request->input('percobaan');
        //     Order::where('order_number', $orderNumber)->update(['notes' => $coba]);
        //     return redirect()->back();
        // }


    }
}
