@php
    $status = $status ?? 'semua_orderan';
    $orders = $orders ?? collect();
@endphp


@extends('layouts.mainA')

@section('css')
    <link rel="stylesheet" href="/assets/css/dashboard.css">
@endsection

@section('konten')
    <section class="container-admin rounded overflow-hidden">
        {{-- KATEGORI ORDERAN --}}
        <div class="d-flex flex-wrap justify-content-lg-end justify-content-md-center gap-3 px-3 pb-3 pt-3">
            <div class="d-flex flex-wrap justify-content-lg-end justify-content-center col-lg-5 col-md-8 col-sm-12 col-12 gap-4 align-items-center py-4">
                <!-- Pilih Juragan Dropdown -->
                <div class="col-lg-auto col-md-auto col-sm-auto col-12 mb-3 mb-md-0">
                    <div class="dropdown">
                        <form action="{{ route('select-juragan') }}" method="GET">
                            <select id="filter-select" class="form-select mr-3 mt-3 fzt7 select-tablet" name="juragan" aria-label="Default select example" style="width: 200px; border:1px solid black">
                                <option class="fzt8" selected>Pilih Juragan</option>
                                @foreach ($dataJuragan as $item)
                                    <option class="fzt8" value="{{ $item->name_juragan }}">{{ $item->name_juragan }}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                </div>
                <!-- Search Input -->
                <div class="col-lg-auto col-md-auto col-sm-12 col-12">
                    <div class="dropdown">
                        <div class="input-group rounded m-0 col-12 align-items-center border border-dark">
                            <input type="text" name="search" class="form-control px-4 py-2 input-search" id="searchInput" placeholder="Cari Orderan" data-bs-toggle="modal" data-bs-target="#inputSearchModal" value="">
                            <button class="btn bg-white btn-search" type="button" id="searchButton" disabled>
                                <span><i class="fa-solid fa-magnifying-glass"></i></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex status-orders row justify-content-lg-between justify-content-md-center g-3 px-lg-5">
            <div class="col-lg-2 col-md-4 col-sm-6 col-12 w-auto">
                <a href="{{ route('dashboard', ['status' => 'semua_orderan']) }}" class="d-flex align-items-center justify-content-around text-decoration-none btn border-1 rounded-5 border-black py-2 px-3  width_10 {{ $status == 'semua_orderan' ? 'status-order' : 'status-order-normal' }}">
                    Semua Orderan
                    <span class="angka_filter text-white py-1 px-custom">{{ $countStatus['jumlah_id'] }}</span>
                </a>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-12 w-auto">
                <a href="{{ route('dashboard', ['status' => 'belum_proses']) }}"
                    class="d-flex align-items-center justify-content-around text-decoration-none btn border-1 rounded-5 border-black py-2 px-3 width_10 {{ $status == 'belum_proses' ? 'status-order' : 'status-order-normal' }}">
                    Belum Proses
                    <span class="angka_filter text-white py-1 px-custom">{{ $countStatus['belumProses'] }}</span>
                </a>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-12 w-auto">
                <a href="{{ route('dashboard', ['status' => 'cek_pembayaran']) }}"
                    class="d-flex align-items-center justify-content-around text-decoration-none btn border-1 rounded-5 border-black py-2 px-3 width_10 {{ $status == 'cek_pembayaran' ? 'status-order' : 'status-order-normal' }}">
                    Cek Pembayaran
                    <span class="angka_filter text-white py-1 px-custom">{{ $countStatus['menungguDicek'] }}</span>
                </a>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6 col-12 w-auto">
                <a href="{{ route('dashboard', ['status' => 'dalam_proses']) }}"
                    class="d-flex align-items-center justify-content-around text-decoration-none btn border-1 rounded-5 border-black py-2 px-3 width_10 {{ $status == 'dalam_proses' ? 'status-order' : 'status-order-normal' }}">
                    Dalam Proses
                    <span class="angka_filter text-white py-1 px-custom">{{ $countStatus['dalamProses'] }}</span>
                </a>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6 col-12 w-auto">
                <a href="{{ route('dashboard', ['status' => 'orderan_selesai']) }}"
                    class="d-flex align-items-center justify-content-around text-decoration-none btn border-1 rounded-5 border-black py-2 px-3 width_10 {{ $status == 'orderan_selesai' ? 'status-order' : 'status-order-normal' }}">
                    Orderan Selesai
                    <span class="angka_filter text-white py-1 px-custom">{{ $countStatus['orderanSelesai'] }}</span>
                </a>
            </div>
        </div>

        {{-- KATEGORI ORDERAN --}}
        <x-admin.dashboard.modal.modal-search />

        @if ($status == 'belum_proses' && $orderan->count() > 0)
            <x-admin.dashboard.card.card-not-process :orders="$orderan->where('status', 'belum_proses')" class="col-md-12" />
        @elseif($status == 'cek_pembayaran' && $orders->count() > 0)
            <x-admin.dashboard.card.card-check-payment :orders="$orderan->where('status', 'cek_pembayaran')" class="col-md-12" />
        @elseif($status == 'dalam_proses' && $orders->count() > 0)
            <x-admin.dashboard.card.card-on-process :orders="$orderan->where('status', 'dalam_proses')" class="col-md-12" />
        @elseif($status == 'orderan_selesai' && $orderan->count() > 0)
            <x-admin.dashboard.card.card-done-order :orders="$orderan->where('status', 'orderan_selesai')" class="col-md-12" />
        @else
        
            @if ($orderan && $orders->count() > 0)
                <x-admin.dashboard.card.card-not-process :orders="$orderan->where('status', 'belum_proses')" class="col-md-12" />
                <x-admin.dashboard.card.card-check-payment :orders="$orderan->where('status', 'cek_pembayaran')" class="col-md-12" />
                <x-admin.dashboard.card.card-on-process :orders="$orderan->where('status', 'dalam_proses')" class="col-md-12" />
                <x-admin.dashboard.card.card-done-order :orders="$orderan->where('status', 'orderan_selesai')" class="col-md-12" />
            @else
                @if(isset($noOrders) && $noOrders)
                    <p class="fs-6 fw-bold text-center mt-5">No orders available.</p>
                @endif
            @endif
    </section>
@endif


@section('javascript')
<script src="assets/js/admin/dashboard/dashboard-admin.js"></script>
@endsection
@endsection
