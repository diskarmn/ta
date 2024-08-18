@extends('layouts.mainA')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/data-pelanggan.css') }}">
@endsection

@section('konten')
    <div class="container-fluid p-4">

        {{-- header konten --}}
            <div class="d-flex justify-content-center" style="background-color: #202B46;">
                <div class="col-xl-9  col-lg-10 col-md-11  mb-2 mt-5 bg-white border rounded">
                    <div class="d-flex justify-content-start align-items-center">
                        <div class="col-2 d-flex justify-content-center ps-3" style="min-width: 120px">
                            <img src="{{ asset('assets/img/Avatar-image.png') }}" alt="" width="100px"
                                height="120px" style="border-radius: 8px;">
                        </div>
                        <div class="col p-0 text-start my-3 px-3">
                            <p class="mb-1 h5  text-capitalize" style="font-size: 28px; color:#41404C;">{{ $detailData->name }}
                            </p>
                            <p class="mb-0 fw-light" style="font-size: 22px;  color:#5C6B82;">{{ $detailData->id }}</p>
                            <p class="mb-0 fs-6" style=" color:#5C6B82;"><span class="fs-6"
                                    style="color:#41404C; white-space:pre;">Hp 1 : </span> {{ $detailData->phone }}</p>
                            {{-- spasi sengaja diberikan --}}
                            <p class="mb-0 fs-6" style=" color:#5C6B82;"><span class="fs-6"
                                    style="color:#41404C; white-space:pre;">Hp 2 : </span> {{ $detailData->phone2 }}</p>
                            {{-- ganti dengan data tanpa menghapus spasi --}}
                            <p class="mb-0 fs-6" style=" color:#5C6B82; white-space:nowrap;"><span class="fs-6"
                                    style="color:#41404C; white-space:pre;">Email : </span> {{ $detailData->email }}</p>
                        </div>
                        <div class="col text-start align-self-start mt-3 px-3"style="max-width: 230px;">
                            <p class="mb-0 fs-4 ">Tgl. bergabung</p>
                            <p class="my-2" style="font-size: 22px; font-weight:300; color:#666666;">
                                {{ $detailData->register_date }}</p>
                            <span>
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M16 16C16 14.895 12.866 14 9 14M16 16C16 17.105 12.866 18 9 18C5.134 18 2 17.105 2 16M16 16V20.937C16 22.076 12.866 23 9 23C5.134 23 2 22.077 2 20.937V16M16 16C19.824 16 23 15.013 23 14V4M9 14C5.134 14 2 14.895 2 16M9 14C4.582 14 1 13.013 1 12V7M9 5C4.582 5 1 5.895 1 7M1 7C1 8.105 4.582 9 9 9C9 10.013 12.253 11 16.077 11C19.9 11 23 10.013 23 9M23 4C23 2.895 19.9 2 16.077 2C12.253 2 9.154 2.895 9.154 4M23 4C23 5.105 19.9 6 16.077 6C12.254 6 9.154 5.105 9.154 4M9.154 4V14.166"
                                        stroke="#D8CF06" stroke-width="2" />
                                </svg>
                                <p class="m-0 d-inline fw-semibold" style="color:#D8CF06;">{{ $detailData->point }}</p>
                            </span>

                        </div>
                    </div>
                </div>
            </div>

            {{-- isi konten --}}
            <div class="d-flex justify-content-center bg-white">
                <div class=" d-flex  gap-4 flex-column col-xl-9 col-lg-10 col-md-11 bg-white border rounded mt-2 p-4">
                    <div class="d-flex gap-4 align-items-center ">
                        <a class="text-decoration-none" href="{{ route('dataPelangganAdmin') }}"><i
                                class="fa-solid fa-arrow-left fs-4 color-title mb-0"></i></a><span
                            class=" h4 color-title mb-0">Detail pelanggan</span>
                    </div>
                    <div class="d-flex flex-row justify-content-center px-lg-4 px-md-0 ">
                        <!-- Layout Kiri -->
                        <div class="col-6">
                            <div class="d-flex flex-row mb-4">
                                <div class="col-6 px-2">
                                    <p class="mb-2 color-title h4">Provinsi</p>
                                    <p class="fs-5 fw-light text-wrap mb-0">{{ $detailData->provinsi }}</p>
                                </div>
                                <div class="col-6 px-2">
                                    <p class="mb-2 color-title h4">Kab/Kota</p>
                                    <p class="fs-5 fw-light text-wrap mb-0">{{ $detailData->kabupaten }}</p>
                                </div>
                            </div>
                            <div class="d-flex flex-row mb-4">
                                <div class="col-6 px-2">
                                    <p class="mb-2 color-title h4">Kecamatan</p>
                                    <p class="fs-5 fw-light text-wrap mb-0">{{ $detailData->kecamatan }}</p>
                                </div>
                                <div class="col-6 px-2">
                                    <p class="mb-2 color-title h4">Kode Pos</p>
                                    <p class="fs-5 fw-light text-wrap mb-0">{{ $detailData->kodepos }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Layout Kanan -->
                        <div class="col-6 px-2">
                            <p class="mb-2 color-title h4">Alamat</p>
                            <p class="fs-5 fw-light text-wrap mb-0">{{ $detailData->address }}</p>
                        </div>
                    </div>
                </div>
            </div>
          

    </div>
    {{-- modal edit pelanggan --}}
        <div class="modal fade" id="modalEdit{{ $detailData->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0 m-3 py-0">
                        <h5 class="modal-title ms-auto ">Detail data pelanggan</h5>
                        {{-- <button type="button" class="btn-close ms-auto " data-bs-dismiss="modal" aria-label="Close"></button> --}}
                    </div>
                    <div class="modal-body m-3 mt-0 py-0">
                        <form action="{{ route('editPelangganAdmin', $detailData->id) }}" method="POST" id="editFormPelanggan">
                            @csrf
                            @method('PUT')
                            {{-- <div class="mb-4 ">
                                <label for="IdPelanggan" class="form-label label-order mb-1">ID Pelanggan</label>
                                <input type="text" class="form-control form-control-lg  input-custom shadow text-black"
                                    value="ID12345678" id="IdPelanggan"disabled readonly>
                            </div> --}}

                            <div class="mb-4 ">
                                <label for="tanggalRegistrasi" class="form-label label-order mb-1">Tanggal Registrasi</label>
                                <input type="text" class="form-control form-control-lg  input-custom shadow" id="tanggalRegistrasi" name="register_date" value="{{ date('Y-m-d') }}" required readonly>
                                <div class="invalid-feedback">
                                    Masukkan tanggal registrasi
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="namaPelanggan" class="form-label label-order mb-1">Nama Pelanggan</label>
                                <input type="text" name="name" value="{{ $detailData->name }}" class="form-control form-control-lg input-custom shadow" id="namaPelanggan">
                                <div class="invalid-feedback">
                                    Masukkan nama pelanggan
                                </div>
                            </div>


                            <div class="d-flex row">
                                <div class="col-md-6 mb-2" id="tambah-hp-1">
                                    <label for="hp" class="form-label label-order mb-1">HP 1</label>
                                    <input type="telp" name="phone" value="{{ $detailData->phone }}" minlength="10" maxlength="13" class="form-control form-control-lg  input-custom shadow " id="hp" oninput="this.value = this.value.replace(/\D/g, '')" required>
                                </div>
                                <div class="col-md-6 mb-4 " id="tambah-hp-2">
                                    <label for="hp2" class="form-label label-order mb-1">HP 2 (Optional) </label>
                                    <input type="telp" name="phone2" value="{{ $detailData->phone2 }}" minlength="10" maxlength="13" class="form-control form-control-lg  input-custom shadow " id="hp2" oninput="this.value = this.value.replace(/\D/g, '')">
                                </div>
                            </div>

                            <div class="mb-4 ">
                                <label for="email" class="form-label label-order mb-1">Email Pelanggan</label>
                                <input type="email" name="email" value="{{ $detailData->email }}" class="form-control form-control-lg  input-custom shadow" id="email" required>
                                <div class="invalid-feedback">
                                    Masukkan email pelanggan
                                </div>
                            </div>

                            <div class="mb-4 ">
                                <label for="alamat" class="form-label label-order mb-1">Alamat</label>
                                <textarea type="text" name="address" class="form-control form-control-lg  input-custom shadow " id="alamat" rows="3" required>{{ $detailData->address }}</textarea>
                                <div class="invalid-feedback">
                                    Masukkan alamat
                                </div>
                            </div>

                            <div class="row d-flex">
                                <div class="col-md-6 mb-4">
                                    <label for="provinsi" class="form-label label-order mb-1">Provinsi</label>
                                    <select class="form-select form-select-lg shadow" id="provinsi" onchange="loadKabupaten()" required>
                                        <option value="{{ $detailData->provinsi }}" selected>{{ $detailData->provinsi }}</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Masukkan provinsi
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="kota" class="form-label label-order mb-1">Kab / kota</label>
                                    <select class="form-select form-select-lg  shadow" id="kota" onchange="loadKecamatan()" required>
                                        <option value="{{ $detailData->kabupaten }}" selected>{{ $detailData->kabupaten }}</option>
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
                                        <option value="{{ $detailData->kecamatan }}" selected>{{ $detailData->kecamatan }}</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Masukkan kecamatan
                                    </div>
                                </div>
                                <div class="col-md-6 ">
                                    <label for="kodepos" class="form-label label-order mb-1">Kode Pos </label>
                                    <input type="number" class="form-control form-control-lg  input-custom shadow " value="{{ $detailData->kodepos }}" name="kodepos" maxlength="5" id="kodepos" required>
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
                                <button type="button" class="btn btn-blue px-5 py-2" data-bs-dismiss="modal" onclick="editPelanggan()">Simpan</button>
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
    {{-- script menampilkan action dari submit button --}}
    <script>
        function showSuksesModalPelanggan() {
            $('#suksesModalEdit').modal('show');
            setTimeout(function() {
                $('#suksesModalEdit').modal('hide');
            }, 1500);

        }

        function showErorModalPelanggan() {
            $('#erorModalEdit').modal('show');
            setTimeout(function() {
                $('#erorModalEdit').modal('hide');
            }, 1500);
        }

        function editPelanggan() {
            // Logika untuk menambah toko manual
            const formnya = document.getElementById('editFormPelanggan');
            if (!formnya.checkValidity()) {
                showErorModal();
                return false;
            } else {
                formnya.submit();
                showSuksesModal();
            }
        }
    </script>
    <script>
        // Fungsi untuk memuat daftar provinsi
         function loadProvinsi() {
    var provinsiSelect = document.getElementById("provinsi");
    provinsiSelect.innerHTML = ''; // Mengosongkan options sebelum menambahkan yang baru

    // Mengambil data provinsi dari API
    fetch('https://dev.farizdotid.com/api/daerahindonesia/provinsi')
        .then(response => response.json())
        .then(data => {
            data.provinsi.forEach(provinsi => {
                var option = document.createElement('option');
                option.value = provinsi.id; // Menggunakan nama provinsi sebagai nilai option
                option.text = provinsi.nama;
                provinsiSelect.add(option);

                // Menandai option sebagai selected jika nama provinsi sama dengan $detailData->provinsi
                if (provinsi.nama === "{{ $detailData->provinsi }}") {
                    option.selected = true;
                }
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
    // Menyimpan nama awal dari select provinsi, kabupaten, dan kecamatan saat halaman dimuat
    var provinsiName = "{{ $detailData->provinsi }}";
    var kabupatenName = "{{ $detailData->kabupaten }}";
    var kecamatanName = "{{ $detailData->kecamatan }}";

    // Fungsi untuk menyimpan nama ke input tersembunyi
    function saveToHiddenInput(name, hiddenInputId) {
        $(hiddenInputId).val(name);
    }

    // Menyimpan nama awal ke dalam input tersembunyi saat halaman dimuat
    saveToHiddenInput(provinsiName, '#namaProvinsi');
    saveToHiddenInput(kabupatenName, '#namaKabupaten');
    saveToHiddenInput(kecamatanName, '#namaKecamatan');

    // Menangani perubahan pada select dengan id "provinsi"
    $('#provinsi').change(function() {
        // Mengambil nama dari opsi yang dipilih
        var selectedName = $(this).find('option:selected').text();
        // Menyimpan nama ke dalam input tersembunyi
        saveToHiddenInput(selectedName, '#namaProvinsi');
    });

    // Menangani perubahan pada select dengan id "kota"
    $('#kota').change(function() {
        // Mengambil nama dari opsi yang dipilih
        var selectedName = $(this).find('option:selected').text();
        // Menyimpan nama ke dalam input tersembunyi
        saveToHiddenInput(selectedName, '#namaKabupaten');
    });

    // Menangani perubahan pada select dengan id "kecamatan"
    $('#kecamatan').change(function() {
        // Mengambil nama dari opsi yang dipilih
        var selectedName = $(this).find('option:selected').text();
        // Menyimpan nama ke dalam input tersembunyi
        saveToHiddenInput(selectedName, '#namaKecamatan');
    });
});

    </script>
@endsection
