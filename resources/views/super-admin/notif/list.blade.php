@extends('layouts.mainSA')

@section('css')
    <link rel="stylesheet" href="/assets/css/notif.css">
    <style>
        .session-card,
        .session-error {
            transition: opacity 0.5s ease;
        }
    </style>
@endsection

@section('konten')
    <section class="container-data_notif rounded max-container ">
        {{-- Header Profile --}}
        <article
            class="header-data_notif d-flex flex-column align-items-start flex-lg-row justify-content-lg-between align-items-lg-center mx-5 my-4">
            <div class="align-items-center ">
                <h1 class="title-header-data_notif fw-bold m-0 px-0">{{ $title }}</h1>
            </div>

            {{-- Modal Tambah --}}
            <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="modalTambahLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable w-100 ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-white px-4" id="modalTambahLabel">Tambah Data</h5>
                            <button type="button" class="btn-close me-2 bg-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('addNotifinSA') }}" method="POST" id="formDataNotif"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body px-5">
                                <div class="mb-3">
                                    <label for="teks" class="form-label fw-semibold d-flex gap-3"><img
                                            src="/assets/icons/Teks.png" width="32" /> Teks Tampilan <span
                                            class="text-danger">*</span></label>
                                    <textarea type="text" name="teks" class="form-control border border-black rounded-0" id="teks" required></textarea>
                                    <div class="invalid-feedback">
                                        Masukkan Teks Tampilan
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label fw-semibold d-flex gap-3"><img
                                            src="/assets/icons/Status.png" width="32" />Status</label>
                                    <select class="form-select border border-black rounded-0" id="status" name="status"
                                        required>
                                        <option value="">Pilih Status</option>
                                        <option class="text-uppercase" value="active">active</option>
                                        <option class="text-uppercase" value="non_active">non-active</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Masukkan Status
                                    </div>
                                </div>
                                <div class="mb-1">
                                    <label for="audio" class="form-label fw-semibold d-flex gap-3"><img
                                            src="/assets/icons/Audio.png" width="32" />Audio <span
                                            class="text-danger">*</span></label>
                                    <input type="file" name="audio" class="form-control border border-black rounded-0"
                                        id="audio" accept=".mp3" required>
                                    <div class="invalid-feedback">
                                        Masukkan File Audio (.mp3)
                                    </div>
                                </div>
                            </div>
                            <div class="mx-auto d-flex mb-2">
                                <button type="button" class="btn w-50 m-5 fw-semibold btn-cancel"
                                    data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn w-50 btn-primary w-50 m-5">simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>

            {{-- Action Tambah --}}


            {{-- Error Modal --}}
            <div class="modal fade" id="erorModalTambah" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content ">
                        <div class=" my-5 d-flex flex-column justify-content-center ">
                            <img src="{{ asset('assets/img/gagal.png') }}" alt="" width="100px"
                                class="mx-auto mb-2">
                            <small class="fw-bolder text-center ">Data <span class="text-danger">GAGAL</span>
                                Ditambahkan!</small>
                            <span class="text-danger text-center  ">ERROR : message</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal Edit --}}
            @foreach ($data_notif as $item)
                <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="modalEditLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-white px-4" id="modalEditLabel">Edit Data</h5>
                                <button type="button" class="btn-close me-2 bg-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-5">
                                <form action="{{ route('updateNotifSA', $item->id) }}" method="POST" id="editForm"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="editTeks" class="form-label fw-semibold d-flex gap-3"><img
                                                src="/assets/icons/Teks.png" width="32" /> Teks Tampilan <span
                                                class="text-danger">*</span></label>
                                        <textarea type="text" class="form-control border border-black rounded-0" id="editTeks" name="teks" required>{{ $item->teks }}</textarea>
                                        <div class="invalid-feedback">
                                            Masukkan Teks Tampilan
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editStatus" class="form-label fw-semibold d-flex gap-3"><img
                                                src="/assets/icons/Status.png" width="32" />Status</label>
                                        <select class="form-select border border-black rounded-0" id="editStatus"
                                            name="status" required>
                                            <option value="active" {{ $item->status == 'active' ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="non_active"
                                                {{ $item->status == 'non_active' ? 'selected' : '' }}>Non-Active</option>
                                        </select>

                                        <div class="invalid-feedback">
                                            Masukkan Status
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label for="editAudio" class="form-label fw-semibold d-flex gap-3"><img
                                                src="/assets/icons/Audio.png" width="32" />Audio <span
                                                class="text-danger">*</span></label>
                                        <input type="file" class="form-control border border-black rounded-0"
                                            id="editAudio" accept=".mp3" name="audio".>
                                        <div class="invalid-feedback">
                                            Masukkan File Audio (.mp3)
                                        </div>
                                    </div>
                                    <div class="mx-auto d-flex">
                                        <button type="button" class="btn w-50 mb-2 me-5 fw-semibold btn-cancel px-5"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary w-50 mb-2 fw-semibold btn-add px-5"
                                            id="simpan" data-bs-target="#actionModalEdit" data-bs-toggle="modal"
                                            data-bs-dismiss="modal">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- Action Edit --}}
            <div class="modal fade" id="actionModalEdit" tabindex="-1" role="dialog"
                aria-labelledby="successModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class=" my-5 d-flex flex-column justify-content-center ">
                            <img src="{{ asset('assets/img/sukses.png') }}" alt="" width="100px"
                                class="mx-auto mb-2">
                            <small class="fw-bolder text-center ">Data <span class="text-success ">Berhasil</span>
                                Diubah!</small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Error Edit --}}
            <div class="modal fade" id="errorModalEdit" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content ">
                        <div class=" my-5 d-flex flex-column justify-content-center ">
                            <img src="{{ asset('assets/img/gagal.png') }}" alt="" width="100px"
                                class="mx-auto mb-2">
                            <small class="fw-bolder text-center ">Data <span class="text-danger">GAGAL</span>
                                Diubah!</small>
                            <span class="text-danger text-center  ">ERROR : Message</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal Hapus --}}
            @foreach ($data_notif as $item)
                <div class="modal fade" id="modalHapus{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="modalHapusLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                            <div class=" my-5 d-flex flex-column justify-content-center ">
                                <img src="{{ asset('assets/icons/danger.png') }}" alt="" width="200px"
                                    class="mx-auto mb-2">
                                <p class="text-capitalize text-center fs-5 alert-hapus fw-medium ">Yakin hapus data?</p>
                                <div class="mx-auto d-flex gap-2">
                                    <form action="{{ route('deleteNotifSA', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn mb-3 btn-primary px-5" data-bs-dismiss="modal"
                                            data-bs-target="#actionModalHapus" data-bs-toggle="modal">Ya</button>
                                    </form>
                                    <button type="button" class="btn btn-danger mb-3 px-5" id="simpan"
                                        data-bs-dismiss="modal">Batal</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- Action Hapus --}}
            <div class="modal fade" id="actionModalHapus" tabindex="-1" role="dialog"
                aria-labelledby="successModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class=" my-5 d-flex flex-column justify-content-center ">
                            <img src="{{ asset('assets/img/sukses.png') }}" alt="" width="100px"
                                class="mx-auto mb-2">
                            <small class="fw-bolder text-center ">Data <span class="text-success ">Berhasil</span>
                                Dihapus!</small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Error Hapus --}}
            <div class="modal fade" id="errorModalHapus" tabindex="-1" role="dialog"
                aria-labelledby="errorModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content ">
                        <div class=" my-5 d-flex flex-column justify-content-center ">
                            <img src="{{ asset('assets/img/gagal.png') }}" alt="" width="100px"
                                class="mx-auto mb-2">
                            <small class="fw-bolder text-center ">Data <span class="text-danger">GAGAL</span>
                                Dihapus!</small>
                            <span class="text-danger text-center  ">ERROR : Message</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tambah-cari-notif d-flex flex-column align-items-start gap-3 flex-sm-row mt-4 mt-lg-0">
                <button
                    class="btn d-inline-block mx-2 rounded btn-tambah-notif text-decoration-none px-5 text-white h-48 p-2"
                    data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah</button>
                <div class="position-relative">
                    <input type="text" name="search" class="px-4 py-2 w-auto" id="searchInput"
                        placeholder="Cari Teks" value="{{ $search }}">
                    <span class="position-absolute top-50 end-0 translate-middle-y pe-4"><i
                            class="fa-solid fa-magnifying-glass text-muted"></i></span>
                </div>
            </div>
        </article>



        @if (session()->has('success'))
            <div class="session-card p-4" id="successMessage">
                <img src="/assets/icons/checklist.png" alt="checklist" style="margin-right: 10px;">
                <h3 class="mt-3">{{ session('success') }}</h3>
            </div>
            <script>
                setTimeout(function() {
                    document.getElementById('successMessage').style.opacity = '0';
                    setTimeout(function() {
                        document.getElementById('successMessage').style.display = 'none';
                    }, 500);
                }, 1000);
            </script>
        @endif

        @if (session()->has('error') || $errors->any())
            <div class="session-error p-4" id="errorMessage">
                <img src="/assets/icons/gagal.png" alt="error" style="margin-right: 10px;">
                <h3 class="mt-3">
                    @if (session()->has('error'))
                        {{ session('error') }}
                    @else
                        Terjadi Kesalahan:
                    @endif
                </h3>
                @if ($errors->any())
                    <ul class="mt-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <script>
                setTimeout(function() {
                    document.getElementById('errorMessage').style.opacity = '0';
                    setTimeout(function() {
                        document.getElementById('errorMessage').style.display = 'none';
                    }, 500);
                }, 1000);
            </script>
        @endif


        @if ($data_notif->count())
            <article class="px-2 mx-5 mt-5 border-2 border-opacity-25 row mb-5">
                <table class="rounded-2 bg-white tabel">
                    <thead class="text-center mb-2 fw-semibold">
                        <tr class="rounded">
                            <th scope="col" class="text-white tb-header p-2 px-5">No</th>
                            <th scope="col" class="text-white tb-header teks">Tampilan Teks</th>
                            <th scope="col" class="text-white tb-header ps-5">File Audio</th>
                            <th scope="col" class="text-white tb-header">Status</th>
                            <th scope="col" class="text-white tb-header">Opsi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($data_notif as $cs)
                            <tr class="row-notif">
                                <td data-header="No" scope="row">{{ $cs['id'] }}</td>
                                <td data-header="Tampilan Teks" class="text-capitalize flex-wrap ">{{ $cs['teks'] }}
                                </td>
                                <td data-header="File Audio" class="ps-md-5">{{ basename($cs->audio) }}</td>
                                <td data-header="Status" class="status">
                                    @if ($cs['status'] === 'active')
                                        <p
                                            class="status-active text-uppercase text-white fw-semibold rounded-5 my-auto m-md-auto text-center ">
                                            {{ $cs['status'] }}</p>
                                    @elseif ($cs['status'] === 'non_active')
                                        <p
                                            class="status-non text-uppercase text-white fw-semibold rounded-5 my-auto m-md-auto text-center ">
                                            non-active</p>
                                    @endif
                                </td>
                                <td data-header="Opsi"
                                    class="opsi d-flex align-items-center justify-content-between gap-2">
                                    <div class="mx-md-auto d-md-flex">
                                        <button
                                            class="btn d-inline-block mx-1 rounded-3 btn-edit-notif text-decoration-none w-md-50 py-1 text-white h-48 mt-md-4 mb-md-4"
                                            data-bs-toggle="modal" data-bs-target="#modalEdit{{ $cs->id }}"
                                            data-notification-id="{{ $cs['id'] }}"
                                            data-notification-teks="{{ $cs['teks'] }}"
                                            data-notification-audio="{{ $cs['audio'] }}"
                                            data-notification-status="{{ $cs['status'] }}">Edit
                                        </button>
                                        <button
                                            class="btn d-inline-block mx-1 rounded-3 btn-hapus-notif text-decoration-none w-md-50 py-1 text-white h-48 mt-md-4 mb-md-4"
                                            data-bs-toggle="modal" data-bs-target="#modalHapus{{ $cs->id }}">Hapus</button>
                                    </div>
                                </td>
                                <td class="jarak"></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="page justify-content-between">
                    {{ $data_notif->links() }}
                </div>
            </article>
        @else
            <p class="text-center fs-4 mt-5">Audio & Teks Notif tidak ditemukan .</p>
        @endif
    </section>

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
            })
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.btn-edit-notif').on('click', function() {
                var id = $(this).data('notification-id');
                var teks = $(this).data('notification-teks');
                var audio = $(this).data('notification-audio');
                var status = $(this).data('notification-status');

                // Set values in the modal
                $('#editTeks').val(teks);
                $('#editAudio').val(audio);
                $('#editStatus option').filter(function() {
                    return $(this).val() === status;
                }).prop('selected', true);
            });
        });
    </script>
@endsection
