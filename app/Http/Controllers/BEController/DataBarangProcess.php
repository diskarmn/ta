<?php

namespace App\Http\Controllers\BEController;

use App\Models\Barang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class DataBarangProcess extends Controller
{

    public function addBarang(Request $request)
    {
        // Validasi input form
        $this->validate($request, [
            'kd_produk' => 'required',
            'nama' => 'required',
            'size' => 'required|in:S,M,L,XL,XXL,XXXL',
            'harga_satuan' => 'required',
            'stock' => 'required',
            'img' => 'required',
            'video' => 'required',
            'point' => 'required',
        ]);

        $data = "";
        try {
            $data = $request->all();
            Barang::create($data);
            Session::forget('barang_search');
        } catch (\Exception $e) {
            Log::error('Error menambahkan barang: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan barang'
            ], 500);
        }

        return $data;
    }


    public function updateBarang(Request $request, $id)
    {
        // Validasi input form
        $validatedData = $request->validate([
            'nama' => 'required',
            'size' => 'required|in:S,M,L,XL,XXL,XXXL',
            'harga_satuan' => 'required',
            'stock' => 'required',
            'img' => 'nullable',
            'video' => 'nullable',
            'point' => 'required',
        ]);
        $data = "";
        $data = Barang::findOrFail($id);
        try {
            $data->update($validatedData);
        } catch (\Exception $e) {
            \Log::error('Error menambahkan barang: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Barang gagal dirubah!!'
            ], 500);
        }
        return $data;
    }

    public function deleteBarang($id)
    {
        $data = Barang::findOrFail($id);
        if ($data) {
            $data->delete();
            return back()->with('success', 'Berhasil hapus data barang');
        } else {
            return back()->with('error', 'Data barang tidak ditemukan');
        }
    }
}
