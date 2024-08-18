@section('css')
    <style>
        #btn-orderan-selesai {
            background-color: #202B46;
            color: white;
        }

        #navbar-dashboard {
            color: white !important;
            font-weight: 600 !important;
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
    @extends('layouts.mainA')
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

                    @include('admin.dashboard.layouts.button')
                </div>
            </div>
            <!--card-->


            <div class="d-flex justify-content-center ">

                <div class="main-content  col-lg-11 col-md-10 justify-content-center">
                    <!-- Konten utama Anda di sini -->
                    <form action="" class="form-container">

                        {{-- implementasi array dalam OrderanController menampilkan ke blade --}}
                        @if ($orderan->count())
                            @foreach ($orderan as $data)
                                <div id="maincard" class="card  mt-5 rounded-3 custom-input w-100">
                                    <!--atas-->

                                    <div class="card-header dashed-line d-flex flex-row justify-content-between"
                                        style="box-sizing: border-box;">
                                        <!--kiri-->
                                        <div class="card-atas-kiri d-flex flex-row">
                                            <input style="width: 180px; height:50px; font-weight:bold; font-size:20px"
                                                class="rounded ms-3 text-center mt-3 fzt6 card-atas-satu" type="text"
                                                value="{{ $data->order_number }}" readonly>
                                            <div style="margin-left: 100px; font-size:16px" class="mt-1">
                                                <input style="width: 180px" type="text"
                                                    class="form-control-plaintext fzt6" readonly
                                                    value="{{ $data->order_date }}">
                                                <input style="width: 180px" type="text"
                                                    class="form-control-plaintext fzt6" readonly
                                                    value="{{ $data->juragan }}">
                                            </div>
                                        </div>
                                        <!--kanan-->
                                        @include('super-admin.dashboard-invoice.icon.proses-icon')
                                    </div>
                                    <!--bawah-->
                                    {{-- info pemesan --}}
                                    <div class="card-body d-flex">
                                        <!--satu-->
                                        <div class="col-3 p-0 ">
                                            <div class="card-body">
                                                <div class="mb-2">

                                                    <label for="pemesan" class="form-label fzt7">Pemesan / Dikirim
                                                        kepada</label>
                                                    <input class="fzt7"
                                                        style="border: none;background-color:white;font-weight:bold; font-size:20px"
                                                        type="text" class="form-control" id="pemesan" readonly
                                                        value="{{ $data->customer_name }}">
                                                    <label for="nohp" class="form-label"></label>
                                                    <input class="fzt7"
                                                        style="border: none; background-color:white; font-weight:bold; font-size:20px"
                                                        type="number" class="form-control" id="nohp" readonly
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
                                                        class="fzt7" type="text" id="asalorderan"
                                                        readonly value="{{ $data->source }}">
                                                </div>
                                                <div class="mb-4">
                                                    <label for="cs" class="fzt7">Dilayani</label>
                                                    <div class="p-scroll">
                                                        <p class="fzt7"><b>{{ $data->served_by }}</b></p>
                                                    </div>
                                                </div>

                                                {{-- cetak invoice muncul apabila orderan sudah selesai dan terbayar lunas --}}
                                                @if ($data->total_amount == $data->paid_amount && $data->status == 'orderan_selesai')
                                                    <div class="d-flex justify-content-between align-items-center   p-0"
                                                        onclick="goToInvoice()"
                                                        style="background-color: white;   font-weight:bold; border:2px solid #202B46; border-radius:10px;">
                                                        <a href="{{ route('cs.data-pelanggan.invoice', ['orderNumber' => $data->order_number]) }}"
                                                            class="btn rounded p-1 text-start fzt7"
                                                            style="color: #202B46;">Cetak
                                                            Invoice </a>
                                                        <div class=" fzt6 "
                                                            style="background-color: #202B46; border-radius: 0 5px 5px 0; padding:9px">
                                                            <a
                                                                href="{{ route('cs.data-pelanggan.invoice', ['orderNumber' => $data->order_number]) }}">
                                                                <i class="fa-solid fa-download  " style="color: white"></i></a>
                                                        </div>
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                        <!--dua-->
                                        <div class=" col-2 p-0 ">
                                            <div class="card-body " style="font-size: 15px; position: relative;">
                                                <p class=" fzt7">Produk <i class="fa-solid fa-circle-info hoverjs"></i></p>
                                                <div>

                                                    @php
                                                        $barangOrders =  DB::table('barang_order')
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
                                                                    <td><p style="font-size: 70%"><b>{{ $hvr->produk_nama }}</b></p></td>
                                                                    <td><p style="font-size: 70%">{{ $hvr->size }}</p></td>
                                                                    <td><p style="font-size: 70%">X</p></td>
                                                                    <td><p style="font-size: 70%">{{ $hvr->quantity }}</p></td>
                                                                    <td><p style="font-size: 70%">=</p></td>
                                                                    <td><p style="font-size: 70%">Rp. {{ number_format($hvr->subtotal, 2) }}</p></td>
                                                                </tr>
                                                                 @endforeach
                                                            </table>
                                                        </div>

                                                    <hr style="height: 2px; border:none; color:black; background-color:black">
                                                    <table>
                                                        <tr>
                                                            <td><p style="font-size: 80%"><b>total</b></p></td>
                                                            <td><p style="font-size: 80%"><b>=</b></p></td>
                                                            <td><p style="font-size: 80%"><b>Rp. {{ number_format($data->total_amount, 2) }}</b></p></td>
                                                        </tr>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                        <!--tiga-->
                                        <div class=" col-4 p-0">
                                            <div class="card rounded-3">
                                                {{-- header berwarna merah apabila belum dibayar --}}
                                                @if ($data->paid_amount == 0)
                                                    <div class="card-header P-4 wajib-bayar custom-input"
                                                        style="display: absolute; z-index:1; background : linear-gradient(to bottom, #FF8E8E, #FFFFFF)">
                                                        <h5 class="text-center fs-4 fzt7" style="font-weight: bold">Wajib
                                                            Bayar RP
                                                            {{ number_format($data->total_amount, 0, ',', '.') }}
                                                        </h5>
                                                    </div>
                                                @endif

                                                {{-- header berwarna kuning apabila dibayar sebagian --}}
                                                @if ($data->paid_amount < $data->total_amount && $data->paid_amount > 0)
                                                    <div class="card-header P-4 wajib-bayar custom-input"
                                                        style="display: absolute; z-index:1; background : linear-gradient(to bottom, #FDF771, #FFFFFF)">
                                                        <h5 class="text-center fs-4" fzt7 style="font-weight: bold">Wajib
                                                            Bayar RP
                                                            {{ number_format($data->total_amount, 0, ',', '.') }}
                                                        </h5>
                                                    </div>
                                                @endif

                                                {{-- header berwarna hijau apabila terbayar lunas --}}
                                                @if ($data->paid_amount == $data->total_amount)
                                                    <div class="card-header P-4 wajib-bayar custom-input"
                                                        style="display: absolute; z-index: 1; background: linear-gradient(to bottom, #4FDF6F, #FFFFFF);">
                                                        <h5 class="text-center fs-4 fzt7 " style="font-weight: bold">Lunas
                                                            {{ number_format($data->total_amount, 0, ',', '.') }}
                                                        </h5>
                                                    </div>
                                                @endif

                                                {{-- isi card body --}}
                                                <div class="card-body fs-5 " style="background-color: #EDEDED">
                                                    <table class="table table-borderless fw-bold fs-5 ">
                                                        <tr>
                                                            <td class="fzt7" style="background-color: #EDEDED">Harga
                                                                Produk
                                                            </td>
                                                            <td class="fzt7" id="total"
                                                                style="background-color: #EDEDED">RP
                                                                {{ number_format($data->total_amount, 0, ',', '.') }}
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <hr style="border-bottom: 3px solid black">
                                                    <table class="table table-borderless fw-bold">
                                                        <tr>
                                                            <td class="fzt7" style="background-color: #EDEDED">Terbayar
                                                            </td>
                                                            <td class="fzt7" id="terbayar"
                                                                style="background-color: #EDEDED">RP
                                                                {{ number_format($data->paid_amount, 0, ',', '.') }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fzt7" style="background-color: #EDEDED">
                                                                Kekurangan
                                                            </td>
                                                            <td class="fzt7" id="kekurangan"
                                                                style="background-color: #EDEDED">RP
                                                                {{ number_format(max(0, $data->total_amount - $data->paid_amount), 0, ',', '.') }}
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    {{-- keterangan lunas akan muncul apabila sudah terbayar penuh --}}
                                                    @if ($data->total_amount == $data->paid_amount)
                                                        <div id="status-lunas"
                                                            class="border border-secondary p-2 mb-2 text-center rounded-3 custom-input fzt7"
                                                            style="font-weight: bold; color:#ccc;">LUNAS</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <!--emat-->
                                        {{-- note keterangan --}}
                                        <div class=" col-3 p-0 ">
                                            <div class="card-body" style="font-size: 18px">
                                                <p class="fzt7" style="font-weight: 900; color:#ccc">Keterangan</p>
                                                @php
                                                    // Ubah jumlah kata yang diinginkan sesuai kebutuhan
                                                    $limitedNote = Str::limit(
                                                        $data->notes,
                                                        $limit = 50,
                                                        $end = '...',
                                                    );
                                                @endphp
                                                <div class="note-section">
                                                    <div class="limited-note">
                                                        <p class="fzt6 my-0">{{ $limitedNote }}</p>
                                                        @if($data->dana_ongkir)
                                                            <p class="fzt6 my-0">{{ $data->dana_ongkir }}: {{ $data->dana_ongkir }}</p>
                                                        @else
                                                            <p class="fzt6 my-0">dana ongkir tidak ada</p>
                                                        @endif
                                                        @if($data->dana_biaya_lain)
                                                            <p class="fzt6 my-0">{{ $data->biaya_lain }}: {{ $data->dana_biaya_lain }}</p>
                                                        @else
                                                            <p class="fzt6 my-0">biaya lain tidak ada</p>
                                                        @endif
                                                    </div>
                                                    <div class="full-note"
                                                        style="display: none; margin-top: 0; padding-top: 0;">
                                                        @foreach (explode("\n", $data->notes) as $noteLine)
                                                            <p style="margin: 0; padding: 0;" class="fzt7">
                                                                {{ $noteLine }}</p>
                                                        @endforeach
                                                    </div>
                                                    <a href="#" class="show-more fzt7"
                                                        onclick="toggleNoteVisibility(this); return false;">Selengkapnya</a>
                                                </div>
                                                @php
                                                    $resi = DB::table('resi')
                                                        ->where('order_number', $data->order_number)
                                                        ->first();
                                                @endphp

                                                @if($resi)
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
                                                    <p>No matching resi found.</p>
                                                @endif
                                            </div>
                                        </div>




                                    </div>



                                </div>
                            @endforeach
                        @else
                            <h3 class="text-center">orderan belum ada</h3>
                        @endif





                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel" style="margin-left: 120px">
                                            Tambah
                                            Pembayaran</h1>
                                        {{-- <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button> --}}
                                    </div>
                                    <div class="modal-body">
                                        <h6 class="text-center bg-warning mb-4 p-2 rounded">Detail Pembayaran tidak bisa
                                            diganti
                                            atau diubah</h6>
                                        <form>
                                            <div class="d-flex">
                                                <div class="mb-3 me-3">
                                                    <label for="tujuan-pembayaran" class="col-form-label">Tujuan
                                                        Pembayaran</label>
                                                    <select class="form-select custom-input"
                                                        aria-label="Default select example" id="tujuan-pembayaran"
                                                        style="width: 200px">
                                                        <option selected>Pilih Tujuan</option>
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
                                                    <input type="date" class="form-control custom-input"
                                                        id="tanggal-bayar" style="width: 200px">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="jumlah-dana" class="col-form-label">Jumlah Dana</label>
                                                <input type="text" class="form-control custom-input" id="jumlah-dana"
                                                    style="width: 200px">
                                            </div>
                                    </div>
                                    <div class="modal-footer justify-content-start">
                                        <button type="button" id="liveToastBtn" class="btn btn-primary"
                                            onclick="hitungKekurangan()">Simpan</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
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
            <div id="pembayarangagal" class="toast rounded-4" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-body bg-white text-center p-3">
                    <img src="/assets/img/gagal.png" alt="" style="width: 80px; height:80px">
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
