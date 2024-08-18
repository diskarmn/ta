@extends('layouts.mainCS')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/data-pelanggan.css') }}">
@endsection

@section('konten')
    <div class="container-fluid p-4">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="xsrf-token" content="{{ csrf_token() }}">
        {{-- header --}}
        <div class="d-flex row justify-content-between align-items-center p-0">
            <div class="col-lg-7 col-xl-4 col-md-12 d-flex header-text align-items-center mb-4 ">Data Pelanggan</div>
            <div
                class="col-lg-5 col-xl-5 col-md-12  d-flex justify-content-md-end  flex-md-row-reverse flex-lg-row justify-content-center align-items-center gap-4 mb-4">
                <button type="button" class="btn btn-blue px-4 py-2 cursor-pointer" data-bs-toggle="modal"
                    data-bs-target="#modalTambahPelanggan">Tambah</button>
                {{-- search --}}
                <div class="input-group  custom-shadow bg-white rounded-pill align-items-center ">
                    <input type="text" class="form-control form-control-lg input-fields ps-4"
                        placeholder="Cari Pelanggan" name="search" id="searchInput">
                    <button class="btn bg-white btn-groups pe-4" type="button" id="searchButton"><span><i
                                class="fa-solid fa-magnifying-glass text-muted"></i></span></button>
                </div>
            </div>
        </div>

        {{-- table data pelanggan --}}
        @if ($customers->count())
            <main class="d-flex flex-column bg-white  table-responsive rounded-top">
                <table class="table table-borderless text-center">
                    <thead>
                        <tr>
                            <th class="col text-white">ID Pelanggan</th>
                            <th class="col text-white">Nama Pelanggan</th>
                            <th class="col text-white">Registrasi</th>
                            <th class="col text-white">HP</th>
                            <th class="col text-white">Alamat</th>
                            <th class="col text-white">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $DP)
                            <tr>
                                <td class="col pb-0 pt-3">{{ $DP->id }}</td>
                                <td class="col pb-0 pt-3 text-truncate text-capitalize">{{ $DP->name }}</td>
                                <td class="col pb-0 pt-3">{{ $DP->register_date = date('d/m/y') }} </td>
                                <td class="col pb-0 pt-3">{{ $DP->phone }}</td>
                                <td class="col pb-0 pt-3 text-truncate">{{ $DP->address }}</td>
                                <td class="col pb-0 pt-3"> <a href="{{ route('detailPelangganCs', ['id' => $DP->id]) }}"
                                        class="btn btn-sm rounded-2 px-lg-3  fw-medium  btn-detail text-center"
                                        style=" font-size:12px;">
                                        <span id="icon" class="fa-solid fa-circle-info"></span>
                                        <span id="text">Detail</span>
                                    </a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- pagination --}}
                <div class="d-flex justify-content-between mt-5 m-4">
                    <div class="">
                        <button class="btn btn-outline-success" disabled>Halaman {{ $customers->currentPage() }}</button>
                    </div>
                    {{ $customers->links() }}
                </div>
            </main>
    </div>
