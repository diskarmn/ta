<div class="wadah wadah-nav   d-flex justify-content-center flex-column">
    <div class="d-flex justify-content-between atas" style="">
        {{-- <div class="kiri "></div>
        <div class="d-flex flex-row justify-content-around mx-1">

            <form action="{{ route('filterJuraganAdmin') }}" method="GET">
                <select id="filter-select" class="form-select mr-3 mt-3 fzt7 select-tablet" name="juragan"
                    style="width: 200px; border:1px solid black">
                    <option class="fzt8" selected>Pilih Juragan</option>
                    @foreach ($juragan as $item)
                        <option class="fzt8" value="{{ $item->name_juragan }}">{{ $item->name_juragan }}</option>
                    @endforeach
                </select>
            </form>
            <div class="kanan flex-row d-flex justify-content-around align-items-center "
                style="box-sizing: border-box;">
                <a id="cari-orderan"
                    style="border:1px solid black; width:280px; margin-left:30px ; text-decoration:none;"
                    class="form-control rounded-5 fzt8" type="search" aria-label="Search" data-bs-toggle="modal"
                    data-bs-target="#exampleModal4">Cari
                    Orderan</a><i style="margin-left:10px; margin-right:50px;" class="fa-solid fa-magnifying-glass"></i>
            </div>
        </div> --}}
    </div>
    <div id="button-orderan" class=" d-flex row justify-content-center bawah  w-100">
        <a id="btn-semua-orderan" href="{{ route('semua-orderancs') }}"
            class="btn  fzt8 rounded-4 me-3 text-center  py-2 col-lg-2 {{ $title == 'Semua Orderan' ? 'aktif' : 'btn-orderan' }}"
            style="width: 220px; margin-left:50px; height:45px; font-size:18px;">Semua Orderan<span
                class="badge text-bg-danger ms-3 rounded-circle px-2 py-1 badge-qty">
                {{ $status['jumlah_id'] }}</span></a>
        <a id="btn-belum-proses" href="{{ route('belum-proses-orderana') }}"
            class="btn   fzt8 rounded-4 ms-3 me-4 text-center  py-2 col-lg-2 {{ $title == 'Belum Proses Orderan' ? 'aktif' : 'btn-orderan' }} "
            style="width: 195px; height:45px; font-size:18px">Belum proses<span
                class="badge text-bg-danger ms-3 rounded-circle px-2 py-1 badge-qty">{{ $status['belumProses'] }}</span></a>
        <a id="btn-cek-pembayaran" href="{{ route('menunggu-dicek-orderana') }}"
            class="btn   fzt8 rounded-3 ms-4 me-3 text-center  py-2 col-lg-2 {{ $title == 'Menunggu Dicek Orderan' ? 'aktif' : 'btn-orderan' }} "
            style="width: 230px; height:45px; font-size:18px">Cek Pembayaran<span
                class="badge text-bg-danger ms-3 rounded-circle px-2 py-1 badge-qty">{{ $status['menungguDicek'] }}</span></a>
        <a id="btn-dalam-proses" href="{{ route('dalam-proses-orderana') }}"
            class="btn   fzt8  rounded-3 ms-4 me-3 text-center  py-2 col-lg-2 {{ $title == 'Dalam Proses Orderan' ? 'aktif' : 'btn-orderan' }}"
            style="width: 200px; height:45px; font-size:18px">Dalam Proses<span
                class="badge text-bg-danger ms-3 rounded-circle px-2 py-1 badge-qty">{{ $status['dalamProses'] }}</span></a>
        <a id="btn-orderan-selesai" href="{{ route('orderan-selesaia') }}"
            class="btn   fzt8 rounded-3 ms-4 text-center  py-2 col-lg-2  {{ $title == 'Orderan Selesai' ? 'aktif' : 'btn-orderan' }}"
            style="width: 220px; height:45px; font-size:18px">Orderan Selesai<span
                class="badge text-bg-danger ms-3 rounded-circle px-2 py-1 badge-qty">{{ $status['orderanSelesai'] }}</span></a>
    </div>
</div>


{{-- popup cari orderan --}}
@php
    $uniquePaymentMethods = $orderan->pluck('payment_method')->unique();
    $uniqueCustomerName = $orderan->pluck('customer_name')->unique();
@endphp
<div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Menambahkan class modal-lg -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="searchForm" method="GET" action="{{ route('searchinA') }}">
                    <div class="d-flex">
                        <div class="mb-3 me-3">
                            <label for="opsi-pembayaran" class="col-form-label">Opsi Pembayaran 1</label>
                            <select class="form-select custom-input" name="payment_method"
                                aria-label="Default select example" id="opsi-pembayaran" style="width: 200px">
                                <option selected>Pilih Pembayaran</option>
                                <option value="BRI">BRI</option>
                                <option value="BCA">BCA</option>
                                <option value="BNI">BNI</option>
                                <option value="Mandiri">Mandiri</option>
                                <option value="BSI">BSI</option>
                                <option value="COD">COD</option>
                            </select>
                        </div>

                        <div class="mb-3 me-3 ms-3">
                            <label for="opsi-orderan" class="col-form-label">Opsi Orderan</label>
                            <select class="form-select custom-input" name="status" aria-label="Default select example"
                                id="opsi-orderan" style="width: 200px">
                                <option selected>Pilih opsi order</option>
                                <option value="dalam_proses">Sedang Diproses</option>
                                <option value="belum_proses">Belum Diproses</option>
                                <option value="cek_pembayaran">Cek Pembayaran</option>
                                <option value="orderan_selesai">Orderan Selesai</option>
                            </select>
                        </div>

                        <div class="mb-3 me-3 ms-3">
                            <label for="opsi-pengiriman" class="col-form-label">Opsi Pengiriman</label>
                            <select class="form-select custom-input" name="opsi_pengiriman"
                                aria-label="Default select example" id="opsi-pengiriman" style="width: 25  0px">
                                <option selected>Pilih opsi pengiriman</option>
                                <option value="dalam_proses">Belum Dikirim</option>
                                <option value="orderan_selesai">Sudah Dikirim</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="mb-3 me-3">
                            <label for="opsi-pencarian" class="col-form-label">Opsi Pencarian</label>
                            <select class="form-select custom-input" name="customer_name"
                                aria-label="Default select example" id="opsi-pencarian" style="width: 200px">
                                <option selected>Nama Pelanggan</option>
                                @foreach ($pelanggan as $value)
                                    <option value="{{ $value->name }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 me-3 mt-4 ms-3">
                            <label for="tanggal-pencarian" class="col-form-label"></label>
                            <input type="date" class="form-control custom-input" name="order_date"
                                id="tanggal-pencarian">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-start">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#filter-select').change(function() {
            $(this).closest('form').submit();
        });
    });
</script>
