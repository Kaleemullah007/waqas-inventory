<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Matrix lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Matrix admin lite design, Matrix admin lite dashboard bootstrap 5 dashboard template" />
    <meta name="description"
        content="Matrix Admin Lite Free Version is powerful and clean admin dashboard template, inpired from Bootstrap Framework" />
    <meta name="robots" content="noindex,nofollow" />

    <title>@yield('title','Admin panel')</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}" defer></script>
    <script src="{{ asset('assets/libs/switch/js/switch.min.js') }}" defer></script>
    <script src="{{ asset('assets/libs/select2/dist/js/select2.full.min.js') }}" defer></script>
    <script src="{{ asset('assets/libs/custom/js/custom.js') }}" defer></script>
    <script src="{{ asset('assets/libs/chart/apexcharts/apexcharts.min.js') }}" defer></script>
    <script src="{{ asset('assets/libs/chart/chart.js') }}" defer></script>
    <script src="{{ asset('assets/libs/datatable/datatables.min.js') }}" defer></script>


    <!-- Styles -->
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/switch/css/switch.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/custom/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/custom/css/sass.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/custom/css/custom2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/custom/css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/custom/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/chart/apexcharts/apexcharts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/datatable/datatables.min.css') }}">







    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
</head>

<body>
    <div id="app">


        @include('layouts.navbar')
        @include('layouts.sidebar')




        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
