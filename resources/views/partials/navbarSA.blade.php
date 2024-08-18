<link rel="stylesheet" href="{{ asset('assets/css/navbar.css') }}">
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />

  <audio id="myAudio" class="visually-hidden" src="http://localhost/posdjuragan/public/assets/audio/simple-notification-152054.mp3"></audio>



{{-- navbar Super-admin --}}
<nav class="navbar navbar-expand-lg p-0">
    <div class="container-fluid py-3">
        {{-- <button class="btn mx-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar">
            <i class="fa-solid fa-bars text-white fs-5 "></i>
        </button> --}}

        {{-- navbar brand --}}
        {{-- <a href="#" class="navbar-brand ms-3 p-0 text-white d-md-none d-lg-inline ">
            <img src="{{ asset('assets/img/navbrand.png') }}" alt="" height="35px">
        </a> --}}

        {{-- menu dropdown --}}
        <div class="navbar-nav flex-row  me-auto ms-lg-4 gap-2">
            <li class="nav-item">
                <a class="nav-menu nav-link {{ $title === 'halaman utama admin' ? 'active' : '' }} "
                href="{{ route('utamaadmin') }}">Halaman Utama <i class="fa-solid fa-house" style="color: #ffffff;"></i></a>

            </li>


        </div>

        {{-- profile notif --}}
        <div class="d-flex align-items-center me-3 gap-3 position-relative">
            {{-- <button class="btn notif  position-relative" id="notifikasi" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                <i class="fa-regular fa-bell">
                    <span id="notif-qty"
                        class="visually-hidden position-absolute top-0 start-100 translate-middle badge rounded-circle bg-danger fw-light"
                        style="font-size: 10px; font-family: 'Poppins'; " data-count="0">
                        <span class="visually-hidden">unread messages</span>
                    </span>
                </i>
            </button> --}}
            <button class="btn bg-transparent d-flex align-items-center ga" id="logout"
                data-bs-toggle="modal" data-bs-target="#ModalKeluar">
                <span>
                    <svg id="keluar" width="22" height="25" viewBox="0 0 22 25" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M15.2857 1H1V21.125C1 21.8875 1.30102 22.6188 1.83684 23.1579C2.37266 23.6971 3.09938 24 3.85714 24H15.2857M16.7143 16.8125L21 12.5M21 12.5L16.7143 8.1875M21 12.5H6.71429"
                            stroke="#ADB4CB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>
                Logout
            </button>
            <div>
                <i class="fa-solid fa-user fs-5" style="color: #ffffff;"></i>
            </div>
        </div>
    </div>
</nav>


{{-- isi notif pada navbar --}}





{{-- modal keluar --}}

<div class="modal fade" id="ModalKeluar" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content ">
            <div class="my-5">
                <div class="d-flex flex-column justify-content-center ">
                    <img src="{{ asset('assets/img/confirm.png') }}" alt="" width="120px" class="mx-auto">
                    <p class="fw-bolder text-center my-3">Anda yakin ingin keluar dari akun ?</p>
                </div>
                <div class="d-flex justify-content-center gap-3 ">
                    <form action="">
                        <button class="btn btn-grey1 px-4 " data-bs-dismiss="modal">Batal</button>
                    </form>
                    <form action="{{ route('web.logout') }}" method="GET">
                        @csrf
                        <button type="submit" class="btn btn-blue px-4">Keluar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="listNotif">

</div>
<script>
    // Ambil konten dari elemen dengan ID popoverContent
    // var popoverContent = document.getElementById('popoverContent').innerHTML;


    // // Inisialisasi Popover dengan konten dinamis
    // var popover = new bootstrap.Popover(document.getElementById('notifikasi'), {
    //     container: 'body',
    //     placement: 'bottom',
    //     content: popoverContent
    // });
    // // Tambahkan event listener untuk menyesuaikan tampilan saat popover terbuka
    // document.getElementById('notifikasi').addEventListener('shown.bs.popover', function() {
    //     // Hapus kelas 'fa-regular' dan tambahkan kelas 'fa-solid'
    //     document.querySelector('#notifikasi i.fa-regular').classList.remove('fa-regular');
    //     document.querySelector('#notifikasi i').classList.add('fa-solid');
    //     // Tambahkan warna biru
    //     document.getElementById('notifikasi').style.color = '#0091ff';
    //     document.getElementById('notifikasi').style.backgroundColor = 'white';
    //     document.getElementById('notif-qty').style.display = 'none';
    // });

    // // Tambahkan event listener untuk menyesuaikan tampilan saat popover tertutup
    // document.getElementById('notifikasi').addEventListener('hidden.bs.popover', function() {
    //     // Hapus kelas 'fa-solid' dan tambahkan kelas 'fa-regular'
    //     document.querySelector('#notifikasi i.fa-solid').classList.remove('fa-solid');
    //     document.querySelector('#notifikasi i').classList.add('fa-regular');
    //     // Hapus warna biru
    //     document.getElementById('notifikasi').style.color = '#828282';
    //     document.getElementById('notifikasi').style.backgroundColor = '';
    // });
</script>
<script>
    // Event listener for new notifications
    channel.bind('notif-show', function(data) {
        // Memutar audio notifikasi
        const audio = new Audio('http://localhost/posdjuragan/public/assets/audio/simple-notification-152054.mp3');
        audio.play().catch(function(error) {
            console.error("Error playing notification audio: ", error);
        });

        // Update notification badge
        const notifQty = document.querySelector('[data-count]');
        notifQty.classList.remove('visually-hidden');
        let newCount = parseInt(notifQty.textContent) || 0;
        notifQty.textContent = newCount + 1;
        notifQty.style.display = 'block';

        // Create notification item
        const notificationItem = document.createElement('div');
        notificationItem.classList.add('bg-white', 'border-bottom');

        // Timestamp
        const timestamp = document.createElement('small');
        timestamp.textContent = data.data.date;
        notificationItem.appendChild(timestamp);

        // Message
        const message = document.createElement('p');
        message.classList.add('text-primary');
        message.innerHTML = data.data.message; // You can use HTML for formatting
        notificationItem.appendChild(message);

        // Prepend notification item to the list
        const notificationList = document.getElementById('testNotiff');
        notificationList.insertBefore(notificationItem, notificationList.firstChild);

        // Get the last count from localStorage
        const lastCount = parseInt(localStorage.getItem('notifCount')) || 0;

        // Update counter
        newCount = lastCount + 1;
        notifQty.textContent = newCount;

        // Save new count to localStorage
        localStorage.setItem('notifCount', newCount);
    });

    // Event listener for bell click
    document.getElementById('notif-qty').addEventListener('click', function() {
        // Reset counter
        const notifQty = document.querySelector('[data-count]');
        notifQty.textContent = 0;

        // Reset counter in localStorage
        localStorage.setItem('notifCount', 0);
    });
</script>




