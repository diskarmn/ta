{{-- @if (session()->has('success'))
    <div class="session-card p-4" id="successMessage">
        <img src="/assets/icons/checklist.png" alt="checklist" style="margin-right: 10px;">
        <h3 class="mt-3">{!! session('success') !!}</h3>
    </div>
    <script>
        setTimeout(function() {
            document.getElementById('successMessage').style.display = 'none';
        }, 1000); // Hilang dalam satu detik
    </script>
@endif

@if (session()->has('error') || $errors->any())
    <div class="session-error p-4">
        <img src="/assets/icons/gagal.png" alt="error" style="margin-right: 10px;">
        <h3 class="mt-3">
            @if (session()->has('error'))
                {!! session('error') !!}
            @else
                Terjadi Kesalahan:
            @endif
        </h3>
        @if ($errors->any())
            <ul class="mt-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>
@endif --}}
{{-- CARD BELUM PROSES DASHBOARD ADMIN --}}
@if ($orderan->count())
    @foreach ($orderan as $orderNumber => $data)
        <div class="card mt-5 rounded-3  " style="box-shadow: 3px 3px 4px 2px rgb(187, 185, 185); ">
            <!--atas-->
            <div class="card-header col-12 d-flex dashed-line justify-content-between d-flex flex-row ">
                <!--kiri-->
                <div class="card-atas-kiri d-flex flex-row " style="box-sizing: border-box;">
                    <input style="width: 180px; height:50px; font-weight:bold; font-size:20px"
                        class="rounded ms-3 text-center mt-3 fzt5 card-atas-satu" type="text"
                        value="{{ $orderNumber }}" readonly>
                    <div style="margin-left: 100px; font-size:16px" class="mt-1 card-atas-dua">
                        <input style="width: 180px" type="text" class="form-control-plaintext input-atas-kiri fzt6"
                            readonly value="{{ $data->first()->order_date }}">
                        <input style="width: 180px" type="text" class="form-control-plaintext input-atas-kiri fzt6"
                            readonly value="{{ $data->first()->juraganname }}">
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
                                value="{{ $data->first()->customer_name }}">
                            <label for="nohp" class="form-label"></label>
                            <input class="fzt7"
                                style="border: none; background-color:white; font-weight:bold; font-size:20px"
                                type="number" class="form-control mb-0 ms-0" id="nohp" readonly
                                value="{{ $data->first()->customer_phone }}">
                            <label for="metode" class="form-label"></label>

                            <input class="fzt7"
                                style="border: none; background-color:white; font-weight:bold; font-size:20px"
                                type="text" class="form-control" id="metode" readonly
                                value="{{ $data->first()->payment_method }}">
                        </div>
                        <div class="mb-2">
                            <label for="asalorderan" class="fzt7">Asal Orderan</label>
                            <input style="border: none; background-color:white; font-weight:bold; font-size:20px"
                                class="form-control fzt7" type="text" id="asalorderan" readonly
                                value="{{ $data->first()->source }}">
                        </div>
                        <div class="mb-4">
                            <label for="cs" class="fzt7">Dilayani</label>
                            <div class="p-scroll">
                                <p class="fzt7"><b>{{ $data->first()->served_byname }}</b></p>
                            </div>
                        </div>

                    </div>
                </div>
                <!--dua-->
                <div class=" col-2 p-0 ">
                    <div class="card-body " style="font-size: 15px; position: relative;">
                        <p class=" fzt7">Produk <i class="fa-solid fa-circle-info"></i></p>
                        <div>
                            @php
                                $orderData = DB::table('orders')
                                    ->join('barangs', 'orders.id_produk', '=', 'barangs.id')
                                    ->select('orders.quantity', 'orders.size', 'orders.subtotal', 'barangs.kd_produk')
                                    ->where('orders.order_number', $data->first()->order_number)
                                    ->get();

                                $totalSubtotal = $orderData->sum('subtotal');
                                $totalqty = $orderData->sum('quantity');
                            @endphp

                            @foreach ($orderData as $item)
                                <div class="d-flex flex-row">
                                    <div class="col-6">
                                        <p class="hoverjs"><b>{{ $item->kd_produk }}</b></p>
                                        <p class="hoverjs">{{ $item->size }}</p>
                                    </div>
                                    <div class="col-6">
                                        <p class="hoverjs">X <b> {{ $item->quantity }}</b></p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <hr style="height: 2px; border:none; color:black; background-color:black">
                        <div class="d-flex flex-row">
                            <div class="col-6">
                                <p class="hoverjs"><b>total</b></p>
                            </div>
                            <div class="col-6">
                                <p class="hoverjs"><b>= {{ $totalqty }} pcs</b></p>
                            </div>
                        </div>

                        <div class="hasilhover p-2 rounded">
                            <div class="d-flex">
                                <table>
                                    @foreach ($orderData as $hvr)
                                        <tr>
                                            <td>
                                                <p style="font-size: 70%"><b>{{ $hvr->kd_produk }}</b></p>
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
                                                <p style="font-size: 70%">Rp. {{ number_format($hvr->subtotal, 2) }}
                                                </p>
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
                                        <p style="font-size: 80%"><b>Rp. {{ number_format($totalSubtotal, 2) }}</b>
                                        </p>
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
                        @if ($data->first()->paid_amount < $data->first()->total_amount && $data->first()->paid_amount > 0)
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
                        @if ($data->first()->paid_amount == $data->first()->total_amount)
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
                                    <td id="total" class="fzt7" style="background-color: #EDEDED">RP
                                        {{ number_format($data->first()->total_amount, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </table>
                            <hr style="border-bottom: 3px solid black">
                            <table class="table table-borderless fw-bold">
                                <tr>
                                    <td class="fzt7" style="background-color: #EDEDED">
                                        Terbayar</td>
                                    <td class="fzt7" id="terbayar" style="background-color: #EDEDED">RP
                                        {{ number_format($data->first()->paid_amount, 0, ',', '.') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fzt7" style="background-color: #EDEDED">
                                        Kekurangan
                                    </td>
                                    @if ($data->first()->total_amount == $data->first()->paid_amount)
                                        <td class="fzt7 col-6 " style="background-color: #EDEDED">RP
                                            {{ number_format(max(0, $data->first()->total_amount - $data->first()->paid_amount), 0, ',', '.') }}
                                        </td>
                                    @else
                                        <td class="fzt7 col-6 " style="background-color: #EDEDED">-RP
                                            {{ number_format(max(0, $data->first()->total_amount - $data->first()->paid_amount), 0, ',', '.') }}
                                        </td>
                                    @endif
                                </tr>
                            </table>

                            {{-- keterangan lunas akan muncul apabila sudah terbayar lunas --}}
                            @if ($data->first()->total_amount == $data->first()->paid_amount)
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
                            $limitedNote = Str::limit($data->first()->notes, $limit = 50, $end = '...');
                        @endphp
                        <div class="note-section">
                            <div class="limited-note">
                                <p class="fzt6">{{ $limitedNote }}</p>
                            </div>
                            <div class="full-note fzt7" style="display: none; margin-top: 0; padding-top: 0;">
                                @foreach (explode("\n", $data->first()->notes) as $noteLine)
                                    <p style="margin: 0; padding: 0;">{{ $noteLine }}</p>
                                @endforeach
                            </div>
                            <a href="#" class="show-more fzt7"
                                onclick="toggleNoteVisibility(this); return false;">Selengkapnya
                            </a>
                            @php
                                $status = DB::table('update_status_proses')
                                    ->where('order_number', $data->first()->order_number)
                                    ->get();
                                $status9Selesai = DB::table('update_status_proses')
                                    ->where('order_number', $data->first()->order_number)
                                    ->where('id_status', 9)
                                    ->where('kelengkapan', 'selesai')
                                    ->first();
                                $status8Selesai = DB::table('update_status_proses')
                                    ->where('order_number', $data->first()->order_number)
                                    ->where('id_status', 8)
                                    ->where('kelengkapan', 'selesai')
                                    ->first();

                            @endphp
                            @if (
                                $data->first()->status == 'dalam_proses' &&
                                    $data->first()->total_amount == $data->first()->paid_amount &&
                                    $status8Selesai &&
                                    $status9Selesai)
                                <button type="button" class="btn btn-primary border border-dark w-100"
                                    data-bs-toggle="modal"
                                    data-bs-target="#resi{{ $data->first()->order_number }}">Resi
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
                @if ($data->first()->total_amount > $data->first()->paid_amount && $data->first()->status != 'cek_pembayaran')
                    <button data-bs-toggle="modal"
                        data-bs-target="#prosesOrderanModal{{ $data->first()->order_number }}" type="button"
                        class="rounded p-1 justify-content-center flex-lg-row flex-md-column  col-lg-2  col-3 d-flex align-items-center"
                        style="background-color: #202B46; color:white"
                        data-idpelanggan = "{{ $data->first()->id_customer }}"><small
                            class="me-2 fzt6 col-12 text-center"><i class="fa-regular fa-square-plus m-1"></i>Proses
                            Pembayaran</small>
                    </button>
                    <div class="sunting rounded rounded-3 d-flex overflow-hidden  col-2 mx-2 px-0 justify-content-between border border-dark border-2 "
                        style="">
                        <form class="w-100 m-auto" action="{{ route('kesunting', $data->first()->order_number) }}"
                            method="POST">
                            @csrf
                            <input type="hidden" value="{{ $data->first()->order_number }}" id="lorder_number">
                            <input type="hidden" value="{{ $data->first()->juragan }}" id="lid_juragan">
                            <input type="hidden" value="{{ $data->first()->juraganname }}" id="lname_juragan">
                            <input type="hidden" value="{{ $data->first()->source }}" id="lsource">
                            <input type="hidden" value="{{ $data->first()->served_by }}" id="lid_served_by">
                            <input type="hidden" value="{{ $data->first()->served_byname }}" id="lname_served_by">
                            <input type="hidden" value="{{ $data->first()->order_date }}" id="lorder_date">
                            <input type="hidden" value="{{ $data->first()->customer_name }}" id="lname_customer">
                            <input type="hidden" value="{{ $data->first()->id_customer }}" id="lid_customer">
                            <input type="hidden" value="{{ $data->first()->notes }}" id="lnotes">
                            <input type="hidden" value="{{ $data->first()->payment_method }}" id="lmethod">
                            <input type="hidden" value="{{ $data->first()->status }}" id="lstatus">
                            <button type="submit"
                                class="btn w-100 px-2 btn fzt7 text-start
                                                    border border-none text-dark w-100 d-flex align-items-center"
                                onclick="simpanlokal()" style="text-decoration: none;">
                                Sunting
                            </button>
                        </form>

                        <button class="px-3 bg-none dropdown border-none border  " type="button"
                            style="border-left:2px solid black !important;" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fa-solid fa-caret-down"></i>
                        </button>

                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item  fzt7" data-value="tambah" data-bs-toggle="modal"
                                    data-bs-target="#tambahPembayaran{{ $data->first()->order_number }}">Tambah
                                    Pembayaran</a></li>
                            <li><a class="dropdown-item text-danger fzt7" data-value="hapus">Hapus</a></li>
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


{{-- cek pembayaran --}}
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('update.check.paymentsa', ['orderId' => $orderNumber]) }}" method="POST">
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
                                <div class="d-flex flex-column">
                                    <input type="text" style="z-index: -10" class="border border-none bg-none"
                                        name="adatidak[]" id="adatidak" value="">
                                    <div class="py-2" id="statusContainer" style="display:none ;">
                                        <p class="fw-bold text-success" id="statusText">Status: Dana
                                            Ada
                                        </p>
                                        <input type="text" class="form-control" id="paymentProof" name="link[]"
                                            placeholder="Inputan link gambar bukti pembayaran disini!">
                                    </div>
                                    <div class="py-2 " id="statusContainerTidak" style="display:none ;">
                                        <p class="fw-bold text-danger" id="statusText">Status: Dana
                                            Tidak
                                            Ada</p>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" id="formongkir"
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
                                    <option value="BSI">BSI</option>
                                    <option value="COD">COD</option>
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
                    </div>
                    <div class="modal-footer justify-content-start">
                        {{-- <button type="button" id="liveToastBtn" class="btn btn-primary"
                                     onclick="hitungKekurangan()">Simpan</button> --}}
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Tambah
                            Pembayaran</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
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
                        <h5 class="modal-title w-100 text-center" id="prosesOrderanModalLabel">Status Proses
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
                                            Pilih Status
                                        </button>
                                        <ul class="dropdown-menu pilih-menu">
                                            <li><a class="dropdown-item status-option disabled" data-value="3">Data
                                                    Pesanan</a></li>
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
                                        <input type="text" name="status" id="modalStatus" value="">
                                    </div>

                                </div>
                                <div class="col-lg-6 my-2 keterangan-parent">
                                    <div class="dropdown">
                                        <button
                                            class="btn d-flex justify-content-between align-items-center bg-white border w-100 border-black rounded rounded-3 dropdown-toggle @error('kelengkapan') is-invalid @enderror"
                                            type="button" data-bs-toggle="dropdown" aria-expanded="false"
                                            id="kelengkapan" data-name="kelengkapan">
                                            Pilih
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item kelengkapan-option"
                                                    data-value="Masuk">Masuk</a>
                                            </li>
                                            <li><a class="dropdown-item kelengkapan-option"
                                                    data-value="Selesai">Selesai</a></li>
                                        </ul>
                                        <input type="text" name="kelengkapan" id="checkKelengkapan"
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
                                            Pilih Status
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
                                            <li><a class="dropdown-item status-option disabled" data-value="QC">QC</a>
                                            </li>
                                            <li> <a class="dropdown-item status-option disabled"
                                                    data-value="Packing">Packing</a></li>
                                        </ul>
                                        <input type="number" name="status" id="modalStatus" value="">
                                    </div>
                                </div>
                                <div class="col-lg-6 my-2 keterangan-parent">
                                    <div class="dropdown">
                                        <button
                                            class="btn d-flex justify-content-between align-items-center bg-white border w-100 border-black rounded rounded-3 dropdown-toggle @error('kelengkapan') is-invalid @enderror"
                                            type="button" data-bs-toggle="dropdown" aria-expanded="false"
                                            id="kelengkapan" data-name="kelengkapan">
                                            Pilih
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item kelengkapan-option"
                                                    data-value="Lengkap">Lengkap</a>
                                            </li>
                                            <li><a class="dropdown-item kelengkapan-option"
                                                    data-value="Belum Lengkap">Belum
                                                    Lengkap</a></li>
                                        </ul>
                                        <input type="text" name="kelengkapan" id="checkKelengkapan"
                                            value="">

                                    </div>
                                </div>
                            </div>
                        @endif





                        <div class="mb-3 col-lg-12">
                            <label for="jumlah-dana" class="col-form-label">Note / Keterangan</label>
                            <textarea type="text" class="form-control shadow" placeholder="Opsional" style="min-height: 100px !important;"
                                name="keterangan"></textarea>
                        </div>


                    </div>
                    <div class="modal-footer justify-content-start gap-2 parentvalidasi" style="position: relative;">

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
                                            data-bs-toggle="modal" data-bs-target="#confirmPerubahanStatusOrderModal"
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
    <div class="modal fade" id="resi{{ $resi->order_number }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel" style="margin-left: 120px">
                        Input Resi {{ $resi->order_number }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                @php
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
                </form>
            </div>
        </div>
    </div>
@endforeach







{{-- @php
    $status = $filtered->status ?? 'belum_proses';
@endphp --}}





{{-- <x-confirm-modal-status /> --}}
{{-- <div class="modal fade" id="confirmPerubahanStatusOrderModal" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="confirmPerubahanStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="confirmPerubahanStatusModalLabel">Ubah Status Orderan
                </h5>
            </div>
            <div class="modal-body text-center">
                <p>Setelah data status yang diubah disimpan, data tersebut <span class="text-danger">tidak bisa diubah
                        kembali</span><br>Apakah Anda yakin menyimpan data ini?</p>
            </div>
            <div class="modal-footer justify-content-center gap-2">
                <button type="button" class="btn btn-secondary modal_btn_width"
                    data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary modal_btn_width" data-bs-toggle="modal"
                    data-bs-target="confirmPerubahanStatusOrderModal">Simpan</button>
            </div>
        </div>
    </div>
</div> --}}
{{-- Akhir Modal Confirm Perubahan Status Order Modal --}}

{{-- Akhir Modal Proses Orderan --}}

{{-- @section('javascript') --}}
<script src="/assets/js/admin/dashboard/dashboard-admin.js"></script>
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
{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {

        document.querySelectorAll('.line_selengkapnya a').forEach((link, index) => {
            link.addEventListener('click', () => toggleNotes(index));
        });

        const status = "{{ $status }}";
        const dropdownItems = document.querySelectorAll('.status-option');

        if (status === 'belum_proses') {
            dropdownItems.forEach(item => {
                if (item.getAttribute('data-value') === 'Data Pesanan') {
                    item.classList.remove('disabled');
                } else {
                    item.classList.add('disabled');
                }
            });
        }

        if (status === 'cek_pembayaran') {
            dropdownItems.forEach(item => {
                if (item.getAttribute('data-value') !== 'Data Pesanan') {
                    item.classList.remove('disabled');
                } else {
                    item.classList.add('disabled');
                }
            });
        }

        const tambahBayarDropdownMenu = document.querySelectorAll('#tujuan_bayar + .dropdown-menu a');
        tambahBayarDropdownMenu.forEach(item => {
            item.addEventListener('click', function() {
                const selectedValue = this.getAttribute('data-value');
                document.getElementById('tujuan_bayar').innerText = selectedValue;
                document.getElementById('tujuan_bayar').value = selectedValue;
            });
        });

        const simpanBtn = document.getElementById('btnSimpanBayar');
        simpanBtn.addEventListener('click', function() {
            document.getElementById('modalBayar').value = 'cek_pembayaran';
        })

        const tambahDropdownMenu = document.querySelectorAll('#pilih_status + .dropdown-menu a');
        tambahDropdownMenu.forEach(item => {
            item.addEventListener('click', function() {
                const selectedValue = this.getAttribute('data-value');
                document.getElementById('pilih_status').innerText = selectedValue;
                document.getElementById('pilih_status').value = selectedValue;
            });
        });

        const kelengkapanDropdownMenu = document.querySelectorAll('#kelengkapan + .dropdown-menu a');
        kelengkapanDropdownMenu.forEach(item => {
            item.addEventListener('click', function() {
                const selectedValue = this.getAttribute('data-value');
                document.getElementById('kelengkapan').innerText = selectedValue;
                document.getElementById('checkKelengkapan').value = selectedValue;

            });
        });

        const simpanButton = document.querySelector('#confirmPerubahanStatusOrderModal .btn-primary');
        simpanButton.addEventListener('click', handleSimpanClick);

        function handleSimpanClick() {
            const kelengkapanValue = document.getElementById('kelengkapan').innerText.trim();
            if (kelengkapanValue === 'Lengkap') {
                const confirmModal = bootstrap.Modal.getInstance(document.getElementById(
                    'confirmPerubahanStatusOrderModal'));
                confirmModal.show();

                document.getElementById('modalStatus').value = 'cek_pembayaran';

                const modalProsesOrderan = bootstrap.Modal.getInstance(document.getElementById(
                    'prosesOrderanModal'));
                modalProsesOrderan.hide();
            } else {

                const modalProsesOrderan = bootstrap.Modal.getInstance(document.getElementById(
                    'prosesOrderanModal'));
                modalProsesOrderan.hide();
            }
        }

        const successMessage = document.querySelector('.session-card');

        if (successMessage) {
            setTimeout(function() {
                successMessage.style.display = 'none';
            }, 2000);
        }

        const errorMessage = document.querySelector('.session-error');

        if (errorMessage) {
            setTimeout(function() {
                errorMessage.style.display = 'none';
            }, 2000);
        }
    });
</script> --}}
{{-- @endsection --}}
