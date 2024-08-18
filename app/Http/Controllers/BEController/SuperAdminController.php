<?php

namespace App\Http\Controllers\BEController;

use App\Models\Barang;
use Illuminate\Http\Request;
use App\Models\data_jasa_ekspedisi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class SuperAdminController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil nilai pencarian dari sesi
        $search = Session::get('ekspedisi_search');

        // Jika nilai pencarian tidak ada dalam sesi, maka gunakan nilai pencarian dari request
        if (!$search) {
            $search = $request->search;
        }
        // Panggil metode scopeFilter untuk melakukan filtering data
        // $data_jasa_ekspedisis = data_jasa_ekspedisi::latest()->filter(['search' => $search])->paginate(10)->withQueryString();
        $data_jasa_ekspedisis = data_jasa_ekspedisi::latest()->when($request->search != null , function ($query) use ($search) {
            $query->where('nama_jasa_ekspedisi', 'LIKE', '%' . $search . '%');
        })->paginate(10)->withQueryString();
        return view('super-admin.data-ekspedisi.data-ekspedisi', [
            "title" => "Data Ekspedisi",
            "data" => $data_jasa_ekspedisis
        ]);
    }
    
    public function APIsearch ($search)
    {
        $barang = Barang::where("nama", "like", "%".$search."%")->get();
        return response()->json($barang);
    }

    public function show_data_jasa_ekspedisi(Request $request)
    {
        $title = 'Jasa Ekspedisi';
        $data = data_jasa_ekspedisi::all();
        if ($request->is('api/*') || $request->wantsJson())
        {
            return response()->json($data);
        } else {
            return view("super-admin.data-ekspedisi.data-ekspedisi", compact('data', 'title'));
        }
        // data_jasa_ekspedisi::where("id", "like", "%".$search."%")->get();
        // return view("super-admin.data-ekspedisi.data-ekspedisi")->with(['superadmin' => data_jasa_ekspedisi::all()]);
    }

    public function tambah_data_jasa_ekspedisi (Request $request) {
        $data = data_jasa_ekspedisi::create($request->all());
        if ($request->is('api/*') || $request->wantsJson())
        {
            return response()->json($data);
        } else {
            return redirect()->route('dataJasaEkspedisi');
        };
    }

    public function update_data_jasa_ekspedisi (Request $request, $id)
    {
        $data = data_jasa_ekspedisi::findOrFail($id);
        $data->update($request->all());
        if ($request->is('api/*') || $request->wantsJson())
        {
            return response()->json($data);
        } else {
            return redirect()->route('dataJasaEkspedisi');
        }
    }

    public function delete_data_jasa_ekspedisi (Request $request, $id)
    {
        $data = data_jasa_ekspedisi::findOrFail($id);
        $data->delete();
        if ($request->is('api/*') || $request->wantsJson())
        {
            return response()->json($data);
        } else {
            return redirect()->route('dataJasaEkspedisi');
        }
    }



}