@else
    <p class="text-center fs-4 mt-3">Pelanggan tidak ditemukan .</p>
    @endif


    {{-- Modal add pelanggan --}}
    <div class="modal fade" id="modalTambahPelanggan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header border-bottom-0 m-3 py-0 ">
                    <h5 class="modal-title ms-auto">Tambah Data pelanggan</h5>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body m-3 mt-0 py-0">
                    <form id="formDataPelanggan" method="POST" action="{{ route('tambahPelangganCs') }}">
                        @csrf
                        {{-- <div class="mb-3 ">
                            <input type="hidden" id="cs_id" name="cs_id" value="1">
                        </div> --}}
                        {{-- <div class="mb-4 ">
                            <label for="IdPelanggan" class="form-label label-order mb-1" >ID Pelanggan</label>
                            <input type="text" class="form-control form-control-lg  input-custom shadow text-black" value="ID12345678" id="IdPelanggan"disabled  readonly>
                        </div> --}}

                        <div class="mb-4 ">
                            <label for="tanggalRegistrasi" class="form-label label-order mb-1">Tanggal Registrasi</label>
                            <input type="text" class="form-control form-control-lg  input-custom shadow"
                                id="tanggalRegistrasi" name="register_date" value="{{ date('Y-m-d') }}" required readonly>
                            <div class="invalid-feedback">
                                Masukkan tanggal registrasi
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="namaPelanggan" class="form-label label-order mb-1">Nama Pelanggan</label>
                            <input type="text" name="name" class="form-control form-control-lg input-custom shadow"
                                id="namaPelanggan" required>
                            <div class="invalid-feedback">
                                Masukkan nama pelanggan
                            </div>
                        </div>


                        <div class="d-flex row">
                            <div class="col-md-6 mb-2" id="tambah-hp-1">
                                <label for="hp" class="form-label label-order mb-1">HP 1</label>
                                <input type="telp" name="phone" minlength="10" maxlength="13"
                                    class="form-control form-control-lg  input-custom shadow " id="hp"
                                    oninput="this.value = this.value.replace(/\D/g, '')" required>
                            </div>
                            <div class="col-md-6 mb-4 " id="tambah-hp-2">
                                <label for="hp2" class="form-label label-order mb-1">HP 2 (Optional) </label>
                                <input type="telp" name="phone2" minlength="10" maxlength="13"
                                    class="form-control form-control-lg  input-custom shadow " id="hp2"
                                    oninput="this.value = this.value.replace(/\D/g, '')">
                            </div>
                        </div>

                        <div class="mb-4 ">
                            <label for="email" class="form-label label-order mb-1">Email Pelanggan</label>
                            <input type="email" name="email"
                                class="form-control form-control-lg  input-custom shadow" id="email" required>
                            <div class="invalid-feedback">
                                Masukkan email pelanggan
                            </div>
                        </div>

                        <div class="mb-4 ">
                            <label for="alamat" class="form-label label-order mb-1">Alamat</label>
                            <textarea type="text" name="address" class="form-control form-control-lg  input-custom shadow " id="alamat"
                                rows="3" required></textarea>
                            <div class="invalid-feedback">
                                Masukkan alamat
                            </div>
                        </div>

                        <div class="row d-flex">
                            <div class="col-md-6 mb-4">
                                <label for="provinsi" class="form-label label-order mb-1">Provinsi</label>
                                <select class="form-select form-select-lg  shadow" id="provinsi"
                                    onchange="loadKabupaten()" required>
                                    <option value="">Pilih Provinsi</option>
                                </select>
                                <div class="invalid-feedback">
                                    Masukkan provinsi
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="kota" class="form-label label-order mb-1">Kab / kota</label>
                                <select class="form-select form-select-lg  shadow" id="kota"
                                    onchange="loadKecamatan()" required>
                                    <option value="">Pilih Kab/Kota</option>
                                </select>
                                <div class="invalid-feedback">
                                    Masukkan kota
                                </div>
                            </div>
                        </div>

                        <div class="row d-flex mb-4">
                            <div class="col-md-6">
                                <label for="kecamatan" class="form-label label-order mb-1">Kecamatan</label>
                                <select class="form-select form-select-lg  shadow" id="kecamatan" required>
                                    <option value="">Pilih Kecamatan</option>
                                </select>
                                <div class="invalid-feedback">
                                    Masukkan kecamatan
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <label for="kodepos" class="form-label label-order mb-1">Kode Pos </label>
                                <input type="number" class="form-control form-control-lg  input-custom shadow "
                                    name="kodepos" maxlength="5" id="kodepos" required>
                                <div class="invalid-feedback">
                                    Masukkan kodepos
                                </div>
                            </div>
                        </div>
                        <div class="mb-4 ">
                            <input type="hidden" id="namaProvinsi" name="provinsi">
                            <input type="hidden" id="namaKabupaten" name="kabupaten">
                            <input type="hidden" id="namaKecamatan" name="kecamatan">
                        </div>
                        <div class="d-flex justify-content-between align-items-center my-3 ">
                            <button type="button" class="btn btn-grey py-2  px-5" data-bs-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-blue px-5 py-2" data-bs-dismiss="modal"
                                onclick="tambahPelanggan()">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<section>
    @include('partials.modal')
