@extends('layouts.mainA')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/request.css') }}">
@endsection

@php
    use App\Models\Order;
@endphp

@section('konten')
    <div class="container-fluid p-4">

        <form method="POST" id="formDataPelanggan" action="{{ route('editordersa', $nomer_order) }}">

            @csrf
            {{-- head req edit --}}
            {{-- @dd($request) --}}
            <div class="head-reqEdit d-flex flex-column shadow p-4">
                <div class=" d-flex flex-row justify-content-between">
                    <div class="idProduct px-2 py-3">
                        {{-- <p class="idlogin">{{ $user_id }}</p> --}}
                        <p>Edit Orderan <span class="text-uppercase">#{{ $nomer_order }}</span></p>
                        <input type="hidden" value="{{ $nomer_order }}" name="order_number">
                        <input type="hidden" value="{{ $user_id }}" class="idlogin">
                    </div>
                    @foreach ($request as $item)
                        <div class="text-capitalize" style=" font-size:18px;">{{ $item->created_at->format('d-m-Y H:i') }}
                        </div>
                </div>

                <div class="d-flex flex-column ">
                    <div class="d-flex col-lg-12 py-3 px-0 justify-content-between ">
                        <p class="fs-4" style=" font-weight:600;">Request</p>
                    </div>
                    <div class="col-lg-12 p-0" style="white-space: pre-line;">
                        <p>{{ $item->detail }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- body req edit --}}
            <div class="body-reqEdit flex-column p-4 ">
                {{-- <form action="{{ route('editRequest', $firstOrder->id) }}" class="needs-validation" id="editRequest" method="POST"
                novalidate>
                @csrf
                @method('PUT') --}}

                {{-- info req --}}

                <div class="d-flex flex-row justify-content-between mb-4 gap-5" id="form-juragan">
                    <div class="col">
                        <label for="opsi-juragan" class="label-order mb-0">Juragan</label>
                        <input type="hidden" id="ijuragan" name="juragan_f">
                        <b><p class='pjuragan'></p></b>
                           {{-- <select class="form-select form-select-lg shadow" id="opsi-juragan" name="juragan">

                            <option id="juragan" disabled>Pilih Juragan</option>
                         <option disabled>Pilih Juragan</option>
                            @foreach ($juragans as $juragan)
                                <option value="{{ $juragan->id }}">
                                    {{ $juragan->name_juragan }}
                                </option>
                            @endforeach
                        </select> --}}
                    </div>

                    <div class="col">
                        <input type="hidden" class="border border-none" id="isource" name="sumber_f">
                        <label for="opsi-orderan" id="source" class="label-order mb-0">Asal Orderan </label>
                        <b><p id='isource'></p></b>
                        {{-- <select class="form-select form-select-lg shadow" id="opsi-orderan">
                            <option id="source" selected>Pilih asal</option>
                        <select class="form-select form-select-lg shadow" id="opsi-orderan">
                            <option selected>Pilih asal</option>
                            <option value="1">Blibli</option>
                            <option value="2">Bukalapak</option>
                            <option value="3">Facebook</option>
                            <option value="4">Instagram</option>
                            <option value="5">Lazada</option>
                            <option value="6">Offline Store/COD</option>
                            <option value="7">OLX</option>
                            <option value="8">Shopee</option>
                            <option value="9">Tokopedia</option>
                            <option value="10">Web/App lain</option>
                            <option value="11">WhatsApp</option>
                            <option value="12">Zalora</option>
                        </select> --}}
                    </div>
                    <div class="col">
                        {{-- <input type="text" id="dilayani" name="dilayani"> --}}
                        <input type="hidden" id="iddilayani" name="served_by">
                        <label for="opsi-cs" class="label-order mb-0">Dilayani Oleh</label>
                        <b><p id='dilayani'></p></b>
                         {{-- <select class="form-select form-select-lg shadow" id="opsi-cs" name="cs">
                            <option id="dilayani" disabled>Pilih CS</option>
                           @foreach ($employees as $cs)
                                <option value="{{ $cs->id }}">
                                    {{ $cs->name }}
                                </option>
                            @endforeach
                        </select> --}}
                    </div>
                    {{-- @foreach ($orderan as $item) --}}
                    <div class="col">
                        <label for="tanggal-order" class="label-order mb-0">Tanggal Order</label>
                        <input type="date" id="itanggal" class="border border-none border-0" name="tanggal_order">
                        <input type="hidden" id="tanggal">
                        {{-- <input type="date" class="form-control form-control-lg input-custom shadow" id="tanggal-order"
                            name="tanggal_order" value=""> --}}
                    </div>
                    {{-- @endforeach --}}

                </div>

                {{-- pelanggan --}}
                <div class="d-flex col-lg-5 flex-column mb-4">
                    {{-- @foreach ($orderan as $order) --}}
                    <label for="pelanggan" class="label-order mb-0">Pelanggan</label>
                    <div class="input-group rounded  bg-white shadow" id="data-pelanggan">
                        <input type="text" class="form-control m-1 text-capitalize "
                            placeholder="" id="pelanggan" name="pelanggan">
                        <input type="hidden" class="form-control m-1 text-capitalize "
                            placeholder="" id="idpelanggan" name="id_pelanggan_keorder">

                            {{-- placeholder="{{ $orderan->customer->name }}" id="pelanggan"> --}}
                        {{-- <div class="d-flex align-items-center mx-1">
                            <button class="btn btn-purple px-5 py-1 rounded" id="searchButton" data-bs-toggle="modal"
                                data-bs-target="#modalSearch" type="button">Cari</button> --}}
                                {{-- data-bs-target="#modalSearch{{ $orderan->customer->id }}" type="button">Cari</button> --}}
                        {{-- </div> --}}
                    </div>
                    {{-- @endforeach --}}
                </div>

                {{-- keterangan --}}
                {{-- @foreach ($orderan as $item) --}}
                <div class="d-flex col-lg-8 flex-column mb-4" id="note-juragan">
                    <label for="note" class="label-order">Note / Keterangan</label>
                    <textarea class="shadow form-control rounded text-muted" name="note" id="note" rows="10"
                        style="resize:none; white-space:pre-line;">
                        {{-- style="resize:none; white-space:pre-line;">{{ $orderan->notes }} --}}
                    </textarea>
                </div>
                {{-- @endforeach --}}


                {{-- tab order --}}
                <div class="shadow tab-order mb-4">
                    <div class="border-0 d-flex align-items-center gap-1 ">
                        <div class="bg-white border-0 px-4 py-2 rounded-top label-order">Order</div>
                        <button class="btn p-0 border-0  rounded btn-add" type="button" data-bs-toggle="modal"
                            data-bs-target="#addOrder">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32"
                                fill="none">
                                <path
                                    d="M20.8183 16.904H16.6754V21.0468C16.6754 21.2666 16.5882 21.4773 16.4328 21.6327C16.2774 21.7881 16.0666 21.8754 15.8469 21.8754C15.6271 21.8754 15.4164 21.7881 15.261 21.6327C15.1056 21.4773 15.0183 21.2666 15.0183 21.0468V16.904H10.8754C10.6557 16.904 10.4449 16.8167 10.2896 16.6613C10.1342 16.5059 10.0469 16.2951 10.0469 16.0754C10.0469 15.8556 10.1342 15.6449 10.2896 15.4895C10.4449 15.3341 10.6557 15.2468 10.8754 15.2468H15.0183V11.104C15.0183 10.8842 15.1056 10.6735 15.261 10.5181C15.4164 10.3627 15.6271 10.2754 15.8469 10.2754C16.0666 10.2754 16.2774 10.3627 16.4328 10.5181C16.5882 10.6735 16.6754 10.8842 16.6754 11.104V15.2468H20.8183C21.0381 15.2468 21.2488 15.3341 21.4042 15.4895C21.5596 15.6449 21.6469 15.8556 21.6469 16.0754C21.6469 16.2951 21.5596 16.5059 21.4042 16.6613C21.2488 16.8167 21.0381 16.904 20.8183 16.904Z"
                                    fill="#626262" />
                            </svg>
                        </button>
                    </div>
                    <div class="bg-white">
                        <div class="card px-3 border-0 mb-3">
                            <table class="table table-borderless mb-0" id="order-table">
                                <thead class="text-center small border border-0 border-bottom ">
                                    <tr>
                                        <td class="opsi col-lg-1"></td>
                                        <th class="col py-3">Produk</th>
                                        <th class="col py-3">Harga</th>
                                        <th class="col py-3">Qty</th>
                                        <th class="col py-3">Subtotal</th>
                                    </tr>
                                </thead>
                                @php
                                    // $orderan = Order::where('order_number', $orderan->order_number)->get();
                                    // $subtotal = 0;
                                @endphp
                                {{-- @if ($orderan)

                            @endif --}}
                                <tbody id="infoOrder">
                                    @foreach ($keranjang as $isi)
                                        @if ($isi->kd)
                                            <tr class="text-center small border border-0  border-bottom tr-harga"
                                                id="dataOrder">
                                                <td class="col-lg-1">
                                                    <button class="btn px-1 py-0" data-bs-toggle="modal" data-id=""
                                                        data-bs-target="#editOrder{{ $isi->id }}" type="button"
                                                        data-bs-toggle="modal">
                                                        <svg width="15" height="15" viewBox="0 0 15 15"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M4.92648 14.3165H1.2395C1.07652 14.3165 0.920223 14.2517 0.804982 14.1365C0.689742 14.0212 0.625 13.8649 0.625 13.702V10.2695C0.625 10.1888 0.640894 10.1089 0.671776 10.0343C0.702657 9.95978 0.747921 9.89204 0.804983 9.83498L10.0224 0.617482C10.1377 0.502241 10.294 0.4375 10.457 0.4375C10.6199 0.4375 10.7762 0.502241 10.8915 0.617482L14.3239 4.04995C14.4392 4.16519 14.5039 4.32149 14.5039 4.48446C14.5039 4.64744 14.4392 4.80374 14.3239 4.91898L4.92648 14.3165Z"
                                                                stroke="black" stroke-width="0.7" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <path d="M8 2.64062L12.3015 6.94212" stroke="black"
                                                                stroke-width="0.7" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>
                                                    </button>

                                                    {{-- btn delete --}}
                                                    <button class="btn px-1 py-0 " type="button" data-bs-toggle="modal"
                                                        data-bs-target="#hapusOrder{{ $isi->id }}">
                                                        <svg width="18" height="18" viewBox="0 0 18 18"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M14.5027 3.98492H12.0602V3.57862C12.0602 3.00699 11.8805 2.59262 11.5171 2.33974C11.2604 2.17399 10.942 2.08984 10.5719 2.08984H7.83445C7.83232 2.08984 7.83063 2.09112 7.8285 2.09112C7.82638 2.09112 7.82468 2.08984 7.82255 2.08984H7.43622C6.47615 2.08984 5.94745 2.61854 5.94745 3.57862V3.98492H3.50625C3.42171 3.98492 3.34064 4.0185 3.28086 4.07828C3.22108 4.13806 3.1875 4.21913 3.1875 4.30367C3.1875 4.38821 3.22108 4.46928 3.28086 4.52906C3.34064 4.58884 3.42171 4.62242 3.50625 4.62242H3.78122L4.60827 15.581C4.60827 16.2742 5.0099 16.6716 5.71072 16.6716H12.2816C12.9663 16.6716 13.3684 16.2763 13.3832 15.6048L14.2107 4.62242H14.5023C14.5441 4.62245 14.5856 4.61423 14.6243 4.59824C14.663 4.58224 14.6981 4.55879 14.7277 4.52921C14.7573 4.49963 14.7808 4.46451 14.7969 4.42585C14.8129 4.38718 14.8212 4.34574 14.8212 4.30388C14.8213 4.26202 14.813 4.22057 14.7971 4.18188C14.7811 4.1432 14.7576 4.10805 14.728 4.07843C14.6984 4.04881 14.6633 4.02531 14.6247 4.00926C14.586 3.99322 14.5446 3.98495 14.5027 3.98492ZM13.5244 5.24972H4.46802L4.42085 4.62242H13.5715L13.5244 5.24972ZM6.58537 3.57862C6.58537 2.97384 6.83188 2.72734 7.43665 2.72734H10.5723C10.8179 2.72734 11.0198 2.77707 11.1626 2.86887C11.3381 2.99084 11.4232 3.22289 11.4232 3.57862V3.98492H6.58537V3.57862ZM12.747 15.5738C12.7389 15.9181 12.6216 16.0341 12.2816 16.0341H5.71072C5.36307 16.0341 5.24577 15.9198 5.24493 15.5568L4.51605 5.88679H13.4759L12.747 15.5738Z"
                                                                fill="#333333" />
                                                            <path
                                                                d="M7.89934 6.39196C7.85753 6.39344 7.81642 6.40315 7.77836 6.42053C7.74031 6.43791 7.70605 6.46262 7.67755 6.49325C7.64905 6.52388 7.62687 6.55983 7.61227 6.59904C7.59768 6.63825 7.59096 6.67995 7.59249 6.72176L7.89169 14.9472C7.89466 15.0296 7.92943 15.1076 7.98871 15.1649C8.04798 15.2222 8.12715 15.2543 8.20959 15.2545L8.22149 15.2541C8.2633 15.2526 8.30441 15.2429 8.34247 15.2255C8.38053 15.2081 8.41478 15.1834 8.44328 15.1528C8.47178 15.1221 8.49396 15.0862 8.50856 15.047C8.52315 15.0078 8.52988 14.9661 8.52834 14.9243L8.22957 6.69838C8.22319 6.52243 8.07954 6.37666 7.89934 6.39196ZM5.92352 6.39238C5.83921 6.39827 5.76069 6.43739 5.70523 6.50114C5.64976 6.5649 5.62188 6.64808 5.62772 6.73238L6.19254 14.9578C6.19803 15.0383 6.23386 15.1137 6.29279 15.1687C6.35173 15.2238 6.42936 15.2545 6.51002 15.2545L6.53254 15.2536C6.61684 15.2478 6.69536 15.2086 6.75083 15.1449C6.8063 15.0811 6.83418 14.9979 6.82834 14.9136L6.26352 6.68818C6.25698 6.60413 6.21768 6.52601 6.15407 6.47068C6.09047 6.41534 6.00766 6.38722 5.92352 6.39238ZM10.0817 6.39196C9.90364 6.37496 9.75787 6.52286 9.75192 6.69881L9.45229 14.9243C9.4507 14.9661 9.45738 15.0078 9.47196 15.047C9.48653 15.0863 9.50871 15.1222 9.53722 15.1529C9.56573 15.1835 9.60001 15.2082 9.63809 15.2256C9.67618 15.243 9.71731 15.2526 9.75914 15.2541L9.77104 15.2545C9.85348 15.2543 9.93265 15.2222 9.99192 15.1649C10.0512 15.1076 10.086 15.0296 10.0889 14.9472L10.3886 6.72176C10.3902 6.67994 10.3835 6.63821 10.3689 6.59898C10.3543 6.55974 10.3321 6.52377 10.3036 6.49313C10.2751 6.46249 10.2408 6.43778 10.2028 6.42042C10.1647 6.40305 10.1235 6.39338 10.0817 6.39196ZM12.0575 6.39238C11.9734 6.38734 11.8907 6.41549 11.8271 6.47081C11.7635 6.52612 11.7242 6.60417 11.7175 6.68818L11.1527 14.9136C11.1469 14.9979 11.1748 15.0811 11.2302 15.1449C11.2857 15.2086 11.3642 15.2478 11.4485 15.2536L11.471 15.2545C11.5517 15.2544 11.6292 15.2237 11.6882 15.1686C11.7471 15.1136 11.7829 15.0383 11.7885 14.9578L12.3533 6.73238C12.3592 6.64808 12.3313 6.5649 12.2758 6.50114C12.2204 6.43739 12.1418 6.39827 12.0575 6.39238Z"
                                                                fill="#333333" />
                                                        </svg>
                                                    </button>

                                                </td>
                                                <td class="col py-3 nama-barang" id="nama-barang"
                                                    style=" white-space: nowrap;overflow: hidden;">
                                                    <input type="hidden" value="{{ $isi->kd }}"
                                                        name="kd_produk_f[]">
                                                    <input type="hidden" value="{{ $isi->ukuran }}" name="size_f[]">
                                                    {{ $isi->barang }}
                                                </td>
                                                <td class="col py-3 harga-satuan" id="harga-satuan">
                                                    <input type="hidden" value="{{ $isi->harga }}" name="harga_f">
                                                    {{ 'Rp ' . number_format($isi->harga, 0, ',', '.') }}
                                                    <input type="hidden" readonly
                                                        class="form-control input-custom shadow" id="inputpoint"
                                                        name="point_v[]" value="{{ $isi->point }}">
                                                </td>
                                                </td>
                                                <td class="col py-3 jumlah-barang" id="jumlah-barang">
                                                    <input type="hidden" value="{{ $isi->qty }}" name="qty_f[]">
                                                    {{ $isi->qty }}
                                                </td>
                                                <td class="col py-3 harga-barang" id="harga-barang">
                                                    <input type="hidden" value="{{ $isi->subtotal }}" id="subtotal" name="subtotal_f[]">
                                                    {{ 'Rp ' . number_format($isi->subtotal, 0, ',', '.') }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                                <tbody class="table-secondary ">
                                    @if ($ongkir->count())
                                        @foreach ($ongkir as $item)
                                            <tr class="text-center small  border-bottom" id="subtotal">
                                                <td class="col-lg-1">
                                                    <button class="btn px-1 py-0" type="button" data-bs-toggle="modal"
                                                        data-bs-target="#editOngkir{{ $item->id }}">

                                                        <svg width="15" height="15" viewBox="0 0 15 15"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M4.92648 14.3165H1.2395C1.07652 14.3165 0.920223 14.2517 0.804982 14.1365C0.689742 14.0212 0.625 13.8649 0.625 13.702V10.2695C0.625 10.1888 0.640894 10.1089 0.671776 10.0343C0.702657 9.95978 0.747921 9.89204 0.804983 9.83498L10.0224 0.617482C10.1377 0.502241 10.294 0.4375 10.457 0.4375C10.6199 0.4375 10.7762 0.502241 10.8915 0.617482L14.3239 4.04995C14.4392 4.16519 14.5039 4.32149 14.5039 4.48446C14.5039 4.64744 14.4392 4.80374 14.3239 4.91898L4.92648 14.3165Z"
                                                                stroke="black" stroke-width="0.7" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <path d="M8 2.64062L12.3015 6.94212" stroke="black"
                                                                stroke-width="0.7" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>
                                                    </button>

                                                    {{-- btn delete --}}
                                                    <button class="btn px-1 py-0 " type="button" data-bs-toggle="modal"
                                                        data-bs-target="#hapusOngkir{{ $item->id }}">
                                                        <svg width="18" height="18" viewBox="0 0 18 18"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M14.5027 3.98492H12.0602V3.57862C12.0602 3.00699 11.8805 2.59262 11.5171 2.33974C11.2604 2.17399 10.942 2.08984 10.5719 2.08984H7.83445C7.83232 2.08984 7.83063 2.09112 7.8285 2.09112C7.82638 2.09112 7.82468 2.08984 7.82255 2.08984H7.43622C6.47615 2.08984 5.94745 2.61854 5.94745 3.57862V3.98492H3.50625C3.42171 3.98492 3.34064 4.0185 3.28086 4.07828C3.22108 4.13806 3.1875 4.21913 3.1875 4.30367C3.1875 4.38821 3.22108 4.46928 3.28086 4.52906C3.34064 4.58884 3.42171 4.62242 3.50625 4.62242H3.78122L4.60827 15.581C4.60827 16.2742 5.0099 16.6716 5.71072 16.6716H12.2816C12.9663 16.6716 13.3684 16.2763 13.3832 15.6048L14.2107 4.62242H14.5023C14.5441 4.62245 14.5856 4.61423 14.6243 4.59824C14.663 4.58224 14.6981 4.55879 14.7277 4.52921C14.7573 4.49963 14.7808 4.46451 14.7969 4.42585C14.8129 4.38718 14.8212 4.34574 14.8212 4.30388C14.8213 4.26202 14.813 4.22057 14.7971 4.18188C14.7811 4.1432 14.7576 4.10805 14.728 4.07843C14.6984 4.04881 14.6633 4.02531 14.6247 4.00926C14.586 3.99322 14.5446 3.98495 14.5027 3.98492ZM13.5244 5.24972H4.46802L4.42085 4.62242H13.5715L13.5244 5.24972ZM6.58537 3.57862C6.58537 2.97384 6.83188 2.72734 7.43665 2.72734H10.5723C10.8179 2.72734 11.0198 2.77707 11.1626 2.86887C11.3381 2.99084 11.4232 3.22289 11.4232 3.57862V3.98492H6.58537V3.57862ZM12.747 15.5738C12.7389 15.9181 12.6216 16.0341 12.2816 16.0341H5.71072C5.36307 16.0341 5.24577 15.9198 5.24493 15.5568L4.51605 5.88679H13.4759L12.747 15.5738Z"
                                                                fill="#333333" />
                                                            <path
                                                                d="M7.89934 6.39196C7.85753 6.39344 7.81642 6.40315 7.77836 6.42053C7.74031 6.43791 7.70605 6.46262 7.67755 6.49325C7.64905 6.52388 7.62687 6.55983 7.61227 6.59904C7.59768 6.63825 7.59096 6.67995 7.59249 6.72176L7.89169 14.9472C7.89466 15.0296 7.92943 15.1076 7.98871 15.1649C8.04798 15.2222 8.12715 15.2543 8.20959 15.2545L8.22149 15.2541C8.2633 15.2526 8.30441 15.2429 8.34247 15.2255C8.38053 15.2081 8.41478 15.1834 8.44328 15.1528C8.47178 15.1221 8.49396 15.0862 8.50856 15.047C8.52315 15.0078 8.52988 14.9661 8.52834 14.9243L8.22957 6.69838C8.22319 6.52243 8.07954 6.37666 7.89934 6.39196ZM5.92352 6.39238C5.83921 6.39827 5.76069 6.43739 5.70523 6.50114C5.64976 6.5649 5.62188 6.64808 5.62772 6.73238L6.19254 14.9578C6.19803 15.0383 6.23386 15.1137 6.29279 15.1687C6.35173 15.2238 6.42936 15.2545 6.51002 15.2545L6.53254 15.2536C6.61684 15.2478 6.69536 15.2086 6.75083 15.1449C6.8063 15.0811 6.83418 14.9979 6.82834 14.9136L6.26352 6.68818C6.25698 6.60413 6.21768 6.52601 6.15407 6.47068C6.09047 6.41534 6.00766 6.38722 5.92352 6.39238ZM10.0817 6.39196C9.90364 6.37496 9.75787 6.52286 9.75192 6.69881L9.45229 14.9243C9.4507 14.9661 9.45738 15.0078 9.47196 15.047C9.48653 15.0863 9.50871 15.1222 9.53722 15.1529C9.56573 15.1835 9.60001 15.2082 9.63809 15.2256C9.67618 15.243 9.71731 15.2526 9.75914 15.2541L9.77104 15.2545C9.85348 15.2543 9.93265 15.2222 9.99192 15.1649C10.0512 15.1076 10.086 15.0296 10.0889 14.9472L10.3886 6.72176C10.3902 6.67994 10.3835 6.63821 10.3689 6.59898C10.3543 6.55974 10.3321 6.52377 10.3036 6.49313C10.2751 6.46249 10.2408 6.43778 10.2028 6.42042C10.1647 6.40305 10.1235 6.39338 10.0817 6.39196ZM12.0575 6.39238C11.9734 6.38734 11.8907 6.41549 11.8271 6.47081C11.7635 6.52612 11.7242 6.60417 11.7175 6.68818L11.1527 14.9136C11.1469 14.9979 11.1748 15.0811 11.2302 15.1449C11.2857 15.2086 11.3642 15.2478 11.4485 15.2536L11.471 15.2545C11.5517 15.2544 11.6292 15.2237 11.6882 15.1686C11.7471 15.1136 11.7829 15.0383 11.7885 14.9578L12.3533 6.73238C12.3592 6.64808 12.3313 6.5649 12.2758 6.50114C12.2204 6.43739 12.1418 6.39827 12.0575 6.39238Z"
                                                                fill="#333333" />
                                                        </svg>
                                                    </button>
                                                </td>
                                                <td colspan="1" class="col py-3"></td>
                                                <td class="col py-3">Biaya Ongkir :</td>
                                                <td class="col py-3 ongkirnya">{{ $item->jasa_ongkir }}
                                                    <input type="hidden" value="{{ $item->jasa_ongkir }}" name="jasa_ongkir"></td>
                                                <td class="col py-3 ongkir-form">
                                                    {{ 'Rp ' . number_format($item->ongkir, 0, ',', '.') }}
                                                    <input type="hidden" value="{{ $item->ongkir }}" name="ongkir"></td>
                                            </tr>
                                        @endforeach
                                    @else
                                    @endif
                                    @if ($biaya_lain->count())
                                        @foreach ($biaya_lain as $item)
                                            <tr class="text-center small " id="subtotal">
                                                <td class="col-lg-1">
                                                    <button class="btn px-1 py-0" type="button" data-bs-toggle="modal"
                                                        data-bs-target="#editbiayalain{{ $item->id }}">

                                                        <svg width="15" height="15" viewBox="0 0 15 15"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M4.92648 14.3165H1.2395C1.07652 14.3165 0.920223 14.2517 0.804982 14.1365C0.689742 14.0212 0.625 13.8649 0.625 13.702V10.2695C0.625 10.1888 0.640894 10.1089 0.671776 10.0343C0.702657 9.95978 0.747921 9.89204 0.804983 9.83498L10.0224 0.617482C10.1377 0.502241 10.294 0.4375 10.457 0.4375C10.6199 0.4375 10.7762 0.502241 10.8915 0.617482L14.3239 4.04995C14.4392 4.16519 14.5039 4.32149 14.5039 4.48446C14.5039 4.64744 14.4392 4.80374 14.3239 4.91898L4.92648 14.3165Z"
                                                                stroke="black" stroke-width="0.7" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <path d="M8 2.64062L12.3015 6.94212" stroke="black"
                                                                stroke-width="0.7" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>
                                                    </button>

                                                    {{-- btn delete --}}
                                                    <button class="btn px-1 py-0 " type="button" data-bs-toggle="modal"
                                                        data-bs-target="#hapuslain{{ $item->id }}">
                                                        <svg width="18" height="18" viewBox="0 0 18 18"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M14.5027 3.98492H12.0602V3.57862C12.0602 3.00699 11.8805 2.59262 11.5171 2.33974C11.2604 2.17399 10.942 2.08984 10.5719 2.08984H7.83445C7.83232 2.08984 7.83063 2.09112 7.8285 2.09112C7.82638 2.09112 7.82468 2.08984 7.82255 2.08984H7.43622C6.47615 2.08984 5.94745 2.61854 5.94745 3.57862V3.98492H3.50625C3.42171 3.98492 3.34064 4.0185 3.28086 4.07828C3.22108 4.13806 3.1875 4.21913 3.1875 4.30367C3.1875 4.38821 3.22108 4.46928 3.28086 4.52906C3.34064 4.58884 3.42171 4.62242 3.50625 4.62242H3.78122L4.60827 15.581C4.60827 16.2742 5.0099 16.6716 5.71072 16.6716H12.2816C12.9663 16.6716 13.3684 16.2763 13.3832 15.6048L14.2107 4.62242H14.5023C14.5441 4.62245 14.5856 4.61423 14.6243 4.59824C14.663 4.58224 14.6981 4.55879 14.7277 4.52921C14.7573 4.49963 14.7808 4.46451 14.7969 4.42585C14.8129 4.38718 14.8212 4.34574 14.8212 4.30388C14.8213 4.26202 14.813 4.22057 14.7971 4.18188C14.7811 4.1432 14.7576 4.10805 14.728 4.07843C14.6984 4.04881 14.6633 4.02531 14.6247 4.00926C14.586 3.99322 14.5446 3.98495 14.5027 3.98492ZM13.5244 5.24972H4.46802L4.42085 4.62242H13.5715L13.5244 5.24972ZM6.58537 3.57862C6.58537 2.97384 6.83188 2.72734 7.43665 2.72734H10.5723C10.8179 2.72734 11.0198 2.77707 11.1626 2.86887C11.3381 2.99084 11.4232 3.22289 11.4232 3.57862V3.98492H6.58537V3.57862ZM12.747 15.5738C12.7389 15.9181 12.6216 16.0341 12.2816 16.0341H5.71072C5.36307 16.0341 5.24577 15.9198 5.24493 15.5568L4.51605 5.88679H13.4759L12.747 15.5738Z"
                                                                fill="#333333" />
                                                            <path
                                                                d="M7.89934 6.39196C7.85753 6.39344 7.81642 6.40315 7.77836 6.42053C7.74031 6.43791 7.70605 6.46262 7.67755 6.49325C7.64905 6.52388 7.62687 6.55983 7.61227 6.59904C7.59768 6.63825 7.59096 6.67995 7.59249 6.72176L7.89169 14.9472C7.89466 15.0296 7.92943 15.1076 7.98871 15.1649C8.04798 15.2222 8.12715 15.2543 8.20959 15.2545L8.22149 15.2541C8.2633 15.2526 8.30441 15.2429 8.34247 15.2255C8.38053 15.2081 8.41478 15.1834 8.44328 15.1528C8.47178 15.1221 8.49396 15.0862 8.50856 15.047C8.52315 15.0078 8.52988 14.9661 8.52834 14.9243L8.22957 6.69838C8.22319 6.52243 8.07954 6.37666 7.89934 6.39196ZM5.92352 6.39238C5.83921 6.39827 5.76069 6.43739 5.70523 6.50114C5.64976 6.5649 5.62188 6.64808 5.62772 6.73238L6.19254 14.9578C6.19803 15.0383 6.23386 15.1137 6.29279 15.1687C6.35173 15.2238 6.42936 15.2545 6.51002 15.2545L6.53254 15.2536C6.61684 15.2478 6.69536 15.2086 6.75083 15.1449C6.8063 15.0811 6.83418 14.9979 6.82834 14.9136L6.26352 6.68818C6.25698 6.60413 6.21768 6.52601 6.15407 6.47068C6.09047 6.41534 6.00766 6.38722 5.92352 6.39238ZM10.0817 6.39196C9.90364 6.37496 9.75787 6.52286 9.75192 6.69881L9.45229 14.9243C9.4507 14.9661 9.45738 15.0078 9.47196 15.047C9.48653 15.0863 9.50871 15.1222 9.53722 15.1529C9.56573 15.1835 9.60001 15.2082 9.63809 15.2256C9.67618 15.243 9.71731 15.2526 9.75914 15.2541L9.77104 15.2545C9.85348 15.2543 9.93265 15.2222 9.99192 15.1649C10.0512 15.1076 10.086 15.0296 10.0889 14.9472L10.3886 6.72176C10.3902 6.67994 10.3835 6.63821 10.3689 6.59898C10.3543 6.55974 10.3321 6.52377 10.3036 6.49313C10.2751 6.46249 10.2408 6.43778 10.2028 6.42042C10.1647 6.40305 10.1235 6.39338 10.0817 6.39196ZM12.0575 6.39238C11.9734 6.38734 11.8907 6.41549 11.8271 6.47081C11.7635 6.52612 11.7242 6.60417 11.7175 6.68818L11.1527 14.9136C11.1469 14.9979 11.1748 15.0811 11.2302 15.1449C11.2857 15.2086 11.3642 15.2478 11.4485 15.2536L11.471 15.2545C11.5517 15.2544 11.6292 15.2237 11.6882 15.1686C11.7471 15.1136 11.7829 15.0383 11.7885 14.9578L12.3533 6.73238C12.3592 6.64808 12.3313 6.5649 12.2758 6.50114C12.2204 6.43739 12.1418 6.39827 12.0575 6.39238Z"
                                                                fill="#333333" />
                                                        </svg>
                                                    </button>
                                                </td>
                                                <td colspan="1" class="col py-3"></td>
                                                <td class="col py-3">Biaya Lain :</td>
                                                <td class="col py-3 biaya-lain">{{ $item->jasa_biaya_lain }}
                                                <input type="hidden" value="{{ $item->jasa_biaya_lain }}" name="jasa_biaya_lain"></td>
                                                <td class="col py-3 biaya-form">
                                                    {{ 'Rp ' . number_format($item->biaya_lain, 0, ',', '.') }}
                                                    <input type="hidden" value="{{ $item->biaya_lain }}" name="biaya_lain"></td>
                                            </tr>
                                        @endforeach
                                    @else
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div id="btn-OB">
                            <div class="d-flex gap-3 mx-3">
                                @if ($ongkir->count())
                                @else
                                    <button type="button" class="btn btn-light px-4 py-2 btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#ModalOngkir">
                                        Ongkir
                                    </button>
                                @endif
                                @if ($biaya_lain->count())
                                @else
                                    <button type="button" class="btn btn-light btn-sm px-3 py-2" data-bs-toggle="modal"
                                        data-bs-target="#Modalbiayalain">Biaya lain</button>
                                @endif
                            </div>
                            <div id="totalhargaOrder">
                                <div class="d-flex flex-row justify-content-between align-items-center p-3 mx-4">
                                    <p class="fw-bold small">TOTAL</p>
                                    <input type="hidden" id="totalbiaya" name="total_f">
                                    <h5 class="fw-bold total-harga-semua" style="color: #0091ff;" id="total-final-cost">
                                        Rp
                                    </h5>

                                </div>
                            </div>
                            <div id="dance-chart">
                                <div class="d-flex justify-content-center py-5 mb-3 ">
                                    <div id="shopping"
                                        style="width: 100px; height: 100px; background: url('/assets/img/shopping.gif') lightgray 50% / cover no-repeat; background-blend-mode: luminosity;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2 w-100  d-flex justify-content-end">

                        {{-- <button type="submit" class="btn btn-blue py-2 px-5" >Simpan</button> --}}
                        <button type="submit" class="btn btn-blue py-2 px-5" onclick="saveOrder()">Simpan</button>
                    </div>

                </div>


            </div>
        </form>
    </div>


    {{-- Modal add pelanggan --}}
    <div class="modal fade" id="modaladdpelanggan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header border-bottom-0 m-3 py-0 ">
                    <h5 class="modal-title ms-auto">Tambah Data pelanggan</h5>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body m-3 py-0">
                    <form action="" id="formDataPelanggan">
                        <div class="mb-4 ">
                            <label for="id-pelanggan" class="form-label label-order mb-1">ID Pelanggan</label>
                            <input type="text" class="form-control form-control-lg  input-custom shadow text-black "
                                value="ID12345678" id="id-pelanggan"disabled readonly>
                        </div>
                        <div class="mb-4 ">
                            <label for="nama-pelanggan" class="form-label label-order mb-1">Nama Pelanggan</label>
                            <input type="text" class="form-control form-control-lg  input-custom shadow"
                                id="nama-pelanggan" required>
                            <div class="invalid-feedback">
                                Masukkan nama pelanggan
                            </div>
                        </div>

                        <div class="mb-4 ">
                            <label for="email-pelanggan" class="form-label label-order mb-1">Email
                                Pelanggan</label>
                            <input type="email" class="form-control form-control-lg  input-custom shadow"
                                id="email-pelanggan" required>
                            <div class="invalid-feedback">
                                Masukkan email pelanggan
                            </div>
                        </div>
                        <div class="d-flex row">
                            <div class="col-md-6 mb-2" id="tambah-hp-1">
                                <label for="hp-1" class="form-label label-order mb-1">HP 1</label>
                                <input type="telp" minlength="10" maxlength="13"
                                    class="form-control form-control-lg  input-custom shadow " id="hp-1"
                                    oninput="this.value = this.value.replace(/\D/g, '')" required>
                            </div>
                            <div class="col-md-6 mb-4 " id="tambah-hp-2">
                                <label for="hp-2" class="form-label label-order mb-1">HP 2 (Optional) </label>
                                <input type="telp" minlength="10" maxlength="13"
                                    class="form-control form-control-lg  input-custom shadow " id="hp-2"
                                    oninput="this.value = this.value.replace(/\D/g, '')">
                            </div>
                        </div>
                        <div class="mb-4 ">
                            <label for="alamat" class="form-label label-order mb-1">Alamat</label>
                            <textarea type="text" class="form-control form-control-lg  input-custom shadow " id="alamat" rows="3"
                                required></textarea>
                            <div class="invalid-feedback">
                                Masukkan alamat
                            </div>
                        </div>

                        <div class="row d-flex">
                            <div class="col-md-6 mb-4">
                                <label for="provinsi2" class="form-label label-order mb-1">Provinsi</label>
                                <select class="form-select form-select-lg  shadow" id="provinsi2"
                                    onchange="loadKabupaten()" required>
                                    <option value="">Pilih Provinsi</option>
                                </select>
                                <div class="invalid-feedback">
                                    Masukkan provinsi
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="kabupaten2" class="form-label label-order mb-1">Kab / kota</label>
                                <select class="form-select form-select-lg  shadow" id="kabupaten2"
                                    onchange="loadKecamatan()" required>
                                    <option value="">Pilih Kab/Kota</option>
                                </select>
                                <div class="invalid-feedback">
                                    Masukkan kota
                                </div>
                            </div>
                        </div>

                        <div class="row d-flex mb-4">
                            <div class="col-md-6">
                                <label for="kecamatan2" class="form-label label-order mb-1">Kecamatan</label>
                                <select class="form-select form-select-lg  shadow" id="kecamatan2" required>
                                    <option value="">Pilih Kecamatan</option>
                                </select>
                                <div class="invalid-feedback">
                                    Masukkan kecamatan
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <label for="kodepos2" class="form-label label-order mb-1">Kode Pos </label>
                                <input type="number" class="form-control form-control-lg  input-custom shadow "
                                    maxlength="5" id="kodepos2" required>
                                <div class="invalid-feedback">
                                    Masukkan kodepos
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center my-3 ">
                            <button type="button" class="btn btn-grey py-2  px-5" data-bs-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-blue px-5 py-2" data-bs-dismiss="modal"
                                onclick="addPelanggan()">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal not found -->
    <div class="modal fade" id="modalNotFound" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content ">
                <div class="modal-body m-2">
                    <div class="d-flex  justify-content-end ">
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class=" my-2 d-flex flex-column justify-content-center ">
                        <img src="{{ asset('assets/img/not-found.png') }}" alt="" width="120px"
                            class="mx-auto">
                        <p class="text-center fw-semibold py-3">Data tidak ditemukan</p>
                    </div>
                    <div class="d-flex justify-content-center my-2 ">
                        <button class="btn btn-purple px-3" data-bs-dismiss="modal" data-bs-toggle="modal"
                            data-bs-target="#modaladdpelanggan">Tambah data</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Ongkir --}}
    <div class="modal fade" id="ModalOngkir" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-0 m-3 py-0">
                    <h5 class="modal-title ms-auto">Biaya Ongkir</h5>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body m-3 py-0">

                    <form method="POST" id="formongkir" action="{{ url('admin/request/ongkir') }}">
                        @csrf
                        <div class="mb-4 ">
                            <input type="hidden" value="{{ $nomer_order }}" name="order_number">
                            <label for="ongkir-nominal" class="form-label h6 mb-1">Nominal</label>
                            <input type="number" class="form-control form-control-lg input-custom shadow" name="ongkir"
                                id="ongkir-nominal" required>
                        </div>
                        <div class="mb-5 ">
                            <label for="jasa-ongkir" class="form-label h6 mb-1">Label</label>
                            <input type="text" class="form-control form-control-lg input-custom shadow"
                                name="jasa_ongkir" id="jasa-ongkir" placeholder="Jasa Exspedisi" required>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <button type="button" class="btn btn-grey py-2  px-5" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-blue px-5 py-2" data-bs-dismiss="modal"
                                onclick="tambahongkir()">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- edit Ongkir --}}
    @foreach ($keranjang as $item)
        <div class="modal fade" id="editOngkir{{ $item->id }}" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0 m-3 py-0">
                        <h5 class="modal-title ms-auto">Edit Biaya Ongkir</h5>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body m-3 py-0">

                        <form method="POST" id="formongkir"
                            action="{{ url('admin/tulisOrderan/editongkir/' . $item->id) }}">
                            @csrf
                            <div class="mb-4 ">
                                <label for="ongkir-nominal" class="form-label h6 mb-1">Nominal</label>
                                <input type="number" class="form-control form-control-lg input-custom shadow"
                                    name="ongkir_edit" id="ongkir-nominal" required value="{{ $item->ongkir }}">
                            </div>
                            <div class="mb-5 ">
                                <label for="jasa-ongkir" class="form-label h6 mb-1">Label</label>
                                <input type="text" class="form-control form-control-lg input-custom shadow"
                                    id="jasa-ongkir" value="{{ $item->jasa_ongkir }}" name="jasa_ongkir_edit" required>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <button type="button" class="btn btn-grey py-2  px-5"
                                    data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-blue px-5 py-2" data-bs-dismiss="modal"
                                    onclick="tambahongkir()">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- hapus ongkir --}}
    @foreach ($ongkir as $item)
        <div class="modal fade" id="hapusOngkir{{ $item->id }}" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content bg-white">
                    <div class="modal-header border-bottom-0 m-3 py-0">
                        <h5 class="modal-title ms-auto">Data Ongkir Yang Akan Dihapus</h5>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body m-3 py-0">
                        <form method="POST" id="formhapusongkir"
                            action="{{ url('admin/tulisOrderan/deleteongkir/' . $item->id) }}">
                            @csrf
                            @method('DELETE')

                            <table class="table">
                                <tr>
                                    <td class="px-0 fs-5">jasa</td>
                                    <td class="px-0 fs-5">:</td>
                                    <td class="px-0 fs-5" colspan="2" style="white-space: nowrap;">
                                        {{ $item->jasa_ongkir }}</td>
                                </tr>
                                <tr>
                                    <td class="px-0 fs-5">nominal</td>
                                    <td class="px-0 fs-5">:</td>
                                    <td class="px-0 fs-5" colspan="2" style="white-space: nowrap;">
                                        {{ $item->ongkir }}</td>
                                </tr>
                            </table>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <button type="button" class="btn btn-grey py-2  px-5"
                                    data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-danger px-5 py-2"
                                    data-bs-dismiss="modal">Hapus</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- Modal Add biaya lain --}}
    <div class="modal fade" id="Modalbiayalain" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-0 m-3 py-0">
                    <h5 class="modal-title ms-auto">Biaya Lain-Lain</h5>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body m-3 py-0">
                    <form method="POST" id="formbiayalain" action="{{ url('admin/request/lain') }}">
                        @csrf
                        <div class="mb-3 ">
                            <input type="hidden" value="{{ $nomer_order }}" name="order_number">
                            <label for="costnominal" class="form-label h6 mb-1">Nominal</label>
                            <input type="number" class="form-control form-control-lg input-custom shadow mb-2"
                                id="costnominal" required name="biaya_lain">
                            <div class="small">Gunakan tanda (-) untuk mengurangi. <br>misal untuk diskon : -20000
                            </div>
                        </div>
                        <div class="mb-5 ">
                            <label for="addcostlabel" class="form-label h6 mb-1">Label</label>
                            <input type="text" class="form-control form-control-lg input-custom shadow"
                                name="jasa_biaya_lain" id="addcostlabel"
                                placeholder="Label biaya - Opsional (max 20 karakter)" required>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3 ">
                            <button type="button" class="btn btn-grey py-2  px-5" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-blue px-5 py-2" data-bs-dismiss="modal"
                                onclick="tambahcost()">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal edit biaya lain --}}
    @foreach ($biaya_lain as $item)
        <div class="modal fade" id="editbiayalain{{ $item->id }}" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0 m-3 py-0">
                        <h5 class="modal-title ms-auto">Edit Biaya Lain-Lain</h5>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body m-3 py-0">
                        <form method="POST" id="formbiayalain"
                            action="{{ url('admin/tulisOrderan/editlain/' . $item->id) }}">
                            @csrf
                            <div class="mb-3 ">
                                <label for="costnominal" class="form-label h6 mb-1">Nominal</label>
                                <input type="number" class="form-control form-control-lg input-custom shadow mb-2"
                                    name="biaya_lain_edit" id="costnominal" required value="{{ $item->biaya_lain }}">
                                <div class="small">Gunakan tanda (-) untuk mengurangi. <br>misal untuk diskon :
                                    -20000
                                </div>
                            </div>
                            <div class="mb-5 ">
                                <label for="addcostlabel" class="form-label h6 mb-1">Label</label>
                                <input type="text" class="form-control form-control-lg input-custom shadow"
                                    value="{{ $item->jasa_biaya_lain }}" id="addcostlabel"
                                    placeholder="Label biaya - Opsional (max 20 karakter)" required
                                    name="jasa_biaya_lain_edit">
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3 ">
                                <button type="button" class="btn btn-grey py-2  px-5"
                                    data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-blue px-5 py-2"
                                    data-bs-dismiss="modal">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- hapus biaya lain --}}
    @foreach ($biaya_lain as $item)
        <div class="modal fade" id="hapuslain{{ $item->id }}" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content bg-white">
                    <div class="modal-header border-bottom-0 m-3 py-0">
                        <h5 class="modal-title ms-auto">Data Biaya Lain Yang Akan Dihapus</h5>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body m-3 py-0">
                        <form method="POST" id="formhapusbiayalain"
                            action="{{ url('admin/tulisOrderan/deletelain/' . $item->id) }}">
                            @csrf
                            @method('DELETE')

                            <table class="table">
                                <tr>
                                    <td class="px-0 fs-5">keterangan</td>
                                    <td class="px-0 fs-5">:</td>
                                    <td class="px-0 fs-5" colspan="2" style="white-space: nowrap;">
                                        {{ $item->jasa_biaya_lain }}</td>
                                </tr>
                                <tr>
                                    <td class="px-0 fs-5">nominal</td>
                                    <td class="px-0 fs-5">:</td>
                                    <td class="px-0 fs-5" colspan="2" style="white-space: nowrap;">
                                        {{ $item->biaya_lain }}</td>
                                </tr>
                            </table>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <button type="button" class="btn btn-grey py-2  px-5"
                                    data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-danger px-5 py-2"
                                    data-bs-dismiss="modal">Hapus</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- Modal add order --}}
    <div class="modal fade " id="addOrder" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header border-bottom-0 m-3 py-0">
                    <h5 class="modal-title ms-auto ">Tambah Data Order</h5>
                    <button type="button" class="btn-close ms-auto " data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form method="POST" id="tambahForm" action="{{ url('admin/request/keranjang') }}">
                    @csrf
                    {{--
                            <div class="col">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" id="jumlah" min="1" max="5" value="1">
                                <button type="submit" onclick="tambahkan()">tambahkan</button>

                            </div> --}}
                    <div class="modal-body m-3 py-0 wadahulang">
                        <div class="diulang">
                            <div class="d-flex flex-row justify-content-between gap-4  mb-4">
                                <div class="col">
                                    <input type="hidden" value="{{ $nomer_order }}" name="order_number">
                                    <label for="kp" class="form-label label-order mb-1">Kode produk</label>
                                    <select required class="form-select shadow" name="kd" id="kd_produk">
                                        <option id="value" selected disabled>Masukkan kode</option>
                                        @foreach ($kda as $item)
                                                <option value="{{ $item->id }}"
                                                    data-harga="{{ $item->harga_satuan }}"
                                                    data-point="{{ $item->point }}" data-stock="{{ $item->stock }}"
                                                    data-size="{{ $item->size }}" data-barang="{{ $item->nama }}"
                                                    onclick="harga()">{{ $item->kd_produk }}-{{ $item->nama }}({{ $item->size }})
                                                </option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="hargasatuan" class="form-label label-order mb-1">Harga
                                        Satuan</label>
                                    <input required type="hidden" name="nama_barang"
                                        class="form-control input-custom shadow" id="nama_barang">
                                    <input required type="hidden" name="harga"
                                        class="form-control input-custom shadow" id="hargasatuan">
                                    <input type="text " disabled class="form-control input-custom shadow"
                                        id="tampilhargasatuan">
                                    <input required type="hidden" class="form-control input-custom shadow"
                                        id="tampilpoint" name="point">
                                </div>


                                <div class="col ">
                                    <label for="ukuran" class="form-label label-order mb-1"
                                        id="label_ukuran">Ukuran</label>
                                    <input required type="text" name="ukuran" id="ukuran"
                                        class="form-control input-custom shadow" >
                                </div>
                                <div class="col">
                                    <label for="qty" id="labelqty" class="form-label label-order mb-1">QTY</label>
                                    <input required type="number" name="qty" class="form-control input-custom shadow" id="qty" min="0">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 m-3 gap-3 py-0 ">
                        <button type="button" class="btn btn-grey py-2 px-5" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-blue px-5 py-2 " data-bs-dismiss="modal">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Delete -->
    <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-sm " role="document">
            <div class="modal-content ">
                <div class="my-5">
                    <div class="d-flex flex-column justify-content-center ">
                        <img src="{{ asset('assets/img/confirm.png') }}" alt="" width="120px" class="mx-auto">
                        <p class="fw-bold text-center my-3">Yakin Hapus Data ?</p>
                    </div>
                    <div class="d-flex justify-content-center gap-3">
                        <button class="btn btn-blue" id="btn-ya" data-bs-dismiss="modal">Ya</button>
                        <button class="btn btn-red " data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal edit order --}}
    @foreach ($keranjang as $isi)
        <div class="modal fade " id="editOrder{{ $isi->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0 m-3 py-0">
                        <h5 class="modal-title ms-auto judul-edit ">Edit Data Order</h5>
                        <button type="button" class="btn-close ms-auto " data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ url('admin/request/editkeranjang/' . $isi->id) }}">
                        @csrf
                        <div class="modal-body m-3 py-0">
                            <div class="d-flex flex-row justify-content-between gap-4  mb-4">
                                <div class="col">
                                    <label for="kp" class="form-label label-order mb-1">Nama produk</label>
                                    <select class="form-select shadow" name="kd_edit" id="kd_produk_edit">
                                        <option selected readonly value="{{ $isi->kd }}" id="value_edit">
                                            {{ $isi->barang }}</option>
                                            @foreach ($kda as $item)
                                            <option value="{{ $item->id }}"
                                                data-harga="{{ $item->harga_satuan }}"
                                                data-point="{{ $item->point }}" data-stock="{{ $item->stock }}"
                                                data-size="{{ $item->size }}" data-barang="{{ $item->nama }}"
                                                onclick="harga()">  {{ $item->nama }} ({{ $item->size }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="hargasatuan" class="form-label label-order mb-1">Edit
                                        Harga</label>
                                    <input type="hidden" name="nama_barang_edit"
                                        class="form-control input-custom shadow" value="{{ $isi->barang }}"
                                        id="nama_barang_edit">
                                    <input type="hidden" name="harga_edit" class="form-control input-custom shadow"
                                        id="hargasatuan_edit" value="{{ $isi->harga }}">
                                    <input type="text" disabled
                                        value="{{ 'Rp ' . number_format($isi->harga, 0, ',', '.') }}"
                                        class="form-control input-custom shadow" id="tampilhargasatuan_edit">
                                    <input type="hidden" class="form-control input-custom shadow" id="tampilpoint_edit"
                                        value="{{ $isi->point_per_barang }}" name="point_edit">
                                </div>

                                <div class="col ">
                                    <label for="ukuran" class="form-label label-order mb-1"
                                        id="label_ukuran">Ukuran</label>
                                    <input required type="text" name="ukuran_edit" id="ukuran"
                                        class="form-control input-custom shadow"  value="{{ $isi->ukuran }}">
                                </div>
                                <div class="col">
                                    @php
                                    $barang = DB::table('barangs')
                                            ->where('barangs.id', $isi->kd)
                                            ->first();
                                    @endphp

                                    @if ($barang)
                                        <label for="qty" id="labelqty_edit" class="form-label label-order mb-1">QTY max:{{ $barang->stock }}</label>
                                        <input type="number" name="qty_edit" class="form-control input-custom shadow"
                                            id="qty_edit" value="{{ $isi->qty }}" min="0" max="{{ $barang->stock }}">
                                    @endif

                                    <input type="hidden" name="qty_sebelumnya" class="form-control input-custom shadow "
                                        id="" value="{{ $isi->qty }}" >
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-top-0 m-3 gap-3 py-0 ">
                            <button type="button" class="btn btn-grey py-2 px-5" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-blue px-5 py-2 "
                                data-bs-dismiss="modal">Simpan</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    @endforeach
    {{-- Modal hapus order --}}
    @foreach ($keranjang as $isi)
        <div class="modal fade " id="hapusOrder{{ $isi->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content bg-white">
                    <div class="modal-header border-bottom-0 m-3 py-0">
                        <h5 class="modal-title ms-auto judul-edit ">Data Order Yang Akan Dihapus</h5>
                        <button type="button" class="btn-close ms-auto " data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body m-3">
                        <form method="POST" id="formhapusbiayalain" action="{{ route('hapusordera', $isi->id) }}">
                            @csrf
                            @method('DELETE')
                            <table class="table">
                                <tr>
                                    <td class="px-0 fs-5">Kode Produk</td>
                                    <td class="px-0 fs-5">:</td>
                                    <td class="px-0 fs-5" colspan="2" style="white-space: nowrap;">
                                        {{ $isi->kd }}</td>
                                </tr>
                                <tr>
                                    <td class="px-0 fs-5">Harga</td>
                                    <td class="px-0 fs-5">:</td>
                                    <td class="px-0 fs-5" colspan="2" style="white-space: nowrap;">
                                        {{ $isi->harga }}</td>
                                </tr>
                                <tr>
                                    <td class="px-0 fs-5">Ukuran</td>
                                    <td class="px-0 fs-5">:</td>
                                    <td class="px-0 fs-5" colspan="2" style="white-space: nowrap;">
                                        {{ $isi->ukuran }}</td>
                                </tr>
                                <tr>
                                    <td class="px-0 fs-5">Quantity</td>
                                    <td class="px-0 fs-5">:</td>
                                    <td class="px-0 fs-5" colspan="2" style="white-space: nowrap;">
                                        {{ $isi->qty }}</td>
                                </tr>
                            </table>
                            <div class="modal-footer border-top-0 m-3 gap-3 py-0 ">
                                <button type="button" class="btn btn-grey py-2 px-5"
                                    data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-danger px-5 py-2 "
                                    data-bs-dismiss="modal">Hapus</button>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    @endforeach

    <section>
        @include('partials.modal')
    </section>
@endsection


@section('js')
    <script>
        function formatRupiah(angka) {
            var reverse = angka.toString().split('').reverse().join('');
            var ribuan = reverse.match(/\d{1,3}/g);
            var hasil = ribuan.join('.').split('').reverse().join('');
            return 'Rp ' + hasil;
        }

        const subtotalElements = document.querySelectorAll("#subtotal");

        let totalSum = 0;

        subtotalElements.forEach((element) => {
            const value = parseFloat(element.value);
            if (!isNaN(value)) {
                totalSum += value;
            }
        });

        var ongkirElement = document.querySelector(".ongkir-form");
        var lainElement = document.querySelector(".biaya-form");

        var ongkir = ongkirElement ? parseInt(ongkirElement.textContent.trim().replace('Rp ', '').replace('.', '')) : 0;
        var lain = lainElement ? parseInt(lainElement.textContent.trim().replace('Rp ', '').replace('.', '')) : 0;

        var totalSemua = totalSum + ongkir + lain;

        document.getElementById('total-final-cost').textContent = formatRupiah(totalSemua);
        document.getElementById('totalbiaya').value = totalSemua;


        const selek = document.querySelectorAll("#kd_produk");
            for (let i = 0; i < selek.length; i++) {
                selek[i].addEventListener("change", function() {
                    const selectedOption = selek[i].options[selek[i].selectedIndex];
                    const harga = selectedOption.getAttribute("data-harga");
                    const barang = selectedOption.getAttribute("data-barang");
                    const point = selectedOption.getAttribute("data-point");
                    const stock = selectedOption.getAttribute("data-stock");
                    const size = selectedOption.getAttribute("data-size");

                    const parentDiv = selek[i].parentElement;
                    const namaBarangInput = parentDiv.nextElementSibling.querySelector("#nama_barang");
                    const hargaInput = parentDiv.nextElementSibling.querySelector("#hargasatuan");
                    const tampilHargaInput = parentDiv.nextElementSibling.querySelector("#tampilhargasatuan");
                    const tampilpoint = parentDiv.nextElementSibling.querySelector("#tampilpoint");
                    const qtyInput = parentDiv.nextElementSibling.nextElementSibling.nextElementSibling.querySelector("#qty");
                    const labelqty = parentDiv.nextElementSibling.nextElementSibling.nextElementSibling.querySelector("#labelqty");
                    const ukuranSelect = parentDiv.nextElementSibling.nextElementSibling.querySelector("#ukuran");

                    tampilpoint.value=point;
                    namaBarangInput.value = barang;
                    hargaInput.value = harga;
                    tampilHargaInput.value = formatRupiah(harga);
                    qtyInput.max = stock;
                    qtyInput.min = 0;
                    labelqty.innerHTML = `QTY max: ${stock}`;
                    ukuranSelect.value= size;
                });
            }
            //
            const select = document.querySelectorAll("#kd_produk_edit");
            for (let i = 0; i < select.length; i++) {
                select[i].addEventListener("change", function() {
                    const selectedOption = select[i].options[select[i].selectedIndex];
                    const tampil = selectedOption.parentElement.querySelector('#value_edit');
                    const harga = selectedOption.getAttribute("data-harga");
                    const barang = selectedOption.getAttribute("data-barang");
                    const point = selectedOption.getAttribute("data-point");
                    const stock = selectedOption.getAttribute("data-stock");
                    const size = selectedOption.getAttribute("data-size");

                    const parentDiv = select[i].parentElement;
                    const namaBarangInput = parentDiv.nextElementSibling.querySelector("#nama_barang_edit");
                    const hargaInput = parentDiv.nextElementSibling.querySelector("#hargasatuan_edit");
                    const tampilHargaInput = parentDiv.nextElementSibling.querySelector("#tampilhargasatuan_edit");
                    const tampilpoint = parentDiv.nextElementSibling.querySelector("#tampilpoint_edit");
                    const qtyInput = parentDiv.nextElementSibling.nextElementSibling.nextElementSibling.querySelector("#qty_edit");
                    const labelqty = parentDiv.nextElementSibling.nextElementSibling.nextElementSibling.querySelector("#labelqty_edit");
                    const ukuranSelect = parentDiv.nextElementSibling.nextElementSibling.querySelector("#ukuran");

                    tampilpoint.value=point;
                    tampil.textContent = barang;
                    tampil.value = barang;
                    namaBarangInput.value = barang;
                    hargaInput.value = harga;
                    tampilHargaInput.value = formatRupiah(harga);
                    qtyInput.max = stock;
                    qtyInput.min = 0;
                    labelqty.innerHTML = `QTY max: ${stock}`;
                    ukuranSelect.value= size;

                });
            }

        // local storeage
        function tampil(){

            var idlogin = document.querySelector('.idlogin').value;

            const ordernumber  = localStorage.getItem('rordernumber_' + idlogin);
            const orderdate  = localStorage.getItem('rorderdate_' + idlogin);
            document.getElementById("itanggal").value=orderdate;
            document.getElementById("tanggal").value=orderdate;

            const juragan  = localStorage.getItem('rjuragan_' + idlogin);
            document.getElementById("ijuragan").value=juragan;

            const namejuragan  = localStorage.getItem('rnamejuragan_' + idlogin);
            document.querySelector(".pjuragan").innerText=namejuragan;

            const source  = localStorage.getItem('rsource_' + idlogin);
            document.getElementById("isource").innerText=source;
            document.getElementById("isource").value=source;

            const dilayani  = localStorage.getItem('rdilayani_' + idlogin);
            document.querySelector("#dilayani").innerText=dilayani;

            const iddilayani  = localStorage.getItem('riddilayani_' + idlogin);
            document.querySelector("#iddilayani").value=iddilayani;

            const csname  = localStorage.getItem('rcsname_' + idlogin);
            document.querySelector("#pelanggan").value=csname;

            const csid  = localStorage.getItem('rcsid_' + idlogin);
            document.querySelector("#idpelanggan").value=csid;

            const notes  = localStorage.getItem('rnotes_' + idlogin);
            document.querySelector("#note").value=notes;

        }

        tampil();





        // Fungsi untuk memuat daftar provinsi
        function loadProvinsi() {
            var provinsiSelect = document.getElementById("provinsi");
            provinsiSelect.innerHTML = '<option value="">Pilih Provinsi</option>';

            fetch('https://dev.farizdotid.com/api/daerahindonesia/provinsi')
                .then(response => response.json())
                .then(data => {
                    data.provinsi.forEach(provinsi => {
                        var option = document.createElement('option');
                        option.value = provinsi.id;
                        option.text = provinsi.nama;
                        provinsiSelect.add(option);
                    });
                });
        }

        // Fungsi untuk memuat daftar kabupaten/kota berdasarkan provinsi yang dipilih
        function loadKabupaten() {
            var kabupatenSelect = document.getElementById("kota");
            kabupatenSelect.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>';

            // Menetapkan teks pilihan provinsi ke input tersembunyi
            var selectedProvinsiText = document.getElementById("provinsi").options[document.getElementById("provinsi")
                .selectedIndex].text;
            document.getElementById("namaProvinsi").value = selectedProvinsiText;

            var selectedProvinsi = document.getElementById("provinsi").value;
            if (selectedProvinsi) {
                fetch(`https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi=${selectedProvinsi}`)
                    .then(response => response.json())
                    .then(data => {
                        data.kota_kabupaten.forEach(kabupaten => {
                            var option = document.createElement('option');
                            option.value = kabupaten.id;
                            option.text = kabupaten.nama;
                            kabupatenSelect.add(option);
                        });
                    });
            }
        }

        // Fungsi untuk memuat daftar kecamatan berdasarkan kabupaten/kota yang dipilih
        function loadKecamatan() {
            var kecamatanSelect = document.getElementById("kecamatan");
            kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';

            // Menetapkan teks pilihan kabupaten/kota ke input tersembunyi
            var selectedKabupatenText = document.getElementById("kota").options[document.getElementById("kota")
                .selectedIndex].text;
            document.getElementById("namaKabupaten").value = selectedKabupatenText;

            var selectedKota = document.getElementById("kota").value;
            if (selectedKota) {
                fetch(`https://dev.farizdotid.com/api/daerahindonesia/kecamatan?id_kota=${selectedKota}`)
                    .then(response => response.json())
                    .then(data => {
                        data.kecamatan.forEach(kecamatan => {
                            var option = document.createElement('option');
                            option.value = kecamatan.id;
                            option.text = kecamatan.nama;
                            kecamatanSelect.add(option);
                        });
                    });
            }
        }

        // Menambahkan event listener untuk menetapkan teks pilihan kecamatan ke input tersembunyi ketika pilihan kecamatan berubah
        document.getElementById("kecamatan").addEventListener("change", function() {
            var selectedKecamatanText = this.options[this.selectedIndex].text;
            document.getElementById("namaKecamatan").value = selectedKecamatanText;
        });

        // Memuat daftar provinsi ketika halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            loadProvinsi();
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#jenisPelanggan').change(function() {
                // Mengambil teks dari opsi yang dipilih
                var selectedText = $(this).find('option:selected').text();
                // Menyimpan teks ke dalam input tersembunyi
                $('#jenisPelangganTeks').val(selectedText);
            });
        });
    </script>

    <script>
        function showSuksesModalPelanggan() {
            $('#suksesModalEdit').modal('show');
            setTimeout(function() {
                $('#suksesModalEdit').modal('hide');
            }, 1500);

        }

        function showErorModalPelanggan() {
            $('#erorModalEdit').modal('show');
            setTimeout(function() {
                $('#erorModalEdit').modal('hide');
            }, 1500);
        }

        function editPelanggan() {
            // Logika untuk menambah toko manual
            const formnya = document.getElementById('customerUpdate');
            if (!formnya.checkValidity()) {
                showErorModal();
                return false;
            } else {
                formnya.submit();
                showSuksesModal();
            }
        }
    </script>

    <script>
        // Mendapatkan elemen tombol switch
        var switchButton = document.getElementById('COD');

        // Mendapatkan elemen yang akan disembunyikan
        var hiddenComponents = document.getElementById('switch-COD');

        // Menambahkan event listener untuk merespons perubahan pada tombol switch
        switchButton.addEventListener('change', function() {
            // Jika tombol switch aktif, sembunyikan elemen yang diberi ID 'hiddenComponents'
            if (this.checked) {
                hiddenComponents.classList.add('d-none');
            } else {
                hiddenComponents.classList.remove('d-none');
            }
        });

        (function() {
            'use strict';

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation');

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms).forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    } else {
                        event.preventDefault();
                    }

                    form.classList.add('was-validated');
                }, false);
            });
        })();

        function showSuksesModalEdit() {
            $('#suksesModalEdit').modal('show');
            setTimeout(function() {
                $('#suksesModalEdit').modal('hide');
            }, 1200);
        }

        function showErorModalEdit() {
            $('#erorModalEdit').modal('show');
            setTimeout(function() {
                $('#erorModalEdit').modal('hide');
            }, 1200);
        }

        function search() {
            var gagal = true;

            if (gagal) {
                $('#modalNotFound').modal('show');
            } else {
                // isi dengan data sesuai pencarian
            }

        }

        function saveOrder() {
            var id_akun = document.querySelector('.idlogin').value;
                localStorage.removeItem('rordernumber_' + id_akun);
                localStorage.removeItem('rorderdate_' + id_akun);
                localStorage.removeItem('rjuragan_' + id_akun);
                localStorage.removeItem('rnamejuragan_' + id_akun);
                localStorage.removeItem('rsource_' + id_akun);
                localStorage.removeItem('rdilayani_' + id_akun);
                localStorage.removeItem('riddilayani_' + id_akun);
                localStorage.removeItem('rtanggal_' + id_akun);
                localStorage.removeItem('rcsname_' + id_akun);
                localStorage.removeItem('rcsid_' + id_akun);
                localStorage.removeItem('rnotes_' + id_akun);
                localStorage.removeItem('rcsp1_' + id_akun);
                localStorage.removeItem('rcsp2_' + id_akun);


            var berhasil = true; // Ganti dengan logika sesuai kebutuhan

            if (berhasil) {
                showSuksesModalEdit();
                setTimeout(function() {

                }, 1200);
            } else {
                showErorModalEdit();
                setTimeout(function() {

                }, 1200);
            }
        }

        function showSuksesModalAdd() {
            $('#suksesModalTambah').modal('show');
            setTimeout(function() {
                $('#suksesModalTambah').modal('hide');
            }, 1200);
        }

        function showErorModalAdd() {
            $('#erorModalTambah').modal('show');
            setTimeout(function() {
                $('#erorModalTambah').modal('hide');
            }, 1200);
        }

        function addPelanggan() {
            // Logika untuk menambah Save
            var berhasil = true; // Ganti dengan logika sesuai kebutuhan

            if (berhasil) {
                showSuksesModalAdd();
            } else {
                showErorModalAdd();
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#dance-chart').hide();
            $('.opsi').show();
            $('#infoOrder').show();
            $('#btn-OB').show();
            $('#totalhargaOrder').show();
            $('#totalongkir').hide();
            $('#totaladdcost').hide();

        });

        function tambahpesanan() {
            $('#dance-chart').hide();
            $('.opsi').show();
            $('#infoOrder').show();
            $('#btn-OB').show();
            $('#totalhargaOrder').show();
            $('#totalongkir').hide();
            $('#totaladdcost').hide();
        }

        function tambahongkir() {
            $('#dance-chart').hide();
            $('.opsi').show();
            $('#infoOrder').show();
            $('#btn-OB').show();
            $('#totalhargaOrder').show();
            if ($('#totaladdcost').is(':hidden')) { // Cek apakah #totalongkir disembunyikan
                $('#totalongkir').show();
            } else {
                $('#totaladdcost').show();
                $('#totalongkir').show();
            }
        }

        function tambahcost() {
            $('#dance-chart').hide();
            $('.opsi').show();
            $('#infoOrder').show();
            $('#btn-OB').show();
            $('#totalhargaOrder').show();
            if ($('#totalongkir').is(':hidden')) { // Cek apakah #totaladdcost disembunyikan
                $('#totaladdcost').show();
            } else {
                $('#totaladdcost').show();
                $('#totalongkir').show();
            }
        }

        // Ambil semua tombol delete
        var deleteButtons = document.querySelectorAll('.btn-dlt');

        // Tambahkan event listener pada setiap tombol delete
        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                // Ambil ID dari parent <tr> tombol delete yang diklik
                var id = this.closest('tr').id;

                // Panggil fungsi untuk menampilkan modalDelete
                $('#ModalDelete').modal('show');

                // Atur event listener untuk tombol "Ya" di dalam modalDelete
                $('#btn-ya').click(function() {
                    var berhasil = true; // Ganti dengan logika sesuai kebutuhan

                    if (berhasil) {
                        showSuksesModalDelete(); // Jalankan fungsi showmodaldelete()
                        hapusTRById(id);
                    } else {
                        showErorModalDelete();
                    }

                });
            });
        });

        // Fungsi untuk menampilkan modal Sukses Delete
        function showSuksesModalDelete() {
            $('#suksesModalDelete').modal('show');
            setTimeout(function() {
                $('#suksesModalDelete').modal('hide');
            }, 1200);
        }

        // Fungsi untuk menampilkan modal Error Delete
        function showErorModalDelete() {
            $('#erorModalDelete').modal('show');
            setTimeout(function() {
                $('#erorModalDelete').modal('hide');
            }, 1200);
        }


        // Fungsi untuk menghapus elemen <tr> berdasarkan ID
        function hapusTRById(id) {
            var element = document.getElementById(id);
            if (element) {
                element.parentNode.removeChild(element);
            }

            // Setelah menghapus, cek apakah masih ada elemen <tr> di dalam tabel
            var remainingRows = document.querySelectorAll('.btn-dlt');
            if (remainingRows.length === 0) {
                $('.opsi').hide();
                $('#infoOrder').hide();
                $('#btn-OB').hide();
                $('#totalhargaOrder').hide();
                $('#totalongkir').hide();
                $('#totaladdcost').hide();
                $('#dance-chart').show();
            }
        }

        let totalFinalCost = 0;

        function displayTotalFinalCost() {
            let totalFinalCostElement = document.getElementById('total-final-cost');
            totalFinalCostElement.innerHTML = totalFinalCost;
        }

        function updateTotalFinalCost(cost) {
            totalFinalCost = cost;
        }


        function tambahOrder(codeProduct, price, size, quantity) {
            let cp = document.getElementById("kp");
            let p = document.getElementById("ukuran")

            let selectedProduct = cp.options[cp.selectedIndex].text;
            let selectedSize = p.options[p.selectedIndex].text;

            codeProduct = selectedProduct;
            price = parseFloat(document.getElementById('hargasatuan').value);
            size = selectedSize;
            quantity = parseInt(document.getElementById('qty').value)

            let subtotal = price * quantity;

            let tableBody = document.querySelector('#order-table tbody');
            let newRow = tableBody.insertRow(tableBody.rows.length);
            newRow.id = codeProduct;
            newRow.classList.add('productCost');

            let cellAction = newRow.insertCell(0);
            let cellCodeProduct = newRow.insertCell(1);
            let cellPrice = newRow.insertCell(2);
            let cellQuantity = newRow.insertCell(3);
            let cellSubtotal = newRow.insertCell(4);

            cellAction.classList.add("col-lg-1", "py-3", "text-center");
            cellCodeProduct.classList.add("col", "py-3", "text-center");
            cellPrice.classList.add("col", "py-3", "text-center");
            cellQuantity.classList.add("col", "py-3", "text-center");
            cellSubtotal.classList.add("col", "py-3", "text-center");

            cellAction.innerHTML = `<button class="btn px-1 py-0" data-bs-toggle="modal" data-bs-target="#editOrder" onclick="showEditOrder('${newRow.id}', '${size}')">
                                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M4.92648 14.3165H1.2395C1.07652 14.3165 0.920223 14.2517 0.804982 14.1365C0.689742 14.0212 0.625 13.8649 0.625 13.702V10.2695C0.625 10.1888 0.640894 10.1089 0.671776 10.0343C0.702657 9.95978 0.747921 9.89204 0.804983 9.83498L10.0224 0.617482C10.1377 0.502241 10.294 0.4375 10.457 0.4375C10.6199 0.4375 10.7762 0.502241 10.8915 0.617482L14.3239 4.04995C14.4392 4.16519 14.5039 4.32149  14.5039 4.48446C14.5039 4.64744 14.4392 4.80374 14.3239 4.91898L4.92648 14.3165Z" stroke="black" stroke-width="0.7" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M8 2.64062L12.3015 6.94212" stroke="black" stroke-width="0.7" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </button>

                                        {{-- btn delete --}}
                                        <button class="btn btn-dlt px-1 py-0" onclick="deleteOrder('${newRow.id}')">
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M14.5027 3.98492H12.0602V3.57862C12.0602 3.00699 11.8805 2.59262 11.5171 2.33974C11.2604 2.17399 10.942 2.08984 10.5719 2.08984H7.83445C7.83232 2.08984 7.83063 2.09112 7.8285 2.09112C7.82638 2.09112 7.82468 2.08984 7.82255 2.08984H7.43622C6.47615 2.08984 5.94745 2.61854 5.94745 3.57862V3.98492H3.50625C3.42171 3.98492 3.34064 4.0185 3.28086 4.07828C3.22108 4.13806 3.1875 4.21913 3.1875 4.30367C3.1875 4.38821 3.22108 4.46928 3.28086 4.52906C3.34064 4.58884 3.42171 4.62242 3.50625 4.62242H3.78122L4.60827 15.581C4.60827 16.2742 5.0099 16.6716 5.71072 16.6716H12.2816C12.9663 16.6716 13.3684 16.2763 13.3832 15.6048L14.2107 4.62242H14.5023C14.5441 4.62245 14.5856 4.61423 14.6243 4.59824C14.663 4.58224 14.6981 4.55879 14.7277 4.52921C14.7573 4.49963 14.7808 4.46451 14.7969 4.42585C14.8129 4.38718 14.8212 4.34574 14.8212 4.30388C14.8213 4.26202 14.813 4.22057 14.7971 4.18188C14.7811 4.1432 14.7576 4.10805 14.728 4.07843C14.6984 4.04881 14.6633 4.02531 14.6247 4.00926C14.586 3.99322 14.5446 3.98495 14.5027 3.98492ZM13.5244 5.24972H4.46802L4.42085 4.62242H13.5715L13.5244 5.24972ZM6.58537 3.57862C6.58537 2.97384 6.83188 2.72734 7.43665 2.72734H10.5723C10.8179 2.72734 11.0198 2.77707 11.1626 2.86887C11.3381 2.99084 11.4232 3.22289 11.4232 3.57862V3.98492H6.58537V3.57862ZM12.747 15.5738C12.7389 15.9181 12.6216 16.0341 12.2816 16.0341H5.71072C5.36307 16.0341 5.24577 15.9198 5.24493 15.5568L4.51605 5.88679H13.4759L12.747 15.5738Z" fill="#333333"/>
                                                <path d="M7.89934 6.39196C7.85753 6.39344 7.81642 6.40315 7.77836 6.42053C7.74031 6.43791 7.70605 6.46262 7.67755 6.49325C7.64905 6.52388 7.62687 6.55983 7.61227 6.59904C7.59768 6.63825 7.59096 6.67995 7.59249 6.72176L7.89169 14.9472C7.89466 15.0296 7.92943 15.1076 7.98871 15.1649C8.04798 15.2222 8.12715 15.2543 8.20959 15.2545L8.22149 15.2541C8.2633 15.2526 8.30441 15.2429 8.34247 15.2255C8.38053 15.2081 8.41478 15.1834 8.44328 15.1528C8.47178 15.1221 8.49396 15.0862 8.50856 15.047C8.52315 15.0078 8.52988 14.9661 8.52834 14.9243L8.22957 6.69838C8.22319 6.52243 8.07954 6.37666 7.89934 6.39196ZM5.92352 6.39238C5.83921 6.39827 5.76069 6.43739 5.70523 6.50114C5.64976 6.5649 5.62188 6.64808 5.62772 6.73238L6.19254 14.9578C6.19803 15.0383 6.23386 15.1137 6.29279 15.1687C6.35173 15.2238 6.42936 15.2545 6.51002 15.2545L6.53254 15.2536C6.61684 15.2478 6.69536 15.2086 6.75083 15.1449C6.8063 15.0811 6.83418 14.9979 6.82834 14.9136L6.26352 6.68818C6.25698 6.60413 6.21768 6.52601 6.15407 6.47068C6.09047 6.41534 6.00766 6.38722 5.92352 6.39238ZM10.0817 6.39196C9.90364 6.37496 9.75787 6.52286 9.75192 6.69881L9.45229 14.9243C9.4507 14.9661 9.45738 15.0078 9.47196 15.047C9.48653 15.0863 9.50871 15.1222 9.53722 15.1529C9.56573 15.1835 9.60001 15.2082 9.63809 15.2256C9.67618 15.243 9.71731 15.2526 9.75914 15.2541L9.77104 15.2545C9.85348 15.2543 9.93265 15.2222 9.99192 15.1649C10.0512 15.1076 10.086 15.0296 10.0889 14.9472L10.3886 6.72176C10.3902 6.67994 10.3835 6.63821 10.3689 6.59898C10.3543 6.55974 10.3321 6.52377 10.3036 6.49313C10.2751 6.46249 10.2408 6.43778 10.2028 6.42042C10.1647 6.40305 10.1235 6.39338 10.0817 6.39196ZM12.0575 6.39238C11.9734 6.38734 11.8907 6.41549 11.8271 6.47081C11.7635 6.52612 11.7242 6.60417 11.7175 6.68818L11.1527 14.9136C11.1469 14.9979 11.1748 15.0811 11.2302 15.1449C11.2857 15.2086 11.3642 15.2478 11.4485 15.2536L11.471 15.2545C11.5517 15.2544 11.6292 15.2237 11.6882 15.1686C11.7471 15.1136 11.7829 15.0383 11.7885 14.9578L12.3533 6.73238C12.3592 6.64808 12.3313 6.5649 12.2758 6.50114C12.2204 6.43739 12.1418 6.39827 12.0575 6.39238Z" fill="#333333"/>
                                            </svg>
                                        </button>`;
            cellCodeProduct.innerHTML = codeProduct;
            cellPrice.innerHTML = price;
            cellQuantity.innerHTML = quantity;
            cellSubtotal.innerHTML = subtotal;

            let totalProductCost = 0;
            let subtotals = document.querySelectorAll('.productCost td:nth-child(5)');
            subtotals.forEach(subtotal => {
                totalProductCost += parseFloat(subtotal.innerHTML);
            });

            totalFinalCost += subtotal;
            updateTotalFinalCost(totalFinalCost);
            displayTotalFinalCost();
        }

        function addShippingCost(shippingCost, label) {
            shippingCost = parseFloat(document.getElementById('ongkir-nominal').value);
            label = document.getElementById('jasa-ongkir').value;

            let tableFoot = document.querySelector('#order-table tfoot');
            let newRow = tableFoot.insertRow(0);
            newRow.id = `row-${label}`;
            newRow.classList.add("text-right", "shippingCost");

            let cellAction = newRow.insertCell(0);
            let cellTitle = newRow.insertCell(1);
            let cellAdditional = newRow.insertCell(2);
            let cellLabel = newRow.insertCell(3);
            let cellCost = newRow.insertCell(4);

            cellAction.classList.add("col", "py-3", "text-center");
            cellTitle.classList.add("col", "py-3", "text-center");
            cellAdditional.setAttribute('colspan', '1');
            cellLabel.classList.add("col", "py-3", "text-center");
            cellCost.classList.add("col", "py-3", "text-center");

            cellAction.innerHTML = `
            <button class="btn px-1 py-0" data-bs-toggle="modal" data-bs-target="#editOngkir" onclick="showEditShippingCost()">
                                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M4.92648 14.3165H1.2395C1.07652 14.3165 0.920223 14.2517 0.804982 14.1365C0.689742 14.0212 0.625 13.8649 0.625 13.702V10.2695C0.625 10.1888 0.640894 10.1089 0.671776 10.0343C0.702657 9.95978 0.747921 9.89204 0.804983 9.83498L10.0224 0.617482C10.1377 0.502241 10.294 0.4375 10.457 0.4375C10.6199 0.4375 10.7762 0.502241 10.8915 0.617482L14.3239 4.04995C14.4392 4.16519 14.5039 4.32149  14.5039 4.48446C14.5039 4.64744 14.4392 4.80374 14.3239 4.91898L4.92648 14.3165Z" stroke="black" stroke-width="0.7" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M8 2.64062L12.3015 6.94212" stroke="black" stroke-width="0.7" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </button>

                                        {{-- btn delete --}}
                                        <button class="btn btn-dlt px-1 py-0" onclick="deleteShippingCost()">
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M14.5027 3.98492H12.0602V3.57862C12.0602 3.00699 11.8805 2.59262 11.5171 2.33974C11.2604 2.17399 10.942 2.08984 10.5719 2.08984H7.83445C7.83232 2.08984 7.83063 2.09112 7.8285 2.09112C7.82638 2.09112 7.82468 2.08984 7.82255 2.08984H7.43622C6.47615 2.08984 5.94745 2.61854 5.94745 3.57862V3.98492H3.50625C3.42171 3.98492 3.34064 4.0185 3.28086 4.07828C3.22108 4.13806 3.1875 4.21913 3.1875 4.30367C3.1875 4.38821 3.22108 4.46928 3.28086 4.52906C3.34064 4.58884 3.42171 4.62242 3.50625 4.62242H3.78122L4.60827 15.581C4.60827 16.2742 5.0099 16.6716 5.71072 16.6716H12.2816C12.9663 16.6716 13.3684 16.2763 13.3832 15.6048L14.2107 4.62242H14.5023C14.5441 4.62245 14.5856 4.61423 14.6243 4.59824C14.663 4.58224 14.6981 4.55879 14.7277 4.52921C14.7573 4.49963 14.7808 4.46451 14.7969 4.42585C14.8129 4.38718 14.8212 4.34574 14.8212 4.30388C14.8213 4.26202 14.813 4.22057 14.7971 4.18188C14.7811 4.1432 14.7576 4.10805 14.728 4.07843C14.6984 4.04881 14.6633 4.02531 14.6247 4.00926C14.586 3.99322 14.5446 3.98495 14.5027 3.98492ZM13.5244 5.24972H4.46802L4.42085 4.62242H13.5715L13.5244 5.24972ZM6.58537 3.57862C6.58537 2.97384 6.83188 2.72734 7.43665 2.72734H10.5723C10.8179 2.72734 11.0198 2.77707 11.1626 2.86887C11.3381 2.99084 11.4232 3.22289 11.4232 3.57862V3.98492H6.58537V3.57862ZM12.747 15.5738C12.7389 15.9181 12.6216 16.0341 12.2816 16.0341H5.71072C5.36307 16.0341 5.24577 15.9198 5.24493 15.5568L4.51605 5.88679H13.4759L12.747 15.5738Z" fill="#333333"/>
                                                <path d="M7.89934 6.39196C7.85753 6.39344 7.81642 6.40315 7.77836 6.42053C7.74031 6.43791 7.70605 6.46262 7.67755 6.49325C7.64905 6.52388 7.62687 6.55983 7.61227 6.59904C7.59768 6.63825 7.59096 6.67995 7.59249 6.72176L7.89169 14.9472C7.89466 15.0296 7.92943 15.1076 7.98871 15.1649C8.04798 15.2222 8.12715 15.2543 8.20959 15.2545L8.22149 15.2541C8.2633 15.2526 8.30441 15.2429 8.34247 15.2255C8.38053 15.2081 8.41478 15.1834 8.44328 15.1528C8.47178 15.1221 8.49396 15.0862 8.50856 15.047C8.52315 15.0078 8.52988 14.9661 8.52834 14.9243L8.22957 6.69838C8.22319 6.52243 8.07954 6.37666 7.89934 6.39196ZM5.92352 6.39238C5.83921 6.39827 5.76069 6.43739 5.70523 6.50114C5.64976 6.5649 5.62188 6.64808 5.62772 6.73238L6.19254 14.9578C6.19803 15.0383 6.23386 15.1137 6.29279 15.1687C6.35173 15.2238 6.42936 15.2545 6.51002 15.2545L6.53254 15.2536C6.61684 15.2478 6.69536 15.2086 6.75083 15.1449C6.8063 15.0811 6.83418 14.9979 6.82834 14.9136L6.26352 6.68818C6.25698 6.60413 6.21768 6.52601 6.15407 6.47068C6.09047 6.41534 6.00766 6.38722 5.92352 6.39238ZM10.0817 6.39196C9.90364 6.37496 9.75787 6.52286 9.75192 6.69881L9.45229 14.9243C9.4507 14.9661 9.45738 15.0078 9.47196 15.047C9.48653 15.0863 9.50871 15.1222 9.53722 15.1529C9.56573 15.1835 9.60001 15.2082 9.63809 15.2256C9.67618 15.243 9.71731 15.2526 9.75914 15.2541L9.77104 15.2545C9.85348 15.2543 9.93265 15.2222 9.99192 15.1649C10.0512 15.1076 10.086 15.0296 10.0889 14.9472L10.3886 6.72176C10.3902 6.67994 10.3835 6.63821 10.3689 6.59898C10.3543 6.55974 10.3321 6.52377 10.3036 6.49313C10.2751 6.46249 10.2408 6.43778 10.2028 6.42042C10.1647 6.40305 10.1235 6.39338 10.0817 6.39196ZM12.0575 6.39238C11.9734 6.38734 11.8907 6.41549 11.8271 6.47081C11.7635 6.52612 11.7242 6.60417 11.7175 6.68818L11.1527 14.9136C11.1469 14.9979 11.1748 15.0811 11.2302 15.1449C11.2857 15.2086 11.3642 15.2478 11.4485 15.2536L11.471 15.2545C11.5517 15.2544 11.6292 15.2237 11.6882 15.1686C11.7471 15.1136 11.7829 15.0383 11.7885 14.9578L12.3533 6.73238C12.3592 6.64808 12.3313 6.5649 12.2758 6.50114C12.2204 6.43739 12.1418 6.39827 12.0575 6.39238Z" fill="#333333"/>
                                            </svg>
                                        </button>
            `
            cellTitle.innerHTML = 'Biaya Pengiriman';
            cellLabel.innerHTML = label;
            cellCost.innerHTML = shippingCost;

            totalFinalCost += shippingCost;
            updateTotalFinalCost(totalFinalCost);
            displayTotalFinalCost();

            let shippingCostContainer = document.querySelector('.shippingCost');
            // validation
            if (tableFoot.contains(shippingCostContainer)) {
                const shippingCostButton = document.getElementById('shippingButton');
                shippingCostButton.classList.add('d-none');
            } else {
                const shippingCostButton = document.getElementById('shippingButton');
                shippingCostButton.classList.remove('d-none');
            }
        }

        function addAdditionalCost(additionalCost, label) {
            additionalCost = parseFloat(document.getElementById('costnominal').value);
            label = document.getElementById('addcostlabel').value;

            let tableFoot = document.querySelector('#order-table tfoot');
            let newRow = tableFoot.insertRow(0);
            newRow.id = `row-${label}`;
            newRow.classList.add("text-right", "additionalCost");

            let cellAction = newRow.insertCell(0);
            let cellTitle = newRow.insertCell(1);
            let cellAdditional = newRow.insertCell(2);
            let cellLabel = newRow.insertCell(3);
            let cellCost = newRow.insertCell(4);

            cellAction.classList.add("col", "py-3", "text-center");
            cellTitle.classList.add("col", "py-3", "text-center");
            cellAdditional.setAttribute('colspan', '1');
            cellLabel.classList.add("col", "py-3", "text-center");
            cellCost.classList.add("col", "py-3", "text-center");

            cellAction.innerHTML = `<button class="btn px-1 py-0" data-bs-toggle="modal" data-bs-target="#editbiayalain" onclick="showEditAdditionalCost()">
                                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M4.92648 14.3165H1.2395C1.07652 14.3165 0.920223 14.2517 0.804982 14.1365C0.689742 14.0212 0.625 13.8649 0.625 13.702V10.2695C0.625 10.1888 0.640894 10.1089 0.671776 10.0343C0.702657 9.95978 0.747921 9.89204 0.804983 9.83498L10.0224 0.617482C10.1377 0.502241 10.294 0.4375 10.457 0.4375C10.6199 0.4375 10.7762 0.502241 10.8915 0.617482L14.3239 4.04995C14.4392 4.16519 14.5039 4.32149  14.5039 4.48446C14.5039 4.64744 14.4392 4.80374 14.3239 4.91898L4.92648 14.3165Z" stroke="black" stroke-width="0.7" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M8 2.64062L12.3015 6.94212" stroke="black" stroke-width="0.7" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </button>

                                        {{-- btn delete --}}
                                        <button class="btn btn-dlt px-1 py-0" onclick="deleteAdditionalCost()">
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M14.5027 3.98492H12.0602V3.57862C12.0602 3.00699 11.8805 2.59262 11.5171 2.33974C11.2604 2.17399 10.942 2.08984 10.5719 2.08984H7.83445C7.83232 2.08984 7.83063 2.09112 7.8285 2.09112C7.82638 2.09112 7.82468 2.08984 7.82255 2.08984H7.43622C6.47615 2.08984 5.94745 2.61854 5.94745 3.57862V3.98492H3.50625C3.42171 3.98492 3.34064 4.0185 3.28086 4.07828C3.22108 4.13806 3.1875 4.21913 3.1875 4.30367C3.1875 4.38821 3.22108 4.46928 3.28086 4.52906C3.34064 4.58884 3.42171 4.62242 3.50625 4.62242H3.78122L4.60827 15.581C4.60827 16.2742 5.0099 16.6716 5.71072 16.6716H12.2816C12.9663 16.6716 13.3684 16.2763 13.3832 15.6048L14.2107 4.62242H14.5023C14.5441 4.62245 14.5856 4.61423 14.6243 4.59824C14.663 4.58224 14.6981 4.55879 14.7277 4.52921C14.7573 4.49963 14.7808 4.46451 14.7969 4.42585C14.8129 4.38718 14.8212 4.34574 14.8212 4.30388C14.8213 4.26202 14.813 4.22057 14.7971 4.18188C14.7811 4.1432 14.7576 4.10805 14.728 4.07843C14.6984 4.04881 14.6633 4.02531 14.6247 4.00926C14.586 3.99322 14.5446 3.98495 14.5027 3.98492ZM13.5244 5.24972H4.46802L4.42085 4.62242H13.5715L13.5244 5.24972ZM6.58537 3.57862C6.58537 2.97384 6.83188 2.72734 7.43665 2.72734H10.5723C10.8179 2.72734 11.0198 2.77707 11.1626 2.86887C11.3381 2.99084 11.4232 3.22289 11.4232 3.57862V3.98492H6.58537V3.57862ZM12.747 15.5738C12.7389 15.9181 12.6216 16.0341 12.2816 16.0341H5.71072C5.36307 16.0341 5.24577 15.9198 5.24493 15.5568L4.51605 5.88679H13.4759L12.747 15.5738Z" fill="#333333"/>
                                                <path d="M7.89934 6.39196C7.85753 6.39344 7.81642 6.40315 7.77836 6.42053C7.74031 6.43791 7.70605 6.46262 7.67755 6.49325C7.64905 6.52388 7.62687 6.55983 7.61227 6.59904C7.59768 6.63825 7.59096 6.67995 7.59249 6.72176L7.89169 14.9472C7.89466 15.0296 7.92943 15.1076 7.98871 15.1649C8.04798 15.2222 8.12715 15.2543 8.20959 15.2545L8.22149 15.2541C8.2633 15.2526 8.30441 15.2429 8.34247 15.2255C8.38053 15.2081 8.41478 15.1834 8.44328 15.1528C8.47178 15.1221 8.49396 15.0862 8.50856 15.047C8.52315 15.0078 8.52988 14.9661 8.52834 14.9243L8.22957 6.69838C8.22319 6.52243 8.07954 6.37666 7.89934 6.39196ZM5.92352 6.39238C5.83921 6.39827 5.76069 6.43739 5.70523 6.50114C5.64976 6.5649 5.62188 6.64808 5.62772 6.73238L6.19254 14.9578C6.19803 15.0383 6.23386 15.1137 6.29279 15.1687C6.35173 15.2238 6.42936 15.2545 6.51002 15.2545L6.53254 15.2536C6.61684 15.2478 6.69536 15.2086 6.75083 15.1449C6.8063 15.0811 6.83418 14.9979 6.82834 14.9136L6.26352 6.68818C6.25698 6.60413 6.21768 6.52601 6.15407 6.47068C6.09047 6.41534 6.00766 6.38722 5.92352 6.39238ZM10.0817 6.39196C9.90364 6.37496 9.75787 6.52286 9.75192 6.69881L9.45229 14.9243C9.4507 14.9661 9.45738 15.0078 9.47196 15.047C9.48653 15.0863 9.50871 15.1222 9.53722 15.1529C9.56573 15.1835 9.60001 15.2082 9.63809 15.2256C9.67618 15.243 9.71731 15.2526 9.75914 15.2541L9.77104 15.2545C9.85348 15.2543 9.93265 15.2222 9.99192 15.1649C10.0512 15.1076 10.086 15.0296 10.0889 14.9472L10.3886 6.72176C10.3902 6.67994 10.3835 6.63821 10.3689 6.59898C10.3543 6.55974 10.3321 6.52377 10.3036 6.49313C10.2751 6.46249 10.2408 6.43778 10.2028 6.42042C10.1647 6.40305 10.1235 6.39338 10.0817 6.39196ZM12.0575 6.39238C11.9734 6.38734 11.8907 6.41549 11.8271 6.47081C11.7635 6.52612 11.7242 6.60417 11.7175 6.68818L11.1527 14.9136C11.1469 14.9979 11.1748 15.0811 11.2302 15.1449C11.2857 15.2086 11.3642 15.2478 11.4485 15.2536L11.471 15.2545C11.5517 15.2544 11.6292 15.2237 11.6882 15.1686C11.7471 15.1136 11.7829 15.0383 11.7885 14.9578L12.3533 6.73238C12.3592 6.64808 12.3313 6.5649 12.2758 6.50114C12.2204 6.43739 12.1418 6.39827 12.0575 6.39238Z" fill="#333333"/>
                                            </svg>
                                        </button>`;
            cellTitle.innerHTML = 'Biaya Lainnya';
            cellLabel.innerHTML = label;
            cellCost.innerHTML = additionalCost;

            totalFinalCost += additionalCost;
            updateTotalFinalCost(totalFinalCost);
            displayTotalFinalCost();

            let additionalCostContainer = document.querySelector('.additionalCost');
            // validation
            if (tableFoot.contains(additionalCostContainer)) {
                const additionalCostButton = document.getElementById('additionalButton');
                additionalCostButton.classList.add('d-none');
            }
        }

        // buat function show edit order per id
        function showEditOrder(id, size) {
            let row = document.getElementById(id);

            let codeProduct = row.querySelector('td:nth-child(2)').innerHTML;
            let price = parseFloat(row.querySelector('td:nth-child(3)').innerHTML);
            let quantity = row.querySelector('td:nth-child(4)').innerHTML;
            let productSize = size;

            let codeProductOption = document.getElementById('edit-kp');
            let sizeOption = document.getElementById('edit-ukuran');

            for (let i = 0; i < codeProductOption.options.length; i++) {
                if (codeProductOption.options[i].label === codeProduct) {
                    codeProductOption.selectedIndex = i;
                    break;
                }
            }

            document.getElementById('edit-hargasatuan').value = price;

            for (let i = 0; i < sizeOption.options.length; i++) {
                if (sizeOption.options[i].label === productSize) {
                    sizeOption.selectedIndex = i;
                    break;
                }
            }

            document.getElementById('edit-qty').value = quantity;
        }

        function showEditShippingCost() {
            let shippingCost = parseFloat(document.querySelector('.shippingCost td:nth-child(5)').innerHTML);
            let shippingLabel = document.querySelector('.shippingCost td:nth-child(4)').innerHTML;

            document.getElementById('edit-ongkir-nominal').value = shippingCost;
            document.getElementById('edit-jasa-ongkir').value = shippingLabel;
        }

        function editShippingCost(newShippingCost, newShippingLabel) {
            newShippingCost = parseFloat(document.getElementById('edit-ongkir-nominal').value);
            newShippingLabel = document.getElementById('edit-jasa-ongkir').value;

            let tableFoot = document.querySelector('#order-table tfoot');
            let shippingCostContainer = document.querySelector('.shippingCost');
            let shippingCostValue = parseFloat(document.querySelector('.shippingCost td:nth-child(5)').innerHTML);

            if (tableFoot.contains(shippingCostContainer)) {
                totalFinalCost -= shippingCostValue;
                updateTotalFinalCost(totalFinalCost);
                displayTotalFinalCost();

                let shippingCost = document.querySelector('.shippingCost td:nth-child(5)');
                let shippingCostLabel = document.querySelector('.shippingCost td:nth-child(4)');

                shippingCost.innerHTML = newShippingCost;
                shippingCostLabel.innerHTML = newShippingLabel;

                totalFinalCost += newShippingCost;
                updateTotalFinalCost(totalFinalCost);
                displayTotalFinalCost();
            }
            // console.log(shippingCostLabel);
        }

        function showEditAdditionalCost() {
            let additionalCost = parseFloat(document.querySelector('.additionalCost td:nth-child(5)').innerHTML);
            let additionalLabel = document.querySelector('.additionalCost td:nth-child(4)').innerHTML;

            document.getElementById('edit-costnominal').value = additionalCost;
            document.getElementById('edit-addcostlabel').value = additionalLabel;
        }

        function editAdditionalCost(newAdditionalCost, newAdditionalLabel) {
            newAdditionalCost = parseFloat(document.getElementById('edit-costnominal').value);
            newAdditionalLabel = document.getElementById('edit-addcostlabel').value;

            let tableFoot = document.querySelector('#order-table tfoot');
            let additionalCostContainer = document.querySelector('.additionalCost');
            let additionalCostValue = parseFloat(document.querySelector('.additionalCost td:nth-child(5)').innerHTML);

            if (tableFoot.contains(additionalCostContainer)) {
                totalFinalCost -= additionalCostValue;
                updateTotalFinalCost(totalFinalCost);
                displayTotalFinalCost();

                let additionalCost = document.querySelector('.additionalCost td:nth-child(5)');
                let additionalLabel = document.querySelector('.additionalCost td:nth-child(4)');

                additionalCost.innerHTML = newAdditionalCost;
                additionalLabel.innerHTML = newAdditionalLabel;

                totalFinalCost += newAdditionalCost;
                updateTotalFinalCost(totalFinalCost);
                displayTotalFinalCost();
            }
        }

        function deleteOrder(id) {
            let row = document.getElementById(id);
            let subtotal = parseFloat(row.querySelector('td:nth-child(5)').innerHTML);

            var txt = "Are you sure you want to delete this order?";
            var r = confirm(txt);
            if (r == true) {
                let totalProductCost = 0;
                let subtotals = document.querySelectorAll('.productCost td:nth-child(5)');
                subtotals.forEach(subtotal => {
                    totalProductCost += parseFloat(subtotal.innerHTML);
                });

                totalFinalCost -= subtotal;
                updateTotalFinalCost(totalFinalCost);
                displayTotalFinalCost();

                row.remove();
            }
        }

        function deleteShippingCost() {
            let tableFoot = document.querySelector('#order-table tfoot');
            let shippingCostContainer = document.querySelector('.shippingCost');

            if (tableFoot.contains(shippingCostContainer)) {
                let shippingCost = parseFloat(document.querySelector('.shippingCost td:nth-child(5)').innerHTML);
                totalFinalCost -= shippingCost;
                updateTotalFinalCost(totalFinalCost);
                displayTotalFinalCost();
                var txt;
                var r = confirm("Are you sure you want to delete this shipping cost?");
                if (r == true) {
                    shippingCostContainer.remove();
                }
            }

            let shippingCostButton = document.getElementById('shippingButton');
            shippingCostButton.classList.remove('d-none');
        }

        function deleteAdditionalCost() {
            let tableFoot = document.querySelector('#order-table tfoot');
            let additionalCostContainer = document.querySelector('.additionalCost');

            if (tableFoot.contains(additionalCostContainer)) {
                let additionalCost = parseFloat(document.querySelector('.additionalCost td:nth-child(5)').innerHTML);
                totalFinalCost -= additionalCost;
                updateTotalFinalCost(totalFinalCost);
                displayTotalFinalCost();
                var txt;
                var r = confirm("Are you sure you want to delete this additional cost?");
                if (r == true) {
                    additionalCostContainer.remove();
                }
            }

            let additionalCostButton = document.getElementById('additionalButton');
            additionalCostButton.classList.remove('d-none');
        }
    </script>
@endsection
