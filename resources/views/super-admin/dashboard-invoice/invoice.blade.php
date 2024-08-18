<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    {{-- bootsrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    {{-- font open sans --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    {{-- font poopins --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    {{-- font montserat --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Open+Sans:wght@400;500;600;700&family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    {{-- link online font awesome version 6.4.2 --}}
    <script src="https://kit.fontawesome.com/3aff193c83.js" crossorigin="anonymous"></script>

    {{-- jquery --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="{{ asset('assets/css/invoice.css') }}">


    @yield('css')
</head>


@php
use App\Models\Order;
$orderan = Order::join('barang_order', 'orders.id', '=', 'barang_order.id_order') // Join ke tabel barang_order
    ->join('barangs', 'barang_order.id_produk', '=', 'barangs.id') // Join ke tabel barangs menggunakan barang_order.id_produk
    ->where('orders.order_number', $invoiceNumber)
    ->get();

@endphp

<body>
    <div class="d-flex justify-content-center pt-5">
        <div class="card  shadow " style="max-width: 700px; min-width:595px;">
            <div class="d-flex justify-content-between  px-5 py-4" style="background-color: #F9FAFC;">
                <div class="mx-3">
                    <p class="lh-1 fw-bold" style="font-size: 36px;">INVOICE</p>
                    <p class="fw-medium " style="color: #4C63ED;">Pesanan Juragan</p>
                    <p class="my-2" style="font-size: 10px; color:#B9BBC0;">Alamat</p>
                    <p class="data-invoice">Jalan Karangjambe, Gg. Arjuna No.59 Kec. Banguntapan,<br>
                        Bantul, Daerah Istimewa Yogyakarta <br>
                        55198
                    </p>

                </div>
                <div class="mx-3">
                    <p class="sub-title">No.Invoice</p>
                    <p class="mb-2 fw-medium" style="color: #4C63ED;">{{ $invoiceNumber ?? '' }}</p>
                    <!-- Menggunakan operator ?? untuk mengakses variabel yang mungkin tidak didefinisikan -->
                    <p class="sub-title">Tanggal</p>
                    <p class="data-invoice mb-2">{{ $invoiceDate ?? '' }}</p>
                    <!-- Menggunakan operator ?? untuk mengakses variabel yang mungkin tidak didefinisikan -->
                    <p class="sub-title">Dilayani Oleh</p>
                    @php
                        $employeeName = DB::table('employees')->where('id', $servedBy)->value('name');
                    @endphp
                    {{-- Menampilkan nama karyawan --}}
                    <p class="data-invoice">{{ $employeeName ?? '' }}</p>
                    <!-- Menggunakan operator ?? untuk mengakses variabel yang mungkin tidak didefinisikan -->
                </div>
            </div>
            <div class="px-5 py-5">
                <div class="card">
                    <div class="px-2">
                        <table class="table text-center mb-0">
                            <thead>
                                <tr>
                                    <th class="col">Produk</th>
                                    <th class="col">QTY</th>
                                    <th class="col">Harga</th>
                                    <th class="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $subtotal = 0;
                                @endphp
                                @foreach($orderan as $item)
                                    <tr>
                                        <td>{{ $item->kd_produk}}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>Rp {{ $item->harga_satuan ?? '' }}</td>
                                        <td>Rp {{ $item->quantity * ($item->harga_satuan ?? 0) }} ,00</td>
                                    </tr>
                                    @php
                                    $subtotal = $item->harga_satuan * $item->quantity;
                                    @endphp
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="border-bottom-0 py-3">Subtotal</th>
                                    <td class="border-bottom-0 py-3" colspan="2"></td>
                                    <td class="border-bottom-0 py-3">Rp {{ $subtotal }},00</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="d-flex justify-content-between rounded-bottom-2 border-top px-5 py-2"
                        style="color: #4C63Ed; font-weight:700; background-color: #F9FAFC; font-size:10px;">
                        <p>Total</p>
                        <p>Rp {{ $subtotal }},00</p>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center px-5 py-4"
                style="background-color: #F9FAFC; color: #5E6470; font-size: 10px;">
                <span>www.seven.inc</span>
                <span>
                    @php
                        $employeeName = DB::table('employees')->where('id', $servedBy)->value('name');
                    @endphp
                    <p class="text-decoration-underline text-primary text-center ">{{ $employeeName ?? ''}}</p>
                    @php
                        $employeePhone = DB::table('employees')->where('id', $servedBy)->value('phone_number');
                    @endphp
                    <p>{{ $employeePhone ?? ''}}</p>
                </span>
                <span>seveninc@gmail.com</span>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center my-5">
        <div class="d-flex w-50 justify-content-between px-5 hide-on-print">
            <a href="/superAdmin/riwayat" class="btn px-5 btn-grey">Kembali</a>
            <button class="btn px-5 btn-blue" onclick="printPage()">Print</button>
        </div>
    </div>

</body>
<script>
    function printPage() {
        // Lakukan pencetakan
        window.print();
    }
</script>

</html>