</section>

@endsection

@section('js')
    {{-- script form daerah --}}
    <script>
        // Fungsi untuk memuat daftar provinsi
        function loadProvinsi() {
            var provinsiSelect = document.getElementById("provinsi");
            provinsiSelect.innerHTML = '<option value="">Pilih Provinsi</option>';

            fetch('https://dev.farizdotid.com/api/daerahindonesia/provinsi')
                .then(response => response.json())
                .then(data => {
                    data.provinsi.forEach(provinsi => {
                        var option = document.createElement('option');
                        option.value = provinsi.id;
                        option.text = provinsi.nama;
                        provinsiSelect.add(option);
                    });
                });
        }

        // Fungsi untuk memuat daftar kabupaten/kota berdasarkan provinsi yang dipilih
        function loadKabupaten() {
            var kabupatenSelect = document.getElementById("kota");
            kabupatenSelect.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>';

            // Menetapkan teks pilihan provinsi ke input tersembunyi
            var selectedProvinsiText = document.getElementById("provinsi").options[document.getElementById("provinsi")
                .selectedIndex].text;
            document.getElementById("namaProvinsi").value = selectedProvinsiText;

            var selectedProvinsi = document.getElementById("provinsi").value;
            if (selectedProvinsi) {
                fetch(`https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi=${selectedProvinsi}`)
                    .then(response => response.json())
                    .then(data => {
                        data.kota_kabupaten.forEach(kabupaten => {
                            var option = document.createElement('option');
                            option.value = kabupaten.id;
                            option.text = kabupaten.nama;
                            kabupatenSelect.add(option);
                        });
                    });
            }
        }

        // Fungsi untuk memuat daftar kecamatan berdasarkan kabupaten/kota yang dipilih
        function loadKecamatan() {
            var kecamatanSelect = document.getElementById("kecamatan");
            kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';

            // Menetapkan teks pilihan kabupaten/kota ke input tersembunyi
            var selectedKabupatenText = document.getElementById("kota").options[document.getElementById("kota")
                .selectedIndex].text;
            document.getElementById("namaKabupaten").value = selectedKabupatenText;

            var selectedKota = document.getElementById("kota").value;
            if (selectedKota) {
                fetch(`https://dev.farizdotid.com/api/daerahindonesia/kecamatan?id_kota=${selectedKota}`)
                    .then(response => response.json())
                    .then(data => {
                        data.kecamatan.forEach(kecamatan => {
                            var option = document.createElement('option');
                            option.value = kecamatan.id;
                            option.text = kecamatan.nama;
                            kecamatanSelect.add(option);
                        });
                    });
            }
        }

        // Menambahkan event listener untuk menetapkan teks pilihan kecamatan ke input tersembunyi ketika pilihan kecamatan berubah
        document.getElementById("kecamatan").addEventListener("change", function() {
            var selectedKecamatanText = this.options[this.selectedIndex].text;
            document.getElementById("namaKecamatan").value = selectedKecamatanText;
        });

        // Memuat daftar provinsi ketika halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            loadProvinsi();
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#jenisPelanggan').change(function() {
                // Mengambil teks dari opsi yang dipilih
                var selectedText = $(this).find('option:selected').text();
                // Menyimpan teks ke dalam input tersembunyi
                $('#jenisPelangganTeks').val(selectedText);
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const searchParam = urlParams.get('search');

    // Menambahkan event listener pada tombol pencarian
    const searchInput = document.querySelector('input[name="search"]');
    searchInput.value = searchParam || '';

    searchInput.addEventListener('input', function(event) {
        event.preventDefault();

        // Mengambil nilai pencarian dari input
        const searchValue = this.value.trim();

        // Mendapatkan URL saat ini tanpa parameter pencarian
        let currentUrl = window.location.origin + window.location.pathname;

        // Menambahkan parameter pencarian jika nilai pencarian tidak kosong
        if (searchValue !== '') {
            currentUrl += '?search=' + encodeURIComponent(searchValue);
        }

        // Mengarahkan pengguna ke URL yang diperbarui
        window.location.href = currentUrl;
    });

    // Menghapus parameter pencarian jika input pencarian kosong saat blur
    searchInput.addEventListener('blur', function() {
        if (this.value.trim() === '') {
            const currentUrl = window.location.origin + window.location.pathname;
            window.location.href = currentUrl;
        }
    });
});


        function showSuksesModalPelanggan() {
            $('#suksesModalTambah').modal('show');
            setTimeout(function() {
                $('#suksesModalTambah').modal('hide');
            }, 1500);
        }

        function showErorModalPelanggan() {
            $('#erorModalTambah').modal('show');
            setTimeout(function() {
                $('#erorModalTambah').modal('hide');
            }, 1500);
        }

