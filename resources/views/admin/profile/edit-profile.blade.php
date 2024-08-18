@extends('layouts.mainA')

@section('css')
    <link rel="stylesheet" href="/assets/css/profile.css">
@endsection

@section('konten')
    <section class="container-edit_profile rounded">
        {{-- Header Profile --}}
        <article class="header-edit_profile px-lg-4 px-md-4">
            <h1 class="text-white fs-2 fw-bold m-0 py-5">{{ $title }}</h1>
        </article>
        {{-- Akhir Header Profile --}}
        
        <form action="{{ route('adminEditProfile') }}" method="POST" class="bg-white pt-5 body-edit_profile d-flex justify-center align-items-center">
            @csrf
            @method('PUT')
            <div
                class="mx-5 px-5 py-5 rounded-4 shadow border border-2 border-black border-opacity-25 edit-profile-container">
                <div>
                    <h4 class="text-black fw-bold m-0">Informasi Personal</h4>
                </div>
                <div class="row d-flex justify-content-between p-0 my-3">
                    <div class="col-lg-6 col-md-12 d-flex flex-column gap-1 mb-md-3">
                        <label class="text-secondary fw-semibold m-0">Nama</label>
                        <input name="name" class="text-black fs-6 fw-semibold px-3 py-3 rounded border-black border-opacity-50"
                            value="{{ $profile['name'] }}">
                    </div>
                    <div class="col-lg-6 col-md-12 d-flex flex-column gap-1">
                        <label class="text-secondary fs-6 fw-semibold m-0">Nomor Handphone</label>
                        <input name="phone_number" class="text-black fs-6 fw-semibold m-0 px-3 py-3 rounded border-black border-opacity-50"
                            value="{{ $profile['phone_number'] }}">
                    </div>
                </div>
                <div class="col-lg-12 p-0">
                    <div class="d-flex flex-column gap-1">
                        <label class="text-secondary fs-6 fw-semibold col-lg-12 m-0">Email</label>
                        <input name="email"
                            class="text-black fs-6 fw-semibold col-lg-12 m-0 px-3 py-3 rounded border-black border-opacity-50"
                            value="{{ $profile['email'] }}">
                    </div>
                </div>
            </div>
            <div class="d-flex gap-5 btn-edit_save my-5">
                <button type="button" onclick="window.location.href='{{ route('admin.profile') }}'" class="btn btn_batal-edit">Batal</button>
                <button type="submit" class="btn btn_simpan-edit">Simpan</button>
            </div>
        </form>
    </section>

    <section>
        @include('partials.modal')
        
        @if(session('errorValidate'))
            <script>
                $(document).ready(function() {
                    $('#messageErrorValidate').text('Eror: {{ implode(', ', session('errorMessage')) }}');
                    $('#erorModalValidasi').modal('show');
                });
            </script>
        @endif
    </section>
@endsection
