<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="https://i.postimg.cc/bvSyKtcP/No-text-white-logo.png" type="image/png">

    <title>{{ config('app.name', 'flippinpages') }}</title>

    <!-- Scripts -->
    @vite(['resources/assets/sass/app.scss', 'resources/assets/js/app.js'])
    @yield('localVite')
</head>

<body class="flex flex-col">
    @include('layouts.navigation')
    <div class="main-content">
        @yield('main')
    </div>
    @include('layouts.footer')
</body>

</html>
