@extends('layouts.mainA')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/edit-cs.css') }}">
@endsection

@section('konten')
    <div class="container-fluid content-add p-4">
        <header>
            <div class="d-flex flex-row gap-4 p-5 align-items-center ">
                <h2 class="mb-0 fw-bold ">Edit CS</h2>
            </div>
        </header>
        <main class="bg-white ">
            <div class="p-5">
                <div class="mb-5">
                    <h5 class="fw-bolder mb-0">Informasi Personal</h5>
                    <div style="font-size: 12px;">Berisi data pribadi dari Customer Service yang akan didaftarkan</div>
                </div>
                <form action="{{ route('editCs', $data->id) }}" class="needs-validation" id="editForm" method="POST"
                    novalidate>
                    @csrf
                    @method('PUT')
                    <div class="col m-0 input-container d-none">
                        <label for="idadmin" class="form-label custom-label">Id Admin</label>
                        <input type="text" id="idadmin" class="form-control custom-input">
                    </div>

                    <div class="row mb-5">
                        <div class="col m-0 input-container">
                            <label for="nama" class="form-label custom-label">Nama</label>
                            <input type="text" id="nama" name="name" class="form-control custom-input"
                                value="{{ $data->name }}" required>
                            <div class="invalid-feedback fw-bold">
                                EROR: Field Tidak Boleh Kosong
                            </div>
                        </div>
                        <div class="col m-0 input-container ">
                            <label for="hp" class="form-label custom-label">Nomor Handphone</label>
                            <input type="tel" maxlength="13" minlength="11" id="hp"
                                class="form-control custom-input" name="phone_number"
                                oninput="this.value = this.value.replace(/\D/g, '')" value="{{ $data->phone_number }}"
                                required>
                            <div class="invalid-feedback fw-bold">
                                EROR: Field Tidak Boleh Kosong
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col m-0 input-container ">
                            <label for="email" class="form-label custom-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control custom-input"
                                value="{{ $data->email }}" required>
                            <div class="invalid-feedback fw-bold">
                                EROR: Field Tidak Boleh Kosong
                            </div>
                        </div>
                    </div>
                    <div class="mb-5 d-none">
                        <label for="role" class="form-label custom-label">Role</label>
                        <input type="text" id="role" class="form-control custom-input" value="cs" name="role">
                    </div>
                    <div class="mb-3">
                        <h5 class="fw-bolder mb-0">Toko Juragan</h5>
                        <div style="font-size: 12px;">Setiap Customer Service (CS) yang didaftarkan wajib memilih setidaknya
                            1 toko yang dipegang, toko yang sudah dipilih oleh satu CS tidak bisa lagi dipegang oleh CS yang
                            lain</div>
                    </div>

                    <div class="mb-5">
                        <div class="dropdown" style="width: 100%">
                            <button style="width: 100%; display: flex; align-items: left;"
                                class="text-start fw-bold custom-input bg-white" type="button" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false" onclick="pilihToko()">
                                <span class="mt-2 ms-2 " style="flex-grow: 1;">Klik untuk pilih toko</span>
                                <span class="me-4 fs-2" id="icon-down"><svg class="mb-2" width="25" height="25"
                                        viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="22.95" height="22.95" rx="3.5"
                                            transform="matrix(1 0 0 -1 0.0498047 22.9766)" fill="white" />
                                        <path
                                            d="M22.9998 19.7666V3.23653C22.9998 2.38519 22.6616 1.56873 22.0596 0.966742C21.4576 0.364756 20.6412 0.0265617 19.7898 0.0265617H3.25977C2.40844 0.0265617 1.59197 0.364756 0.989983 0.966742C0.387997 1.56873 0.0498047 2.38519 0.0498047 3.23653V19.7666C0.0498047 20.6179 0.387997 21.4344 0.989983 22.0364C1.59197 22.6384 2.40844 22.9766 3.25977 22.9766H19.7898C20.6412 22.9766 21.4576 22.6384 22.0596 22.0364C22.6616 21.4344 22.9998 20.6179 22.9998 19.7666ZM1.33379 3.23653C1.33379 2.72573 1.53671 2.23585 1.8979 1.87466C2.25909 1.51347 2.74897 1.31055 3.25977 1.31055H19.7898C20.3006 1.31055 20.7905 1.51347 21.1517 1.87466C21.5129 2.23585 21.7158 2.72573 21.7158 3.23653V19.7666C21.7158 20.2774 21.5129 20.7673 21.1517 21.1285C20.7905 21.4897 20.3006 21.6926 19.7898 21.6926H3.25977C2.74897 21.6926 2.25909 21.4897 1.8979 21.1285C1.53671 20.7673 1.33379 20.2774 1.33379 19.7666V3.23653Z"
                                            fill="black" />
                                        <path
                                            d="M15.8185 10.0189C15.9357 9.89929 16.001 9.73827 16.0002 9.57082C15.9993 9.40337 15.9324 9.24302 15.814 9.12461C15.6956 9.0062 15.5353 8.93931 15.3678 8.93846C15.2004 8.93762 15.0393 9.00289 14.9197 9.12009L11.5172 12.5098L8.11461 9.12009C7.99501 9.00289 7.83399 8.93762 7.66654 8.93846C7.49909 8.93931 7.33874 9.0062 7.22033 9.12461C7.10193 9.24302 7.03503 9.40337 7.03419 9.57082C7.03334 9.73827 7.09861 9.89929 7.21582 10.0189L11.0678 13.8709C11.1265 13.9303 11.1965 13.9775 11.2737 14.0098C11.3508 14.042 11.4336 14.0586 11.5172 14.0586C11.6008 14.0586 11.6836 14.042 11.7607 14.0098C11.8378 13.9775 11.9078 13.9303 11.9666 13.8709L15.8185 10.0189Z"
                                            fill="black" />
                                    </svg>
                                </span>
                                <span class="me-4 fs-2 hide" id="icon-down2">
                                    <svg width="25" height="25" viewBox="0 0 23 23" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect width="22.95" height="22.95" rx="3.5"
                                            transform="matrix(1 0 0 -1 0.0498047 22.9766)" fill="#202B46" />
                                        <path
                                            d="M22.9998 19.7666V3.23653C22.9998 2.38519 22.6616 1.56873 22.0596 0.966742C21.4576 0.364756 20.6412 0.0265617 19.7898 0.0265617H3.25977C2.40844 0.0265617 1.59197 0.364756 0.989983 0.966742C0.387997 1.56873 0.0498047 2.38519 0.0498047 3.23653V19.7666C0.0498047 20.6179 0.387997 21.4344 0.989983 22.0364C1.59197 22.6384 2.40844 22.9766 3.25977 22.9766H19.7898C20.6412 22.9766 21.4576 22.6384 22.0596 22.0364C22.6616 21.4344 22.9998 20.6179 22.9998 19.7666ZM1.33379 3.23653C1.33379 2.72573 1.53671 2.23585 1.8979 1.87466C2.25909 1.51347 2.74897 1.31055 3.25977 1.31055H19.7898C20.3006 1.31055 20.7905 1.51347 21.1517 1.87466C21.5129 2.23585 21.7158 2.72573 21.7158 3.23653V19.7666C21.7158 20.2774 21.5129 20.7673 21.1517 21.1285C20.7905 21.4897 20.3006 21.6926 19.7898 21.6926H3.25977C2.74897 21.6926 2.25909 21.4897 1.8979 21.1285C1.53671 20.7673 1.33379 20.2774 1.33379 19.7666V3.23653Z"
                                            fill="black" />
                                        <path
                                            d="M15.8185 10.0189C15.9357 9.89929 16.001 9.73827 16.0002 9.57082C15.9993 9.40337 15.9324 9.24302 15.814 9.12461C15.6956 9.0062 15.5353 8.93931 15.3678 8.93846C15.2004 8.93762 15.0393 9.00289 14.9197 9.12009L11.5172 12.5098L8.11461 9.12009C7.99501 9.00289 7.83399 8.93762 7.66654 8.93846C7.49909 8.93931 7.33874 9.0062 7.22033 9.12461C7.10193 9.24302 7.03503 9.40337 7.03419 9.57082C7.03334 9.73827 7.09861 9.89929 7.21582 10.0189L11.0678 13.8709C11.1265 13.9303 11.1965 13.9775 11.2737 14.0098C11.3508 14.042 11.4336 14.0586 11.5172 14.0586C11.6008 14.0586 11.6836 14.042 11.7607 14.0098C11.8378 13.9775 11.9078 13.9303 11.9666 13.8709L15.8185 10.0189Z"
                                            fill="white" />
                                    </svg>

                                </span>
                            </button>

                            <ul style="width: 100%; border: 1px solid black;" class="dropdown-menu"
                                aria-labelledby="dropdownMenuButton">
                                <div class="row ms-1 me-1 mt-2 mb-2">
                                    <div class="col-md-6 d-grid gap-2">
                                        @foreach ($juragan as $item)
                                            <li
                                                class="list-group-item border border-dark custom-checkbox d-flex justify-content-between align-items-center w-100">
                                                <label for="juragan" class="fw-bold p-2 ">{{ $item }}</label>
                                                <div class="form-check me-3">
                                                    <input type="checkbox" id="juragan" value="{{ $item }}"
                                                        class="w-100" name="juragans[]" checked>
                                                </div>
                                            </li>
                                        @endforeach
                                        @foreach ($juraganNoCs as $item)
                                            <li
                                                class="list-group-item border border-dark custom-checkbox d-flex justify-content-between align-items-center w-100">
                                                <label for="juragan"
                                                    class="fw-bold p-2 ">{{ $item->name_juragan }}</label>
                                                <div class="form-check me-3">
                                                    <input type="checkbox" id="juragan"
                                                        value="{{ $item->name_juragan }}" class="w-100"
                                                        name="juragans[]">
                                                </div>
                                            </li>
                                        @endforeach

                                    </div>
                                </div>
                                <button id="button-submit" class="ms-3 me-1 py-3 custom-checkbox btn btn-secondary"
                                    style="width: 98%">Submit</button>
                            </ul>
                            <div id="error-message-checkbox" class="invalid-feedback text-danger fw-bold "
                                style="display: none;">
                                ERROR: Field Tidak Boleh Kosong
                            </div>
                            <div class="mt-4 d-flex justify-content-between align-items-center">
                                <div class="col-6">
                                    <p class="mb-0" id="terpilih" style="display: none">Toko yang dipilih :</p>
                                    <p id="toko-terpilih" class="mb-0 fw-bold "></p>
                                </div>
                                <a href="" id="reset-link" style="display: none" class="col-6 text-end">Reset
                                    Pilihan</a>
                            </div>

                        </div>
                    </div>


                    <div class="d-flex flex-row gap-3 justify-content-end ">
                        <a href="/admin/data-cs" class="btn fw-bold px-4 py-2 btn-btl">Batal</a>
                        <button type="submit" class="btn fw-bold btn-dark px-4 py-2 btn-sv"
                            onclick="editCs()">Simpan</button>
                    </div>
                </form>
            </div>

        </main>
    </div>

    {{-- sukses modal tambah --}}
    <div class="modal fade" id="suksesModal" tabindex="-1" role="dialog" data-bs-backdrop="false">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body py-4">
                    <div class="d-flex flex-row  justify-content-evenly align-items-center ">
                        <img src="{{ asset('assets/img/sukses.png') }}" alt="" width="55px">
                        <p class="fw-bolder text-center m-0">Data <span class="text-success ">Berhasil</span> diedit!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- gagal Modal Edit -->
    <div class="modal fade" id="erorModal" tabindex="-1" role="dialog" data-bs-backdrop="false">
        <div class="modal-dialog modal-sm " role="document">
            <div class="modal-content ">
                <div class="modal-body px-0">
                    <div class="d-flex flex-row  justify-content-evenly align-items-center  ">
                        <img src="{{ asset('assets/img/gagal.png') }}" alt="" height="55px" class="my-2">
                        <div class="d-flex flex-column ">
                            <p class="fw-bold text-start m-0">Data <span class="text-danger">Gagal</span> diedit!</p>
                            <span class="text-danger text-center d-block small">Eror : message!!</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    {{-- tulisan jika CS tidak ditemukan pada pencarian --}}
    {{-- @else
      <p class="text-center fs-4 mt-3">CS tidak ditemukan .</p>
    @endif --}}
