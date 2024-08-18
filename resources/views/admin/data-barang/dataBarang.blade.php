@extends('layouts.mainA')

@section('css')
    <link rel="stylesheet" href="/assets/css/data-barang.css">
@endsection

@section('konten')
    <section class="container-fluid p-4">
        {{-- header --}}
        <div class="d-flex row  justify-content-between align-items-center  p-0">
            <div class="col-lg-7 col-xl-4 col-md-12 d-flex header-text align-items-center mb-4 ">Data Barang</div>
            <div
                class="col-lg-5 col-xl-5 col-md-12  d-flex justify-content-md-end  flex-md-row-reverse flex-lg-row  justify-content-center align-items-center gap-4 mb-4 ">
                <button type="button" class="btn btn-blue px-4 py-2" data-bs-toggle="modal"
                    data-bs-target="#tambahBarangModal">Tambah</button>


            </div>
        </div>

        @if ($data_barang->count())
            <article class="d-flex flex-column rounded-top my-3 bg-white overflow-hidden ">
                <div class="table-responsive">
                    <table class="table table-borderless text-center ">
                        <thead class="text-center mb-2">
                            <tr>
                                <th class="text-white col">Kode Produk</th>
                                <th class="text-white col">Nama</th>
                                <th class="text-white col">Size</th>
                                <th class="text-white col">Harga Satuan</th>
                                <th class="text-white col">Stok</th>
                                <th class="text-white col">Gambar</th>
                                <th class="text-white col">Video</th>
                                <th class="text-white col">Opsi</th>

                            </tr>
                        </thead>
                        <tbody class="text-center w-100 ">
                            @foreach ($data_barang as $data_brg)
                                <tr>
                                    <td class="pb-0 pt-3">{{ $data_brg->kd_produk }}</td>
                                    <td class="pb-0 pt-3">{{ $data_brg->nama }}</td>
                                    <td class="pb-0 pt-3">{{ $data_brg->size }}</td>
                                    <td class="pb-0 pt-3">Rp {{ $data_brg->harga_satuan }}</td>
                                    <td class="pb-0 pt-3">{{ $data_brg->stock }}</td>
                                    <td class="pb-0 pt-3 text-truncate"><a href="#">{{ $data_brg->img }}</a></td>
                                    <td class="pb-0 pt-3 text-truncate"><a href="#">{{ $data_brg->video }}</a></td>
                                    {{-- <td class="pb-0 pt-3">{{ $data_brg->point }}</td> --}}
                                    <td class="pb-0 pt-3 d-flex flex-column justify-content-evenly gap-md-2 mx-auto">
                                        <button class="btn btn-sm btn-orange px-lg-4 text-center rounded-2 fw-medium"
                                            data-bs-toggle="modal" data-bs-target="#editBarangModal{{ $data_brg->id }}"
                                            onclick="changeURLAndShowModal({{ $data_brg->id }})" style="font-size: 12px;">
                                            <span id="icon" class="fa-solid fa-pen"></span>
                                            <span id="text">Edit</span>
                                        </button>
                                        <button class="btn btn-sm btn-primary px-lg-4 text-center rounded-2 fw-medium"
                                            data-bs-toggle="modal" data-bs-target="#stock{{ $data_brg->id }}"
                                            onclick="changeURLAndShowModal({{ $data_brg->id }})" style="font-size: 12px;">
                                            <span id="icon" class="fa-solid fa-plus"></span>
                                            <span id="text">Tambah Stock</span>
                                        </button>

                                        <button class="btn btn-sm btn-red px-lg-3 text-center rounded-2 fw-medium"
                                            style="font-size: 12px;" data-bs-toggle="modal"
                                            data-bs-target="#deleteBarangModal{{ $data_brg->id }}"
                                            data-id="{{ $data_brg->id }}" onclick="deleteModal({{ $data_brg->id }})">
                                            <span id="icon" class="fa-solid fa-trash"></span>
                                            <span id="text">Hapus</span>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- pagination --}}
                <nav aria-label="Page navigation example" class="d-flex justify-content-between m-4 mt-5 bg-white">
                    <p class="border border-secondary text-secondary rounded px-3 py-1">Halaman
                        {{ $data_barang->currentPage() }}</p>
                    <ul class="pagination">
                        @if ($data_barang->onFirstPage())
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $data_barang->previousPageUrl() }}"
                                    tabindex="-1">Previous</a>
                            </li>
                        @endif

                        @for ($i = 1; $i <= $data_barang->lastPage(); $i++)
                            @if ($i == $data_barang->currentPage())
                                <li class="page-item active">
                                    <a class="page-link" href="#">{{ $i }}</a>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $data_barang->url($i) }}">{{ $i }}</a>
                                </li>
                            @endif
                        @endfor

                        @if ($data_barang->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $data_barang->nextPageUrl() }}">Next</a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        @endif
                    </ul>
                </nav>
            </article>

    </section>
        @else
    <p class="text-center fs-4 mt-3">Barang tidak ditemukan .</p>
        @endif
    {{-- Modal Tambah Barang --}}
    <div class="modal fade" id="tambahBarangModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-bottom-0 m-3 py-0 ">
                    <h5 class="modal-title ms-auto">Tambah Data Barang</h5>
                    {{-- <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                <div class="modal-body m-3 mt-0 pt-0 pb-3">
                    <form method="POST" id="tambahForm" action="{{ route('addbarang') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="kd-produk" class="form-label label-order mb-1">Kode Produk</label>
                            <input type="text"
                                class="form-control shadow form-control-lg   @error('kd_produk') is-invalid @enderror"
                                id="kd-produk" name="kd_produk" placeholder="Kode Produk" autofocus
                                value="{{ old('kd_produk') }}">

                        </div>
                        <div class="mb-4">
                            <label for="nama-produk" class="form-label label-order mb-1">Nama Produk</label>
                            <input type="text"
                                class="form-control shadow form-control-lg   @error('nama') is-invalid @enderror"
                                id="nama" name="nama" placeholder="Nama Produk" value="{{ old('nama') }}"
                                required>

                        </div>
                        <div class="d-flex row gap-0  justify-content-around mb-4">
                            <div class="col-lg-3 col-md-4 ">
                                <label for="ukuran" class="form-label label-order mb-1">Ukuran</label>
                                <select class="form-select form-select-lg  shadow" id="ukuran" name="size">
                                    <option selected disabled>Pilih Ukuran</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                    <option value="XXL">XXL</option>

                                </select>
                            </div>
                            <div class="col-lg-3 col-md-4 ">
                                <label for="harga" class="form-label label-order mb-1">Harga</label>
                                <input type="number"
                                    class="form-control shadow form-control-lg   @error('harga_satuan') is-invalid @enderror"
                                    id="harga" name="harga_satuan" value="{{ old('harga_satuan') }}">

                            </div>
                            <div class="col-lg-3 col-md-4 ">
                                <label for="stok" class="form-label label-order mb-1">Stok</label>
                                <input type="number"
                                    class="form-control shadow form-control-lg   @error('stock') is-invalid @enderror"
                                    id="stock" name="stock" value="{{ old('stock') }}">

                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="gambar" class="form-label label-order mb-1">Gambar</label>
                            <input type="text" class="form-control shadow form-control-lg  " id="gambar"
                                placeholder="Link Google Drive" name="img">
                        </div>
                        <div class="mb-4">
                            <label for="video" class="form-label label-order mb-1">Video</label>
                            <input type="text" class="form-control shadow form-control-lg  " id="video"
                                placeholder="Link Google Drive" name="video">
                        </div>
                        <div class="mb-5 col-lg-3">

                        </div>
                        <div class="d-flex gap-4 justify-content-md-between ">
                            <button type="button" class="btn btn-grey py-2  px-5" data-bs-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-blue px-5 py-2"
                                onclick="tambahBarang()">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    {{-- Modal Edit Barang --}}
    @foreach ($data_barang as $data)
        <div class="modal fade" id="editBarangModal{{ $data->id }}" tabindex="-1" aria-labelledby="editModalLabel"
            aria-hidden="true">

            <div class="modal-dialog modal-lg" id="isikan-form">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0 m-3 py-0 ">
                        <h5 class="modal-title ms-auto">Edit Data Barang</h5>

                    </div>

                    <div class="modal-body m-3 mt-0 pt-0 pb-3">
                        <form id="updateForm" action="{{ url('/cs/dataBarang/update/' . $data->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label for="kd-produk" class="form-label label-order mb-1">Kode
                                    Produk</label>
                                <input type="text"
                                    class="form-control form-control-lg  shadow @error('kd_produk') is-invalid @enderror"
                                    id="edit-kd-produk" name="kd_produk" placeholder="Kode Produk"
                                    value="{{ $data->kd_produk }}" readonly>
                                @error('kd_produk')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="nama-produk" class="form-label label-order mb-1">Nama
                                    Produk</label>
                                <input type="text"
                                    class="form-control form-control-lg  shadow @error('nama') is-invalid @enderror"
                                    id="edit-nama-produk" name="nama" placeholder="Nama Produk"
                                    value="{{ $data->nama }}" autofocus>
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="d-flex row gap-4 justify-content-between mb-4">
                                <div class=" col-lg-3 col-md-12 ">
                                    <label for="ukuran" class="form-label label-order mb-1">Ukuran</label>
                                    <select class="form-select form-select-lg  shadow" id="ukuran"
                                        value='{{ $data->size }}' name="size">
                                        <option selected> {{ $data->size }}</option>
                                        <option value="S">S</option>
                                        <option value="M">M</option>
                                        <option value="L">L</option>
                                        <option value="XL">XL</option>
                                        <option value="XXL">XXL</option>

                                    </select>
                                </div>
                                <div class=" col-lg-3 col-md-12 ">
                                    <label for="harga" class="form-label label-order mb-1">Harga</label>
                                    <input type="number"
                                        class="form-control form-control-lg  shadow @error('harga_satuan') is-invalid @enderror"
                                        id="edit-harga" name="harga_satuan" value="{{ $data->harga_satuan }}">
                                    @error('harga_satuan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class=" col-lg-3 col-md-12 ">
                                    <label for="stok" class="form-label label-order mb-1">Stok</label>
                                    <input type="number"
                                        class="form-control form-control-lg  shadow @error('stock') is-invalid @enderror"
                                        id="edit-stok" name="stock" value="{{ $data->stock }}">
                                    @error('stock')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="gambar" class="form-label label-order mb-1">Gambar</label>
                                <input type="text" class="form-control form-control-lg  shadow" id="edit-gambar"
                                    placeholder="Link Google Drive" name="img" value="{{ $data->img }}">
                            </div>
                            <div class="mb-4">
                                <label for="video" class="form-label label-order mb-1">Video</label>
                                <input type="text" class="form-control form-control-lg  shadow" id="edit-video"
                                    placeholder="Link Google Drive" name="video" value="{{ $data->video }}">
                            </div>

                            <div class="d-flex gap-4 justify-content-md-between ">
                                <button type="button" class="btn btn-grey py-2  px-5" data-bs-dismiss="modal"
                                    onclick="backTo()">Batal</button>
                                <button type="submit" class="btn btn-blue px-5 py-2">Edit</button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    @endforeach
    {{-- Modal stock Barang --}}
    @foreach ($data_barang as $data)
        <div class="modal fade" id="stock{{ $data->id }}" tabindex="-1" aria-labelledby="editModalLabel"
            aria-hidden="true">

            <div class="modal-dialog modal-lg" id="isikan-form">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-center">
                        <h5 class="modal-title text-center">Tambah stock {{ $data->nama }}</h5>

                    </div>

                    <div class="modal-body m-3 p-5">
                        <form id="updateForm" action="{{ url('/cs/dataBarang/stock/' . $data->id) }}" method="POST"
                            class=" d-flex justify-content-center">
                            @csrf
                            <div class=" col-lg-3 justify-content-center col-md-12 ">
                                <p>stock sekarang : {{ $data->stock }}</p>
                                <div class="d-flex flex-row align-items-center gap-2">
                                    <i class="fa-solid fa-plus"></i>
                                    <input type="number"
                                        class="form-control form-control-lg  shadow @error('stock') is-invalid @enderror"
                                        id="edit-stok" name="stock" value="">
                                    @error('stock')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                    </div>
                    <div class="d-flex col-12 p-5 justify-content-center gap-2  ">
                        <button type="button" class="btn btn-grey py-2  px-5" data-bs-dismiss="modal"
                            onclick="backTo()">Batal</button>
                        <button type="submit" class="btn btn-blue px-5 py-2">Tambah</button>
                    </div>
                    </form>

                </div>

            </div>
        </div>
        </div>
    @endforeach



    <!-- Modal Delete -->
    @foreach ($data_barang as $data)
        <div class="modal fade" id="deleteBarangModal{{ $data->id }}" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-md " role="document">
                <div class="modal-content ">
                    <div class="my-5">
                        <div class="d-flex flex-column justify-content-center ">
                            <img src="{{ asset('assets/img/confirm.png') }}" alt="" width="120px"
                                class="mx-auto">
                            <p class="fw-bold text-center my-3">Yakin Hapus Data ?</p>
                        </div>
                        <div class="d-flex justify-content-center gap-3">
                            <form id="deleteForm" action="{{ route('deleteBarangA', $data->id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-blue" id="btn-ya">Ya</button>
                            </form>
                            <button class="btn btn-red " data-bs-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <section>
        @include('partials.modal')
    </section>

    {{-- JavaScript untuk menampilkan data modal edit --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const searchParam = urlParams.get('search');
            const searchInput = document.querySelector('input[name="search"]');

            // Memasukkan nilai pencarian ke dalam input
            searchInput.value = searchParam || '';

            // Menambahkan event listener pada input pencarian
            searchInput.addEventListener('input', function(event) {
                event.preventDefault();

                // Memperbarui URL dengan parameter pencarian
                const currentUrl = new URL(window.location.href);
                currentUrl.searchParams.set('search', this.value);

                // Mengarahkan pengguna ke URL yang diperbarui
                window.location.href = currentUrl.toString();
            });

            // Menghapus parameter pencarian jika input pencarian kosong
            searchInput.addEventListener('blur', function(event) {
                event.preventDefault();
                if (this.value.trim() === '') {
                    const currentUrl = new URL(window.location.href);
                    currentUrl.searchParams.delete('search');
                    window.location.href = currentUrl.toString();
                }
            });

            const editBarangModal = document.getElementById('editBarangModal');
            const updateForm = document.getElementById('updateForm');

            editBarangModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const barangData = JSON.parse(button.getAttribute('data-barang'));

                // Set data barang ke dalam form edit
                document.getElementById('edit-id').value = barangData.id;
                document.getElementById('edit-kd-produk').value = barangData.kd_produk;
                document.getElementById('edit-nama-produk').value = barangData.nama;

                // Set dropdown value
                const dropdownBtn = document.getElementById('edit-ukuran');
                dropdownBtn.innerText = barangData.size;
                document.getElementById('hidden-edit-ukuran').value = barangData.size;

                // Set other input values
                document.getElementById('edit-harga').value = barangData.harga_satuan;
                document.getElementById('edit-stok').value = barangData.stock;
                document.getElementById('edit-gambar').value = barangData.img;
                document.getElementById('edit-video').value = barangData.video;
                document.getElementById('edit-point_produk').value = barangData.point;

                const buttonUpdate = event.relatedTarget;
                const idBarang = buttonUpdate.getAttribute('data-id');
                const actionUrl = "{{ route('barangs.update', ':id') }}".replace(':id', idBarang);

                updateForm.action = actionUrl;
            });

            // Handle dropdown selection
            const dropdownMenu = document.querySelectorAll('#edit-ukuran + .dropdown-menu a');
            dropdownMenu.forEach(item => {
                item.addEventListener('click', function() {
                    const selectedValue = this.getAttribute('data-value');
                    document.getElementById('edit-ukuran').innerText = selectedValue;
                    document.getElementById('hidden-edit-ukuran').value = selectedValue;
                });
            });

            const tambahDropdownMenu = document.querySelectorAll('#tambah-ukuran + .dropdown-menu a');
            tambahDropdownMenu.forEach(item => {
                item.addEventListener('click', function() {
                    const selectedValue = this.getAttribute('data-value');
                    document.getElementById('tambah-ukuran').innerText = selectedValue;
                    document.getElementById('hidden-tambah-ukuran').value = selectedValue;
                });
            });

            // Handle modal tambah shown event
            const tambahBarangModal = document.getElementById('tambahBarangModal');
            tambahBarangModal.addEventListener('show.bs.modal', function() {
                // Set default value for dropdown
                document.getElementById('tambah-ukuran').innerText = 'Pilih Ukuran';
            });

            const successMessage = document.querySelector('.session-card');

            if (successMessage) {
                setTimeout(function() {
                    successMessage.style.display = 'none';
                }, 2000);
            }

            const errorMessage = document.querySelector('.session-error');

            if (errorMessage) {
                setTimeout(function() {
                    errorMessage.style.display = 'none';
                }, 2000);
            }
        });
    </script>
    <script>
        function showSuksesModal() {
            $('#tambahBarangModal').modal('hide');
            $('#suksesModalTambah').modal('show');
            setTimeout(function() {
                $('#suksesModalTambah').modal('hide');
            }, 1500);
        }

        function showErorModal() {
            $('#tambahBarangModal').modal('hide');
            $('#erorModalTambah').modal('show');
            setTimeout(function() {
                $('#erorModalTambah').modal('hide');
            }, 1500);
        }

        function showSuksesModalEdit() {
            $('#editBarangModal').modal('hide');
            $('#suksesModalEdit').modal('show');
            setTimeout(function() {
                $('#suksesModalEdit').modal('hide');
            }, 1500);

        }

        function showErorModalEdit() {
            $('#editBarangModal').modal('hide');
            $('#erorModalEdit').modal('show');
            setTimeout(function() {
                $('#erorModalEdit').modal('hide');
            }, 1500);
        }

        function tambahBarang() {
            document.getElementById('tambahForm').submit();
            event.preventDefault();

            const inputKodeProduk = document.getElementById('kd-produk');
            const inputNamaProduk = document.getElementById('nama');
            const inputUkuran = document.getElementById('ukuran');
            const inputHarga = document.getElementById('harga');
            const inputStock = document.getElementById('stock');
            const inputGambar = document.getElementById('gambar');
            const inputVideo = document.getElementById('video');
            const inputPointProduk = document.getElementById('point_produk');

            const kodeProdukValue = inputKodeProduk.value.trim();
            const namaProdukValue = inputNamaProduk.value.trim();
            const ukuranValue = inputUkuran.value.trim();
            const hargaValue = inputHarga.value.trim();
            const stockValue = inputStock.value.trim();
            const gambarValue = inputGambar.value.trim();
            const videoValue = inputVideo.value.trim();
            const pointValue = inputPointProduk.value.trim();

            if (ukuranValue === 'Pilih Ukuran') {
                inputUkuran.classList.add('is-invalid');
            } else {
                inputUkuran.classList.remove('is-invalid');
            }

            if (!kodeProdukValue || !namaProdukValue || !ukuranValue || !hargaValue || !stockValue || !gambarValue || !
                videoValue || !pointValue) {
                if (!kodeProdukValue) {
                    inputKodeProduk.classList.add('is-invalid');
                } else {
                    inputKodeProduk.classList.remove('is-invalid');
                }
                if (!namaProdukValue) {
                    inputNamaProduk.classList.add('is-invalid');
                } else {
                    inputNamaProduk.classList.remove('is-invalid');
                }
                if (!hargaValue) {
                    inputHarga.classList.add('is-invalid');
                } else {
                    inputHarga.classList.remove('is-invalid');
                }
                if (!stockValue) {
                    inputStock.classList.add('is-invalid');
                } else {
                    inputStock.classList.remove('is-invalid');
                }
                if (!gambarValue) {
                    inputGambar.classList.add('is-invalid');
                } else {
                    inputGambar.classList.remove('is-invalid');
                }
                if (!videoValue) {
                    inputVideo.classList.add('is-invalid');
                } else {
                    inputVideo.classList.remove('is-invalid');
                }
                if (!pointValue) {
                    inputPointProduk.classList.add('is-invalid');
                } else {
                    inputPointProduk.classList.remove('is-invalid');
                }
                showErorModal();
                return;
            }

            const formnya = document.getElementById('tambahForm');
            if (!formnya.checkValidity()) {
                showErorModal();
                return false;
            } else {
                formnya.submit();
                showSuksesModal();
            }
        }

        function editBarang() {
            // Logika untuk menambah Barang
            var berhasil = true; // Ganti dengan logika sesuai kebutuhan

            if (berhasil) {
                showSuksesModalEdit();
            } else {
                showErorModalEdit();
            }
        }
    </script>

@endsection

@section('javascript')
    <script src="assets/js/modalTambahBarang.js"></script>
@endsection
