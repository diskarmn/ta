@extends('layouts.password')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/password.css') }}">
@endsection

@section('konten')
    <main class="p-5 p-md-0">
        <div class="container mt-5 ">
            <div class="row content-center align-items-start align-items-md-center ">
                <div class="col-12 col-md-6">
                    <img src="{{ asset('assets/img/verif.png') }}" class="img-fluid mx-auto d-block">
                </div>
                <div class="col-12 col-md-6">
                    <div class="card-body">
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if(isset($tampilerror))
                            <div class="alert alert-danger">
                                {{ $tampilerror }}
                            </div>
                        @endif
                    <form class="text-center" method="POST" action="{{ route('verOTP') }}">
                        @csrf
                        <h2 class="text-capitalize mb-3 text-muted">Kode Verifikasi</h2>
                        <p class="text-muted mb-0">4 digit kode telah dikirimkan ke email</p>
                        <p class="mb-5">{{ $email }}</p>

                        <div class="otp-container justify-content-center">
                            <!-- OTP Input 1 -->
                            <input type="text" name="digit1" maxlength="1" class="form-control text-center square-input shadow-sm"
                                id="otp1" oninput="moveToNext(this)" />
                            <!-- OTP Input 2 -->
                            <input type="text" name="digit2" maxlength="1" class="form-control text-center square-input shadow-sm"
                                id="otp2" oninput="moveToNext(this)" />
                            <!-- OTP Input 3 -->
                            <input type="text" name="digit3" maxlength="1" class="form-control text-center square-input shadow-sm"
                                id="otp3" oninput="moveToNext(this)" />
                            <!-- OTP Input 4 -->
                            <input type="text" name="digit4" maxlength="1" class="form-control text-center square-input shadow-sm"
                                id="otp4" />
                        </div>
                        <input type="hidden" id="email" name="email" />
                        <input type="hidden" id="otp" name="otp" />
                        <div class="center-content mt-5">
                             {{-- <a href="/password/resetPassword}" class="btn btn-primary btn-md hover:btn-light" id="verifButton">Kirim</a> --}}
                             <button type="submit" class="btn btn-primary btn-md hover:btn-light" id="verifButton">Kirim</button>
                             <div class="d-flex mt-2">
                                <a href="{{ route('lupaPassword') }}" id="resendLink"
                                    class="border-0 text-black text-decoration-underline bg-transparent" >Kirim Ulang</a>
                                <div id="countdown" class="countdown">01:00</div>
                            </div>
                        </div>
                    </form>
                    @error('otp')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
    </main>

    <script>
        var countdown = 60;

        function startCountdown() {
            var timer = setInterval(function() {
                countdown--;
                var minutes = Math.floor(countdown / 60);
                var seconds = countdown % 60;

                var formattedTime =
                    (minutes < 10 ? '0' : '') + minutes + ':' + (seconds < 10 ? '0' : '') + seconds;

                document.getElementById('countdown').innerText = formattedTime;

                // Disable "Kirim Ulang" link when countdown reaches 0
                if (countdown <= 0) {
                    clearInterval(timer);
                    document.getElementById('resendLink').disabled = false;
                }
            }, 1000);
        }

        function moveToNext(input) {
            // Get the current input's length
            const length = input.value.length;

            // If the input is filled, move focus to the next input
            if (length === 1) {
                const nextId = input.id.substring(0, input.id.length - 1) + (parseInt(input.id.slice(-1)) + 1);
                const nextInput = document.getElementById(nextId);

                if (nextInput) {
                    nextInput.focus();
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
         startCountdown();

        // Tambahkan event listener untuk form submission
        var otpValue = document.getElementById('otp1').value +
                    document.getElementById('otp2').value +
                    document.getElementById('otp3').value +
                    document.getElementById('otp4').value;

                var email = document.getElementById("email").value = "{{$email}}";
                var otp = document.getElementById("otp").value = otpValue;

        });


    </script>
@endsection
