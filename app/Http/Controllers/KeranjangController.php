<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Barang;
use App\Models\Customer;
use App\Models\ViewTulisOrder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    //
    public function viewtulisorder(Request $request)
    {
        $user = Auth::guard('employee')->user();
        $request->validate([
            'kd' => 'required',
            'nama_barang'=>'required',
            'harga' => 'required',
            'ukuran' => 'required',
        ]);
        // dd($request->all());
        ViewTulisOrder::create([
            'kd' => $request->kd,
            'harga' => $request->harga,
            'ukuran' => $request->ukuran,
            'qty' => $request->qty,
            'barang'=>$request->nama_barang,
            // 'subtotal' => $request->harga * $request->qty,
            'employee_id'=> $user->id,
        ]);
        Barang::where('id', $request->kd)
            ->decrement('stock', $request->qty);
        return redirect()->back()->with('success', 'Data berhasil ditambahkan ke keranjang.');
    }
    public function edittulisorder(Request $request, $id)
    {
        $user = Auth::guard('employee')->user();
        $request->validate([
            'kd_edit' => 'nullable',
            'nama_barang_edit'=>'nullable',
            'harga_edit' => 'nullable',
            'ukuran_edit' => 'nullable',
            'qty_edit' => 'nullable',
            'qty_sebelumnya'=>'nullable'
        ]);
        // dd($request->all());
        $viewtulisorder = ViewTulisOrder::findOrFail($id);
            $viewtulisorder->kd = $request->kd_edit;
            $viewtulisorder->barang = $request->nama_barang_edit;

        if ($viewtulisorder) {
            $viewtulisorder->harga = $request->harga_edit;
            $viewtulisorder->ukuran = $request->ukuran_edit;
            $viewtulisorder->qty = $request->qty_edit;
            $viewtulisorder->employee_id= $user->id;
            $viewtulisorder->save();

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




    public function bataltulis(Request $request)
    {
        $kodeProduks = $request->input('kdk');
        $qtyProduks = $request->input('qtyk');

        foreach ($kodeProduks as $index => $kodeProduk) {
            $qty = $qtyProduks[$index];

            DB::table('barangs')
                ->where('kd_produk', $kodeProduk)
                ->increment('stock', $qty);

            DB::table('keranjangs')->where('kd', $kodeProduk)->delete();
        }

        return redirect()->back()->with('success', 'Orderan berhasil dibatalkan dan stok diperbarui.');
    }

    public function hapusorder($id)
    {
        $viewtulisorder = ViewTulisOrder::findOrFail($id);
        if ($viewtulisorder) {
            $viewtulisorder->delete();
            return back()->with('success', 'Data berhasil dihapus dari keranjang.');
        } else {
            return response([
                'pesan' => 'Data gagal dihapus',
            ]);
        }
    }
    //
    public function addcs(Request $request)
    {
        $request->validate([
            'add_nama_pelanggan' => 'required',
            'add_email_pelanggan' => 'required|email',
            'add_phone_pelanggan' => 'required',
            'add_phone2_pelanggan' => 'nullable',
            'add_alamat_pelanggan' => 'required',
            'add_provinsi_pelanggan' => 'required',
            'add_kabupaten_pelanggan' => 'required',
            'add_kecamatan_pelanggan' => 'required',
            'add_kodepos_pelanggan' => 'required',
        ]);

        Customer::create([
            'name' => $request->add_nama_pelanggan,
            'email' => $request->add_email_pelanggan,
            'phone' => $request->add_phone_pelanggan,
            'phone2' => $request->add_phone2_pelanggan,
            'address' => $request->add_alamat_pelanggan,
            'provinsi' => $request->add_provinsi_pelanggan,
            'kabupaten' => $request->add_kabupaten_pelanggan,
            'kecamatan' => $request->add_kecamatan_pelanggan,
            'kodepos' => $request->add_kodepos_pelanggan,
        ]);
        return redirect()->back()->with('success', 'Data berhasil ditambahkan ke keranjang.');
    }


    //
    public function ongkir(Request $request)
    {
        $user = Auth::guard('employee')->user();
        $request->validate([
            'ongkir' => 'nullable',
            "jasa_ongkir" => 'nullable'
        ]);
        ViewTulisOrder::create([
            'ongkir' => $request->ongkir,
            'jasa_ongkir' => $request->jasa_ongkir,
            'employee_id'=> $user->id
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan ke keranjang.');
    }
    public function editongkir(Request $request, $id)
    {
        $request->validate([
            'ongkir_edit' => 'required',
            'jasa_ongkir_edit' => 'required',
        ]);
        // dd($request->all());
        $viewtulisorder = ViewTulisOrder::findOrFail($id);

        if ($viewtulisorder) {
            $user = Auth::guard('employee')->user();
            $viewtulisorder->ongkir = $request->ongkir_edit;
            $viewtulisorder->jasa_ongkir = $request->jasa_ongkir_edit;
            $viewtulisorder->employee_id= $user->id;
            $viewtulisorder->save();
            return redirect()->back()->with('success', 'Data berhasil diubah pada keranjang.');
        } else {
            return response([
                'pesan' => 'data gagal diubah',
            ]);
        }
    }
    public function hapusongkir($id)
    {
        $viewtulisorder = ViewTulisOrder::where('id', $id)->firstOrFail();
        if ($viewtulisorder) {
            $viewtulisorder->delete();
            return redirect()->back()->with('success', 'Data berhasil dihapus dari keranjang.');
        } else {
            return response([
                'pesan' => 'Data gagal dihapus',
            ]);
        }
    }
    //

    //

    public function lain(Request $request)
    {
        $user = Auth::guard('employee')->user();
        $request->validate([
            'biaya_lain' => 'required',
            "jasa_biaya_lain" => 'required'
        ]);
        ViewTulisOrder::create([
            'biaya_lain' => $request->biaya_lain,
            'jasa_biaya_lain' => $request->jasa_biaya_lain,
            'employee_id'=> $user->id
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan ke keranjang.');
    }
    public function editlain(Request $request, $id)
    {
        $user = Auth::guard('employee')->user();
        $request->validate([
            'biaya_lain_edit' => 'required',
            'jasa_biaya_lain_edit' => 'required',
        ]);

        $viewtulisorder = ViewTulisOrder::findOrFail($id);
        if ($viewtulisorder) {
            $viewtulisorder->biaya_lain = $request->biaya_lain_edit;
            $viewtulisorder->jasa_biaya_lain = $request->jasa_biaya_lain_edit;
            $viewtulisorder->employee_id= $user->id;
            $viewtulisorder->save();
            return redirect()->back()->with('success', 'Data berhasil diubah pada keranjang.');
        } else {
            return response([
                'pesan' => 'Data gagal diubah',
            ]);
        }
    }
    public function hapuslain($id)
    {
        $viewtulisorder = ViewTulisOrder::findOrFail($id);
        if ($viewtulisorder) {
            $viewtulisorder->delete();
            return redirect()->back()->with('success', 'Data berhasil dihapus dari keranjang.');
        } else {
            return response([
                'pesan' => 'Data gagal dihapus',
            ]);
        }
    }





}
