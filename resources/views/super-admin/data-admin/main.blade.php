{{-- @dd($data_admin) --}}
@extends('layouts.mainSA')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/data-admin.css') }}">
@endsection

@section('konten')
    <div class="container-fluid p-4">
        {{-- header --}}
        <div class="d-flex row justify-content-between align-items-center p-0">
            <div class="col-lg-7 col-xl-4 col-md-12 d-flex header-text align-items-center mb-4  ">Data Admin</div>
            <div
                class="col-lg-5 col-xl-5 col-md-12 justify-content-md-end  d-flex flex-md-row-reverse flex-lg-row justify-content-center align-items-center gap-4 mb-4 ">
                <a href="/super-admin/tambahAdmin" class="btn btn-lg btn-blue rounded-2 px-4 fs-6">Tambah</a>
                {{-- search --}}
                <div class="input-group  custom-shadow bg-white align-items-center">
                    <input type="text" class="form-control form-control-lg input-fields border-0 ps-4"
                        placeholder="Cari Admin" name="search" id="searchInput">
                    <button class="btn bg-white btn-groups pe-4 border-0" type="button" id="searchButton"><span><i
                                class="fa-solid fa-magnifying-glass text-muted"></i></span></button>
                </div>
            </div>
        </div>

        {{-- table data admin --}}
        <main class="d-flex flex-column  table-responsive rounded-top bg-white">
            <table class="table table-borderless text-center">
                <thead>
                    <tr>
                        <th class="col">No.</th>
                        <th class="col">Nama Admin</th>
                        <th class="col">Email</th>
                        <th class="col">No. Telpon</th>
                        <th class="col">Gender</th>
                        <th class="col">Opsi</th>
                    </tr>
                </thead>
                <tbody id="tabel-body">
                    @if ($data_admin->count())
                        @foreach ($data_admin as $data)
                            <tr>
                                <td class="col pb-0 pt-3">{{ $loop->iteration }}</td>
                                <td class="col pb-0 pt-3 text-capitalize">{{ $data->name }}</td>
                                <td class="col pb-0 pt-3 text-truncate">{{ $data->email }}</td>
                                <td class="col pb-0 pt-3 text-truncate ">{{ $data->phone_number }}</td>
                                <td class="col pb-0 pt-3 text-truncate ">{{ $data->gender }}</td>
                                <td class="col pb-0 pt-3">
                                    <div class="d-flex justify-content-evenly">
                                        <a href="{{ route('showEditAdmin', $data->id) }}"
                                            class="btn btn-sm btn-orange px-lg-4 text-center rounded-2 fw-medium "
                                            style="font-size:12px;">
                                            <span id="icon" class="fa-solid fa-pen"></span>
                                            <span id="text">Edit</span>
                                        </a>
                                        <button class="btn btn-info btn-sm">
                                            <a class="text-center text-decoration-none text-white"
                                                href="{{ route('editPasswordAdmin', $data->id) }}">Edit
                                                Password</a>
                                        </button>
                                        <button class="btn btn-sm px-lg-3  btn-red text-center fw-medium rounded-2 "
                                            style="font-size:12px;" data-bs-target="#ModalDelete{{ $data->id }}" data-bs-toggle="modal">
                                            <span id="icon" class="fa-solid fa-trash"></span>
                                            <span id="text">Hapus</span>
                                        </button>
                                </td>
                            </tr>

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
                                                <form action="{{ route('deleteAdmin', $data->id) }}" id="deleteForm"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-blue" id="btn-ya" data-bs-dismiss="modal"
                                                        onclick="hapusAdmin()">Ya</button>
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
                            <td colspan="6" class="text-center pt-4">Data Admin tidak ditemukan.</td>
                        </tr>
                    @endif
                </tbody>
            </table>

            {{-- pagination --}}
            <div class="d-flex justify-content-between  m-4 mt-5">
                <div class="">
                    <button class="btn btn-outline-success" disabled>Halaman 1{{-- {{ $data_pelanggan->currentPage() }} --}} </button>
                </div>
                {{-- ganti block ini dengan data yang sesuai contoh : {{ $data_pelanggan->links() }} --}}
                <div class="d-flex justify-content-end me-2 mt-1">
                    {{ $data_admin->links() }}
                </div>
            </div>
        </main>
    </div>
    <section>
        @include('partials.modal')
    </section>
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
        function showSuksesModalHapusAdmin() {
            $('#suksesModalDelete').modal('show');
            setTimeout(function() {
                $('#suksesModalDelete').modal('hide');
            }, 1200);

        }

        function showErorModalHapusAdmin() {
            $('#erorModalDelete').modal('show');
            setTimeout(function() {
                $('#erorModalDelete').modal('hide');
            }, 1200);
        }

        function hapusAdmin() {
            // Logika untuk menambah toko manual
            const formnya = document.getElementById('deleteForm');
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
