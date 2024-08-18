@extends('layouts.mainCS')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/data-detailData.css') }}">

@endsection

@section('konten')
    <div class="container-fluid p-4">

        {{-- header konten --}}
        <div class="d-flex justify-content-center" style="background-color: #202B46;">
            <div class="col-xl-9  col-lg-10 col-md-11  {{ $detailData->address }} mb-2 mt-5 bg-white border rounded">
                <div class="d-flex justify-content-start align-items-center">
                    <div class="col-2 d-flex justify-content-center ps-3" style="min-width: 120px">
                        <img src="{{ asset('assets/img/Avatar-image.png') }}" alt="" width="100px" height="120px" style="border-radius: 8px;">
                    </div>
                    <div class="col p-0 text-start my-3 px-3">
                        <p class="mb-1 h5  text-capitalize" style="font-size: 28px; color:#41404C;">{{ $detailData->name }}</p>
                        <p class="mb-0 fw-light" style="font-size: 22px;  color:#5C6B82;">ID{{ $detailData->id }}</p>
                        <p class="mb-0 fs-6" style=" color:#5C6B82;"><span class="fs-6" style="color:#41404C; white-space:pre;">Hp 1       : </span>  {{ $detailData->phone }}</p>
                        <p class="mb-0 fs-6" style=" color:#5C6B82;"><span class="fs-6" style="color:#41404C; white-space:pre;">Hp 2      : </span>  {{ $detailData->phone2 }}</p>
                        <p class="mb-0 fs-6" style=" color:#5C6B82; white-space:nowrap;"><span class="fs-6" style="color:#41404C; white-space:pre;">Email    : </span>  {{ $detailData->email }}</p>
                    </div>
                    <div class="col text-start align-self-start mt-3 px-3"style="max-width: 230px;">
                       <p class="mb-0 fs-4 " >Tgl. bergabung</p>
                       <p class="my-2" style="font-size: 22px; font-weight:300; color:#666666;">{{ $detailData->register_date = date('d/m/y') }}</p>
                       <span>
                           <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                               <path d="M16 16C16 14.895 12.866 14 9 14M16 16C16 17.105 12.866 18 9 18C5.134 18 2 17.105 2 16M16 16V20.937C16 22.076 12.866 23 9 23C5.134 23 2 22.077 2 20.937V16M16 16C19.824 16 23 15.013 23 14V4M9 14C5.134 14 2 14.895 2 16M9 14C4.582 14 1 13.013 1 12V7M9 5C4.582 5 1 5.895 1 7M1 7C1 8.105 4.582 9 9 9C9 10.013 12.253 11 16.077 11C19.9 11 23 10.013 23 9M23 4C23 2.895 19.9 2 16.077 2C12.253 2 9.154 2.895 9.154 4M23 4C23 5.105 19.9 6 16.077 6C12.254 6 9.154 5.105 9.154 4M9.154 4V14.166" stroke="#D8CF06" stroke-width="2"/>
                           </svg>
                           <p class="m-0 d-inline fw-semibold" style="color:#D8CF06;" >{{ $detailData->point }}</p>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- isi konten --}}
        <div class="d-flex justify-content-center bg-white" >
            <div class=" d-flex  gap-4 flex-column col-xl-9 col-lg-10 col-md-11 bg-white border rounded mt-2 p-4">
                <div class="d-flex gap-4 align-items-center ">
                    <a class="text-decoration-none " href="{{ route('dataPelangganCs') }}">
                        <i class="fa-solid fa-arrow-left fs-4 color-title mb-0"></i>
                    </a>
                    <span class=" h4 color-title mb-0">Detail detail Data</span>
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
                                <p class="mb-2 color-title h4" >Kab/Kota</p>
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
        <div class="d-flex justify-content-center bg-white ">
            <a class="btn btn-blue my-4 px-4 py-2 " href="{{ route('dataRiwayatTransaksiCs', $detailData->id) }}">Riwayat Transaksi</a>
        </div> 

    </div>
@endsection

@section('js')

@endsection
