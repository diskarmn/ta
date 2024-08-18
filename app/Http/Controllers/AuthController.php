<?php

namespace App\Http\Controllers;

// app/Http/Controllers/AuthController.php

use App\Models\cs;
use App\Models\User;
use App\Mail\OtpMail;
use App\Models\Admin;
use App\Models\Employee;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Password;
use Laravel\Sanctum\Actions\CreateNewApiToken;
use Symfony\Component\HttpFoundation\Response;
use App\Events\PasswordReset as EventsPasswordReset;


class AuthController extends Controller
{

    // public function login(Request $request)
    // {
    //     try {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     $user = Employee::where('email', $request->email)->first();

    //     if (Auth::guard('employee')->attempt(['email' => $request->email, 'password' => $request->password])) {
    //         $user = Auth::guard('employee')->user();

    //         $token = Str::random(60);
    //         $user->auth_token = $token;
    //         $user->save();

    //         session(['user_id' => $user->id, 'user_role' => $user->role]);

    //         if ($user->role === 'admin') {
    //             return redirect()->route('dashboard');
    //         } elseif ($user->role === 'superAdmin') {
    //             return redirect()->route('semua-orderan');
    //         } elseif ($user->role === 'cs') {
    //             return redirect()->route('cs.profile');
    //         }
    //     } else {
    //         return redirect()->route('login')->with('error', 'Login gagal. Email atau password tidak valid');
    //     }

    //     return redirect('/');
    // } catch (\Exception $e) {
    //     Log::error($e->getMessage());
    // }
    // }

    //     public function login(Request $request)
    // {
    //     $request->validate([
    //         'email'=>'required',
    //         'password'=>'required',
    //         ]);
    //         $data=[
    //             'email'=>$request->email,
    //             'password'=>$request->password
    //         ];
    //         if(Auth::attempt($data)){
    //             return redirect()->route('coba');
    //         }else{
    //             return redirect()->route('loginPage');
    //         }
    // }


    // public function logout()
    // {
    //     Auth::logout();
    //     return redirect()->route('loginPage')->with('success', 'Logout berhasil!');
    // }







    public function lupaPassword()
    {
        return view('login.lupa-password.lupaPassword', ["title" => "Lupa Password"]);
    }


    public function sendOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $employee = Employee::where('email', $request->email)->first();

        if (!$employee) {
            return response()->json(['error' => 'User not found.'], 404);
        }

        $otp = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
        Session::put('otp_' . $request->email, $otp);
        Session::put('reset_password', $request->email);

        // Simpan OTP, email, dan timestamp di database jika diperlukan
        $employee->otp = $otp;
        $employee->save();

        // Kirim OTP ke email pengguna
        try {
            Mail::to($request->email)->send(new OtpMail($otp));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to send OTP email. Please try again later.'], 500);
        }
        return view('login.lupa-password.verifikasi', ['email' => $request->email, 'otp' => $otp], ["title" => "Verifikasi OTP"]);
    }


    public function verifikasiOTP(Request $request)
    {
        $request->validate([
            'digit1' => 'required|string',
            'digit2' => 'required|string',
            'digit3' => 'required|string',
            'digit4' => 'required|string',
            'email' => 'required|email',
        ]);

        $inputOtp = $request->digit1 . $request->digit2 . $request->digit3 . $request->digit4;
        $otpFromSession = Session::get('otp_' . $request->email);

        if ($otpFromSession !== $inputOtp) {
            return view('login.lupa-password.verifikasi',
            ['email' => $request->email], ["title" => "Verifikasi OTP", 'tampilerror' => 'Kode OTP yang dimasukkan salah. Silahkan kirim ulang OTP!']);        }

        // Hapus OTP dari sesi
        $request->session()->forget('otp_' . $request->email);

        // Arahkan pengguna ke halaman reset password
        return redirect()->route('resetPasswordForm', ['email' => $request->email]);
    }

    public function showResetPasswordForm(Request $request)
    {
        // Dapatkan email pengguna dari parameter request jika tersedia
        $email = $request->query('email');
        // Jika email tidak ada, mungkin karena pengguna mengakses halaman secara langsung tanpa melewati verifikasi OTP
        if (!$email) {
            return redirect()->route('lupaPassword')->with('error', 'Email is required to reset password');
        }
        // Kirimkan email ke view sebagai data
        return view('login.lupa-password.resetPassword', ['email' => $email]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:5',
            'email' => 'required|email',
        ]);
        // Mengambil pengguna berdasarkan email untuk pembaruan database
        $reset = $request->input('email');
        $reset = Session::get('reset_password');
        $user = Employee::where('email', $reset)->first();
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Pengguna tidak ditemukan.'
            ]);
        }
        // Memperbarui password pengguna
        $user->update(['password' =>Hash::make($request->password)]);

        $request->session()->forget('reset_password');
        return redirect()->to('/login')->with('status', 'Kata sandi berhasil direset. Silakan masuk dengan kata sandi baru Anda.');
    }

    public function notice()
    {
        return response()->json([
            'status' => false,
            'message' => 'Anda belum melakukan verifikasi email.'
        ], 400);
    }

    public function logout(Request $request)
    {
        $user = Auth::guard('employee')->user();

        // if ($user) {
        //     if ($user->auth_token) {
        //         $user->auth_token = null;
        //         $user->save();
        //     }
        // }

        Auth::guard('employee')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('loginPage')->with('success', 'Anda telah berhasil keluar dari akun.');
    }

    public function __construct()
    {
        $this->middleware('auth:employee')->except('logout');
    }

}

