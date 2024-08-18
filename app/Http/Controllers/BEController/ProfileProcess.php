<?php

namespace App\Http\Controllers\BEController;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfileProcess extends Controller
{
    // Update profile CS
    public function updateProfile(Request $request, $username, $routing)
    {
        // Validasi manual menggunakan file Request untuk mendapatkan pesan kesalahan validasi
        try {
            $request->validate((new ProfileRequest())->rules($username));
        } catch (ValidationException $e) {
            // Ambil pesan kesalahan validasi
            $errorValidate = $e->validator->errors()->all();
            return redirect()->route($routing . '.edit')->with([
                "errorValidate" => true,
                "errorMessage" => $errorValidate,
            ]);
        }

        $data = $request->all();
        $profile = Employee::where('username', $username)->first();

        try {
            $profile->update($data);
            return redirect()->route($routing)->with("successUpdate", true);
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return redirect()->route($routing)->with([
                "errorUpdate" => true,
                "errorMessage" => $errorMessage
            ]);
        }
    }

    public function updatePassword(Request $request, $username, $routing)
    {
        try {
            $request->validate((new PasswordRequest())->rules());
        } catch (ValidationException $e) {
            $errorValidate = $e->validator->errors()->all();
            return redirect()->route($routing . '.editPassword')->with([
                "errorValidate" => true,
                "errorMessage" => $errorValidate,
            ]);
        }

        $profile = Employee::where('username', $username)->first();
        if (!Hash::check($request->current_password, $profile->password)) {
            return redirect()->route($routing . '.editPassword')->with([
                "errorValidate" => true,
                "errorMessage" => ["Password lama anda salah"],
            ]);
        }

        try {
            $profile->fill([
                'password' => $request->password, // Hash::make($request->password),
            ])->save();
            return redirect()->route($routing)->with("successUpdate", true);
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return redirect()->route($routing)->with([
                "errorUpdate" => true,
                "errorMessage" => $errorMessage
            ]);
        }
    }
}
