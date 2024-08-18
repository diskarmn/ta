{{-- @extends('halaman-sebelum-login.layouts.main') --}}

@section('css')
    {{-- link local untuk css pada section fitur carousel slide nya --}}
    {{-- <link rel="stylesheet" type="text/css" href="/assets/css/halaman-sebelum-login/fitur-slide-carousel/owl.carousel.min.css"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="/assets/css/halaman-sebelum-login/fitur-slide-carousel/style.css"> --}}

    {{-- link local untuk css custom halaman ini --}}
    {{-- <link rel="stylesheet" href="assets/css/halaman-sebelum-login/beranda.css"> --}}
@endsection

@section('konten')
    {{-- div ini pembungkus semua bagian konten --}}
    <div class="konten container container-fluid mt-4">
        {{-- section jumbotron page ini --}}

        <section class="bg-white p-2 rounded">
            {{-- jumbotron 1 --}}
            <div class="row">
                <div class="col-lg-8 mb-2" >
                    <div class="jumbotron1 container">
                        <h3 style="color: #4D4D4D; font-weight: 700">Mau Cari Homestay atau Guesthouse</h3>
                        <h3 style="color: #4D4D4D; font-weight: 700">murah di semua tempat?</h3>
                        <h6 style="color: #4D4D4D">Dapatkan infonya dan langsung sewa di homestay.</h6>
                    </div>

                    {{-- input form search something --}}
                    <form class="d-flex mt-4" role="search">
                        <input class="form-control input-field" type="search"
                            placeholder="Masukan nama lokasi/alamat/area" aria-label="Search"
                            style="border-radius: 5px 0 0 5px" id="input-cari-beranda">
                        <button class="btn btn-outline-success bg-danger text-white ps-4 pe-4" type="submit"
                            style="border-radius: 0 5px 5px 0" id="button-cari">Cari</button>
                    </form>
                </div>
                <div class="col-lg-4 mb-2">
                    <img src="assets/img/roket-orang.png" style="width: 90%; margin: auto; display: block;">
                </div>
            </div>
        </section>

        {{-- section carousel page ini --}}


    </div>
@endsection
