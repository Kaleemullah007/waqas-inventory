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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js" defer></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/switch/js/switch.min.js') }}" defer></script>
    <script src="{{ asset('assets/libs/select2/dist/js/select2.full.min.js') }}" defer></script>
    <script src="{{ asset('assets/libs/custom/js/custom.js') }}" defer></script>
    <script src="{{ asset('assets/libs/chart/apexcharts/apexcharts.min.js') }}" defer></script>
    <script src="{{ asset('assets/libs/chart/chart.js') }}" defer></script>
    <script src="{{ asset('assets/libs/datatable/datatables.min.js') }}" defer></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" defer></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <style>
        .btn-primary {
    --bs-btn-color: #fff;
    --bs-btn-bg: rgb(177,8,60) !important;
    --bs-btn-border-color: rgb(177,8,60) !important;
    --bs-btn-hover-color: #fff;
    --bs-btn-hover-bg: rgb(200, 24, 77) !important;
    --bs-btn-hover-border-color:rgb(143, 37, 69) !important;
    --bs-btn-focus-shadow-rgb: 49, 132, 253;
    --bs-btn-active-color: #fff;
    --bs-btn-active-bg: rgb(219, 42, 95) !important;
    --bs-btn-active-border-color: rgb(224, 65, 113) !important;
    --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
    --bs-btn-disabled-color: #fff;
    --bs-btn-disabled-bg: rgb(177,8,60) !important;
    --bs-btn-disabled-border-color: rgb(177,8,60) !important;
}
.pagination {
    --bs-pagination-padding-x: 0.75rem;
    --bs-pagination-padding-y: 0.375rem;
    --bs-pagination-font-size: 1rem;
    --bs-pagination-color: rgb(245, 112, 152) !important;
    --bs-pagination-bg: #fff;
    --bs-pagination-border-width: 1px;
    --bs-pagination-border-color:rgb(247, 188, 205) !important;;
    --bs-pagination-border-radius: 0.375rem;
    --bs-pagination-hover-color: rgb(131, 43, 70) !important;
    --bs-pagination-hover-bg: #e9ecef;
    --bs-pagination-hover-border-color: #f42323;
    --bs-pagination-focus-color: rgb(135, 1, 41) !important;
    --bs-pagination-focus-bg: #e9ecef;
    --bs-pagination-focus-box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    --bs-pagination-active-color: #fff;
    --bs-pagination-active-bg:rgb(247, 7, 79) !important;
    --bs-pagination-active-border-color:rgb(212, 1, 64) !important;
    --bs-pagination-disabled-color: #1a0601;
    --bs-pagination-disabled-bg: #fff;
    --bs-pagination-disabled-border-color: #dee2e6;
    display: flex
;
    padding-left: 0;
    list-style: none;
}
    </style>
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
<script>
    $(".delete").click(function(e){
      e.preventDefault();
      action= $(this).closest("form").attr('action');
      id = this.id;

swal({
  title: "Are you sure?",
  text: "You will not be able to recover this data!",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes, delete it!",
  closeOnConfirm: false
}).then(isConfirmed => {
if(isConfirmed) {

    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'DELETE', // Just delete Latter Capital Is Working Fine
            dataType: "JSON",
            url: action,
            data:{'action':'delete'},
            success: function(data) {
                if(data.error == true){
                    swal("Deleted!", "Your Product has been deleted.", "success");
                }
                else{
                    swal("Deleted!", "Invalid Product.", "danger");
                }
                $("#record"+id).remove();



            },
            error:function(){
                swal("Deleted!", "Invalid Product.", "danger");
            }
        });



//   window.location.href =action
}
});
});
</script>
<script src="{{ asset('js/app.js') }}" defer></script>
@yield('script')
</html>
