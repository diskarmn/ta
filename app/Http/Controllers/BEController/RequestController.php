<?php

namespace App\Http\Controllers\BEController;

use Carbon\Carbon;
use App\Models\Notif;
use App\Models\Order;
use App\Models\Barang;
use App\Models\Juragan;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Keranjang;
use App\Models\Pelanggan;
use App\Models\Notiforder;
use App\Models\BarangOrder;
use App\Models\EditRequest;
use Illuminate\Http\Request;
use App\Models\InfoPembayaran;
use App\Events\NotifRequestEdit;
use App\Events\OrderCreatedNotif;
use Illuminate\Support\Facades\DB;
use App\Events\NotifRequestDitolak;
use App\Events\NotifRequestPending;
use Illuminate\Support\Facades\Log;
use App\Events\NotifRequestDiterima;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RequestController extends Controller
{
    public function main()
    {
        $gambar = Auth::guard('employee')->user()->profile_image;
        $title = "Request Super Admin";
        $requests = EditRequest::with(['order' => function ($query) {
            $query->select('id', 'order_number', 'juragan');
        }, 'order.juragan:id,name_juragan'])
            ->whereNull('selesai')

            ->get();
        $status = EditRequest::with(['order' => function ($query) {
            $query->select('id', 'order_number', 'juragan');
        }, 'order.juragan:id,name_juragan'])
            ->whereNotNull('selesai')
            ->where('selesai', '<>', '')
            ->get();

        $notifications = Notiforder::all();

        return view(
            'admin.request.main',
            [
                'requests' => $requests,
                'title' => $title,
                'status' => $status,
                'notifications' => $notifications,
                "gambar" => $gambar
            ]
        );
    }

    public function mainSA()
    {
        $title = "Request Super Admin";
        $requests = EditRequest::with(['order' => function ($query) {
            $query->select('id', 'order_number', 'juragan');
        }, 'order.juragan:id,name_juragan'])
            ->whereNull('selesai')

            ->get();
        $status = EditRequest::with(['order' => function ($query) {
            $query->select('id', 'order_number', 'juragan');
        }, 'order.juragan:id,name_juragan'])
            ->whereNotNull('selesai')
            ->where('selesai', '<>', '')
            ->get();


        return view('super-admin.request.main', ['requests' => $requests, 'title' => $title, 'status' => $status]);
    }

    public function handleRequest($order_number, $status)
    {
        $teks = "Request edit 'Data Pesanan' pada invoice $order_number $status";

        $notification = new Notiforder([
            'teks' => $teks,
        ]);

        $notification->save();

        return $teks;
    }


    public function requestPending($orderNumber)
    {
        $teks = "Request edit 'Data Pesanan' pada invoice $orderNumber menunggu konfirmasi";

        $notification = new Notiforder([
            'teks' => $teks,
        ]);

        $notification->save();

        return $teks;
    }

    public function notifSelesiDiedit($order_number)
    {
        $teks = "Request edit 'Data Pesanan' pada invoice $order_number telah selesai di edit";

        $notification = new Notiforder([
            'teks' => $teks,
        ]);

        $notification->save();

        return $teks;
    }



    // public function index()
    // {
    //     $requests = EditRequest::where('status', 'belum_proses')->get();
    //     $finishedRequests = EditRequest::where('status', 'orderan_selesai')->get();

    //     return view('admin.request.main', compact('requests', 'finishedRequests'));
    // }

    public function showOrderDetail($order_number)
    {
        $title = "Request Detail";
        $user = Auth::guard('employee')->user();
        $orders = Order::with('barang')
            ->where('order_number', $order_number)
            ->get()
            ->first();
        $status = EditRequest::with(['order' => function ($query) {
            $query->select('id', 'order_number', 'juragan'); // Memilih kolom id, order_number, dan juragan saja dari tabel Order
        }, 'order.juragan:id,name_juragan'])
            ->whereNotNull('selesai') // Hanya ambil yang kolom 'selesai' tidak null
            ->where('selesai', '<>', '') // Hanya ambil yang kolom 'selesai' tidak kosong
            ->get();
        if ($orders) {
            $order = $orders;
            $customer = Customer::where('id', $order->id_customer)->first();
            $userid =  Auth::guard('employee')->user()->id;
            $employee = Employee::where('id', $userid)->first();
            $requests = EditRequest::where('id_order', $order->id)->get();
            $items = $order->barang; // sudah di-load dengan 'with'
            $totalPrice = 0;
            // foreach ($items as $item) {
            //     if (is_object($item) && isset($item->total_quantity) && isset($item->harga_satuan)) {
            //         $totalPrice += $item->total_quantity * ($item->harga_satuan ?? 0);
            //     }
            // }
            $notifications = Notiforder::all();
            // Kirim data ke view
            return view('admin.request.main', compact('order', 'customer', 'requests', 'items', 'totalPrice', 'title', 'userid', 'status', 'notifications'));
        } else {
            // Jika pesanan tidak ditemukan, kembalikan pesan error
            return view('admin.request.main')->with('error', 'Pesanan tidak ditemukan.');
        }
    }


    public function showOrderDetailSA($order_number)
    {
        $title = "Request Detail";
        $user = Auth::guard('employee')->user();
        $orders = Order::with('barang')
            ->where('order_number', $order_number)
            ->get()
            ->first();
        $status = EditRequest::with(['order' => function ($query) {
            $query->select('id', 'order_number', 'juragan'); // Memilih kolom id, order_number, dan juragan saja dari tabel Order
        }, 'order.juragan:id,name_juragan'])
            ->whereNotNull('selesai') // Hanya ambil yang kolom 'selesai' tidak null
            ->where('selesai', '<>', '') // Hanya ambil yang kolom 'selesai' tidak kosong
            ->get();
        if ($orders) {
            $order = $orders;
            $customer = Customer::where('id', $order->id_customer)->first();
            $userid =  Auth::guard('employee')->user()->id;
            $employee = Employee::where('id', $userid)->first();
            $requests = EditRequest::where('id_order', $order->id)->get();
            $items = $order->barang; // sudah di-load dengan 'with'
            $totalPrice = 0;
            // foreach ($items as $item) {
            //     if (is_object($item) && isset($item->total_quantity) && isset($item->harga_satuan)) {
            //         $totalPrice += $item->total_quantity * ($item->harga_satuan ?? 0);
            //     }
            // }

            // Kirim data ke view
            return view('super-admin.request.main', compact('order', 'customer', 'requests', 'items', 'totalPrice', 'title', 'userid', 'status'));
        } else {
            // Jika pesanan tidak ditemukan, kembalikan pesan error
            return view('super-admin.request.main')->with('error', 'Pesanan tidak ditemukan.');
        }
    }

    public function edit($order_number)
    {
        $title = "Request Edit";
        $user = Auth::guard('employee')->user();
        $orders = BarangOrder::where('order_number', $order_number)->get();
        $notas = Order::where('order_number', $order_number)->first();


        if ($notas) {
            $ongkir = $notas->ongkir;
            $dana_ongkir = $notas->dana_ongkir;
            $biaya_lain = $notas->biaya_lain;
            $dana_biaya_lain = $notas->dana_dana_biaya_lain;

            foreach ($orders as $order) {
                $barang = Barang::find($order->id_produk);

                if ($barang) {
                    $keranjang = new Keranjang();

                    $keranjang->order_number = $order->order_number;
                    $keranjang->ukuran = $order->size;
                    $keranjang->jasa_ongkir = $ongkir;
                    $keranjang->jasa_biaya_lain = $biaya_lain;
                    $keranjang->ongkir = $dana_ongkir;
                    $keranjang->biaya_lain = $dana_biaya_lain;
                    $keranjang->barang = $barang->nama;
                    $keranjang->kd = $barang->id;
                    $keranjang->harga = $barang->harga_satuan;
                    $keranjang->qty = $order->quantity;
                    $keranjang->point = $barang->point;
                    $keranjang->subtotal = $order->subtotal;
                    $keranjang->save();
                }
            }
        }

        DB::table('requests')
            ->where('order_number', $order_number)
            ->update(['selesai' => 'diterima']);

            Order::where('order_number', $order_number)->delete();
            BarangOrder::where('order_number', $order_number)->delete();
        $notif = $this->handleRequest($order_number, 'diterima');
        NotifRequestDiterima::dispatch($notif);
        $notifications = Notiforder::all();
        return redirect()->route('admin.requestEdit.view', ['order_number' => $order_number, 'notifications' => $notifications]);
    }

    public function ditolakA($order_number)
    {
        DB::table('requests')
            ->where('order_number', $order_number)
            ->update(['selesai' => 'ditolak']);

        $notif = $this->handleRequest($order_number, 'ditolak');
        NotifRequestDitolak::dispatch($notif);

        return redirect()->route('admin.request.main');
    }

    public function viewrequestA($order_number)
    {
        $gambar = Auth::guard('employee')->user()->profile_image;
        $title = "Request Edit";
        $user = Auth::guard('employee')->user();

        $requests = EditRequest::where('order_number', $order_number)->get();

        $juragans = Juragan::get();
        $employees = Employee::get();

        $keranjang = Keranjang::where('order_number', $order_number)->get();

        $biaya_lain = Keranjang::whereNotNull('biaya_lain')
            ->whereNotNull('jasa_biaya_lain')
            ->where('order_number', $order_number)
            ->get();
        $ongkir = Keranjang::whereNotNull('ongkir')
            ->whereNotNull('jasa_ongkir')
            ->where('order_number', $order_number)
            ->get();
        $kda = Barang::all();
        $nomer_order = $order_number;
        
        return view('admin.request.requestEdit', [
            'request' => $requests,
            'keranjang' => $keranjang,
            'juragans' => $juragans,
            'employees' => $employees,
            'biaya_lain' => $biaya_lain,
            'ongkir' => $ongkir,
            'kda' => $kda,
            'title' => $title,
            'nomer_order' => $nomer_order,
            'user_id' => $user->id,

            "gambar" => $gambar
        ]);
    }

    public function moveOrder(Request $request)
    {
        $user = Auth::guard('employee')->user();
        $kdProdukArray = $request->input('kd_produk_f');
        $hargaArray = $request->input('harga_produk_f');
        $sizeArray = $request->input('ukuran_f');
        $qtyArray = $request->input('quantity_f');

        $orders = [];
        foreach ($kdProdukArray as $index => $kdProduk) {
            $keranjang = Keranjang::create([
                'kd' => $kdProduk,
                'harga' => $hargaArray[$index],
                'ukuran' => $sizeArray[$index],
                'qty' => $qtyArray[$index],
                'employee_id' => $user->id
            ]);
            $keranjang->save();
        }

        return redirect()->route('admin.request.main');

        // dd($keranjang);
    }

    public function vieweditSA()
    {
        return view('super-admin.request.requestEdit');
    }

    // public function editSA($order_number)
    // {
    //     $user = Auth::guard('employee')->user();
    //     $title = "Request Edit";
    //     $orderan = Order::with('barang', 'customer', 'requests')
    //         ->where('order_number', $order_number)
    //         ->first();
    //     $keranjangItems = [];
    //     $orders = Order::where('order_number', $order_number)->get();
    //     foreach ($orders as $order) {
    //         if (!Keranjang::where('kd', $order->barang->kd_produk)->exists()) {
    //             $keranjang = new Keranjang();
    //             $keranjang->kd = $order->barang->kd_produk;
    //             $keranjang->barang = $order->barang->nama;
    //             $keranjang->harga = $order->barang->harga_satuan;
    //             $keranjang->ukuran = $order->size;
    //             $keranjang->qty = $order->quantity;
    //             $keranjang->employee_id = $user->id;
    //             $keranjang->subtotal = $order->barang->harga_satuan * $order->quantity;
    //             $keranjangItems[] = $keranjang->toArray();
    //         }
    //     }
    //     Keranjang::insert($keranjangItems);
    //     $keranjang = Keranjang::where('employee_id', $user->id)->get();
    //     $requests = EditRequest::where('id_order', $orderan->id)->get();
    //     $juragans = Juragan::get();
    //     $employees = Employee::get();
    //     $biaya_lain = Keranjang::whereNotNull('biaya_lain')
    //         ->whereNotNull('jasa_biaya_lain')
    //         ->where('employee_id', $user->id)
    //         ->get();
    //     $ongkir = Keranjang::whereNotNull('ongkir')
    //         ->whereNotNull('jasa_ongkir')
    //         ->where('employee_id', $user->id)
    //         ->get();
    //     $kda = Barang::all();
    //     return view('super-admin.request.requestEdit', [
    //         'request' => $requests,
    //         'keranjang'=>$keranjang,
    //         'orderan' => $orderan,
    //         'juragans' => $juragans,
    //         'customer' => $orderan->customer,
    //         'employees' => $employees,
    //         'biaya_lain' => $biaya_lain,
    //         'ongkir' => $ongkir,
    //         'kda' => $kda,
    //         'barang' => $orderan->barang,
    //         'title' => $title,
    //     ]);

    // }

    public function viewrequestSA($order_number)
    {
        $title = "Request Edit";
        $user = Auth::guard('employee')->user();

        $requests = EditRequest::where('order_number', $order_number)->get();

        $juragans = Juragan::get();
        $employees = Employee::get();

        $keranjang = Keranjang::where('order_number', $order_number)->get();

        $biaya_lain = Keranjang::whereNotNull('biaya_lain')
            ->whereNotNull('jasa_biaya_lain')
            ->where('order_number', $order_number)
            ->get();
        $ongkir = Keranjang::whereNotNull('ongkir')
            ->whereNotNull('jasa_ongkir')
            ->where('order_number', $order_number)
            ->get();
        $kda = Barang::all();
        $nomer_order = $order_number;

        return view('super-admin.request.requestEdit', [
            'request' => $requests,
            'keranjang' => $keranjang,
            'juragans' => $juragans,
            'employees' => $employees,
            'biaya_lain' => $biaya_lain,
            'ongkir' => $ongkir,
            'kda' => $kda,
            'title' => $title,
            'nomer_order' => $nomer_order,
            'user_id' => $user->id,
        ]);
    }
    public function kerequestSA($order_number)
    {
        $user = Auth::guard('employee')->user();
        $orders = BarangOrder::where('order_number', $order_number)->get();
        $notas = Order::where('order_number', $order_number)->first();


        if ($notas) {
            $ongkir = $notas->ongkir;
            $dana_ongkir = $notas->dana_ongkir;
            $biaya_lain = $notas->biaya_lain;
            $dana_biaya_lain = $notas->dana_dana_biaya_lain;

            foreach ($orders as $order) {
                $barang = Barang::find($order->id_produk);

                if ($barang) {
                    $keranjang = new Keranjang();

                    $keranjang->order_number = $order->order_number;
                    $keranjang->ukuran = $order->size;
                    $keranjang->jasa_ongkir = $ongkir;
                    $keranjang->jasa_biaya_lain = $biaya_lain;
                    $keranjang->ongkir = $dana_ongkir;
                    $keranjang->biaya_lain = $dana_biaya_lain;
                    $keranjang->barang = $barang->nama;
                    $keranjang->kd = $barang->id;
                    $keranjang->harga = $barang->harga_satuan;
                    $keranjang->qty = $order->quantity;
                    $keranjang->point = $barang->point;
                    $keranjang->subtotal = $order->subtotal;
                    $keranjang->save();
                }
            }
        }


        DB::table('requests')
            ->where('order_number', $order_number)
            ->update(['selesai' => 'diterima']);
        Order::where('order_number', $order_number)->delete();
        BarangOrder::where('order_number', $order_number)->delete();

        $notif = $this->handleRequest($order_number, 'diterima');
        NotifRequestDiterima::dispatch($notif);

        return redirect()->route('super-admin.requestEdit.view', ['order_number' => $order_number]);
    }

    public function ditolakSA($order_number)
    {
        DB::table('requests')
            ->where('order_number', $order_number)
            ->update(['selesai' => 'ditolak']);

        $notif = $this->handleRequest($order_number, 'ditolak');
        NotifRequestDitolak::dispatch($notif);

        return redirect()->route('super-admin.request.main');
    }



    // keranjang
    public function keranjangrequest(Request $request)
    {
        $user = Auth::guard('employee')->user();
        $request->validate([
            'kd' => 'required',
            'order_number' => 'required',
            'nama_barang' => 'required',
            'harga' => 'required',
            'ukuran' => 'required',
            'qty' => 'required',
            'point' => 'required'
        ]);
        // dd($request->all());
        Keranjang::create([
            'kd' => $request->kd,
            'order_number' => $request->order_number,
            'harga' => $request->harga,
            'ukuran' => $request->ukuran,
            'qty' => $request->qty,
            'barang' => $request->nama_barang,
            'subtotal' => $request->harga * $request->qty,
            'employee_id' => $user->id,
            'point_per_barang' => $request->point,
            'point' => $request->point * $request->qty
        ]);
        Barang::where('id', $request->kd)
            ->decrement('stock', $request->qty);
        return redirect()->back()->with('success', 'Data berhasil ditambahkan ke keranjang.');
    }

    public function editkeranjangrequest(Request $request, $id)
    {
        $user = Auth::guard('employee')->user();
        $request->validate([
            'kd_edit' => 'nullable',
            'nama_barang_edit' => 'nullable',
            'harga_edit' => 'nullable',
            'ukuran_edit' => 'nullable',
            'qty_edit' => 'nullable',
            'qty_sebelumnya' => 'nullable',
            'point_edit' => 'nullable'
        ]);
        // dd($request->all());
        $keranjang = Keranjang::findOrFail($id);

        if ($keranjang) {
            $keranjang->kd = $request->kd_edit;
            $keranjang->barang = $request->nama_barang_edit;
            $keranjang->harga = $request->harga_edit;
            $keranjang->ukuran = $request->ukuran_edit;
            $keranjang->qty = $request->qty_edit;
            $keranjang->subtotal = $request->qty_edit * $request->harga_edit;
            $keranjang->employee_id = $user->id;
            $keranjang->point = $request->point_edit * $request->qty_edit;
            $keranjang->save();

            $barang = DB::table('barangs')
                ->where('id', $request->kd_edit)
                ->first();
            if ($barang) {
                $newStock = $barang->stock - $request->qty_edit + $request->qty_sebelumnya;
                DB::table('barangs')
                    ->where('id', $request->kd_edit)
                    ->update(['stock' => $newStock]);
            }
            return redirect()->back()->with('success', 'Data berhasil diubah pada keranjang.');
        } else {
            return response([
                'pesan' => 'Data gagal diubah',
            ]);
        }
    }

    public function ongkirrequest(Request $request)
    {
        $user = Auth::guard('employee')->user();
        $request->validate([
            'ongkir' => 'nullable',
            "jasa_ongkir" => 'nullable',
            'order_number' => 'required',
        ]);
        Keranjang::create([
            'ongkir' => $request->ongkir,
            'jasa_ongkir' => $request->jasa_ongkir,
            'employee_id' => $user->id,
            'order_number' => $request->order_number
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan ke keranjang.');
    }

    public function lainrequest(Request $request)
    {
        $user = Auth::guard('employee')->user();
        $request->validate([
            'biaya_lain' => 'required',
            "jasa_biaya_lain" => 'required',
            "order_number" => 'required',
        ]);
        Keranjang::create([
            'biaya_lain' => $request->biaya_lain,
            'jasa_biaya_lain' => $request->jasa_biaya_lain,
            'employee_id' => $user->id,
            'order_number' => $request->order_number
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan ke keranjang.');
    }





    public function editordersSA(Request $request)
    {
        $user = Auth::guard('employee')->user();


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
        $biaya_lain = $request->input('jasa_biaya_lain');
        $dana_ongkir = $request->input('ongkir');
        $dana_biaya_lain = $request->input('biaya_lain');
        $note = $request->input('note');
        $point = array_sum($request->input('point_v'));
        $pointArray=$request->input('point_v');
        $total_qty = array_sum($request->input('qty_f'));
        $order_number = $request->input('order_number');


        $pelanggan = Customer::find($id);
        if ($pelanggan && $point > 0) {
            $pelanggan->update(['point' => $point]);
        }

        $jumlah_uang = InfoPembayaran::where('order_number', $order_number)
            ->where('kelengkapan', 'Ada')
            ->sum('jumlah_dana');
        $kelengkapan = InfoPembayaran::where('order_number', $order_number)
            ->whereNull('kelengkapan')
            ->orWhere('kelengkapan', '')
            ->count();
        $proses = ($total_semua > $jumlah_uang) ? 'belum_proses' : 'dalam_proses';
        $status = ($kelengkapan > 0) ? 'cek_pembayaran' : $proses;

        $order = new Order();
        $order->total_amount = $total_semua;
        $order->total_quantity = $total_qty;
        $order->total_point = $point;
        $order->juragan = $juragan;
        $order->source = $sumber;
        $order->served_by = $served;
        $order->order_date = $tanggal;
        $order->id_customer = $id;
        $order->notes = $note;
        $order->order_number = $order_number;
        $order->ongkir = $ongkir;
        $order->biaya_lain = $biaya_lain;
        $order->dana_ongkir = $dana_ongkir;
        $order->dana_biaya_lain = $dana_biaya_lain;

        $order->save();

        $orderId = Order::where('order_number', $order_number)->value('id');
        // dd($orderId);

        $orders = [];
        foreach ($kdProdukArray as $index => $kdProduk) {
            $barangOrder = BarangOrder::create([
                'id_produk' => $kdProduk,
                'id_order' => $orderId,
                'size' => $sizeArray[$index],
                'quantity' => $qtyArray[$index],
                'subtotal' => $subtotal[$index],
                'order_number' => $order_number,
                'point' => $pointArray[$index],
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

        $ordernya = Order::where('order_number', $order_number)->first();
        $id_ordernya = $ordernya->id;

        Keranjang::where('order_number', $order_number)->get()->each(function ($item) {
            $item->delete();
        });

        EditRequest::where('order_number', $order_number)->update(['id_order' => $id_ordernya]);

        $notif = $this->notifSelesiDiedit($order_number);
        NotifRequestEdit::dispatch($notif);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan ke keranjang.');
    }

    public function suntingeditordersSA(Request $request)
    {

        $user = Auth::guard('employee')->user();
        $total_semua = $request->input('total_f');
        $kdProdukArray = $request->input('kd_produk_f');
        $sizeArray = $request->input('size_f');
        $qtyArray = $request->input('qty_f');
        $subtotal = $request->input('subtotal_f');
        $juragan = $request->input('juragan_f');
        $sumber = $request->input('sumber_f');
        $served = $request->input('served_by');
        $tanggal = $request->input('tanggal_order');
        $id = $request->input('id_pelanggan_keorder');
        $ongkir = $request->input('jasa_ongkir');
        $biaya_lain = $request->input('jasa_biaya_lain');
        $dana_ongkir = $request->input('ongkir');
        $dana_biaya_lain = $request->input('biaya_lain');
        $note = $request->input('note');
        $point = array_sum($request->input('point_v'));
        $pointArray = $request->input('point_v');
        $total_qty = array_sum($request->input('qty_f'));


        $order_number = $request->input('order_number');

        $pelanggan = Customer::find($id);
        if ($pelanggan && $point > 0) {
            $pelanggan->update(['point' => $point]);
        }

        $order = new Order();
        $order->total_amount = $total_semua;
        $order->juragan = $juragan;
        $order->source = $sumber;
        $order->served_by = $served;
        $order->order_date = $tanggal;
        $order->id_customer = $id;
        $order->notes = $note;
        $order->order_number = $order_number;
        $order->ongkir = $ongkir;
        $order->biaya_lain = $biaya_lain;
        $order->dana_ongkir = $dana_ongkir;
        $order->dana_biaya_lain = $dana_biaya_lain;
        $order->total_quantity = $total_qty;
        $order->total_point = $point;

        $order->save();

        $orderId = Order::where('order_number', $order_number)->value('id');

        $orders = [];
        foreach ($kdProdukArray as $index => $kdProduk) {
            $order = BarangOrder::create([
                'id_produk' => $kdProduk,
                'id_order' => $orderId,
                'size' => $sizeArray[$index],
                'quantity' => $qtyArray[$index],
                'subtotal' => $subtotal[$index],
                'order_number' => $order_number,
                'point' => $pointArray[$index],
            ]);
            if ($order->save()) {
                $orders[] = $order;
            }
        }



        if (!empty($orders)) {
            Log::info('Memulai memicu event OrderCreatedNotif dengan orders: ', $orders);
            event(new OrderCreatedNotif(collect($orders)));
            Log::info('Event OrderCreatedNotif dipicu.');
        }

        $jumlah_uang = InfoPembayaran::where('order_number', $order_number)
            ->where('kelengkapan', 'Ada')
            ->sum('jumlah_dana');

        $ordernya = Order::where('order_number', $order_number)->first();
        $id_ordernya = $ordernya->id;
        Keranjang::where('order_number', $order_number)->get()->each(function ($item) {
            $item->delete();
        });
        EditRequest::where('order_number', $order_number)->update(['id_order' => $id_ordernya]);


        return redirect()->route('semua-orderan');
    }
    public function suntingeditordersA(Request $request)
    {

        $user = Auth::guard('employee')->user();
        $total_semua = $request->input('total_f');
        $kdProdukArray = $request->input('kd_produk_f');
        $sizeArray = $request->input('size_f');
        $qtyArray = $request->input('qty_f');
        $subtotal = $request->input('subtotal_f');
        $juragan = $request->input('juragan_f');
        $sumber = $request->input('sumber_f');
        $served = $request->input('served_by');
        $tanggal = $request->input('tanggal_order');
        $id = $request->input('id_pelanggan_keorder');
        $ongkir = $request->input('jasa_ongkir');
        $biaya_lain = $request->input('jasa_biaya_lain');
        $dana_ongkir = $request->input('ongkir');
        $dana_biaya_lain = $request->input('biaya_lain');
        $note = $request->input('note');
        // $point = array_sum($request->input('point_v'));
        // $pointArray = $request->input('point_v');
        $total_qty = array_sum($request->input('qty_f'));


        $order_number = $request->input('order_number');



        $order = new Order();
        $order->total_amount = $total_semua;
        $order->juragan = $juragan;
        $order->source = $sumber;
        $order->served_by = $served;
        $order->order_date = $tanggal;
        $order->id_customer = $id;
        $order->notes = $note;
        $order->order_number = $order_number;
        $order->ongkir = $ongkir;
        $order->biaya_lain = $biaya_lain;
        $order->dana_ongkir = $dana_ongkir;
        $order->dana_biaya_lain = $dana_biaya_lain;
        $order->total_quantity = $total_qty;

        $order->save();

        $orderId = Order::where('order_number', $order_number)->value('id');

        $orders = [];
        foreach ($kdProdukArray as $index => $kdProduk) {
            $order = BarangOrder::create([
                'id_produk' => $kdProduk,
                'id_order' => $orderId,
                'size' => $sizeArray[$index],
                'quantity' => $qtyArray[$index],
                'subtotal' => $subtotal[$index],
                'order_number' => $order_number,
            ]);
            if ($order->save()) {
                $orders[] = $order;
            }
        }

        if (!empty($orders)) {
            Log::info('Memulai memicu event OrderCreatedNotif dengan orders: ', $orders);
            event(new OrderCreatedNotif(collect($orders)));
            Log::info('Event OrderCreatedNotif dipicu.');
        }
        $ordernya = Order::where('order_number', $order_number)->first();
        $id_ordernya = $ordernya->id;
        Keranjang::where('order_number', $order_number)->get()->each(function ($item) {
            $item->delete();
        });
        // EditRequest::where('order_number', $order_number)->update(['id_order' => $id_ordernya]);


        return redirect()->route('semua-orderancs');
    }




    public function updateOrder(Request $request, $id)
    {
        $title = 'Update Request';
        $validator = Validator::make($request->all(), [
            'name_juragan' => 'required',
            'source' => 'required',
            // 'served_by' => 'nullable',
            'name' => 'required',
            'notes' => 'required',
            'kd_produk' => 'required',
            'harga_satuan' => 'required',
            'quantity' => 'required',
            'size' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Cari pelanggan berdasarkan nama
        $pelanggan = Customer::where('name', $request->name)->first();
        if (!$pelanggan) {
            return response()->json(['error' => 'Pelanggan tidak ditemukan'], 404);
        }

        // $employee = Employee::where('name', $request->served_by)->first();
        // if (!$employee) {
        //     return response()->json(['error' => 'Employee tidak ditemukan'], 404);
        // }

        // Cari produk berdasarkan kode
        $produk = Barang::where('kd_produk', $request->kd_produk)->first();
        if (!$produk) {
            return response()->json(['error' => 'Produk tidak ditemukan'], 404);
        }

        // Cari order berdasarkan nomor order
        $order = Order::where('id', $id)->first();
        if (!$order) {
            return response()->json(['error' => 'Order tidak ditemukan'], 404);
        }

        $juragan = Juragan::where('name_juragan', $request->name_juragan)->first();
        if (!$juragan) {
            return response()->json(['error' => 'Juragan tidak ditemukan'], 404);
        }

        // Update data order
        $order = Order::findOrFail($id);
        // dd($order);
        $order->fill([
            'name_juragan' => $request->$juragan,
            'source' => $request->source,
            'name' => $request->$pelanggan,
            // 'served_by' => $request->$employee,
            'notes' => $request->notes,
            'kd_produk' => $request->kd_produk,
            'harga_satuan' => $request->harga_satuan,
            'quantity' => $request->quantity,
            'size' => $request->size,
        ]);

        $order->save();
        // dd($order);

        return response()->json([
            'success' => true,
            'message' => 'Order berhasil diupdate',
            'data' => $order
        ], 200);
    }

    public function updateOrderSA(Request $request, $id)
    {
        $title = 'Update Rqguest';
        $validator = Validator::make($request->all(), [
            'name_juragan' => 'required',
            'source' => 'required',
            // 'served_by' => 'nullable',
            'name' => 'required',
            'notes' => 'required',
            'kd_produk' => 'required',
            'harga_satuan' => 'required',
            'quantity' => 'required',
            'size' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Cari pelanggan berdasarkan nama
        $pelanggan = Customer::where('name', $request->name)->first();
        if (!$pelanggan) {
            return response()->json(['error' => 'Pelanggan tidak ditemukan'], 404);
        }

        // $employee = Employee::where('name', $request->served_by)->first();
        // if (!$employee) {
        //     return response()->json(['error' => 'Employee tidak ditemukan'], 404);
        // }

        // Cari produk berdasarkan kode
        $produk = Barang::where('kd_produk', $request->kd_produk)->first();
        if (!$produk) {
            return response()->json(['error' => 'Produk tidak ditemukan'], 404);
        }

        // Cari order berdasarkan nomor order
        $order = Order::where('id', $id)->first();
        if (!$order) {
            return response()->json(['error' => 'Order tidak ditemukan'], 404);
        }

        $juragan = Juragan::where('name_juragan', $request->name_juragan)->first();
        if (!$juragan) {
            return response()->json(['error' => 'Juragan tidak ditemukan'], 404);
        }

        // Update data order
        $order = Order::findOrFail($id);
        // dd($order);
        $order->fill([
            'name_juragan' => $request->$juragan,
            'source' => $request->source,
            'name' => $request->$pelanggan,
            // 'served_by' => $request->$employee,
            'notes' => $request->notes,
            'kd_produk' => $request->kd_produk,
            'harga_satuan' => $request->harga_satuan,
            'quantity' => $request->quantity,
            'size' => $request->size,
        ]);

        $order->save();
        // dd($order);

        return response()->json([
            'success' => true,
            'message' => 'Order berhasil diupdate',
            'data' => $order
        ], 200);
    }

    public function updateCustomer(Request $request, $id_order)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'phone2' => 'nullable',
            'address' => 'required',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'kodepos' => 'required',
            'cs_id' => 'nullable'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $order = Order::findOrFail($id_order);

        // Retrieve the associated customer
        $customer = $order->customer;

        // Update the customer data
        $customer->update($validator->validated());

        return back()->with('message', 'sucsess euy');
    }

    public function updateCustomerSA(Request $request, $id_order)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'phone2' => 'nullable',
            'address' => 'required',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'kodepos' => 'required',
            'cs_id' => 'nullable'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $order = Order::findOrFail($id_order);

        // Retrieve the associated customer
        $customer = $order->customer;

        // Update the customer data
        $customer->update($validator->validated());

        return back()->with('message', 'sucsess euy');
    }


    public function notifRequestEdit($orderNumber, $csName, $juraganName)
    {
        $teks = "[ $csName | $juraganName ] Merequest Edit 'Data Pesanan' pada invoice $orderNumber";


        $notification = new Notiforder([
            'teks' => $teks,
        ]);

        $notification->save();

        return $teks;
    }

    public function editRequest(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'order_number' => 'required', // Pastikan id_order ada dalam permintaan
            'detail' => 'required',
        ]);

        // Ambil data order dari tabel orders berdasarkan nomor pesanan
        $order = Order::where('order_number', $request->order_number)->first();

        // Jika pesanan tidak ditemukan
        if (!$order) {
            return back()->with('error', 'Pesanan tidak ditemukan');
        }

        // Periksa apakah ada permintaan yang sudah ada untuk pesanan ini
        $existingRequest = EditRequest::where('id_order', $order->id)->first();
        if ($existingRequest) {
            return back()->with('error', 'Permintaan untuk pesanan ini sudah ada');
        }

        // Buat permintaan baru
        $newRequest = EditRequest::create([
            'id_order' => $order->id,
            'detail' => $request->detail,
            'order_number' => $request->order_number,
        ]);

        // Ambil nama customer service yang sedang login
        $csName = Auth::guard('employee')->user()->name;

        // Ambil nama juragan yang sesuai dengan order_number
        $juraganName = Juragan::whereHas('orders', function ($query) use ($request) {
            $query->where('order_number', $request->order_number);
        })->pluck('name_juragan')->first();

        // Panggil fungsi notifRequestEdit untuk membuat notifikasi
        $notifEdit = $this->notifRequestEdit($request->order_number, $csName, $juraganName);
        NotifRequestEdit::dispatch($notifEdit);

        // Buat notifikasi pending
        $notifPending = $this->requestPending($request->order_number);
        NotifRequestPending::dispatch($notifPending);

        // Ambil data customer dari tabel customers berdasarkan id customer dalam order
        $customer = Customer::find($order->customer_id);

        // Kirim pesan sukses ke halaman sebelumnya dan sertakan data order dan customer
        return redirect()->route('semua-orderanCS')->with('success-pending', $notifPending)->with(compact('order', 'customer'));
    }


    public function tambahPesanan(Request $request)
    {

        $request->validate([
            'kd' => 'required',
            'harga' => 'required',
            'ukuran' => 'required',
            'qty' => 'required',
        ]);
        $keranjang = Keranjang::create([
            'kd' => $request->kd,
            'harga' => $request->harga,
            'ukuran' => $request->ukuran,
            'qty' => $request->qty,
            'employee_id' => Auth::guard('employee')->user()->id,
            'subtotal' => $request->harga * $request->qty
            // 'order_id' => $request->order_id,
        ]);
        $keranjang->save();
        // Redirect atau kembalikan respons sesuai kebutuhan aplikasi Anda
        return redirect()->back()->with('success', 'Pesanan berhasil ditambahkan ke keranjang.');
    }

    public function editOrder(Request $request, $keranjang_id)
    {
        $user = Auth::guard('employee')->user();
        // Ambil data yang diterima dari form
        $kd_produk = $request->input('kd');
        $harga = $request->input('harga');
        $ukuran = $request->input('ukuran');
        $qty = $request->input('qty');

        // Lakukan validasi data jika diperlukan

        // Temukan record keranjang yang akan diedit
        $keranjang = Keranjang::find($keranjang_id);

        // Perbarui data keranjang
        $keranjang->kd = $kd_produk;
        $keranjang->harga = $harga;
        $keranjang->ukuran = $ukuran;
        $keranjang->qty = $qty;
        $keranjang->employee_id = $user->id;

        // Simpan perubahan
        $keranjang->save();
        // dd($keranjang);

        // Redirect atau berikan respons sesuai kebutuhan aplikasi Anda
        return redirect()->back()->with('success', 'Data order berhasil diperbarui.');
    }


    public function ongkir(Request $request)
    {
        $request->validate([
            'ongkir' => 'required',
            "jasa_ongkir" => 'required'
        ]);
        Keranjang::create([
            'employee_id' => Auth::guard('employee')->user()->id,
            'ongkir' => $request->ongkir,
            'jasa_ongkir' => $request->jasa_ongkir
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan ke keranjang.');
    }

    public function editOngkir(Request $request, $order_id)
    {
        $user = Auth::guard('employee')->user();
        // Ambil data yang diterima dari form
        $ongkir = $request->input('ongkir_edit');
        $jasa_ongkir = $request->input('jasa_ongkir_edit');

        // Lakukan validasi data jika diperlukan

        // Temukan record keranjang yang akan diedit
        $keranjang = Keranjang::find($order_id);

        // Perbarui data keranjang
        $keranjang->ongkir = $ongkir;
        $keranjang->jasa_ongkir = $jasa_ongkir;
        $keranjang->employee_id = $user->id;

        // Simpan perubahan
        $keranjang->save();
        // dd($keranjang);

        // Redirect atau berikan respons sesuai kebutuhan aplikasi Anda
        return redirect()->back()->with('success', 'Data order berhasil diperbarui.');
    }

    public function lain(Request $request)
    {
        // Validasi request dari form kedua
        $request->validate([
            'biaya_lain' => 'required|numeric',
            'jasa_biaya_lain' => 'required|string|max:20', // Sesuaikan validasi untuk string dan panjang maksimal
        ]);

        // Menyimpan data ke dalam tabel biaya lain
        Keranjang::create([
            'biaya_lain' => $request->biaya_lain,
            'jasa_biaya_lain' => $request->jasa_biaya_lain,
            'employee_id' => Auth::guard('employee')->user()->id
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
    }

    public function editBiaya(Request $request, $order_id)
    {
        $user = Auth::guard('employee')->user();
        // Ambil data yang diterima dari form
        $biaya_lain = $request->input('biaya_lain_edit');
        $jasa_biaya_lain = $request->input('jasa_biaya_lain_edit');

        // Lakukan validasi data jika diperlukan

        // Temukan record keranjang yang akan diedit
        $keranjang = Keranjang::find($order_id);

        // Perbarui data keranjang
        $keranjang->biaya_lain = $biaya_lain;
        $keranjang->jasa_biaya_lain = $jasa_biaya_lain;
        $keranjang->employee_id = $user->id;

        // Simpan perubahan
        $keranjang->save();
        // dd($keranjang);

        // Redirect atau berikan respons sesuai kebutuhan aplikasi Anda
        return redirect()->back()->with('success', 'Data order berhasil diperbarui.');
    }
}