@endsection

@section('js')
    <script>
        // Fungsi pada button Show Password pada form
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

        // Fungsi button submit pada pilihan checkbox
        document.addEventListener('DOMContentLoaded', function() {
            var submitButton = document.getElementById('button-submit');
            var terpilih = document.getElementById('terpilih');
            var resetLink = document.getElementById('reset-link');
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            var tokoTerpilih = document.getElementById('toko-terpilih');
            var icon1 = document.getElementById('icon-down');
            var icon2 = document.getElementById('icon-down2');

            submitButton.addEventListener('click', function() {
                var selectedStores = [];
                checkboxes.forEach(function(checkbox) {
                    if (checkbox.checked) {
                        selectedStores.push(checkbox.value);
                    }
                });

                // Logika apabila ada data yang dipilih dalama inputan checkbox
                if (selectedStores.length > 0) {
                    terpilih.style.display = 'block';
                    tokoTerpilih.textContent = 'Toko yang dipilih: ' + selectedStores.join(', ');
                    resetLink.style.display = 'inline';
                    icon1.classList.add('hide');
                    icon2.classList.remove('hide');
                    resetLink.style.display = 'block';
                    document.getElementById('error-message-checkbox').style.display = 'none';

                    // Logika apabila tidak ada data yang dipilih dadlam checkbox
                } else {
                    tokoTerpilih.style.display = 'none';
                    resetLink.style.display = 'none';
                    icon1.classList.remove('hide');
                    icon2.classList.add('hide');
                    document.getElementById('error-message-checkbox').style.display = 'block';

                }
            });

            // Fungsi reset pilihan
            resetLink.addEventListener('click', function(event) {
                event.preventDefault();
                checkboxes.forEach(function(checkbox) {
                    checkbox.checked = false;
                });

                tokoTerpilih.style.display = 'none';
                resetLink.style.display = 'none';
                terpilih.style.display = 'none';
                icon1.classList.remove('hide');
                icon2.classList.add('hide');
            });
        });
    </script>

    <script>
        // Fungsi validasi form default dari Bootstrap
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

        // Fungsi pada pilih toko
        function pilihToko() {
            var icon1 = document.getElementById('icon-down');
            var icon2 = document.getElementById('icon-down2');
            // Cek apakah icon1 sedang ditampilkan
            var isIcon1Visible = !icon1.classList.contains('hide');

            if (isIcon1Visible) {
                // Sembunyikan icon1, tampilkan icon2
                icon1.classList.add('hide');
                icon2.classList.remove('hide');
            } else {
                // Sembunyikan icon2, tampilkan icon1
                icon1.classList.remove('hide');
                icon2.classList.add('hide');
            }

        }

        // Fungsi untuk menambah data CS
        function editCs() {
            const formnya = document.getElementById('editForm');
            if (!formnya.checkValidity()) {
                showErorModal();
                return false;
            } else {
                formnya.submit();
                showSuksesModal();
            }
        }

        // Modal
        // Fungsi untuk menampilkan modal sukses menambah data
        function showSuksesModalCS() {
            $('#suksesModal').modal('show');
            setTimeout(function() {
                $('#suksesModal').modal('hide');
                window.location.href = '/admin/data-cs';
            }, 1200);
        }

        // Fungsi untuk menampilkan modal gagal menambah data
        function showErorModalCS() {
            $('#erorModal').modal('show');
            setTimeout(function() {
                $('#erorModal').modal('hide');
                window.location.href = '';
            }, 1200);
        }
    </script>
@endsection
