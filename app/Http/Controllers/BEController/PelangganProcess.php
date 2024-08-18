<?php

namespace App\Http\Controllers\BEController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;

class PelangganProcess extends Controller
{

    public function addPelanggan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'register_date' => 'required',
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

        $data = $validator->validated();
        
        $customer = Customer::create($data);

        return response()->json([
            'status' => 'success',
            'data' => $customer
        ]);
    }

    public function updatePelanggan(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'nullable',
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

        $customer = Customer::findOrFail($id);
        $input = $validator->validated();

        $customer->update($input);

        return response()->json([
            'status' => 'success',
            'data' => $customer
        ], 200);
    }

    public function deletePelanggan($id)
    {
        $customer = Customer::findOrFail($id);

        if (!$customer) {
            return response()->json([
                'status' => false,
                'message' => 'Data not found',
                'data' => null,
            ]);
        }

        $customer->delete();

        return response()->json([
            'success' => true,
            'massage' => 'Data berhasil di hapus',
        ], 200);
    }
}
