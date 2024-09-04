{{-- @extends('layouts.mainSA') --}}
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


    {{-- font montserat &poopins --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&family=Open+Sans:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700;800&display=swap"
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
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        // Konfigurasikan Pusher
        var pusher = new Pusher('c892b96d1a2cd2314dba', {
            cluster: 'ap1'
        });

        // Subscribe ke channel notifikasi
        var channel = pusher.subscribe('notif');
    </script>
    <link rel="stylesheet" href="{{ asset('assets/css/data-cs-superadmin.css') }}">
</head><body>
    <div class="container-fluid content-add p-4">
        <header>
            <div class="d-flex flex-column gap-4 p-5 ">
                <a href="/" class="text-white fs-5"><i class="fa-solid fa-backward" style="color: #ffffff;"></i> Halaman Login</a>
                <h2 class="mb-0 fw-bold ">Register Customer Service</h2>

            </div>
        </header>
        <main class="bg-white ">
            <div class="p-5">
                <div class="mb-5">
                    <h5 class="fw-bolder mb-0">Informasi Personal</h5>
                    <div style="font-size: 12px;">Berisi data pribadi dari Customer Service yang akan didaftarkan</div>
                </div>
                <form action="{{ route('regiscs') }}" method="POST"  enctype="multipart/form-data"
                class="needs-validation" id="tambahForm" novalidate>
                   @csrf
                   <div class="col m-0 input-container d-none">
                       <label for="idadmin" class="form-label custom-label">Id Customer Service</label>
                       <input type="text" id="idadmin" class="form-control custom-input">
                   </div>
                   <div class="row mb-5">
                       <div class="col m-0 input-container">
                           <label for="nama" class="form-label custom-label">Nama</label>
                           <input type="text" id="nama" class="form-control custom-input"
                               placeholder="Tuliskan nama disini" name="name" required>
                       </div>
                       <div class="col m-0 input-container ">
                           <label for="hp" class="form-label custom-label">Nomor Handphone</label>
                           <input type="tel" maxlength="13" minlength="11" id="hp"
                               class="form-control custom-input" placeholder="Tuliskan nomor handphone disini"
                               oninput="this.value = this.value.replace(/\D/g, '')" name="phone_number" required>
                       </div>
                   </div>
                   <div class="row mb-5">
                       <div class="col m-0 input-container ">
                           <label for="email" class="form-label custom-label">Email</label>
                           <input type="email" id="email" class="form-control custom-input"
                               placeholder="Tuliskan email disini (@)" name="email" required>
                       </div>
                       <div class="col m-0 d-flex flex-row gap-2 input-container ">
                           <div class="col">
                               <label for="password" class="form-label custom-label">Password</label>
                               <input type="password" class="form-control custom-input rounded"
                                   placeholder="Min 8 char (e.g. Ab#123)" id="password" name="password" required>
                           </div>
                           <div class="col-lg-1">
                               <button class="btn btn-hides rounded py-3 d-flex align-items-center"
                                   style="box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.25);" type="button" id="showPassword"><i
                                       class="fa-regular fa-eye text-muted m-0 p-0 "></i></button>
                           </div>
                       </div>
                   </div>
                   <div class="col m-0 d-flex flex-row gap-2 input-container ">
                       <div class="mb-3 col-6">
                           <label for="gender" class="form-label">Gender</label>
                           <select class="form-select" id="gender" name="gender" required>
                               <option value="" selected>Pilih Gender</option>
                               <option value="male">Male</option>
                               <option value="female">Female</option>
                           </select>
                       </div>
                       <div class="mb-3 col-6">
                           <label for="juragan" class="form-label">Juragan</label>
                               @php
                               use Illuminate\Support\Facades\DB;

                               $juragans = DB::table('juragans')->get();
                           @endphp
                           <select class="form-select" id="juragan" name="juragan_id">
                               <option value="" selected>Pilih Juragan</option>
                               @foreach ($juragans as $juragan)
                                   <option value="{{ $juragan->id }}">{{ $juragan->name_juragan }}</option>
                               @endforeach
                           </select>
                       </div>

                   </div>
                   <div class="mb-3">
                       <label for="gambar" class="col-form-label">Unggah Foto Customer Service</label>
                       <input type="file" class="form-control custom-input" id="gambar"
                           name="gambar" style="width: 200px">
                   </div>
                   <div class="d-flex flex-row gap-3 justify-content-end ">
                       <a href="/admin/data-cs" class="btn fw-bold px-4 py-2 btn-btl">Batal</a>
                       <button type="submit" class="btn fw-bold btn-dark px-4 py-2 btn-sv">Simpan</button>
                   </div>
               </form>
            </div>

        </main>
    </div>

    {{-- sukses modal tambah --}}
    <div class="modal fade" id="suksesModal" tabindex="-1" role="dialog" data-bs-backdrop="false">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body py-4">
                    <div class="d-flex flex-row  justify-content-evenly align-items-center ">
                        <img src="{{ asset('assets/img/sukses.png') }}" alt="" width="55px">
                        <p class="fw-bolder text-center m-0">Data <span class="text-success ">Berhasil</span> ditambah!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- gagal Modal tambah -->
    <div class="modal fade" id="erorModal" tabindex="-1" role="dialog" data-bs-backdrop="false">
        <div class="modal-dialog modal-sm " role="document">
            <div class="modal-content ">
                <div class="modal-body px-0">
                    <div class="d-flex flex-row  justify-content-evenly align-items-center  ">
                        <img src="{{ asset('assets/img/gagal.png') }}" alt="" height="55px" class="my-2">
                        <div class="d-flex flex-column ">
                            <p class="fw-bold text-start m-0">Data <span class="text-danger">Gagal</span> ditambah!</p>
                            <span class="text-danger text-center d-block small">Eror : message!!</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>




</body>
</html>
