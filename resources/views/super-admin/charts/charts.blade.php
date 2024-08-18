@extends('layouts.mainSA')

@section('css')
    <link rel="stylesheet" href="/assets/css/charts.css">
    <link rel="stylesheet" href="/assets/css/chartsbs5.css">
@endsection

@section('konten')
@if ($status)
    <section class="container-charts rounded mx-4">
        <div class="row justify-content-end mb-4 mt-4 mx-auto"> <!-- Tambahkan div sebagai wadah -->
            <div class="col-lg-2 col-md-10 me-5"> <!-- Tambahkan class col-lg-2 -->
                <select class="form-select justify-content-end rounded-4 border" id="tahun" name="tahun" onchange="window.location.href=this.value;">
                    <option selected disabled>Tahun</option>
                    @foreach ($years as $year)
                        <option value="/super-admin/charts/{{ $year }}">{{ $year }}</option>
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
                    <p class="fs-5 text-end fw-bold text-primary">{{ $totalPendapatan }}</p>
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
                    <p class="fs-5 text-end fw-bold text-primary">{{ $hargaTertinggi }}</p>
                </div>
            </div>
            <div class="card">

                <div id="earning"> {!! $diagram->container() !!}</div>
            </div>
        </article>

        {{-- Chart Penjualan --}}
        {{-- <div class="chart w-100">
            <div class="wadah-chart ">
                <div class="chart-kiri ">
                    <div class="tinggi"></div>
                    <div class="tinggi">0</div>
                    <div class="tinggi">50</div>
                    <div class="tinggi">100</div>
                    <div class="tinggi">150</div>
                    <div class="tinggi">200</div>
                    <div class="tinggi">250</div>
                    <div class="tinggi">300</div>
                    <div class="tinggi">350</div>
                    <div class="tinggi">400</div>
                    <div class="tinggi">450</div>
                    <div class="tinggi">500</div>


                </div>
                <div class="chart-kanan ">
                    <div class="kanan-atas">
                        <div class="background-garis-nilai">
                            <div class="background-garis">
                                <div class="garis-garis"></div>
                                <div class="garis-garis"></div>
                                <div class="garis-garis"></div>
                                <div class="garis-garis"></div>
                                <div class="garis-garis"></div>
                                <div class="garis-garis"></div>
                                <div class="garis-garis"></div>
                                <div class="garis-garis"></div>
                                <div class="garis-garis"></div>
                                <div class="garis-garis"></div>
                                <div class="garis-garis"></div>

                            </div>
                            <div class="nilai-chart row ">
                                <div class="row col12">
                                    <!--jan-->
                                    <div id="januari" class="nilainya justify-content-center col-1"
                                        style="height: 70px">
                                        <div class="bg-primary"></div>
                                    </div>
                                    <!--feb-->
                                    <div id="febuari" class="nilainya justify-content-center col-1"
                                        style="height: 150px">
                                        <div class="bg-primary"></div>
                                    </div>
                                    <!--mart-->
                                    <div id="maret" class="nilainya justify-content-center col-1"
                                        style="height: 300px">
                                        <div class="bg-primary"></div>
                                    </div>
                                    <!--april-->
                                    <div id="april" class="nilainya justify-content-center col-1"
                                        style="height: 100px">
                                        <div class="bg-primary"></div>
                                    </div>
                                    <!--mei-->
                                    <div id="mei" class="nilainya justify-content-center col-1"
                                        style="height: 120px">
                                        <div class="bg-primary"></div>
                                    </div>
                                    <!--juni-->
                                    <div id="juni" class="nilainya justify-content-center col-1"
                                        style="height: 80px">
                                        <div class="bg-primary"></div>
                                    </div>
                                    <!--juli-->
                                    <div id="juli" class="nilainya justify-content-center col-1"
                                        style="height: 80px">
                                        <div class="bg-primary"></div>
                                    </div>
                                    <!--agus-->
                                    <div id="agustus" class="nilainya justify-content-center col-1"
                                        style="height: 240px">
                                        <div class="bg-primary"></div>
                                    </div>
                                    <!--sep-->
                                    <div id="september" class="nilainya justify-content-center col-1"
                                        style="height: 230px">
                                        <div class="bg-primary"></div>
                                    </div>
                                    <!--okt-->
                                    <div id="oktober" class="nilainya justify-content-center col-1"
                                        style="height: 130px">
                                        <div class="bg-primary"></div>
                                    </div>
                                    <!--nov-->
                                    <div id="november" class="nilainya justify-content-center col-1"
                                        style="height: 90px">
                                        <div class="bg-primary"></div>
                                    </div>
                                    <!--dec-->
                                    <div id="desember" class="nilainya justify-content-center col-1"
                                        style="height: 170px">
                                        <div class="bg-primary"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="kanan-bulan row w-100 ">
                        <div class="bulan col-1 d-flex justify-content-center">Jan</div>
                        <div class="bulan col-1 d-flex justify-content-center">Feb</div>
                        <div class="bulan col-1 d-flex justify-content-center">Mar</div>
                        <div class="bulan col-1 d-flex justify-content-center">Apr</div>
                        <div class="bulan col-1 d-flex justify-content-center">Mei</div>
                        <div class="bulan col-1 d-flex justify-content-center">Jun</div>
                        <div class="bulan col-1 d-flex justify-content-center">Jul</div>
                        <div class="bulan col-1 d-flex justify-content-center">Ags</div>
                        <div class="bulan col-1 d-flex justify-content-center">Sep</div>
                        <div class="bulan col-1 d-flex justify-content-center">Okt</div>
                        <div class="bulan col-1 d-flex justify-content-center">Nov</div>
                        <div class="bulan col-1 d-flex justify-content-center">Des</div>

                    </div>

                </div>
            </div>
        </div> --}}


        {{-- </article>


        </article> --}}

        <article class="d-flex flex-wrap gap-2 mt-3 justify-content-evenly mb-5">
            <div class="card col-lg-4 col-md-10 col-sm-10 py-2 px-2 rounded-4 child-card-sa-t">
                <div class="card-body">
                    <h1 class="card-title fs-4">
                        Produk Terlaris
                    </h1>
                    {{-- @foreach ($produkTerlaris as $produk) --}}
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
                    {{-- @endforeach --}}


                </div>
            </div>
            <div class="card col-lg-3 col-md-10 col-sm-10 py-2 px-2 rounded-4 child-card-sa-t">
                <div class="card-body">
                    <h1 class="card-title fs-4">
                        Toko Terlaris
                    </h1>
                    {{-- @foreach ($tokoTerlaris as $toko) --}}

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
                    {{-- @endforeach --}}
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
@section('javascript')
    <script src="/ "></script>
@endsection
