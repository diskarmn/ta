<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\BEController\PelangganProcess;


class PelangganController extends Controller
{
    /**
     * ganti view sesuai user, yang perlu diganti fungsi index show dan route web pada transaksi
     */

    public function indexcs()
    {
        $pelanggan = Customer::count();
        $historyOrder = Order::count();

        $search = request('search');

        // Menyimpan nilai pencarian dalam session
        Session::put('pelanggan_search', $search);
        return view('customer-service.data-pelanggan.dataPelanggan', [
            "title" => "Data Pelanggan",
            "pelanggan" => $pelanggan,
            "historyOrder" => $historyOrder,
            "customers" => Customer::latest()->filter(['search' => $search])->paginate(5)->withQueryString()
        ]);
    }
    public function index()
    {
        $pelanggan = Customer::count();
        $historyOrder = Order::distinct('order_number')->count();

        $search = request('search');

        // Menyimpan nilai pencarian dalam session
        Session::put('pelanggan_search', $search);


        return view('super-admin.data-pelanggan.dataPelanggan', [
            "title" => "Data Pelanggan",
            "pelanggan" => $pelanggan,
            "historyOrder" => $historyOrder,
            "customers" => Customer::latest()->filter(['search' => $search])->paginate(5)->withQueryString()
        ]);
    }

    public function indexForAdmin()
    {
        $search = request('search');
        $gambar = Auth::guard('employee')->user()->profile_image;
        // Menyimpan nilai pencarian dalam session
        Session::put('pelanggan_search', $search);

        return view('admin.data-pelanggan.dataPelanggan', [
            "title" => "Data Pelanggan",
            "customers" => Customer::latest()->filter(['search' => $search])->paginate(5)->withQueryString(),
            "gambar" => $gambar
        ]);
    }

    public function indexForCs()
    {
        $search = request('search');

        // Menyimpan nilai pencarian dalam session
        Session::put('pelanggan_search', $search);

        return view('customer-service.data-pelanggan.dataPelanggan', [
            "title" => "Data Pelanggan",
            "customers" => Customer::latest()->filter(['search' => $search])->paginate(5)->withQueryString()
        ]);
    }

    public function store(Request $request)
    {
        $addCustomer = new PelangganProcess;
        $addCustomer->addPelanggan($request);

        return back()->with('message', 'sukses nambah pelanggan');
    }

    public function showDetail($id)
    {
        $data = Customer::findOrFail($id);

        // Contoh menggunakan Eloquent
        $orders = Order::with('barang')
            ->where('id_customer', $id)
            ->get();

        $totalPoints = $orders->sum(function ($order) {
            return $order->barang->point * $order->quantity; // Asumsikan setiap order mengandung 'quantity' dari barang
        });


        return view('super-admin.data-pelanggan.detailPelanggan', [
            'title' => 'Detail Pelanggan',
            'detailData' => $data,
            'totalPoints' => $totalPoints
        ]);
    }

    public function showDetailForAdmin($id)
    {
        $data = Customer::findOrFail($id);
        $gambar = Auth::guard('employee')->user()->profile_image;
        // Contoh menggunakan Eloquent
        $orders = Order::with('barang')
            ->where('id_customer', $id)
            ->get();

        $totalPoints = $orders->sum(function ($order) {
            return $order->barang->point * $order->quantity; // Asumsikan setiap order mengandung 'quantity' dari barang
        });


        return view('admin.data-pelanggan.detailPelanggan', [
            'title' => 'Detail Pelanggan',
            'detailData' => $data,
            'totalPoints' => $totalPoints,
            "gambar" => $gambar
        ]);
    }

    public function showDetailForCs($id)
    {
        $data = Customer::findOrFail($id);

        // Contoh menggunakan Eloquent
        $orders = Order::with('barang')
            ->where('id_customer', $id)
            ->get();

        $totalPoints = $orders->sum(function ($order) {
            return $order->barang->point * $order->quantity; // Asumsikan setiap order mengandung 'quantity' dari barang
        });


        return view('customer-service.data-pelanggan.detailPelanggan', [
            'title' => 'Detail Pelanggan',
            'detailData' => $data,
            'totalPoints' => $totalPoints
        ]);
    }

    public function showRiwayatTransaksi($id)
    {
        // Dapatkan customer berdasarkan ID.
        $customer = Customer::findOrFail($id);

        // Dapatkan semua order yang berkaitan dengan customer ini.
        $orders = Order::with('barang', 'employee')
            ->where('id_customer', $id)
            ->get();

        $orderGroup = $orders->groupBy('order_number');

        // Kalkulasi total poin per order dan tambahkan ke total poin pelanggan.
        $totalPointsPerOrder = $orderGroup->map(function ($group) use ($customer) {
            return $group->sum(function ($order) use ($customer) {
                $totalPoints = $order->barang->point * $order->quantity;
                $customer->point += $totalPoints; // Tambahkan poin ke total poin pelanggan
                return $totalPoints;
            });
        });

        $totalPoints = $orders->sum(function ($order) {
            return $order->barang->point * $order->quantity; // Asumsikan setiap order mengandung 'quantity' dari barang
        });

        return view('super-admin.data-pelanggan.dataTransaksi', [
            'title' => 'Riwayat Transaksi',
            'dataTransaksi' => $customer,
            'orders' => $orderGroup,
            'totalPointsEachOrder' => $totalPointsPerOrder,
            'totalPoints' => $totalPoints
        ]);
    }


