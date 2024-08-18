<link rel="stylesheet" href="{{ asset('assets/css/navbar.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

<audio id="myAudio" class="visually-hidden"
    src="http://localhost/posdjuragan/public/assets/audio/simple-notification-152054.mp3"></audio>


{{-- navbar CS --}}
<nav class="navbar navbar-expand-lg p-0">
    <div class="container-fluid py-3">

            <img src="{{ asset('assets/img/navbrand.png') }}" alt="" height="35px">

            <div class="navbar-nav flex-row  me-auto ms-lg-4 gap-2">
                <li class="nav-item">
                    <a class="nav-menu nav-link {{ $title === 'charts' ? 'active' : '' }} "
                    href="{{ route('chartsceo') }}">Chart <i class="fa-solid fa-house" style="color: #ffffff;"></i></a>

                </li>


            </div>

        {{-- profile notif --}}
        <div class="d-flex align-items-center me-3 gap-3 ">
            <button class="btn bg-transparent d-flex align-items-center gap-3 " id="logout"
                data-bs-toggle="modal" data-bs-target="#ModalKeluar">
                <span>
                    <svg id="keluar" width="22" height="25" viewBox="0 0 22 25" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M15.2857 1H1V21.125C1 21.8875 1.30102 22.6188 1.83684 23.1579C2.37266 23.6971 3.09938 24 3.85714 24H15.2857M16.7143 16.8125L21 12.5M21 12.5L16.7143 8.1875M21 12.5H6.71429"
                            stroke="#ADB4CB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>
                Keluar
            </button>
            <div>

                    <img src="{{ asset('bukti_pembayaran/' . $gambar) }}" alt="" width="40" height="40"
                        style="border-radius: 8px;">

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
    // Saluran untuk notifikasi pertama
    const notifChannel = pusher.subscribe('notif');

    // Event listener for new notifications (notif channel)
    notifChannel.bind('notif-show', function(data) {
        // Update notification badge
        const notifQty = document.querySelector('[data-count]');
        notifQty.classList.remove('visually-hidden');
        let newCount = parseInt(notifQty.textContent) || 0;
        notifQty.textContent = newCount + 1;
        notifQty.style.display = 'block';

        // Create notification item
        const notificationItem = document.createElement('div');
        notificationItem.classList.add('bg-white');
        notificationItem.classList.add('border-bottom');

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
        document.getElementById('testNotiff').prepend(notificationItem);

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

<script>
    // Saluran untuk notifikasi kedua
    const posChannel = pusher.subscribe('Pos-Djuragan');

    // Variable to hold the next message to be displayed
    let nextMessageDiv = null;

    // CSS for scrolling animation
    const style = document.createElement('style');
    style.innerHTML = `
        #notifBerjalan {
            position: relative;
        }

        .scrolling-message {
            display: flex;
            flex-basis: auto;
            gap: 50px;
            animation: scroll linear infinite;
        }

        @keyframes scroll {
            from { transform: translateX(100%); }
            to { transform: translateX(-100%); }
        }
    `;
    document.head.appendChild(style);

    // Function to handle message scrolling animation
    function scrollMessage(messageDiv) {
        const container = document.getElementById('notifBerjalan');
        container.appendChild(messageDiv);

        const containerWidth = container.offsetWidth;
        const messageWidth = messageDiv.offsetWidth;
        const animationDuration = (messageWidth + containerWidth) / 80; // Adjust speed as needed

        messageDiv.style.animationDuration = `${animationDuration}s`;

        messageDiv.addEventListener('animationend', function() {
            container.removeChild(messageDiv);
            if (nextMessageDiv) {
                scrollMessage(nextMessageDiv);
                nextMessageDiv = null;
            }
        });
    }

    // Event listener for new notifications (Pos-Djuragan channel)
    posChannel.bind('MyEvent', function(data) {
        console.log('Event MyEvent received:', data.message);

        const newMessageDiv = document.createElement('div');
        newMessageDiv.classList.add('scrolling-message');
        newMessageDiv.style.alignItems = 'center'; // Ensure content alignment
        newMessageDiv.style.width = '100vw';
        newMessageDiv.style.position = 'absolute';

        newMessageDiv.innerHTML = '<i class="fa-solid fa-bullhorn ms-2 me-2"></i>' + data.message;

        if (nextMessageDiv) {
            nextMessageDiv = newMessageDiv;
        } else {
            scrollMessage(newMessageDiv);
        }

        document.getElementById('notifBerjalan').appendChild(newMessageDiv);

        // Play audio if notification is active
        if (data.audioURL) {
            const audio = new Audio(data.audioURL);
            audio.play().catch(error => console.error('Error playing audio:', error));
        }
    });

    // Event listener to toggle notification display
    document.getElementById("notifikasi").addEventListener("click", function() {
        this.classList.toggle("active");
    });
</script>









