@section('css')
    <style>
        body {
            background-color: #EDEDED;
        }

        .running-text {
            white-space: nowrap;
            overflow: hidden;
            animation: marquee 10s linear infinite;
            background-color: #EDEDED;
            position: absolute;
            left: 0;
            top: 56px;
            /* Sesuaikan dengan tinggi navbar */
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border-bottom: 1px solid #EDEDED;
            /* Garis bawah navbar */
            text-align: center;
            border-radius: 5px;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        @keyframes marquee {
            from {
                transform: translateX(100%);
            }

            to {
                transform: translateX(-100%);
            }
        }

        /* #btn-cek-pembayaran {
                background-color: #202B46;
                color: white;
            } */

        #navbar-dashboard {
            color: white !important;
            font-weight: 600 !important;
        }
    </style>
    <link rel="stylesheet" href="/assets/css/dashboard-cs.css">
@endsection

<body>
    @extends('layouts.mainCS')
    @section('konten')
        <div class="container-fluid justify-content-center p-0 overflow-hidden">


            {{-- running text bagi yang sudah closing  --}}
            {{-- <div class="wadah-jalan w-100 ">
                <div class="jalan">
                    <i class="fab fa-google-wallet me-2"></i> Selamat kepada Emery Donin dari Korean Hunter sudah
                    melakukan
                    closing<i class="fa-solid fa-bullhorn ms-2 me-2"></i><i class="fa-solid fa-bullhorn"></i>
                </div>
            </div> --}}
            <div class="w-100 justify-content-center">
                <div class="top-content mt-5 col-12 ">

                    @include('customer-service.dashboard-invoice.layouts.button')
                </div>
            </div>


            <div class="d-flex justify-content-center ">
                <div class="main-content col-lg-11 p-0 col-md-10 justify-content-center">
                    <!-- Konten utama Anda di sini -->
                    @if ($orderan->count())
                        @foreach ($orderan as $data)
                            <div class="card mt-5 rounded-3  " style="box-shadow: 3px 3px 4px 2px rgb(187, 185, 185); ">
                                <!--atas-->
                                <div class="card-header col-12 d-flex dashed-line justify-content-between d-flex flex-row ">
                                    <!--kiri-->
                                    <div class="card-atas-kiri d-flex flex-row " style="box-sizing: border-box;">
                                        <input style="width: 180px; height:50px; font-weight:bold; font-size:20px"
                                            class="rounded ms-3 text-center mt-3 fzt5 card-atas-satu" type="text"
                                            value="{{ $data->order_number }}" readonly>
                                        <div style="margin-left: 100px; font-size:16px" class="mt-1 card-atas-dua">
                                            <input style="width: 180px" type="text"
                                                class="form-control-plaintext input-atas-kiri fzt6" readonly
                                                value="{{ $data->order_date }}">
                                            <input style="width: 180px" type="text"
                                                class="form-control-plaintext input-atas-kiri fzt6" readonly
                                                value="{{ $data->juraganname }}">
                                        </div>
                                    </div>
                                    <!--kanan-->


                                    @include('super-admin.dashboard-invoice.icon.proses-icon')



                                </div>
                                <!--BAWAHh-->
                                <div class="card-body d-flex   row gap-0 justify-content-evenly">
                                    <!--satu-->
                                    <div class="col-3 p-0 ">
                                        <div class="card-body">
                                            <div class="mb-2">

                                                <label for="pemesan" class="form-label fzt7">Pemesan / Dikirim
                                                    kepada</label>
                                                <input class="fzt7"
                                                    style="border: none;background-color:white;font-weight:bold; font-size:20px"
                                                    type="text" class="form-control mb-0 ms-0" id="pemesan" readonly
                                                    value="{{ $data->customer_name }}">
                                                <label for="nohp" class="form-label"></label>
                                                <input class="fzt7"
                                                    style="border: none; background-color:white; font-weight:bold; font-size:20px"
                                                    type="number" class="form-control mb-0 ms-0" id="nohp" readonly
                                                    value="{{ $data->customer_phone }}">
                                                <label for="metode" class="form-label"></label>

                                                <input class="fzt7"
                                                    style="border: none; background-color:white; font-weight:bold; font-size:20px"
                                                    type="text" class="form-control" id="metode" readonly
                                                    value="{{ $data->payment_method }}">
                                            </div>
                                            <div class="mb-2">
                                                <label for="asalorderan" class="fzt7">Asal Orderan</label>
                                                <input
                                                    style="border: none; background-color:white; font-weight:bold; font-size:20px"
                                                    class="fzt7" type="text" id="asalorderan" readonly
                                                    value="{{ $data->source }}">
                                            </div>
                                            <div class="mb-4">
                                                <label for="cs" class="fzt7">Dilayani</label>
                                                <div class="p-scroll">
                                                    <p class="fzt7"><b>{{ $data->served_byname }}</b></p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!--dua-->
                                    <div class=" col-2 p-0 ">
                                        <div class="card-body " style="font-size: 15px; position: relative;">
                                            <p class=" fzt7">Produk <i class="fa-solid fa-circle-info hoverjs"></i></p>
                                            <div>

                                                @php
                                                    $barangOrders = DB::table('barang_order')
                                                        ->join('barangs', 'barang_order.id_produk', '=', 'barangs.id')
                                                        ->where('barang_order.order_number', $data->order_number)
                                                        ->select('barang_order.*', 'barangs.nama as produk_nama')
                                                        ->get();
                                                @endphp

                                                @if ($barangOrders->count())
                                                    @foreach ($barangOrders as $item)
                                                        <div class="d-flex flex-row">
                                                            <div class="col-6">
                                                                <p><b>{{ $item->produk_nama }}</b></p>
                                                                <p>{{ $item->size }}</p>
                                                            </div>
                                                            <div class="col-6">
                                                                <p>X <b>{{ $item->quantity }}</b></p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <p>No items found for this order.</p>
                                                @endif
                                            </div>
                                            <hr style="height: 2px; border:none; color:black; background-color:black">
                                            <div class="d-flex flex-row">
                                                <div class="col-6">
                                                    <p class=""><b>total</b></p>
                                                </div>
                                                <div class="col-6">
                                                    <p class=""><b>= {{ $data->total_quantity }} pcs</b></p>
                                                </div>
                                            </div>

                                            <div class="hasilhover p-2 rounded">
                                                <div class="d-flex">
                                                    <table>
                                                        @foreach ($barangOrders as $hvr)
                                                            <tr>
                                                                <td>
                                                                    <p style="font-size: 70%">
                                                                        <b>{{ $hvr->produk_nama }}</b></p>
                                                                </td>
                                                                <td>
                                                                    <p style="font-size: 70%">{{ $hvr->size }}</p>
                                                                </td>
                                                                <td>
                                                                    <p style="font-size: 70%">X</p>
                                                                </td>
                                                                <td>
                                                                    <p style="font-size: 70%">{{ $hvr->quantity }}</p>
                                                                </td>
                                                                <td>
                                                                    <p style="font-size: 70%">=</p>
                                                                </td>
                                                                <td>
                                                                    <p style="font-size: 70%">Rp.
                                                                        {{ number_format($hvr->subtotal, 2) }}</p>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </div>

                                                <hr style="height: 2px; border:none; color:black; background-color:black">
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <p style="font-size: 80%"><b>total</b></p>
                                                        </td>
                                                        <td>
                                                            <p style="font-size: 80%"><b>=</b></p>
                                                        </td>
                                                        <td>
                                                            <p style="font-size: 80%"><b>Rp.
                                                                    {{ number_format($data->total_amount, 2) }}</b></p>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                    <!--tiga-->
                                    {{-- card info pembayaran dan terbayar --}}
                                    <div class=" col-4 p-0">
                                        <div class="card rounded-3">

                                            {{-- header berwarna merah apabila belum terbayar atau terbayar 0 --}}
                                            @if ($data->first()->paid_amount == 0)
                                                <div class="card-header P-4 wajib-bayar custom-input"
                                                    style="display: absolute; z-index:1; background : linear-gradient(to bottom, #FF8E8E, #FFFFFF)">
                                                    <h5 class="text-center fs-4 fzt7" style="font-weight: bold">
                                                        Wajib
                                                        Bayar RP
                                                        {{ number_format($data->first()->total_amount, 0, ',', '.') }}
                                                    </h5>
                                                </div>
                                            @endif

                                            {{-- header berwarna kuning apabila sudah melakukan pembayaran namun  masih kurang --}}
                                            @if ($data->first()->paid_amount < $data->total_amount && $data->paid_amount > 0)
                                                <div class="card-header P-4 wajib-bayar custom-input"
                                                    style="display: absolute; z-index:1; background : linear-gradient(to bottom, #FDF771, #FFFFFF)">
                                                    <h5 class="text-center fs-4 fzt7" style="font-weight: bold">
                                                        Wajib
                                                        Bayar RP
                                                        {{ number_format($data->first()->total_amount, 0, ',', '.') }}
                                                    </h5>
                                                </div>
                                            @endif

                                            {{-- header berwarna hijau apabila sudah terbayar lunas --}}
                                            @if ($data->first()->paid_amount == $data->total_amount)
                                                <div class="card-header P-4 wajib-bayar custom-input"
                                                    style="display: absolute; z-index: 1; background: linear-gradient(to bottom, #4FDF6F, #FFFFFF);">
                                                    <h5 class="text-center fs-4 fzt7" style="font-weight: bold">
                                                        Lunas
                                                        {{ number_format($data->first()->total_amount, 0, ',', '.') }}
                                                    </h5>
                                                </div>
                                            @endif

                                            {{-- isi card body --}}
                                            <div class="card-body fs-5 " style="background-color: #EDEDED">
                                                <table class="table table-borderless fw-bold fs-5 ">
                                                    <tr>
                                                        <td style="background-color: #EDEDED" class="fzt7">Harga
                                                            Produk
                                                        </td>
                                                        <td id="total" class="fzt7"
                                                            style="background-color: #EDEDED">RP
                                                            {{ number_format($data->first()->total_amount, 0, ',', '.') }}
                                                        </td>
                                                    </tr>
                                                </table>
                                                <hr style="border-bottom: 3px solid black">
                                                <table class="table table-borderless fw-bold">
                                                    <tr>
                                                        <td class="fzt7" style="background-color: #EDEDED">
                                                            Terbayar</td>
                                                        <td class="fzt7" id="terbayar"
                                                            style="background-color: #EDEDED">RP
                                                            {{ number_format($data->first()->paid_amount, 0, ',', '.') }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fzt7" style="background-color: #EDEDED">
                                                            Kekurangan
                                                        </td>
                                                        @if ($data->first()->total_amount == $data->paid_amount)
                                                            <td class="fzt7 col-6 " style="background-color: #EDEDED">RP
                                                                {{ number_format(max(0, $data->total_amount - $data->paid_amount), 0, ',', '.') }}
                                                            </td>
                                                        @else
                                                            <td class="fzt7 col-6 " style="background-color: #EDEDED">-RP
                                                                {{ number_format(max(0, $data->total_amount - $data->paid_amount), 0, ',', '.') }}
                                                            </td>
                                                        @endif
                                                    </tr>
                                                </table>

                                                {{-- keterangan lunas akan muncul apabila sudah terbayar lunas --}}
                                                @if ($data->first()->total_amount == $data->paid_amount)
                                                    <div id="status-lunas"
                                                        class="border fzt7 border-secondary p-2 mb-2 text-center rounded-3 custom-input"
                                                        style="font-weight: bold; color:#ccc;">LUNAS</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <!--empat-->
                                    {{-- note keterangan --}}
                                    <div class=" col-3 p-0 ">
                                        <div class="card-body" style="font-size: 18px">
                                            <p class="fzt7" style="font-weight: 900; color:#ccc">Keterangan</p>
                                            @php
                                                // Ubah jumlah kata yang diinginkan sesuai kebutuhan
                                                $limitedNote = Str::limit($data->notes, $limit = 50, $end = '...');
                                            @endphp
                                            <div class="note-section">
                                                <div class="limited-note">
                                                    <p class="fzt6 my-0">{{ $limitedNote }}</p>
                                                    @if ($data->first()->dana_ongkir)
                                                        <p class="fzt6 my-0">{{ $data->dana_ongkir }}:
                                                            {{ $data->dana_ongkir }}</p>
                                                    @else
                                                        <p class="fzt6 my-0">dana ongkir tidak ada</p>
                                                    @endif
                                                    @if ($data->first()->dana_biaya_lain)
                                                        <p class="fzt6 my-0">{{ $data->biaya_lain }}:
                                                            {{ $data->dana_biaya_lain }}</p>
                                                    @else
                                                        <p class="fzt6 my-0">biaya lain tidak ada</p>
                                                    @endif
                                                </div>
                                                <div class="full-note fzt7"
                                                    style="display: none; margin-top: 0; padding-top: 0;">
                                                    @foreach (explode("\n", $data->notes) as $noteLine)
                                                        <p style="margin: 0; padding: 0;">{{ $noteLine }}</p>
                                                    @endforeach
                                                </div>
                                                <a href="#" class="show-more fzt7"
                                                    onclick="toggleNoteVisibility(this); return false;">Selengkapnya
                                                </a>
                                                @php
                                                    $status = DB::table('update_status_proses')
                                                        ->where('order_number', $data->order_number)
                                                        ->get();
                                                    $status9Selesai = DB::table('update_status_proses')
                                                        ->where('order_number', $data->order_number)
                                                        ->where('id_status', 9)
                                                        ->where('kelengkapan', 'selesai')
                                                        ->first();
                                                    $status8Selesai = DB::table('update_status_proses')
                                                        ->where('order_number', $data->order_number)
                                                        ->where('id_status', 8)
                                                        ->where('kelengkapan', 'selesai')
                                                        ->first();

                                                @endphp
                                                @if (
                                                    $data->first()->status == 'dalam_proses' &&
                                                        $data->total_amount == $data->paid_amount &&
                                                        $status8Selesai &&
                                                        $status9Selesai)
                                                    <button type="button"
                                                        class="btn btn-primary border border-dark w-100"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#resi{{ $data->order_number }}">Resi
                                                    </button>
                                                @else
                                                @endif

                                            </div>
                                        </div>
                                    </div>



                                </div>
                                {{-- card bawah endiri untuk tampilan superadmin --}}
                                <div class="card-bawah-sendiri-superadmin  px-4 py-3 gap-2 row">
                                    {{-- tombol pembayaran muncul apabila status masih dalam proses dan jumalh yang terbayar masih kurang --}}


                                    @if ($data->first()->total_amount >= 0 && $data->status == 'cek_pembayaran')
                                        <div style="color:#ccc"
                                            class="border w-auto fzt4 border-secondary fw-bold rounded-3 text-center p-2 mb-2 custom-input">
                                            MENUNGGU DI CEK ADMIN</div>
                                    @endif
                                    {{-- cetak invoice muncul apabila orderan sudah selesai dan terbayar lunas --}}
                                    @if ($data->first()->total_amount == $data->paid_amount && $data->status == 'orderan_selesai')
                                        <div class="d-flex justify-content-between align-items-center  col-lg-2  col-3 p-0"
                                            onclick="goToInvoice()"
                                            style="background-color: white;   font-weight:bold; border:2px solid #202B46; border-radius:10px;">
                                            <a href="{{ route('super-admin.dashboard-invoice.invoice', ['orderNumber' => $orderNumber]) }}"
                                                class="btn rounded p-1 text-start fzt7" style="color: #202B46;">Cetak
                                                Invoice </a>
                                            <div class=" fzt6 "
                                                style="background-color: #202B46; border-radius: 0 5px 5px 0; padding:9px">
                                                <a
                                                    href="{{ route('super-admin.dashboard-invoice.invoice', ['orderNumber' => $orderNumber]) }}">
                                                    <i class="fa-solid fa-download  " style="color: white"></i></a>
                                            </div>
                                        </div>
                                    @else
                                    @endif

                                </div>
                            </div>
                        @endforeach
                    @else
                        <h3 class="text-center p-5">orderan belum ada</h3>
                    @endif
                </div>
            </div>



            {{-- popup tambah pembayaran --}}

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel" style="margin-left: 120px">
                                Tambah
                                Pembayaran</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h6 class="text-center bg-warning mb-4 p-2 rounded">Detail Pembayaran tidak
                                bisa diganti
                                atau diubah</h6>
                            <form method="POST" id="formongkir" enctype="multipart/form-data"
                                action="{{ route('tambah-pembayaran', ['orderNumber' => $orderNumber->order_number]) }}">

                                @csrf
                                <div class="modal-body">

                                    <h6 class="text-center bg-warning mb-4 p-2 rounded">Detail Pembayaran tidak
                                        bisa
                                        diganti
                                        atau diubah</h6>
                                    <div class="d-flex">

                                        <div class="mb-3 me-3">
                                            <label for="tujuan-pembayaran" class="col-form-label">Tujuan
                                                Pembayaran</label>
                                            <select class="form-select custom-input" aria-label="Default select example"
                                                id="tujuan-pembayaran" style="width: 200px" name="tujuan_bayar">
                                                @if (!$orderNumber->tujuan_bayar)
                                                    <option value="" selected>Pilih Tujuan</option>
                                                @else
                                                    <option value="{{ $orderNumber->tujuan_bayar }}" selected>
                                                        {{ $orderNumber->tujuan_bayar }}</option>
                                                @endif

                                                <option value="BRI">BRI</option>
                                                <option value="BCA">BCA</option>
                                                <option value="BNI">BNI</option>
                                                <option value="Mandiri">Mandiri</option>


                                            </select>
                                        </div>
                                        <div class="mb-3 ms-5">
                                            <label for="tanggal-bayar" class="col-form-label">Tanggal
                                                Bayar</label>
                                            <input type="date" class="form-control custom-input" id="tanggal-bayar"
                                                name="tanggal_bayar" style="width: 200px"
                                                value="{{ $orderNumber->updated_at }}">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="jumlah-dana" class="col-form-label">Jumlah Dana</label>
                                        <input type="text" class="form-control custom-input" id="jumlah-dana"
                                            name="jumlah_dana" style="width: 200px" value="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="gambar" class="col-form-label">Unggah Bukti Pembayaran</label>
                                        <input type="file" class="form-control custom-input" id="gambar"
                                            name="gambar" style="width: 200px">
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-start">

                                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Tambah
                                        Pembayaran</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                        onclick="hideDropdownMenu()">Batal</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                {{-- popup request edit orderan --}}
                <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel" style="margin-left: 120px">Request
                                    Edit
                                    Orderan</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('cs.editrequest') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="order_number" class="col-form-label">ID Pemesanan</label>
                                        <input type="text" name="order_number" class="form-control custom-input"
                                            id="order_number" style="width: 200px" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="detail" class="col-form-label">Keterangan</label>
                                        <textarea required name="detail" class="form-control custom-input" id="detail" style="height: 300px"
                                            placeholder="Nama masukan = keterangan Cth 1. Asal Orderan = Facebook 2. Nama Pelanggan = Stephany"></textarea>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <!-- Pastikan tombol submit berada di dalam tag form -->
                                <button type="submit" class="btn btn-primary" id="submitForm">Kirim</button>
                            </div>

                        </div>
                    </div>
                </div>


                {{-- popup cari orderan --}}
                @php
                    $uniquePaymentMethods = $orderan->pluck('payment_method')->unique();
                    $uniqueCustomerName = $orderan->pluck('customer_name')->unique();
                @endphp
                <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg"> <!-- Menambahkan class modal-lg -->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="GET" id="searchForm">
                                    <div class="d-flex">
                                        <div class="mb-3 me-3">
                                            <label for="opsi-pembayaran" class="col-form-label">Opsi Pembayaran 1</label>
                                            <select class="form-select custom-input" name="payment_method"
                                                aria-label="Default select example" id="opsi-pembayaran"
                                                style="width: 200px">
                                                <option selected>Pilih Pembayaran</option>
                                                <option value="BRI">BRI</option>
                                                <option value="BCA">BCA</option>
                                                <option value="BNI">BNI</option>
                                                <option value="Mandiri">Mandiri</option>
                                                <option value="BSI">BSI</option>
                                                <option value="COD">COD</option>
                                                <option value="QRIS">QRIS</option>
                                            </select>
                                        </div>

                                        <div class="mb-3 me-3 ms-3">
                                            <label for="opsi-orderan" class="col-form-label">Opsi Orderan</label>
                                            <select class="form-select custom-input" name="status"
                                                aria-label="Default select example" id="opsi-orderan"
                                                style="width: 200px">
                                                <option selected>Pilih opsi order</option>
                                                <option value="dalam_proses">Sedang Diproses</option>
                                                <option value="belum_proses">Belum Diproses</option>
                                                <option value="orderan_selesai">Orderan Selesai</option>
                                            </select>
                                        </div>

                                        <div class="mb-3 me-3 ms-3">
                                            <label for="opsi-pengiriman" class="col-form-label">Opsi Pengiriman</label>
                                            <select class="form-select custom-input" name="opsi_pengiriman"
                                                aria-label="Default select example" id="opsi-pengiriman"
                                                style="width: 25  0px">
                                                <option selected>Pilih opsi pengiriman</option>
                                                <option value="dalam_proses || belum_proses">Belum Dikirim</option>
                                                <option value="orderan_selesai">Sudah Dikirim</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="mb-3 me-3">
                                            <label for="opsi-pencarian" class="col-form-label">Opsi Pencarian</label>
                                            <select class="form-select custom-input" name="customer_name"
                                                aria-label="Default select example" id="opsi-pencarian"
                                                style="width: 200px">
                                                <option selected>Nama Pelanggan</option>
                                                @foreach ($uniqueCustomerName as $value)
                                                    <option value="{{ $value }}">{{ $value }}</option>
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


                {{-- toast pembayaran berhasil --}}
                <div class="toast-container position-absolute bottom-0 start-50 translate-middle-x">
                    <div id="pembayaranberhasil" class="toast rounded-4" role="alert" aria-live="assertive"
                        aria-atomic="true">
                        <div class="toast-body bg-white text-center p-3">
                            <img src="/assets/img/checklist.png" alt="" style="width: 80px; height:80px">
                            <h6 class="mt-3 mb-3">Pembayaran <span style="color: #58D91B">Berhasil</span> Ditambahkan</h6>
                        </div>
                    </div>
                </div>

                {{-- toast pembayaran gagal --}}
                <div class="toast-container position-absolute bottom-0 start-50 translate-middle-x">
                    <div id="pembayarangagal" class="toast rounded-4" role="alert" aria-live="assertive"
                        aria-atomic="true">
                        <div class="toast-body bg-white text-center p-3">
                            <img src="/assets/img/gagal.png" alt="" style="width: 180px; height:80px">
                            <h6 class="mt-3 mb-3">Pembayaran <span style="color: #F44336">GAGAL</span> Ditambahkan</h6>
                            <h6 class="text-center text-danger">ERROR: Message</h6>
                        </div>
                    </div>
                </div>

                {{-- toast ketika request berhasil dikirim --}}
                <div class="toast-container position-absolute bottom-0 start-50 translate-middle-x">
                    <div id="requestberhasil" class="toast rounded-4" role="alert" aria-live="assertive"
                        aria-atomic="true">
                        <div class="toast-body bg-white text-center p-3">
                            <img src="/assets/img/checklist.png" alt="" style="width: 80px; height:80px">
                            <h6 class="mt-3 mb-3">Request <span style="color: #58D91B">Berhasil</span> Dikirim</h6>
                        </div>
                    </div>
                </div>




            @section('js')
                <!-- Skrip JavaScript untuk menangani perhitungan kekurangan -->
                <script>
                    // Url modification
                    document.getElementById('searchForm').onsubmit = function(e) {
                        e.preventDefault();

                        var form = this;
                        var url = form.getAttribute('action') || window.location.href;
                        var queryParams = [];

                        // Loop melalui setiap elemen input dalam form
                        Array.from(form.elements).forEach(function(element) {
                            var name = element.name;
                            var value = element.value;

                            // Tambahkan hanya jika name ada dan value tidak kosong
                            if (name && value && value !== "Pilih Pembayaran" && value !== "Pilih opsi order" && value !==
                                "Pilih opsi pengiriman" && value !== "Nama Pelanggan") {
                                queryParams.push(encodeURIComponent(name) + "=" + encodeURIComponent(value));
                            }
                        });

                        // Bangun query string dan redirect
                        var queryString = queryParams.join('&');
                        if (queryString.length > 0) {
                            window.location.href = url + '?' + queryString;
                        } else {
                            window.location.href = url;
                        }
                    };

                    //menampilkan alert pembayaran dan request berhasil
                    const toastTrigger = document.getElementById('liveToastBtn');
                    const toastLiveExample = document.getElementById('pembayaranberhasil');
                    const toastLiveExample2 = document.getElementById('pembayarangagal');

                    if (toastTrigger) {

                        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample2);

                        toastTrigger.addEventListener('click', () => {
                            toastBootstrap.show();
                            setTimeout(() => {
                                toastBootstrap.hide();
                            }, 1000);
                        });
                    }

                    document.addEventListener('DOMContentLoaded', (event) => {
                        const hoverElements = document.querySelectorAll('.hoverjs');
                        const hasilHover = document.querySelector('.hasilhover');

                        hoverElements.forEach(element => {
                            element.addEventListener('mouseover', () => {
                                hasilHover.style.display = 'block';
                            });

                            element.addEventListener('mouseleave', () => {
                                hasilHover.style.display = 'none';
                            });
                        });
                    });
                    //melihat selengkapnya
                    function toggleNoteVisibility(link) {
                        var noteSection = link.closest('.note-section');
                        var limitedNote = noteSection.querySelector('.limited-note');
                        var fullNote = noteSection.querySelector('.full-note');
                        var showMoreLink = noteSection.querySelector('.show-more');

                        if (limitedNote.style.display === 'none') {
                            limitedNote.style.display = 'block';
                            fullNote.style.display = 'none';
                            showMoreLink.innerHTML = 'Selengkapnya';
                        } else {
                            limitedNote.style.display = 'none';
                            fullNote.style.display = 'block';
                            showMoreLink.innerHTML = 'Tutup';
                        }
                    }
                </script>

                {{-- Script untuk fungsi Request orderan agar masuk kedalam database --}}
                <!-- Tambahkan kode JavaScript untuk menampilkan popup -->
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    document.getElementById('searchForm').onsubmit = function(e) {
                        e.preventDefault();

                        var form = this;
                        var url = form.getAttribute('action') || window.location.href;
                        var queryParams = [];

                        // Loop melalui setiap elemen input dalam form
                        Array.from(form.elements).forEach(function(element) {
                            var name = element.name;
                            var value = element.value;

                            // Tambahkan hanya jika name ada dan value tidak kosong
                            if (name && value && value !== "Pilih Pembayaran" && value !== "Pilih opsi order" && value !==
                                "Pilih opsi pengiriman" && value !== "Nama Pelanggan") {
                                queryParams.push(encodeURIComponent(name) + "=" + encodeURIComponent(value));
                            }
                        });

                        // Bangun query string dan redirect
                        var queryString = queryParams.join('&');
                        if (queryString.length > 0) {
                            window.location.href = url + '?' + queryString;
                        } else {
                            window.location.href = url;
                        }
                    };


                    // Tampilkan popup saat halaman dimuat
                    $(document).ready(function() {
                        // $('#requestberhasil').toast('show');
                    });

                    // Kirim permintaan menggunakan AJAX
                    $('#editOrderForm').submit(function(e) {
                        e.preventDefault(); // Menghentikan pengiriman form

                        // Lakukan pengiriman form menggunakan AJAX
                        $.ajax({
                            type: 'POST',
                            url: $(this).attr('action'),
                            data: $(this).serialize(),
                            success: function(response) {
                                // Tampilkan popup saat permintaan berhasil dikirim
                                $('#requestberhasil').toast('show');

                                // Alihkan pengguna ke halaman admin
                                window.location.href = "{{ route('admin.request.main') }}";
                            },
                            error: function(xhr, status, error) {
                                // Tambahkan logika untuk menangani kesalahan
                                console.error(xhr.responseText);
                            }
                        });
                    });
                </script>
                </script>
            @endsection


            <div class="mt-3 button-request">
                <button type="button" class="btn btn-primary me-2" id="request" data-bs-toggle="modal"
                    data-bs-target="#exampleModal2">Request Edit Orderan</button>
            </div>
        @endsection
</body>

</html>
