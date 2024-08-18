@extends('layouts.mainA')

@section('css')
    <link rel="stylesheet" href="/assets/css/profile.css">
@endsection

@section('konten')
    <section class="container-edit_profile rounded">
        {{-- Header Profile --}}
        <article class="header-edit_profile px-lg-4 px-md-5">
            <h1 class="text-white fw-bold m-0 p-0">{{ $title }}</h1>
        </article>
        {{-- Akhir Header Profile --}}

        <div class="modal fade" id="actionModalTambah" tabindex="-1" role="dialog" aria-labelledby="successModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class=" my-5 d-flex flex-column justify-content-center ">
                        <img src="{{ asset('assets/img/sukses.png') }}" alt="" width="100px" class="mx-auto mb-2">
                        <small class="fw-bolder text-center ">Password <span class="text-success ">Berhasil</span>
                            Diubah!</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="erorModalTambah" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content ">
                    <div class=" my-5 d-flex flex-column justify-content-center ">
                        <img src="{{ asset('assets/img/gagal.png') }}" alt="" width="100px" class="mx-auto mb-2">
                        <small class="fw-bolder text-center ">Password <span class="text-danger">GAGAL</span>
                            Diubah!</small>
                        <span class="text-danger text-center">ERROR : message</span>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('editPasswordCsAdmin', $data->id) }}" method="POST" id="editPasswordForm">
            @csrf
            <article class="bg-white py-5 body-edit_profile d-flex justify-center align-items-center">
                <div class="mx-5 px-5 py-1 rounded-4 border border-2 border-black border-opacity-25 password-wrapper">
                    <div class="row py-4">
                        <div class="col-lg-12 row py-4 mx-0">
                            <label class="fs-4 fw-bold col-12 m-0 p-0 mb-1">Password Lama <span
                                    class="text-danger">*</span></label>
                            <div class="col-lg-12 p-0 d-flex justify-content-between password-toggle gap-3">
                                <input class=" w-100 m-0 px-3 py-lg-3 py-md-3 rounded border border-2 rounded"
                                    type="password" placeholder="Masukkan Password Lama" id="password"
                                    name="current_password">
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
                                <input id="passwordInput" class="w-100 m-0 px-3 py-lg-3 py-md-3 border border-2 rounded"
                                    type="password" placeholder="Masukkan Password Baru" id="password" name="new_password">
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
                                <input class=" w-100 m-0 px-3 py-lg-3 py-md-3 border border-2 rounded" type="password"
                                    placeholder="Ulangi Password Baru" id="password" name="new_password_confirmation">
                                <button
                                    class="toggle-password btn btn-hides rounded py-2 px-lg-3 px-3 d-flex align-items-center border border-2 rounded"
                                    style="box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.25);" type="button" id="showPassword"><i
                                        class="fa-regular fa-eye text-muted m-0 p-0 "></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex gap-5 btn-edit_save my-5">
                    <a onclick="history.back()" class="btn btn_batal-edit">Batal</a>
                    <button type="submit" class="btn btn_simpan-edit" onclick="editPasswordCS()">Simpan</button>
                </div>
            </article>
        </form>
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

        function editPasswordCS() {
            const formnya = document.getElementById('editPasswordForm');
            if (!formnya.checkValidity()) {
                showErorModalCS();
                return false;
            } else {
                formnya.submit();
                showSuksesModalCS();
            }
        }

        function showSuksesModalCS() {
            $('#actionModalTambah').modal('show');
            setTimeout(function() {
                $('#actionModalTambah').modal('hide');
                window.location.href = '/admin/data-cs';
            }, 1200);
        }

        function showErorModalCS() {
            $('#erorModalTambah').modal('show');
            setTimeout(function() {
                $('#erorModalTambah').modal('hide');
                window.location.href = '';
            }, 1200);
        }
    </script>
    {{-- <script>
        document.getElementById("passwordInput").addEventListener("input", function() {
            var passwordInput = document.getElementById("passwordInput").value;
            var progressBar = document.getElementById("progressBar");
            var strengthText = document.getElementById("strengthText");

            // Pemeriksaan kekuatan password
            var weakRegex = /^(?=.*[a-zA-Z])(?=.*\d).{8,}$/;
            var mediumRegex = /^(?=.*[a-z])(?=.*\d).{8,}$/;
            var strongRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;

            if (passwordInput.length < 8) {
                progressBar.style.width = "8%";
                progressBar.className = "progress-bar weak";
                strengthText.innerText = "Password Tidak Aman. Gunakan minimal 8 karakter.";
            } else if (strongRegex.test(passwordInput)) {
                progressBar.style.width = "102%";
                progressBar.className = "progress-bar strong";
                strengthText.innerText = "Password Kuat";
            } else if (mediumRegex.test(passwordInput)) {
                progressBar.style.width = "66%";
                progressBar.className = "progress-bar medium";
                strengthText.innerText = "Password Sedang";
            } else if (weakRegex.test(passwordInput)) {
                progressBar.style.width = "33%";
                progressBar.className = "progress-bar weak";
                strengthText.innerText = "Lemah, kombinasikan huruf (a-z, A-z) dan angka (0-9)";
            } else {
                progressBar.style.width = "0%";
                strengthText.innerText = "Gunakan minimal 8 karakter dengan kombinasi huruf dan angka";
            }
        });
    </script> --}}
@endsection
