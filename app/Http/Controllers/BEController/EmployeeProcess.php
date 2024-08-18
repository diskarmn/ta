<?php

namespace App\Http\Controllers\BEController;

use App\Models\Juragan;
use App\Models\Employee;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class EmployeeProcess extends Controller
{

    public function addEmployee(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:employees,email',
            'username' => 'nullable|unique:employees,username',
            'password' => ['required', Password::min(4)->letters()->mixedCase()->numbers()->symbols()->uncompromised()],
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'role' => 'required|in:cs,admin,superAdmin',
            'gender' => 'nullable|in:male,female',
            'phone_number' => 'nullable|min:11',
            'juragans' => 'nullable|array',
            'juragans.*' => 'exists:juragans,name_juragan'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();
        $data['password'] = Hash::make($data['password']);

        // Menangani upload profile image
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::slug($request->name) . '.' . $extension;
            $relativePath = 'assets/profile-image/';
            $file->move(public_path($relativePath), $filename);
            $data['profile_image'] = $relativePath . $filename;
        }

        // Membuat employee baru
        $employee = Employee::create($data);

        // Mengaitkan employee dengan juragan jika ada
        $juraganData = [];
        if (!empty($request->juragans)) {
            foreach ($request->juragans as $juraganName) {
                $juragan = Juragan::where('name_juragan', $juraganName)->first();
                if ($juragan) {
                    $juragan->cs_id = $employee->id;
                    $juragan->save();
                    $juraganData[] = $juragan;
                }
            }
        }

        // Memperbarui path profile image untuk response
        if (isset($employee->profile_image)) {
            $employee->profile_image = asset($employee->profile_image);
        }

        return response()->json([
            'success' => true,
            'data' => $employee,
            'data_juragan' => $juraganData // Mengembalikan array juragan yang dikaitkan
        ]);
    }


    public function updateEmployee(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:employees,email,' . $id,
            'username' => 'nullable|unique:employees,username,' . $id,
            'password' => ['nullable', Password::min(4)->letters()->mixedCase()->numbers()->symbols()->uncompromised()],
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'role' => 'required|in:cs,admin,superAdmin',
            'gender' => 'nullable|in:male,female',
            'phone_number' => 'nullable|min:11',
            'juragans' => 'nullable|array',
            'juragans.*' => 'exists:juragans,name_juragan'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $employee = Employee::findOrFail($id);
        $input = $validator->validated();

        // Update password jika diberikan
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            unset($input['password']); // Jangan update password jika tidak diubah
        }

        // Menangani upload profile image
        if ($request->hasFile('profile_image')) {
            // Hapus gambar profil lama jika ada
            if ($employee->profile_image && File::exists(public_path($employee->profile_image))) {
                File::delete(public_path($employee->profile_image));
            }

            $file = $request->file('profile_image');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::slug($request->name) . '.' . $extension;
            $relativePath = 'assets/profile-image/';
            $file->move(public_path($relativePath), $filename);
            $input['profile_image'] = $relativePath . $filename;
        }

        Juragan::where('cs_id', $employee->id)->update(['cs_id' => null]);
        if (!empty($input['juragans'])) {
            foreach ($input['juragans'] as $juraganName) {
                $juragan = Juragan::where('name_juragan', $juraganName)->first();
                if ($juragan) {
                    $juragan->cs_id = $employee->id;
                    $juragan->save();
                }
            }
        }
        // Update data employee
        $employee->update($input);
        return response()->json([
            'success' => true,
            'data' => $employee
        ]);
    }

    public function changePasswordEmployee(Request $request, $id)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => ['required', 'confirmed', Password::min(4)->letters()->mixedCase()->numbers()->symbols()->uncompromised()],
        ]);

        $data = Employee::findOrFail($id);

        if (!Hash::check($request->current_password, $data->password)) {
            // Jika password saat ini tidak cocok
            return back()->withErrors(['current_password' => 'Password saat ini tidak cocok.']);
        }

        $data->password = Hash::make($request->new_password);
        $data->save();

        return response()->json([
            'id' => $id,
            'data' => $data,
            'success' => true,
            'message' => 'Password berhasil dirubah'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyEmployee($id)
    {
        //menghapus data employee
        $data = Employee::find($id);

        if ($data) {
            $imagePath = public_path($data->profile_image);
            if (File::exists($imagePath)) {
                // Hapus file gambar profil
                File::delete($imagePath);
            }

            $data->delete();
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data gagal untuk dihapus'
            ]);
        }
    }
}
