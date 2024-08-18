@extends('layouts.mainCS')

@section('css')
    <link rel="stylesheet" href="/assets/css/charts.css">
    <link rel="stylesheet" href="/assets/css/chartsbs5.css">
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"> --}}

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
                        <select class="form-select justify-content-end rounded-4 border" id="tahun" name="tahun"
                            onchange="window.location.href=this.value;">
                            <option selected disabled class="bg-dark text-white">Pilih Juragan</option>
                            @foreach ($juragans as $juragan)
                                <option value="/ceo/charts/{{ $juragan }}">{{ $juragan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="card">

                <div id="earning"> {!! $chart->container() !!}</div>
            </div>

        </article>





    </section>
    @else
    <div class="container-fluid">
        <h3 class="m-auto text-center mt-5">Belum ada order dengan status orderan selesai</h3>
    </div>
@endif
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

</script>
    <script>
        var months = ['JANUARI', 'FEBRUARI', 'MARET', 'APRIL', 'MEI', 'JUNI', 'JULI', 'AGUSTUS', 'SEPTEMBER', 'OKTOBER',
            'NOVEMBER', 'DESEMBER'
        ];
        var month = months[new Date().getMonth()];
        document.getElementById('bulan').textContent = month;
    </script>
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
