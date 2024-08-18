@extends('layouts.mainSA')

@section('css')
    <link rel="stylesheet" href="/assets/css/profile.css">
@endsection

@section('konten')
    <section class="container-profile rounded ">
        {{-- Header Profile --}}
        <article class="header-profile position-relative px-lg-3 px-md-2 py-md-4">
            <h1 class="text-white fs-2 fw-bold m-0 px-3">{{ $title }}</h1>
            {{-- Akhir Header Profile --}}
            <article
                class="px-2 py-3 bg-white shadow border border-2 border-black d-flex justify-content-center icon-profile start-50 translate-middle border-opacity-25">
                <div class="col-lg-12 col-md-12 col-sm-12 w-100 d-flex gap-3 px-3">
                    <div class="img-container p-0 w-auto">
                        <img class="avatar-profile m-0" src="/assets/img/avatar-profile.png" />
                    </div>
                    <div class="d-flex align-items-center justify-content-between w-100">
                        <div class="mb-2">
                            <p class="text-black fw-bold m-0 username">{{ $profile->name }}</p>
                            <p class="text-black fw-semibold m-0">{{ $profile->role }}</p>
                            <p class="text-black fw-normal m-0">{{ $profile->id }}</p>
                        </div>
                        <div class="d-flex btn-ganti-password justify-content-end">
                            <a class="rounded-3 text-white fw-semibold m-0 px-3 py-lg-3 py-md-3 text-decoration-none d-flex align-items-center"
                                href="{{ route('tampilUbahPasSA') }}">
                                <p class="m-0">Ganti Password</p>
                                <i class="fa-solid fa-pen-to-square edit-pw-icon fa-lg"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </article>
        </article>


        <article class="bg-white body-profile d-flex justify-content-center align-items-center">
            <div
                class="box-profile flex flex-column align-items-center px-2 py-1 shadow border border-2 border-black row border-opacity-25">
                <div class="col-lg-12 row align-items-center justify-content-between py-3 mt-5">
                    <p class="col-lg-9 col-md-6 m-0 w-auto title" style="font-weight: 800;">Informasi Personal</p>
                    <div class="px-1 py-1 btn-edit-profile rounded-3 col-lg-3 col-md-6 col-sm-5 col-5 d-flex">
                        <a class="text-white fw-semibold m-0 px-3 py-lg-2 py-md-2 text-decoration-none d-flex justify-content-between align-items-center"
                            href="{{ route('getEditProfilinSA') }}">
                            <p class="m-0">Edit</p>
                            <i class="fa-solid fa-pen-to-square edit-icon fa-lg"></i>
                        </a>
                    </div>
                </div>
                <div class="flex flex-column align-items-center row">
                    <div class="col-lg-12 row p-0 admin-data">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12 my-3">
                            <p class="text-secondary m-0">Nama<br /></p>
                            <p class="text-black fw-bolder m-0">{{ $profile->name }}</p>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12 my-3">
                            <p class="text-secondary m-0">Nomor Handphone</p>
                            <p class="text-black fw-bolder m-0">{{ $profile->phone_number }}</p>
                        </div>
                    </div>
                    <div class="col-lg-12 admin-data">
                        <div class="col-lg-12 row mb-5">
                            <p class="text-secondary col-lg-12 m-0">Email</p>
                            <p class="text-black  fw-bold col-lg-12 m-0">{{ $profile->email }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </section>

    <section>
        @include('partials.modal')
    
        @if(session('successUpdate'))
            <script>
                $(document).ready(function() {
                    $('#suksesModalEdit').modal('show');
                    setTimeout(function() {
                        $('#suksesModalEdit').modal('hide');
                    }, 1500);
                })
            </script>
        @elseif(session('errorUpdate'))
            <script>
                $(document).ready(function() {
                    $('#errorEditMessage').text('Eror: {{ implode(', ', session('errorMessage')) }}');
                    $('#erorModalEdit').modal('show');
                    setTimeout(function() {
                        $('#erorModalEdit').modal('hide');
                    }, 1500);
                })
            </script>
        @endif
    </section>
    
@endsection
