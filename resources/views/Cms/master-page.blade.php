<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('FrontEnd/Image/favicon-mjqjobs-02-01.png') }}">
    <title>@yield('title', 'MJQ Job')</title>

    <!-- Bootstrap 5 cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="{{ asset('plugin/js/notifications/sweetalert2/sweetalert2.bundle.js') }}"></script>
    <link rel="stylesheet" media="screen, print"
        href="{{ asset('plugin/css/notifications/sweetalert2/sweetalert2.bundle.css') }}">
    <!-- Google Font: Kantumruy Pro, Fresca -->
    <link
        href="https://fonts.googleapis.com/css2?family=Fresca&family=Kantumruy+Pro:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">
    <!-- Font Awesome Icones -->
    {{-- <script src="https://kit.fontawesome.com/6cee2a7f00.js" crossorigin="anonymous"></script> --}}
    <script src="{{ asset('FrontEnd/Js/6cee2a7f00.js') }}" crossorigin="anonymous"></script>

    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('FrontEnd/Css/owl carousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('FrontEnd/Css/owl carousel/owl.theme.default.css') }}">
    <!-- Megmific Popup -->
    <link rel="stylesheet" href="{{ asset('FrontEnd/Css/magnific-popup/magnific-popup.css') }}">
    <!-- Animation -->
    <link rel="stylesheet" href="{{ asset('FrontEnd/Css/animate/animate-3.7.2.css') }}">
    <!-- Custom Style -->
    <link rel="stylesheet" href="{{ asset('FrontEnd/Css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('FrontEnd/Css/responsive.css') }}">
    {{-- modal --}}
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> --}}
    <?php
    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: 0');
    ?>
    @yield('style')
</head>

<body>

    @include('Cms.top-menu')
    @yield('content')
    @include('Cms.bottom-menu')


    <!-- JQuery -->
    <script src="{{ asset('FrontEnd/Js/jquery-3.6.0.js') }}" crossorigin="anonymous"></script>
    <!-- Owl Carousel -->
    <script src="{{ asset('FrontEnd/Js/owl carousel/owl.carousel.min.js') }}"></script>
    <!-- Magnific Popup -->
    <script src="{{ asset('FrontEnd/Js/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <!-- Wow js -->
    <script src="{{ asset('FrontEnd/Js/wow-js/wow.min.js') }}"></script>
    <!-- Custom js -->
    <script src="{{ asset('FrontEnd/Js/script.js') }}"></script>
    @yield('script')
</body>

</html>
