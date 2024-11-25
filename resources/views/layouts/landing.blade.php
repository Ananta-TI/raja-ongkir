<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title','landing page')</title>
    <link rel="shortcut icon" href="{{ asset('dist/assets/images/favicon.ico') }}">

    <link rel="stylesheet" href="{{ asset('dist/assets/libs/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('dist/assets/libs/aos/aos.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('dist/assets/css/style.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('dist/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
    @include('components.navbar')
    @yield('content')
    @include('components.footer')

    <script src="{{ asset('dist/assets/libs/@frostui/tailwindcss/frostui.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/aos/aos.js') }}"></script>
    <script src="{{ asset('dist/assets/js/theme.min.js') }}"></script>
</body>
</html>