    public function showRiwayatTransaksiForAdmin($id)
    {
        // Dapatkan customer berdasarkan ID.
        $data = Customer::findOrFail($id);
        $gambar = Auth::guard('employee')->user()->profile_image;
        // Dapatkan semua order yang berkaitan dengan customer ini.
        $orders = Order::with('barang', 'employee')
            ->where('id_customer', $id)
            ->get();

        $orderGroup = $orders->groupBy('order_number');

        // Kalkulasi total poin per order.


        $totalPointsPerOrder = $orderGroup->map(function ($group) {
            return $group->sum(function ($order) {
                return $order->barang->point * $order->quantity;
            });
        });

        return view('admin.data-pelanggan.dataTransaksi', [
            'title' => 'Riwayat Transaksi',
            'dataTransaksi' => $data,
            'totalPointsEachOrder' => $totalPointsPerOrder,
            'orders' => $orderGroup,
            "gambar" => $gambar
        ]);
    }

    public function showRiwayatTransaksiForCs($id)
    {
        // Dapatkan customer berdasarkan ID.
        $data = Customer::findOrFail($id);

        // Dapatkan semua order yang berkaitan dengan customer ini.
        $orders = Order::with('barang', 'employee')
            ->where('id_customer', $id)
            ->get();

        // Mengambil total poin dari tabel customers

        $orderGroup = $orders->groupBy('order_number');



        $totalPointsPerOrder = $orderGroup->map(function ($group) {
            return $group->sum(function ($order) {
                return $order->barang->point * $order->quantity;
            });
        });

        return view('customer-service.data-pelanggan.dataTransaksi', [
            'title' => 'Riwayat Transaksi',
            'dataTransaksi' => $data,
            'totalPointsEachOrder' => $totalPointsPerOrder,
            'orders' => $orderGroup
        ]);
    }



    public function editPelanggan(Request $request, $id)
    {
        $editCustomer = new PelangganProcess;
        $editCustomer->updatePelanggan($request, $id);

        return redirect()->route('dataPelangganDetailSA', $id)->with('message', 'data berhasil di update');
    }

    public function editPelangganForAdmin(Request $request, $id)
    {
        $editCustomer = new PelangganProcess;
        $editCustomer->updatePelanggan($request, $id);

        return redirect()->route('detailPelangganAdmin', $id)->with('message', 'data berhasil di update');
    }

    public function editPelangganForCs(Request $request, $id)
    {
        $editCustomer = new PelangganProcess;
        $editCustomer->updatePelanggan($request, $id);

        return redirect()->route('detailPelangganCs', $id)->with('message', 'data berhasil di update');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pelanggan = Pelanggan::find($id);

        if (!$pelanggan) {
            abort(404); // Handle jika pelanggan tidak ditemukan
        }

        return view('customer-service.data-pelanggan.detailPelanggan', ['title' => 'Detail pelanggan'], compact('pelanggan'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $deletePelanggan = new PelangganProcess;
        $deletePelanggan->deletePelanggan($id);

        return back()->with('success', 'Berhasil menghapus data');
    }

    public function getCustomerIdByOrderNumber($orderNumber)
    {
        $customerId = Order::where('order_number', $orderNumber)->value('id_customer');

        if (!$customerId) {
            return null; // Handle jika order number tidak ditemukan
        }

        return $customerId;
    }

    public function addPointsCS(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'point' => 'required|integer',
        ]);

        // Retrieve the customer based on the ID from the URL
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        // Add the new points to the customer's existing points
        $customer->point += $request->point;

        // Save the changes to the database
        $customer->save();

        return redirect()->route('dataRiwayatTransaksiCs', ['id' => $id])->with('success', 'Points added successfully');
    }

    public function addPointsSA(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'point' => 'required|integer',
        ]);

        // Retrieve the customer based on the ID from the URL
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        // Add the new points to the customer's existing points
        $customer->point += $request->point;

        // Save the changes to the database
        $customer->save();

        return redirect()->route('dataRiwayatTransaksiSA', ['id' => $id])->with('success', 'Points added successfully');
    }

    public function addPointsAdmin(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'point' => 'required|integer',
        ]);

        // Retrieve the customer based on the ID from the URL
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        // Add the new points to the customer's existing points
        $customer->point += $request->point;

        // Save the changes to the database
        $customer->save();

        return redirect()->route('dataRiwayatTransaksiAdmin', ['id' => $id])->with('success', 'Points added successfully');
    }




}
