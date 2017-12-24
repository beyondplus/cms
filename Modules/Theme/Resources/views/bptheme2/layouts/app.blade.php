<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" >
    <title>@if (trim($__env->yieldContent('title'))) @yield('title') - Beyond Plus CMS @endif Beyond Plus CMS </title>

    <link rel="stylesheet" type="text/css" href="{{ asset("/public/assets/bptheme2/css/app.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("/public/assets/bptheme2/css/main.css") }}">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset("/public/js/jssor.slider-22.0.15.min.js") }}" data-library="jssor.slider"></script>


</head>
<body>

    <!-- Header -->

    @include('theme::bptheme2.layouts.header')

    <!-- Sidebar -->
   <!-- @1include('layouts/bptheme2/slider')  -->

    @yield('content')

    <!-- Footer -->
    @include('theme::bptheme2.layouts.footer')


    <!-- REQUIRED JS SCRIPTS -->
   {{--  <script src="{{ asset("/public/assets/bptheme2/js/app.js") }}"></script> --}}

    <script src="{{ asset("/public/assets/bptheme2/js/main.js") }}"></script>

    @stack('scripts')
    

</body>
</html>
