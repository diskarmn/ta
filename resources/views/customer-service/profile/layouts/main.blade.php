<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}}</title>
    
    {{-- link online font awesome version 6.4.2 --}}
    <script src="https://kit.fontawesome.com/3aff193c83.js" crossorigin="anonymous"></script>

    {{-- Font Poppins --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">


    {{-- bootsrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
        /* Custom styles for the offcanvas */
        .offcanvas {
            max-width: 20%; /* Set the maximum width according to your preference */
        }
        
        .nav-pills > button.nav-link.active{
            background-color: #647192;
        }
    </style>

    @yield('css')
    
</head>

<body style="background-color: #E3E5E8;">
    {{-- section navbar --}}

    <section>
        {{-- navbar --}}
        @include('customer-service.profile.partials.navbar')
    </section>

    <section>
        {{-- sidebar --}}
        @include('customer-service.profile.partials.sidebar')
    </section>

    {{-- section untuk semua konten --}}
    <section>
        @yield('konten')
    </section>


    {{-- ========================ini bagian script=========================================== --}}
    {{-- script nya bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    {{-- script untuk jquery --}}
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    
    @yield('js')
</body>
</html>
