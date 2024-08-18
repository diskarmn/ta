@extends('layouts.mainA')

@section('css')
    <link rel="stylesheet" href="/assets/css/charts.css">
@endsection

@section('konten')
@if ($status === 'orderan_selesai')
    <section class="container-charts rounded mx-4">
        <div class="row justify-content-end mb-4 mt-4 mx-auto"> <!-- Tambahkan div sebagai wadah -->
            <div class="col-lg-2 col-md-10 me-5"> <!-- Tambahkan class col-lg-2 -->
                <select class="form-select justify-content-end rounded-4 border" id="tahun" name="tahun" onchange="window.location.href=this.value;">
                    <option selected disabled>Tahun</option>
                    @foreach ($years as $year)
                        <option value="/admin/charts/{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>

            </div>
        </div>

        {{-- Container Card --}}
        <article class="d-flex mx-auto flex-wrap gap-3 mx-1 row justify-content-between card-sa-t col-lg-11 ">
            <div class="card-charts card col-lg-3 py-2 px-2 rounded-4 child-card-sa-t">
                <div class="card-body">
                    <h1 class="card-title fs-4 pb-4">
                        Total Penjualan
                    </h1>
                    <p class="fs-5 text-end fw-bold text-primary">{{ $penjualan['totalPendapatan'] }}</p>
                </div>
            </div>
            <div class="card-charts card col-lg-3 py-2 px-2 rounded-4 child-card-sa-t">
                <div class="card-body">
                    <h1 class="card-title fs-4 pb-4">
                        Total Order
                    </h1>
                    {{-- @foreach ($total as $item) --}}

                    <p class="fs-5 text-end fw-bold text-primary">{{ $total->total_orderan }} pcs</p>
                    {{-- @endforeach --}}
                </div>
            </div>
            <div class="card-charts card col-lg-3 py-2 px-2 rounded-4 child-card-sa-t">
                <div class="card-body">
                    <h1 class="card-title fs-4 pb-4">
                        Penjualan Tertinggi
                    </h1>
                    <p class="fs-5 text-end fw-bold text-primary">{{ $penjualan['hargaTertinggi'] }}</p>
                </div>
            </div>
            <div class="card">

                <div id="earning"> {!! $diagram->container() !!}</div>
            </div>
        </article>

        <article class="d-flex flex-wrap gap-2 mt-3 justify-content-evenly mb-5">
            <div class="card col-lg-4 col-md-10 col-sm-10 py-2 px-2 rounded-4 child-card-sa-t">
                <div class="card-body">
                    <h1 class="card-title fs-4">
                        Produk Terlaris
                    </h1>

                    <p class="fs-6 date-charts"> {{ $produkTerlaris->tanggal_terbaru }} -
                        {{ $produkTerlaris->tanggal_terlama }}</p>

                    <div class="d-flex justify-content-between fw-semibold gap-2">
                        <p>Kode Produk</p>
                        <p>Nama Produk</p>
                        <p>Total</p>
                    </div>
                    <div class="d-flex justify-content-between fw-semibold gap-2">
                        <p>{{ $produkTerlaris->kd_produk }}</p>
                        <p>{{ $produkTerlaris->nama }}</p>
                        <p>{{ $produkTerlaris->total_terjual }}</p>
                    </div>


                </div>
            </div>
            <div class="card col-lg-3 col-md-10 col-sm-10 py-2 px-2 rounded-4 child-card-sa-t">
                <div class="card-body">
                    <h1 class="card-title fs-4">
                        Toko Terlaris
                    </h1>
                    <p class="fs-6 date-charts"> {{ $tokoTerlaris->tanggal_terbaru }} -
                        {{ $tokoTerlaris->tanggal_terlama }}</p>
                    <div class="d-flex justify-content-around fw-semibold">
                        <p>Nama Toko</p>
                        <p>Total</p>
                    </div>
                    <div class="d-flex justify-content-around fw-semibold">
                        <p> {{ $tokoTerlaris->juragan }}</p>
                        <p>{{ $tokoTerlarisTotal->total_penjualan }}</p>
                    </div>
                </div>
            </div>
            <div class="card col-sm-6 col-lg-3 py-2 px-2 rounded-4 child-card-sa-t-delapan">
                <div class="card-body ">
                    {!! $donat->container() !!}
                </div>
            </div>
        </article>
    </section>
    @else
    <div class="container-fluid">
        <h3 class="m-auto text-center mt-5">Belum ada order dengan status orderan selesai</h3>
    </div>
@endif
@endsection

@section('js')
<script>
    document.getElementById('tahun').addEventListener('change', function() {
        document.getElementById('filterForm').submit();
    });
</script>

    <script src="{{ $diagram->cdn() }}"></script>
    <script src="{{ $donat->cdn() }}"></script>
    {{ $diagram->script() }}
    {{ $donat->script() }}
@endsection
