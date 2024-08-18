@section('css')
    <style>
        #btn-semua-orderan {
            background-color: #202B46;
            color: white;
        }

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

                    {{-- @include('super-admin.dashboard-invoice.layouts.button') --}}
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
                                                                            <b>{{ $hvr->produk_nama }}</b>
                                                                        </p>
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
                                                        $resi = DB::table('resi')
                                                            ->where('order_number', $data->order_number)
                                                            ->first();
                                                    @endphp

                                                    @if ($resi)
                                                        <table>
                                                            <tr>
                                                                <th style="font-size: 70%;">Kurir</th>
                                                                <td style="font-size: 70%;">:{{ $resi->kurir }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th style="font-size: 70%;">Ongkos</th>
                                                                <td style="font-size: 70%;">:{{ $resi->ongkos }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th style="font-size: 70%;">Lainnya</th>
                                                                <td style="font-size: 70%;">:{{ $resi->lainnya }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th style="font-size: 70%;">No Resi</th>
                                                                <td style="font-size: 70%;">:{{ $resi->no_resi }}</td>
                                                            </tr>
                                                        </table>
                                                    @else
                                                    @endif


                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                    {{-- card bawah endiri untuk tampilan superadmin --}}
                                    <div class="card-bawah-sendiri-superadmin  px-4 py-3 gap-2 row">
                                        {{-- tombol pembayaran muncul apabila status masih dalam proses dan jumalh yang terbayar masih kurang --}}

                                        @if ($data->status == 'cek_pembayaran')
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
                                            <div
                                                class="col-3  justify-content-center align-items-center d-flex fzt6 rounded">
                                                <button type="button" class="btn btn-warning border border-dark w-100"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#infoPembayaranModal{{ $data->order_number }}">Cek
                                                    Orderan</button>
                                            </div>
                                        @else
                                        @endif
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
                                        {{-- lunas --}}
                                        @if (
                                            ($data->total_amount == $data->paid_amount || $data->paid_amount > $data->total_amount) &&
                                                $data->status != 'cek_pembayaran' &&
                                                $data->status != 'orderan_selesai')
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

                                        {{-- cetak invoice muncul apabila orderan sudah selesai dan terbayar lunas --}}
                                        @if ($data->total_amount == $data->paid_amount && $data->status == 'orderan_selesai')
                                            <div class="d-flex justify-content-between align-items-center  col-lg-2  col-3 p-0"
                                                onclick="goToInvoice()"
                                                style="background-color: rgb(255, 255, 255);   font-weight:bold; border:2px solid #202B46; border-radius:10px;">
                                                <a href="{{ route('super-admin.dashboard-invoice.invoice', ['orderNumber' => $data->order_number]) }}"
                                                    class="btn rounded p-1 text-start fzt7" style="color: #202B46;">Cetak
                                                    Invoice </a>
                                                <div class=" fzt6 "
                                                    style="background-color: #202B46; border-radius: 0 5px 5px 0; padding:9px">
                                                    <a
                                                        href="{{ route('super-admin.dashboard-invoice.invoice', ['orderNumber' => $data->order_number]) }}">
                                                        <i class="fa-solid fa-download  " style="color: white"></i></a>
                                                </div>
                                            </div>
                                        @else
                                        @endif
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
                                            <div class="col-3">
                                                <button type="button" class="btn btn-warning text-dark  col-3 w-100"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#resi{{ $data->order_number }}">
                                                    <svg width="36" height="35" viewBox="0 0 50 33"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g id="Logo Diantar">
                                                            <rect id="Box" x="7.4375" y="1.69238" width="19.7476"
                                                                height="25" stroke="#070707" stroke-width="2" />
                                                            <path id="Head"
                                                                d="M35.1755 11.6924H27.7969V19.1924M35.1755 11.6924L41.0008 19.1924M35.1755 11.6924V19.1924M41.0008 19.1924V27.1924H27.7969V19.1924M41.0008 19.1924H35.1755M27.7969 19.1924H35.1755"
                                                                stroke="#070707" stroke-width="2" />
                                                            <path id="Ellipse 1973"
                                                                d="M34.9493 29.6924C34.9493 31.0468 34.1333 31.6924 33.6192 31.6924C33.105 31.6924 32.2891 31.0468 32.2891 29.6924C32.2891 28.338 33.105 27.6924 33.6192 27.6924C34.1333 27.6924 34.9493 28.338 34.9493 29.6924Z"
                                                                stroke="#070707" stroke-width="2" />
                                                            <path id="Ellipse 1974"
                                                                d="M12.4258 29.6924C12.4258 31.0468 11.6099 31.6924 11.0957 31.6924C10.5816 31.6924 9.76562 31.0468 9.76562 29.6924C9.76562 28.338 10.5816 27.6924 11.0957 27.6924C11.6099 27.6924 12.4258 28.338 12.4258 29.6924Z"
                                                                stroke="#070707" stroke-width="2" />
                                                            <path id="Vector 1483"
                                                                d="M1 8.69238C0.447715 8.69238 0 9.1401 0 9.69238C0 10.2447 0.447715 10.6924 1 10.6924V8.69238ZM1 10.6924H23.5243V8.69238H1V10.6924Z"
                                                                fill="#070707" />
                                                            <path id="Vector 1484"
                                                                d="M4.88281 12.6924C4.33053 12.6924 3.88281 13.1401 3.88281 13.6924C3.88281 14.2447 4.33053 14.6924 4.88281 14.6924V12.6924ZM4.88281 14.6924H23.5236V12.6924H4.88281V14.6924Z"
                                                                fill="#070707" />
                                                            <path id="Vector 1485"
                                                                d="M1 17.6924C0.447715 17.6924 2.89661e-0 justify-content-center d-flex 8 18.1401 0 18.6924C-2.89661e-0 justify-content-center d-flex 8 19.2447 0.447715 19.6924 1 19.6924L1 17.6924ZM1 19.6924L23.5243 19.6924L23.5243 17.6924L1 17.6924L1 19.6924Z"
                                                                fill="#070707" />
                                                        </g>
                                                    </svg>
                                                    Input Resi
                                                </button>
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




        @foreach ($dana as $orderNumber => $orders)
            @php
                $infoPembayaran = DB::table('info_pembayaran')
                    ->where('order_number', $orderNumber)
                    ->whereNull('kelengkapan')
                    ->get();
            @endphp
            <div class="modal fade infopembayaran" id="infoPembayaranModal{{ $orderNumber }}" tabindex="1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog ">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title w-100 text-center" id="infoPembayaranModalLabel">Info Pembayaran
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('update.check.paymentsa', ['orderId' => $orderNumber]) }}"
                                method="POST">
                                @csrf
                                <p>{{ $orderNumber }}</p>
                                <p
                                    class="bg-warning text-secondary rounded-1 text-center fs-6 fw-medium font-family-Montserrat m-0 px-3 py-2">
                                    Detail Pembayaran tidak bisa diganti atau dirubah</p>
                                @foreach ($infoPembayaran as $info)
                                    <div class="d-flex flex-column parentinfo">
                                        <div
                                            class="d-flex gap-4 align-items-center justify-content-between border border-1
                                                my-2 px-3 rounded-1 border-secondary shadow">
                                            <div class="col-lg-2 d-flex align-items-center">
                                                <p class="fw-bold gap-1 d-flex align-items-center my-1">
                                                    <span>
                                                        <svg width="35" height="31" viewBox="0 0 35 31"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <g id="Icon">
                                                                <path id="Vector"
                                                                    d="M29.4231 8.23779H5.57692C3.60144 8.23779 2 9.83989 2 11.8162V26.1298C2 28.1061 3.60144 29.7082 5.57692 29.7082H29.4231C31.3986 29.7082 33 28.1061 33 26.1298V11.8162C33 9.83989 31.3986 8.23779 29.4231 8.23779Z"
                                                                    stroke="#0091FF" stroke-width="2.58333"
                                                                    stroke-linejoin="round" />
                                                                <path id="Vector_2"
                                                                    d="M29.0773 8.47931V5.78352C29.0771 5.12234 28.9559 4.46936 28.7224 3.87116C28.4888 3.27296 28.1487 2.74429 27.7262 2.32287C27.3037 1.90146 26.8092 1.59768 26.2782 1.43321C25.7471 1.26875 25.1925 1.24765 24.6538 1.37142L5.02846 5.4106C4.1762 5.60645 3.40734 6.1548 2.85447 6.96108C2.30161 7.76735 1.99941 8.781 2 9.8272V14.2303"
                                                                    stroke="#0091FF" stroke-width="2.58333"
                                                                    stroke-linejoin="round" />
                                                                <path id="Vector_3"
                                                                    d="M25.8456 24.295C25.3739 24.295 24.9129 24.1263 24.5207 23.8103C24.1286 23.4944 23.8229 23.0453 23.6425 22.5199C23.462 21.9944 23.4147 21.4163 23.5068 20.8585C23.5988 20.3007 23.8259 19.7883 24.1594 19.3862C24.4929 18.984 24.9178 18.7102 25.3803 18.5992C25.8429 18.4882 26.3224 18.5452 26.7581 18.7628C27.1938 18.9805 27.5663 19.349 27.8283 19.8219C28.0903 20.2948 28.2302 20.8507 28.2302 21.4195C28.2302 22.1821 27.9789 22.9135 27.5317 23.4527C27.0845 23.992 26.478 24.295 25.8456 24.295Z"
                                                                    fill="#0091FF" />
                                                            </g>
                                                        </svg>
                                                    </span>
                                                    {{ $info->payment_method }}

                                                </p>
                                            </div>
                                            <div class="col-lg-4 my-2">
                                                <p class=" fs-6 fw-medium font-family-Poppins ml-2 my-0">
                                                    Rp
                                                    {{ number_format($info->jumlah_dana, 0, ',', '.') }}

                                            </div>
                                            <div class="col-lg-3 wadah my-2 justify-content-end d-flex">
                                                <div class="btn-group dropend infopembayaran">
                                                    <a class="btn border border-3 border-black px-2 dropdown rounded-2 ">
                                                        <span class="">
                                                            <svg width="14" height="4" style="display: ;"
                                                                class="mx-1 my-2 garis" viewBox="0 0 11 1" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path id="Vector 1489" d="M1.5 1.5H9.5" stroke="black"
                                                                    stroke-width="3" stroke-linecap="round" />
                                                            </svg>
                                                            <i class="fa-solid fa-check text-success  fs-4 cekada"
                                                                style="display: none;"></i>
                                                            <i class="fa-solid fa-check text-danger fs-4 cektidak"
                                                                style="display: none;"></i>
                                                        </span>

                                                    </a>

                                                    <div class="dropdown-menu border border-dark" style="display: none;">
                                                        <p class="mx-5 my-2" id="ada">Ada</p>
                                                        <p class="mx-5 my-2" style="white-space: nowrap;" id="tidak-ada">
                                                            Tidak Ada</p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <img class="gallery-image"
                                                data-img-src="{{ asset('bukti_pembayaran/' . $info->gambar) }}"
                                                src="{{ asset('bukti_pembayaran/' . $info->gambar) }}"
                                                style="max-width: 20%;" alt="">

                                        </div>
                                        <div class="d-flex flex-column">
                                            <input type="text" style="z-index: -10" class="border border-none bg-none"
                                                name="adatidak[]" id="adatidak" value="">
                                            <div class="py-2" id="statusContainer" style="display:none ;">
                                                <p class="fw-bold text-success" id="statusText">Bukti Ada
                                                </p>

                                            </div>
                                            <div class="py-2 " id="statusContainerTidak" style="display:none ;">
                                                <p class="fw-bold text-danger" id="statusText">Bukti belum ada</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <div class=" justify-content-start gap-2">
                                    <button type="submit" id="submit_cek"
                                        class="btn btn-primary modal_btn_width">Simpan</button>
                                    <button type="button" class="btn btn-secondary modal_btn_width"
                                        data-bs-dismiss="modal">Batal</button>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
            </div>
        @endforeach


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
                                                    Masuk/Selesai
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
                        @php
                            $orderDetails = DB::table('orders')
                                ->where('order_number', $resi->order_number)
                                ->first(); // Use first() to get a single record instead of get()
                            $total_qty = $orderDetails ? $orderDetails->total_quantity : 0;

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
                                        <label for="lainnya" class="col-form-label">Lainnya</label>
                                        <input type="text" class="form-control custom-input" id="lainnya"
                                            name="lainnya" value="">
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
                                        <label for="isi_paket" class="col-form-label">Isi Paket</label>
                                        <input type="number" readonly class="form-control custom-input" id="isi_paket"
                                            name="isi_paket" value="{{ $total_qty }}">
                                    </div>

                                </div>
                                <div class="d-flex flex-row justify-content-between">
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
                        </form>
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



        <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered" style="max-width: 50%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="imageModalLabel">Bukti Pembayaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img id="modalImage" class="img-fluid" src="" alt="">
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
        <!-- Skrip JavaScript untuk menangani perhitungan kekurangan -->
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

            document.addEventListener('DOMContentLoaded', function() {
                // Ambil elemen modal dan gambar modal
                const modal = document.getElementById('imageModal');
                const modalImage = document.getElementById('modalImage');

                // Ambil semua elemen gambar di galeri
                const galleryImages = document.querySelectorAll('.gallery-image');

                galleryImages.forEach(image => {
                    // Tambahkan event listener untuk klik
                    image.addEventListener('click', function() {
                        // Ambil src gambar dari atribut data
                        const imgSrc = this.getAttribute('data-img-src');

                        // Set src gambar modal
                        modalImage.src = imgSrc;

                        // Tampilkan modal
                        const modalInstance = new bootstrap.Modal(modal);
                        modalInstance.show();
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



            //         var validasi = document.querySelectorAll(".validasi");

            // for(let i=0; i<validasi.length;i++){
            //     var validasimuncul = this.closest.querySelector(".validasimuncul");
            //     var buttonvalidasi = this.closest.querySelector(".buttonvalidasi");

            //     this.addEventListener("click", function() {
            //         validasi.style.background = 'red';
            //         validasimuncul.style.display = "block";
            //     })
            //     buttonvalidasi.addEventListener("click", function() {
            //         validasi.style.background = 'white';
            //         validasimuncul.style.display = "none";
            //     })
            // }




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
            // tambahDropdownMenu.forEach(item => {
            //     item.addEventListener('click', function() {
            //         const selectedValue = this.getAttribute('data-value');
            //         this.closest('.dropdown-status').querySelector('#pilih_status').innerText = selectedValue;
            //         this.closest('.dropdown-status').querySelector('#modalStatus').value = selectedValue;
            //     });
            // });
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

            //sunting
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




            // Menampilkan Alert
            // jQuery
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





            // menghitung kekurangan pembayaran
            // Ambil nilai total dan terbayar dari PHP ke JavaScript


            // Hitung kekurangan
            var kekurangan = Math.max(0, total - terbayar);

            // Tampilkan kekurangan di elemen dengan id "kekurangan"
            document.getElementById("kekurangan").innerHTML = "RP " + kekurangan.toLocaleString();

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
    @endsection
@endsection
</body>

</html>
