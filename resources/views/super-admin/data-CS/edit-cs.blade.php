@extends('layouts.mainSA')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/data-cs-superadmin.css') }}">
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
                <form action="{{ route('editCsSA', $data->id) }}" method="POST" id="editForm"
                    >
                    @csrf
                    @method('PUT')
                    <div class="col m-0 input-container d-none">
                        <label for="idadmin" class="form-label custom-label">Id Admin</label>
                        <input type="text" id="idadmin" class="form-control custom-input">
                    </div>

                    <div class="row mb-5">
                        <div class="col m-0 input-container">
                            <label for="nama" class="form-label custom-label">Nama</label>
                            <input type="text" id="nama" class="form-control custom-input" name="name"
                                value="{{ $data->name }}" required>
                            <div class="invalid-feedback fw-bold">
                                EROR: Field Tidak Boleh Kosong
                            </div>
                        </div>
                        <div class="col m-0 input-container ">
                            <label for="hp" class="form-label custom-label">Nomor Handphone</label>
                            <input type="tel" maxlength="13" minlength="11" id="hp"
                                class="form-control custom-input" oninput="this.value = this.value.replace(/\D/g, '')"
                                value="{{ $data->phone_number }}" name="phone_number" required>
                            <div class="invalid-feedback fw-bold">
                                EROR: Field Tidak Boleh Kosong
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col m-0 input-container ">
                            <label for="email" class="form-label custom-label">Email</label>
                            <input type="email" id="email" class="form-control custom-input"
                                value="{{ $data->email }}" name="email" required>
                            <div class="invalid-feedback fw-bold">
                                EROR: Field Tidak Boleh Kosong
                            </div>
                        </div>
                    </div>
                    <div class="mb-5 d-none">
                        <label for="role" class="form-label custom-label">Role</label>
                        <input type="text" id="role" class="form-control custom-input" value="{{ $data->role }}"
                            name="role">
                    </div>
                    <div class="mb-3">
                        <h5 class="fw-bolder mb-0">Toko Juragan</h5>
                        <select name="juragan_id" class="form-select w-50">
                        @foreach ($juragan as $item)
                            <option value="{{ $item->id }}">{{ $item->name_juragan }}</option>
                        @endforeach
                    </select>
                    </div>


                    <div class="d-flex flex-row gap-3 justify-content-end">
                        <a href="/super-admin/data-cs" class="btn fw-bold px-4 py-2 btn-btl">Batal</a>
                        <button type="submit" class="btn fw-bold btn-dark px-4 py-2 btn-sv"
                            >Simpan</button>
                        {{-- <button type="submit" class="btn fw-bold btn-dark px-4 py-2 btn-sv"
                            onclick="editCs()">Simpan</button> --}}
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

        // Fungsi untuk mengubah data CS
        function editCs() {
            const formnya = document.getElementById('editForm');
            if (!formnya.checkValidity()) {
                showErorModalCS();
                return false;
            } else {
                formnya.submit();
                showSuksesModalCS();
            }
        }

        // Modal
        // Fungsi untuk menampilkan modal sukses menambah data
        function showSuksesModalCS() {
            $('#suksesModal').modal('show');
            setTimeout(function() {
                $('#suksesModal').modal('hide');
                window.location.href = '/super-admin/data-cs';
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
