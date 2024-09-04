<?php

namespace App\Http\Controllers;

use App\Models\Juragan;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\BEController\EmployeeProcess;

class EmployeeController extends Controller
{
    public function indexCs()
    {
        $search = request('search');
        Session::put('employee_search', $search);

        return view('admin.data-cs.data-cs', [
            'title' => 'Data Customer Service',
            'search' => $search,
            'data_cs' => Employee::filter(['search' => $search, 'role' => 'cs'])->paginate(4)->withQueryString()
        ]);
    }
    public function indexAdmin()
    {
        $search = request('search');
        Session::put('employee_search', $search);



        return view('super-admin.data-admin.main', [
            'title' => 'Data Customer Service',

            'search' => $search,
            'data_admin' => Employee::filter(['search' => $search, 'role' => 'admin'])->paginate(10)->withQueryString()
        ]);
    }

    public function dataceo()
    {

        $data_ceo = Employee::where('role', 'ceo')->get();
        $title = 'Data CEO';

        return view('super-admin.data-CS.dataceo', compact('data_ceo', 'title'));
    }
    public function coba()
    {

        $ceos = Employee::where('role', 'ceo')->get();
        $title = 'Data CEO';

        return view('super-admin.data-ceo.coba', compact('data_ceo', 'title'));
    }

    public function indexSuperAdmin()
    {
        $search = request('search');
        Session::put('employee_search', $search);

        return view('super-admin.data-CS.data-cs', [
            'title' => 'Data Customer Service',
            'search' => $search,
            'data_cs' => Employee::filter(['search' => $search, 'role' => 'cs'])->paginate(10)->withQueryString()
        ]);
    }
    public function editcs2(Request $request, $id){
        // dd($request->all());
        // $request->validate([
        //     'name' => 'required|string|max:50',
        //     'phone_number' => 'required|string|min:11|max:13',
        //     'email' => 'required|email|max:50',
        //     'juragan_id' => 'required|exists:juragans,id',
        // ]);

        // $customerService = Employee::findOrFail($id);

        // $customerService->name = $request->input('name');
        // $customerService->phone_number = $request->input('phone_number');
        // $customerService->email = $request->input('email');
        // $customerService->juragan_id = $request->input('juragan_id');
        // $customerService->save();
        $customerService = Employee::findOrFail($id);

        $customerService->name = $request->input('name');
        $customerService->phone_number = $request->input('phone_number');
        $customerService->email = $request->input('email');
        $customerService->juragan_id = $request->input('juragan_id');
        $customerService->save();
        return redirect()->back()->with('success', 'Data berhasil diperbarui');

    }



    public function addCsAdmin()
    {


        return view('admin.data-cs.add', ["title" => "tambah data"]);
    }


    public function addCsSuperAdmin()
    {
        $juragan = Juragan::pluck('name_juragan');

        return view('super-admin.data-CS.tambah-cs', ["title" => "tambah data", 'juragan' => $juragan]);
    }
    public function viewaddjuragan()
    {

        return view('super-admin.data-juragan.addjuragan',["title" => "tambah toko"]);
    }

    public function addceo(){
        $title = 'add CEO';

        return view('super-admin.data-CS.addceo', compact('title'));
    }



    public function createCssa(Request $request)
    {
        $employee = new Employee();
        $employee->name = $request->input('name');
        $employee->phone_number = $request->input('phone_number');
        $employee->email = $request->input('email');
        $employee->password = bcrypt($request->input('password'));
        $employee->juragan_id = $request->input('juragan_id');
        $employee->gender = $request->input('gender', '');
        $employee->role = 'cs';

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');

            $fileName = time() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('bukti_pembayaran'), $fileName);

