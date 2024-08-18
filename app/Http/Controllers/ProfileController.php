<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileRequest;
use Illuminate\Validation\Rules\Password;
use App\Http\Controllers\BEController\emp;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\BEController\EmployeeProcess;

class ProfileController extends Controller
{
    protected function getViewBasedOnRole($role)
    {
        switch ($role) {
            case 'superAdmin':
                return 'super-admin.profile.my-profile';
            case 'admin':
                return 'admin.profile.my-profile';
            case 'cs':
                return 'customer-service.profile.my-profile';
            default:
                // Default view if role is not recognized
                return 'errors.unknown-role';
        }
    }
    protected function getViewEditBasedOnRole($role)
    {
        switch ($role) {
            case 'superAdmin':
                return 'super-admin.profile.edit-profile';
            case 'admin':
                return 'admin.profile.edit-profile';
            case 'cs':
                return 'customer-service.profile.edit-profile';
            default:
                // Default view if role is not recognized
                return 'errors.unknown-role';
        }

    }
    protected function getViewPasswordBasedOnRole($role)
    {
        switch ($role) {
            case 'superAdmin':
                return 'super-admin.profile.edit-password';
            case 'admin':
                return 'admin.profile.edit-password';
            case 'cs':
                return 'customer-service.profile.edit-password';
            default:
                // Default view if role is not recognized
                return 'errors.unknown-role';
        }
    }

    protected function getRouteViewBasedOnRole($role)
    {
        switch ($role) {
            case 'superAdmin':
                return 'indexProfile';
            case 'admin':
                return 'admin.profile';
            case 'cs':
                return 'cs.profile';
            default:
                // Default view if role is not recognized
                return 'errors.unknown-role';
        }
    }
    

    public function profile()
    {
        $profile = auth()->user();
        $role = $profile->role; 

        $view = $this->getViewBasedOnRole($role);
        return view($view, [
            "title" => "My Profile",
            "profile" => $profile
        ]);
    }

    // Edit profile CS
    public function edit()
    {
        $profile = auth()->user();
        $role = $profile->role; 
        $view = $this->getViewEditBasedOnRole($role);
        return view($view, [
            "title" => "Edit Profile",
            "profile" => $profile
        ]);
    }

    public function passwordView()
    {
        $profile = auth()->user();
        $role = $profile->role; 
        $view = $this->getViewPasswordBasedOnRole($role);
        return view($view, [
            "title" => "Change Password",
            "profile" => $profile
        ]);
    }

    public function updateData(Request $request){
        $profile = auth()->user();
        $role = $profile->role; 
        $view = $this->getRouteViewBasedOnRole($role);
        $user = Auth::guard('employee')->user();
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required',
            'email' => 'required|string|email|max:255|unique:employees,email,' . $user->id,
        ]);
    
        // Proses update data user dengan cara yang benar
        $user->update($request->all());
    
        return redirect()->route($view)->with('success', 'berhasil merubah data');
    }

    public function updatePassword(Request $request)
    {
        $profile = auth()->user();
        $role = $profile->role; 
        $view = $this->getRouteViewBasedOnRole($role);
        $user = Auth::guard('employee')->user();
        $request->validate([
            'current_password' => 'required',
            'new_password' => ['required', 'confirmed', Password::min(4)->letters()->mixedCase()->numbers()->symbols()->uncompromised()],
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            // Jika password saat ini tidak cocok
            return back()->withErrors(['current_password' => 'Password saat ini tidak cocok.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route($view)->with('success', 'sukses mengganti password');
    }
}
