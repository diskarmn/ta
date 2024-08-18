@extends('layouts.mainCS')

@section('css')
    <link rel="stylesheet" href="/assets/css/charts.css">
    <link rel="stylesheet" href="/assets/css/charts.css">
    <link rel="stylesheet" href="/assets/css/chartsbs5.css">
@endsection

@section('konten')
@if ($status === 'orderan_selesai')
    <section class="container-cs-charts rounded">
        <article class="mx-5 my-5 py-3 rounded-4 shadow border border-2 border-black border-opacity-25 row bg-white">
            <div class="header-cs-charts d-flex flex-wrap justify-content-between gap-2 px-5 py-3">
                <div class="col-lg-5 col-md-4 col-sm-8">
                    <h1 class="title-cs-charts fs-4 fw-semibold m-0 px-3 py-2">Charts Penjualan CS</h1>
                </div>
                <div class="d-flex flex-wrap justify-content-end col-lg-5 col-md-4 col-sm-8 gap-4 align-items-center py-3">
                    <div class="dropdown">
                        <select class="form-select justify-content-end rounded-4 border" id="tahun"
                         name="tahun" onchange="window.location.href=this.value;">
                         <option selected disabled class="bg-dark text-white">{{ $namajuragan }}</option>
                         @foreach ($juragans as $juragan)
                                <option value="/ceo/charts/{{ $juragan }}">{{ $juragan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="card">

                <div id="earning">   {!! $chart->container() !!}</div>
            </div>


        </article>

        <!--ranking-->
        {{-- <article class="mx-5 my-5 p-4 rounded-4 shadow gap-4 row " style="background: #2E3955">
            <div class="pemenang col12 rounded-4 p-4 d-flex justify-content-center flex-row gap-3">
                <h1 class="text-white">PEMENANG </h1>
                @if($bulanTerbanyak)
                <h1 class="text-dark" style="text-shadow: 0 2px 3px black">{{ $bulanTerbanyak }}</h1>
                @else
                <p class="text-dark">belum ada data order terbanyak.</p>
                @endif
            </div>
            <!--leaderboard-->
            <div class="leaderboard-parent col12 p-4 rounded-4 d-flex justify-content-center flex-column gap-3">
                <h1 class="text-center text-light"style="letter-spacing:5px; text-shadow:0 2px 3px black;">
                    <b>LEADERBOARD</b>
                </h1>
                <div class="leaderboard-child col12 rounded-4 d-flex justify-content-center w-100 row p-5">
                    <div class="ranktigabesar row  col-12">
                        <div class="ranktiga col-4 justify-content-center">
                            <div class="anakabsolute d-flex justify-content-center">
                                <img src="https://cdn-icons-png.flaticon.com/128/13601/13601212.png">
                            </div>
                            @if($thirdPlace)
                            <h3 class="text-white text-center">{{ $thirdPlace->name }}</h3>
                            <h4 class=" silver text-center">{{ $thirdPlace->total_barang_terjual }}</h4>
                            <p class="text-white text-center fw-light">{{ $thirdPlace->username }}</p>
                            @else
                            <p class="text-center text-light">belum ada data</p>
                            @endif
                        </div>
                        <div class="ranksatu col-4 justify-content-center">
                            <div class="anakabsolute d-flex justify-content-center">
                                <img src="https://cdn-icons-png.flaticon.com/128/616/616430.png">
                            </div>
                            @if($firstPlace)
                            <h3 class="text-white text-center">{{ $firstPlace->name }}</h3>
                            <h4 class="gold text-center">{{ $firstPlace->total_barang_terjual }}</h4>
                            <p class="text-white text-center fw-light">{{ $firstPlace->username }}</p>
                            @else
                            <p class="text-center text-light">belum ada data</p>
                            @endif
                        </div>
                        <div class="rankdua col-4 justify-content-center">
                            <div class="anakabsolute d-flex justify-content-center">
                                <img src="https://cdn-icons-png.flaticon.com/128/2171/2171991.png">
                            </div>
                            @if($secondPlace)
                            <h3 class="text-white text-center">{{ $secondPlace->name }}</h3>
                            <h4 class="perak text-center">{{ $secondPlace->total_barang_terjual }}</h4>
                            <p class="text-white text-center fw-light">{{ $secondPlace->username }}</p>
                            @else
                            <p class="text-center text-light">belum ada data</p>
                            @endif
                        </div>
                        <!--list-->
                        <div class="daftar d-flex flex-column col-12  justify-content-center bg-white">
                            <div class="isi-daftar-scroll bg-white">
                                <!--isi list-->
                                @php
                                $startNumber = 4;
                            @endphp
                                @foreach ($remainingEmployees as $d)
                                    <div class="my-2 d-flex flex-row justify-content-between row ">
                                        <div class="ulkiri col-4 d-flex flex-row rownjustify-content-around">
                                            <div
                                                class="no col-3 justify-content-lg-center justify-content-md-start d-flex align-items-center ">
                                                <b>{{ $loop->iteration + $startNumber - 1 }}</b>
                                            </div>
                                            <div
                                                class="profil-list col-9 text-center d-flex align-items-center justify-content-around ">
                                                <div class="profil-list-kiri align-items-center">
                                                    <img src="https://cdn-icons-png.flaticon.com/128/10736/10736493.png">
                                                </div>
                                                <div
                                                    class="profil-list-kanan d-flex flex-column justify-content-center align-items-center">
                                                    <div class="nama-profil-list  text-center d-flex align-items-center">
                                                        <b>{{ $d->name }}</b>
                                                    </div>
                                                    <div
                                                        class="username-profil-list  text-center d-flex align-items-center fw-light">
                                                        <p>{{ $d->username }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="ulkanan col-3  d-flex flex-row row justify-content-between">
                                            <div class="poin col-5 justify-content-center d-flex align-items-center">
                                                <b>{{ $d->total_barang_terjual }}</b>
                                            </div>
                                            <div class="ikon col-5 text-center d-flex align-items-center">
                                                <i class="fa-solid fa-up-long" style="color:rgb(38, 218, 38)"></i>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </article> --}}


        @else
        <div class="container-fluid">
            <h3 class="m-auto text-center mt-5">Belum ada order dengan status orderan selesai</h3>
        </div>
    @endif
    </section>
    <footer class="mx-5 rounded-2">
        <div class="footer-cs-charts">
        </div>
    </footer>


    <script>

        document.addEventListener('DOMContentLoaded', function() {
            // const chartContainer = document.getElementById('chartCS');
            const pilihJuragan = document.querySelectorAll('#pilihJuragan + .dropdown-menu a');

            pilihJuragan.forEach(item => {
                item.addEventListener('click', function() {
                    const selectedJuragan = this.getAttribute('data-value');
                    document.getElementById('pilihJuragan').innerText = selectedJuragan;
                    fetchAndRenderChart(selectedJuragan);
                });
            });

            // Inisialisasi dengan juragan pertama saat halaman dimuat
            fetchAndRenderChart(pilihJuragan[0].getAttribute('data-value'));
        });


        //select action
        document.querySelectorAll('.dropdown-menu a').forEach(item => {
            item.addEventListener('click', function() {
                document.getElementById('belum-terkirim').innerText = this.getAttribute('data-value');
            });
        });

        document.querySelectorAll('.dropdown-menu a').forEach(item => {
            item.addEventListener('click', function() {
                document.getElementById('belum-terkirim').innerText = this.getAttribute('data-value');
            });
        });


        // Inisialisasi dengan juragan pertama saat halaman dimuat
    </script>
@endsection
@section('js')
<script src="{{ $chart->cdn() }}"></script>

{{ $chart->script() }}
    {{-- <script src="{{ $diagram->cdn() }}"></script>
    <script src="{{ $donat->cdn() }}"></script>
    {{ $diagram->script() }}
    {{ $donat->script() }} --}}
@endsection
{{-- @section('javascript')
    <script src="/ "></script>
@endsection --}}
