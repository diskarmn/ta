<?php

namespace App\Http\Controllers\BEController;

use App\Models\Juragan;
use App\Http\Controllers\Controller;
use App\Http\Requests\JuraganRequest;
use App\Models\Notiforder;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class JuraganProcess extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // Admin
    public function index()
    {
        $notifications=Notiforder::all();
        $juragans = Juragan::paginate(10);
        return view(
            'admin.data-juragan.dataJuragan',
            [
                "title" => "Data Juragan",
                "juragans" => $juragans,
                'notifications'=>$notifications
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, String $routing)
    {
        $data = $request->all();
        try {
            $request->validate((new JuraganRequest())->rules());
        } catch (ValidationException $e) {
            $errorValidate = $e->validator->errors()->all();
            return redirect()->route($routing)->with([
                'errorAdd' => true,
                'errorMessage' => $errorValidate,
            ]);
        }

        try {
            Juragan::create([
                "name_juragan" => $data['name_juragan'],
                "alamat" => $data['alamat'],
            ]);
            return redirect()->route($routing)->with('successAdd', 'Data berhasil ditambah');
        } catch (\Exception $e) {
            return redirect()->route($routing)->with([
                'errorAdd' => true,
                'errorMessage' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function juraganupdate(Request $request, $id, String $routing)
    {
        $name_juragan = $request->name_juragan;
        $alamat = $request->alamat;
        $data = Juragan::findOrFail($id);
        try {
            $data->update([
                "name_juragan" => ($name_juragan),
                "alamat" => ($alamat)
            ]);
            return redirect()->route($routing)->with('successEdit', 'Data Berhasil diUbah');
        } catch (\Exception $e) {
            return redirect()->route($routing)->with([
                'errorEdit' => true,
                'errorMessage' => $e->getMessage(),
            ]);
        }
    }

    // Search
    public function juragansearch(Request $request)
    {
        $keyword = $request->input('keyword');
        $result = Juragan::where('name_juragan', 'LIKE', '%' . $keyword . '%')->get();
        return response()->json(['result' => $result]);
    }

    // Get Existing Id
    public function juragangetExistingIds()
    {
        $existingIds = Juragan::pluck('id')->toArray();
        return response()->json($existingIds);
    }

    public function destroy($id){
        $data = Juragan::findOrFail($id);

        if ($data) {
            // Menghapus data jika ditemukan
            $data->delete();
            // Mengembalikan response JSON untuk kasus sukses
            return redirect()->route('semua-orderanCS')->with('success', 'Data successfully deleted.');
        } else {
            // Mengembalikan response JSON untuk kasus data tidak ditemukan
            return response()->json([
                'success' => false,
                'message' => 'Data not found.'
            ], 404); // HTTP status code 404 Not Found
        }
    }
}