            $employee->profile_image = $fileName;
        } else {
            $employee->profile_image = null;
        }

        $employee->save();
        return redirect()->route('datacs')->with('success', 'Data successfully added.');

    }

    public function regiscs(Request $request)
    {
        $employee = new Employee();
        $employee->name = $request->input('name');
        $employee->phone_number = $request->input('phone_number');
        $employee->email = $request->input('email');
        $employee->password = bcrypt($request->input('password'));
        $employee->juragan_id = $request->input('juragan_id');
        $employee->gender = $request->input('gender', '');
        $employee->role = 'cs';

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');

            $fileName = time() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('bukti_pembayaran'), $fileName);

            $employee->profile_image = $fileName;
        } else {
            $employee->profile_image = null;
        }

        $employee->save();
        return redirect()->back()->with('success', 'Data successfully added.');

    }


    public function tambahceo(Request $request){
        $employee = new Employee();
        $employee->name = $request->input('name');
        $employee->phone_number = $request->input('phone_number');
        $employee->email = $request->input('email');
        $employee->password = bcrypt($request->input('password'));
        $employee->gender = $request->input('gender', '');
        $employee->role = 'ceo';

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');

            $fileName = time() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('bukti_pembayaran'), $fileName);

            $employee->profile_image = $fileName;
        } else {
            $employee->profile_image = null;
        }

        $employee->save();
        return redirect()->route('dataceo')->with('success', 'Data successfully add.');
    }

    public function createCsSuperAdmin(Request $request)
    {
        $request->merge(['role' => 'cs']);
        $employeeProcess = new EmployeeProcess;
        $employeeProcess->addEmployee($request);

        return redirect()->route('dataCsSuperAdmin')->with('success', 'Data successfully add.');
    }

    public function createAdmin(Request $request)
    {
        $employeeProcess = new EmployeeProcess;
        $employeeProcess->addEmployee($request);

        return redirect()->route('dataAdmin')->with('success', 'Data successfully add.');
    }

    public function edit($id)
    {
        $data = Employee::with('juragans')->findOrFail($id);
        $juragan = $data->juragans->pluck('name_juragan');

        // Mendapatkan Juragan yang belum memiliki CS
        $juraganNoCs = Juragan::whereNull('cs_id')->get();


        return view('admin.data-cs.edit', [
            'title' => 'Edit Data',
            'data' => $data,
            'juragan' => $juragan,
            'juraganNoCs' => $juraganNoCs
        ]);
    }

    public function editCsSuperAdmin($id)
    {
        // $data = Employee::with('juragans')->findOrFail($id);
        $juragan = Juragan::all();

        $data = Employee::findOrFail($id);

        // Mendapatkan Juragan yang belum memiliki CS
        // $juraganNoCs = Juragan::whereNull('cs_id')->get();

        return view('super-admin.data-CS.edit-cs', [
            'title' => 'Edit Data',
            'data' => $data,
            'juragan' => $juragan,
            // 'juraganNoCs' => $juraganNoCs
        ]);
    }

    public function editCs(Request $request, $id)
    {
        //
        $employeeProcess = new EmployeeProcess;
        $employeeProcess->updateEmployee($request, $id);

        return redirect()->route('dataCs')->with('success', 'Data Berhasil di update');
    }
    public function editCsSA(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|string|max:50',
            'phone_number' => 'required|string|min:11|max:13',
            'email' => 'required|email|max:50',
            'juragan_id' => 'required|exists:juragans,id',
        ]);
        dd($request->all());
        $customerService = Employee::findOrFail($id);

        $customerService->name = $request->input('name');
        $customerService->phone_number = $request->input('phone_number');
        $customerService->email = $request->input('email');
        $customerService->juragan_id = $request->input('juragan_id');
        $customerService->save();

        return redirect()->route('dataCsSuperAdmin')->with('success', 'Data Berhasil di update');
    }




    public function showEditAdmin($id)
    {
        $data = Employee::findOrFail($id);

        return view('super-admin.data-admin.editAdmin', [
            'data' => $data,
            'title' => 'Edit Data Admin'
        ]);
    }

    public function editAdmin(Request $request, $id)
    {
        $employeeProcess = new EmployeeProcess;
        $employeeProcess->updateEmployee($request, $id);

        return redirect()->route('dataAdmin')->with('success', 'Data Berhasil di update');
    }

    public function changePassword(Request $request, $id)
    {
        $employeeProcess = new EmployeeProcess;
        $employeeProcess->changePasswordEmployee($request, $id);

        return back()->with('success', 'Berhasil mengubah password');
    }

    public function destroy($id)
    {
        $employeeProcess = new EmployeeProcess;
        $employeeProcess->destroyEmployee($id);

        return back()->with('success', 'Berhasil menghapus data');
    }


    public function editPasswordCsAdmin($id)
    {
        $data = Employee::findOrFail($id);

        return view('admin.data-cs.edit-password-cs', [
            'id' => $id,
            'data' => $data,
            'title' => "Edit Password Customer Service"
        ]);
    }
    public function editPasswordCsSuperAdmin($id)
    {
        $data = Employee::findOrFail($id);

        return view('super-admin.data-CS.edit-password-cs', [
            'id' => $id,
            'data' => $data,
            'title' => "Edit Password Customer Service"
        ]);
    }

    public function editPasswordAdmin($id)
    {
        $data = Employee::findOrFail($id);

        return view('super-admin.data-admin.edit-password-admin', [
            "title" => "Edit Password Admin",
            'id' => $id,
            'data' => $data
        ]);
    }
}
