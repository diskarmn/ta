@extends('layouts.main')

@section('css')
<link rel="stylesheet" href="/assets/css/profile.css">
<style>
    /* Tambahkan gaya CSS tambahan di sini jika diperlukan */
</style>
@endsection

@section('konten')
<section class="container-profile rounded">
    {{-- Header Profile --}}
    <article class="header-profile">
        <h1 class="text-white fs-2 fw-bold m-0 px-3 py-4">{{ $title }}</h1>
    </article>
    {{-- Akhir Header Profile --}}

    <article class="px-2 py-1 bg-white rounded-4 shadow border border-2 border-black border-opacity-25 justify-content-between icon-profile">
        <div class="col-lg-12 col-md-12 col-sm-12 row align-items-center">
            <img class="my-2 rounded-circle col-lg-2 col-md-3 col-sm-2 col-2 avatar-profile" src="/assets/img/avatar-profile.png" />
            <div class="col-lg-10 col-md-10 col-sm-9 row d-flex align-items-center justify-content-between">
                <div class="col-lg-6 col-md-5 col-sm-4 mb-2">
                    <p class="text-black fs-4 fw-bold m-0">{{ $name }}</p>
                    <p class="text-black fs-6 fw-semibold m-0">Admin</p>
                    <p class="text-black fs-6 fw-normal m-0">ID007123945</p>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-3 d-flex btn-ganti-password justify-content-end">
                    <a class="rounded-3 text-white fs-6 fw-semibold m-0 px-3 py-2 teks-edit-pw text-decoration-none justify-content-center" href="/profile/ubahPassword">Ganti Password <i class="fa-solid fa-pen-to-square edit-pw-icon"></i></a>
                </div>
            </div>
        </div>
    </article>
    
    <article class="bg-white body-profile d-flex justify-content-center align-items-center">
        <div class="mx-3 px-2 py-1 rounded-4 shadow border border-2 border-black border-opacity-25 row">
            <div class="col-lg-12 row align-items-center py-3">
                <p class="text-black fs-6 fw-bold col-lg-9 m-0">Informasi Personal</p>
                <div class="px-1 py-1 btn-edit-profile rounded-3 col-lg-3 col-md-4 col-sm-5 col-5 d-flex">
                    <a class="text-white fs-6 fw-semibold m-0 px-3 py-2 teks-edit text-decoration-none" href="/profile/editProfile">Edit <i class="fa-solid fa-pen-to-square edit-icon"></i></a>
                </div>
            </div>
            <div class="col-lg-12 row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12 row mb-2">
                    <p class="text-secondary fs-6 fw-semibold col-12 m-0">Nama</p>
                    <p class="text-black fs-6 fw-semibold col-12 mb-0">{{ $name }}</p>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12 row mb-2 my-3">
                    <p class="text-secondary fs-6 fw-semibold col-12 m-0">Nomor Handphone</p>
                    <p class="text-black fs-6 fw-semibold col-12 m-0">{{ $no_hp }}</p>
                </div>
            </div>
            <div class="col-lg-12 align-items-center">
                <div class="col-lg-12 row mb-5">
                    <p class="text-secondary fs-6 fw-semibold col-lg-12 m-0">Email</p>
                    <p class="text-black fs-6 fw-semibold col-lg-12 m-0">{{ $email }}</p>
                </div>
            </div>
        </div>
    </article>
</section>
@endsection
