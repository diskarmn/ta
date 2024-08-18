@extends('layouts.password')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/password.css') }}">
@endsection

@section('konten')
    <main class="pt-5">
        <div class="container mt-5">
            <div class="row align-items-center">
                <div class="col-12 col-lg-6 mb-4 mb-lg-0">
                    <img src="{{ asset('assets/img/lupa.png') }}" class="img-fluid mx-auto d-block" alt="Forgot Password Image">
                </div>
                <div class="col-12 col-lg-6">
                    <form id="forgotPasswordForm" method="POST" action="{{ route('sendMailOTP') }}">
                        @csrf
                        <h2 class="text-capitalize mb-3 text-muted text-center text-lg-start">Lupa Password?</h2>
                        <p class="w-100 mb-4 text-muted">Jangan khawatir! Silakan masukkan alamat email yang terkait dengan akun Anda.</p>
                        <div class="mb-4 d-flex">
                            <label class="form-label mt-1 me-1 opacity-50">@</label>
                            <input type="email" name="email" class="form-control border-0 border-bottom border-black/90 bg-transparent p-1 opacity-75" placeholder="Masukkan Email">
                        </div>
                        {{-- <a href="/password/verifikasi" class="btn btn-primary btn-md hover:btn-light mt-lg-4" id="forgotButton">Kirim</a> --}}
                        <button type="submit" class="btn btn-primary btn-md hover:btn-light mt-lg-4" id="forgotButton">Kirim</button>

                        <div class="mb-4 d-lg-none"></div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
