@extends('layouts.mainSA')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/data-admin.css') }}">
@endsection

@section('konten')
    <div class="container-fluid content-add p-4">
        <header>
            <div class="d-flex flex-row gap-4 p-5 align-items-center ">
                {{-- <a href="/superAdmin/dataAdmin" class="text-decoration-none text-white "><i
                        class="fa-solid fa-arrow-left fa-2x"></i></a> --}}
                <h2 class="mb-0 fw-bold ">Tambah Admin</h2>
            </div>
        </header>
        <main class="bg-white ">
            <div class="p-5">
                <div class="mb-5">
                    <h5 class="fw-bolder mb-0">Informasi Personal</h5>
                    <div style="font-size: 12px;">Berisi data pribadi dari Customer Service yang akan didaftarkan</div>
                </div>
                <form action="{{ route('addAdmin') }}" class="needs-validation" method="POST" id="tambahForm" novalidate>
                    @csrf
                    <div class="col m-0 input-container d-none">
                        <label for="idadmin" class="form-label custom-label">Id Admin</label>
                        <input type="text" id="idadmin" class="form-control custom-input">
                    </div>

                    <div class=" d-flex flex-row gap-4 mb-5">
                        <div class="col m-0 input-container">
                            <label for="nama" class="form-label custom-label">Nama</label>
                            <input type="text" id="nama" name="name" class="form-control custom-input"
                                placeholder="Tuliskan nama disini" required>
                            <div class="invalid-feedback fw-bold">
                                EROR: Field Tidak Boleh Kosong
                            </div>
                        </div>
                        <div class="col m-0 input-container ">
                            <label for="hp" class="form-label custom-label">Nomor Handphone</label>
                            <input type="tel" maxlength="13" minlength="10" id="hp"
                                class="form-control custom-input" name="phone_number" placeholder="Tuliskan nomor handphone disini"
                                oninput="this.value = this.value.replace(/\D/g, '')" required>
                            <div class="invalid-feedback fw-bold">
                                EROR: Field Tidak Boleh Kosong
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-row gap-4 mb-5">
                        <div class="col m-0 input-container ">
                            <label for="email" class="form-label custom-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control custom-input"
                                placeholder="Tuliskan email disini (@)" required>
                            <div class="invalid-feedback fw-bold">
                                EROR: Field Tidak Boleh Kosong
                            </div>
                        </div>
                        <div class="col m-0 d-flex flex-row gap-2 input-container ">
                            <div class=" d-flex flex-grow-1">
                                <label for="password" class="form-label custom-label">Password</label>
                                <input type="password" name="password" class="form-control custom-input rounded"
                                    placeholder="Minimal 8 karakter, tidak boleh simbol" id="password" required>
                                <div class="invalid-feedback fw-bold">
                                    EROR: Field Tidak Boleh Kosong
                                </div>
                            </div>
                            <div class="">
                                <button class="btn btn-hides rounded"
                                    style="box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.25); padding-top:12px; padding-bottom:12px;"
                                    type="button" id="showPassword"><i class="fa-regular fa-eye text-muted "></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="mb-5 d-none">
                        <label for="role" class="form-label custom-label">Role</label>
                        <input type="text" id="role" name="role" class="form-control custom-input" value="admin">
                    </div>
                    <div class="d-flex flex-row gap-3 justify-content-end ">
                        <a href="/superAdmin/dataAdmin" class="btn fw-semibold rounded-3  px-5 py-3 btn-grey"
                            style="font-size: 15px;">Batal</a>
                        <button type="submit" class="btn fw-semibold btn-purple rounded-3  px-5 py-3 "
                            style="font-size: 15px;">Simpan</button>
                    </div>
                </form>
            </div>

        </main>
    </div>

    <section>
        @include('partials.modal')
    </section>
@endsection


@section('js')
    <script>
        $(document).ready(function() {
            const password = document.getElementById("password");
            const btn_show = document.getElementById("showPassword");
            btn_show.addEventListener("click", function() {
                if (password.type === "password") {
                    password.type = "text";
                    btn_show.innerHTML = '<i class="fa-regular fa-eye-slash"></i>';
                } else {
                    password.type = "password";
                    btn_show.innerHTML = '<i class="fa-regular fa-eye"></i>';
                }
            });
        });
    </script>

    <script>
        (function() {
            'use strict';

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation');

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms).forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    } else {
                        event.preventDefault();
                        tambahAdmin();
                    }

                    form.classList.add('was-validated');
                }, false);
            });
        })();

        function showSuksesModalAdmin() {
            $('#suksesModalTambah').modal('show');
            setTimeout(function() {
                $('#suksesModalTambah').modal('hide');
                window.location.href = '/superAdmin/dataAdmin';
            }, 1200);
        }

        function showErorModalAdmin() {
            $('#erorModalTambah').modal('show');
            setTimeout(function() {
                $('#erorModalTambah').modal('hide');
                window.location.href = '/superAdmin/dataAdmin';
            }, 1200);
        }

        function tambahAdmin() {
            const formnya = document.getElementById('tambahForm');
            if (!formnya.checkValidity()) {
                showErorModal();
                return false;
            } else {
                formnya.submit();
                showSuksesModal();
            }
        }
    </script>
@endsection
