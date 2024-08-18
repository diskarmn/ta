@section('css')
    <style>
        .wadah-jalan {
            overflow: hidden;
        }

        .jalan {
            width: 150%;
            white-space: nowrap;
            overflow: hidden;
            animation: moveLeft 10s linear infinite;
        }

        @keyframes moveLeft {
            0% {
                transform: translateX(100%);
            }

            100% {
                transform: translateX(-35%);
            }
        }
    </style>
    <link rel="stylesheet" href="/assets/css/dashboard-cs.css">
@endsection

<body>
    @extends('layouts.mainSA')
    @section('konten')
        <div class="container-fluid justify-content-center">
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

                    @include('super-admin.dashboard-invoice.layouts.button')
                </div>
            </div>
            <!--card-->
            <div class="d-flex justify-content-center">
                <div class="main-content col-lg-11 col-md-10 justify-content-center ">
                    <!-- Konten utama Anda di sini -->
                    <div>
                        @if ($orderan->count())
                            @foreach ($orderan as $data)
                                <div class="card mt-5 rounded-3  " style="box-shadow: 3px 3px 4px 2px rgb(187, 185, 185); ">
                                    <!--atas-->
                                    <div
                                        class="card-header col-12 d-flex dashed-line justify-content-between d-flex flex-row ">
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
                                                        type="text" class="form-control mb-0 ms-0" id="pemesan"
                                                        readonly value="{{ $data->customer_name }}">
                                                    <label for="nohp" class="form-label"></label>
                                                    <input class="fzt7"
                                                        style="border: none; background-color:white; font-weight:bold; font-size:20px"
                                                        type="number" class="form-control mb-0 ms-0" id="nohp"
                                                        readonly value="{{ $data->customer_phone }}">
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
                                                        class="form-control fzt7" type="text" id="asalorderan" readonly
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
                                                            ->join(
                                                                'barangs',
                                                                'barang_order.id_produk',
                                                                '=',
                                                                'barangs.id',
                                                            )
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

                                                    <hr
                                                        style="height: 2px; border:none; color:black; background-color:black">
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
                                                @if ($data->paid_amount == 0)
                                                    <div class="card-header P-4 wajib-bayar custom-input"
                                                        style="display: absolute; z-index:1; background : linear-gradient(to bottom, #FF8E8E, #FFFFFF)">
                                                        <h5 class="text-center fs-4 fzt7" style="font-weight: bold">
                                                            Wajib
                                                            Bayar RP
                                                            {{ number_format($data->total_amount, 0, ',', '.') }}
                                                        </h5>
                                                    </div>
                                                @endif

                                                {{-- header berwarna kuning apabila sudah melakukan pembayaran namun  masih kurang --}}
                                                @if ($data->paid_amount < $data->total_amount && $data->paid_amount > 0)
                                                    <div class="card-header P-4 wajib-bayar custom-input"
                                                        style="display: absolute; z-index:1; background : linear-gradient(to bottom, #FDF771, #FFFFFF)">
                                                        <h5 class="text-center fs-4 fzt7" style="font-weight: bold">
                                                            Wajib
                                                            Bayar RP
                                                            {{ number_format($data->total_amount, 0, ',', '.') }}
                                                        </h5>
                                                    </div>
                                                @endif

                                                {{-- header berwarna hijau apabila sudah terbayar lunas --}}
                                                @if ($data->paid_amount == $data->total_amount)
                                                    <div class="card-header P-4 wajib-bayar custom-input"
                                                        style="display: absolute; z-index: 1; background: linear-gradient(to bottom, #4FDF6F, #FFFFFF);">
                                                        <h5 class="text-center fs-4 fzt7" style="font-weight: bold">
                                                            Lunas
                                                            {{ number_format($data->total_amount, 0, ',', '.') }}
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
                                                                {{ number_format($data->total_amount, 0, ',', '.') }}
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
                                                                {{ number_format($data->paid_amount, 0, ',', '.') }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fzt7" style="background-color: #EDEDED">
                                                                Kekurangan
                                                            </td>
                                                            @if ($data->total_amount == $data->paid_amount)
                                                                <td class="fzt7 col-6 " style="background-color: #EDEDED">
                                                                    RP
                                                                    {{ number_format(max(0, $data->total_amount - $data->paid_amount), 0, ',', '.') }}
                                                                </td>
                                                            @else
                                                                <td class="fzt7 col-6 " style="background-color: #EDEDED">
                                                                    -RP
                                                                    {{ number_format(max(0, $data->total_amount - $data->paid_amount), 0, ',', '.') }}
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    </table>

                                                    {{-- keterangan lunas akan muncul apabila sudah terbayar lunas --}}
                                                    @if ($data->total_amount == $data->paid_amount)
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
                                                        @if ($data->dana_ongkir)
                                                            <p class="fzt6 my-0">{{ $data->dana_ongkir }}:
                                                                {{ $data->dana_ongkir }}</p>
                                                        @else
                                                            <p class="fzt6 my-0">dana ongkir tidak ada</p>
                                                        @endif
                                                        @if ($data->dana_biaya_lain)
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
                                                    @if ($data->status == 'dalam_proses' && $data->total_amount == $data->paid_amount && $status8Selesai && $status9Selesai)
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


                                        {{-- blum bayar/ blom lunas --}}
                                        @if ($data->total_amount > $data->paid_amount && $data->status != 'cek_pembayaran')
                                            <button data-bs-toggle="modal"
                                                data-bs-target="#prosesOrderanModal{{ $data->order_number }}"
                                                type="button"
                                                class="rounded p-1 justify-content-center flex-lg-row flex-md-column  col-lg-2  col-3 d-flex align-items-center"
                                                style="background-color: #202B46; color:white"
                                                data-idpelanggan = "{{ $data->id_customer }}"><small
                                                    class="me-2 fzt6 col-12 text-center"><i
                                                        class="fa-regular fa-square-plus m-1"></i>Proses
                                                    Orderan</small>
                                            </button>
                                            <div class=" rounded rounded-3 d-flex   col-2 mx-2 px-0  border border-dark border-2 "
                                                style="height:max-content;align-self:center;">
                                                <form class="w-100 m-auto"
                                                    action="{{ route('kesuntingsa', $data->order_number) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" value="{{ $data->order_number }}"
                                                        id="lorder_number">
                                                    <input type="hidden" value="{{ $data->juragan }}" id="lid_juragan">
                                                    <input type="hidden" value="{{ $data->juraganname }}"
                                                        id="lname_juragan">
                                                    <input type="hidden" value="{{ $data->source }}" id="lsource">
                                                    <input type="hidden" value="{{ $data->served_by }}"
                                                        id="lid_served_by">
                                                    <input type="hidden" value="{{ $data->served_byname }}"
                                                        id="lname_served_by">
                                                    <input type="hidden" value="{{ $data->order_date }}"
                                                        id="lorder_date">
                                                    <input type="hidden" value="{{ $data->customer_name }}"
                                                        id="lname_customer">
                                                    <input type="hidden" value="{{ $data->id_customer }}"
                                                        id="lid_customer">
                                                    <input type="hidden" value="{{ $data->notes }}" id="lnotes">
                                                    <input type="hidden" value="{{ $data->payment_method }}"
                                                        id="lmethod">
                                                    <input type="hidden" value="{{ $data->status }}" id="lstatus">
                                                    <button type="submit"
                                                        class="btn w-100 px-2 btn fzt7 text-start
                                                    border border-none text-dark w-100 d-flex align-items-center"
                                                        onclick="simpanlokal()" style="text-decoration: none;">
                                                        Sunting
                                                    </button>
                                                </form>


                                            </div>
                                            <div class="sunting rounded rounded-3 px-1 d-flex overflow-hidden  col-2 mx-2 px-0 justify-content-between border border-dark border-2 "
                                                style="">
                                                Pembayaran / hapus order

                                                <button class="px-3 bg-none dropdown border-none border  " type="button"
                                                    style="border-left:2px solid black !important;"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa-solid fa-caret-down"></i>
                                                </button>

                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item  fzt7" data-value="tambah"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#tambahPembayaran{{ $data->order_number }}">Tambah
                                                            Pembayaran</a></li>
                                                    <li>
                                                        <form class="dropdown-item my-0 fzt7  parentvalidasihapus"
                                                            method="POST" id=""
                                                            action="{{ route('deleteordersa', $data->order_number) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <p id="validasihapus" class=" text-danger">Hapus</p>
                                                            <div class="validasimunculhapus" style="display: none;">
                                                                <div class="anaknyavalidasihapus">
                                                                    <div
                                                                        class="tengahnya w-50 m-auto p-5  rounded bg-white d-flex flex-column justify-content-center align-items-center">

                                                                        <h1 class="fz9 text-center">Yakin Hapus Orderan?
                                                                        </h1>
                                                                        <div
                                                                            class="kanankirivalidasi d-flex flex-row justify-content-between w-50">
                                                                            <button type="submit"
                                                                                class="btn btn-danger modal_btn_width "
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#confirmPerubahanStatusOrderModal"
                                                                                id="btnSimpanProsesOrderan">Hapus</button>
                                                                            <div onclick="hideDropdownMenu()"
                                                                                class="buttonvalidasihapus px-2 py-1 rounded bg-secondary text-center d-flex align-items-center text-white">
                                                                                batal</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </li>
                                                </ul>
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
            </div>
        </div>
        </div>





        {{-- popup tambah pembayaran --}}
        @foreach ($allorder as $orderNumber)
            <div class="modal fade" id="tambahPembayaran{{ $orderNumber->order_number }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel" style="margin-left: 120px">
                                Tambah
                                Pembayaran {{ $orderNumber->order_number }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form method="POST" id="formongkir" enctype="multipart/form-data"
                        action="{{ route('tambah-pembayaransa', ['orderNumber' => $orderNumber->order_number]) }}">

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
        @endforeach

        {{-- proses status --}}
        @foreach ($allorder as $orderId)
            <div class="modal fade" id="prosesOrderanModal{{ $orderId->order_number }}" data-bs-backdrop="static"
                data-bs-keyboard="false" tabindex="-1" aria-labelledby="prosesOrderanModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">

                        <form action="{{ route('update.on.processsa', ['orderId' => $orderId->order_number]) }}"
                            method="post" id="form_proses">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title w-100 text-center" id="prosesOrderanModalLabel">Proses
                                    Orderan {{ $orderId->order_number }}
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p
                                    class="bg-warning text-secondary rounded-1 text-center fs-6 fw-medium font-family-Montserrat m-0 px-3 py-2">
                                    Perlu diingat, penambahan status orderan ini tidak bisa diubah!</p>

                                @php
                                    $updateStatusProses = DB::table('update_status_proses')
                                        ->where('order_number', $orderId->order_number)
                                        ->get();
                                @endphp

                                <br>

                                @if ($updateStatusProses->where('id_status', 3)->where('kelengkapan', 'Lengkap')->isNotEmpty())
                                    <div class="d-flex gap-1 justify-content-between">
                                        <div class="col-lg-6 my-2">
                                            <div class="dropdown-status">
                                                <button
                                                    class="btn d-flex justify-content-between align-items-center bg-white border w-100 border-black rounded rounded-3 dropdown-toggle @error('pilih_status') is-invalid @enderror"
                                                    type="button" data-bs-toggle="dropdown" aria-expanded="false"
                                                    id="pilih_status" data-name="pilih_status" name="pilih_status">
                                                    Pilih Proses
                                                </button>
                                                <ul class="dropdown-menu pilih-menu">
                                                    <li><a class="dropdown-item status-option disabled"
                                                            data-value="3">Data Pesanan</a></li>
                                                    <li>

                                                        <a class="dropdown-item status-option
                                                            {{ $updateStatusProses->where('id_status', 4)->where('kelengkapan', 'selesai')->isNotEmpty() ? 'disabled' : '' }}"
                                                            data-value="4">Bahan Produk</a>

                                                    </li>
                                                    <li>

                                                        <a class="dropdown-item status-option
                                                        {{ $updateStatusProses->where('id_status', 5)->where('kelengkapan', 'selesai')->isNotEmpty() ? 'disabled' : '' }}"
                                                            data-value="5">Sablon</a>
                                                    </li>
                                                    <li><a class="dropdown-item status-option
                                                        {{ $updateStatusProses->where('id_status', 6)->where('kelengkapan', 'selesai')->isNotEmpty() ? 'disabled' : '' }}"
                                                            data-value="6">Bordir</a></li>
                                                    <li><a class="dropdown-item status-option
                                                        {{ $updateStatusProses->where('id_status', 7)->where('kelengkapan', 'selesai')->isNotEmpty() ? 'disabled' : '' }}"
                                                            data-value="7">Penjahit</a></li>
                                                    <li><a class="dropdown-item status-option
                                                        {{ $updateStatusProses->where('id_status', 8)->where('kelengkapan', 'selesai')->isNotEmpty() ? 'disabled' : '' }}"
                                                            data-value="8">QC</a>
                                                    </li>
                                                    <li> <a class="dropdown-item status-option
                                                        {{ $updateStatusProses->where('id_status', 9)->where('kelengkapan', 'selesai')->isNotEmpty() ? 'disabled' : '' }}"
                                                            data-value="9">Packing</a></li>
                                                </ul>
                                                <input type="hidden" name="status" id="modalStatus" value="">
                                            </div>

                                        </div>
                                        <div class="col-lg-6 my-2 keterangan-parent">
                                            <div class="dropdown">
                                                <button
                                                    class="btn d-flex justify-content-between align-items-center bg-white border w-100 border-black rounded rounded-3 dropdown-toggle @error('kelengkapan') is-invalid @enderror"
                                                    type="button" data-bs-toggle="dropdown" aria-expanded="false"
                                                    id="kelengkapan" data-name="kelengkapan">
                                                    Masuk/selesai
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item kelengkapan-option"
                                                            data-value="Masuk">Masuk</a>
                                                    </li>
                                                    <li><a class="dropdown-item kelengkapan-option"
                                                            data-value="Selesai">Selesai</a></li>
                                                </ul>
                                                <input type="hidden" name="kelengkapan" id="checkKelengkapan"
                                                    value="">
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="d-flex gap-1 justify-content-between">
                                        <div class="col-lg-6 my-2">
                                            <div class="dropdown-status">
                                                <button
                                                    class="btn d-flex justify-content-between align-items-center bg-white border w-100 border-black rounded rounded-3 dropdown-toggle @error('pilih_status') is-invalid @enderror"
                                                    type="button" data-bs-toggle="dropdown" aria-expanded="false"
                                                    id="pilih_status" data-name="pilih_status" name="pilih_status">
                                                    Pilih Proses
                                                </button>
                                                <ul class="dropdown-menu pilih-menu">
                                                    <li><a class="dropdown-item status-option" data-value="3">Data Pesanan
                                                        </a></li>
                                                    <li><a class="dropdown-item status-option disabled"
                                                            data-value="Bahan Produk">Bahan Produk</a></li>
                                                    <li><a class="dropdown-item status-option disabled"
                                                            data-value="Sablon">Sablon</a></li>
                                                    <li><a class="dropdown-item status-option disabled"
                                                            data-value="Bordir">Bordir</a></li>
                                                    <li><a class="dropdown-item status-option disabled"
                                                            data-value="Penjahit">Penjahit</a></li>
                                                    <li><a class="dropdown-item status-option disabled"
                                                            data-value="QC">QC</a>
                                                    </li>
                                                    <li> <a class="dropdown-item status-option disabled"
                                                            data-value="Packing">Packing</a></li>
                                                </ul>
                                                <input type="hidden" name="status" id="modalStatus" value="">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 my-2 keterangan-parent">
                                            <div class="dropdown">
                                                <button
                                                    class="btn d-flex justify-content-between align-items-center bg-white border w-100 border-black rounded rounded-3 dropdown-toggle @error('kelengkapan') is-invalid @enderror"
                                                    type="button" data-bs-toggle="dropdown" aria-expanded="false"
                                                    id="kelengkapan" data-name="kelengkapan">
                                                    Kelengkapan
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item kelengkapan-option"
                                                            data-value="Lengkap">Lengkap</a>
                                                    </li>
                                                    <li><a class="dropdown-item kelengkapan-option"
                                                            data-value="Belum Lengkap">Belum
                                                            Lengkap</a></li>
                                                </ul>
                                                <input type="hidden" name="kelengkapan" id="checkKelengkapan"
                                                    value="">

                                            </div>
                                        </div>
                                    </div>
                                @endif





                                <div class="mb-3 col-lg-12">
                                    <label for="jumlah-dana" class="col-form-label">Note</label>
                                    <textarea type="text" class="form-control shadow" placeholder="Opsional" style="min-height: 100px !important;"
                                        name="keterangan"></textarea>
                                </div>


                            </div>
                            <div class="modal-footer justify-content-start gap-2 parentvalidasi"
                                style="position: relative;">

                                <div class="validasi px-2 py-1 rounded bg-primary text-center text-white">Simpan</div>
                                <button type="button" class="btn btn-secondary modal_btn_width"
                                    data-bs-dismiss="modal">Batal</button>
                                <div class="validasimuncul" style="display: none;">
                                    <div class="anaknyavalidasi">

                                        <div
                                            class="tengahnya w-50 m-auto p-5  rounded bg-white d-flex flex-column justify-content-center align-items-center">
                                            <h1>Ubah Status Orderan</h1>
                                            <p class="fz9 text-center">Setelah data status yang diubah disimpan data
                                                tersebut <b class="text-danger fzt9">tidak bisa diubah kembali</b>
                                                Apakah anda yakin menyimpan data ini?</p>
                                            <div class="kanankirivalidasi d-flex flex-row justify-content-between w-50">
                                                <button type="submit" class="btn btn-primary modal_btn_width "
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#confirmPerubahanStatusOrderModal"
                                                    id="btnSimpanProsesOrderan">Simpan</button>
                                                <div
                                                    class="buttonvalidasi px-2 py-1 rounded bg-danger text-center d-flex align-items-center text-white">
                                                    batal</div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        @endforeach


        {{-- resi --}}
        @foreach ($allorder as $resi)
            <div class="modal fade" id="resi{{ $resi->order_number }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel" style="margin-left: 120px">
                                Input Resi {{ $resi->order_number }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        {{-- @php
                            $orderDetails = DB::table('orders')
                                ->where('order_number', $resi->order_number)
                                ->get();
                            $totalQuantity = DB::table('orders')
                                ->where('order_number', $resi->order_number)
                                ->sum('quantity');
                        @endphp
                        <form method="POST" id="formongkir"
                            action="{{ route('resisa', ['orderNumber' => $resi->order_number]) }}">

                            @csrf
                            <div class="modal-body">
                                <div class="d-flex flex-row justify-content-between">
                                    <div class="mb-3 col-5">
                                        <label for="tanggal-bayar" class="col-form-label">Pilih Kurir</label>
                                        <select class="form-select custom-input" aria-label="Default select example"
                                            id="kurir" name="kurir">
                                            <option value="" selected>Pilih Kurir</option>
                                            <option value="JNE">JNE</option>
                                            <option value="Speed">Speed</option>
                                            <option value="Fast">Fast</option>
                                            <option value="Express">Express</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-5">
                                        <label for="isi_paket" class="col-form-label">Isi Paket</label>
                                        <input type="number" readonly class="form-control custom-input" id="isi_paket"
                                            name="isi_paket" value="{{ $totalQuantity }}">
                                    </div>
                                </div>
                                <div class="d-flex flex-row">
                                    <div class="mb-3 col-12">
                                        <label for="resi" class="col-form-label">No Resi</label>
                                        <input type="text" class="form-control custom-input" id="resi"
                                            name="resi" value="">
                                    </div>
                                </div>
                                <div class="d-flex flex-row justify-content-between">
                                    <div class="mb-3 col-5">
                                        <label for="tanggal_kirim" class="col-form-label">Tanggal Kirim</label>
                                        <input type="date" class="form-control custom-input" id="tanggal_kirim"
                                            name="tanggal_kirim" value="">
                                    </div>
                                    <div class="mb-3 col-5">
                                        <label for="ongkir" class="col-form-label">Ongkir</label>
                                        <input type="number" class="form-control custom-input" id="ongkir"
                                            name="ongkir" value="">
                                    </div>
                                </div>
                            </div>


                            <div class="modal-footer justify-content-start">
                                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Simpan</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </form> --}}
                    </div>
                </div>
            </div>
        @endforeach


        {{-- toast/popup ketika pembayaran berhasil --}}
        <div class="toast-container position-absolute bottom-0 start-50 translate-middle-x">
            <div id="pembayaranberhasil" class="toast rounded-4" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="toast-body bg-white text-center p-3">
                    <img src="/assets/img/checklist.png" alt="" style="width: 80px; height:80px">
                    <h6 class="mt-3 mb-3">Pembayaran <span style="color: #58D91B">Berhasil</span> Ditambahkan</h6>
                </div>
            </div>
        </div>
        {{-- toast/popup ketika pembayaran gagal --}}
        <div class="toast-container position-absolute bottom-0 start-50 translate-middle-x">
            <div id="pembayarangagal" class="toast rounded-4" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-body bg-white text-center p-3">
                    <img src="/assets/img/gagal.png" alt="" style="width: 100px; height:100px">
                    <h6 class="mt-3 mb-3">Pembayaran <span style="color: #F44336">GAGAL</span> Ditambahkan</h6>
                    <h6 class="text-center text-danger">ERROR: Message</h6>
                </div>
            </div>
        </div>

        </div>
    @section('js')
        <script>
            $(document).ready(function() {
                $('[data-bs-toggle="tooltip"]').tooltip();
            });
        </script>

        <script>
            document.querySelectorAll('.dropdown-status').forEach(item => {
                item.addEventListener('click', event => {
                    if (event.target.classList.contains('status-option')) {
                        const selectedOption = event.target;
                        const dropdown = selectedOption.closest('.dropdown-status');
                        const button = dropdown.querySelector('button');
                        const input = dropdown.querySelector('input');

                        button.innerText = selectedOption.innerText;
                        input.value = selectedOption.dataset.value;
                    }
                });
            });
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

            document.querySelectorAll('.validasi').forEach(item => {
                item.addEventListener('click', event => {

                    const muncul = event.target.closest('.parentvalidasi').querySelector('.validasimuncul');
                    muncul.style.display = "block";

                })
            })
            document.querySelectorAll('.buttonvalidasi').forEach(item => {
                item.addEventListener('click', event => {
                    const validasi = event.target.closest('.validasimuncul');
                    validasi.style.display = "none";
                });
            });

            document.querySelectorAll('#validasihapus').forEach(item => {
                item.addEventListener('click', event => {

                    const muncul = event.target.closest('.parentvalidasihapus').querySelector(
                        '.validasimunculhapus');
                    muncul.style.display = "block";

                })
            })
            document.querySelectorAll('.buttonvalidasihapus').forEach(item => {
                item.addEventListener('click', event => {
                    const validasi = event.target.closest('.validasimunculhapus');
                    validasi.style.display = "none";
                });
            });

            function hideDropdownMenu() {
                var dropdownMenu = document.querySelector('.dropdown-menu');
                dropdownMenu.style.display = 'none';
            }


            const forms = document.querySelectorAll('form.w-100.m-auto');
            forms.forEach((form, index) => {
                const button = form.querySelector('button[type="submit"]');
                button.addEventListener('click', () => {
                    var order_number = form.querySelector('#lorder_number').value;
                    localStorage.setItem('snamejuragan_' + order_number, form.querySelector('#lname_juragan')
                        .value);
                    localStorage.setItem('sidjuragan_' + order_number, form.querySelector('#lid_juragan')
                        .value);
                    localStorage.setItem('ssource_' + order_number, form.querySelector('#lsource').value);
                    localStorage.setItem('snameservedby_' + order_number, form.querySelector('#lname_served_by')
                        .value);
                    localStorage.setItem('sidservedby_' + order_number, form.querySelector('#lid_served_by')
                        .value);
                    localStorage.setItem('sordedate_' + order_number, form.querySelector('#lorder_date').value);
                    localStorage.setItem('snamecs_' + order_number, form.querySelector('#lname_customer')
                        .value);
                    localStorage.setItem('sidcs_' + order_number, form.querySelector('#lid_customer').value);
                    localStorage.setItem('snote_' + order_number, form.querySelector('#lnotes').value);
                    localStorage.setItem('smethod_' + order_number, form.querySelector('#lmethod').value);
                    localStorage.setItem('sstatus_' + order_number, form.querySelector('#lstatus').value);
                });
            });


            var dropdowns = document.querySelectorAll(".dropdown");
            dropdowns.forEach(function(dropdown) {
                dropdown.addEventListener('click', function() {
                    var dropdownMenu = this.nextElementSibling;
                    dropdownMenu.style.display = 'block';

                });
            });

            var ada = document.querySelectorAll("#ada");
            ada.forEach(function(ada) {
                ada.addEventListener('click', function() {
                    this.closest('.parentinfo').querySelector('#statusContainer').style.display = "block";
                    this.closest('.parentinfo').querySelector('.dropdown-menu').style.display = "none";
                    this.closest('.parentinfo').querySelector('#statusContainerTidak').style.display = "none";
                    this.closest('.parentinfo').querySelector('.cekada').style.display = "block";
                    this.closest('.parentinfo').querySelector('.garis').style.display = "none";
                    this.closest('.parentinfo').querySelector('.cektidak').style.display = "none";
                    this.closest('.parentinfo').querySelector('.dropdown').classList.remove('border-danger');
                    this.closest('.parentinfo').querySelector('.dropdown').classList.remove('border-black');
                    this.closest('.parentinfo').querySelector('.dropdown').classList.add('border-success');
                    this.closest('.parentinfo').querySelector('#adatidak').value = "Ada";
                });
            });

            var tada = document.querySelectorAll("#tidak-ada");
            tada.forEach(function(tada) {
                tada.addEventListener('click', function() {
                    this.closest('.parentinfo').querySelector('#statusContainer').style.display = "none";
                    this.closest('.parentinfo').querySelector('.dropdown-menu').style.display = "none";
                    this.closest('.parentinfo').querySelector('#statusContainerTidak').style.display = "block";
                    this.closest('.parentinfo').querySelector('.cekada').style.display = "none";
                    this.closest('.parentinfo').querySelector('.garis').style.display = "none";
                    this.closest('.parentinfo').querySelector('.cektidak').style.display = "block";
                    this.closest('.parentinfo').querySelector('.dropdown').classList.add('border-danger');
                    this.closest('.parentinfo').querySelector('.dropdown').classList.remove('border-black');
                    this.closest('.parentinfo').querySelector('.dropdown').classList.remove('border-success');
                    this.closest('.parentinfo').querySelector('#adatidak').value = "Tidak Ada";
                });
            });


            const tambahDropdownMenu = document.querySelectorAll('.dropdown-menu li a');

            for (let i = 0; i < tambahDropdownMenu.length; i++) {
                tambahDropdownMenu[i].addEventListener('click', function() {
                    const selectedValue = this.getAttribute('data-value');
                    this.closest('.dropdown-status').querySelector('#pilih_status').innerText = selectedValue;
                    this.closest('.dropdown-status').querySelector('#modalStatus').value = selectedValue;
                });
            }

            const kelengkapanDropdownMenu = document.querySelectorAll('#kelengkapan + .dropdown-menu a');
            kelengkapanDropdownMenu.forEach(item => {
                item.addEventListener('click', function() {
                    const selectedValue = this.getAttribute('data-value');
                    this.closest('.keterangan-parent').querySelector('#kelengkapan').innerText = selectedValue;
                    this.closest('.keterangan-parent').querySelector('#checkKelengkapan').value = selectedValue;

                });
            });



            document.getElementById('searchForm').onsubmit = function(e) {
                e.preventDefault();

                var form = this;
                var url = form.getAttribute('action') || window.location.href;
                var queryParams = [];

                Array.from(form.elements).forEach(function(element) {
                    var name = element.name;
                    var value = element.value;

                    if (name && value && value !== "Pilih Pembayaran" && value !== "Pilih opsi order" && value !==
                        "Pilih opsi pengiriman" && value !== "Nama Pelanggan") {
                        queryParams.push(encodeURIComponent(name) + "=" + encodeURIComponent(value));
                    }
                });

                var queryString = queryParams.join('&');
                if (queryString.length > 0) {
                    window.location.href = url + '?' + queryString;
                } else {
                    window.location.href = url;
                }
            };

            let dropdownItems = document.querySelectorAll('.dropdown-menu a');
            dropdownItems.forEach((item, index) => {
                item.addEventListener('click', function() {
                    let value = this.getAttribute('data-value');
                    let button = this.closest('.dropdown').querySelector('.dropdown-toggle');
                    button.innerText = value;

                    // Cari index dari item yang diklik
                    let clickedIndex = Array.from(dropdownItems).indexOf(this);

                    if (value === 'hapus') {
                        button.classList.add('text-danger');
                        console.log('Index yang diklik:', clickedIndex);
                    } else {
                        button.classList.remove('text-danger');
                    }
                });
            });





            $(document).ready(function() {
                var alerts = $('.toast-info');

                function showNextToast(index) {
                    if (index < alerts.length) {
                        $(alerts[index]).addClass('show');

                        setTimeout(function() {
                            $(alerts[index]).removeClass('show');
                            showNextToast(index + 1);
                        }, 2000);
                    }
                }

                setTimeout(function() {
                    showNextToast(0);
                }, 1000);
            });




            var kekurangan = Math.max(0, total - terbayar);

            document.getElementById("kekurangan").innerHTML = "RP " + kekurangan.toLocaleString();

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
    @endsection
@endsection
</body>

</html>
