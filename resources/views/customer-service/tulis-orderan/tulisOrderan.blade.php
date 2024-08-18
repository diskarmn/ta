@extends('layouts.mainCS')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/request.css') }}">
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
@endsection

@section('konten')
    <div class="container-fluid p-4">
        <div class="body-reqEdit flex-column p-4 " style=" border: 1.5px solid black; border-radius: 10px;">
            <form method="POST" id="formDataPelanggan" action="{{ url('cs/tulisOrderan/keorders') }}">
                @csrf
                {{-- info req --}}
                <div class="d-flex flex-row justify-content-between mb-4 gap-5" id="form-juragan">
                    <div class="col">
                        <label for="opsi-juragan" class="label-order mb-0">Juragan</label>
                        <input type="hidden" id="nama-juragan" name="namajuragan">
                        <select class="form-select form-select-lg shadow" id="opsi-juragan"  name="juragan_f">
                            <option selected readonly  id="local-juragan" >Pilih Juragan
                            </option>
                            @foreach ($juragan as $juragannya)
                            <option value="{{ $juragannya->id }}" data-name="{{ $juragannya->name_juragan }}">{{ $juragannya->name_juragan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label for="opsi-orderan" class="label-order mb-0">Asal Orderan </label>
                        <select class="form-select form-select-lg shadow" id="opsi-orderan" name="sumber_f">
                            <option selected readonly id="local-sumber" >Pilih asal</option>
                            <option value="Blibli">Blibli</option>
                            <option value="Bukalapal">Bukalapak</option>
                            <option value="Facebook">Facebook</option>
                            <option value="Instagram">Instagram</option>
                            <option value="Lazada">Lazada</option>
                            <option value="Offline Store/COD">Offline Store/COD</option>
                            <option value="OLX">OLX</option>
                            <option value="Shopee">Shopee</option>
                            <option value="Tokopedia">Tokopedia</option>
                            <option value="Web/App lain">Web/App lain</option>
                            <option value="WhatsApp">WhatsApp</option>
                            <option value="Zalora">Zalora</option>
                        </select>
                    </div>
                  {{-- <  <div class="col">
                        label for="opsi-cs" class="label-order mb-0">Dilayani Oleh</label>
                        <select class="form-select form-select-lg shadow" id="opsi-cs" name="served_by">
                            <option selected readonly class="bg-secondary text-white" id="local-cs">Pilih CS</option>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="col">
                        <label for="opsi-cs" class="label-order mb-0">Dilayani Oleh</label>
                        <input type="text" readonly value="{{ $profile->name }}"
                            class="form-control form-control-lg input-custom shadow ">
                        <input type="hidden" value="{{ $profile->id }}" name="served_by">
                    </div>
                    <div class="col">
                        <label for="tanggal-order" class="label-order mb-0">Tanggal Order </label>
                        <input type="date" class="form-control form-control-lg input-custom shadow " id="tanggal-order"
                            name="tanggal_order">
                    </div>
                </div>

                {{-- pelanggan --}}
                <div class="d-flex col-lg-6 flex-column mb-4">

                    <label for="pelanggan" class="label-order mb-0">Pelanggan</label>
                    <div class="input-group rounded bg-white shadow rounded" id="data-pelanggan">
                        <input type="text" class="form-control border-0 rounded m-1 text-capitalize text-muted"
                            placeholder="Cari Pelanggan" selected  style="font-family: montserrat;" id="pelanggan"
                            readonly value="">

                        <input type="hidden" class="form-control border-0 rounded m-1 text-capitalize text-muted"
                            placeholder="Cari Pelanggan" style="font-family: montserrat;" id="coba" value=""
                            name="id_pelanggan_keorder">


                        <div class="d-flex align-items-center gap-1 mx-1">
                            <button class="btn btn-purple px-5 py-1 rounded" data-bs-toggle="modal" data-bs-target="#search"
                                type="button">Cari</button>
                        </div>
                    </div>
                </div>

                {{-- keterangan --}}
                <div class="d-flex col-lg-8 flex-column mb-4" id="note-juragan">
                    <label for="note" class="label-order">Note / Keterangan</label>
                    <textarea class="form-control shadow rounded" id="note" rows="10" style="resize:none; white-space:pre-line;"
                        name="note"></textarea>
                </div>

                {{-- tab order --}}
                <div class="shadow tab-order mb-4">
                    <div class="border-0 d-flex align-items-center gap-1 ">
                        <div class="bg-white border-0 px-4 py-2 rounded-top label-order">Order</div>
                        <button class="btn p-0 border-0 rounded btn-add" type="button" data-bs-toggle="modal"
                            data-bs-target="#addOrder" onclick="tambahorder()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32"
                                fill="none">
                                <path id="tambahorder"
                                    d="M20.8183 16.904H16.6754V21.0468C16.6754 21.2666 16.5882 21.4773 16.4328 21.6327C16.2774 21.7881 16.0666 21.8754 15.8469 21.8754C15.6271 21.8754 15.4164 21.7881 15.261 21.6327C15.1056 21.4773 15.0183 21.2666 15.0183 21.0468V16.904H10.8754C10.6557 16.904 10.4449 16.8167 10.2896 16.6613C10.1342 16.5059 10.0469 16.2951 10.0469 16.0754C10.0469 15.8556 10.1342 15.6449 10.2896 15.4895C10.4449 15.3341 10.6557 15.2468 10.8754 15.2468H15.0183V11.104C15.0183 10.8842 15.1056 10.6735 15.261 10.5181C15.4164 10.3627 15.6271 10.2754 15.8469 10.2754C16.0666 10.2754 16.2774 10.3627 16.4328 10.5181C16.5882 10.6735 16.6754 10.8842 16.6754 11.104V15.2468H20.8183C21.0381 15.2468 21.2488 15.3341 21.4042 15.4895C21.5596 15.6449 21.6469 15.8556 21.6469 16.0754C21.6469 16.2951 21.5596 16.5059 21.4042 16.6613C21.2488 16.8167 21.0381 16.904 20.8183 16.904Z"
                                    fill="#626262" />
                            </svg>
                        </button>
                    </div>
                    <div class="bg-white">
                        <div class="card px-3 border-0 mb-3">
                            <table class="table table-borderless mb-0">
                                <thead class="text-center small border border-0 border-bottom ">
                                    <tr>
                                        <td class="opsi col-lg-1"></td>
                                        <th colspan="1" class="col py-3">Produk</th>
                                        <th class="col py-3">Harga</th>
                                        <th class="col py-3">Qty</th>
                                        <th class="col py-3">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody id="infoOrder">
                                    @foreach ($keranjang as $isi)
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
                                                <input type="hidden" value="{{ $isi->kd }}" name="kd_produk_f[]">
                                                <input type="hidden" value="{{ $isi->ukuran }}" name="size_f[]">
                                                {{ $isi->barang }}
                                            </td>
                                            <td class="col py-3 harga-satuan" id="harga-satuan">
                                                <input type="hidden" value="{{ $isi->harga }}" name="harga_f">
                                                {{ 'Rp ' . number_format($isi->harga, 0, ',', '.') }}
                                                <input type="hidden" readonly class="form-control input-custom shadow"
                                                id="inputpoint" name="point_v[]"  value="{{ $isi->point }}"></td>
                                            </td>
                                            <td class="col py-3 jumlah-barang" id="jumlah-barang">
                                                <input type="hidden" value="{{ $isi->qty }}" name="qty_f[]">
                                                {{ $isi->qty }}
                                            </td>
                                            <td class="col py-3 harga-barang" id="harga-barang">
                                                <input type="hidden" value="{{ $isi->subtotal }}" name="subtotal_f[]">
                                                {{ 'Rp ' . number_format($isi->subtotal, 0, ',', '.') }}
                                            </td>

                                        </tr>
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
                                                <td class="col py-3 ongkirnya">
                                                    <input type="hidden" name="jasa_ongkir" value="{{ $item->jasa_ongkir }}">
                                                    {{ $item->jasa_ongkir }}</td>
                                                <td class="col py-3 ongkir-form">
                                                    <input type="hidden" name="ongkir" value="{{ $item->ongkir }}">
                                                    {{ 'Rp ' . number_format($item->ongkir, 0, ',', '.') }}</td>
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
                                                <td class="col py-3 biaya-lain">
                                                    <input type="hidden" name="jasa_biaya_lain" value="{{ $item->jasa_biaya_lain }}">
                                                    {{ $item->jasa_biaya_lain }}</td>
                                                <td class="col py-3 biaya-form">
                                                    <input type="hidden" name="biaya_lain" value="{{ $item->biaya_lain }}">
                                                    {{ 'Rp ' . number_format($item->biaya_lain, 0, ',', '.') }}</td>
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
                        </div>
                        <div id="totalhargaOrder">
                            <div class="d-flex flex-row justify-content-between align-items-center p-3 mx-4">
                                <p class="fw-bold small">TOTAL</p>
                                <input type="hidden" value="{{ $total_semua }}" name="total_f">
                                <h5 class="fw-bold total-harga-semua" style="color: #0091ff;">
                                    {{ 'Rp ' . number_format($total_semua, 0, ',', '.') }}</h5>
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
                <div class=" d-flex gap-3">
                    <a href="/cs/semua-orderan" class="btn btn-grey py-2 px-5">Batal</a>
                    <button type="submit" class="btn btn-blue py-2 px-5" onclick="hapuslocal()">Simpan</button>
                    {{-- <button type="submit" class="btn btn-blue py-2 px-5" onclick="saveOrder()">Simpan</button> --}}

                </div>
            </form>
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

                    <form method="POST" id="formongkir" action="{{ url('cs/tulisOrderan/ongkir') }}">
                        @csrf
                        <div class="mb-4 ">
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
    @foreach ($ongkir as $item)
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
                            action="{{ url('cs/tulisOrderan/editongkir/' . $item->id) }}">
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
                            action="{{ url('cs/tulisOrderan/deleteongkir/' . $item->id) }}">
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
                    <form method="POST" id="formbiayalain" action="{{ url('cs/tulisOrderan/lain') }}">
                        @csrf
                        <div class="mb-3 ">
                            <label for="costnominal" class="form-label h6 mb-1">Nominal</label>
                            <input type="number" class="form-control form-control-lg input-custom shadow mb-2"
                                id="costnominal" required name="biaya_lain">
                            <div class="small">Gunakan tanda (-) untuk mengurangi. <br>misal untuk diskon : -20000</div>
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
                            action="{{ url('cs/tulisOrderan/editlain/' . $item->id) }}">
                            @csrf
                            <div class="mb-3 ">
                                <label for="costnominal" class="form-label h6 mb-1">Nominal</label>
                                <input type="number" class="form-control form-control-lg input-custom shadow mb-2"
                                    name="biaya_lain_edit" id="costnominal" required value="{{ $item->biaya_lain }}">
                                <div class="small">Gunakan tanda (-) untuk mengurangi. <br>misal untuk diskon : -20000
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
                            action="{{ url('cs/tulisOrderan/deletelain/' . $item->id) }}">
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
                <form method="POST" id="tambahForm" action="{{ url('cs/tulisOrderan/keranjang') }}">
                    @csrf

                    <div class="modal-body m-3 py-0 wadahulang">
                        <div class="diulang">
                        <div class="d-flex flex-row justify-content-between gap-4  mb-4">
                            <div class="col">
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
                                <label for="hargasatuan" class="form-label label-order mb-1">Harga Satuan</label>
                                <input required type="hidden" name="nama_barang"
                                    class="form-control input-custom shadow" id="nama_barang">
                                <input required type="hidden" name="harga" class="form-control input-custom shadow"
                                    id="hargasatuan">
                                <input type="text " disabled class="form-control input-custom shadow"
                                    id="tampilhargasatuan">
                                <input required type="hidden"  class="form-control input-custom shadow"
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
                    <form method="POST" action="{{ url('cs/tulisOrderan/editkeranjang/' . $isi->id) }}">
                        @csrf
                        <div class="modal-body m-3 py-0">
                            <div class="d-flex flex-row justify-content-between gap-4  mb-4">
                                <div class="col">
                                    <label for="kp" class="form-label label-order mb-1">Nama produk</label>
                                    <select  class="form-select shadow" name="kd_edit" id="kd_produk_edit">
                                        <option selected readonly value="{{ $isi->kd }}" id="value_edit">{{ $isi->barang }}</option>
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
                                    <label for="hargasatuan" class="form-label label-order mb-1">Edit Harga</label>
                                    <input  type="hidden" name="nama_barang_edit"
                                        class="form-control input-custom shadow" value="{{ $isi->barang }}" id="nama_barang_edit">
                                    <input  type="hidden" name="harga_edit"
                                        class="form-control input-custom shadow" id="hargasatuan_edit" value="{{ $isi->harga }}" >
                                    <input type="text" disabled
                                        value="{{ 'Rp ' . number_format($isi->harga, 0, ',', '.') }}"
                                        class="form-control input-custom shadow" id="tampilhargasatuan_edit">
                                    <input type="hidden" class="form-control input-custom shadow"
                                    id="tampilpoint_edit" value="{{ $isi->point_per_barang }}" name="point_edit">
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
                                    <label for="qty" id="labelqty_edit" class="form-label label-order mb-1">QTY max:{{ $barang->stock }}</label>

                                    <input type="number" name="qty_edit" class="form-control input-custom shadow"
                                        id="qty_edit" value="{{ $isi->qty }}" min="0" max="{{ $barang->stock }}">


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
                        <form method="POST" id="formhapusbiayalain" action="{{ route('hapusordercs', $isi->id) }}">
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

    <!-- Modal show cs-->
    @foreach ($cs as $data)
        <div class="modal fade modal-lg" id="showcs{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <div class="d-flex flex-column">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Data <b>{{ $data->name }}</b></h1>
                        <p>{{ $data->id }}</p>
                        </div>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="kanankiri justify-content-between w-100 row">

                            <div class="mb-2 pb-1  col-6  border-secondary">
                                <p class="p-1"><b>Nama Pelanggan</b></p>
                                <p class="border-bottom p-1">{{ $data->name }}</p>
                            </div>
                            <div class="mb-2 pb-1 col-6 border-secondary">
                                <p class="p-1"><b>E-Mail Pelanggan</b></p>
                                <p class="border-bottom p-1">{{ $data->email }}</p>
                            </div>
                        </div>
                        <div class="kanankiri justify-content-between w-100 row">

                            <div class="mb-2 pb-1 col-6 border-secondary">
                                <p class="p-1"><b>Phone Pelanggan</b></p>
                                <p class="border-bottom p-1">{{ $data->phone }}</p>
                            </div>
                        <div class="mb-2 col-6 pb-1 border-secondary">
                            <p class="p-1"><b>Phone2 Pelanggan</b></p>
                            <p class="border-bottom p-1">{{ $data->phone2 }}</p>
                        </div>
                        </div>


                        <div class="mb-2  pb-1 border-secondary">
                                    <p class="p-1"><b>Alamat Pelanggan</b></p>
                                    <p class="border-bottom p-1">{{ $data->address }}</p>
                        </div>
                        <div id="switch">
                            <div class="kanankiri justify-content-between w-100 row">
                                <div class="mb-2 pb-1  col-6 border-secondary">
                                    <p class="p-1"><b>Kabupaten Pelanggan</b></p>
                                    <p class="border-bottom p-1">{{ $data->kabupaten }}</p>
                                </div>
                                <div class="mb-2 pb-1 col-6  border-secondary">
                                    <p class="p-1"><b>Provinsi Pelanggan</b></p>
                                    <p class="border-bottom p-1">{{ $data->provinsi }}</p>
                                </div>
                            </div>
                            <div class="kanankiri justify-content-between w-100 row">

                                <div class="mb-2 pb-1  col-6 border-secondary">
                                    <p class="p-1"><b>Kecamatan Pelanggan</b></p>
                                    <p class="border-bottom p-1">{{ $data->kecamatan }}</p>
                                </div>
                                <div class="mb-2 col-6 pb-1 border-secondary">
                                    <p class="p-1"><b>Kode Pos Pelanggan</b></p>
                                    <p class="border-bottom p-1">{{ $data->kodepos }}</p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-dismiss="modal"
                            data-bs-target="#search">Kembali</button>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal"
                            onclick="local()">OK</button>
                    </div>
                </div>

            </div>
        </div>
    @endforeach

    {{-- Modal add pelanggan --}}
    <div class="modal fade" id="tambahpelanggan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header border-bottom-0 m-3 py-0 ">
                    <h5 class="modal-title ms-auto">Tambah Data pelanggan</h5>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body m-3 py-0">

                    <form method="POST" id="formDataPelanggan" action="{{ url('cs/tulisOrderan/addcs') }}">
                        @csrf
                        <div class="mb-4 ">
                            <label for="nama-pelanggan" class="form-label label-order mb-1">Nama Pelanggan</label>
                            <input type="text" class="form-control form-control-lg  input-custom shadow"
                                id="nama-pelanggan" required name="add_nama_pelanggan">
                            <div class="invalid-feedback">
                                Masukkan nama pelanggan
                            </div>
                        </div>

                        <div class="mb-4 ">
                            <label for="email-pelanggan" class="form-label label-order mb-1">Email Pelanggan</label>
                            <input type="email" class="form-control form-control-lg  input-custom shadow"
                                id="email-pelanggan" required name="add_email_pelanggan">
                            <div class="invalid-feedback">
                                Masukkan email pelanggan
                            </div>
                        </div>
                        <div class="d-flex row">
                            <div class="col-md-6 mb-2" id="tambah-hp-1">
                                <label for="hp-1" class="form-label label-order mb-1">HP 1</label>
                                <input type="telp" minlength="10" maxlength="13"
                                    class="form-control form-control-lg  input-custom shadow " id="hp-1"
                                    oninput="this.value = this.value.replace(/\D/g, '')" required
                                    name="add_phone_pelanggan">
                            </div>
                            <div class="col-md-6 mb-4 " id="tambah-hp-2">
                                <label for="hp-2" class="form-label label-order mb-1">HP 2 (Optional) </label>
                                <input type="telp" minlength="10" maxlength="13"
                                    class="form-control form-control-lg  input-custom shadow " id="hp-2"
                                    oninput="this.value = this.value.replace(/\D/g, '')" name="add_phone2_pelanggan">
                            </div>
                        </div>
                        <div class="mb-4 ">
                            <label for="alamat" class="form-label label-order mb-1">Alamat</label>
                            <textarea type="text" class="form-control form-control-lg  input-custom shadow " id="alamat" rows="3"
                                required name="add_alamat_pelanggan"></textarea>
                            <div class="invalid-feedback">
                                Masukkan alamat
                            </div>
                        </div>

                        <div class="row d-flex">
                            <div class="col-md-6 mb-4">
                                <label for="provinsi2" class="form-label label-order mb-1">Provinsi</label>

                                <select class="form-select form-select-lg  shadow" onchange="loadKabupaten()" required
                                    id="provinsiadd" name="add_provinsi_pelanggan">
                                    <option value="">Pilih Provinsi</option>
                                </select>
                                <div class="invalid-feedback">
                                    Masukkan provinsi
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="kabupaten2" class="form-label label-order mb-1">Kab / kota</label>
                                <select class="form-select form-select-lg  shadow" id="kabupatenadd"
                                    name="add_kabupaten_pelanggan" onchange="loadKecamatan()" required>
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
                                <select class="form-select form-select-lg  shadow" id="kecamatanadd" required
                                    name="add_kecamatan_pelanggan">
                                    <option value="">Pilih Kecamatan</option>
                                </select>
                                <div class="invalid-feedback">
                                    Masukkan kecamatan
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <label for="kodepos2" class="form-label label-order mb-1">Kode Pos </label>
                                <input type="number" class="form-control form-control-lg  input-custom shadow "
                                    name="add_kodepos_pelanggan" maxlength="5" id="kodepos2" required>
                                <div class="invalid-feedback">
                                    Masukkan kodepos
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center my-3 ">
                            <button type="button" class="btn btn-grey py-2  px-5" data-bs-target="#search"
                                data-bs-dismiss="modal" data-bs-toggle="modal">Kembali</button>
                            <button type="submit" class="btn btn-blue px-5 py-2" data-bs-dismiss="modal"
                                onclick="addPelanggan()">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal search pelanggan --}}
    <div class="modal fade" id="search" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content " style="">
                <div class="modal-header border-bottom-0 m-3 py-0 ">
                    <h5 class="modal-title ms-auto">Data Pelanggan</h5>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body mb-5 py-0 ">

                    <div class="manual d-flex justify-content-center">

                        <input type="text"
                            class="form-control  input-select2 border-0 rounded m-1 text-capitalize text-muted"
                            placeholder="Cari Pelanggan" style="font-family: montserrat;" id="manual" value="">
                        <div class="bungkus-option d-flex flex-column">

                            @foreach ($cs as $data)
                                <button class="btn px-1 py-0 kedepan text-start" onclick="modalganti(this)"
                                    type="button" data-bs-toggle="modal" data-bs-dismiss="modal"
                                    data-bs-target="#showcs{{ $data->id }}">
                                    {{ $data->name }}
                                    <input type="hidden" value="{{ $data->id }}" id="mengirim">
                                </button>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer mt-5 mb-3 justify-content-center">
                        <button type="button" class="btn btn-blue px-5 mt-5 py-2" data-bs-target="#tambahpelanggan"
                            data-bs-dismiss="modal" data-bs-toggle="modal">Tambah Pelanggan</button>

                    </div>
                </div>

                <!--  <div class="modal-body m-5 py-0 ">
                            <form action="" id="formpelanggan">
                                <div class="mb-4 ">
                                    <label for="id-pelanggan" class="form-label label-order mb-1">ID Pelanggan</label>
                                    <input type="text" class="form-control form-control-lg  input-custom shadow text-black "
                                        value="ID12345678" id="id-pelanggan"disabled readonly>
                                </div>
                                <div class="mb-4 ">
                                    <label for="nama-pelanggan" class="form-label label-order mb-1">Nama Pelanggan</label>
                                    <input type="text" class="form-control form-control-lg  input-custom shadow"
                                        id="nama-pelanggan" required value="">

                                    <div class="mb-4 ">
                                        <label for="email-pelanggan" class="form-label label-order mb-1">E-Mail Pelanggan</label>
                                        <input type="email" class="form-control form-control-lg  input-custom shadow"
                                            id="email-pelanggan" required value="">

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
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox" role="switch" id="COD" checked>
                                        <label class="form-check-label" for="COD">COD</label>
                                    </div>

                                    <div class="d-none" id="switch-COD">
                                        <div class="mb-4 ">
                                            <label for="alamat" class="form-label label-order mb-1">Alamat</label>
                                            <textarea type="text" class="form-control form-control-lg  input-custom shadow" id="alamat2" rows="3"
                                                required></textarea>
                                        </div>

                                        <div class="row d-flex">
                                            <div class="col-md-6 mb-4">
                                                <label for="provinsi2" class="form-label label-order mb-1">Provinsi</label>
                                                <select class="form-select form-select-lg  shadow" id="provinsi"
                                                    onchange="loadKabupaten()" required>
                                                    <option id="provinsi2" value>Pilih Provinsi</option>
                                                </select>

                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <label for="kabupaten2" class="form-label label-order mb-1">Kab / kota</label>
                                                <select class="form-select form-select-lg  shadow" onchange="loadKecamatan()"
                                                    required id="kabupaten">
                                                    <option id="kabupaten2" value="">Pilih Kab/ Kota</option>
                                                </select>

                                            </div>
                                        </div>

                                        <div class="row d-flex mb-4">
                                            <div class="col-md-6">
                                                <label for="kecamatan2" class="form-label label-order mb-1">Kecamatan</label>
                                                <select class="form-select form-select-lg  shadow" id="kecamatan" required>
                                                    <option id="kecamatan2" value="">Pilih Kecamatan</option>
                                                </select>

                                            </div>
                                            <div class="col-md-6 ">
                                                <label for="kodepos2" class="form-label label-order mb-1">Kode Pos </label>
                                                <input type="number" class="form-control form-control-lg  input-custom shadow "
                                                    maxlength="5" id="kodepos2" required>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center my-3 ">
                                        <button type="button" class="btn btn-blue px-5 py-2" data-bs-dismiss="modal"
                                            >Kembali</button>
                                    </div>
                            </form>
                        </div>
                    </div>-->
            </div>
        </div>


        {{-- Modal add pelanggan --}}
        {{-- <div class="modal fade" id="modaladdpelanggan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
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
                                value="ID12345678" id="id-pelanggan" disabled readonly>
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
                            <label for="email-pelanggan" class="form-label label-order mb-1">Email Pelanggan</label>
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
                                <select class="form-select form-select-lg  shadow"
                                    onchange="loadKabupaten()" required id="provinsi">
                                    <option value="">Pilih Provinsi</option>
                                </select>
                                <div class="invalid-feedback">
                                    Masukkan provinsi
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="kabupaten2" class="form-label label-order mb-1">Kab / kota</label>
                                <select class="form-select form-select-lg  shadow" id="kabupaten"
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
                                <select class="form-select form-select-lg  shadow" id="kecamatan" required>
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
    </div> --}}

        <!-- Modal not found -->







        <section>
            @include('partials.modal')
        </section>
    @endsection


    @section('js')
        {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}

        <script>
            document.getElementById('manual').addEventListener('input', function() {

                var input, filter, option, bungkusOption, i, txtValue;
                input = document.getElementById('manual');
                filter = input.value.toUpperCase();
                bungkusOption = document.getElementsByClassName('bungkus-option')[0];
                option = bungkusOption.getElementsByClassName('kedepan');
                for (i = 0; i < option.length; i++) {
                    txtValue = option[i].textContent || option[i].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        option[i].style.display = "";
                    } else {
                        option[i].style.display = "none";
                    }
                }
            });
            var search = document.querySelector(".input-select2");
            var bungkus = document.querySelector(".bungkus-option");
            var option = document.querySelectorAll(".kedepan");
            document.querySelectorAll('.kedepan').forEach(item => {
                item.addEventListener('click', event => {
                    document.getElementById('manual').value = event.target.innerText;
                    document.getElementById('pelanggan').value = event.target.innerText;
                    bungkus.classList.remove('muncul');
                    bungkus.style.display = "none";
                    for (let i = 0; i < option.length; i++) {
                        option[i].classList.remove('muncul');
                        option[i].style.display = "none";
                    }
                });
            });

            search.addEventListener('click', function() {
                if (bungkus.classList.contains('muncul')) {
                    bungkus.classList.remove('muncul');
                    bungkus.style.display = "none";
                    for (let i = 0; i < option.length; i++) {
                        option[i].classList.remove('muncul');
                        option[i].style.display = "none";
                    }
                } else {
                    bungkus.classList.add('muncul');
                    bungkus.style.display = "inline-block";
                    for (let i = 0; i < option.length; i++) {
                        option[i].classList.add('muncul');
                        option[i].style.display = "inline-block";
                    }
                }
            });

            const options = document.querySelectorAll(".option");
            options.forEach(option => {
                option.addEventListener("click", function() {
                    const customerId = this.getAttribute("data-id");
                    document.getElementById("customer_id").value = customerId;
                });
            });


            function formatRupiah(angka) {
                var reverse = angka.toString().split('').reverse().join('');
                var ribuan = reverse.match(/\d{1,3}/g);
                var hasil = ribuan.join('.').split('').reverse().join('');
                return 'Rp ' + hasil;
            }


            function tambahkan(){
                 event.preventDefault();
                let jumlah = parseInt(document.getElementById("jumlah").value);
                if (jumlah > 5) {
                    this.value = 5;
                    jumlah = 5;
                }
                let divs = document.querySelectorAll('.diulang');
                for (let i = 1; i < jumlah; i++) {
                        let clone = divs[0].cloneNode(true);
                        document.querySelector('.wadahulang').appendChild(clone);
                    }

            }


            const selectElement = document.getElementById('opsi-juragan');
            const inputElement = document.getElementById('nama-juragan');

            selectElement.addEventListener('change', function() {
                inputElement.value = this.options[this.selectedIndex].getAttribute('data-name');
            });



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




            function tambahorder(){
                var id_akun = '{{ $id_lokal }}';

                var note = document.getElementById('note').value;
                 localStorage.setItem('note_' + id_akun, note);

                 var juraganSelect = document.getElementById('opsi-juragan');
                 var selectedJuragan = juraganSelect.options[juraganSelect.selectedIndex];
                 var juraganName = selectedJuragan.dataset.name;
                localStorage.setItem('juragan_' + id_akun, juraganName);
                var juraganId = selectedJuragan.value;
                localStorage.setItem('juragan_id_' + id_akun, juraganId);


                // var csSelect = document.getElementById('opsi-cs');
                // var selectedCs = csSelect.options[csSelect.selectedIndex];
                // var csName = selectedCs.text;
                // localStorage.setItem('cs_' + id_akun, csName);
                // var csId = selectedCs.value;
                // localStorage.setItem('cs_id_' + id_akun, csId);


                var orderanSelect = document.getElementById('opsi-orderan');
                var selectedOrderan = orderanSelect.options[orderanSelect.selectedIndex];
                var orderanValue = selectedOrderan.value;
                localStorage.setItem('sumber_' + id_akun, orderanValue);

                var tanggalOrder = document.getElementById('tanggal-order').value;
                localStorage.setItem('tanggal_' + id_akun, tanggalOrder);
            }

            function modalganti(button) {

                var id = button.querySelector('#mengirim').value;
                document.getElementById('coba').value = id;
                $("#modalSearch").modal('hide');

                var id_akun = '{{ $id_lokal }}';

                var nama = button.innerText.trim();
                localStorage.setItem('nama_' + id_akun, nama);
                var id = button.querySelector('input[type="hidden"]').value;
                  localStorage.setItem('id_' + id_akun, id);

                  var note = document.getElementById('note').value;
                 localStorage.setItem('note_' + id_akun, note);

                 var juraganSelect = document.getElementById('opsi-juragan');
                 var selectedJuragan = juraganSelect.options[juraganSelect.selectedIndex];
                 var juraganName = selectedJuragan.dataset.name;
                localStorage.setItem('juragan_' + id_akun, juraganName);
                var juraganId = selectedJuragan.value;
                localStorage.setItem('juragan_id_' + id_akun, juraganId);


                // var csSelect = document.getElementById('opsi-cs');
                // var selectedCs = csSelect.options[csSelect.selectedIndex];
                // var csName = selectedCs.text;
                // localStorage.setItem('cs_' + id_akun, csName);
                // var csId = selectedCs.value;
                // localStorage.setItem('cs_id_' + id_akun, csId);


                var orderanSelect = document.getElementById('opsi-orderan');
                var selectedOrderan = orderanSelect.options[orderanSelect.selectedIndex];
                var orderanValue = selectedOrderan.value;
                localStorage.setItem('sumber_' + id_akun, orderanValue);

                var tanggalOrder = document.getElementById('tanggal-order').value;
                localStorage.setItem('tanggal_' + id_akun, tanggalOrder);

            }


            function tampil() {
                var id_akun = '{{ $id_lokal }}';
                const savedText = localStorage.getItem('nama_'+id_akun);
                document.getElementById('pelanggan').value = savedText;
                const id = localStorage.getItem('id_'+id_akun);
                document.getElementById('coba').value = id;

                const juragan=localStorage.getItem('juragan_'+id_akun);
                const juraganId=localStorage.getItem('juragan_id_'+id_akun);
                const note=localStorage.getItem('note_'+id_akun);
                const sumber=localStorage.getItem('sumber_'+id_akun);
                const tanggal=localStorage.getItem('tanggal_'+id_akun);

                if (juragan) {
                    document.getElementById('local-juragan').innerText = juragan !== 'null' ? juragan : 'Pilih Juragan';
                } else {
                    document.getElementById('local-juragan').innerText = 'Pilih Juragan';
                }

                if (sumber) {
                    document.getElementById('local-sumber').innerText = sumber !== 'null' ? sumber : 'Pilih Sumber';
                } else {
                    document.getElementById('local-sumber').innerText = 'Pilih Sumber';
                }


                // const cs=localStorage.getItem('cs_'+id_akun);
                // const csId=localStorage.getItem('cs_id_'+id_akun);
                // if (cs) {
                //     document.getElementById('local-cs').innerText = cs !== 'null' ? cs : 'Pilih Cs';
                // } else {
                //     document.getElementById('local-cs').innerText = 'Pilih Cs';
                // }
                // document.getElementById('local-cs').value = csId;



                document.getElementById('local-juragan').value = juraganId;
                document.getElementById('nama-juragan').value = juragan;
                document.getElementById('local-juragan').setAttribute('data-name', juragan);

                document.getElementById('local-sumber').value = sumber;


                document.getElementById('tanggal-order').value = tanggal;
                document.getElementById('tanggal-order').innerText = tanggal;
                document.getElementById('note').innerText = note;
                document.getElementById('note').value = note;

            }
            tampil();

            function hapuslocal(){
                var id_akun = '{{ $id_lokal }}';
                localStorage.removeItem('nama_' + id_akun);
                localStorage.removeItem('id_' + id_akun);
                localStorage.removeItem('juragan_' + id_akun);
                localStorage.removeItem('juragan_id_' + id_akun);
                localStorage.removeItem('sumber_' + id_akun);
                // localStorage.removeItem('cs_' + id_akun);
                // localStorage.removeItem('cs_id_' + id_akun);
                localStorage.removeItem('tanggal_' + id_akun);
                localStorage.removeItem('note_' + id_akun);
            }

            function tambahongkir() {
                $('#dance-chart').hide();
                $('.opsi').show();
                $('#infoOrder').show();
                $('#btn-OB').show();
                $('#totalhargaOrder').show();
                if ($('#totaladdcost').is(':hidden')) {
                    $('#totalongkir').show();
                } else {
                    $('#totaladdcost').show();
                    $('#totalongkir').show();
                }

                // var jasaOngkir = document.getElementById("jasa-ongkir").value;
                // document.querySelector(".ongkirnya").innerText = jasaOngkir;

                // var ongkirNominal = document.getElementById("ongkir-nominal").value;
                // document.querySelector(".ongkir-form").innerText = formatRupiah(ongkirNominal);
                // //
                // let totalBiaya = 0;
                // document.querySelectorAll(".harga-barang").forEach(elem => {
                //     let biaya = parseInt(elem.innerText.replace("Rp ", "").replace(/\./g, ''));
                //     totalBiaya += biaya;
                // });
                // let ongkir = parseInt(document.querySelector(".ongkir-form").innerText.replace("Rp ", "").replace(/\./g, ''));
                // let lain = parseInt(document.querySelector(".biaya-form").innerText.replace("Rp ", "").replace(/\./g, ''));
                // let totalHargaSemua = totalBiaya + ongkir + lain;
                // document.querySelector(".total-harga-semua").innerText = formatRupiah(totalHargaSemua);
            }

            function tambahcost() {
                $('#dance-chart').hide();
                $('.opsi').show();
                $('#infoOrder').show();
                $('#btn-OB').show();
                $('#totalhargaOrder').show();
                if ($('#totalongkir').is(':hidden')) {
                    $('#totaladdcost').show();
                } else {
                    $('#totaladdcost').show();
                    $('#totalongkir').show();
                }

                // var jasa = document.getElementById("addcostlabel").value;
                // document.querySelector(".biaya-lain").innerText = jasa;

                // var jasaNominal = document.getElementById("costnominal").value;
                // document.querySelector(".biaya-form").innerText = formatRupiah(jasaNominal);

                // //
                // let totalBiaya = 0;
                // document.querySelectorAll(".harga-barang").forEach(elem => {
                //     let biaya = parseInt(elem.innerText.replace("Rp ", "").replace(/\./g, ''));
                //     totalBiaya += biaya;
                // });
                // let ongkir = parseInt(document.querySelector(".ongkir-form").innerText.replace("Rp ", "").replace(/\./g, ''));
                // let lain = parseInt(document.querySelector(".biaya-form").innerText.replace("Rp ", "").replace(/\./g, ''));
                // let totalHargaSemua = totalBiaya + ongkir + lain;
                // document.querySelector(".total-harga-semua").innerText = formatRupiah(totalHargaSemua);
            }

            function totalin() {
                event.preventDefault();
                let total = 0;
                let totalBiaya = 0;
                document.querySelectorAll(".harga-barang").forEach(elem => {
                    let biaya = parseInt(elem.innerText.replace("Rp ", "").replace(/\./g, ''));
                    totalBiaya += biaya;
                });
                let ongkir = parseInt(document.querySelector(".ongkir-form").innerText.replace("Rp ", "").replace(/\./g,
                    ''));
                let lain = parseInt(document.querySelector(".biaya-form").innerText.replace("Rp ", "").replace(/\./g,
                    ''));
                let totalHargaSemua = totalBiaya + ongkir + lain;
                document.querySelector(".total-harga-semua").innerText = formatRupiah(totalHargaSemua);
            }
            document.addEventListener("DOMContentLoaded", function() {
                totalin();

            });
        </script>
        <script>
            // Function to load provinces
            function loadProvinsi() {
                var provinsiSelect = document.getElementById("provinsiadd");
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


            // Function to load cities (kota/kabupaten)
            function loadKabupaten() {
                var kabupatenSelect = document.getElementById("kabupatenadd");
                kabupatenSelect.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>';

                var selectedProvinsi = document.getElementById("provinsiadd").value;
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

            // Function to load districts (kecamatan)
            function loadKecamatan() {
                var kecamatanSelect = document.getElementById("kecamatanadd");
                kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';

                var selectedKota = document.getElementById("kabupatenadd").value;
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

            // Initial load of provinces
            loadProvinsi();


            function ambilNama() {
                var nama = document.getElementById("nama").text;
                var phone = document.getElementById("phone").value;
                var phone2 = document.getElementById("phone2").value;
                var provinsi = document.getElementById("provinsip").value;
                var kabupaten = document.getElementById("kabupatenp").value;
                var kecamatan = document.getElementById("kecamatanp").value;
                var kodepos = document.getElementById("kodeposp").value;
                var cs_id = document.getElementById("cs_id").value;
                var alamat = document.getElementById("alamatp").value;
                var email = document.getElementById("emailp").value;

                document.getElementById("nama-pelanggan").value = nama;
                document.getElementById("hp-1").value = phone;
                document.getElementById("hp-2").value = phone2;
                document.getElementById("provinsi2").innerText = provinsi;
                document.getElementById("provinsi2").value = provinsi;
                document.getElementById("kabupaten2").innerText = kabupaten;
                document.getElementById("kecamatan2").innerText = kecamatan;
                document.getElementById("kodepos2").value = kodepos;
                document.getElementById("id-pelanggan").value = cs_id;
                document.getElementById("alamat2").value = alamat;
                document.getElementById("email-pelanggan").value = email;

            }
        </script>

        <script>
            // Mendapatkan elemen tombol switch


            var switchButton = document.querySelectorAll('#COD');
            for (let i = 0; i < switchButton.length; i++) {
                switchButton[i].addEventListener('change', function() {
                    var switchElement = this.parentNode.nextElementSibling;
                    if (this.checked) {
                        switchElement.style.display = 'inline-block';
                    } else {
                        switchElement.style.display = 'none';
                    }
                });
            }




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
                // Logika untuk Save
                var berhasil = true; // Ganti dengan logika sesuai kebutuhan

                if (berhasil) {
                    showSuksesModalEdit();
                    setTimeout(function() {
                        window.location.href = '/cs/semua-orderan';
                    }, 1200);
                } else {
                    showErorModalEdit();
                    setTimeout(function() {
                        window.location.href = '/cs/semua-orderan';
                    }, 1200);
                }
            }

            function editPelanggan() {
                var berhasil = true;

                if (berhasil) {
                    showSuksesModalEdit();
                } else {
                    showErorModalEdit();
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
            function formatRupiah(angka) {
                var reverse = angka.toString().split('').reverse().join('');
                var ribuan = reverse.match(/\d{1,3}/g);
                var hasil = ribuan.join('.').split('').reverse().join('');
                return 'Rp ' + hasil;
            }

            function totalin() {
                event.preventDefault();
                let total = 0;
                let totalBiaya = 0;
                document.querySelectorAll(".harga-barang").forEach(elem => {
                    let biaya = parseInt(elem.innerText.replace("Rp ", "").replace(/\./g, ''));
                    totalBiaya += biaya;
                });
                let ongkir = parseInt(document.querySelector(".ongkir-form").innerText.replace("Rp ", "").replace(/\./g, ''));
                let lain = parseInt(document.querySelector(".biaya-form").innerText.replace("Rp ", "").replace(/\./g, ''));
                let totalHargaSemua = totalBiaya + ongkir + lain;
                document.querySelector(".total-harga-semua").innerText = formatRupiah(totalHargaSemua);
            }
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
                // let kode = document.querySelector("#kd_produk").value;
                const kode = document.getElementById("kd_produk").value;
                console.log(kode);
                let harga = document.querySelector("#harga").value;
                let size = document.querySelector("#ukuran").value;
                let qty = document.querySelector("#qty").value;
                let hargarp = formatRupiah(harga);
                let total = harga * qty;
                let totalrp = formatRupiah(total);
                // let isi = ` <tr class="text-center small border border-0  border-bottom tr-harga" id="dataOrder">
        //     <td class="col-lg-1">
        //         <button class="btn px-1 py-0" data-bs-toggle="modal" data-id="" onclick="prepareEditModal()" data-bs-target="#editOrder" type="button">

        //                                     <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
        //                                         xmlns="http://www.w3.org/2000/svg">
        //                                         <path
        //                                             d="M4.92648 14.3165H1.2395C1.07652 14.3165 0.920223 14.2517 0.804982 14.1365C0.689742 14.0212 0.625 13.8649 0.625 13.702V10.2695C0.625 10.1888 0.640894 10.1089 0.671776 10.0343C0.702657 9.95978 0.747921 9.89204 0.804983 9.83498L10.0224 0.617482C10.1377 0.502241 10.294 0.4375 10.457 0.4375C10.6199 0.4375 10.7762 0.502241 10.8915 0.617482L14.3239 4.04995C14.4392 4.16519 14.5039 4.32149 14.5039 4.48446C14.5039 4.64744 14.4392 4.80374 14.3239 4.91898L4.92648 14.3165Z"
        //                                             stroke="black" stroke-width="0.7" stroke-linecap="round"
        //                                             stroke-linejoin="round" />
        //                                         <path d="M8 2.64062L12.3015 6.94212" stroke="black" stroke-width="0.7"
        //                                             stroke-linecap="round" stroke-linejoin="round" />
        //                                     </svg>
        //                                 </button>

        //                                 {{-- btn delete --}}
        //                                 <button class="btn px-1 py-0 btn-dlt">
        //                                     <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
        //                                         xmlns="http://www.w3.org/2000/svg">
        //                                         <path
        //                                             d="M14.5027 3.98492H12.0602V3.57862C12.0602 3.00699 11.8805 2.59262 11.5171 2.33974C11.2604 2.17399 10.942 2.08984 10.5719 2.08984H7.83445C7.83232 2.08984 7.83063 2.09112 7.8285 2.09112C7.82638 2.09112 7.82468 2.08984 7.82255 2.08984H7.43622C6.47615 2.08984 5.94745 2.61854 5.94745 3.57862V3.98492H3.50625C3.42171 3.98492 3.34064 4.0185 3.28086 4.07828C3.22108 4.13806 3.1875 4.21913 3.1875 4.30367C3.1875 4.38821 3.22108 4.46928 3.28086 4.52906C3.34064 4.58884 3.42171 4.62242 3.50625 4.62242H3.78122L4.60827 15.581C4.60827 16.2742 5.0099 16.6716 5.71072 16.6716H12.2816C12.9663 16.6716 13.3684 16.2763 13.3832 15.6048L14.2107 4.62242H14.5023C14.5441 4.62245 14.5856 4.61423 14.6243 4.59824C14.663 4.58224 14.6981 4.55879 14.7277 4.52921C14.7573 4.49963 14.7808 4.46451 14.7969 4.42585C14.8129 4.38718 14.8212 4.34574 14.8212 4.30388C14.8213 4.26202 14.813 4.22057 14.7971 4.18188C14.7811 4.1432 14.7576 4.10805 14.728 4.07843C14.6984 4.04881 14.6633 4.02531 14.6247 4.00926C14.586 3.99322 14.5446 3.98495 14.5027 3.98492ZM13.5244 5.24972H4.46802L4.42085 4.62242H13.5715L13.5244 5.24972ZM6.58537 3.57862C6.58537 2.97384 6.83188 2.72734 7.43665 2.72734H10.5723C10.8179 2.72734 11.0198 2.77707 11.1626 2.86887C11.3381 2.99084 11.4232 3.22289 11.4232 3.57862V3.98492H6.58537V3.57862ZM12.747 15.5738C12.7389 15.9181 12.6216 16.0341 12.2816 16.0341H5.71072C5.36307 16.0341 5.24577 15.9198 5.24493 15.5568L4.51605 5.88679H13.4759L12.747 15.5738Z"
        //                                             fill="#333333" />
        //                                         <path
        //                                             d="M7.89934 6.39196C7.85753 6.39344 7.81642 6.40315 7.77836 6.42053C7.74031 6.43791 7.70605 6.46262 7.67755 6.49325C7.64905 6.52388 7.62687 6.55983 7.61227 6.59904C7.59768 6.63825 7.59096 6.67995 7.59249 6.72176L7.89169 14.9472C7.89466 15.0296 7.92943 15.1076 7.98871 15.1649C8.04798 15.2222 8.12715 15.2543 8.20959 15.2545L8.22149 15.2541C8.2633 15.2526 8.30441 15.2429 8.34247 15.2255C8.38053 15.2081 8.41478 15.1834 8.44328 15.1528C8.47178 15.1221 8.49396 15.0862 8.50856 15.047C8.52315 15.0078 8.52988 14.9661 8.52834 14.9243L8.22957 6.69838C8.22319 6.52243 8.07954 6.37666 7.89934 6.39196ZM5.92352 6.39238C5.83921 6.39827 5.76069 6.43739 5.70523 6.50114C5.64976 6.5649 5.62188 6.64808 5.62772 6.73238L6.19254 14.9578C6.19803 15.0383 6.23386 15.1137 6.29279 15.1687C6.35173 15.2238 6.42936 15.2545 6.51002 15.2545L6.53254 15.2536C6.61684 15.2478 6.69536 15.2086 6.75083 15.1449C6.8063 15.0811 6.83418 14.9979 6.82834 14.9136L6.26352 6.68818C6.25698 6.60413 6.21768 6.52601 6.15407 6.47068C6.09047 6.41534 6.00766 6.38722 5.92352 6.39238ZM10.0817 6.39196C9.90364 6.37496 9.75787 6.52286 9.75192 6.69881L9.45229 14.9243C9.4507 14.9661 9.45738 15.0078 9.47196 15.047C9.48653 15.0863 9.50871 15.1222 9.53722 15.1529C9.56573 15.1835 9.60001 15.2082 9.63809 15.2256C9.67618 15.243 9.71731 15.2526 9.75914 15.2541L9.77104 15.2545C9.85348 15.2543 9.93265 15.2222 9.99192 15.1649C10.0512 15.1076 10.086 15.0296 10.0889 14.9472L10.3886 6.72176C10.3902 6.67994 10.3835 6.63821 10.3689 6.59898C10.3543 6.55974 10.3321 6.52377 10.3036 6.49313C10.2751 6.46249 10.2408 6.43778 10.2028 6.42042C10.1647 6.40305 10.1235 6.39338 10.0817 6.39196ZM12.0575 6.39238C11.9734 6.38734 11.8907 6.41549 11.8271 6.47081C11.7635 6.52612 11.7242 6.60417 11.7175 6.68818L11.1527 14.9136C11.1469 14.9979 11.1748 15.0811 11.2302 15.1449C11.2857 15.2086 11.3642 15.2478 11.4485 15.2536L11.471 15.2545C11.5517 15.2544 11.6292 15.2237 11.6882 15.1686C11.7471 15.1136 11.7829 15.0383 11.7885 14.9578L12.3533 6.73238C12.3592 6.64808 12.3313 6.5649 12.2758 6.50114C12.2204 6.43739 12.1418 6.39827 12.0575 6.39238Z"
        //                                             fill="#333333" />
        //                                     </svg>
        //                                 </button>
        //                             </td>
        //                             <td class="col py-3 nama-barang" id="nama-barang">
        //                                     ${kode}
        //                             </td>
        //                             <td class="col py-3 harga-satuan" id="harga-satuan">${hargarp}</td>
        //                             <td class="col py-3 jumlah-barang" id="jumlah-barang">${qty}</td>
        //                             <td class="col py-3 harga-barang" id="harga-barang">${totalrp}</td>
        //                         </tr>`;
                // $("#infoOrder").append(isi);
                totalin();
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
        </script>
    @endsection
