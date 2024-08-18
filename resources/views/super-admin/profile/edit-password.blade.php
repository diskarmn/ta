@extends('layouts.mainSA')

@section('css')
    <link rel="stylesheet" href="/assets/css/profile.css">
@endsection

@section('konten')
    <section class="container-edit_profile rounded">
        {{-- Header Profile --}}
        <article class="header-edit_profile px-lg-4 px-md-5">
            <!-- <a href="/superadmin/profile" class="back-profile p-0">
                <i class="fa-solid fa-arrow-left icon_back-profile m-0"></i>
            </a> -->
            <h1 class="text-white fw-bold m-0 p-0">{{ $title }}</h1>
        </article>
        {{-- Akhir Header Profile --}}

        <form method="POST" action="{{ route('ubahPasSA') }}" class="bg-white py-5 body-edit_profile d-flex justify-center align-items-center">
            @csrf
            @method('PUT')
            <div class="mx-5 px-5 py-1 rounded-4 border border-2 border-black border-opacity-25 password-wrapper">
                <div class="row py-4">
                    <div class="col-lg-12 row py-4 mx-0">
                        <label class="fs-4 fw-bold col-12 m-0 p-0 mb-1">Password Lama <span
                                class="text-danger">*</span></label>
                        <div class="col-lg-12 p-0 d-flex justify-content-between password-toggle gap-3">
                            <input name="current_password" class=" w-100 m-0 px-3 py-lg-3 py-md-3 rounded border border-2 rounded" type="password"
                                placeholder="Masukkan Password Lama" id="password">
                            <button
                                class="toggle-password btn btn-hides rounded py-2 px-lg-3 px-3 d-flex align-items-center border border-2 rounded"
                                style="box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.25);" type="button" id="showPassword"><i
                                    class="fa-regular fa-eye text-muted m-0 p-0 "></i></button>
                        </div>
                    </div>
                    <div class="col-lg-12 row py-4 mx-0">
                        <label class="fs-4 fw-bold col-12 m-0 p-0 mb-1">Password Baru <span
                                class="text-danger">*</span></label>
                        <div class="col-lg-12 p-0 d-flex justify-content-between mb-2 password-toggle gap-3">
                            <input name="new_password" id="passwordInput" class="w-100 m-0 px-3 py-lg-3 py-md-3 border border-2 rounded"
                                type="password" placeholder="Masukkan Password Baru" id="password">
                            <button
                                class="toggle-password btn btn-hides rounded py-2 px-lg-3 px-3 d-flex align-items-center border border-2 rounded"
                                style="box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.25);" type="button" id="showPassword"><i
                                    class="fa-regular fa-eye text-muted m-0 p-0 "></i></button>
                        </div>
                        <div class="progress mt-3 mb-2" style="height: 20px;">
                            <div id="progressBar" class="progress-bar" role="progressbar" style="width: 0%;"
                                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex flex-column p-0">
                            <p id="strengthText" class="strength-text m-0 w-auto p-0">Gunakan minimal 8 karakter dengan
                                kombinasi huruf dan angka (simbol opsional)</p>
                        </div>
                    </div>
                    <div class="col-lg-12 row py-4 mx-0">
                        <label class="fs-4 fw-bold col-12 m-0 p-0 mb-1">Konfirmasi Password Baru <span
                                class="text-danger">*</span></label>
                        <div class="col-lg-12 p-0 d-flex justify-content-between password-toggle gap-3">
                            <input name="new_password_confirmation" class=" w-100 m-0 px-3 py-lg-3 py-md-3 border border-2 rounded" type="password"
                                placeholder="Ulangi Password Baru" id="password">
                            <button
                                class="toggle-password btn btn-hides rounded py-2 px-lg-3 px-3 d-flex align-items-center border border-2 rounded"
                                style="box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.25);" type="button" id="showPassword"><i
                                    class="fa-regular fa-eye text-muted m-0 p-0 "></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex gap-5 btn-edit_save my-5">
                <button type="button" onclick="window.location.href='{{ route('indexProfile') }}'" class="btn btn_batal-edit">Batal</button>
                <button type="submit" class="btn btn_simpan-edit" id="simpan">Simpan</button>
            </div>
        </form>
    </section>

    <section>
        @include('partials.modal')

        @if(session('errorValidate'))
            <script>
                $(document).ready(function() {
                    $('#messageErrorValidate').text('Eror: {{ implode(', ', session('errorMessage')) }}');
                    $('#erorModalValidasi').modal('show');
                })
            </script>
        @endif
    </section>

    <script>
        const togglePasswordButtons = document.querySelectorAll('.toggle-password');
    
        togglePasswordButtons.forEach(button => {
            button.addEventListener('click', function() {
                const inputField = this.parentElement.querySelector('input');
                const icon = this.querySelector('i');
    
                if (inputField.type === 'password') {
                    inputField.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    inputField.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });
    
        // Function to calculate password strength
        function calculatePasswordStrength(password) {
            var strength = 0;
    
            // Check length
            if (password.length >= 8) {
                strength += 25;
            }
    
            // Check for uppercase letters
            if (/[A-Z]/.test(password)) {
                strength += 25;
            }
    
            // Check for lowercase letters
            if (/[a-z]/.test(password)) {
                strength += 25;
            }
    
            // Check for numbers
            if (/\d/.test(password)) {
                strength += 25;
            }
    
            // Check for symbols
            if (/[^A-Za-z0-9]/.test(password)) {
                strength += 25;
            }
    
            // Ensure strength does not exceed 100
            strength = Math.min(strength, 100);
    
            return strength;
        }
    
        // Function to update progress bar with color
        function updateProgressBar(strength) {
            var progressBar = document.getElementById("progressBar");
            progressBar.style.width = strength + "%";
            progressBar.setAttribute("aria-valuenow", strength);
    
            // Set color based on strength
            if (strength >= 75) {
                progressBar.classList.remove("weak", "medium");
                progressBar.classList.add("strong");
            } else if (strength >= 50) {
                progressBar.classList.remove("strong", "weak");
                progressBar.classList.add("medium");
            } else {
                progressBar.classList.remove("strong", "medium");
                progressBar.classList.add("weak");
            }
        }
    
        // Function to update strength text
        function updateStrengthText(strength) {
            var strengthText = document.getElementById("strengthText");
            if (strength >= 100) {
                strengthText.textContent = "Sangat Kuat";
                strengthText.classList.remove("text-muted", "text-warning", "text-danger");
                strengthText.classList.add("text-success");
            } else if (strength >= 75) {
                strengthText.textContent = "Kuat";
                strengthText.classList.remove("text-muted", "text-warning", "text-danger");
                strengthText.classList.add("text-success");
            } else if (strength >= 50) {
                strengthText.textContent = "Sedang";
                strengthText.classList.remove("text-muted", "text-success", "text-danger");
                strengthText.classList.add("text-warning");
            } else if (strength >= 25) {
                strengthText.textContent = "Lemah";
                strengthText.classList.remove("text-muted", "text-success", "text-warning");
                strengthText.classList.add("text-danger");
            } else {
                strengthText.textContent = "Gunakan minimal 8 karakter dengan kombinasi huruf dan angka (simbol opsional)";
                strengthText.classList.remove("text-success", "text-warning", "text-danger");
                strengthText.classList.add("text-muted");
            }
        }
    
    
        // Event listener for password input
        document.getElementById("passwordInput").addEventListener("input", function(event) {
            var password = event.target.value;
    
            var strength = calculatePasswordStrength(password);
            updateProgressBar(strength);
            updateStrengthText(strength);
        });
    </script>
@endsection
