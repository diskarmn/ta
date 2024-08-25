@extends('layouts.mainSA')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/data-admin.css') }}">
@endsection

@section('konten')
    <div class="container-fluid p-4">

        {{-- header --}}
        <div class="d-flex justify-content-between align-items-center mb-4 p-0">
            <div class="col-lg-8 col-md-7 d-flex header-text align-items-center ">Data CEO</div>
            <div class="col-lg-4 col-md-5 d-flex  justify-content-end align-items-end gap-4 ">
                <a href="{{ route('addceo') }}" class="btn btn-lg btn-blue rounded-2 px-4 fs-6">Tambah</a>
                {{-- search --}}

            </div>
        </div>

        {{-- table data admin --}}
        <main class="d-flex flex-column  table-responsive rounded-top my-3 bg-white">
            <table class="table table-borderless text-center mb-2">
                <thead>
                    <tr>
                        <th class="col">ID CEO</th>
                        <th class="col">Nama CEO</th>
                        <th class="col">Email</th>
                        <th class="col">No Telepon</th>
                        <th class="col">Opsi</th>
                    </tr>
                </thead>
                <tbody id="tabel-body">
                    @if ($data_ceo->count())
                        @foreach ($data_ceo as $data)
                            <tr>
                                <td class="col pb-0 pt-3">{{ $loop->iteration }}</td>
                                <td class="col pb-0 pt-3 text-capitalize">{{ $data->name }}</td>

                                <td class="col pb-0 pt-3 text-truncate ">{{ $data->email }}</td>
                                <td class="col pb-0 pt-3 text-truncate ">{{ $data->phone_number }}</td>
                                <td class="col pb-0 pt-3">
                                    <div class="d-flex justify-content-center gap-lg-3 gap-md-1">
                                        <a class="btn btn-sm btn-orange px-lg-4 px-md-3  text-center rounded-2 fw-medium "
                                            style="font-size:12px;" data-bs-toggle="modal"
                                            data-bs-target="#edit{{ $data->id }}">Edit</a>

                                        <button class="btn btn-sm px-lg-3 px-md-2 btn-red text-center fw-medium rounded-2 "
                                            style="font-size:12px;" data-bs-target="#ModalDelete{{ $data->id }}"
                                            data-bs-toggle="modal" type="submit">Hapus</button>
                                </td>
                            </tr>

                            <!-- Modal Delete -->
                            <div class="modal fade" id="ModalDelete{{ $data->id }}" tabindex="-1" role="dialog">
                                <div class="modal-dialog modal-dialog-centered modal-md " role="document">
                                    <div class="modal-content ">
                                        <div class="my-5">
                                            <div class="d-flex flex-column justify-content-center ">
                                                <img src="{{ asset('assets/img/confirm.png') }}" alt=""
                                                    width="120px" class="mx-auto">
                                                <p class="fw-bold text-center my-3">Yakin Hapus Data ?</p>
                                            </div>
                                            <div class="d-flex justify-content-center gap-3">
                                                <form action="{{ route('deleteDataCSSuperAdmin', $data->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-blue" id="btn-ya" data-bs-dismiss="modal"
                                                        onclick="hapusCS()">Ya</button>
                                                </form>
                                                <button class="btn btn-red " data-bs-dismiss="modal">Batal</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center pt-4">Data ceo belum ada.</td>
                        </tr>
                    @endif

                </tbody>
            </table>


        </main>
    </div>

    @foreach ($data_ceo as $edit)
        <div class="modal fade" id="edit{{ $edit->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        yang mau di edit
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('editcs2', $data->id) }}" method="POST" id="editForm">
                            @csrf
                            @method('PUT')
                            <label for="nama" class="form-label">Nama</label>
                            <div class="input-group rounded mb-4 shadow align-items-center">
                                <input type="text" id="nama" class="form-control custom-input" name="name"
                                    value="{{ $edit->name }}"required>
                            </div>
                            <label for="hp" class="form-label">no hp</label>
                            <div class="input-group rounded mb-4 shadow align-items-center">
                                <input type="tel" maxlength="13" minlength="11" id="hp"
                                    class="form-control custom-input" oninput="this.value = this.value.replace(/\D/g, '')"
                                    value="{{ $edit->phone_number }}" name="phone_number"required>
                            </div>
                            <label for="email" class="form-label">email</label>
                            <div class="input-group rounded mb-4 shadow align-items-center">
                                <input type="email" id="email" class="form-control custom-input"
                                    value="{{ $edit->email }}" name="email"required>
                            </div>
                            <div class="d-flex flex-row gap-3 justify-content-end">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn fw-bold btn-primary px-4 py-2 btn-sv">Simpan</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- sukses Modal delete  -->
    <div class="modal fade" id="suksesModalDelete" tabindex="-1" role="dialog" data-bs-backdrop="false">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body py-4">
                    <div class="d-flex flex-row  justify-content-evenly align-items-center ">
                        <img src="{{ asset('assets/img/sukses.png') }}" alt="" width="55px">
                        <p class="fw-bolder text-center m-0">Data <span class="text-success ">Berhasil</span> dihapus!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- gagal Modal delete -->
    <div class="modal fade" id="erorModalDelete" tabindex="-1" role="dialog" data-bs-backdrop="false">
        <div class="modal-dialog modal-sm " role="document">
            <div class="modal-content ">
                <div class="modal-body px-0">
                    <div class="d-flex flex-row  justify-content-evenly align-items-center  ">
                        <img src="{{ asset('assets/img/gagal.png') }}" alt="" height="55px" class="my-2">
                        <div class="d-flex flex-column ">
                            <p class="fw-bold text-start m-0">Data <span class="text-danger">Gagal</span> dihapus!</p>
                            <span class="text-danger text-center  small">Eror : message!!</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- @else
      <p class="text-center fs-4 mt-3">Admin tidak ditemukan .</p>
    @endif --}}
@endsection

@section('js')
    <script>
        // Fungsi untuk mencari data
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('input[name="search"]');
            const searchButton = document.getElementById('searchButton');

            // Menambahkan event listener pada tombol pencarian
            searchButton.addEventListener('click', function(event) {
                event.preventDefault();

                // Memeriksa apakah nilai pencarian tidak kosong
                if (searchInput.value.trim() !== '') {
                    // Memperbarui URL dengan parameter pencarian
                    const currentUrl = new URL(window.location.href);
                    currentUrl.searchParams.set('search', searchInput.value);

                    // Mengarahkan pengguna ke URL yang diperbarui
                    window.location.href = currentUrl.toString();
                }
            });

            // Menghapus parameter pencarian jika input pencarian kosong saat blur
            searchInput.addEventListener('blur', function() {
                if (this.value.trim() === '') {
                    const currentUrl = new URL(window.location.href);
                    currentUrl.searchParams.delete('search');
                    window.location.href = currentUrl.toString();
                }
            });
        });
    </script>
    <script>
        // Fungsi untuk hapus data
        function showSuksesModalHapusCS() {
            $('#suksesModalDelete').modal('show');
            setTimeout(() => {
                $('#suksesModalDelete').modal('hide')
            }, 1200);
        }

        function showErorModalHapusCS() {
            $('#erorModalDelete').modal('show');
            setTimeout(() => {
                $('#erorModalDelete').modal('hide')
            }, 1200);
        }

        function hapusCS() {
            // Logika untuk menambah toko manual
            var berhasil = true; // Ganti dengan logika sesuai kebutuhan

            if (berhasil) {
                showSuksesModalHapusCS();
            } else {
                showErorModalHapusCS();
            }
        }
    </script>
@endsection
