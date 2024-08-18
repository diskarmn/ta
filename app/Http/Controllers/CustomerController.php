<?php

namespace App\Http\Controllers;

use App\Models\DataCustomer;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    public function index()
    {
        $search = request('search');

        // Menyimpan nilai pencarian dalam session
        Session::put('cs_search', $search);

        return view('admin.data-cs.data-cs', [
            "title" => "Data Customer",
            "data_cs" => DataCustomer::latest()->filter(['search' => $search])->paginate(9)->withQueryString()
        ]);
    }
}