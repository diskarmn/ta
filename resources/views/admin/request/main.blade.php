@extends('layouts.mainA')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/request.css') }}">
@endsection

@php
    use App\Models\Order;
@endphp

@section('konten')
    <div class="container-fluid p-4">

        {{-- header --}}
        <header class="col-lg-5">
            <ul class="nav nav-pills mb-4 gap-4">
                <li class="nav-item btn-req">
                    <button class="btn btn-sm btn-outline-dark rounded-pill px-3 active" id="btn-belum">Belum Selesai</button>
                </li>
                <li class="nav-item btn-req">
                    <button class="btn btn-sm btn-outline-dark  rounded-pill px-3" id="btn-selesai">Selesai</button>
                </li>

            </ul>
        </header>

        <div>

            {{-- belum selesai --}}

            <div class="card col-lg-12 " id="belum" style="display: flex;">
                @if ($requests)
                    <div class="card-header d-flex justify-content-end py-3 small" onclick="removeUnreadClass()">
                        <p style="cursor: pointer;">Tandai sebagai sudah dibaca</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach ($requests as $request)
                            <li class="list-group-item unread d-flex justify-content-between align-items-center"
                                id="request{{ $loop->index + 1 }}">
                                <img src="{{ asset('assets/img/logo-file.png') }}" height="40px" alt="">
                                <div class="flex-column flex-fill px-3">
                                    <div>Request Edit Orderan dengan no Pesanan {{ $request->order->order_number }}</div>
                                    <div class="info-req">
                                        <p>[{{ $request->order->juragan }}]</p>
                                        <p>{{ $request->created_at->format('d-m-Y H:i') }}</p>
                                    </div>
                                </div>
                                <a href="{{ route('admin.request.detail', ['order_number' => $request->order->order_number]) }}"
                                    class="btn btn-blue btn-sm border-0 py-1 px-3" style="font-size: 14px;">Detail</a>
                            </li>
                    </ul>
            </div>
            @endforeach
        @else
            <p class="text-center py-2">belum ada</p>
            @endif
        </div>
        {{-- selesai --}}
        <div class="card" id="selesai" style="display: none;">
            <div class=" col-lg-12">
                @if ($status)
                    <ul class="list-group list-group-flush">
                        @foreach ($status as $data)
                            <li class="list-group-item unread d-flex justify-content-between align-items-center"
                                id="request{{ $loop->index + 1 }}">
                                <img src="{{ asset('assets/img/logo-file.png') }}" height="40px" alt="">
                                <div class="flex-column flex-fill px-3">
                                    <div>Request Edit Orderan dengan no Pesanan {{ $data->order_number }}</div>
                                    <div class="info-req">
                                        <p>[{{ $data->juragan }}]</p>
                                        <p>{{ $data->created_at->format('d-m-Y H:i') }}</p>
                                    </div>
                                </div>

                                @if ($data->selesai === 'ditolak')
                                    <p class="btn btn-danger btn-sm border-0 py-1 px-3" style="font-size: 14px;">ditolak</p>
                                @elseif ($data->selesai === 'diterima')
                                    <p class="btn btn-blue btn-sm border-0 py-1 px-3" style="font-size: 14px;">diterima</p>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-center">belum ada</p>
                @endif
            </div>
        </div>


    </div>

    <!-- Modal request detail -->
    <div class="modal fade" id="modalRequest" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            @isset($order)
                <div class="modal-content ">
                    <div class="modal-header m-4 p-0  d-flex justify-content-between align-items-start border-bottom-0 ">
                        <div class="flex-fill  col-xl-3 d-flex justify-content-start p-0">
                            <div class="idProduct d-flex flex-column">
                                <p class="text-uppercase px-2 py-3 order-number" style="font-family: Montserrat;">
                                    #{{ $order->order_number }}</p>
                                <p class="idlogin" style="font-size:40%;">{{ $userid }}</p>
                            </div>
                        </div>
                        <div class="flex-fill  col-xl-2  flex-column p-0">
                            <div class="headReq">
                                @php
                                    $orderan = Order::where('order_number', $order->order_number)->get();
                                    $juragan = Order::leftJoin('juragans', 'orders.juragan', '=', 'juragans.id')
                                        ->where('orders.order_number', $order->order_number)
                                        ->select('juragans.name_juragan')
                                        ->get();
                                @endphp
                                <p class="text-capitalize order-date" style="font-family: Montserrat;margin-bottom:12px;">
                                    {{ $order->order_date }}</p>
                                <p class="text-capitalize juragan" style="font-family: Montserrat;">{{ $order->juragan }}</p>
                                <p class="text-capitalize namejuragan" style="font-family: Montserrat;">
                                    <b>{{ $juragan[0]->name_juragan }}</b></p>
                                {{-- <p class="text-capitalize name-juragan" style="font-family: Montserrat;">{{ $order->juragan->name_juragan }}</p> --}}
                            </div>
                        </div>
                        <div class="flex-fill  col-xl-4  flex-column p-0 ps-5">
                            <div class="headReq">
                                <p style="font-family: Montserrat; margin-bottom:12px;">Asal Orderan</p>
                                <p class="text-uppercase asal-order fw-bolder source">{{ $order->source }}</p>
                            </div>
                        </div>
                        <div class="flex-fill  col-xl-2  flex-column p-0 ps-3">
                            <div class="headReq ">
                                <p style="font-family: Montserrat; margin-bottom:12px;">Dilayani</p>

                                <p class="fw-bolder dilayani" style="font-family: Open Sans; color:#4D4D4D;">
                                    {{ $order->employee->name }}</p>
                                <p class="fw-bolder iddilayani" style="font-family: Open Sans; color:#4D4D4D;">
                                    {{ $order->employee->id }}</p>
                            </div>
                        </div>
                        <div class="d-flex flex-fill col-xl-1">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                    <div class="modal-body px-0 mx-4 mb-4 p-0">
                        <div class="d-flex row">
                            <div class="col-9">
                                <div class="d-flex flex-row mb-3">
                                    <div class="col-lg-4 flex-column">
                                        <div class="titleBody">Data Pelanggan
                                        </div>
                                        <div class="content ps-2 mt-2">
                                            <p class="text-capitalize fw-bold cs-name">{{ $customer->name }}</p>
                                            <p class="text-capitalize fw-bold cs-id">{{ $customer->id }}</p>
                                            <p style="font-weight: 600;" class="cs-p1">{{ $customer->phone }}</p>
                                            <p style="font-weight: 600;" class="cs-p2">{{ $customer->phone2 }}</p>
                                        </div>
                                    </div>
                                    <div class="flex-column flex-fill ">
                                        <div class="titleBody">Biaya Ongkir
                                        </div>
                                        <div class="content ps-2 mt-2">
                                            <p class="fw-bold ">JNE Reguler</p>
                                            <p>Rp. 18.000,00</p>
                                        </div>
                                    </div>
                                    @php
                                        // $orderan = Order::where('order_number', $order->order_number)->get();
                                        $orderan = DB::table('barang_order')
                                        ->join('barangs', 'barang_order.id_produk', '=', 'barangs.id')
                                        ->where('barang_order.order_number', $order->order_number)
                                        ->select('barang_order.*', 'barangs.nama as produk_nama', DB::raw('SUM(barang_order.subtotal) as total_subtotal'))
                                        ->groupBy('barang_order.order_number', 'barang_order.id', 'barang_order.id_produk', 'barang_order.order_number', 'barang_order.quantity', 'barangs.harga_satuan', 'barang_order.subtotal', 'barang_order.created_at', 'barang_order.updated_at', 'barangs.nama')
                                        ->get();
                                    @endphp

                                    <div class="flex-column flex-fill">
                                        <div class="titleBody">Data Order</div>

                                        <div class="excontent mt-2">
                                            @foreach ($orderan as $ord)
                                                <div class="small mb-2">
                                                    <p>Kode Produk: {{ $ord->produk_nama }}</p>
                                                    <p>Quantity: {{ $ord->quantity }}</p>
                                                    <p>Total: Rp. {{ $ord->subtotal }} ,00</p>
                                                    <p>Size: {{ $ord->size }}</p>

                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-row mb-3">
                                    <div class="col-lg-4 flex-column">
                                        <div class="titleBody">Detail Alamat
                                        </div>
                                        <div class="content ps-2 mt-2 ">
                                            <p class="alamat address">{{ $customer->address }}</p>
                                            <div class="alamat-detail">
                                                <p class="kecamatan">{{ $customer->kecamatan }}</p>
                                                <p class="kabupaten">{{ $customer->kabupaten }}</p>
                                                <p class="provinsi">{{ $customer->provinsi }}</p>
                                                <p class="kodepos">{{ $customer->kodepos }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-column">
                                        <div class="titleBody">Biaya Lainnya
                                        </div>
                                        <div class="content ps-2 mt-2">
                                            <p class="fw-bold ">Biaya packing</p>
                                            <p>Rp. 18.000,00</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="flex-column col-3">
                                <div class="titleBody">Keterangan</div>
                                <div class="Keterangan p-0 mt-2 notes" id="keterangan">{{ $order->notes }}
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="flex-grow-1 overflow-hidden" style="color:#006AB7;"
                                        id="dot">......................................</span>
                                    <span class="expand" id="selengkapnya" onclick="expandKeterangan()"> Selengkapnya</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="m-0">
                    <!-- Bagian Tampilan untuk Menampilkan Detail Permintaan -->
                    <div class="modal-footer d-flex row justify-content-start gap-2 border-top-0 m-4 p-0">
                        <div class="d-flex justify-content-between m-0 align-items-center p-0">
                            <p class="fw-bolder" style="font-size: 18px; font-family:montserrat;">REQUEST</p>
                            <p style="font-family: montserrat">{{ $request->created_at }}</p>
                        </div>
                        <div class="ps-3 m-0" id="request-edit">
                            <p>{{ $request->detail }}</p>
                        </div>
                        <div class="d-flex gap-3 justify-content-end p-0 m-0">
                            <form action="{{ route('admin.requestEdit.ditolak', $order->order_number) }}"
                                method="POST">
                                @csrf
                                <button type="submit" class="btn btn-red border-0  py-2 px-5" style="font-size:18px; "
                                    data-bs-dismiss="modal" onclick="handleDenied()">Ditolak</button>
                            </form>
                            <form action="{{ route('admin.requestEdit.kerequest', $order->order_number) }}"
                                method="POST">
                                @csrf
                                <button type="submit" class="border border-none bg-none "> <a onclick="localsave()"
                                        class="btn btn-blue border-0 py-2 px-5" style="font-size:18px;">Diterima</a></button>
                            </form>
                        </div>
                    </div>
                @endisset
            </div>
        </div>








    </div>
@endsection


@section('js')
    <script>
        document.querySelector('#btn-belum').addEventListener('click', function() {
            document.getElementById('belum').style.display = 'flex';
            document.getElementById('selesai').style.display = 'none';
            this.classList.add('active');
            document.querySelector('#btn-selesai').classList.remove('active');
        });

        document.querySelector('#btn-selesai').addEventListener('click', function() {
            document.getElementById('belum').style.display = 'none';
            document.getElementById('selesai').style.display = 'flex';
            this.classList.add('active');
            document.querySelector('#btn-belum').classList.remove('active');
        });

        function localsave() {
            var idlogin = document.querySelector('.idlogin').innerText;
            var ordernumber = document.querySelector('.order-number').innerText.replace('#', '');
            localStorage.setItem('rordernumber_' + idlogin, ordernumber);

            var orderdate = document.querySelector('.order-date').innerText;
            localStorage.setItem('rorderdate_' + idlogin, orderdate);


            var juragan = document.querySelector('.juragan').innerText;
            localStorage.setItem('rjuragan_' + idlogin, juragan);

            var namejuragan = document.querySelector('.namejuragan').innerText;
            localStorage.setItem('rnamejuragan_' + idlogin, namejuragan);

            var source = document.querySelector('.source').innerText;
            localStorage.setItem('rsource_' + idlogin, source);

            var dilayani = document.querySelector('.dilayani').innerText;
            localStorage.setItem('rdilayani_' + idlogin, dilayani);

            var iddilayani = document.querySelector('.iddilayani').innerText;
            localStorage.setItem('riddilayani_' + idlogin, iddilayani);

            var csname = document.querySelector('.cs-name').innerText;
            localStorage.setItem('rcsname_' + idlogin, csname);

            var csid = document.querySelector('.cs-id').innerText;
            localStorage.setItem('rcsid_' + idlogin, csid);

            var notes = document.querySelector('.notes').innerText;
            localStorage.setItem('rnotes_' + idlogin, notes);
            // var csp1 = document.querySelector('.cs-p1').innerText;
            // localStorage.setItem('csp1_' + idlogin, csp1);

            // var csp2 = document.querySelector('.cs-p2').innerText;
            // localStorage.setItem('csp2_' + idlogin, csp2);

            // var address = document.querySelector('.address').innerText;
            // localStorage.setItem('address_' + idlogin, address);

            // var kecamatan = document.querySelector('.kecamatan').innerText;
            // localStorage.setItem('kecamatan_' + idlogin, kecamatan);

            // var kabupaten = document.querySelector('.kabupaten').innerText;
            // localStorage.setItem('kabupaten_' + idlogin, kabupaten);

            // var provinsi = document.querySelector('.provinsi').innerText;
            // localStorage.setItem('provinsi_' + idlogin, provinsi);

            // var kodepos = document.querySelector('.kodepos').innerText;
            // localStorage.setItem('kodepos_' + idlogin, kodepos);


        }
    </script>
    <script src="{{ asset('assets/js/request.js') }}"></script>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @isset($order)
        <script>
            $(function() {
                $('#modalRequest').modal('show');
            });
        </script>
    @endisset
    <script>
        // Fungsi untuk menangani tautan yang memicu modal
        function handleModal(orderNumber) {
            // Bangun URL modal dengan menambahkan nomor pesanan
            var modalUrl = '/admin/request/' + orderNumber + '/detail';

            // Navigasi ke URL modal
            window.location.href = modalUrl;
        }
    </script>
@endsection
