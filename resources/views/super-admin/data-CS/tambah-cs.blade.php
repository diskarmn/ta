@extends('layouts.mainSA')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/data-cs-superadmin.css') }}">
@endsection

@section('konten')
    <div class="container-fluid content-add p-4">
        <header>
            <div class="d-flex flex-row gap-4 p-5 align-items-center ">

                <h2 class="mb-0 fw-bold ">Tambah CS</h2>
            </div>
        </header>
        <main class="bg-white ">
            <div class="p-5">
                <div class="mb-5">
                    <h5 class="fw-bolder mb-0">Informasi Personal</h5>
                    <div style="font-size: 12px;">Berisi data pribadi dari Customer Service yang akan didaftarkan</div>
                </div>
                <form action="{{ route('tambahCsSuperAdmin') }}" method="POST"  enctype="multipart/form-data"
                class="needs-validation" id="tambahForm" novalidate>
                   @csrf
                   <div class="col m-0 input-container d-none">
                       <label for="idadmin" class="form-label custom-label">Id Customer Service</label>
                       <input type="text" id="idadmin" class="form-control custom-input">
                   </div>
                   <div class="row mb-5">
                       <div class="col m-0 input-container">
                           <label for="nama" class="form-label custom-label">Nama</label>
                           <input type="text" id="nama" class="form-control custom-input"
                               placeholder="Tuliskan nama disini" name="name" required>
                       </div>
                       <div class="col m-0 input-container ">
                           <label for="hp" class="form-label custom-label">Nomor Handphone</label>
                           <input type="tel" maxlength="13" minlength="11" id="hp"
                               class="form-control custom-input" placeholder="Tuliskan nomor handphone disini"
                               oninput="this.value = this.value.replace(/\D/g, '')" name="phone_number" required>
                       </div>
                   </div>
                   <div class="row mb-5">
                       <div class="col m-0 input-container ">
                           <label for="email" class="form-label custom-label">Email</label>
                           <input type="email" id="email" class="form-control custom-input"
                               placeholder="Tuliskan email disini (@)" name="email" required>
                       </div>
                       <div class="col m-0 d-flex flex-row gap-2 input-container ">
                           <div class="col">
                               <label for="password" class="form-label custom-label">Password</label>
                               <input type="password" class="form-control custom-input rounded"
                                   placeholder="Min 8 char (e.g. Ab#123)" id="password" name="password" required>
                           </div>
                           <div class="col-lg-1">
                               <button class="btn btn-hides rounded py-3 d-flex align-items-center"
                                   style="box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.25);" type="button" id="showPassword"><i
                                       class="fa-regular fa-eye text-muted m-0 p-0 "></i></button>
                           </div>
                       </div>
                   </div>
                   <div class="col m-0 d-flex flex-row gap-2 input-container ">
                       <div class="mb-3 col-6">
                           <label for="gender" class="form-label">Gender</label>
                           <select class="form-select" id="gender" name="gender" required>
                               <option value="" selected>Pilih Gender</option>
                               <option value="male">Male</option>
                               <option value="female">Female</option>
                           </select>
                       </div>
                       <div class="mb-3 col-6">
                           <label for="juragan" class="form-label">Juragan</label>
                               @php
                               use Illuminate\Support\Facades\DB;

                               $juragans = DB::table('juragans')->get();
                           @endphp
                           <select class="form-select" id="juragan" name="juragan_id">
                               <option value="" selected>Pilih Juragan</option>
                               @foreach ($juragans as $juragan)
                                   <option value="{{ $juragan->id }}">{{ $juragan->name_juragan }}</option>
                               @endforeach
                           </select>
                       </div>

                   </div>
                   <div class="mb-3">
                       <label for="gambar" class="col-form-label">Unggah Foto Customer Service</label>
                       <input type="file" class="form-control custom-input" id="gambar"
                           name="gambar" style="width: 200px">
                   </div>
                   <div class="d-flex flex-row gap-3 justify-content-end ">
                       <a href="/admin/data-cs" class="btn fw-bold px-4 py-2 btn-btl">Batal</a>
                       <button type="submit" class="btn fw-bold btn-dark px-4 py-2 btn-sv">Simpan</button>
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
                        <p class="fw-bolder text-center m-0">Data <span class="text-success ">Berhasil</span> ditambah!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- gagal Modal tambah -->
    <div class="modal fade" id="erorModal" tabindex="-1" role="dialog" data-bs-backdrop="false">
        <div class="modal-dialog modal-sm " role="document">
            <div class="modal-content ">
                <div class="modal-body px-0">
                    <div class="d-flex flex-row  justify-content-evenly align-items-center  ">
                        <img src="{{ asset('assets/img/gagal.png') }}" alt="" height="55px" class="my-2">
                        <div class="d-flex flex-column ">
                            <p class="fw-bold text-start m-0">Data <span class="text-danger">Gagal</span> ditambah!</p>
                            <span class="text-danger text-center d-block small">Eror : message!!</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


@endsection

@section('js')
    <script>
        // Fungsi pada button Show Password
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
        document.getElementById("password").addEventListener("input", function(event) {
            var password = event.target.value;

            var strength = calculatePasswordStrength(password);
            updateProgressBar(strength);
            updateStrengthText(strength);
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

                // Logika apabila ada data yang dipilih dalam input checkbox
                if (selectedStores.length > 0) {
                    terpilih.style.display = 'block';
                    tokoTerpilih.textContent = 'Toko yang dipilih: ' + selectedStores.join(', ');
                    resetLink.style.display = 'inline';
                    icon1.classList.add('hide');
                    icon2.classList.remove('hide');
                    resetLink.style.display = 'block';
                    document.getElementById('error-message-checkbox').style.display = 'none';

                    // Logika apabila tidak ada data yang dipilih dalam inputan checkbox
                } else {
                    tokoTerpilih.style.display = 'none';
                    resetLink.style.display = 'none';
                    icon1.classList.remove('hide');
                    icon2.classList.add('hide');
                    document.getElementById('error-message-checkbox').style.display = 'block';

                }
            });

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
                        tambahCS();
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


            var checkboxes = document.querySelectorAll('input[type="checkbox"][name="juragans[]"]');
            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    var selectedJuragans = document.querySelectorAll(
                        'input[type="checkbox"][name="juragans[]"]:checked');
                    var selectedJuragansText = [];
                    selectedJuragans.forEach(function(juragan) {
                        selectedJuragansText.push(juragan.value);
                    });
                    // Mengganti teks pada elemen <span> dengan id 'selectedJuragansText'
                    var spanElement = document.getElementById('selectedJuragansText');
                    spanElement.innerText = selectedJuragansText.length > 0 ? selectedJuragansText.join(
                        ', ') : 'Klik untuk pilih toko';
                });
            });


            // Tambahkan event listener pada tombol "Submit"
            document.getElementById('button-submit').addEventListener('click', function() {
                var selectedJuragans = document.querySelectorAll(
                    'input[type="checkbox"][name="juragans[]"]:checked');
                var selectedJuragansText = [];
                selectedJuragans.forEach(function(juragan) {
                    selectedJuragansText.push(juragan.value);
                });
                document.getElementById('dropdownMenuButton').innerText = selectedJuragansText.length > 0 ?
                    selectedJuragansText.join(', ') : 'Klik untuk pilih toko';
            });

        }

        // Fungsi untuk menambah data CS
        function tambahCS() {
            // Logika untuk menambah CS
            const formnya = document.getElementById('tambahForm');
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
                window.location.href = '/superadmin/data-cs';
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
