

{{-- navbar CS --}}
<nav class="navbar navbar-expand-lg p-0" style=" background-color: #202B46; max-width: 100%;">
    <div class="container-fluid" style="padding: 12px 32px 12px 32px;">
        <div>
            <button class="btn ms-2" style="background-color: #202B46; " type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <i class="fa-solid fa-bars text-white" style="font-size: 20px;" ></i>
            </button>

            {{-- brand + menambahkan responsive display --}}
            <a href="#" class="navbar-brand ms-3 text-white" >
                <img src="{{ asset ('') }}assets/img/navbrand.png" class="img-fluid" alt="" style="height: 40px;">
            </a>
        </div>


        {{-- {{ ($title === "Charts") ? 'active' }} --}}

        {{-- menu dropdown --}}
        <div class="navbar-nav flex-row  me-auto mx-3 mb-2 mb-lg-0">
            <li class="nav-item" style="color:#828282; font-family: 'Poppins'; font-size:16px;">
                <a class="nav-link rounded" style="color:#828282;" href="/cs/semua-orderan">Dashboard</a>
            </li>
            <li class="nav-item mx-3">
                <a class="nav-link rounded" style="color:#828282; font-size:16px;" href="/cs/tulis-orderan">Tulis Orderan</a>
            </li>
            <li class="nav-item">
                <a id="charts" class="nav-link rounded" style="color:#828282; font-size:16px;"  href="/charts">Charts</a>
            </li>
        </div>

        {{-- profile notif --}}
        <div class="d-flex align-items-center me-3" >
            <button class="btn" id="" type="button" style="background-color: #202B46; border:none;" >
                <i class="fa-regular fa-bell position-relative me-2 " style="color:#828282; font-size:20px;">
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-circle bg-danger fw-light" style="font-size: 10px; font-family: 'Poppins'; ">
                        3<span class="visually-hidden">unread messages</span>
                    </span>
                </i>
            </button>
            <div>
                <img src="{{ asset('') }}assets/img/Avatar-image.png" alt="mdo" width="40" height="40" style="border-radius: 8px;" >
            </div>
        </div>
    </div>
</nav>