function tambahPelanggan() {
 const inputNamaPelanggan = document.getElementById('namaPelanggan');
 const inputNoHp = document.getElementById('hp');
 const inputEmail = document.getElementById('email');
 const inputAlamat = document.getElementById('alamat');
 const inputProv = document.getElementById('provinsi');
 const inputKota = document.getElementById('kota');
 const inputKec = document.getElementById('kecamatan');
 const inputKodePos = document.getElementById('kodepos');

 const namaPelangganValue = inputNamaPelanggan.value.trim();
 const hpValue = inputNoHp.value.trim();
 const emailValue = inputEmail.value.trim();
 const alamatValue = inputAlamat.value.trim();
 const provValue = inputProv.value.trim();
 const kotaValue = inputKota.value.trim();
 const kecValue = inputKec.value.trim();
 const kodePosValue = inputKodePos.value.trim();
        
        if (!namaPelangganValue || !hpValue || !emailValue || !alamatValue || !provValue || !kotaValue || !kecValue || !kodePosValue) {

        if (!namaPelangganValue) {
            inputNamaPelanggan.classList.add('is-invalid');
        }
        if (!hpValue) {
            inputNoHp.classList.add('is-invalid');
        }
        if (!emailValue) {
            inputEmail.classList.add('is-invalid');
        }
        if (!alamatValue) {
            inputAlamat.classList.add('is-invalid');
        }
        if (!provValue) {
            inputProv.classList.add('is-invalid');
        }
        if (!kotaValue) {
            inputKota.classList.add('is-invalid');
        }
        if (!kecValue) {
            inputKec.classList.add('is-invalid');
        }
        if (!kodePosValue) {
            inputKodePos.classList.add('is-invalid');
        }
        showErorModalPelanggan();
        return;
    }

    const formnya = document.getElementById('formDataPelanggan');
    if (!formnya.checkValidity()) {
        showErorModalPelanggan();
        return false;
    } else {
        inputNamaPelanggan.classList.remove('is-invalid');
        inputNoHp.classList.remove('is-invalid');
        inputEmail.classList.remove('is-invalid');
        inputAlamat.classList.remove('is-invalid');
        inputProv.classList.remove('is-invalid');
        inputKota.classList.remove('is-invalid');
        inputKec.classList.remove('is-invalid');
        inputKodePos.classList.remove('is-invalid');

        // Menyembunyikan modal error jika sebelumnya ditampilkan
        $('#erorModalTambah').modal('hide');

        // Menampilkan modal sukses dan mengirim form
        $('#suksesModalTambah').modal('show');
        formnya.submit();
    }
        }

        // JavaScript to retrieve the value from localStorage and display it
        document.addEventListener('DOMContentLoaded', function() {
            // Retrieve the user ID from sessionStorage
            var userId = localStorage.getItem('user_id');

            // Select the cs_id input element
            var csIdInput = document.getElementById('cs_id');

            // Set the value of the cs_id input to the user ID from sessionStorage
            if (userId && csIdInput) {
                csIdInput.value = userId;
            }
        });
        var userId = localStorage.getItem('user_id');
        $.ajax({
            url: 'http://127.0.0.1:8000/dataPelanggan', // The URL of your Laravel route
            method: 'GET',
            data: {
                user_id: userId // Send the user ID as part of the request data
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token for Laravel
            },
            success: function(response) {
                // Handle the response from the server
            },
            error: function(xhr, status, error) {
                // Handle errors
            }
        });
    </script>
@endsection
