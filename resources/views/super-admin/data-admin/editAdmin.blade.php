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
                <h2 class="mb-0 fw-bold ">Edit Admin</h2>
            </div>
        </header>
        <main class="bg-white ">
            <div class="p-5">
                <div class="mb-5">
                    <h5 class="fw-bolder mb-0">Informasi Personal</h5>
                    <div style="font-size: 12px;">Berisi data pribadi dari Customer Service yang akan didaftarkan</div>
                </div>
                <form action="{{ route('updateAdmin', $data->id) }}" method="POST" id="editForm" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="col m-0 input-container d-none">
                        <label for="idadmin" class="form-label custom-label">Id Admin</label>
                        <input type="text" id="idadmin" class="form-control custom-input">
                    </div>

                    <div class="d-flex flex-row mb-5 gap-4 ">
                        <div class="col m-0 input-container rounded-2">
                            <label for="nama" class="form-label custom-label">Nama</label>
                            <input type="text" id="nama" name="name" class="form-control custom-input" value="{{ $data->name }}" required>
                            <div class="invalid-feedback fw-bold">
                                EROR: Field Tidak Boleh Kosong
                            </div>
                        </div>
                        <div class="col m-0 input-container ">
                            <label for="hp" class="form-label custom-label">Nomor Handphone</label>
                            <input type="tel" maxlength="13" name="phone_number" minlength="11" id="hp"
                                class="form-control custom-input" value="{{ $data->phone_number }}" oninput="this.value = this.value.replace(/\D/g, '')"
                                required>
                            <div class="invalid-feedback fw-bold">
                                EROR: Field Tidak Boleh Kosong
                            </div>
                        </div>
                    </div>
                    <div class=" mb-5">
                        <div class="col m-0 input-container ">
                            <label for="email" class="form-label custom-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control custom-input" value="{{ $data->email }}" required>
                            <div class="invalid-feedback fw-bold">
                                EROR: Field Tidak Boleh Kosong
                            </div>
                        </div>
                    </div>
                    <div class="mb-5 d-none">
                        <label for="role" class="form-label custom-label">Role</label>
                        <input type="text" id="role" name="role" class="form-control custom-input" value="admin">
                    </div>
                    <div class="d-flex flex-row gap-3 justify-content-end ">
                        <a href="/superAdmin/dataAdmin" class="btn fw-semibold px-5 rounded-3  py-3 btn-grey">Batal</a>
                        <button type="submit" class="btn fw-semibold px-4 py-3 rounded-3  btn-purple">Simpan</button>
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
                        editAdmin();
                    }

                    form.classList.add('was-validated');
                }, false);
            });
        })();

        function showSuksesModalEdit() {
            $('#suksesModalEdit').modal('show');
            setTimeout(function() {
                $('#suksesModalEdit').modal('hide');
                window.location.href = '/superAdmin/dataAdmin';
            }, 1200);
        }

        function showErorModalEdit() {
            $('#erorModalEdit').modal('show');
            setTimeout(function() {
                $('#erorModalEdit').modal('hide');
                window.location.href = '/superAdmin/dataAdmin';
            }, 1200);
        }

        function editAdmin() {
            // Logika untuk menambah admin
            const formnya = document.getElementById('editForm');
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
