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
    @yield('css')

</head>

<body>
    <div class="" id="requestNotif"></div>
    <div class="notification-container ">
    </div>

    @if (session('success-pembayaran'))
        <div style="position: fixed; z-index: 2; top: 10; left: 0; margin-top: 5%; margin-left: 30%; width: max-content;"
            class="toast-info rounded bg-white" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-body d-flex">
                <div class="d-absolute rounded-start p-2 d-flex align-items-center" style="background-color: yellow">
                    <i style="color: white" class="fa-solid fa-dollar-sign fs-4"></i>
                </div>              
                <div class="my-3 mx-3 d-flex align-items-center">{{ session('success-pembayaran') }}</div>
            </div>
        </div>
    @endif 

    {{-- section navbar --}}
    <section>
        {{-- navbar --}}
        @include('partials.navbarSA')
    </section>

    {{-- section untuk semua konten --}}
    <section>
        @yield('konten')
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', (e) => {
            const toastContainer = document.getElementById('toast-container');
            if(toastContainer){
                const toast = new bootstrap,Toast(toastContainer.querySelector('.toas-info'));
                toast.show();
            }
        });
    </script>
    <script>
        const channelEdit = pusher.subscribe('requestEdit'); // Added new channel for accept

        const notificationContainer = document.querySelector('.notification-container');

        channelEdit.bind('eventEdit', function(data) {
            const newToast = `
            <div style="position: fixed; z-index: 2; top: 10; left: 0; margin-top: 5%; margin-left: 30%; width: max-content;"
                class="toast-info rounded bg-white" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-body d-flex">
                    <div class="d-absolute rounded-start p-2 d-flex align-items-center" style="background-color: blue">
                        <i style="color: white" class="fa-solid fa-file-pen fs-4"></i>
                    </div>
                    <div class="my-3 mx-3 d-flex align-items-center">${data.message}</div>
                </div>
            </div>
            `;
            console.log(data.message);
            notificationContainer.insertAdjacentHTML('beforeend', newToast);

            const toastEl = notificationContainer.lastElementChild;
            const toast = new bootstrap.Toast(toastEl);
            toast.show();
        });
    </script>
    @yield('js')
</body>

</html>
