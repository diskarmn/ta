<?php

namespace App\Http\Controllers\BEController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class OtentikasiController extends Controller
{
    public function registerCustomer(Request $request)
    {
        $nama = $request->input('name');
        $email = $request->input('email');
        $username = $request->input('username');
        $email_verified = date('Y-m-d');
        $password = bcrypt($request->input('password'));
        $profile_image = $request->file('profile_image');
        $gender = $request->input('gender');
        $phone_number = $request->input('phone_number');
        $role = $request->input('role');

        $pengguna = new Employee();
        $pengguna->name = $nama;
        $pengguna->email = $email;
        $pengguna->username = $username;
        $pengguna->password = $password;
        $pengguna->profile_image = $profile_image;
        $pengguna->gender = $gender;
        $pengguna->phone_number = $phone_number;
        $pengguna->role = $role;
        $pengguna->email_verifed_at = $email_verified;

        $pengguna->save();

        return response()->json([
            'success' => true,
            'data' => $pengguna
        ], 200);
    }
}
