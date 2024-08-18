<?php

namespace App\Http\Controllers\BEController;

use App\Http\Controllers\Controller;
use App\Models\data_jasa_ekspedisi;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


class EkspedisiProcess extends Controller
{

    public function index()
    {
        $data = data_jasa_ekspedisi::get();
        return view('super-admin.data-ekspedisi.data-ekspedisi',[
                "title" => "Data Juragan",
                "data" => $data
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
            ]);
            return redirect()->route($routing)->with('successAdd', 'Data berhasil ditambah');
        } catch (\Exception $e) {
            return redirect()->route($routing)->with([
                'errorAdd' => true,
                'errorMessage' => $e->getMessage(),
            ]);
        }
    }
}
