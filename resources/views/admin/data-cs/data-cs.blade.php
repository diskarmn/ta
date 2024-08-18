@extends('layouts.mainA')

@section('css')
    <link rel="stylesheet" href="/assets/css/data-cs.css">
@endsection

@section('konten')
    <section class="container-data_cs rounded p-4">

        {{-- header --}}
        <div class="d-flex justify-content-between align-items-center mb-4 p-0">
            <h1 class="col-lg-8 col-md-7 d-flex header-text align-items-center ">{{ $title }}</h1>
            <div class="col-lg-4 col-md-5 d-flex  justify-content-center align-items-center gap-4 ">
                <a href="/admin/data-cs/add" class="btn btn-lg btn-blue rounded-2 px-4 fs-6">Tambah</a>
                {{-- search --}}
                <div class="input-group  custom-shadow bg-white align-items-center ">
                    <input type="text" class="form-control form-control-lg input-fields border-0 ps-4"
                        placeholder="Cari CS" name="search" id="searchInput" value="{{ $search }}">
                    <button class="btn bg-white btn-groups pe-4 border-0" type="button" id="searchButton"><span><i
                                class="fa-solid fa-magnifying-glass text-muted"></i></span></button>
                </div>
            </div>
        </div>


        <main class="d-flex flex-column  table-responsive rounded-top my-3 bg-white">
            <table class="table table-borderless text-center mb-5">
                <thead>
                    <tr>
                        <th class="col">ID CS</th>
                        <th class="col">Nama CS</th>
                        <th class="col">Toko</th>
                        <th class="col">Email</th>
                        <th class="col">No Telepon</th>
                        <th class="col">Opsi</th>
                    </tr>
                </thead>
                <tbody id="tabel-body">
                    @if ($data_cs->count())
                        @foreach ($data_cs as $data)
                        @php
                            $juragan = DB::table('juragans')
                                ->where('id', $data->juragan_id)
                                ->first();
                            $name_juragan =$juragan->name_juragan ?? 'belum ditentukan toko';
                        @endphp
                            <tr>
                                <td scope="row" class="col pb-0 pt-3">{{ $loop->iteration }}</td>
                                <td scope="row" class="col pb-0 pt-3">{{ $data->name }}</td>
                                <!-- Menampilkan nama juragan di sini -->
                                <td class="col pb-0 pt-3">
                                    {{ $name_juragan }}
                                </td>
                                <td class="col pb-0 pt-3">{{ $data->email }}</td>
                                <td class="col pb-0 pt-3">{{ $data->phone_number }}</td>
                                <td class="col pb-0 pt-3">
                                    <div class="d-flex justify-content-center gap-lg-3 gap-md-1">
                                        <a class="btn btn-sm btn-orange px-lg-4 px-md-3  text-center rounded-2 fw-medium "
                                        style="font-size:12px;"  data-bs-toggle="modal"
                                        data-bs-target="#edit{{ $data->id }}">Edit</a>
                                        {{-- <a href="{{ route('showEdit', $data->id) }}"
                                            class="btn btn-sm btn-orange px-lg-4 px-md-3  text-center rounded-2 fw-medium "
                                            style="font-size:12px;">Edit</a> --}}
                                        {{-- <button class="btn btn-info btn-sm">
                                            <a class="text-center text-decoration-none text-white"
                                                href="{{ route('editPasswordCsAdmin', $data->id) }}">Edit
                                                Password</a>
                                        </button> --}}
                                        <button class="btn btn-sm px-lg-3 px-md-2 btn-red text-center fw-medium rounded-2 "
                                            style="font-size:12px;" data-bs-target="#ModalDelete{{ $data->id }}" data-bs-toggle="modal"
                                            type="submit">Hapus</button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal delete -->
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
                                                <form action="{{ route('deleteDataCS', $data->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-blue" id="btn-ya"
                                                        data-bs-dismiss="modal">Ya</button>
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
                            <td colspan="6" class="text-center pt-3">Data customer belum ada</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div class="kanan d-flex justify-content-end p-3">{{ $data_cs->links() }}</div>
        </main>
        </div>
        @foreach ($data_cs as $edit)
        <div class="modal fade" id="edit{{ $edit->id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        {{ $edit->id }}
                    yang mau di edit {{ $edit->username }}
                    </div>
                    <div class="modal-body">
                    <form action="{{ route('editcs2a', $data->id) }}" method="POST" id="editForm"
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
                                    value="{{ $edit->name }}" required>
                                <div class="invalid-feedback fw-bold">
                                    EROR: Field Tidak Boleh Kosong
                                </div>
                            </div>
                            <div class="col m-0 input-container ">
                                <label for="hp" class="form-label custom-label">Nomor Handphone</label>
                                <input type="tel" maxlength="13" minlength="11" id="hp"
                                    class="form-control custom-input" oninput="this.value = this.value.replace(/\D/g, '')"
                                    value="{{ $edit->phone_number }}" name="phone_number" required>
                                <div class="invalid-feedback fw-bold">
                                    EROR: Field Tidak Boleh Kosong
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col m-0 input-container ">
                                <label for="email" class="form-label custom-label">Email</label>
                                <input type="email" id="email" class="form-control custom-input"
                                    value="{{ $edit->email }}" name="email" required>
                                <div class="invalid-feedback fw-bold">
                                    EROR: Field Tidak Boleh Kosong
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            @php
                            $juragan = DB::table('juragans')->get();
                            @endphp
                            <select name="juragan_id" class="form-select w-50">
                                @foreach ($juragan as $item)
                                    <option value="{{ $item->id }}">{{ $item->name_juragan }}</option>
                                @endforeach
                            </select>

                        </div>


                        <div class="d-flex flex-row gap-3 justify-content-end">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn fw-bold btn-dark px-4 py-2 btn-sv"
                                >Simpan</button>

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


    </section>

    <script>
        function simpandata() {
            window.location.href = "/admin/data-cs/add";
        }
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
            })
        });
    </script>
@endsection
