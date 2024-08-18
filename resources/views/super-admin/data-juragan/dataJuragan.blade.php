@extends('layouts.mainSA')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/data-juragan.css') }}">
@endsection

@section('konten')
    <div class="container-fluid p-4">

        {{-- header --}}
        <div class="d-flex row justify-content-between align-items-center p-0">
            <div class="col-lg-7 col-md-12 d-flex header-text align-items-center mb-4">Data Toko (Juragan)</div>
            <div
                class="col-lg-5 col-md-12 d-flex justify-content-md-end flex-md-row-reverse flex-lg-row justify-content-center align-items-center mb-4">


            </div>
        </div>



        <div class="flex-row d-flex justify-content-between">
            <div style="width: 70%">
                <main class="flex-column table-responsive my-1 bg-white">

                    <table class="table table-borderless text-center mb-2">
                        <thead>
                            <tr>
                                <th class="col table-darks">No</th>
                                <th class="col table-darks">Nama Toko</th>
                                <th class="col table-darks">Alamat</th>
                                <th class="col table-darks">Opsi</th>
                        </thead>

                        <tbody id="juraganTableBody">
                            @if ($juragans->count())
                                @foreach ($juragans as $data)
                                    <tr>
                                        <td class="col pb-0 pt-3">
                                            {{ ($juragans->currentPage() - 1) * $juragans->perPage() + $loop->iteration }}
                                        </td>
                                        <td class="col pb-0 pt-3 text-capitalize">{{ $data->name_juragan }}</td>

                                        <td class="col pb-0 pt-3 text-capitalize overflow-hidden">{{ $data->alamat }}</td>
                                        <td class="col pb-0 pt-3">
                                            <div class="d-flex justify-content-center gap-lg-3 gap-md-1">
                                                <button class="btn btn-sm text-center px-4 rounded-2 btn-orange"
                                                    data-bs-target="#ModalEdit{{ $data->id }}" data-bs-toggle="modal"
                                                    type="button">
                                                    Edit
                                                </button>

                                                <button
                                                    class="btn btn-sm px-lg-3 px-md-2 btn-red text-center fw-medium rounded-2 "
                                                    style="font-size:12px;" data-bs-target="#ModalDelete{{ $data->id }}"
                                                    data-bs-toggle="modal" type="submit">Hapus</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Modal Delete -->
                                    <div class="modal fade" id="ModalDelete{{ $data->id }}" tabindex="-1"
                                        role="dialog">
                                        <div class="modal-dialog modal-dialog-centered modal-md " role="document">
                                            <div class="modal-content ">
                                                <div class="my-5">
                                                    <div class="d-flex flex-column justify-content-center ">
                                                        <img src="{{ asset('assets/img/confirm.png') }}" alt=""
                                                            width="120px" class="mx-auto">
                                                        <p class="fw-bold text-center my-3">Yakin Hapus Data ?</p>
                                                    </div>
                                                    <div class="d-flex justify-content-center gap-3">
                                                        <form action="{{ route('deleteJuragan', $data->id) }}"
                                                            method="POST" class="w-auto">
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

                                    <!-- modal edit-->
                                    <div class="modal fade" id="ModalEdit{{ $data->id }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body m-3">
                                                    <h5 class="text-center mb-4">Edit Toko</h5>
                                                    <form id="formEditModal{{ $data->id }}" method="POST"
                                                        action="{{ route('editJuraganSuperAdmin', $data->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <label for="namaToko" class="form-label">Nama Toko</label>
                                                        <div class="input-group rounded mb-4 shadow align-items-center">
                                                            <input name="name_juragan" type="text" class="form-control"
                                                                id="namaToko{{ $data->id }}"
                                                                value="{{ $data->name_juragan }}" required>
                                                            <span><i class="fa-solid fa-pen mx-3"
                                                                    style="font-size: 10px;"></i></span>
                                                        </div>

                                                        <label for="alamatToko" class="form-label">Alamat</label>
                                                        <div class="input-group rounded mb-4 shadow align-items-center">
                                                            <input name="alamat" type="text" class="form-control"
                                                                id="alamatToko{{ $data->id }}"
                                                                value="{{ $data->alamat }}" required>
                                                            <span><i class="fa-solid fa-pen mx-3"
                                                                    style="font-size: 10px;"></i></span>
                                                        </div>

                                                        <div class="d-flex justify-content-center gap-3">
                                                            <button type="button" class="btn btn-red px-4"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-blue px-4">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center pt-4">Tidak ada data juragan.</td>
                                </tr>
                            @endif
                        </tbody>

                    </table>




                    <div class="d-flex flex-row  justify-content-between mb-3">
                        <div class="ms-4">
                            <button class="btn btn-outline-secondary mt-5" disabled> Halaman
                                {{ $juragans->currentPage() }}</button>
                        </div>


                        <div class="mt-5 me-3 ">
                            <ul>
                                {{ $juragans->links() }}
                            </ul>
                        </div>

                    </div>

                </main>
            </div>


            <div class="w-25">
                <div class="card border-black  p-4">
                    <h5 class="text-center mb-4 " style="font-family: Montserrat; font-weight:600;">Tambah Toko</h5>
                    <form action="{{ route('tambahJuraganSuperAdmin') }}" method="POST" class=""
                        id="TambahTokoManual">
                        @csrf
                        <label for="namaToko" class="form-label">Nama Toko</label>
                        <div class="mb-4 rounded  shadow">
                            <input name="name_juragan" type="text" class="form-control" id="namaToko" required>
                        </div>

                        <label for="namaToko" class="form-label">Alamat</label>
                        <div class="mb-4 rounded  shadow">
                            <input name="alamat" type="text" class="form-control" id="namaToko" required>
                        </div>


                        <div class="d-flex justify-content-center gap-3">
                            <button type="button" class="btn btn-danger px-4"
                                onclick="showTambahTokoManual()">Batal</button>
                            <button type="submit" class="btn btn-primary px-3" id="tambah">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>





        <script>
            $(document).ready(function() {
                $('#searchButton').click(searchJuragan); // Menjalankan pencarian saat tombol pencarian diklik
                $('#searchInput').keypress(function(event) {
                    // Menjalankan pencarian saat tombol enter ditekan
                    if (event.which == 13) {
                        searchJuragan();
                    }
                });

                function searchJuragan() {
                    var keyword = $('#searchInput').val();
                    $.ajax({
                        url: "{{ route('searchJuraganSuperAdmin') }}",
                        method: "GET",
                        data: {
                            keyword: keyword
                        },
                        success: function(response) {
                            var juragans = response.result;
                            var tableBody = $('#juraganTableBody');

                            tableBody.empty();

                            if (juragans.length > 0) {
                                // Iterasi melalui setiap hasil pencarian dan tambahkan ke tabel
                                $.each(juragans, function(index, juragan) {
                                    var row = '<tr>' +
                                        '<td class="col pb-0 pt-3">' + (index + 1) + '</td>' +
                                        '<td class="col pb-0 pt-3 text-capitalize">' + juragan
                                        .name_juragan + '</td>' +
                                        '<td class="col pb-0 pt-3">' + (juragan.employee ? juragan
                                            .employee.name : 'Tidak ada CS') + '</td>' +
                                        '<td class="col pb-0 pt-3 text-capitalize">' + juragan
                                        .alamat + '</td>' +
                                        '<td class="col pb-0 pt-3">' +
                                        '<div class="d-flex justify-content-center gap-lg-3 gap-md-1">' +

                                        '<button class="btn btn-sm text-center px-4 rounded-2 btn-orange" data-bs-target="#ModalEdit' +
                                        juragan.id + '" data-bs-toggle="modal" >Edit</button>' +
                                        '<button class="btn btn-sm px-lg-3 px-md-2 btn-red text-center fw-medium rounded-2" style="font-size:12px;" data-bs-target="#ModalDelete' +
                                        juragan.id +
                                        '" data-bs-toggle="modal" type="submit">Hapus</button>' +
                                        '</div>' +
                                        '</td>' +
                                        '</tr>';

                                    tableBody.append(row);
                                });
                            } else {
                                var noDataRow = '<tr>' +
                                    '<td colspan="5" class="text-center pt-4">Tidak ada data juragan.</td>' +
                                    '</tr>';
                                tableBody.append(noDataRow);
                            }
                        }
                    });
                }
            });
        </script>




        <section>
            @include('partials.modal')

            @if (session('successAdd'))
                <script>
                    $(document).ready(function() {
                        $('#suksesModalTambah').modal('show');
                        setTimeout(function() {
                            $('#suksesModalTambah').modal('hide');
                        }, 1500);
                    });
                </script>
            @elseif(session('errorAdd'))
                <script>
                    $(document).ready(function() {
                        $('#errorAddMessage').text('Eror: {{ implode(', ', session('errorMessage')) }}');
                        $('#erorModalTambah').modal('show');
                        setTimeout(function() {
                            $('#erorModalTambah').modal('hide');
                        }, 1500);
                    });
                </script>
            @endif

            @if (session('successEdit'))
                <script>
                    $(document).ready(function() {
                        $('#ModalEdit').modal('hide');
                        $('#suksesModalEdit').modal('show');
                        setTimeout(function() {
                            $('#suksesModalEdit').modal('hide');
                        }, 1500);
                    });
                </script>
            @elseif(session('errorEdit'))
                <script>
                    $(document).ready(function() {
                        $('#errorEditMessage').text('Eror: {{ implode(', ', session('errorMessage')) }}');
                        $('#ModalEdit').modal('hide');
                        $('#erorModalEdit').modal('show');
                        setTimeout(function() {
                            $('#erorModalEdit').modal('hide');
                        }, 1500);
                    });
                </script>
            @endif

        </section>

@endsection
