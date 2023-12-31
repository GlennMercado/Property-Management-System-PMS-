<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Argon Dashboard') }}</title>
    <!-- Favicon -->
    <link href="{{ asset('nvdcpics') }}/nvdc-logo.png" rel="icon" type="image/png">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Extra details for Live View on GitHub Pages -->

    <!-- Icons -->
    <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">

    <!--Bootstrap Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"
        integrity="sha384-xeJqLiuOvjUBq3iGOjvSQSIlwrpqjSHXpduPd6rQpuiM3f5/ijby8pCsnbu5S81n" crossorigin="anonymous">

    <!-- Argon CSS -->
    <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">
    {{-- Pageload --}}
    <link rel="stylesheet" href="{{ asset('css') }}/pageload.css">
    <!--Jquery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body class="{{ $class ?? '' }} bg-white" onload="pageLoadFunction()">

    <div id="preloader-background">
        <img class="img-fluid" id="centre-logo" src="{{ asset('nvdcpics') }}/nvdc-logo.png">
        <div id="circle-loader"></div>
    </div>
    <main style="display:none;" id="pageContent" class="animatePageIn">
        @include('sweetalert::alert')
        @auth()
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @endauth

        <div class="main-content">
            @include('layouts.navbars.guest_navbar')

            @yield('content')
        </div>

        @guest()
            @include('layouts.footers.guest')
        @endguest

        <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

        @stack('js')

        @include('layouts.footers.guest')
    </main>
</body>
<script>
    var pageLoad;

    function pageLoadFunction() {
        pageLoad = setTimeout(showPage, 0);
    }

    function showPage() {
        document.getElementById("preloader-background").style.display = "none";
        document.getElementById("pageContent").style.display = "block";
    }
</script>

</html>
