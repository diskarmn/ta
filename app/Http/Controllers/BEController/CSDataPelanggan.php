<?php

namespace App\Http\Controllers\BEController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;


class CSDataPelanggan extends Controller
{
    public function index(Customer $customer)
    {
        return view('customer-service.data-pelanggan.dataPelanggan', [
            "title" => " Data Pelanggan",
            "data_pelanggan" => $customer
        ]);
    }

    public function create(Request $request)
    {
        $csid = $request->input('cs_id');
        $name = $request->input('name');
        $email = $request->input('email');
        $register_date = now()->format('Y-m-d H:i:s');
        $phone = $request->input('phone');
        $phone2 = $request->input('phone2');
        $address = $request->input('address');
        $provinsi = $request->input('provinsi');
        $kabupaten = $request->input('kabupaten');
        $kecamatan = $request->input('kecamatan');
        $kodepos = $request->input('kodepos');

        $customer = new Customer();

        $customer->cs_id = $csid;
        $customer->name = $name;
        $customer->email = $email;
        $customer->register_date = $register_date;
        $customer->phone = $phone;
        $customer->phone2 = $phone2;
        $customer->address = $address;
        $customer->provinsi = $provinsi;
        $customer->kabupaten = $kabupaten;
        $customer->kecamatan = $kecamatan;
        $customer->kodepos = $kodepos;

        $customer->save();

        return response()->json([
            'status' => 'success',
            'data' => $customer,
        ], 200);
    }

    public function store(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'cs_id' => 'required',
        //     'name' => 'required',
        //     'email' => 'required|unique:customers,email',
        //     'register_date' => 'required|date',
        //     'phone' => 'required',
        //     'phone2' => 'required',
        //     'address' => 'required',
        //     'provinsi' => 'required',
        //     'kabupaten' => 'required',
        //     'kecamatan' => 'required',
        //     'kodepos' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json([
        //         'status' => false,
        //         'modal_close' => false,
        //         'message' => 'Data gagal ditambahkan. ' . $validator->errors()->first(),
        //         'data' => $validator->errors()
        //     ]);
        // }

        // $customer = Customer::create([
        //     'cs_id' => $request->cs_id,
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'register_date' => $request->register_date,
        //     'phone' => $request->phone,
        //     'phone2' => $request->phone,
        //     'address' => $request->address,
        //     'provinsi' => $request->provinsi,
        //     'kabupaten' => $request->kabupaten,
        //     'kecamatan' => $request->kecamatan,
        //     'kodepos' => $request->kodepos,
        // ]);

        // return response()->json([
        //     'status' => 'success',
        //     'data' => $customer,
        // ], 200);
    }

    public function show(string $id)
    {
        // Menampikan semua data customer
        // $customer = Customer::all();
        // return view('admin.data-pelanggan.dataPelanggan', ['title' => 'Data Pelanggan'], compact('customer'));

        //Menampikan salah satu detail data Customer
        $customer = Customer::find($id);
        if (!$customer) {
            abort(404);
        }
        return view('customer-service.data-pelanggan.detailPelanggan', ['title' => 'Detail Pelanggan'], compact('customer'));
    }

    public function edit(string $id)
    {
        // $customer = Customer::find($id);
        // if (!$customer) {
        //     abort(404); // Jika tidak ditemukan, tampilkan halaman error 404
        // }

        // return view('customer-service.data-pelanggan.dataPelanggan', ['title' => 'Edit pelanggan'], compact('customer'));
    }

    public function update(Request $request, string $id)
    {
        $customer = Customer::where('id', $id)->first();

        if ($customer) {
            $csid = $request->input('cs_id');
            $name = $request->input('name');
            $email = $request->input('email');
            $register_date = now()->format('Y-m-d H:i:s');
            $phone = $request->input('phone');
            $phone2 = $request->input('phone2');
            $address = $request->input('address');
            $provinsi = $request->input('provinsi');
            $kabupaten = $request->input('kabupaten');
            $kecamatan = $request->input('kecamatan');
            $kodepos = $request->input('kodepos');

            $customer->cs_id = $csid;
            $customer->name = $name;
            $customer->email = $email;
            $customer->register_date = $register_date;
            $customer->phone = $phone;
            $customer->phone2 = $phone2;
            $customer->address = $address;
            $customer->provinsi = $provinsi;
            $customer->kabupaten = $kabupaten;
            $customer->kecamatan = $kecamatan;
            $customer->kodepos = $kodepos;

            $customer->save();

            return response()->json([
                'status' => 'success',
                'data' => $customer,
            ], 200);
        } else {
            return response()->json([
                'status' => 'Pelanggan tidak ditemukan',
            ], 404);
        }
    }

    public function delete($id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json([
                'status' => false,
                'message' => 'Data not found',
                'data' => null
            ]);
        }

        $deleted = $customer->delete();

        return response()->json([
            'status' => 'success',
            'data' => $customer,
        ], 200);
    }
}
