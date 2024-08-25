<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BEController\JuraganProcess;
use App\Models\Juragan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JuraganController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // Admin
    public function indexAdmin()
    {
        $juragans = Juragan::paginate(5);
        return view(
            'admin.data-juragan.dataJuragan',
            [
                "title" => "Data Juragan",
                "juragans" => $juragans
            ]
        );
    }


    /**
     * Store a newly created resource in storage.
     */
    public function storeAdmin(Request $request)
    {
        $createJuragan = new JuraganProcess;
        $routing = 'juragan';
        return $createJuragan->store($request, $routing);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateAdmin(Request $request, $id)
    {
        $updateJuragan = new JuraganProcess;
        $routing = 'juragan';
        // Panggil metode update yang sesuai di dalam JuraganProcess
        return $updateJuragan->juraganupdate($request, $id, $routing);
    }


    // Search Admin
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $result = Juragan::where('name_juragan', 'LIKE', '%' . $keyword . '%')->get();
        return response()->json(['result' => $result]);
    }

    public function getExistingIds()
    {
        $existingIds = Juragan::pluck('id')->toArray();
        return response()->json($existingIds);
    }

    // Super Admin
    public function indexSuperAdmin()
    {
        $juragans = Juragan::paginate(5);
        return view(
            'super-admin.data-juragan.dataJuragan',
            [
                "title" => "Data Juragan",
                "juragans" => $juragans
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function addjuragan(Request $request)
    {

        $juragan = new Juragan;

        $juragan->name_juragan = $request->input('name_juragan');
        $juragan->alamat = $request->input('alamat');

        $juragan->save();

     return redirect()->route('dataJuragan')->with('success', 'Data juragan berhasil ditambahkan.');
    }
    /**
     * Update the specified resource in storage.
     */
    public function updateSuperAdmin(Request $request, $id)
    {
        // $updateJuragan = new JuraganProcess;
        // $routing = 'dataJuraganSuperAdmin';
        // return $updateJuragan->juraganupdate($request, $id, $routing);
        $validatedData = $request->validate([
            'name_juragan' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
        ]);

        // Temukan juragan berdasarkan ID
        $juragan = Juragan::findOrFail($id);

        // Update data juragan
        $juragan->name_juragan = $validatedData['name_juragan'];
        $juragan->alamat = $validatedData['alamat'];

        // Simpan perubahan ke database
        $juragan->save();

        // Redirect kembali dengan pesan sukses
        return back()->with('success', 'Data juragan berhasil diperbarui.');
    }


    public function deleteJuragan($id)
    {
        $deleteJuragan = new JuraganProcess;
        $deleteJuragan->destroy($id);

        return back()->with('success', 'Berhasil hapus data');
    }

    public function deleteJuraganAdmin($id)
    {
        $deleteJuragan = new JuraganProcess;
        $deleteJuragan->destroy($id);

        return back()->with('success', 'Berhasil hapus data');
    }
}
