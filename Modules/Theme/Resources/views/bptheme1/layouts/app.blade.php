<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" >
    <title>@if (trim($__env->yieldContent('title'))) @yield('title') - Beyond Plus CMS @endif Beyond Plus CMS </title>

    <link rel="stylesheet" type="text/css" href="{{ asset("/public/assets/bptheme1/css/app.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("/public/assets/bptheme1/css/main.css") }}">
    
</head>
<body>

    <!-- Header -->

    @include('theme::bptheme1.layouts.header')

    <!-- Sidebar -->
   <!-- @1include('layouts/bptheme1/slider')  -->

    @yield('content')

    <!-- Footer -->
    @include('theme::bptheme1.layouts.footer')


    <!-- REQUIRED JS SCRIPTS -->
    <script src="{{ asset("/public/assets/bptheme1/js/app.js") }}"></script>

    <script src="{{ asset("/public/assets/bptheme1/js/main.js") }}"></script>

    @stack('scripts')
    

</body>
</html>
