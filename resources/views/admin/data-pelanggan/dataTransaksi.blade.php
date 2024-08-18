@extends('layouts.mainA')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/data-pelanggan.css') }}">
    
@endsection

@section('konten')
    <div class="container-fluid p-4">
        <div class="bg-white ">
            {{-- header konten --}}
            <div class="d-flex justify-content-center" style="background-color: #202B46;">
            <div class="col-xl-9  col-lg-10 col-md-11 mb-2 mt-5 bg-white border rounded">
                <div class="d-flex justify-content-start align-items-center">
                    <div class="col-2 d-flex justify-content-center ps-3" style="min-width: 120px">
                        <img src="{{ asset('assets/img/Avatar-image.png') }}" alt="" width="100px" height="120px" style="border-radius: 8px;">
                    </div>
                    <div class="col p-0 text-start my-3 px-3">
                        <p class="mb-1 h5  text-capitalize" style="font-size: 28px; color:#41404C;">
                            {{ $dataTransaksi->name }}</p>
                        <p class="mb-0 fw-light" style="font-size: 22px;  color:#5C6B82;">{{ $dataTransaksi->id }}</p>
                        <p class="mb-0 fs-6" style=" color:#5C6B82;"><span class="fs-6"
                                style="color:#41404C; white-space:pre;">Hp 1 : </span>{{ $dataTransaksi->phone }}</p>
                        <p class="mb-0 fs-6" style=" color:#5C6B82;"><span class="fs-6"
                                style="color:#41404C; white-space:pre;">Hp 2 : </span>{{ $dataTransaksi->phone2 }}</p>
                        <p class="mb-0 fs-6" style=" color:#5C6B82; white-space:nowrap;"><span class="fs-6"
                                style="color:#41404C; white-space:pre;">Email : </span>{{ $dataTransaksi->email }}</p>
                    </div>
                    <div class="col text-start align-self-start mt-3 px-3"style="max-width: 230px;">
                        <p class="mb-0 fs-4 ">Tgl. bergabung</p>
                        <p class="my-2" style="font-size: 22px; font-weight:300; color:#666666;">
                            {{ $dataTransaksi->register_date }}</p>
                        <span>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M16 16C16 14.895 12.866 14 9 14M16 16C16 17.105 12.866 18 9 18C5.134 18 2 17.105 2 16M16 16V20.937C16 22.076 12.866 23 9 23C5.134 23 2 22.077 2 20.937V16M16 16C19.824 16 23 15.013 23 14V4M9 14C5.134 14 2 14.895 2 16M9 14C4.582 14 1 13.013 1 12V7M9 5C4.582 5 1 5.895 1 7M1 7C1 8.105 4.582 9 9 9C9 10.013 12.253 11 16.077 11C19.9 11 23 10.013 23 9M23 4C23 2.895 19.9 2 16.077 2C12.253 2 9.154 2.895 9.154 4M23 4C23 5.105 19.9 6 16.077 6C12.254 6 9.154 5.105 9.154 4M9.154 4V14.166"
                                    stroke="#D8CF06" stroke-width="2" />
                            </svg>
                            <p class="m-0 d-inline fw-semibold" style="color:#D8CF06;">{{ $dataTransaksi->point }}</p>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- isi konten  --}}
        <div class="d-flex justify-content-center bg-white" >
            <div class="col-lg-10 col-xl-9 col-md-11  bg-white border rounded mt-2 mb-4 ">
                <div class="mt-3 mb-4">
                    <span>
                        <a href="{{ route('detailPelangganAdmin', $dataTransaksi->id) }}" class="text-decoration-none ">
                            <i class="fa-solid fa-arrow-left ms-4 h4 color-title"></i>
                        </a>
                    </span>
                    <p class="d-inline ms-4 h4 color-title">Riwayat Transaksi</p>
                </div>
                {{-- detail riwayat --}}
                @foreach ($orders as $orderNumber => $order)
                        {{-- detail riwayat --}}
                        <div class="d-flex flex-column m-3 gap-3">
                            <div class="d-flex justify-content-between "
                                style="border: none; border-radius: 10px; background-color: #F3F1FC; ">
                                <div class="d-flex flex-column justify-content-center p-3 gap-2">
                                    <div class="d-flex flex-row align-items-center gap-2">
                                        <span
                                            class="d-flex align-items-center gap-1 badge badge-gradient rounded-pill px-4 py-2">
                                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M11.332 11.3346C11.332 10.5519 9.11211 9.91797 6.3737 9.91797M11.332 11.3346C11.332 12.1173 9.11211 12.7513 6.3737 12.7513C3.63528 12.7513 1.41536 12.1173 1.41536 11.3346M11.332 11.3346V14.8317C11.332 15.6385 9.11211 16.293 6.3737 16.293C3.63528 16.293 1.41536 15.6392 1.41536 14.8317V11.3346M11.332 11.3346C14.0407 11.3346 16.2904 10.6355 16.2904 9.91797V2.83464M6.3737 9.91797C3.63528 9.91797 1.41536 10.5519 1.41536 11.3346M6.3737 9.91797C3.24428 9.91797 0.707031 9.21884 0.707031 8.5013V4.95964M6.3737 3.54297C3.24428 3.54297 0.707031 4.17693 0.707031 4.95964M0.707031 4.95964C0.707031 5.74234 3.24428 6.3763 6.3737 6.3763C6.3737 7.09384 8.67791 7.79297 11.3866 7.79297C14.0945 7.79297 16.2904 7.09384 16.2904 6.3763M16.2904 2.83464C16.2904 2.05193 14.0945 1.41797 11.3866 1.41797C8.67791 1.41797 6.48278 2.05193 6.48278 2.83464M16.2904 2.83464C16.2904 3.61734 14.0945 4.2513 11.3866 4.2513C8.67861 4.2513 6.48278 3.61734 6.48278 2.83464M6.48278 2.83464V10.0356"
                                                    stroke="#202B46" stroke-width="2" />
                                            </svg>
                                            <p class="mb-0 d-inline text-black" style="font-size: 12px;">
                                                {{ $totalPointsEachOrder[$orderNumber] }}</p>
                                        </span>
                                        <h5>{{ $order->first()->total_amount }}</h5>
                                    </div>  
                                    <div class="d-flex flex-row" style="color: rgba(32, 43, 70, 0.65);">
                                        <p class="mr-2 me-2 mb-0">{{ $order->first()->order_date }}</p>
                                        <div class="vr"></div>
                                        <p class="mr-2 mx-2  mb-0">{{ $orderNumber }}</p>
                                        <div class="vr"></div>
                                        <p class="ms-2 mb-0">{{ $order->first()->employee->name }}</p>
                                    </div>
                                </div>
                                {{-- button lihat invoice --}}
                                <div class="d-flex align-items-center justify-content-center gap-3 mx-4">
                                    <a href="{{ route('admin.data-pelanggan.invoice', $orderNumber) }}" class="btn btn-purple" style="font-size: 12px;">Lihat
                                        Invoice</a>
                                    <button class="btn btn-outline-purple" data-bs-toggle="modal"
                                        data-bs-target="#modalTambahPoin">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- modal tambah poin --}}
    <form action="{{ route('add-pointsAdmin', ['id' => $dataTransaksi->id]) }}" method="POST">
        @csrf
        <div class="modal fade" id="modalTambahPoin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content">
                    <div class="d-flex justify-content-center m-3">
                        <h5 class="col-11 text-center ms-1 mb-0">Tambah Point</h5>
                        <button type="button" class="btn-close col-1 " data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body mx-3 pt-0 ">
                        <div class="text-center mx-5">
                            <small class="text-danger">Setiap kelipatan Rp.100,000 dari transaksi mendapatkan 10 point!</small>
                        </div>
                        <div class="input-modal mt-2">
                            <label for="point" class="fw-medium">Point</label>
                            <input type="number" class="form-control shadow" id="point" name="point" required>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 justify-content-center ">
                        <button type="submit" class="btn btn-blue px-3 py-2">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('js')

@endsection
