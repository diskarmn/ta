<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Notiforder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\BEController\DataBarangProcess;

class BarangController extends Controller
{
    public function indexCs()
    {
        $search = request('search');

    //             // Ambil semua notifikasi, atau Anda bisa menyesuaikan query sesuai kebutuhan
    // $notifications = Notiforder::all();


        // Menyimpan nilai pencarian dalam session
        Session::put('barang_search', $search);

        return view('customer-service.data-barang.dataBarang', [
            "title" => "Data Barang",
            // "notifications" => $notifications,
            "data_barang" => Barang::latest()->filter(['search' => $search])->paginate(5)->withQueryString()
        ]);
    }

    public function indexAdmin()
    {
        $search = request('search');
        $gambar = Auth::guard('employee')->user()->profile_image;
        Session::put('barang_search', $search);

        return view('admin.data-barang.dataBarang', [
            "title" => "Data Barang",
            "data_barang" => Barang::latest()->filter(['search' => $search])->paginate(5)->withQueryString(),
            "gambar" => $gambar 
        ]);
    }

    public function indexSuperadmin()
    {
        $search = request('search');

        // Menyimpan nilai pencarian dalam session
        Session::put('barang_search', $search);

        return view('super-admin.data-barang.dataBarang', [
            "title" => "Data Barang",
            "data_barang" => Barang::latest()->filter(['search' => $search])->paginate(5)->withQueryString()
        ]);
    }

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            // Mengambil nilai pencarian dari session dan melewatkan ke view
            view()->share('search', Session::get('barang_search'));

            return $next($request);
        });
    }

    public function store(Request $request){
        $createDataBarang = new DataBarangProcess;
        $hasil = $createDataBarang->addBarang($request);

        if($hasil){
            return redirect('cs/dataBarang');
        }else{
            return redirect('cs/dataBarang');
        }
    }

    public function update(Request $request, $id){
        $updateBarang = new DataBarangProcess;
        $hasil = $updateBarang->updateBarang($request, $id);
        // dd($hasil);
        if($hasil){
            return back()->with('success', 'Data barang berhasil diupdate');
        } else {
            return back()->with('error', 'Gagal mengupdate data barang');
        }
    }

    public function destroy($id){
        $deleteBarang = new DataBarangProcess;
        $hasil = $deleteBarang->deleteBarang($id);

        if($hasil){
            return back()->with('success', 'Berhasil hapus data barang ');
        } else {
            return back()->with('error', 'Gagal hapus data barang');
        }
    }
    //admin
    // $createDataBarang = new DataBarangProcess;
    // $hasil = $createDataBarang->addBarang($request);

    // if($hasil){
    //     return redirect('admin/dataBarang');
    // }else{
    //     return redirect('admin/dataBarang');
    // }
    public function addbarang(Request $request){
        $validatedData = $request->validate([
            'kd_produk' => 'required|string|max:10',
            'nama' => 'required|string|max:25',
            'size' => 'required|string|max:5',
            'harga_satuan' => 'required|numeric',
            'stock' => 'required|integer',
            'img' => 'nullable|string|max:255',
            'video' => 'nullable|string|max:255',
        ]);

        $barang = new Barang();
        $barang->kd_produk = $validatedData['kd_produk'];
        $barang->nama = $validatedData['nama'];
        $barang->size = $validatedData['size'];
        $barang->harga_satuan = $validatedData['harga_satuan'];
        $barang->stock = $validatedData['stock'];
        $barang->img = $validatedData['img'] ?? null;
        $barang->video = $validatedData['video'] ?? null;

        $barang->save();

        return redirect()->back()->with('success', 'Barang berhasil ditambahkan!');
    }
    public function updatebarang(Request $request, $id){

            $validatedData = $request->validate([
                'kd_produk' => 'required|string|max:10',
                'nama' => 'required|string|max:25',
                'size' => 'required|string|max:5',
                'harga_satuan' => 'required|numeric',
                'stock' => 'required|integer',
                'img' => 'nullable|string|max:255',
                'video' => 'nullable|string|max:255',
            ]);

            // dd($request->all());
            $barang = Barang::findOrFail($id);

            $barang->kd_produk = $validatedData['kd_produk'];
            $barang->nama = $validatedData['nama'];
            $barang->size = $validatedData['size'];
            $barang->harga_satuan = $validatedData['harga_satuan'];
            $barang->stock = $validatedData['stock'];
            $barang->img = $validatedData['img'] ?? $barang->img;
            $barang->video = $validatedData['video'] ?? $barang->video;

            $barang->save();

            return redirect()->back()->with('success', 'Barang berhasil diperbarui!');

    }
    public function stock(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'stock' => 'required|integer|min:1',
        ]);

        // Temukan data barang berdasarkan ID
        $barang = Barang::findOrFail($id);

        // Tambahkan nilai input stock ke stock yang ada
        $barang->increment('stock', $request->input('stock'));

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Stock berhasil ditambahkan.');
    }
    public function destroyA($id){
        $deleteBarang = new DataBarangProcess;
        $hasil = $deleteBarang->deleteBarang($id);

        if($hasil){
            return back()->with('success', 'Berhasil hapus data barang ');
        } else {
            return back()->with('error', 'Gagal hapus data barang');
        }
    }
    //super admmin
    public function createSA(Request $request){
        $createDataBarang = new DataBarangProcess;
        $hasil = $createDataBarang->addBarang($request);

        if($hasil){
            return redirect('super-admin/dataBarang');
        }else{
            return redirect('super-admin/dataBarang');
        }
    }
    public function updateSA(Request $request, $id){
        $updateBarang = new DataBarangProcess;
        $hasil = $updateBarang->updateBarang($request, $id);
        // dd($hasil);
        if($hasil){
            return back()->with('success', 'Data barang berhasil diupdate');
        } else {
            return back()->with('error', 'Gagal mengupdate data barang');
        }
    }
    public function destroySA($id){
        $deleteBarang = new DataBarangProcess;
        $hasil = $deleteBarang->deleteBarang($id);

        if($hasil){
            return back()->with('success', 'Berhasil hapus data barang ');
        } else {
            return back()->with('error', 'Gagal hapus data barang');
        }
    }


}
